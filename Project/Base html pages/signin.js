document.addEventListener("DOMContentLoaded", function () {
    let signinBtn = document.getElementById("signinBtn");
    let emailField = document.getElementById("emailField");
    let passwordField = document.getElementById("passwordField");

    signinBtn.addEventListener("click", function () {
        if (emailField.value && passwordField.value) {
            // Perform sign-in action or redirection
            console.log("Sign In Button working");

            // Add the following lines to submit the form
            let signinForm = document.getElementById("signinForm");
            signinForm.submit();
        } else {
            // Switch to sign-up (if needed)
            console.log("Sign In Button not working");
        }
    });
});