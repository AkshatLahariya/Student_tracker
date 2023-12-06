<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Marks</title>
    <style>
        /* CSS for basic table formatting */
        body {
            font-family: Arial, sans-serif; /* Change the font if needed */
            background-color: #f4f4f4; /* Set a background color */
            margin: 0;
            padding: 0;
			text-align: center:
			
        }
		h2{
		text-align: center;
		}
		h3{
		text-align: center;
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
            text-align: center;
            padding: 10px; /* Increased padding for better spacing */
        }
        th {
            background-color: #3c00a0;
            color: #fff;
        }
		
    </style>
</head>
<body>
    <h2>Student Marks</h2>

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
        $PRN = $_POST['PRN'];

        // Query to fetch marks data for the student
        $sql = "SELECT Name, PRN, Roll_number, Marks_AIES, Marks_DEC, Marks_FSD, Marks_ICS, Marks_ITCH FROM marks_table WHERE Name = '$Name' AND Roll_number = '$Roll_number' AND PRN='$PRN'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h3>Marks for $Name (Roll Number: $Roll_number) PRN: $PRN</h3>";
            echo "<table>";
            echo "<tr><th>Name</th><th>PRN</th><th>Roll Number</th><th>Marks AIES</th><th>Marks DEC</th><th>Marks FSD</th><th>Marks ICS</th><th>Marks ITCH</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row['Name'] . "</td><td>" . $row['PRN'] . "</td><td>" . $row['Roll_number'] . "</td><td>" . $row['Marks_AIES'] . "</td><td>" . $row['Marks_DEC'] . "</td><td>" . $row['Marks_FSD'] . "</td><td>" . $row['Marks_ICS'] . "</td><td>" . $row['Marks_ITCH'] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No marks records found for $Name (Roll Number: $Roll_number) PRN: $PRN";
        }
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
