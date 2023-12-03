<?php
// Replace these database connection details with your actual credentials
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

// Retrieve pending leave approval requests
$sql = "SELECT * FROM leave_requests WHERE status = 'pending'";
$result = $conn->query($sql);

// Display pending leave approval requests
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p><strong>Faculty Name:</strong> " . $row["faculty_name"] . "<br><strong>Faculty ID:</strong> " . $row["faculty_id"] . "</p>";
    }
} else {
    echo "No pending leave approval requests.";
}

$conn->close();
?>
