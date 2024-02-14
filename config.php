<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bank";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// $conn = new mysqli("localhost", "localhost", "Amol123@", "bank");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
