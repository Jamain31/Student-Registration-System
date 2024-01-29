<?php
session_start();

require_once('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login_user'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT adminID, adminUsername, adminEmail, adminRole FROM admins WHERE adminUsername = ? AND adminPassword = ?";
    $stmtselect = $db->prepare($sql);
    $stmtselect->execute([$username, $password]);
    $result = $stmtselect->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Set user information in the session
        $_SESSION['adminID'] = $result['adminID'];
        $_SESSION['username'] = $result['adminUsername'];
        $_SESSION['email'] = $result['adminEmail'];
        $_SESSION['role'] = $result['adminRole'];

        // Redirect based on the user's role
        if ($result['adminRole'] === 'administrative assistant') {
            header("Location: adminassistantprofile.php");
            exit();
        } elseif ($result['adminRole'] === 'registrar') {
            header("Location: registrarprofile.php");
            exit();
        } else {
            // Redirect to the home page or another page for other roles
            header("Location: index.php");
            exit();
        }
    } else {
        echo "Invalid username or password";
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tuska University Website</title>
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

<div class="bg-container">
  <div class="container text-center">
      <h1>Welcome to the Login Page</h1>
  </div>
  <div class="container">
      <form class="padding-top" method="post" action="stafflogin.php">
          <div class="form-row">
              <div class="form-group col-md-12" id="no-padding-left">
                  <label for="inputEmail">Username</label>
                  <input type="username" class="form-control" id="inputUsername" placeholder="Username" autocomplete="off" name="username" required>
              </div>
          </div>
          <div class="form-row">
              <div class="form-group col-md-12" id="no-padding-left">
                  <label for="inputPassword">Password</label>
                  <input type="password" class="form-control" id="inputPassword" placeholder="Password" autocomplete="off" name="password" required>
              </div>
          </div>
          <button type="submit" class="btn btn-primary" name="login_user">Submit</button>

      </form>
  </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
