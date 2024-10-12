
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "phpcoban"; // tên của database
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }
?>
