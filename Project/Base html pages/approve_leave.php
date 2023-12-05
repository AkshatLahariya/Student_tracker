<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Your head content here -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve Leave</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom styles -->
    <link rel="stylesheet" href="approveleave.css">
</head>
<body>

    <?php
    // Dynamic admin name (replace with actual admin name)
    $adminName = "Admin Name";

    // Your database connection code goes here
    $servername = "localhost";
    $username = "Akshat";
    $password = "";
    $dbname = "user";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch pending leave approval requests
    $sql = "SELECT * FROM leave_requests WHERE status = 'pending'";
    $result = $conn->query($sql);

    ?>
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
        <p style="font-size:large;">Hello, <span id="admin-name"><?php echo $adminName; ?></span></p>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-3"> <!-- Center the section -->
                <section id="approve-leave" class="dashboard-section">
                    <h2>Pending Leave Approvals</h2>
                    <!-- Display pending leave approval requests -->
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='leave-request'>";
                            echo "<p>Leave Request:</p>";
                            echo "<p>Faculty ID: " . $row["faculty_id"] . "</p>";
                            echo "<p>Faculty Name: " . $row["faculty_name"] . "</p>";
                            echo "<p>Leave From: " . $row["leave_from"] . "</p>";
                            echo "<p>Leave To: " . $row["leave_to"] . "</p>";
                            echo "<p>Leave Type: " . $row["leave_type"] . "</p>";
                            echo "<form action='display_pending_leaves.php' method='post'>";
                            // Remove the input field for leave_id
                            echo "<button type='submit' name='approve'>Approve</button>";
                            echo "<button type='submit' name='decline'>Decline</button>";
                            echo "</form>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>No pending leave approval requests.</p>";
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
