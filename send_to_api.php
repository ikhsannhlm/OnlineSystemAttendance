<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filePath = $_POST['file_path'];
    $fileName = $_POST['file_name'];

    $fileType = mime_content_type($filePath);
    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];

    if (in_array($fileType, $allowedTypes)) {
        $apiUrl = "http://127.0.0.1:8000/predict";

        // Kirim file ke API
        $curl = curl_init();
        $cfile = curl_file_create($filePath, $fileType, $fileName);
        $data = array('file' => $cfile);

        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        // Pisahkan header dan body
        $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $headers = substr($response, 0, $headerSize);
        $body = substr($response, $headerSize);

        curl_close($curl);

        if ($httpCode == 200) {
            // Parsing header
            $headersArray = [];
            foreach (explode("\r\n", $headers) as $headerLine) {
                if (strpos($headerLine, ":") !== false) {
                    list($key, $value) = explode(":", $headerLine, 2);
                    $headersArray[trim($key)] = trim($value);
                }
            }
            
            // Hapus file setelah sukses
            unlink($filePath);

            // Ambil jumlah orang terdeteksi dari header
            $totalPeopleDetected = $headersArray['total-people-detected'] ?? 0;

            // Simpan gambar hasil dari API
            $uploadDir = 'uploads/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $outputImage = $uploadDir . 'output_' . time() . '.jpg';
            file_put_contents($outputImage, $body);

            // Kirim status sukses
            echo json_encode([
                'status' => 'success',
                'message' => 'Image processed successfully',
                'output_image' => $outputImage,
                'total_people_detected' => $totalPeopleDetected
            ]);
            exit;
        } else {
            // Kirim status error
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to process image',
                'http_code' => $httpCode
            ]);
            exit;
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid file type'
        ]);
    }
}
