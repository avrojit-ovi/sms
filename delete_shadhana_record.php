<?php
session_start();
require_once 'config.php';

// Check if the user is logged in and has the appropriate role
if (!isset($_SESSION['userid']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'counselor')) {
    header("Location: noaccess.php");
    exit;
}

// Get the record ID from the query string
$record_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Delete the record from the database
$sql = "DELETE FROM shadhana_record WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $record_id, PDO::PARAM_INT);
$stmt->execute();

header("Location: view_shadhana_records.php");
exit;
