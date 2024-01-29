<?php
session_start();

// Check if the necessary session variables are set
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You have to log in first";
    header('location: login.php');
}

// Retrieve additional information from the database if needed
// ...

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Registration Success</title>
    <!-- Add your styles or link to external stylesheets here -->
</head>
<body>
    <div class="container">
        <h1>Course Registration Successful</h1>
        <p>Thank you for registering for courses. You can view your course details in your profile.</p>
        <a href="profile.php">Go to Profile</a>
    </div>
</body>
</html>
