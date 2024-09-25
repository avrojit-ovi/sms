<?php
// config.php

$host = 'localhost';     // Database host
$dbname = 'u636183987_sms'; // Database name
$username = 'u636183987_sms';  // Database username
$password = 'u636183987_smS';  // Database password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}
?>
