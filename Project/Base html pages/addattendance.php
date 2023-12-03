<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract form data
    $panel = $_POST["panel"];
    $rollNumber = $_POST["roll_number"];
    $date = $_POST["date"];
    $attendanceStatus = $_POST["attendance"];

    // Validate and sanitize the data (you may need more robust validation)
    $panel = htmlspecialchars($panel);
    $rollNumber = intval($rollNumber); // Convert to integer
    $date = htmlspecialchars($date);
    $attendanceStatus = ($attendanceStatus == 'present') ? 'Present' : 'Absent'; // Sanitize attendance status

    // Perform database operations (replace this with your actual database logic)
    // For demonstration, let's assume you have a MySQL database
    $servername = "your_server_name";
    $username = "your_username";
    $password = "your_password";
    $dbname = "your_database_name";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute SQL query
    $sql = "INSERT INTO attendance_table (panel, roll_number, date, status) VALUES ('$panel', $rollNumber, '$date', '$attendanceStatus')";

    if ($conn->query($sql) === TRUE) {
        echo "Attendance added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // If the form is not submitted, redirect to the form page
    header("Location: addattendance.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Attendance - College ERP</title>
    <link rel="stylesheet" href="addattendance.css">
    <style>
        /* Add some spacing between input fields */
        label,
        input,
        select,
        button {
            display: block;
            margin-bottom: 10px;
        }

        /* Display radio buttons and labels on the same line */
        .attendance-group label {
            display: inline-flex;
            align-items: center;
        }

        /* Add line breaks after each radio button group */
        .attendance-group {
            margin-bottom: 10px;
        }

        /* Display radio buttons and labels on separate lines */
        input[type="radio"],
        label {
            display: inline-block;
            margin-right: 10px; /* Adjust the margin as needed */
        }

        /* Add line breaks after each radio button group */
        .attendance-group {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <div class="dashboard-container">
        <form action="addattendance.php" method="post">
            <h2>Add Attendance</h2>

            <!-- Use dropdowns for Panel (A-H) and Roll Number (1-70) -->
            <label for="panel">Panel:</label>
            <select id="panel" name="panel" required>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
                <option value="F">F</option>
                <option value="G">G</option>
                <option value="H">H</option>
            </select>

            <label for="roll_number">Roll Number:</label>
            <input type="number" id="roll_number" name="roll_number" required>

            <!-- Add a calendar for selecting the date -->
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>

            <!-- Use radio buttons for Attendance on the same line -->
            <label for="attendance">Attendance:</label>
            <input type="radio" id="present" name="attendance" value="present" required>
            <label for="present">Present</label>

            <input type="radio" id="absent" name="attendance" value="absent" required>
            <label for="absent">Absent</label>

            <br> <!-- Add a line break for a one-line gap -->

            <button type="submit">Add Attendance</button>
        </form>
    </div>
</body>
</html>
