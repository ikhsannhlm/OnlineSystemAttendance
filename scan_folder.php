<?php
$folderPath = "snapshots";
$allowedExtensions = ['jpg', 'jpeg', 'png'];

// Cari file dalam folder
$files = array_filter(scandir($folderPath), function($file) use ($folderPath, $allowedExtensions) {
    $filePath = $folderPath . DIRECTORY_SEPARATOR . $file;
    $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    return is_file($filePath) && in_array($extension, $allowedExtensions);
});

if (!empty($files)) {
    $fileName = reset($files);
    $filePath = $folderPath . DIRECTORY_SEPARATOR . $fileName;

    echo json_encode([
        'status' => 'found',
        'file_name' => $fileName,
        'file_path' => $filePath
    ]);
} else {
    echo json_encode(['status' => 'not_found']);
}
