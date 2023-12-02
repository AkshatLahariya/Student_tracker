<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Fetch credentials from the form
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Your database connection code goes here
    // For example:
    $servername = "your_server_name";
    $username = "your_username";
    $password = "your_password";
    $dbname = "your_database_name";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to check if the user exists and the status is 1
    $sql = "SELECT * FROM Users WHERE Email = '$email' AND Password = '$password' AND Status = 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User exists, determine the type based on the first letter of the email
        $firstLetter = strtoupper(substr($email, 0, 1));

        // Update the Status to 1
        $updateStatusSql = "UPDATE Users SET Status = 1 WHERE Email = '$email'";
        $conn->query($updateStatusSql);

        // Redirect based on the type
        if ($firstLetter === "F") {
            header("Location: teacherdashboard.html");
            exit();
        } elseif ($firstLetter === "A") {
            header("Location: admindashboard.html");
            exit();
        } elseif ($firstLetter === "S") {
            header("Location: studentdashboard.html");
            exit();
        }
    }

    // If the user doesn't exist or the credentials are incorrect, show an error
    echo "Invalid credentials";

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - College ERP</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/02aff935aa.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h2 id="title">Sign In</h2>
            <form action="#" id="signinForm">
                <div class="input-group">
                    <div class="input-field">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" id="emailField" placeholder="Email" required>
                        <p id="emailInfo"></p>
                    </div>     
                    <div class="input-field">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="passwordField" placeholder="Password" required>
                        <p id="passwordInfo"></p>
                    </div>
                </div>
                <div class="btn-field">
                    <a href="signup.html">New to the platform? Register</a>
                    <button type="button" id="signinBtn">Sign In</button>
                </div>
            </form>
        </div>
    </div>
    <script src="signin.js"></script>
    <script>
        document.getElementById('signinBtn').addEventListener('click', function () {
            var email = document.getElementById('emailField').value;
            var password = document.getElementById('passwordField').value;

            if (!email || !password) {
                alert('Please fill in all required fields.');
                return;
            }.
        });
    </script>
</body>
</html>
