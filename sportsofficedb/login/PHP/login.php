<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USeP OSAS-Sports Unit Login</title>
    <link rel="stylesheet" href="../CSS/Styles.css">
</head>
<body>
<div class="container">
    <div class="left-panel">
        <div class="logo-container">
            <img src="../../image/SportOffice.png" alt="Sports Office Logo" class="logo">
            <img src="../../image/Usep.png" alt="USeP Logo" class="logo">
        </div>
        <h2><span class="highlight">One Data.</span>  <span class="highlight">One USeP.</span></h2>
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
            <form action="auth.php" method="POST" onsubmit="return validateForm()">
                <label>
                    <input type="email" name="email" placeholder="Enter Email" required>
                </label>
                <div class="password-container">
                    <label for="password"></label><input type="password" id="password" name="password" placeholder="Enter Password" required>
                    <span class="toggle-password" onclick="togglePasswordVisibility()">Show</span>
                </div>
                <button type="submit">LOGIN</button>
            </form>
        </div>
    </div>
</div>
<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const toggleText = passwordInput.nextElementSibling;
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleText.textContent = 'Hide';
        } else {
            passwordInput.type = 'password';
            toggleText.textContent = 'Show';
        }
    }
</script>
</body>
</html>
