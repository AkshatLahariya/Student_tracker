<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Student Attendance</title>
    <style>
        /* CSS for basic table formatting */
        body {
            font-family: Arial, sans-serif; /* Change the font if needed */
            background-color: #f4f4f4; /* Set a background color */
            margin: 0;
            padding: 0;
        }
        table {
            border-collapse: collapse;
            width: 50%;
            margin-top: 20px;
            margin-left: auto;
            margin-right: auto;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 10px; /* Increased padding for better spacing */
        }
        th {
            background-color: #3c00a0;
            color: #fff;
        }
        form {
            margin-top: 20px;
            text-align: center;
        }
        input {
            padding: 5px;
            margin-right: 10px;
        }
        button {
            padding: 8px;
            background-color: #3c00a0;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>View Student Attendance</h2>

    <form action="" method="post">
        <label for="PRN">Enter PRN:</label>
        <input type="text" id="PRN" name="PRN" required>
        <button type="submit">View Attendance</button>
    </form>

    <?php
    // Establish database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "student_tracker"; // Replace with your actual database name

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate and sanitize form data
        $PRN = mysqli_real_escape_string($conn, $_POST['PRN']);

        // Query to fetch attendance data for the student
        $sql = "SELECT Name, Roll_number, Date, Attendance FROM student_table WHERE PRN='$PRN'";
        $result = $conn->query($sql);

        if ($result) {
            if ($result->num_rows > 0) {
                echo "<h3>Attendance for PRN: $PRN</h3>";
                echo "<table>";
                echo "<tr><th>Name</th><th>Roll Number</th><th>Date</th><th>Attendance</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row['Name'] . "</td><td>" . $row['Roll_number'] . "</td><td>" . $row['Date'] . "</td><td>" . $row['Attendance'] . "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "No attendance records found for PRN: $PRN";
            }
        } else {
            echo "Error: " . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
