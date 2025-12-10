document.addEventListener('DOMContentLoaded', function () {

    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm_password');
    const passwordMatchError = document.getElementById('password_match_error');

    function validatePasswords() {
        if (passwordInput.value !== confirmPasswordInput.value) {
            passwordMatchError.style.display = 'inline'; // Show the error message
            confirmPasswordInput.setCustomValidity("Passwords do not match."); // HTML5 validation message
        } else {
            passwordMatchError.style.display = 'none'; // Hide the error message
            confirmPasswordInput.setCustomValidity(""); // Clear custom validity
        }
    }

    // Attach event listeners
    confirmPasswordInput.addEventListener('input', validatePasswords);
    passwordInput.addEventListener('input', validatePasswords);
});