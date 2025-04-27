<!DOCTYPE html>

<?php
session_start();
$errorMessage = '';
if (isset($_SESSION['login_error'])) {
    $errorMessage = $_SESSION['login_error'];
    unset($_SESSION['login_error']); // Clear it after reading
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USeP OSAS-Sports Unit Login</title>
    <link rel="stylesheet" href="../public/CSS/loginStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <script src="../public/JAVASCRIPT/loginScript.js" defer></script>
    <link rel="icon" href="../public/image/Usep.png" sizes="any" />
</head>
<body>
<div class="container">
    <!-- Left Panel -->
    <div class="left-panel">
        <div class="content-wrapper">
            <div class="logo-container">
                <img src="../public/image/SportOffice.png" alt="Sports Office Logo" class="logo">
                <img src="../public/image/Usep.png" alt="USeP Logo" class="logo">
            </div>
            <h2><span class="highlight">One Data.</span> <span class="highlight">One USeP.</span></h2>
            <h1>USeP OSAS-Sports Unit</h1>
        </div>
        <footer>
            <p>&copy; 2025. All Rights Reserved.</p>
            <a href="#">Terms of Use</a> | <a href="#">Privacy Policy</a>
        </footer>
    </div>

    <!-- Right Panel / Login -->
    <div class="right-panel">
        <div class="login-box">
            <h1>WELCOME</h1>
            <?php if (!empty($errorMessage)): ?>
                <p style="color: red; font-weight: bold;"><?php echo htmlspecialchars($errorMessage); ?></p>
            <?php else: ?>
                <p>Please log in to get started.</p>
            <?php endif; ?>
            <form method="POST" action="../controller/auth.php" onsubmit="return validateForm(event)">
                <label>
                    <input type="email" name="email" placeholder="Enter Email" required>
                </label>
                <div class="password-container">
                    <input type="password" id="password" name="password" placeholder="Enter Password" required>
                    <i class="bx bx-show toggle-password" onclick="togglePasswordVisibility()"></i>
                </div>
                <button type="submit">LOGIN</button>
            </form>
            <p class="signup-link">Don't have an account? <a href="../view/signupView.php">Sign Up</a></p>
            <p class="forgot-link"><a href="forgotPassView.php">Forgot Password ?</a></p>
        </div>
    </div>
</div>
</body>
</html>