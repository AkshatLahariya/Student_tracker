<!-- display_user_requests.php -->
<?php
// Read data from the file (you can replace this with a database query)
$userRequests = file('user_requests.txt', FILE_IGNORE_NEW_LINES);

// Display the user requests
foreach ($userRequests as $request) {
    list($name, $email, $password) = explode('|', $request);
    echo "<p>Name: $name, Email: $email, Password: $password</p>";
}
?>
