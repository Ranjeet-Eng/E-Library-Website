<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('location:admin-login.php');
    die();
}


require('functions.php');
?>
<html>

<head>
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

</html>

<body>

    <!-- admin dashboard  -->
    <?php require('admin-navbar.php'); ?>


    <div class="row  text-center mt-5 ">
        <div class="container col-md-3 my-5">
            <div class="card bg-light" style="width: 300px">
                <div class="card-header">Registered Users</div>
                <div class="card-body">
                    <p class="card-text">No. of total Users: <?php echo get_user_count() ?></p>
                    <a class="btn btn-danger" href="Reg_users.php">View Registered Users</a>
                </div>
            </div>
        </div>
        <div class="container col-md-3 my-5">

            <div class="card bg-light" style="width: 300px">
                <div class="card-header">Total Books</div>
                <div class="card-body">
                    <p class="card-text">No of books available: <?php echo get_book_count() ?></p>
                    <a class="btn btn-success" href="Reg_books.php">View All Books</a>
                </div>
            </div>
        </div>


        <div class="container col-md-3 my-5">

            <div class="card bg-light" style="width: 300px">
                <div class="card-header">Issued Books</div>
                <div class="card-body">
                    <p class="card-text">No of book issued: <?php echo get_issuebook_count() ?> </p>
                    <a class="btn btn-primary" href="view_issued_book.php">View Issued Books</a>
                </div>
            </div>
        </div>



    </div>


</body>

</html>