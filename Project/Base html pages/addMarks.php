
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Marks - College ERP</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Container styling */
        .dashboard-container {
            width: 100%;
            height: 100vh;
            background-image: url('grades.png'); /* Use the correct path */
            background-position: left;
            background-size: 30%;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: flex-end;
            padding-right: 10px; 
        }

        /* Form styling for Add Marks */
        .dashboard-container form {
            position: relative;
            width: 80%;
            max-width: 400px;
            background: #fff;
            padding: 40px;
            margin-right: 200px;
            margin-bottom: 0px;
            font-family: Georgia, 'Times New Roman', Times, serif;
            font-weight: bold;
            border-radius: 8px;
            border: 4px solid #000000;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .dashboard-container form h2 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #0d0d0d; /* Set text color */
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold; /* Make the text bold */
            text-transform: uppercase; /* Convert text to uppercase */
            text-align: center; /* Align the text to the center */
            text-decoration: underline; 
            position: absolute; /* Position absolute to place it inside the form */
            top: 0px; /* Adjust top position */
            left: 50%; /* Center horizontally */
            transform: translateX(-50%); /* Center horizontally */
        }

        /* Input field styling */
        label,
        select,
        input,
        button {
            display: block;
            margin-bottom: 15px;
            width: 100%;
        }

        /* Button styling */
        button {
            background-color: #3c00a0;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2a0070;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <form action="" method="post">
            <h2>Add Marks</h2>
			
	    <label for="Name">Name</label>
            <input type="text" id="Name" name="Name" required>
			
	    <label for="PRN">PRN</label>
            <input type="text" id="PRN" name="PRN" required>

            <!-- Subject ITCH -->
            <label for="Marks_ITCH">Marks ITCH</label>
            <div class="marks-box">
                <input type="number" id="Marks_ITCH" name="Marks_ITCH" required>
            </div>
			
            <!-- Subject AIES -->
            <label for="Marks_AIES">Marks AIES</label>
            <div class="marks-box">
                <input type="number" id="Marks_AIES" name="Marks_AIES" required>
            </div>

            <!-- Subject DEC -->
            <label for="Marks_DEC">Marks DEC</label>
            <div class="marks-box">
                <input type="number" id="Marks_DEC" name="Marks_DEC" required>
            </div>

            <!-- Subject FSD -->
            <label for="Marks_FSD">Marks FSD</label>
            <div class="marks-box">
                <input type="number" id="Marks_FSD" name="Marks_FSD" required>
            </div>
			
            <!-- Subject ICS -->
            <label for="Marks_ICS">Marks ICS</label>
            <div class="marks-box">
                <input type="number" id="Marks_ICS" name="Marks_ICS" required>
            </div>

            <label for="Roll_number">Roll Number:</label>
            <input type="text" id="Roll_number" name="Roll_number" required>

            <button type="submit">Add Marks</button>
        </form>
    </div>
	<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract and sanitize form data
    $Name = isset($_POST["Name"]) ? htmlspecialchars($_POST["Name"]) : '';
    $Roll_number = isset($_POST["Roll_number"]) ? htmlspecialchars($_POST["Roll_number"]) : '';
    $PRN = isset($_POST["PRN"]) ? htmlspecialchars($_POST["PRN"]) : '';
    $Marks_AIES = isset($_POST["Marks_AIES"]) ? floatval($_POST["Marks_AIES"]) : 0.0;
    $Marks_FSD = isset($_POST["Marks_FSD"]) ? floatval($_POST["Marks_FSD"]) : 0.0;
    $Marks_ITCH = isset($_POST["Marks_ITCH"]) ? floatval($_POST["Marks_ITCH"]) : 0.0;
    $Marks_DEC = isset($_POST["Marks_DEC"]) ? floatval($_POST["Marks_DEC"]) : 0.0;
    $Marks_ICS = isset($_POST["Marks_ICS"]) ? floatval($_POST["Marks_ICS"]) : 0.0;

    // Validate the data
    $errors = array();

    if (empty($Name)) {
        $errors[] = "Name is required.";
    }

    if (empty($Roll_number)) {
        $errors[] = "Roll Number is required.";
    }

    if (!is_numeric($Roll_number)) {
        $errors[] = "Roll Number should be a numeric value.";
    }

    // Validate marks for each subject (between 0 and 100)
    $maxMarks = 100;
    if ($Marks_AIES < 0 || $Marks_AIES > $maxMarks || $Marks_FSD < 0 || $Marks_FSD > $maxMarks ||
        $Marks_ITCH < 0 || $Marks_ITCH > $maxMarks || $Marks_DEC < 0 || $Marks_DEC > $maxMarks ||
        $Marks_ICS < 0 || $Marks_ICS > $maxMarks) {
        $errors[] = "Marks should be between 0 and 100 for each subject.";
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
    $sql = "INSERT INTO marks_table (PRN, Roll_number, Name, Marks_AIES, Marks_FSD, Marks_DEC, Marks_ICS, Marks_ITCH) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters and execute
        $stmt->bind_param("ssssdddd", $PRN, $Roll_number, $Name, $Marks_AIES, $Marks_FSD, $Marks_DEC, $Marks_ICS, $Marks_ITCH);
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
    // If the form is not submitted, you can redirect to the same page
    // or do nothing if you want to keep the form and processing in the same file.
    // header("Location: addmarks.html");
    // exit();
}
?>
</body>
</html>

