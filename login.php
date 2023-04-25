<?php
// session_start();

$login = 0;
$invalid = 0;



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  include 'includes/connection.php';
  $username = $_POST['name'];
  // $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "Select * from `login` where 
  name='$username' and password='$password'";

  $result = mysqli_query($conn, $sql);
  if ($result) {
    $num = mysqli_num_rows($result);
    if ($num > 0) {
      // echo "Login Successfull";
      $login = 1;

      session_start();
      $_SESSION['user_name'] = $username;
      header('location:index.php');
    } else {
      // echo "Invalid data";
      $invalid = 1;
    }
  }
}


?>




<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
  <?php
  if ($login) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success </strong>You are successfully logged in. 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
  }
  ?>

  <?php
  if ($invalid) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error </strong>Invalid credentials. 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
  }
  ?>


  <h1 class="text-center mt-5">Login to our website</h1>
  <div class="container mt-5 w-50">
    <form action="login.php" method="post">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label" required>Name</label>
        <input type="text" class="form-control" placeholder="Enter your username" name="name" required>

      </div>
      <!-- <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label" required>Email</label>
        <input type="email" class="form-control" placeholder="Enter your username" name="email" required>

      </div> -->
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label" required>Password</label>
        <input type="password" class="form-control" placeholder="Enter your password" name="password" required>
      </div>

      <button type="login" class="btn btn-primary w-100">Login</button><br>
      <p>not register yet? <a href="sign.php">Registerd here</a> </p>

    </form>
  </div>
</body>

</html>