<?php
// Include database config file
require 'config.php';
session_start();

if (!isset($_SESSION['userid']) || !isset($_SESSION['email'])) {
    header('Location: signup.php'); // Redirect if session is missing
    exit();
}

// Handle the password setup form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password']) && isset($_POST['confirm_password'])) {
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    if ($password === $confirm_password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Insert user into the 'users' table
        $query = "INSERT INTO users (userid, name, email, phone, password, role) 
                  VALUES (:userid, :name, :email, :phone, :password, 'user')";
        
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':userid', $_SESSION['userid']);
        $stmt->bindParam(':name', $_SESSION['name']);
        $stmt->bindParam(':email', $_SESSION['email']);
        $stmt->bindParam(':phone', $_SESSION['phone']);
        $stmt->bindParam(':password', $hashed_password);
        
        if ($stmt->execute()) {
            // Send email with login details
            $to = $_SESSION['email'];
            $subject = "Welcome to Svadharmam - Your Login Details";
            $name = htmlspecialchars($_SESSION['name']);
            $userid = htmlspecialchars($_SESSION['userid']);
            $email = htmlspecialchars($_SESSION['email']);
            $phone = htmlspecialchars($_SESSION['phone']);
            $plain_password = htmlspecialchars($password);
            $role = 'user'; // Assuming the role is 'user' for this context
            
            // Prepare email message using HTML format
            $message = "
            <html>
            <head>
                <title>Hare Krishna</title>
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
                            🎉 Congratulations, {$name}!
                        </div>
                        <div class='card-body'>
                            <p>Hare Krishna🙏 Your User profile has been successfully created in the Svadhana Recorder system. Here are your login details:</p>
                            <p><strong>Name:</strong> {$name}</p>
                            <p><strong>Email:</strong> {$email}</p>
                            <p><strong>Phone:</strong> {$phone}</p>
                            <p><strong>User ID:</strong> {$userid}</p>
                            <p><strong>Password:</strong> {$plain_password}</p>
                            <p><strong>Role:</strong> {$role}</p>
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
            </html>";

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: technical@svadharmam.com" . "\r\n";

            mail($to, $subject, $message, $headers);

            // Clear session and redirect to login
            session_destroy();
            header('Location: login.php?signup=success');
            exit();
        } else {
            echo "Failed to create user account. Please try again.";
        }
    } else {
        echo "Passwords do not match!";
    }
}
?>

<!-- Second Form (Password Setup) -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
<form method="POST" action="setup_password.php" id="passwordForm">
    <div class="container mt-4">
        <h2>Setup Your Password</h2>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" value="<?php echo htmlspecialchars($_SESSION['name']); ?>" readonly>
            </div>
            <div class="col-md-6">
                <label for="userid" class="form-label">User ID</label>
                <input type="text" class="form-control" id="userid" value="<?php echo htmlspecialchars($_SESSION['userid']); ?>" readonly>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" readonly>
            </div>
            <div class="col-md-6">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" value="<?php echo htmlspecialchars($_SESSION['phone']); ?>" readonly>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="col-md-6">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" id="signupButton">Set Password</button>
    </div>
</form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm_password');
    const signupButton = document.getElementById('signupButton');

    function validatePasswords() {
        if (passwordInput.value !== confirmPasswordInput.value) {
            confirmPasswordInput.classList.add('is-invalid');
            signupButton.disabled = true; // Disable button
        } else {
            confirmPasswordInput.classList.remove('is-invalid');
            signupButton.disabled = false; // Enable button
        }
    }

    // Add event listeners to validate passwords
    passwordInput.addEventListener('input', validatePasswords);
    confirmPasswordInput.addEventListener('input', validatePasswords);
</script>
</body>
</html>
