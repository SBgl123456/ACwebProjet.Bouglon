<?php
// Database connection settings
$host = "localhost";
$user = "root";
$password = "bouglon123456";
$database = "sae23";

// Connect to the database
$conn = mysqli_connect($host, $user, $password, $database);

// Set character encoding to UTF-8
mysqli_set_charset($conn, "utf8");
?>
