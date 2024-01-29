<?php
require_once("config.php");

// Check if the form is submitted
if (isset($_POST['createstaff'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $sql = "INSERT INTO admins (adminUsername, adminPassword, adminEmail, adminRole) VALUES (?, ?, ?, ?)";
    $stmtinsert = $db->prepare($sql);

    // Check for successful preparation of the SQL query
    if ($stmtinsert) {
        // Execute the SQL query
        $result = $stmtinsert->execute([$username, $password, $email, $role]);

        if ($result) {
            echo 'Successfully saved.';
            // Redirect based on the selected role and username
            if ($role === 'administrative assistant' && $username === 'adminasist') {
                header("Location: stafflogin.php");
                exit();
            } elseif ($role === 'registrar' && $username === 'adminregistrar') {
                header("Location: stafflogin.php");
                exit();
            } else {
                // Redirect to a default page for other roles or invalid usernames
                header("Location: index.php");
                exit();
            }
        } else {
            echo 'There were errors while saving the data.';
        }
    } else {
        echo 'Failed to prepare the SQL query.';
    }
}
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
          <a class="nav-link" href="studentorstaff.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="stafflogin.php">Login</a>
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

   <div>
     <form action="adminregistration.php" method="post">
       <div class="bg-container">
         <div class="container">
           <div class="row">
             <div class="col-sm-3">
               <h1>Staff Registration</h1>
               <p>Fill up the form with correct values.</p>
               <hr class="mb-3">
               <label for="username"><b>Username:(If signing up as Registrar type adminregistrar as username. If signing up as administartor assistant type adminasist.)</b></label>
               <input class="form-control" type="text" name="username" required placeholder="Username provided by HR department.">

               <label for="password"><b>Password</b></label>
               <input class="form-control" type="text" name="password" required>

               <label for="email"><b>Email</b></label>
               <input class="form-control" type="text" name="email" required>

               <label for="role"><b>Role</b></label>
               <select class="form-select" name="role" required>
                 <option value="" disabled selected>Select a role</option>
                 <option value="administrative assistant">Administrative Assistant</option>
                 <option value="registrar">Registrar</option>
                 <option value="other">Other</option>


               </select>




               <hr class="mb-3">
               <input class="btn btn-primary" type="submit" name="createstaff" value="Sign Up">
             </div>
           </div>
         </div>
       </div>
     </form>
   </div>
    </div>
  </div>
  </div>

  </form>

</div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
