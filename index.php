<?php
session_start();  // Start the session

if (!isset($_SESSION['userid'])) {
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
    <p><?php echo $_SESSION['userid']; ?>,You are logged in.</p>
    <br>
    <a href="create_profile.php">Add Profile</a>
    <br>
    <a href="add_counselor.php">Add Counselor</a>
    <br>
    <a href="shadhana_recorder.php">Add Shadhana Record</a>
    <br>
    <a href="assign_counselor.php">Assign Counselor</a>
    <br>
    <a href="view_profiles.php">View Profile</a>
    <br>
    <a href="view_users.php">View Users</a>
    <br>
    <a href="logout.php">Log Out</a>

</body>
</html>
