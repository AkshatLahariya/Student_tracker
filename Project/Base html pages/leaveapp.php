<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Application - College ERP</title>
    <link rel="stylesheet" href="leaveapp.css">
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Fetch values from the form
    $facultyId = $_POST["faculty_id"];
    $facultyName = $_POST["faculty_name"];
    $leaveFrom = $_POST["leave_from"];
    $leaveTo = $_POST["leave_to"];
    $leaveType = $_POST["leave_type"];

    // Your database connection code goes here
    // For example:
    $servername = "localhost";
    $username = "Akshat";
    $password = "";
    $dbname = "user";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to insert leave data into the database using prepared statements
    $sql = "INSERT INTO leave_requests (faculty_id, faculty_name, leave_from, leave_to, leave_type, status) VALUES (?, ?, ?, ?, ?, 'pending')";

    // Prepare and bind the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $facultyId, $facultyName, $leaveFrom, $leaveTo, $leaveType);

    // Execute the statement
    if ($stmt->execute()) {
        // Close the statement and connection
        $stmt->close();
        $conn->close();

        // Redirect to the same page after successful submission to avoid form resubmission
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error: " . $stmt->error; // Output the specific error related to the statement
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<div class="dashboard-container">
    <form action="" method="post">
        <h2>Leave Application</h2>

        <!-- Faculty ID and Name -->
        <label for="faculty_id">Faculty ID:</label>
        <input type="text" id="faculty_id" name="faculty_id" required>

        <label for="faculty_name">Faculty Name:</label>
        <input type="text" id="faculty_name" name="faculty_name" required>

        <!-- Leave From and Leave To -->
        <label for="leave_from">Leave From:</label>
        <input type="date" id="leave_from" name="leave_from" required>

        <label for="leave_to">Leave To:</label>
        <input type="date" id="leave_to" name="leave_to" required>

        <!-- Leave Type (Sick, Vacation, etc.) -->
        <label>Leave Type:</label>
        <div class="leave-type-group">
            <input type="radio" id="sick_leave" name="leave_type" value="sick" required>
            <label for="sick_leave">Sick Leave</label>

            <input type="radio" id="vacation" name="leave_type" value="vacation" required>
            <label for="vacation">Vacation</label>

            <!-- Add more leave types as needed -->
        </div>

        <br> <!-- Add a line break for a one-line gap -->

        <button type="submit">Submit Leave Application</button>
    </form>
</div>

</body>
</html>
