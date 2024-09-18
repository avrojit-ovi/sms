<?php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $userid = $_POST['userid'];
    $role = $_POST['role'];
    $plain_password = $_POST['password']; // Storing the plain password before hashing
    $password = password_hash($plain_password, PASSWORD_BCRYPT);

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
            // Send email
            $to = $email; // recipient email
            $subject = "Welcome to Svadhana Recorder System";
            $message = "
            <html>
        <head>
            <title>Welcome Counselor</title>
            <style>
                .container {
                    width: 100%;
                    max-width: 600px;
                    margin: 0 auto;
                    font-family: Arial, sans-serif;
                    padding: 20px;
                }
                .card {
                    border: 1px solid #ddd;
                    border-radius: 8px;
                    padding: 15px;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                }
                .card-header {
                    background-color: #4CAF50;
                    color: white;
                    text-align: center;
                    font-size: 1.5rem;
                    border-radius: 8px 8px 0 0;
                    padding: 10px;
                }
                .card-body {
                    padding: 10px;
                    text-align: left;
                    font-size: 1rem;
                }
                .card-body p {
                    margin: 10px 0;
                }
                .footer {
                    text-align: center;
                    font-size: 0.9rem;
                    color: #555;
                    margin-top: 20px;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='card'>
                    <div class='card-header'>
                        🎉 Congratulations, " . htmlspecialchars($name) . "!
                    </div>
                    <div class='card-body'>
                        <p>Hare Krishna🙏 Your User profile has been successfully created in the Svadhana Recorder system. Here are your login details:</p>
                        <p><strong>Name:</strong> " . htmlspecialchars($name) . "</p>
                        <p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>
                        <p><strong>Phone:</strong> " . htmlspecialchars($phone) . "</p>
                        <p><strong>User ID:</strong> " . htmlspecialchars($userid) . "</p>
                        <p><strong>Password:</strong> " . htmlspecialchars($plain_password) . "</p>
                        <p><strong>Role:</strong> " . htmlspecialchars($role) . "</p>
                        <p><a href='https://sms.svadharmam.com/login.php'>Click here to login</a></p>
                    </div>
                </div>
                <div class='footer'>
                    <p>If you need assistance, feel free to reach out:</p>
                     <p><strong>📞 Madhura Gaurakisora Das:</strong> +8801816652807</p>
                        <p><strong>📞 Avrojit Chowdhury Ovi:</strong> +8801333121292</p>

               <center><h3>Hare Krishna...!!!</h3></center>
                </div>
            </div>
        </body>
        </html>
            ";
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // Additional headers
            $headers .= 'From: technical@svadharmam.com' . "\r\n";
            $headers .= 'Cc: ' . "\r\n";

            if (mail($to, $subject, $message, $headers)) {
                // Display success message and redirect
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
                            <p><strong>Password:</strong> " . htmlspecialchars($plain_password) . "</p>
                            <p class='text-center'>A confirmation email has been sent to " . htmlspecialchars($email) . " with the password.</p>
                        </div>
                        <p class='text-center'>You will be redirected to the user list in <span id='countdown'>10</span> seconds.</p>
                    </div>
                    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js'></script>
                </body>
                </html>";
            } else {
                echo "Error sending email.";
            }
        } else {
            echo "Error adding user.";
        }
    }
}
?>
