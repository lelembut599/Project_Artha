function togglePassword() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.setAttribute('src', '../Assets/icon/eye.svg');
    } else {
        passwordInput.type = 'password';
        eyeIcon.setAttribute('src', '../Assets/icon/eye-slash.svg');
    }
}