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

                    // Filter attendance based on the current date
                    $sql = mysqli_query($connect, 
                        "SELECT b.Name, b.NIM, a.Date, a.Time 
                        FROM attendance a, student b 
                        WHERE a.IDCard = b.IDCard AND a.Date = '$date'");
                    
                    $no = 0;
                    while($data = mysqli_fetch_array($sql)) {
                        $no++;
                ?>
                <tr>
                    <td> <?php echo $no; ?> </td>
                    <td> <?php echo $data['NIM']; ?> </td>
                    <td> <?php echo $data['Name']; ?> </td>
                    <td> <?php echo $data['Date']; ?> </td>
                    <td> <?php echo $data['Time']; ?> </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <button class="btn btn-primary" id="btnScanYolo">Scan With YOLO</button>
        <input type="file" id="uploadImage" style="display: none;" accept="image/jpeg">

        <div id="result" style="margin-top: 20px;"></div>

        <h3>Validation</h3>
        <table class="table table-bordered" id="validationTable">
            <thead>
                <tr style="background-color: grey;" color: white>
                    <th style="width: 100px; text-align: center;">Jumlah Scan RFID</th>
                    <th style="width: 100px; text-align: center;">Jumlah Scan YOLO</th>
                    <th style="width: 100px; text-align: center;">Validation</th>
                    <th style="width: 10px; text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be appended dynamically here -->
            </tbody>
        </table>
    </div>

    <?php include "footer.php"; ?>

    <script>
        const btnScanYolo = document.getElementById('btnScanYolo');
        const uploadImage = document.getElementById('uploadImage');
        const result = document.getElementById('result');
        const validationTable = document.querySelector("#validationTable tbody");

        btnScanYolo.addEventListener('click', () => {
            uploadImage.click();
        });

        uploadImage.addEventListener('change', () => {
            const file = uploadImage.files[0];

            // Validate file type
            if (file && file.type === 'image/jpeg') {
                const formData = new FormData();
                formData.append('image', file);

                fetch('upload_to_api.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Display the processed image
                        result.innerHTML = `<img src="${data.outputImage}" alt="Processed Image" style="max-width: 100%;">`;

                        // Add data to the Validation table
                        const newRow = `
                            <tr>
                                <td>${uploadImage.files.length}</td>
                                <td>${data.totalPeopleDetected}</td>
                                <td style="color: ${data.totalPeopleDetected > 0 ? 'green' : 'red'};">
                                    ${data.totalPeopleDetected > 0 ? 'Valid' : 'Invalid'}
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm">Edit</button>
                                </td>
                            </tr>
                        `;
                        validationTable.insertAdjacentHTML('beforeend', newRow);
                    } else {
                        result.innerHTML = `<p style="color: red;">${data.message}</p>`;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    result.innerHTML = `<p style="color: red;">Error processing the image.</p>`;
                });
            } else {
                result.innerHTML = `<p style="color: red;">Please upload a valid JPG image.</p>`;
            }
        });
    </script>
</body>
</html>
