<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Attendance - College ERP</title>
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Container styling */
        .dashboard-container {
            width: 100%;
            height: 100vh;
            background-image: url('attendance.png'); /* Use the correct path */
            background-position: center;
            background-size: cover;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: flex-end;
            padding-right: 10px;
        }

        /* Form styling */
        .dashboard-container h2 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #0d0d0d; /* Set text color */
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold; /* Make the text bold */
            text-transform: uppercase; /* Convert text to uppercase */
            text-align: center; /* Align the text to the right */
            text-decoration: underline;
        }

        .dashboard-container form {
            width: 80%;
            max-width: 400px;
            background: #fff;
            padding: 20px;
            margin-right: 200px;
            margin-bottom: 0px;
            font-family: Georgia, 'Times New Roman', Times, serif;
            font-weight: bold;
            border-radius: 8px;
            border: 4px solid #000000;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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

        /* Adjust radio button and label display */
        .attendance-group label {
            display: inline-flex;
            align-items: center;
            margin-bottom: 5px;
            color: #000000;
            white-space: nowrap; /* Ensure that the text does not wrap to the next line */
        }

        .attendance-group input[type="radio"] {
            margin-right: 5px; /* Add spacing between the radio button and label */
        }

        /* Adjust color when radio button is checked */
        #present:checked + label {
            color: #4caf50;
        }

        #absent:checked + label {
            color: #ff4c4c;
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
            <h2>Add Attendance</h2>

            <label for="Name">Name:</label>
            <input type="text" id="Name" name="Name" required>

            <label for="PRN">PRN:</label>
            <input type="number" id="PRN" name="PRN" required>

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
    <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Extract form data
        $Name = isset($_POST["Name"]) ? $_POST["Name"] : '';
        $Roll_number = isset($_POST["roll_number"]) ? $_POST["roll_number"] : '';
        $PRN = isset($_POST["PRN"]) ? $_POST["PRN"] : '';
        $Date = isset($_POST["date"]) ? $_POST["date"] : '';
        $Attendance = isset($_POST["attendance"]) ? $_POST["attendance"] : '';

        // Validate and sanitize the data
        $Name = htmlspecialchars($Name);
        $Roll_number = intval($Roll_number);
        $PRN = intval($PRN); // Convert to integer
        $Date = htmlspecialchars($Date);
        $Attendance = ($Attendance == 'present') ? 'Present' : 'Absent'; // Sanitize attendance status

        // Perform database operations (replace this with your actual database logic)
        // For demonstration, let's assume you have a MySQL database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "student_tracker";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute SQL query using prepared statement
        $sql = "INSERT INTO Student_table (PRN, Roll_number, Name, Date, Attendance) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Bind parameters and execute
            $stmt->bind_param("iisss", $PRN, $Roll_number, $Name, $Date, $Attendance);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "Attendance added successfully";
            } else {
                echo "Error: Unable to add attendance";
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }

        // Close the database connection
        $conn->close();
    } else {
        exit();
    }
    ?>
</body>
</html>
