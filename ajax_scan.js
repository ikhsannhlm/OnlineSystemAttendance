$(document).ready(function () {
    function scanFolder() {
        $.ajax({
            url: "check_folder.php",
            method: "GET",
            success: function (data) {
                if (data !== "No file found") {
                    // Ganti ke uploading.gif
                    $("#status-image").attr("src", "images/uploading2.gif");

                    // Kirim file ke API
                    uploadFile(data);
                } else {
                    // Jika tidak ada file, ulangi scanning
                    setTimeout(scanFolder, 2000);
                }
            },
            error: function () {
                console.error("Error scanning folder.");
                setTimeout(scanFolder, 2000);
            }
        });
    }

    function uploadFile(filename) {
        $.ajax({
            url: "send_to_api.php",
            method: "POST",
            data: { filename: filename },
            success: function (response) {
                $("#status-image").attr("src", "images/success2.gif");

                // Tampilkan hasil respons selama 5 detik
                $("#response").html(response);
                setTimeout(function () {
                    $("#status-image").attr("src", "images/scanning2.gif");
                    $("#response").empty();
                    scanFolder();
                }, 5000);
            },
            error: function () {
                console.error("Error uploading file.");
                $("#status-image").attr("src", "images/scanning2.gif");
                scanFolder();
            }
        });
    }

    // Mulai proses scanning
    scanFolder();
});
