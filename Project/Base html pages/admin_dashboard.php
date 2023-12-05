<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom styles -->
    <link rel="stylesheet" href="stu_dashboard.css">
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background color */
        }

        header {
            color: #ffffff; /* White header text color */
            text-align: center;
        }

        .student-info {
            text-align: center;
            margin: top 0;
        }

        .dashboard-section {
            background-color: #ffffff; /* White section background color */
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            height: 100%; /* Ensure all sections have the same height */
        }

        .dashboard-section h2 {
            color: #343a40; /* Dark gray section title color */
        }

        .bottom-buttons {
            text-align: center;
            margin-top: 15px;
        }

        .btn-primary {
            background-color: #007bff; /* Blue primary button color */
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        footer {
            background-color: #343a40; /* Dark gray footer background color */
            color: #ffffff; /* White footer text color */
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>

    <?php
    // Dynamic admin name (replace with actual admin name)
    $adminName = "Admin Name";
    ?>

    <header>
        <h1>Admin Dashboard</h1>
    </header>

    <!-- Student login image and greeting -->
    <div class="student-info">
        <img src="dashboard_login.png" alt="Student Login Image">
        <p style="font-size:large;">Hello, <span id="student-name"><?php echo $adminName; ?></span></p>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <section id="add-users" class="dashboard-section">
                    <h2>Add Users</h2>
                    <div class="image-container">
                        <img src="addusers.png" alt="Add Users" class="center-image">
                    </div>
                    <p>Manage users and permissions...</p>
                    <!-- Bottom buttons -->
                    <div class="bottom-buttons">
                        <a href="view_requests.php" class="btn btn-primary">Go to Add Users</a>
                    </div>
                </section>
            </div>
            <div class="col-md-4">
                <section id="update-info" class="dashboard-section">
                    <h2>Update Student Info</h2>
                    <div class="image-container">
                        <img src="fees.png" alt="Update Info" class="center-image">
                    </div>
                    <p>Update your personal information...</p>
                    <!-- Bottom buttons -->
                    <div class="bottom-buttons">
                        <button class="btn btn-primary">Go to Update Info</button>
                    </div>
                </section>
            </div>
            <div class="col-md-4">
                <section id="approve-leave" class="dashboard-section">
                    <h2>Approve Leaves</h2>
                    <div class="image-container">
                        <img src="result.png" alt="Approve Leave" class="center-image">
                    </div>
                    <p>Review and approve leave requests...</p>
                    <!-- Bottom buttons -->
                    <div class="bottom-buttons">
                        <a href="approve_leave.php" class="btn btn-primary">Go to Approve Leave</a>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2023 Student Dashboard</p>
    </footer>

    <!-- Bootstrap JavaScript (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
