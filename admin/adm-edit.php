<?php


session_start();
if (!isset($_SESSION['email'])) {
    header('location:admin-login.php');
    die();
}
require('admin-navbar.php');
require('../includes/connection.php');

$editid = $_GET['editid'];

$editsql = "select * from `add-admin` where id = $editid ";
$edit_result = mysqli_query($conn, $editsql);

$editdata = mysqli_fetch_array($edit_result);


if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "UPDATE `add-admin` SET `name`='$name',`email`='$email',`password`='$password' WHERE id=$editid";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script> alert('Data updated Successfully. ')
        window.location.href='admin_dashboard.php';

        </script>";
    } else {
        echo "error";
    }
}
?>

<!-- admin profile edit expect own -->
<div class="row">

    <div class="container w-50" id="main_content">
        <center>
            <h3>Admin Registration Form</h3>
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