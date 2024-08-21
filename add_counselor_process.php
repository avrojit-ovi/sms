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
