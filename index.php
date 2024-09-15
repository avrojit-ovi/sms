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

// If name is available in the profiles table, use it; otherwise fallback to the userid
$userName = $user ? ($user['name'] ?: 'Name not found') : 'Unknown User';

?>
<?php include 'dheader.php' ?>
                <h2 class="text-center">Welcome to Svadhana Recorder Admin Dashboard</h2>
                <p class="text-center">Logged in User ID: <strong><?php echo htmlspecialchars($user['userid']); ?></strong></p>
                <p class="text-center">Logged in Name: <strong><?php echo htmlspecialchars($userName); ?></strong></p>
                <h4 class="text-center alert alert-primary">More Features will be comming soon</h4>
            </div>
        </div>
        <?php include 'dfooter.php' ?>