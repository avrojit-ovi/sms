<?php 
require_once 'config.php';
// Fetch user details from the database
$userid = $_SESSION['userid'];

$query = "SELECT userid, name FROM users WHERE userid = :userid";
$stmt = $conn->prepare($query);
$stmt->bindParam(':userid', $userid);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// If name is available in the users table, use it; otherwise fallback to 'Name not found'
$userName = $user ? ($user['name'] ?: 'Name not found') : 'Unknown User';
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Svadhana Recorder Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/custom.css">
</head>
<body>

    <!-- Include Sidebar -->
    <?php include 'assets/sidebar.php'; ?>

    <!-- Main Content -->
    <div id="content" class="content">
        <!-- Include Navbar -->
        <?php include 'assets/navbar.php'; ?>

        <!-- Page Content -->
        <div class="container-fluid">
            <!-- Scrollable Rounded Div Card -->
            <div class="main-card shadow-lg p-5">