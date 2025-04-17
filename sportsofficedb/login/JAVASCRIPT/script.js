function validateForm() {
    const email = document.querySelector('input[name=\"email\"]').value.trim();
    const password = document.querySelector('input[name=\"password\"]').value.trim();

    if (!email || !password) {
        //alert(\"Please fill in all fields.\");
        return false;
    }

    return true;
}
