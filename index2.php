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
    <title>Dashboard Template</title>
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
    <div class="content">
        <!-- Include Navbar -->
        <?php include 'assets/navbar.php'; ?>
<br>
        <!-- Page Content -->
        <div class="container-fluid">
            <!-- Rounded Card Div -->
            <div class="rounded-card shadow-lg p-5 bg-white rounded">
                <h1>Dashboard Card</h1>
                <p>This is a full-width rounded card inside the main content area of the dashboard. You can put any content here.</p>
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
