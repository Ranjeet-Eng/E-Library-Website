<?php
require('../includes/connection.php');
session_start();
if (!isset($_SESSION['name'])) {
    header('location:user-login.php');
    die();
}

if (isset($_GET['email']) && isset($_GET['reset_token'])) {
    date_default_timezone_set('Asia/Kolkata');

    $date = date("Y-m-d");

    $query = "SELECT * FROM `users` WHERE `email` = '$_GET[email]' and `reset_token` = '$_GET[reset_token]' AND `reset-token-expire`= '$date'";
    $result = mysqli_query($conn, $query);




    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            echo " <div class='container my-5'>
            <form  method='post'>
    
                <div class='mb-3'>
                    <label class='form-label'> Create New Password</label>
                    <input type='password' class='form-control' placeholder='New Password' required>
                </div>
    
                <button type='submit' name='update' class='btn btn-primary'>Update Password</button>
                <input type='hidden' name='email' value='$_GET[email]'>
            </form>
    
        </div>";
        } else {
            echo "<script> alert('Invalid or expired link')
            window.location.href='user-login.php';
            </script>";
        }
    } else {
        echo "<script> alert('Server down try again later')
window.location.href='user-login.php';
</script>";
    }
}



?>

<?php
if (isset($_POST['update'])) {
    $password = $_POST['password'];

    $update = "UPDATE `users` SET `password`='$password',`reset_token`=NULL,`reset-token-expire`= NULL WHERE `email`=$_POST[email]";
    if (mysqli_query($conn, $update)) {
        echo "<script> alert('Password updated Successfully!')
        window.location.href='user-login.php';
        </script>";
    } else {
        echo "<script> alert('Server down try again later')
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
</head>


<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">E-Library</a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item">
                    <a class="nav-link" href="admin/admin-login.php">Admin Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user/register.php"></span>User-Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user/user-login.php">User-Login</a>
                </li>
            </ul>
        </div>
    </nav><br>
    <?php require('../marquee.php') ?>





</body>

</html>