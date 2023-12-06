<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Fetch user_id from the form
    $user_id = $_POST["user_id"];

    // Your database connection code goes here
    $servername = "localhost";
    $username = "root";
    $dbpassword = "";
    $dbname = "student_tracker";

    $conn = new mysqli($servername, $username, $dbpassword, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the 'approve' button is clicked
    if (isset($_POST["approve"])) {
        // SQL query to update the Status to 1 for the approved user
        $sql = "UPDATE users SET Status = 1 WHERE Name = ?";

        // Prepare and bind the statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $user_id);

        // Execute the statement
        if ($stmt->execute()) {
            echo "User request approved successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the statement
        $stmt->close();
    }

    // Check if the 'deny' button is clicked
    if (isset($_POST["deny"])) {
        // SQL query to update the Status to 2 for the denied user
        $sql = "UPDATE signup SET Status = 0 WHERE Name = ?";

        // Prepare and bind the statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $user_id);

        // Execute the statement
        if ($stmt->execute()) {
            echo "User request denied successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the statement
        $stmt->close();
    }

    // Close the connection
    $conn->close();
}
?>
