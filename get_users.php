<?php
require_once 'config.php';

header('Content-Type: application/json');

// Check if counselor_id is set
if (isset($_GET['counselor_id'])) {
    $counselorId = $_GET['counselor_id'];

    // Fetch users that are not assigned to the selected counselor
    $sql = "SELECT id, name FROM users WHERE role = 'user' AND id NOT IN (SELECT user_id FROM assigned_counselor WHERE counselor_id = :counselor_id)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':counselor_id', $counselorId);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($users);
} else {
    echo json_encode([]);
}
?>
