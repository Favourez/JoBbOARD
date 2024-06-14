<?php
$conn = new mysqli('localhost', 'root', '', 'user_database');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
$conn->close();
?>
