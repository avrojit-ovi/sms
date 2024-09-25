<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Svadhana Recorder System</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

    <div class="container" id="container">
        <!-- Removed Sign-Up Form Container -->

        <div class="form-container sign-in-container">
            <form action="login_process.php" method="POST">
                <h1>Svadhana</h1>
                <h4>Recorder System</h4>
                <span>or use your account</span>
                <input type="text" name="login_identifier" placeholder="Email or UserID" required />
                <input type="password" name="password" placeholder="Password" required />
                <br>
                <button type="submit">Log In</button>
                <a href="#" id="forgotPasswordLink" onclick="handleForgotPassword()">Forgot Password?</a>
            </form>
        </div>

        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Haribol!</h1>
                    <p>To keep connected with Svadhana Recorder, please log in with your personal info</p>
                    <button class="ghost" id="signIn">Log In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hare Krishna!</h1>
                    <p>Enter your personal details and start your journey with Svadhana Recorder System</p>
                    <button class="ghost" id="signUp" onclick="showAlert()">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showAlert() {
            alert("Please contact your Counselor or Admin to register your profile into the Svadhana Management System.");
        }

        // Handle Forgot Password Functionality
        function handleForgotPassword() {
            var userID = prompt("Please enter your UserID to reset your password:");
            if (userID) {
                // Create a form and submit it with the UserID
                var form = document.createElement("form");
                form.action = "forgot_password.php";
                form.method = "POST";

                var input = document.createElement("input");
                input.type = "hidden";
                input.name = "userid";
                input.value = userID;
                form.appendChild(input);

                document.body.appendChild(form);
                form.submit();
            } else {
                alert("UserID is required to reset the password.");
            }
        }
    </script>

    <script src="assets/script.js"></script>
</body>
</html>
