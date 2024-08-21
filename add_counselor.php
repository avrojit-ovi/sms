<?php
session_start();  // Start the session

if (!isset($_SESSION['userid'])) {
    // If the user is not logged in, redirect to login page
    header("Location: login.php");
    exit;
}

// If the user is logged in, display the form
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Svadharmam - Sadhana Recorder Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>
    <div class="container mt-5">
        <h2>Add Counselor</h2>
        <form action="add_counselor_process.php" method="POST">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="userid" class="form-label">User ID</label>
                    <input type="text" class="form-control" id="userid" name="userid" value="<?php echo 'ssms' . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT); ?>" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="role" class="form-label">Role</label>
                    <input type="text" class="form-control" id="role" name="role" value="counselor" readonly>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Add Counselor</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
