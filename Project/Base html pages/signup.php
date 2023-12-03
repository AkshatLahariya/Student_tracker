<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Fetch values from the form
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Your database connection code goes here
    // For example:
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "student_tracker";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to insert user data into Users table
    $sql = "INSERT INTO Users (Name, Email, Password, Status) VALUES ('$name', '$email', '$password', 0)";

    if ($conn->query($sql) === TRUE) {
        echo "User registered successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - College ERP</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/02aff935aa.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h2 id="title">Sign Up</h2>
            <form action="#" id="signupForm">
                <div class="input-group">
                    <div class="input-field" id="nameField">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" placeholder="Name">
                    </div>
                    <div class="input-field">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" id="emailField" placeholder="Email">
                        <p id="emailInfo"></p>
                    </div>     
                    <div class="input-field">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="passwordField" placeholder="Password">
                        <p id="passwordInfo"></p>
                    </div>
                </div>
                <div class="btn-field">
                    <a href="signin.php">Already registered? <br>Sign In</a>
                    <button type="button" id="signupBtn">Sign Up</button>
                </div>
            </form>
            <p id="confirmationMessage" style="display: none;">Your request has been sent to the admin for confirmation.</p>
        </div>
    </div>
    <script src="signup.js"></script>
</body>
</html>
