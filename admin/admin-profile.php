<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('location:admin-login.php');
    die();
}
#fetch data from database
require('../includes/connection.php');
$name = "";
$email = "";
$query = "select * from login where email = '$_SESSION[email]'";
$query_run = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($query_run)) {
    $name = $row['name'];
    $email = $row['email'];
}
?>






<body>
    <?php require('admin-navbar.php'); ?>

    <!-- see admin profile -->

    <div class="container mt-5">

        <h3 class="text-center">Admin Profile</h3>

        <div class="d-grid gap-2 col-4 mx-auto my-5">
            <form action="" method="post">

                <label for="exampleInputEmail1" class="form-label" required><strong>Name:</strong></label>
                <input type="text" class="form-control " value="<?php echo $_SESSION['name']; ?>" disabled>

                <label for="exampleInputEmail1" class="form-label" required><strong>Email:</strong></label>
                <input type="text" class="form-control " value="<?php echo $_SESSION['email']; ?>" disabled>

            </form>
        </div>
    </div>

</body>

</html>