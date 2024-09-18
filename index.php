<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit;
}

// Include database connection
require_once 'config.php';


?>
<?php include 'dheader.php' ?>
    <h2 class="text-center">Welcome to Svadhana Recorder Admin Dashboard</h2>
    <p class="text-center">Logged in User ID: <strong><?php echo htmlspecialchars($user['userid']); ?></strong></p>
    <p class="text-center">Logged in Name: <strong><?php echo htmlspecialchars($userName); ?></strong></p>
    <h4 class="text-center alert alert-primary">More Features will be coming soon</h4>
</div>
</div>
<?php include 'dfooter.php' ?>
