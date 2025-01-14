<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "header.php" ?>
    <title>Scan Card</title>

    <!--Scanning RFID Card-->
    <script type="text/javascript">
        $(document).ready(function() {
            setInterval(function() {
                $("#checkcard").load('readcard.php')
            }, 2000);
        });
    </script>

</head>
<body>
    <?php 
        include "menu.php" 
    ?>

    <div class="container-fluid" style="padding-top: 10%">
        <div id="checkcard"></div>
    </div>

    <?php 
        include "footer.php" 
    ?>
</body>
</html>