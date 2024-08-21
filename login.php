<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Svadharmam Management System</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="signup_process.php" method="POST">
                <h3>Svadharmam Management System</h3><br>
                <h1>Create Account</h1>
                <span>or use your email for registration</span>
                <input type="text" name="name" placeholder="Name" required />
                <input type="email" name="email" placeholder="Email" required />
                <input type="password" name="password" placeholder="Password" required />
                <button type="submit">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
        <form action="login_process.php" method="POST">
    <h1>Svadharmam</h1>
    <h4>Management System</h4>
    <span>or use your account</span>
    <input type="text" name="login_identifier" placeholder="Email or UserID" required />
    <input type="password" name="password" placeholder="Password" required />
    <br>
    <button type="submit">Log In</button>
</form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Haribol !</h1>
                    <p>To keep connected with Svadharmam please login with your personal info</p>
                    <button class="ghost" id="signIn">Log In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hare Krishna!</h1>
                    <p>Enter your personal details and start your journey with Svadharmam Management System</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/script.js"></script>
</body>
</html>
