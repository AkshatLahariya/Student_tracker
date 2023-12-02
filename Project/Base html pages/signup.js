document.addEventListener("DOMContentLoaded", function () {
    let signupBtn = document.getElementById("signupBtn");
    let nameField = document.getElementById("nameField");
    let emailField = document.getElementById("emailField");
    let passwordField = document.getElementById("passwordField");
    let emailInfo = document.getElementById("emailInfo");
    let passwordInfo = document.getElementById("passwordInfo");
    let confirmationMessage = document.getElementById("confirmationMessage");
    let title = document.getElementById("title");

    signupBtn.addEventListener("click", function () {
        const isEmailValid = validateEmail();
        const isPasswordValid = validatePassword();

        if (isEmailValid && isPasswordValid) {
            console.log("Confirmation button ");
            confirmationMessage.style.display = "block";
            console.log("Sign Up Button working");
        } else {
            // Switch to sign-in
            console.log("Sign Up Button not working");
            nameField.style.maxHeight = "60px";
            title.innerHTML = "Sign Up";
        }
    });

    function validatePassword() {
        const passwordRegex = /^(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.*[0-9]).{8,}$/;
        const isValidPassword = passwordRegex.test(passwordField.value);

        if (!isValidPassword) {
            passwordInfo.innerHTML = "Password must contain a capital letter, a symbol, and a number.";
        } else {
            passwordInfo.innerHTML = "";
        }

        console.log("Password validation:", isValidPassword);
        return isValidPassword;
    }

    function validateEmail() {
        const emailRegex = /@mitwpu\.edu\.in$/;
        const isValidEmail = emailRegex.test(emailField.value);

        if (!isValidEmail) {
            emailInfo.innerHTML = "Invalid email address. Please use a valid email ending with @mitwpu.edu.in.";
        } else {
            emailInfo.innerHTML = "";
        }

        console.log("Email validation:", isValidEmail);
        return isValidEmail;
    }
});
