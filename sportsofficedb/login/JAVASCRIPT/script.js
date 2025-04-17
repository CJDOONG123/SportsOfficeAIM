<!-- JavaScript -->

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

    function validateForm(event) {
    event.preventDefault();

    const emailInput = document.querySelector('input[name="email"]');
    const passwordInput = document.querySelector('input[name="password"]');
    const email = emailInput.value.trim();
    const password = passwordInput.value;

    // Custom validation first
    let hasError = false;

    if (email !== "admin@usep.edu.ph") {
    emailInput.setCustomValidity("Email not recognized. Please use your USeP admin email.");
    hasError = true;
} else {
    emailInput.setCustomValidity("");
}

    if (password !== "admin123") {
    passwordInput.setCustomValidity("Incorrect password. Please try again.");
    hasError = true;
} else {
    passwordInput.setCustomValidity("");
}

    // Let browser handle required/email format + show any custom errors
    if (!emailInput.checkValidity()) {
    emailInput.reportValidity();
    return false;
}

    if (!passwordInput.checkValidity()) {
    passwordInput.reportValidity();
    return false;
}

    // If all is correct
    if (!hasError) {
    window.location.href = "../../admin/PHP/admin.php";
}

    return false;
}
