<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - USeP OSAS-Sports Unit</title>
    <link rel="stylesheet" href="../CSS/Styles.css">
    <link rel="stylesheet" href="../CSS/signup.css">
    <script src="../JAVASCRIPT/script.js" defer></script>
</head>
<body>
<div class="container">
    <div class="left-panel">
        <div class="logo-container">
            <img src="../../image/SportOffice.png" alt="Sports Office Logo" class="logo">
            <img src="../../image/Usep.png" alt="USeP Logo" class="logo">
        </div>
        <h2><span class="highlight">Join</span> <span class="highlight">USeP Sports</span></h2>
        <h1>USeP OSAS-Sports Unit</h1>
        <footer>
            <p>&copy; 2025. All Rights Reserved.</p>
            <a href="#">Terms of Use</a> | <a href="#">Privacy Policy</a>
        </footer>
    </div>

    <div class="right-panel">
        <div class="login-box">
            <h1>CREATE ACCOUNT</h1>
            <form method="POST" action="signup_process.php" onsubmit="return validateSignupForm(event)">
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
            <p class="signup-link">Already have an account? <a href="login.php">Log In</a></p>
        </div>
    </div>
</div>
</body>
</html>
