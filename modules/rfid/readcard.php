<?php 
include "connect.php";

// read table tmprfid
$readrfid = mysqli_query($connect, "select * from tmprfid");
$datarfid = mysqli_fetch_array($readrfid);

// Periksa apakah $datarfid tidak null
if ($datarfid) {
    $idcard = $datarfid['IDCard'];
} else {
    $idcard = ""; // Atur idcard menjadi string kosong jika tidak ada data
}
?>

<div class="container-fluid" style="text-align: center;">
    <?php if($idcard == "") 
    { ?>
        <h3>Please Put Your Card on the Reader</h3>
        <img src="images/rfid.png" style="width: 200px;"> <br>
        <img src="images/animasi2.gif" style="width: 200px;">
    <?php 
    } else {
        
        // check the card registered or not
        $seacrh_student = mysqli_query($connect, "select * from student where IDCard='$idcard'");
        $sumdata = mysqli_num_rows($seacrh_student);

        if($sumdata == 0) {
            echo "<h1>Sorry! Your card isn't registered</h1>";
        } else {
            $studentdata = mysqli_fetch_array($seacrh_student);
            $name = $studentdata['Name'];

            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $time = date('H:i:s');

            // check in attendance table, is the idcard available this date?. 
            // if not, so its input by come in attendance, but if available
            // update the data
            $search_attend = mysqli_query($connect, "select * from attendance where IDCard='$idcard' and Date='$date'");
            
            // count the data
            $sum_attend = mysqli_num_rows($search_attend);
            if($sum_attend == 0) {
                echo "<h1>Welcome, $name :)</h1>";
                mysqli_query($connect, "insert into attendance(IDCard, Date, Time) values('$idcard', '$date', '$time')");
            } else {
                echo "<h1>Kamu sudah absen, $name :)</h1>";
            }
        }

        // empty the tmprfid table
        mysqli_query($connect, "delete from tmprfid");
    } 
    ?>
</div>
