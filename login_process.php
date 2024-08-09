<?php
session_start();  // Start the session

$servername = "localhost";
$username = "root";  // Change if necessary
$password = "";  // Change if necessary
$dbname = "svadharmam_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];  // Store user ID in session
            header("Location: index.php");
            exit;
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that email address.";
    }

    $conn->close();
}
?>
