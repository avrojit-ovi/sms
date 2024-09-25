<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['userid'])) {
    $userid = $_POST['userid'];

    // Search for the user with the given UserID
    $stmt = $conn->prepare("SELECT name, email FROM users WHERE userid = :userid");
    $stmt->bindParam(':userid', $userid);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        // Fetch the user's details
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $name = $user['name'];
        $email = $user['email'];

        // Generate an 8-digit random password
        $newPassword = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);

        // Hash the new password before storing it
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the new password in the database
        $updateStmt = $conn->prepare("UPDATE users SET password = :password WHERE userid = :userid");
        $updateStmt->bindParam(':password', $hashedPassword);
        $updateStmt->bindParam(':userid', $userid);
        $updateStmt->execute();

        // Prepare the email message using the provided template
        $subject = "Svadhana Recorder - Password Reset";
        $message = "
        <html>
        <head>
            <title>Password Reset</title>
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
                        <p>Hare Krishna🙏 Your password has been successfully reset in the Svadhana Recorder system. Here are your updated login details:</p>
                        <p><strong>Name:</strong> " . htmlspecialchars($name) . "</p>
                        <p><strong>User ID:</strong> " . htmlspecialchars($userid) . "</p>
                        <p><strong>New Password:</strong> " . htmlspecialchars($newPassword) . "</p>
                        <p>Please log in with your new password and change it after the first login for security reasons.</p>
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

        // Set content-type for sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // Additional headers
        $headers .= 'From: technical@svadharmam.com' . "\r\n";

        // Send email
        if (mail($email, $subject, $message, $headers)) {
           echo "A new password has been sent to your email.";
            // Redirect to login.php after 5 seconds
            header("refresh:5;url=login.php");
            exit(); // Ensure no further code is executed after redirect
        } else {
            echo "Failed to send the email. Please try again.";
        }

    } else {
        echo "UserID not found.";
    }
} else {
    echo "Invalid request.";
}
?>
