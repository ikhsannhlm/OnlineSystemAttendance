<!--saving process-->
<?php
    include "connect.php";

    //read ID
    $id = $_GET['id'];

    //read data
    $search = mysqli_query($connect, "select * from student where ID='$id'");
    $result = mysqli_fetch_array($search);

    if(isset($_POST['btnSave']))
    {
        //Read Input Form
        $idcard = $_POST['IDCard'];
        $nim = $_POST['NIM'];
        $name = $_POST['Name'];

        //Save to Student Table
        $save = mysqli_query($connect, "update student set IDCard='$idcard', NIM='$nim', Name='$name' where ID='$id'");

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

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "header.php" ?>
    <title>Edit Student Data</title>
</head>
<body>
    
    <?php include "menu.php" ?>

    <!--isi--->
    <div class="container-fluid">
        <h3>Edit Student Data</h3>

        <!--form input-->
        <form method="POST">
            <div class="form-group">
                <label>IDCard</label>
                <input type="text" name="IDCard" id="IDCard" placeholder="IDCard Number" class="form-control" style="width: 200px;" value="<?php echo $result['IDCard']; ?>">
            </div>
            <div class="form-group">
                <label>NIM</label>
                <input type="text" name="NIM" id="NIM" placeholder="NIM" class="form-control" style="width: 200px;" value="<?php echo $result['NIM']; ?>">
            </div>
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="Name" id="Name" placeholder="Name" class="form-control" style="width: 400px;" value="<?php echo $result['Name']; ?>">
            </div>
            <button class="btn btn-primary" name="btnSave" id="btnSave">Save</button>
        </form>
    </div>

    <?php include "footer.php" ?>

</body>
</html>