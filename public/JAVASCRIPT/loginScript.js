// Toggle password visibility
function togglePasswordVisibility() {
    const passwordInput = document.getElementById('password');
    const toggleText = document.querySelector('.toggle-password');

    if (passwordInput && toggleText) {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleText.textContent = 'Hide';
        } else {
            passwordInput.type = 'password';
            toggleText.textContent = 'Show';
        }
    }
}

// Form validation
function validateForm(event) {
    event.preventDefault(); // Prevent form submission first

    const emailInput = document.querySelector('input[name="email"]');
    const passwordInput = document.querySelector('input[name="password"]');
    let isValid = true;

    if (!emailInput || !passwordInput) {
        console.error('Form inputs not found!');
        return false;
    }

    // Email validation
    if (!emailInput.value.trim()) {
        alert('Please enter your email');
        emailInput.focus();
        isValid = false;
    } else if (!/^\S+@\S+\.\S+$/.test(emailInput.value)) {
        alert('Please enter a valid email address');
        emailInput.focus();
        isValid = false;
    }

    // Password validation
    if (!passwordInput.value.trim()) {
        alert('Please enter your password');
        passwordInput.focus();
        isValid = false;
    }

    if (isValid) {
        event.target.submit();
    }

    return isValid;
}

// Error modal handling
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('loginErrorModal');
    const closeBtn = document.getElementById('closeLoginError');
    const loginForm = document.querySelector('form');

    if (modal && closeBtn) {
        closeBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        if (typeof showLoginErrorModal !== 'undefined' && showLoginErrorModal) {
            modal.style.display = 'flex';
        }
    }

    if (loginForm) {
        loginForm.addEventListener('submit', validateForm);
    }
});
