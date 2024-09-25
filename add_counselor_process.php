<?php
session_start();  // Start the session

require_once 'config.php';  // Include the database configuration file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $userid = $_POST['userid'];
    $role = 'counselor';  // Default role

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Prepare SQL query to insert new user
        $sql = "INSERT INTO users (name, email, phone, password, userid, role) VALUES (:name, :email, :phone, :password, :userid, :role)";
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':userid', $userid);
        $stmt->bindParam(':role', $role);

        // Execute the query
        $stmt->execute();

        // Send email with counselor details
        $to = $email;
        $subject = "🎉 Welcome to Svadhana Recorder - Counselor Registration Details";
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
                        <p>Hare Krishna🙏 Your counselor profile has been successfully created in the Svadhana Recorder system. Here are your login details:</p>
                        <p><strong>Name:</strong> " . htmlspecialchars($name) . "</p>
                        <p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>
                        <p><strong>Phone:</strong> " . htmlspecialchars($phone) . "</p>
                        <p><strong>User ID:</strong> " . htmlspecialchars($userid) . "</p>
                        <p><strong>Password:</strong> " . htmlspecialchars($password) . "</p>
                        <p><strong>Role:</strong> Counselor</p>
                        <p><a href='https://sms.svadharmam.com/login.php'>Click here to login</a></p>
                    </div>
                </div>
                <div class='footer'>
                    <p>For any assistance, please contact our support team.</p>
                     <p><strong>📞 Madhura Gaurakisora Das:</strong> +8801816652807</p>
                        <p><strong>📞 Avrojit Chowdhury Ovi:</strong> +8801333121292</p>
                </div>
            </div>
        </body>
        </html>
        ";

        // Set email headers
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: technical@svadharmam.com' . "\r\n";

        // Send the email
        mail($to, $subject, $message, $headers);

        // Prepare the alert message
        $alert_message = "<div id='alert-container' class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Success!</strong> Counselor added successfully.<br>
            <strong>Name:</strong> $name<br>
            <strong>Email:</strong> $email<br>
            <strong>Phone:</strong> $phone<br>
            <strong>User ID:</strong> $userid<br>
            <strong>Password:</strong> $password<br>
            <strong>Role:</strong> $role<br>
            <div id='countdown'>You will be redirected to the homepage in <span id='seconds'>15</span> seconds.</div>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";

        // Include the HTML for alert display
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Success</title>
            <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'>
        </head>
        <body>
            <div class='container mt-5'>
                $alert_message
            </div>
            <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js'></script>
            <script>
                // Countdown and redirect
                let countdown = 15;
                const countdownElement = document.getElementById('seconds');
                const interval = setInterval(function() {
                    countdown--;
                    countdownElement.textContent = countdown;
                    if (countdown <= 0) {
                        clearInterval(interval);
                        window.location.href = 'index.php'; // Redirect to index.php
                    }
                }, 1000);
            </script>
        </body>
        </html>";
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
