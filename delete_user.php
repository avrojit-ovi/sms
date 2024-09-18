<?php
session_start();  // Start the session

require_once 'config.php';  // Include the database configuration file

// Check if the user is logged in and has the appropriate role
if (!isset($_SESSION['userid']) || $_SESSION['role'] !== 'admin') {
    header("Location: noaccess.php");
    exit;
}

// Delete user
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id > 0) {
    try {
        // Delete the user
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: view_users.php");
        exit;
    } catch (PDOException $e) {
        if ($e->getCode() == '23000') {
            // Foreign key constraint violation
            echo "Cannot delete user because there are associated records in the system.";
        } else {
            echo "Error deleting user: " . $e->getMessage();
        }
    }
} else {
    echo "Invalid user ID.";
}
?>
