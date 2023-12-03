<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract and sanitize form data
    $subject = isset($_POST["subject"]) ? htmlspecialchars($_POST["subject"]) : '';
    $name = isset($_POST["name"]) ? htmlspecialchars($_POST["name"]) : '';
    $rollNumber = isset($_POST["roll_number"]) ? htmlspecialchars($_POST["roll_number"]) : '';
    $internals = isset($_POST["marks"]) ? floatval($_POST["marks"]) : 0.0;
    

    // Validate the data
    $errors = array();

    if (empty($subject)) {
        $errors[] = "Subject is required.";
    }

    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    if (empty($rollNumber)) {
        $errors[] = "Roll Number is required.";
    }

    if (!is_numeric($rollNumber)) {
        $errors[] = "Roll Number should be a numeric value.";
    }

    if ($marks < 0 || $marks > 100) {
        $errors[] = "Marks should be between 0 and 100.";
    }

    // If there are validation errors, output them
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
        exit();
    }

    // Perform database operations (replace this with your actual database logic)
    // For demonstration, let's assume you have a MySQL database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "student_tracker";

    
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute SQL query using prepared statement
    $sql = "INSERT INTO marks_table (subject, panel, roll_number, internals, externals) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters and execute
        $stmt->bind_param("ssssd", $subject, $panel, $rollNumber, $internals, $externals);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Marks added successfully";
        } else {
            echo "Error: Unable to add marks";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // If the form is not submitted, redirect to the form page
    header("Location: addmarks.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Marks - College ERP</title>
    <link rel="stylesheet" href="addmarks.css">
</head>
<body>
    <div class="dashboard-container">
       
        <form action="addMarks.php" method="post">
		<h2>Add Marks</h2>
            <label for="subject">Select Subject:</label>
            <select id="subject" name="subject" required>
                <option value="ITCH">ITCH</option>
                <option value="FSD">FSD</option>
                <option value="DEC">DEC</option>
                <option value="AIES">AIES</option>
                <option value="ICS">ICS</option>
                <!-- Add more subjects as needed -->
            </select>

            <label for="name">Roll Number:</label>
            <input type="text" id="name" name="name" required>

	    <label for="roll_number">Roll Number:</label>
            <input type="text" id="roll_number" name="roll_number" required>

            
            <div class="marks-box">
                <label for="marks">Internals:</label>
                <input type="text" id="marks" name="marks" required>
            </div>

            <button type="submit">Add Marks</button>
        </form>
    </div>
</body>
</html>
