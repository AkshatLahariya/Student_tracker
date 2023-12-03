<?php
$servername = "your_mysql_server";
$username = "your_mysql_username";
$password = "your_mysql_password";
$dbname = "your_mysql_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Example data for all subjects (AIES, FSD, DEC, ICS, ITCH)
$subjectsData = array(
    array('name' => 'AIES', 'progressBarId' => 'aiesProgressBar'),
    array('name' => 'FSD', 'progressBarId' => 'fsdProgressBar'),
    array('name' => 'DEC', 'progressBarId' => 'decProgressBar'),
    array('name' => 'ICS', 'progressBarId' => 'icsProgressBar'),
    array('name' => 'ITCH', 'progressBarId' => 'itchProgressBar')
);

$data = array(
    'totalMarks' => 750,
    'obtainedMarks' => 500,
    'overallPercentage' => 66.67,
    'subjects' => array()
);

// Loop through each subject and fetch data
foreach ($subjectsData as $subjectData) {
    $subjectName = $subjectData['name'];
    $progressBarId = $subjectData['progressBarId'];

    // Replace this with your actual database query for each subject
    $internalMarks = 40;  // Replace with actual internal marks
    $externalMarks = 60;  // Replace with actual external marks
    $obtainedMarks = $internalMarks + $externalMarks;
    $totalMarks = 100;
    $percentage = ($obtainedMarks / $totalMarks) * 100;

    // Add subject data to the $data array
    $data['subjects'][] = array(
        'name' => $subjectName,
        'progressBarId' => $progressBarId,
        'internalMarks' => $internalMarks,
        'externalMarks' => $externalMarks,
        'obtainedMarks' => $obtainedMarks,
        'percentage' => $percentage
    );
}

// Set response headers to indicate JSON content
header('Content-Type: application/json');

// Output the data as JSON
echo json_encode($data);

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marks Analysis - College ERP</title>
    <link rel="stylesheet" href="viewmarks.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Marks Analysis</h2>
        
        <h3>Overall Marks</h3>
        <p>Total Marks: <span id="totalMarks">0</span></p>
        <p>Obtained Marks: <span id="obtainedMarks">0</span></p>
        
        <!-- Update the Overall Marks Percentage section -->
        <p>Overall Marks Percentage:
            <span id="overallPercentage">0%</span>
        </p>

        <h3>Subject-wise Marks</h3>
        <table>
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Internal Marks</th>
                    <th>External Marks</th>
                    <th>Obtained Marks</th>
                    <th>Marks Percentage</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['subjects'] as $subject) : ?>
                    <tr>
                        <td><?php echo $subject['name']; ?></td>
                        <td><?php echo $subject['internalMarks']; ?></td>
                        <td><?php echo $subject['externalMarks']; ?></td>
                        <td><?php echo $subject['obtainedMarks']; ?></td>
                        <td><?php echo $subject['percentage'] . '%'; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Update the script section -->
    <script>
        // Function to fetch marks data and populate the HTML
        function fetchMarksData() {
            fetch('addMarks.php')
                .then(response => response.json())
                .then(data => setMarksData(data))
                .catch(error => console.error('Error fetching marks data:', error));
        }

        // Function to set marks data from PHP to JavaScript
        function setMarksData(data) {
            document.getElementById('totalMarks').innerText = data.totalMarks;
            document.getElementById('obtainedMarks').innerText = data.obtainedMarks;
            setOverallMarksValues('overallPercentage', data.overallPercentage);

            const tbody = document.querySelector('tbody');
            tbody.innerHTML = ''; // Clear existing rows

            data.subjects.forEach(function (subject) {
                setSubjectMarksValues(subject.name, subject.internalMarks, subject.externalMarks, subject.obtainedMarks, subject.percentage);
            });
        }

        function setOverallMarksValues(percentageId, percentage) {
            document.getElementById(percentageId).innerText = `${percentage}%`;
        }

        function setSubjectMarksValues(subject, internalMarks, externalMarks, obtainedMarks, percentage) {
            // Dynamically add rows to the table for each subject
            const tbody = document.querySelector('tbody');
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${subject}</td>
                <td>${internalMarks}</td>
                <td>${externalMarks}</td>
                <td>${obtainedMarks}</td>
                <td>${percentage}%</td>
            `;
            tbody.appendChild(row);
        }

        // Call the fetchMarksData function on page load
        fetchMarksData();
    </script>
</body>
</html>
