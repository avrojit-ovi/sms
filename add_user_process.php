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
                <title>Welcome to Svadhana Recorder System</title>
                <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
                <style>
                    .card {
                        margin: 20px;
                        border-radius: 10px;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    }
                    .card-header {
                        background-color: #4CAF50;
                        color: white;
                        font-size: 1.5rem;
                        text-align: center;
                    }
                    .card-body p {
                        margin: 10px 0;
                        font-size: 1rem;
                    }
                    .card-body i {
                        margin-right: 5px;
                    }
                    .contact-info {
                        text-align: center;
                        margin-top: 20px;
                        font-size: 0.9rem;
                        color: #555;
                    }
                    .contact-info p {
                        margin: 5px 0;
                    }
                    .profile-img {
                        width: 100%;
                        max-width: 150px;
                        border-radius: 50%;
                        display: block;
                        margin: 0 auto;
                    }
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='card'>
                        <div class='card-header'>
                            🎉 Welcome, " . htmlspecialchars($name) . "!
                        </div>
                        <div class='card-body'>
                            <img src='https://iskcontrichy.com/wp-content/uploads/2022/02/iskcon_logo.jpg' alt='Profile Image' class='profile-img'>
                            <h3 class='text-center mt-3'>🎊 Your Profile is Registered Successfully! 🎊</h3>
                            <p><i class='fas fa-user'></i> <strong>Name:</strong> " . htmlspecialchars($name) . "</p>
                            <p><i class='fas fa-envelope'></i> <strong>Email:</strong> " . htmlspecialchars($email) . "</p>
                            <p><i class='fas fa-phone'></i> <strong>Phone:</strong> " . htmlspecialchars($phone) . "</p>
                            <p><i class='fas fa-id-badge'></i> <strong>UserID:</strong> " . htmlspecialchars($userid) . "</p>
                            <p><i class='fas fa-user-tag'></i> <strong>Role:</strong> " . htmlspecialchars($role) . "</p>
                            <p><i class='fas fa-lock'></i> <strong>Password:</strong> " . htmlspecialchars($plain_password) . "</p>
                            <p><i class='fas fa-link'></i> <strong>Login URL:</strong> <a href='https://sms.svadharmam.com/login.php' target='_blank'>Login to your account</a></p>
                            <p class='text-center'>🔒 Please keep your login details safe and secure.</p>
                        </div>
                    </div>
                    <div class='contact-info'>
                        <h5>If you need assistance, feel free to reach out:</h5>
                        <p><strong>📞 Madhura Gaurakisora Das:</strong> +8801816652807</p>
                        <p><strong>📞 Avrojit Chowdhury Ovi:</strong> +8801333121292</p>
                    </div>
                </div>
                <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
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
