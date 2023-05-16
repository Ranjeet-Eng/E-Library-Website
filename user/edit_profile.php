<?php

session_start();
if (!isset($_SESSION['name'])) {
    header('location:user-login.php');
    die();
}

require('user-navbar.php');
require('../includes/connection.php');

$id = $_SESSION['userId'];

$editsql = "select * from `users` where id = $id ";
$edit_result = mysqli_query($conn, $editsql);

$editdata = mysqli_fetch_array($edit_result);

if (isset($_POST['submit'])) {


    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "UPDATE `users` SET `name`='$name',`email`='$email',`password`='$password' WHERE id=$id";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script> alert('Profile updated Successfully. ')
        window.location.href='user_dashboard.php';

        </script>";
    } else {
        echo "error";
    }
}
?>



<div class="row">

    <div class="container w-50" id="main_content">
        <center>
            <h3>User Registration Form</h3>
        </center>

        <form method="post">
            <div class="mb-1">
                <label for="exampleInputEmail1" class="form-label" required>Name</label>
                <input type="text" class="form-control" placeholder="Enter your name" name="name" value="<?php echo $editdata['name']; ?>" required>

            </div>

            <div class="mb-1">
                <label for="exampleInputEmail1" class="form-label" required>Email</label>
                <input type="email" class="form-control" placeholder="Enter your email" name="email" value="<?php echo $editdata['email']; ?>" required>

            </div>
            <div class="mb-1">
                <label for="exampleInputPassword1" class="form-label" required>Password</label>
                <input type="text" class="form-control" placeholder="Enter your password" name="password" value="<?php echo $editdata['password']; ?>" required>
            </div>



            <button type="submit" name="submit" class="btn btn-primary">Update</button>

        </form>

    </div>
</div>