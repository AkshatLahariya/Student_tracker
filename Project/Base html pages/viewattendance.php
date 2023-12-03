<?php
$servername = "your_mysql_server";
$username = "your_mysql_username";
$password = "your_mysql_password";
$dbname = "your_mysql_database";


$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Replace this with your actual database query logic
$subjectsData = array(
    array('name' => 'AIES', 'progressBarId' => 'aiesProgressBar'),
    array('name' => 'FSD', 'progressBarId' => 'fsdProgressBar'),
    array('name' => 'DEC', 'progressBarId' => 'decProgressBar'),
    array('name' => 'ICS', 'progressBarId' => 'icsProgressBar'),
    array('name' => 'ITCH', 'progressBarId' => 'itchProgressBar')
);

$data = array(
    'totalPresent' => 75,
    'totalAbsent' => 25,
    'overallPercentage' => 75,
    'subjects' => array()
);

// Loop through each subject and fetch data
foreach ($subjectsData as $subjectData) {
    $subjectName = $subjectData['name'];
    $progressBarId = $subjectData['progressBarId'];

    // Replace this with your actual database query for each subject
    $present = 15;  // Replace with actual present count
    $absent = 5;    // Replace with actual absent count
    $total = $present + $absent;
    $percentage = ($present / $total) * 100;

    // Add subject data to the $data array
    $data['subjects'][] = array(
        'name' => $subjectName,
        'progressBarId' => $progressBarId,
        'present' => $present,
        'absent' => $absent,
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
    <title>Attendance Analysis - College ERP</title>
    <link rel="stylesheet" href="viewattendance.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Attendance Analysis</h2>
        
        <h3>Overall Attendance</h3>
        <p>Total Present: <span id="totalPresent">0</span></p>
        <p>Total Absent: <span id="totalAbsent">0</span></p>
        
        <!-- Update the Overall Attendance Percentage section -->
        <p>Overall Attendance Percentage:
            <div class="circular-chart">
                <div class="circle" id="overallProgressBar"></div>
                <div class="percent" id="overallPercentage">0%</div>
            </div>
        </p>

        <h3>Subject-wise Attendance</h3>
        <table>
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Total Present</th>
                    <th>Total Absent</th>
                    <th>Attendance Percentage</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>FSD</td>
                    <td id="fsdPresent">0</td>
                    <td id="fsdAbsent">0</td>
                    <td>
                        <span id="fsdPercentage">0%</span>
                        <div class="progress-bar-container">
                            <div id="fsdProgressBar" class="progress-bar"></div>
                        </div>
                    </td>
                </tr>
                <!-- Add rows for other subjects as needed -->
            </tbody>
        </table>
    </div>
    
   <!-- Update the script section -->
   <script>
       function fetchAttendanceData() {
           fetch('addattendance.php')
               .then(response => response.json())
               .then(data => {
                   updateAttendanceUI(data);
               })
               .catch(error => console.error('Error fetching attendance data:', error));
       }

       function updateAttendanceUI(data) {
           document.getElementById('totalPresent').innerText = data.totalPresent;
           document.getElementById('totalAbsent').innerText = data.totalAbsent;

           setOverallAttendanceValues('overallPercentage', 'overallProgressBar', data.overallPercentage);

           data.subjects.forEach(subject => {
               setSubjectAttendanceValues(subject.name, subject.progressBarId, subject.present, subject.absent, subject.percentage);
           });
       }

       function setOverallAttendanceValues(percentageId, progressBarId, percentage) {
           document.getElementById(percentageId).innerText = `${percentage}%`;
           const progressBar = document.getElementById(progressBarId);
           progressBar.style.width = `${percentage}%`;
       }

       function setSubjectAttendanceValues(subject, progressBarId, present, absent, percentage) {
           document.getElementById(`${subject}Present`).innerText = present;
           document.getElementById(`${subject}Absent`).innerText = absent;
           document.getElementById(`${subject}Percentage`).innerText = `${percentage.toFixed(2)}%`;

           const progressBar = document.getElementById(progressBarId);
           progressBar.style.width = `${percentage}%`;
       }

       // Call the function to fetch data
       fetchAttendanceData();
   </script>
</body>
</html>


