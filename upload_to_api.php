<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['image'])) {
        $image = $_FILES['image'];

        // Pastikan file diunggah tanpa error
        if ($image['error'] === UPLOAD_ERR_OK) {
            $fileType = mime_content_type($image['tmp_name']);
            $allowedTypes = ['image/jpeg'];

            // Validasi tipe file
            if (in_array($fileType, $allowedTypes)) {
                $filePath = $image['tmp_name'];

                // URL API Anda
                $apiUrl = "http://127.0.0.1:8000/predict";

                // Kirim file ke API
                $curl = curl_init();
                $cfile = curl_file_create($filePath, 'image/jpeg', $image['name']);
                $data = array('file' => $cfile);

                curl_setopt($curl, CURLOPT_URL, $apiUrl);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_HEADER, true); // Dapatkan headers dan body

                $response = curl_exec($curl);
                $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

                // Pisahkan header dan body
                $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
                $headers = substr($response, 0, $headerSize);
                $body = substr($response, $headerSize);

                curl_close($curl);

                if ($httpCode == 200) {
                    // Parse header untuk mendapatkan Total-People-Detected
                    $headersArray = [];
                    foreach (explode("\r\n", $headers) as $headerLine) {
                        if (strpos($headerLine, ":") !== false) {
                            list($key, $value) = explode(":", $headerLine, 2);
                            $headersArray[trim($key)] = trim($value);
                        }
                    }
                
                    // Perbaiki penulisan header: 'total-people-detected'
                    $totalPeopleDetected = $headersArray['total-people-detected'] ?? 0;
                
                    // Simpan gambar hasil dari API
                    $outputImage = 'output_' . time() . '.jpg';
                    file_put_contents($outputImage, $body);
                
                    echo json_encode([
                        'status' => 'success',
                        'outputImage' => $outputImage,
                        'totalPeopleDetected' => $totalPeopleDetected
                    ]);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to process image']);
                }
                
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Only JPG files are allowed']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error uploading file']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No file uploaded']);
    }
}
?>
