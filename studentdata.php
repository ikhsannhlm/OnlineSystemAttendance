<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "header.php" ?>
    <title>Student Data</title>
</head>
<body>
    <?php include "menu.php"; ?>

    <!--isi-->
    <div class="container-fluid">
        <h3>Student Data</h3>
        <table class="table table-bordered">
            <thead>
                <tr style="background-color: grey; color: white;">
                    <th style="width: 10px; text-align: center;">No</th>
                    <th style="width: 100px; text-align: center;">IDCard</th>
                    <th style="width: 100px; text-align: center;">NIM</th>
                    <th style="width: 400px; text-align: center;">Name</th>
                    <th style="width: 100px; text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>

                <!--Connect to Database-->
                <?php
                    include "connect.php";

                    //read student data
                    $sql = mysqli_query($connect, "select * from student"); 
                    $no=0;
                    while($data = mysqli_fetch_array($sql))
                    {
                        $no++;
                ?>

                <tr>
                    <td> <?php echo $no; ?> </td>
                    <td> <?php echo $data['IDCard']; ?> </td>
                    <td> <?php echo $data['NIM']; ?> </td>
                    <td> <?php echo $data['Name']; ?> </td>
                    <td>
                        <a href="editstudent.php?id=<?php echo $data['ID']; ?>">
                            Edit
                        </a> | 
                        <a href="deletestudent.php?id=<?php echo $data['ID']; ?>">
                            Delete
                        </a>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
        
        <!--Add Student Button-->
        <a href="addstudent.php">
            <button class="btn btn-primary">
                Add Student
            </button>
        </a>

    </div>
    
    <?php include "footer.php"; ?>

</body>
</html>