<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sports Office | System</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="header-container">
        <div class="logo-container">
            <img src="img/sportsoffice 1.png" id="sp_logo" alt="">
            <img src="img/USePLogo.3993af51 1.png" id="usep_logo" alt="">
        </div>

        <div class="one-data-container">
            <div class="one-data">
                <h1 id="one">One <p> Data .</p></h1>
                <h1 id="one">One <p> USeP .</p> </h1>
            </div>
        <div class="osas-unit">
            <p>USeP OSAS-Sports Unit</p>
            </div>
        </div>
        <div class="profile-container">

        </div>
    </div>

    <hr id="header-hr">
{{-----------------------------------------------------------------------}}

<div class="login-container">
    <form method="POST" class="login-form" action="">
        @csrf
        <h2 class="login-title">Hello there!</h2>
        <p class="login-subtitle">Please login to get started.</p>

        <label for="campus"></label>
        <select name="campus" id="campus" required>
            <option value="" disabled selected hidden>Campus</option>
            <option value="Tagum">Tagum</option>
            <option value="Mabini">Mabini</option>
        </select>


        <label for="id_number"></label>
        <input type="text" name="id_number" id="id_number" placeholder="ID number" required />

        <label for="password"></label>
        <input type="password" name="password" id="password" placeholder="Enter your password" required/>

        <div class="options">
            <div class="checkbox-container">
                <input type="checkbox" id="showPassword" onclick="togglePassword()" />
                <label for="showPassword" id="show-password"> Show Password</label>
            </div>
            <a href="#">Forgot Password?</a>
        </div>
        <div class="btn-container">
        <button type="submit" class="login-btn">LOGIN</button>
        </div>
    </form>
</div>

<script>
    // Toggle Password Visibility
    function togglePassword() {
        let pass = document.getElementById('password');
        pass.type = (pass.type === 'password') ? 'text' : 'password';
    }


    // Light/Dark Mode Toggle
function toggleMode() {
    document.body.classList.toggle('light-mode');

    // Store user preference in localStorage
    let mode = document.body.classList.contains('light-mode') ? 'light' : 'dark';
    localStorage.setItem('theme', mode);
}

// Apply saved theme on page load
window.onload = function () {
    if (localStorage.getItem('theme') === 'light') {
        document.body.classList.add('light-mode');
    }
};

</script>


</body>
</html>
