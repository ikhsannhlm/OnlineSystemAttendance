<?php
date_default_timezone_set("Asia/Jakarta"); // Set zona waktu ke Asia/Jakarta
include 'connect.php'; // Koneksi ke database
include 'validation.php'; // Include file validasi

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $total_people = isset($_POST['total_people']) ? (int)$_POST['total_people'] : 0;
    $date = date("Y-m-d");
    $time = date("H:i:s");

    $sql = "INSERT INTO scan_yolo (date, time, total_people_detected) VALUES ('$date', '$time', $total_people)";

    if (mysqli_query($connect, $sql)) {
        // Panggil fungsi validasi setelah data berhasil disimpan
        validate_scans($date, $time, $total_people, $connect);

        echo "<script>
                alert('Data berhasil disimpan dan validasi dijalankan!');
                window.location.href = 'scan_yolo.php'; // Sesuaikan halaman tujuan
              </script>";
    } else {
        echo "<script>
                alert('Gagal menyimpan data: " . mysqli_error($connect) . "');
                window.history.back();
              </script>";
    }

    mysqli_close($connect);
}
?>
