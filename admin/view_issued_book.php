<?php

session_start();
if (!isset($_SESSION['email'])) {
    header('location:admin-login.php');
    die();
}

require('admin-navbar.php');
require('../includes/connection.php');


$b_name = "";
$a_name = "";
$user_email = "";
$book_quantity = "";

$query = "select * from `issued_book`";

if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM `issued_book` WHERE id = '$remove_id'");
    header('location:view_issued_book.php');
}
?>






<div class="row my-5">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <form>
            <!-- <h2 class="text-center">Issued Books</h2> -->
            <!-- <h2 class="text-light bg-dark text-center  ">Issued Books</h2> -->
            <table class="table table-success table-striped text-center my-3">
                <thead>
                    <th colspan="5" style="font-size: 30px;">Users Issued Books</th>
                </thead>

                <!-- <table class="table-bordered my-5" width="900px" style="text-align: center"> -->
                <tr>
                    <th>Book Name</th>
                    <th>Author Name</th>
                    <th>User Email ID</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>

                <?php
                $query_run = mysqli_query($conn, $query);
                if (mysqli_num_rows($query_run) > 0) {

                    while ($row = mysqli_fetch_assoc($query_run)) {
                        $b_name = $row['b_name'];
                        $a_name = $row['a_name'];
                        $user_email = $row['userEmail'];
                        $book_quantity = $row['quantity'];
                ?>
                        <tr>
                            <td><?php echo $b_name; ?></td>
                            <td><?php echo $a_name; ?></td>
                            <td><?php echo $user_email ?></td>
                            <td><?php echo $book_quantity; ?></td>

                            <td>

                                <a href="view_issued_book.php?remove=<?php echo $row['id']; ?>" onclick="return confirm('Delete Book From List?')" class="btn btn-danger btn-sm"> Delete</a>

                            </td>

                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <h3>No Issued Books Here By Users!</h3>

                <?php
                }
                ?>
            </table>
        </form>
    </div>
</div>