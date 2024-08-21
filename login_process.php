<?php
session_start();  // Start the session

require_once 'config.php';  // Include the database configuration file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login_identifier = $_POST['login_identifier'];
    $password = $_POST['password'];

    // Prepare SQL query to fetch user by email or userid
    $sql = "SELECT * FROM users WHERE (email = :login_identifier OR userid = :login_identifier)";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':login_identifier', $login_identifier);

    // Execute the query
    $stmt->execute();
    
    // Fetch the user record
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // If password is correct, store user info in session
        $_SESSION['userid'] = $user['userid'];  // Store user ID in session
        $_SESSION['role'] = $user['role'];  // Store the user role
        header("Location: index.php");  // Redirect to index.php
        exit;
    } else {
        // Invalid login
        echo "Invalid email/username or password.";
    }
}
?>
