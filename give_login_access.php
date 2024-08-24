<?php
session_start();
require 'config.php'; // Include the database connection

// Check if the user is logged in and is an admin
if (!isset($_SESSION['userid']) || $_SESSION['role'] !== 'admin') {
    header("Location: noaccess.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['profile_id'])) {
    $profileId = $_POST['profile_id'];

    // Fetch the profile data based on the profile ID
    $sql = "SELECT * FROM profiles WHERE id = :profile_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':profile_id', $profileId);
    $stmt->execute();
    $profile = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($profile) {
        // Data for the new user entry
        $userid = $profile['userid'];
        $name = $profile['name'];
        $email = $profile['email'];
        $phone_no = $profile['phone_no']; // Fetching the phone number
        $password = password_hash('12345', PASSWORD_DEFAULT); // Default password, hashed
        $role = 'user'; // Default role

        // Insert into users table
        $sqlInsert = "INSERT INTO users (userid, name, email, phone, password, role) VALUES (:userid, :name, :email, :phone, :password, :role)";
        $stmtInsert = $conn->prepare($sqlInsert);

        $stmtInsert->bindParam(':userid', $userid);
        $stmtInsert->bindParam(':name', $name);
        $stmtInsert->bindParam(':email', $email);
        $stmtInsert->bindParam(':phone', $phone_no); // Binding phone number
        $stmtInsert->bindParam(':password', $password);
        $stmtInsert->bindParam(':role', $role);

        if ($stmtInsert->execute()) {
            // Success message and showing inserted data
            echo "<!DOCTYPE html>
                  <html lang='en'>
                  <head>
                      <meta charset='UTF-8'>
                      <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                      <title>Give Login Access</title>
                      <!-- Bootstrap CSS -->
                      <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'>
                  </head>
                  <body>";

            echo "<div class='container mt-5'>
                    <div class='alert alert-success' role='alert'>
                        Profile has been given login access successfully! Redirecting in <span id='countdown'>15</span> seconds.
                    </div>
                    <h3>Inserted User Data:</h3>
                    <p><strong>User ID:</strong> $userid</p>
                    <p><strong>Password:</strong> 12345</p>
                    <p><strong>Name:</strong> $name</p>
                    <p><strong>Email:</strong> $email</p>
                    <p><strong>Phone:</strong> $phone_no</p>
                    <p><strong>Role:</strong> $role</p>
                  </div>";

            // JavaScript for countdown and redirect
            echo "<script>
                    var countdownElement = document.getElementById('countdown');
                    var countdown = 15;
                    var countdownInterval = setInterval(function() {
                        countdown--;
                        countdownElement.textContent = countdown;
                        if (countdown <= 0) {
                            clearInterval(countdownInterval);
                            window.location.href = 'view_profiles.php';
                        }
                    }, 1000);
                  </script>";

            echo "<!-- Bootstrap JS -->
                  <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js'></script>
                  </body>
                  </html>";
        } else {
            echo "<div class='alert alert-danger'>Failed to give login access.</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>Profile not found.</div>";
    }
} else {
    echo "<div class='alert alert-danger'>Invalid request.</div>";
}
?>

