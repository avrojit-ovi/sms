<?php
session_start();
require_once 'config.php';

// Check if the user is logged in and has the appropriate role
if (!isset($_SESSION['userid']) || $_SESSION['role'] !== 'admin') {
    header("Location: noaccess.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $counselorId = $_POST['counselor'];
    $userIds = isset($_POST['users']) ? $_POST['users'] : [];
    $assignedBy = $_SESSION['userid'];

    try {
        $conn->beginTransaction();

        // Insert assignments
        $assignSql = "INSERT INTO assigned_counselor (counselor_id, user_id, assigned_by) VALUES (:counselor_id, :user_id, :assigned_by)";
        $assignStmt = $conn->prepare($assignSql);

        foreach ($userIds as $userId) {
            $assignStmt->bindParam(':counselor_id', $counselorId);
            $assignStmt->bindParam(':user_id', $userId);
            $assignStmt->bindParam(':assigned_by', $assignedBy);
            $assignStmt->execute();
        }

        $conn->commit();
        $message = "Users successfully assigned to the counselor.";
        $alertClass = "alert-success";
    } catch (Exception $e) {
        $conn->rollBack();
        $message = "Failed to assign users: " . $e->getMessage();
        $alertClass = "alert-danger";
    }
} else {
    header("Location: assign_counselor.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Counselor - Svadharmam Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="alert <?php echo htmlspecialchars($alertClass); ?>" role="alert">
            <?php echo htmlspecialchars($message); ?>
        </div>
        <p>You will be redirected back to the assign counselor page in <span id="countdown">10</span> seconds.</p>
        <script>
            let countdown = 10;
            const countdownElement = document.getElementById('countdown');
            const interval = setInterval(() => {
                countdown--;
                countdownElement.textContent = countdown;
                if (countdown <= 0) {
                    clearInterval(interval);
                    window.location.href = 'assign_counselor.php';
                }
            }, 1000);
        </script>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
