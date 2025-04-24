function togglePasswordVisibility() {
    const passwordInput = document.getElementById('password');
    const toggleText = document.querySelector('.toggle-password');
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

    const email = event.target.email.value;
    const password = event.target.password.value;

    if (!email || !password) {
        showModal("Please fill in both fields.");
        return false;
    }

    if (email !== "admin@usep.edu" || password !== "123456") {
        showModal("Invalid email or password. Please try again.");
        return false;
    }

    event.target.submit();
}

function showModal(message) {
    const modal = document.getElementById("errorModal");
    const modalMessage = document.getElementById("modalMessage");
    modalMessage.textContent = message;
    modal.style.display = "flex";
}

function closeModal() {
    document.getElementById("errorModal").style.display = "none";
}