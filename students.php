<?php
session_start();
require_once('config.php');


// Fetch all student information
$sql = "SELECT * FROM tblstudents";
$stmt = $db->query($sql);
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Students Information</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
                    </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>

<div class="container">
    <h1>All Students Information</h1>

   <ul>
       <?php foreach ($students as $student) : ?>
           <li>
               <strong>Student ID:</strong> <?php echo $student['studentID']; ?><br>
               <strong>Name:</strong> <?php echo $student['studentFirstName'] . ' ' . $student['studentLastName']; ?><br>
               <strong>Email:</strong> <?php echo $student['studentEmail']; ?><br>
               <strong>Phone Number:</strong> <?php echo $student['studentPhoneNumber']; ?><br>
               <strong>Degree Program:</strong> <?php echo $student['fieldName']; ?><br>
               <strong>Address:</strong> <?php echo $student['studentAddress']; ?><br>
               <!-- Add more information as needed -->
           </li>
           <hr>
       <?php endforeach; ?>
   </ul>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
