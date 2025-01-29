<?php
date_default_timezone_set("Asia/Jakarta"); // Set zona waktu ke Asia/Jakarta
include 'connect.php'; // Koneksi ke database
include 'validation.php'; // Include file validasi

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $total_people = isset($_POST['total_people']) ? (int)$_POST['total_people'] : 0;
    $date = date("Y-m-d");
    $time = date("H:i:s");

    // Ambil file gambar dari form (jika ada)
    $image_url = isset($_POST['image_url']) ? $_POST['image_url'] : '';

    $sql = "INSERT INTO scan_yolo (date, time, total_people_detected) VALUES ('$date', '$time', $total_people)";

    if (mysqli_query($connect, $sql)) {
        // Jalankan validasi setelah data disimpan
        validate_scans($date, $time, $total_people, $connect);

        // Hapus file gambar jika ada
        if (!empty($image_url) && file_exists($image_url)) {
            unlink($image_url);
        }

        echo "<script>
                alert('Data berhasil disimpan dan gambar dihapus!');
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
