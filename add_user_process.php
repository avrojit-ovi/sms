<?php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $userid = $_POST['userid'];
    $role = $_POST['role'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check if the userid already exists
    $sql = "SELECT COUNT(*) FROM users WHERE userid = :userid";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':userid', $userid);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        echo "Error: UserID already exists. Please choose a different UserID.";
    } else {
        // Insert the new user into the database
        $sql = "INSERT INTO users (name, email, phone, userid, role, password) VALUES (:name, :email, :phone, :userid, :role, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':userid', $userid);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':password', $password);

        if ($stmt->execute()) {
            // Display success message and user details
            echo "<!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>User Added Successfully</title>
                <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'>
                <script>
                    function updateCountdown() {
                        var countdownElement = document.getElementById('countdown');
                        var timeLeft = 10; // seconds
                        var timer = setInterval(function() {
                            if (timeLeft <= 0) {
                                clearInterval(timer);
                                window.location.href = 'view_users.php';
                            } else {
                                countdownElement.textContent = timeLeft;
                                timeLeft -= 1;
                            }
                        }, 1000);
                    }
                    window.onload = updateCountdown;
                </script>
            </head>
            <body>
                <div class='container mt-5'>
                    <h1 class='text-center'>User Added Successfully</h1>
                    <div class='alert alert-success'>
                        <strong>User Details:</strong>
                        <p><strong>Name:</strong> " . htmlspecialchars($name) . "</p>
                        <p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>
                        <p><strong>Phone:</strong> " . htmlspecialchars($phone) . "</p>
                        <p><strong>UserID:</strong> " . htmlspecialchars($userid) . "</p>
                        <p><strong>Role:</strong> " . htmlspecialchars($role) . "</p>
                    </div>
                    <p class='text-center'>You will be redirected to the user list in <span id='countdown'>10</span> seconds.</p>
                </div>
                <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js'></script>
            </body>
            </html>";
        } else {
            echo "Error adding user.";
        }
    }
}
?>
