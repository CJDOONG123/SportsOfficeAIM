// Toggle password visibility
function togglePasswordVisibility() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.querySelector('.toggle-password');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('bx-show');
        toggleIcon.classList.add('bx-hide');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('bx-hide');
        toggleIcon.classList.add('bx-show');
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

