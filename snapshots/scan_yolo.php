<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan YOLO</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <?php include 'header.php'; ?>
    <style>
        #snapshot-container img {
            max-width: 300px;
            margin: 20px auto;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <?php include 'sidebar.php'; ?>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Scan YOLO</h1>
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

        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Scanning Snapshot Folder</h3>
                </div>
                <div class="card-body text-center" id="snapshot-container">
                    <img src="images/scanning.gif" alt="Scanning" id="loading-gif">
                </div>
            </div>
            
            <div id="scan-result" class="mt-3" style="display: none;">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">YOLO Scan Result</h3>
                    </div>
                    <div class="card-body" id="result-container"></div>
                </div>
            </div>
        </section>
    </div>

    <?php include 'footer.php'; ?>

    <script>
        function scanFolder() {
            $.ajax({
                url: "scan_folder.php",
                method: "GET",
                dataType: "json",
                success: function(response) {
                    if (response.status === "found") {
                        $("#loading-gif").attr("src", "images/uploading.gif");
                        sendToAPI(response.file_path, response.file_name);
                    } else {
                        setTimeout(scanFolder, 2000);
                    }
                },
                error: function() {
                    console.error("Error scanning folder.");
                    setTimeout(scanFolder, 2000);
                }
            });
        }

        function sendToAPI(filePath, fileName) {
            $.ajax({
                url: "send_to_api.php",
                method: "POST",
                data: { file_path: filePath, file_name: fileName },
                dataType: "json",
                success: function(response) {
                    if (response.status === "success") {
                        $("#loading-gif").attr("src", "images/success.gif");
                        setTimeout(() => {
                            $("#loading-gif").attr("src", "images/scanning.gif");
                            scanFolder();
                        }, 5000);
                        
                        $("#scan-result").show();
                        $("#result-container").html(`
                            <h4>Total People Detected: ${response.total_people_detected}</h4>
                            <img src="${response.output_image}" class="img-fluid" alt="YOLO Detection Result">
                            <form action="save_result.php" method="POST" class="mt-3">
                                <input type="hidden" name="image_url" value="${response.image_url}">
                                <div class="form-group">
                                    <label for="total_people">Total People Detected</label>
                                    <input type="number" name="total_people" id="total_people" class="form-control" value="${response.total_people_detected}" required>
                                </div>
                                <button type="submit" class="btn btn-success">Save</button>
                            </form>
                        `);
                    } else {
                        console.error(response.message);
                        setTimeout(scanFolder, 2000);
                    }
                },
                error: function() {
                    console.error("Error sending file to API.");
                    setTimeout(scanFolder, 2000);
                }
            });
        }

        $(document).ready(function() {
            scanFolder();
        });
    </script>
</body>
</html>
