<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User Requests</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom styles -->
    <link rel="stylesheet" href="approveleave.css"> <!-- Create a new CSS file for styling if needed -->
</head>
<body>

    <header>
        <h1>Admin Dashboard</h1>
        <nav class="navbar navbar-expand-md navbar-dark bg-transparent">
            <a class="navbar-brand" href="admin_dashboard.php">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="login.html">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Admin login image and greeting -->
    <div class="admin-info">
        <img src="dashboard_login.png" alt="Admin Login Image">
        <p style="font-size:large;">Hello, <span id="admin-name">[Admin Name]</span></p>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-3"> <!-- Center the section -->
                <section id="view-user-requests" class="dashboard-section">
                    <h2>View User Requests</h2>
                    <!-- Display user requests -->
                    <?php
                    // Your database connection code goes here
                    $servername = "localhost";
                    $username = "root";
                    $dbpassword = "";
                    $dbname = "student_tracker";

                    $conn = new mysqli($servername, $username, $dbpassword, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch user requests from the Users table
                    $sql = "SELECT * FROM users WHERE Status = 0";
                    $result = $conn->query($sql);

                    // Check if there are user requests
                    if ($result === false) {
                        // Display SQL error if the query fails
                        echo "Error: " . $conn->error;
                    } elseif ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='user-request'>";
                            echo "<p>User Request:</p>";
                            echo "<p>Name: " . $row["Name"] . "</p>";
                            echo "<p>Email: " . $row["Email"] . "</p>";
                            // Add more fields as needed
                            echo "<form action='process_request.php' method='post'>";
                            echo "<input type='hidden' name='user_id' value='" . $row["Name"] . "'>";
                            echo "<button type='submit' name='approve'>Approve</button>";
                            echo "<button type='submit' name='deny'>Deny</button>";
                            echo "</form>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>No pending user requests.</p>";
                    }

                    // Close the connection
                    $conn->close();
                    ?>
                </section>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2023 Admin Dashboard</p>
    </footer>

    <!-- Bootstrap JavaScript (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
