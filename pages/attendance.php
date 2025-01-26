<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "header.php"; ?>
    <title>Attendance Recapitulation</title>
</head>
<body>

    <?php include "menu.php"; ?>

    <div class="container-fluid">
        <h3>Attendance Recap</h3>
        <table class="table table-bordered">
            <thead>
                <tr style="background-color: grey;" color: white>
                    <th style="width: 10px; text-align: center;">No</th>
                    <th style="width: 100px; text-align: center;">NIM</th>
                    <th style="width: 400px; text-align: center;">Name</th>
                    <th style="width: 100px; text-align: center;">Date</th>
                    <th style="width: 100px; text-align: center;">Time</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    include "connect.php";

                    date_default_timezone_set('Asia/Jakarta');
                    $date = date('Y-m-d');

                    // Filter attendance based on the current date
                    $sql = mysqli_query($connect, 
                        "SELECT b.Name, b.NIM, a.Date, a.Time 
                        FROM attendance a, student b 
                        WHERE a.IDCard = b.IDCard AND a.Date = '$date'");

                    $no = 0;
                    while($data = mysqli_fetch_array($sql)) {
                        $no++;
                ?>
                <tr>
                    <td> <?php echo $no; ?> </td>
                    <td> <?php echo $data['NIM']; ?> </td>
                    <td> <?php echo $data['Name']; ?> </td>
                    <td> <?php echo $data['Date']; ?> </td>
                    <td> <?php echo $data['Time']; ?> </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <h3>Validation History</h3>
        <table class="table table-bordered" id="validationTable">
            <thead>
                <tr style="background-color: grey;" color: white>
                    <th style="width: 100px; text-align: center;">Jumlah Scan RFID</th>
                    <th style="width: 100px; text-align: center;">Jumlah Scan YOLO</th>
                    <th style="width: 100px; text-align: center;">Validation Date</th>
                    <th style="width: 100px; text-align: center;">Validation Status</th>
                    <th style="width: 100px; text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = mysqli_query($connect, "SELECT * FROM validation_log ORDER BY validation_date DESC");
                    while($data = mysqli_fetch_array($sql)) {
                ?>
                <tr>
                    <td><?php echo $data['jumlah_scan_rfid']; ?></td>
                    <td><?php echo $data['jumlah_scan_yolo']; ?></td>
                    <td><?php echo $data['validation_date']; ?></td>
                    <td style="color: <?php echo $data['validation_status'] == 'Valid' ? 'green' : 'red'; ?>;">
                        <?php echo $data['validation_status']; ?>
                    </td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="editValidation(<?php echo $data['id']; ?>)">Edit</button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php include "footer.php"; ?>

    <script>
        function editValidation(validationId) {
            // Redirect to an edit page or show an edit form
            window.location.href = `edit_validation.php?id=${validationId}`;
        }
    </script>

</body>
</html>
