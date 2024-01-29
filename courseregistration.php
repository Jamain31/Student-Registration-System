<?php
session_start();
require_once('config.php');

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You have to log in first";
    header('location: login.php');
}

// Retrieve available semesters from the database
$sqlSemesters = "SELECT * FROM tblsemesters";
$stmtSemesters = $db->query($sqlSemesters);
$semesters = $stmtSemesters->fetchAll(PDO::FETCH_ASSOC);

// Retrieve available fields of study from the database
$sqlFields = "SELECT * FROM tblfields";
$stmtFields = $db->query($sqlFields);
$fields = $stmtFields->fetchAll(PDO::FETCH_ASSOC);

// Retrieve available courses for the selected semester and field of study from the database
$sqlCourses = "SELECT * FROM tblcourses";
$stmtCourses = $db->query($sqlCourses);
$courses = $stmtCourses->fetchAll(PDO::FETCH_ASSOC);

// Include your HTML form for course registration
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
        <h1>Course Registration</h1>
        <form method="post" action="courseregistrationprocess.php">
            <!-- Semester selection -->
            <label for="semester">Select Semester:</label>
            <select id="semester" name="semester">
                <?php foreach ($semesters as $semester): ?>
                    <option value="<?php echo $semester['semesterID']; ?>"><?php echo $semester['semesterName']; ?></option>
                <?php endforeach; ?>
            </select>

            <!-- Field of study selection -->
            <label for="field_of_study">Select Field of Study:</label>
            <select id="field_of_study" name="field_of_study">
                <?php foreach ($fields as $field): ?>
                    <option value="<?php echo $field['fieldID']; ?>"><?php echo $field['fieldName']; ?></option>
                <?php endforeach; ?>
            </select>

            <!-- Course selection -->
            <label>Select up to 5 Courses:</label>
            <?php foreach ($courses as $course): ?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="courses[]" value="<?php echo $course['courseID']; ?>">
                    <label class="form-check-label"><?php echo $course['courseName']; ?></label>
                </div>
            <?php endforeach; ?>

            <!-- Add submit button -->
            <button type="submit" name="register_courses">Register Courses</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
