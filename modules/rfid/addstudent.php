<!--saving process-->
<?php
    include "connect.php";

    if(isset($_POST['btnSave']))
    {
        //Read Input Form
        $idcard = $_POST['IDCard'];
        $nim = $_POST['NIM'];
        $name = $_POST['Name'];

        //Save to Student Table
        $save = mysqli_query($connect, "insert into student(IDCard, NIM, Name)values('$idcard', '$nim', '$name')");

        //If Success show message saved and back to Student Data Page
        if($save)
        {
            echo "
                <script>
                    alert('Data Saved');
                    location.replace('studentdata.php');
                </script>
            ";
        }else
        {
            echo "
                <script>
                    alert('Failed add data');
                    location.replace('studentdata.php');
                </script>
            ";
        }

        //empty the tmprfid table
        mysqli_query($connect, "delete from tmprfid");

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "header.php" ?>
    <title>Add Student Data</title>

    <!--read IDCard automation-->
    <script type="text/javascript">
        $(document).ready(function(){
            setInterval(function(){
                $("#idcard").load('idcard.php')
            }, 0);
        });
    </script>

</head>
<body>
    
    <?php include "menu.php" ?>

    <!--isi--->
    <div class="container-fluid">
        <h3>Add Student Data</h3>

        <!--form input-->
        <form method="POST">
            <div id="idcard"></div>
            <div class="form-group">
                <label>NIM</label>
                <input type="text" name="NIM" id="NIM" placeholder="NIM" class="form-control" style="width: 200px;">
            </div>
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="Name" id="Name" placeholder="Name" class="form-control" style="width: 400px;">
            </div>
            <button class="btn btn-primary" name="btnSave" id="btnSave">Save</button>
        </form>
    </div>

    <?php include "footer.php" ?>

</body>
</html>