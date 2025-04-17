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
    const emailInput = document.querySelector('input[name="email"]');
    const passwordInput = document.querySelector('input[name="password"]');

    if (!emailInput.checkValidity()) {
        emailInput.reportValidity();
        return false;
    }

    if (!passwordInput.checkValidity()) {
        passwordInput.reportValidity();
        return false;
    }

    // Allow the form to submit to PHP
    return true;
}
