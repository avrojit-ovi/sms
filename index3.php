<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit;
}

// Include database connection
require_once 'config.php';

// Fetch user details from the database
$userid = $_SESSION['userid'];

$query = "SELECT u.userid, p.name 
          FROM users u
          LEFT JOIN profiles p ON u.userid = p.userid 
          WHERE u.userid = :userid";

$stmt = $conn->prepare($query);
$stmt->bindParam(':userid', $userid);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// If the profiles table has a 'name' column, use it, otherwise fallback to 'userid'
$userName = $user ? ($user['name'] ?: $user['userid']) : 'Unknown User';

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
                <h2 class="text-center">Welcome to Svadhana Recorder Admin Dashboard</h2>
                <p class="text-center">Logged in as: <strong><?php echo htmlspecialchars($userName); ?></strong></p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script>
    // Sidebar Toggle Script
    document.getElementById("sidebarToggle").addEventListener("click", function() {
        const sidebar = document.getElementById("sidebar");
        const content = document.getElementById("content");
        const navbar = document.querySelector(".navbar");

        sidebar.classList.toggle("collapsed-sidebar");
        content.classList.toggle("collapsed-content");
        navbar.classList.toggle("collapsed-navbar");
    });

    // Bottom Collapse Button
    document.getElementById("sidebarCollapseBtn").addEventListener("click", function() {
        const sidebar = document.getElementById("sidebar");
        const content = document.getElementById("content");
        const navbar = document.querySelector(".navbar");

        sidebar.classList.toggle("collapsed-sidebar");
        content.classList.toggle("collapsed-content");
        navbar.classList.toggle("collapsed-navbar");
    });
</script>

</body>
</html>
