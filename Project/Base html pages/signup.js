document.addEventListener("DOMContentLoaded", function () {
    let signupForm = document.getElementById("signupForm");
    let nameField = document.getElementById("nameField");
    let emailField = document.getElementById("emailField");
    let passwordField = document.getElementById("passwordField");
    let emailInfo = document.getElementById("emailInfo");
    let passwordInfo = document.getElementById("passwordInfo");
    let confirmationMessage = document.getElementById("confirmationMessage");
    let title = document.getElementById("title");

    document.getElementById("signupBtn").addEventListener("click", function () {
        console.log("Sign Up Button Clicked");

        // Logging form data
        console.log("Name:", nameField.value);
        console.log("Email:", emailField.value);
        console.log("Password:", passwordField.value);

        const isEmailValid = validateEmail();
        const isPasswordValid = validatePassword();

        if (isEmailValid && isPasswordValid) {
            // If validation passes, submit the form
            console.log("Form is valid. Submitting...");
            signupForm.submit();
        } else {
            // If validation fails, do not submit the form
            console.log("Form is not valid. Validation failed.");
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
