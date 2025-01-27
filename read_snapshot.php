<?php
$snapshotPath = 'snapshots/image.jpg';

if (file_exists($snapshotPath)) {
    echo '<h3>Snapshot Detected!</h3>';
    echo '<img src="' . $snapshotPath . '" style="width: 300px; border: 2px solid #000;">';
} else {
    echo '<h3>Scanning for snapshot...</h3>';
    echo '<img src="images/scanning.gif" style="width: 300px; border-radius: 50%;">';
}
?>
