<?php
session_start();
   require_once ("config.php");
 ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration</title>
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
          <a class="nav-link" href="registration.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<div>
  <?php
     if(isset($_POST['create'])){
       $firstname = $_POST['firstname'];
       $lastname = $_POST['lastname'];
       $address = $_POST['address'];
       $phone = $_POST['phone'];
       $email = $_POST['email'];
       $password = $_POST['password'];

       $sql = "INSERT INTO tblstudents (studentFirstName, studentLastName, studentAddress, studentEmail, studentPhoneNumber, studentPassword) VALUES(?,?,?,?,?,?)";
       $stmtinsert = $db->prepare($sql);
       $result = $stmtinsert->execute([$firstname, $lastname, $address, $email, $phone, $password]);
       if($result){
         echo 'Successfully saved.';
         header("Location: login.php");
       }else{
         echo 'There were errors while saving the data.';
       }

     }
     $_SESSION['username'] = 'firstname';
 	 ?>
<div>
  <form action="registration.php" method="post">
    <div class="bg-container">
    <div class="container">

    <div class="row">
      <div class="col-sm-3">
        <h1>Registration</h1>
        <p>Fill up the form with correct values.</p>
      <hr class="mb-3">
        <label for"firstname"><b>First Name</b></label>
        <input class="form-control" type="text" name="firstname" required>

        <label for"lastname"><b>Last Name</b></label>
        <input class="form-control type="text" name="lastname" required>

        <label for"address"><b>Address</b></label>
        <input class="form-control" type="text" name="address" required>

        <label for"phone"><b>Phone Number</b></label>
        <input class="form-control" type="text" name="phone" required>

        <label for"email"><b>Email</b></label>
        <input class="form-control" type="email" name="email" required>

        <label for"password"><b>Password</b></label>
        <input class="form-control" type="password" name="password" required>

        <hr class="mb-3">
        <input class="btn btn-primary" type="submit" name="create" value="Sign Up">
      </div>
    </div>
  </div>
  </div>

  </form>

</div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
