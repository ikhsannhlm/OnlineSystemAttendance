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

                    //filter attend based this date
                    $sql = mysqli_query($connect, 
                        "select b.Name, b.NIM, a.Date, a.Time 
                        from attendance a, student b 
                        where a.IDCard=b.IDCard and a.Date='$date'");
                    
                    $no = 0;
                    while($data = mysqli_fetch_array($sql))
                    {
                        $no++;
                ?>
                <tr>
                    <td> <?php echo $no; ?> </td>
                    <td> <?php echo $data['NIM']; ?> </td>
                    <td> <?php echo $data['Name']; ?> </td>
                    <td> <?php echo $data['Date']; ?> </td>
                    <td> <?php echo $data['Time']; ?> </td>
                </tr>
                <?php }?>
            </tbody>
        </table>

    </div>

    <?php include "footer.php"; ?>
    
</body>
</html>