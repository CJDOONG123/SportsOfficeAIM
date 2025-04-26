
<!-- File: /view/signupView.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - USeP OSAS-Sports Unit</title>
    <link rel="stylesheet" href="../public/CSS/signup.css">
    <link rel="icon" href="../public/image/Usep.png" sizes="any">
</head>
<body>
<div class="container">
    <div class="top-bar">
        <div class="logo-container">
            <img src="../public/image/SportOffice.png" alt="Sports Office Logo" class="logo">
            <img src="../public/image/Usep.png" alt="USeP Logo" class="logo">
        </div>
        <h2><span class="highlight">Join</span> <span class="highlight">USeP Sports</span></h2>
        <h1>USeP OSAS-Sports Unit</h1>
    </div>

    <div class="center-panel">
        <div class="login-box">
            <h1>CREATE ACCOUNT</h1>
            <form method="POST" action="../controller/UserController.php" onsubmit="return validateSignupForm(event)">
                <input type="text" name="student_id" placeholder="Student ID" required>
                <input type="text" name="full_name" placeholder="Full Name" required>
                <input type="text" name="address" placeholder="Address" required>
                <input type="email" name="email" placeholder="Email" required>
                <div class="password-container">
                    <input type="password" id="signup-password" name="password" placeholder="Password" required>
                    <span class="toggle-password" onclick="toggleSignupPasswordVisibility()">Show</span>
                </div>
                <select name="status" required>
                    <option value="" disabled selected>Select Status</option>
                    <option value="undergraduate">Undergraduate</option>
                    <option value="alumni">Alumni</option>
                </select>
                <button type="submit">SIGN UP</button>
            </form>
            <p class="signup-link">Already have an account? <a href="loginView.php">Log In</a></p>
        </div>
    </div>

    <footer>
        <p>&copy; 2025. All Rights Reserved.</p>
        <a href="#">Terms of Use</a> | <a href="#">Privacy Policy</a>
    </footer>
</div>
<script src="../public/js/script.js"></script>
</body>
</html>