<?php
include "connect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $rfidCount = $_POST['rfidCount'];
    $yoloCount = $_POST['yoloCount'];
    $validationStatus = $_POST['validationStatus'];

    // Insert ke database
    $validationDate = date('Y-m-d H:i:s');
    $sql = "INSERT INTO validation (rfid_count, yolo_count, validation_date, validation_status)
            VALUES ('$rfidCount', '$yoloCount', '$validationDate', '$validationStatus')";

    if (mysqli_query($connect, $sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Validation saved successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to save validation']);
    }
}
?>
