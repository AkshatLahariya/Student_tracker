<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Attendance</title>
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
    </style>
</head>
<body>
    <h2>Student Attendance</h2>

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
        $Name = $_POST['Name'];
        $Roll_number = $_POST['Roll_number'];

        // Query to fetch attendance data for the student
        $sql = "SELECT Date, Attendance FROM Student_table WHERE Name = '$Name' AND Roll_number = '$Roll_number' AND PRN='$PRN'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h3>Attendance for $Name (Roll Number: $Roll_number) PRN: $PRN</h3>";
            echo "<table>";
            echo "<tr><th>Date</th><th>Attendance</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row['Date'] . "</td><td>" . $row['Attendance'] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No attendance records found for $Name (Roll Number: $Roll_number) PRN: $PRN";
        }
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
