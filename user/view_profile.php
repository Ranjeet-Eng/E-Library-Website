<?php

session_start();
if (!isset($_SESSION['name'])) {
    header('location:user-login.php');
    die();
}

require('user-navbar.php');
require('../includes/connection.php');

$name = "";
$email = "";
$query = "select * from users where email = '$_SESSION[userEmail]'";
$query_run = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($query_run)) {
    $name = $row['name'];
    $email = $row['email'];
}
?>
<div class="container mt-5">

    <h3 class="text-center">User Profile</h3>

    <div class="d-grid gap-2 col-4 mx-auto my-5">
        <form action="" method="post">

            <label for="exampleInputEmail1" class="form-label" required><strong>Name:</strong></label>
            <input type="text" class="form-control " value="<?php echo $_SESSION['name']; ?>" disabled>

            <label for="exampleInputEmail1" class="form-label" required><strong>Email:</strong></label>
            <input type="text" class="form-control " value="<?php echo $_SESSION['userEmail']; ?>" disabled>

        </form>
    </div>
</div>