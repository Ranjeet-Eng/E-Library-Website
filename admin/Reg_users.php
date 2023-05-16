<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('location:admin-login.php');
    die();
}
require('admin-navbar.php');
require('../includes/connection.php');

$name = "";
$email = "";
$status = "";
$userId = "";


$query = "select * from users";
?>

<div class="row my-5">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <form>
            <!-- <h2 class="text-light bg-dark text-center  ">Registered Users </h2> -->
            <table class="table table-success table-striped text-center my-3">
                <thead>
                    <th colspan="5" style="font-size: 25px;">Registered Users</th>
                </thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>User ID</th>
                    <!-- <th>Address</th> -->
                </tr>

                <?php
                $query_run = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($query_run)) {
                    $name = $row['name'];
                    $email = $row['email'];
                    $userId = $row['id'];
                    // $address = $row['address'];
                ?>
                    <tr>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $userId; ?></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </form>
    </div>
    <div class="col-md-2"></div>
</div>