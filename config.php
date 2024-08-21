<?php
// config.php

$host = 'localhost';     // Database host
$dbname = 'svadharmam_db'; // Database name
$username = 'root';  // Database username
$password = '';  // Database password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}
?>
