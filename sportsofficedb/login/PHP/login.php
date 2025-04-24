<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USeP OSAS-Sports Unit Login</title>
    <link rel="stylesheet" href="../CSS/styles.css">

    <link rel="icon" href="../../image/Usep.png" sizes="any" />
</head>
<body>
<div class="container">
    <div class="left-panel">
        <div class="logo-container">
            <img src="../../image/SportOffice.png" alt="Sports Office Logo" class="logo">
            <img src="../../image/Usep.png" alt="USeP Logo" class="logo">
        </div>
        <h2><span class="highlight">One Data.</span> <span class="highlight">One USeP.</span></h2>
        <h1>USeP OSAS-Sports Unit</h1>
        <footer>
            <p>&copy; 2025. All Rights Reserved.</p>
            <a href="#">Terms of Use</a> | <a href="#">Privacy Policy</a>
        </footer>
    </div>
    <div class="right-panel">
        <div class="login-box">
            <h1>WELCOME</h1>
            <p>Please log in to get started.</p>
            <form method="POST" action="auth.php" onsubmit="return validateForm(event)">
                <label>
                    <input type="email" name="email" placeholder="Enter Email" required>
                </label>
                <div class="password-container">
                    <input type="password" id="password" name="password" placeholder="Enter Password" required>
                    <span class="toggle-password" onclick="togglePasswordVisibility()">Show</span>
                </div>
                <button type="submit">LOGIN</button>
                <p style="margin-top: 10px;"><a href="#" style="color: skyblue; font-size: 0.9rem;">Forgot Password?</a></p>
            </form>
            <p class="signup-link">Don't have an account? <a href="signup.php">Sign Up</a></p>
        </div>
    </div>
</div>

<!-- Modal Box -->
<div id="errorModal" class="modal">
    <div class="modal-content">
        <h3>Login Error</h3>
        <p id="modalMessage"></p>
        <button onclick="closeModal()">Close</button>
    </div>
</div>
</body>
</html>
