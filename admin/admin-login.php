<?php



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('../includes/connection.php');

    // $username = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // $_SESSION['status'] = false;


    $query = "Select * from `login` where 
    email='$email' and password='$password'";
    $query_run = mysqli_query($conn, $query);
    $check = mysqli_fetch_array($query_run);

    if ($check) {

        if ($check['email'] == $_POST['email'] && $check['password'] == $_POST['password']) {
            session_start();
            $_SESSION['name'] =  $check['name'];
            $_SESSION['email'] =  $check['email'];
            $_SESSION['id'] =  $check['id'];
            $_SESSION['status'] = true;

            header("Location: admin_dashboard.php");
        }
    } else {
        echo "<script> alert('Email or Password Incorrect')
              window.location.href='user-login.php';
              </script>";
    }
}


?>
<!DOCTYPE html>
<html>

<head>
    <title>E-Library</title>
    <meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
    <script type="text/javascript" src="bootstrap-4.4.1/js/juqery_latest.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
    <script>
        function preventBack() {
            window.history.forward()
        };
        setTimeout("preventBack()", 0);
        window.onload = function() {
            null;
        }
    </script>

</head>
<style type="text/css">
    #main_content {
        padding: 50px;
        background-color: whitesmoke;
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="../index.php">E-Library</a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php"></span>Home</a>
                </li>

            </ul>
        </div>
    </nav><br>
    <span>
        <marquee><strong class="text-primary">This is library mangement system.</strong> </marquee>

    </span><br>
    <div class="container w-50 " id="main_content">
        <center>
            <h2>Admin Login</h2>
        </center>
        <form action="" method="post">

            <div class="mb-1">
                <label for="exampleInputEmail1" class="form-label" required>Email</label>
                <input type="email" class="form-control" placeholder="Enter your email" name="email" required>

            </div>
            <div class="mb-1">
                <label for="exampleInputPassword1" class="form-label" required>Password</label>
                <input type="password" class="form-control" placeholder="Enter your password" name="password" required>
            </div>



            <button type="submit" name="login" class="btn btn-primary mt-2">Login</button>
        </form>
    </div>

</body>

</html>