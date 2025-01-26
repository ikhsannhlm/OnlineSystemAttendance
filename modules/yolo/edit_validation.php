<?php
include "connect.php";

if (isset($_GET['id'])) {
    $validationId = $_GET['id'];

    // Ambil data validasi berdasarkan ID
    $sql = mysqli_query($connect, "SELECT * FROM validation WHERE id = $validationId");
    $data = mysqli_fetch_array($sql);

    if (!$data) {
        echo "Data not found!";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jumlah_scan_rfid = $_POST['jumlah_scan_rfid'];
    $jumlah_scan_yolo = $_POST['jumlah_scan_yolo'];
    $validationStatus = $_POST['validationStatus'];

    // Update data validasi
    $sql = "UPDATE validation 
            SET jumlah_scan_rfid = '$jumlah_scan_rfid', jumlah_scan_yolo = '$jumlah_scan_yolo', validation_status = '$validationStatus' 
            WHERE id = $validationId";

    if (mysqli_query($connect, $sql)) {
        echo "<script>alert('Validation updated successfully'); window.location.href = 'attend.php';</script>";
    } else {
        echo "Failed to update validation.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "header.php"; ?>
    <title>Edit Validation</title>
</head>
<body>

    <?php include "menu.php"; ?>

    <div class="container-fluid">
        <h3>Edit Validation</h3>
        <form method="POST">
            <div class="form-group">
                <label for="jumlah_scan_rfid">Jumlah Scan RFID</label>
                <input type="number" class="form-control" id="jumlah_scan_rfid" name="jumlah_scan_rfid" value="<?php echo $data['jumlah_scan_rfid']; ?>" required>
            </div>
            <div class="form-group">
                <label for="jumlah_scan_yolo">Jumlah Scan YOLO</label>
                <input type="number" class="form-control" id="jumlah_scan_yolo" name="jumlah_scan_yolo" value="<?php echo $data['jumlah_scan_yolo']; ?>" required>
            </div>
            <div class="form-group">
                <label for="validationStatus">Validation Status</label>
                <select class="form-control" id="validationStatus" name="validationStatus" required>
                    <option value="Valid" <?php echo $data['validation_status'] == 'Valid' ? 'selected' : ''; ?>>Valid</option>
                    <option value="Invalid" <?php echo $data['validation_status'] == 'Invalid' ? 'selected' : ''; ?>>Invalid</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Validation</button>
        </form>
    </div>

    <?php include "footer.php"; ?>

</body>
</html>
