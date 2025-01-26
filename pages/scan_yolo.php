<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "header.php"; ?>
    <title>Scan YOLO</title>
</head>
<body>

    <?php include "menu.php"; ?>

    <div class="container-fluid">
        <h3>Scan With YOLO</h3>
        <input type="file" id="uploadImage" accept="image/jpeg">
        <div id="result" style="margin-top: 20px;"></div>

        <form id="saveValidationForm" style="display:none;">
            <input type="hidden" id="rfidCount" name="rfidCount">
            <input type="hidden" id="yoloCount" name="yoloCount">
            <input type="hidden" id="validationStatus" name="validationStatus">
            <button type="submit" class="btn btn-success">Save Validation</button>
        </form>
    </div>

    <?php include "footer.php"; ?>

    <script>
        const uploadImage = document.getElementById('uploadImage');
        const result = document.getElementById('result');
        const saveValidationForm = document.getElementById('saveValidationForm');
        const rfidCount = document.getElementById('rfidCount');
        const yoloCount = document.getElementById('yoloCount');
        const validationStatus = document.getElementById('validationStatus');

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
                        result.innerHTML = `<img src="${data.outputImage}" alt="Processed Image" style="max-width: 100%;">`;

                        // Populate form values for saving validation
                        rfidCount.value = 1;  // Example, replace with real RFID count
                        yoloCount.value = data.totalPeopleDetected;
                        validationStatus.value = (rfidCount.value == yoloCount.value) ? 'Valid' : 'Invalid';

                        saveValidationForm.style.display = 'block';
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

        saveValidationForm.addEventListener('submit', (e) => {
            e.preventDefault();

            fetch('save_validation.php', {
                method: 'POST',
                body: new FormData(saveValidationForm)
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                saveValidationForm.reset();
                saveValidationForm.style.display = 'none';
            })
            .catch(error => {
                console.error('Error saving validation:', error);
            });
        });
    </script>
</body>
</html>
