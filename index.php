<?php
session_start();  // Start the session

if (!isset($_SESSION['user_id'])) {
    // If the user is not logged in, redirect to login page
    header("Location: login.php");
    exit;
}

// If the user is logged in, display the content
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Svadharmam Management System</title>
</head>
<body>
    <h1>Welcome to Svadharmam Management System!</h1>
    <p>You are logged in.</p>
    <a href="logout.php">Log Out</a>

</body>
</html>
