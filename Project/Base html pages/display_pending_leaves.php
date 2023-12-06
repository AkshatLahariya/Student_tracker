<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Fetch faculty_id from the form
    $faculty_id = $_POST["faculty_id"];

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
        $sql = "UPDATE leave_requests SET Status = 1 WHERE faculty_id = ?";

        // Prepare and bind the statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $faculty_id);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Leave request approved successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the statement
        $stmt->close();
    }

    // Check if the 'deny' button is clicked
    if (isset($_POST["deny"])) {
        // SQL query to update the Status to 0 for the denied user
        $sql = "UPDATE leave_requests SET Status = 0 WHERE faculty_id = ";

        // Prepare and bind the statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $faculty_id);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Leave request denied successfully";
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
