<?php
session_start();
require_once('config.php');

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You have to log in first";
    header('location: login.php');
}

// Retrieve student information from the database
$sqlStudent = "SELECT * FROM tblstudents WHERE studentFirstName = ?";
$stmtStudent = $db->prepare($sqlStudent);
$stmtStudent->execute([$_SESSION['username']]);
$student = $stmtStudent->fetch(PDO::FETCH_ASSOC);

// Retrieve registered courses for the student from the database
$sqlRegisteredCourses = "SELECT c.courseID, c.courseName FROM tblstudentcourses sc
                         JOIN tblcourses c ON sc.courseID = c.courseID
                         WHERE sc.studentID = ?";
$stmtRegisteredCourses = $db->prepare($sqlRegisteredCourses);
$stmtRegisteredCourses->execute([$student['studentID']]);
$registeredCourses = $stmtRegisteredCourses->fetchAll(PDO::FETCH_ASSOC);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['drop_course'])) {
    $courseIDToDrop = isset($_POST['course_to_drop']) ? $_POST['course_to_drop'] : null;

    if ($courseIDToDrop) {
        // Delete the course registration from tblstudentcourses
        $sqlDeleteCourse = "DELETE FROM tblstudentcourses WHERE studentID = ? AND courseID = ?";
        $stmtDeleteCourse = $db->prepare($sqlDeleteCourse);
        $stmtDeleteCourse->execute([$student['studentID'], $courseIDToDrop]);

        // Redirect to the profile page
        header("Location: profile.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tuska University Website - Course Drop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Add your own stylesheets if needed -->
</head>
<body background='images/crossword.png'>



<nav class="navbar navbar-expand-lg bg-body-tertiary">
<div class="container-fluid">
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<a class="navbar-brand" href="#">Tuska University</a>
<div class="collapse navbar-collapse" id="navbarTogglerDemo03">
<ul class="navbar-nav me-auto mb-2 mb-lg-0">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="profile.php">Profile</a>
  </li>


</ul>
<form class="d-flex" role="search">
  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
  <button class="btn btn-outline-success" type="submit">Search</button>
</form>
</div>
</div>
</nav>


<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <!-- Display Student Information Section -->
            <div class="card">
                <img src="<?php echo !empty($student['profilePicture']) ? $student['profilePicture'] : 'upload.png'; ?>" style="width: 10%" alt="Profile Image">
                <h1><?php echo $student['studentFirstName'] . " " . $student['studentLastName']; ?></h1>
                <p class="title">Your Information</p>
                <p>Email: <?php echo $student['studentEmail']; ?></p>
                <p>Password: <?php echo $student['studentPassword']; ?></p>
                <p>Address: <?php echo $student['studentAddress']; ?></p>
                <p>Phone number: <?php echo $student['studentPhoneNumber']; ?></p>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12 text-center">
            <!-- Course Drop Section -->
            <div class="card">
                <h2>Drop a Course</h2>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <label for="course_to_drop">Select Course to Drop:</label>
                        <select id="course_to_drop" name="course_to_drop" class="form-select" required>
                            <?php foreach ($registeredCourses as $course): ?>
                                <option value="<?php echo $course['courseID']; ?>"><?php echo $course['courseName']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-danger" name="drop_course">Drop Course</button>
                </form>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12 text-center">
            <!-- Buttons Section -->
            <p>
                <a href="logout.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Log Out</a>
                <a href="courseregistration.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Register Course</a>
                <a href="viewcourses.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">View Registered Courses</a>
            </p>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>