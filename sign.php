<?php
include 'includes/connection.php';
$success = 0;
$user = 0;
$invalid = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  include 'includes/connection.php';
  $username = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $conpassword = $_POST['conpassword'];

  $query = "select * from `login` where name='$username'";

  $result = mysqli_query($conn, $query);
  if ($result) {
    $num = mysqli_num_rows($result);
    if ($num > 0) {
      // echo "User already exist";
      $user = 1;
    } else {
      if ($password === $conpassword) {
        $query = "INSERT INTO `login`(`name`, `email`, `password`) VALUES ('$username','$email','$password')";;

        $result = mysqli_query($conn, $query);


        if ($result) {
          //echo "Signup Successful";
          $success = 1;
          header('location:login.php');
        }
      } else {
        $invalid = 1;
      }
    }
  }
}


?>




<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sign Up Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
  <?php
  if ($user) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Ohh no Sorry  </strong> User already exist 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
  }

  ?>

  <?php
  if ($invalid) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Ohh no Sorry  </strong> Invalid credentials 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
  }
  ?>

  <?php
  if ($success) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success </strong>You are successfully signed up. 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
  }
  ?>

  <h1 class="text-center mt-5">Sign-Up Page</h1>
  <div class="container mt-5 w-50">
    <form action="sign.php" method="post">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label" required>Name</label>
        <input type="text" class="form-control" placeholder="Enter your name" name="name" required>

      </div>

      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label" required>Email</label>
        <input type="email" class="form-control" placeholder="Enter your email" name="email" required>

      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label" required>Password</label>
        <input type="password" class="form-control" placeholder="Enter your password" name="password" required>
      </div>

      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label" required>Confirm Password</label>
        <input type="password" class="form-control" placeholder="Confirm password" name="conpassword" required>
      </div>

      <button type="submit" class="btn btn-primary w-100">Sign up</button>
      <p class="text-center">have an account <a href="login.php">login here</a> </p>
    </form>
  </div>
</body>

</html>