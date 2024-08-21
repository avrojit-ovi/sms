<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>No Access - Svadharmam Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        // Initialize countdown time
        let countdownTime = 10; // seconds

        // Function to update the countdown display
        function updateCountdown() {
            const countdownElement = document.getElementById('countdown');
            countdownElement.textContent = countdownTime;
            countdownTime--;

            // Redirect after countdown reaches 0
            if (countdownTime < 0) {
                window.location.href = 'index.php';
            }
        }

        // Update countdown every second
        setInterval(updateCountdown, 1000);
    </script>
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">Access Denied!</h4>
            <p>You don't have permission to access this page. Please contact the admin. Hare Krishna!</p>
            <hr>
            <p class="mb-0">You will be redirected to the homepage in <span id="countdown">10</span> seconds.</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
