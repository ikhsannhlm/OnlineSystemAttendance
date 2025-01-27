<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan YOLO</title>
    <?php include 'header.php'; ?> <!-- Include header -->
    <!-- Realtime Scanning Script -->
    <script type="text/javascript">
        $(document).ready(function() {
            setInterval(function() {
                $("#snapshotCheck").load('read_snapshot.php');
            }, 1000); // Check every second
        });
    </script>
</head>
<body>

<?php include 'navbar.php'; ?> <!-- Include navbar -->
<?php include 'sidebar.php'; ?> <!-- Include sidebar -->

<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Scan YOLO Snapshot</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Scan YOLO</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Realtime YOLO Snapshot</h3>
            </div>
            <div id="snapshotCheck" style="text-align: center; padding: 20px;"></div>
        </div>
    </section>
</div>

<?php include 'footer.php'; ?> <!-- Include footer -->

</body>
</html>

<?php
// read_snapshot.php
$snapshotPath = 'snapshots/image.jpg';

if (file_exists($snapshotPath)) {
    echo '<h3>Snapshot Detected!</h3>';
    echo '<img src="' . $snapshotPath . '" style="width: 300px; border: 2px solid #000;">';
} else {
    echo '<h3>Scanning for snapshot...</h3>';
    echo '<img src="images/scanning.gif" style="width: 300px;">';
}
?>
