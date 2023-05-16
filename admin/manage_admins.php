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

$query = "select * from `add-admin`";
?>

<div class="row my-5">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <form>
            <table class="table table-success table-striped text-center my-3">
                <thead>
                    <th colspan="5" style="font-size: 25px;">Registered Users</th>
                </thead>
                <!-- <table class="table-bordered" width="900px" style="text-align: center"> -->
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

                <?php
                $query_run = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($query_run)) {
                    $name = $row['name'];
                    $email = $row['email'];
                    $status = $row['verification_status'];
                ?>
                    <tr>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $status; ?></td>
                        <td>



                            <a href="adm-edit.php?editid=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                            <a href="del-admin.php?delid=<?php echo $row['id']; ?>" onclick="return confirm('Are you want to delete Admin?')" class="btn btn-danger btn-sm">Delete</a>


                        </td>

                    </tr>
                <?php
                }
                ?>
            </table>
        </form>
    </div>
</div>