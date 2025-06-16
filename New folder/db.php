<?php
$servername = "localhost";
$username = "root";
$password = ""; // nếu bạn có password
$dbname = "Test1";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Ket noi that bai: " . $conn->connect_error);
}

?>
