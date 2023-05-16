<?php

session_start();
if (!isset($_SESSION['name'])) {
    header('location:user-login.php');
    die();
}

require('user-navbar.php');
require('../includes/connection.php');


$b_name = "";
$a_name = "";
$book_quantity = "";


$query = "select * from `issued_book` where userId = $_SESSION[userId]";

if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM `issued_book` WHERE id = '$remove_id'");
    header('location:issue_book.php');
}
?>






<div class="row my-5">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <form>
            <table class="table table-success table-striped text-center my-3">
                <thead>
                    <th colspan="4" style="font-size: 25px;">Issued Books</th>
                </thead>

                <!-- <table class="table mt-5" width="900px"> -->
                <!-- <table class="table" width="900px" style="text-align: center"> -->

                <tr>
                    <th>Book Name</th>
                    <th>Author Name</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>

                <?php
                $query_run = mysqli_query($conn, $query);
                if (mysqli_num_rows($query_run) > 0) {

                    while ($row = mysqli_fetch_assoc($query_run)) {
                        $b_name = $row['b_name'];
                        $a_name = $row['a_name'];
                        $book_quantity = $row['quantity'];
                ?>
                        <tr>
                            <td><?php echo $b_name; ?></td>
                            <td><?php echo $a_name; ?></td>
                            <td><?php echo $book_quantity; ?></td>

                            <td>

                                <a href="issue_book.php?remove=<?php echo $row['id']; ?>" onclick="return confirm('Delete Book From Cart?')" class="btn btn-danger btn-sm"> Delete</a>

                            </td>

                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <h3>No Issued Books Here!</h3>

                <?php
                }
                ?>
            </table>
        </form>
    </div>
</div>


<table class="table table-dark table-striped">
    ...
</table>