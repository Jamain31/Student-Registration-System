
<?php
session_start();
require_once('config.php');

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You have to log in first";
    header('location: login.php');
}

// Retrieve student information from the database
// Move this line after checking if the user is logged in
$sql = "SELECT * FROM tblstudents WHERE studentFirstName = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$_SESSION['username']]); // Use $_SESSION['username'] instead of $username
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if ($student) {
    echo "<p>Welcome, {$student['studentFirstName']} {$student['studentLastName']}!</p>";
    echo "<p>Email: {$student['studentEmail']}</p>";
    echo "<p>Phone Number: {$student['studentPhoneNumber']}</p>";
    echo "<p>Degree Program: {$student['studentDegreeProgram']}</p>";
    echo "<p>Address: {$student['studentAddress']}</p>";
} else {
    echo "Error retrieving student information.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Student Profile</title>
</head>
<body>
	<h1>Student Profile</h1>

	<!-- Profile picture upload form -->
	<form action="upload_profile_picture.php" method="post" enctype="multipart/form-data">
			<label for="profilePicture">Upload Profile Picture:</label>
			<input type="file" name="profilePicture" id="profilePicture" accept="image/*">
			<button type="submit" name="uploadPicture">Upload</button>
	</form>

	<!-- Course registration and drop buttons -->
	<a href="registration.php"><button>Course Registration</button></a>
	<a href="drop_course.php"><button>Course Drop</button></a>

	<!-- Logout button -->
	<form action="logout.php" method="post">
			<button type="submit" name="logout">Logout</button>
	</form>
</body>
</html>
