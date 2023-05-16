<?php

session_start();
if (!isset($_SESSION['name'])) {
    header('location:user-login.php');
    die();
}
require('user-navbar.php');
require('../includes/connection.php');

if (isset($_POST['issue'])) {

    $b_name = $_POST['b_name'];
    $a_name = $_POST['a_name'];
    // $image = $_POST['image'];
    $user_id = $_SESSION['userId'];
    $user_email = $_SESSION['userEmail'];
    $book_quantity = 1;

    $select_cart = mysqli_query($conn, "SELECT * FROM `issued_book` WHERE b_name = '$b_name'");

    if (mysqli_num_rows($select_cart) > 0) {
        echo "<script> alert('Book Already Issued')
        window.location.href='user_dashboard.php';
        </script>";
    } else {
        $insert_book = mysqli_query($conn, "INSERT INTO `issued_book`(b_name, a_name, userId,userEmail, quantity) VALUES('$b_name', '$a_name',$user_id, '$user_email', '$book_quantity')");
        echo "<script> alert('Book Issued Successfully')
        window.location.href='user_dashboard.php';
        </script>";
    }
}
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



<div class="container my-1 ">
    <!-- <h1 class="my-1 text-center">Books List:</h1><br> -->
    <h1 class="my-1 text-center" style="font-size: 35px; text-decoration-line: underline;">Books Available:</h1><br>


    <div class="container " style="padding-left :50px;">
        <div class="card-body" style="padding-left :300px;">
            <form method=" GET">
                <div class="row">
                    <div class="col-md-3">
                        <div class="input-group mb-3">
                            <select name="sort_alphabet" class="form-control">
                                <option value="">--Select Option--</option>
                                <option value="a-z" <?php if (isset($_GET['sort_alphabet']) && $_GET['sort_alphabet'] == "a-z") {
                                                        echo "Selected";
                                                    } ?>>A-Z (Ascending Order)</option>
                                <option value="z-a" <?php if (isset($_GET['sort_alphabet']) && $_GET['sort_alphabet'] == "z-a") {
                                                        echo 'Selected';
                                                    } ?>>Z-A (Descending Order)</option>
                            </select>
                            <button type="submit" class="input-group-text btn btn-primary">Sort</button>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <form action="" method="GET">
                            <div class="input-group mb-3">
                                <input type="text" name="search" value="<?php if (isset($_GET['search'])) {
                                                                            echo $_GET['search'];
                                                                        } ?>" class="form-control" placeholder="Search data">
                                <button type="submit" class="btn btn-primary">Search</button>
                                <a type="reset" class="btn btn-primary mx-1" href="user_dashboard.php">Reset</a>


                            </div>
                        </form>
                    </div>

            </form>
        </div>
    </div>
</div>

<?php
include('../includes/connection.php');


// search 
$limit = 8;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}


$offset = ($page - 1) * $limit;
$search = isset($_GET['search']) ? $_GET['search'] : '';

$search_query = "SELECT * FROM `add_books` WHERE b_name LIKE '%$search%' OR a_name LIKE '%$search%' LIMIT {$offset},{$limit}";

// Sorting
$sort_option = "";


if (isset($_GET['sort_alphabet'])) {
    if ($_GET['sort_alphabet'] == "a-z") {
        $sort_option = "ASC";
    } elseif ($_GET['sort_alphabet'] == "z-a") {
        $sort_option = "DESC";
    }
}

$sort_query = "SELECT * FROM `add_books` ORDER BY b_name $sort_option LIMIT {$offset},{$limit} ";

$query = $search ? $search_query : $sort_query;
$result = mysqli_query($conn, $query);

?>
<!-- sort function end here -->

<div class="row gy-4 ">
    <?php
    include '../includes/connection.php';


    if (mysqli_num_rows($result) > 0) {
        while ($data = mysqli_fetch_array($result)) {
    ?>
            <div class="container col-md-3 my-3">
                <div class="card">
                    <img src=" ../uploads/<?php echo $data['image']; ?>" class="card-img-top" width="100px" height="300px" alt="book image" />
                    <div class="card-body text-center" style="background-color:#fed49a;">
                        <h6 class="card-title" style="margin:-12px 0px 0px 0px;">Book Name</h6>
                        <p class="card-text"><?php echo $data['b_name']; ?></p>
                        <h6 class="card-title" style="margin:-15px 0px 0px 0px;">Author Name</h6>
                        <p class="card-text"><?php echo $data['a_name']; ?></p>



                        <form action="" method="post" class="text-center" style="margin:-20px;">

                            <input type="hidden" name="b_name" value="<?php echo $data['b_name']; ?>">
                            <input type="hidden" name="a_name" value="<?php echo $data['a_name']; ?>">

                            <a href="user-read.php?id=<?php echo $data['id']; ?>" class="btn btn-info btn-sm">Read More</a>

                            <button name="issue" type="submit" class=" btn btn-success btn-sm my-3"> Issue Book</button>


                        </form>
                    </div>

                </div>

            </div>

        <?php

        }
    } else {
        ?>
        <h3>Empty Library..Please add a Book Here!</h3>

    <?php
    }
    ?>
    <div class="container" style="padding-left :600px;">

        <!-- <div class="col-4 mx-auto" style="padding-left :100px;"> -->
        <?php

        // pagination code
        $sql1 = "SELECT * FROM `add_books`";
        $result1 = mysqli_query($conn, $sql1) or die("Query Failed");

        if (mysqli_num_rows($result1) > 0) {
            $total_records = mysqli_num_rows($result1);

            $total_page = ceil($total_records / $limit);

            echo '<ul class="pagination text-center">';
            if ($page > 1) {
                echo '<li><a href="user_dashboard.php?page=' . ($page - 1) . '" class="btn btn-primary mx-1 btn-sm">Prev</a></li>';
            }

            for ($i = 1; $i <= $total_page; $i++) {
                if ($i == $page) {
                    $active = "active";
                } else {
                    $active = " ";
                }
                echo  '<li class="' . $active . ' "><a class="btn btn-primary mx-1 btn-sm" href="user_dashboard.php?page=' . $i . '"> ' . $i . '</a> </li>';
            }
            if ($total_page > $page) {
                echo '<li><a href="user_dashboard.php?page=' . ($page + 1) . '" class="btn btn-primary mx-1 btn-sm">Next</a></li>';
            }
            echo   '</ul>';
        }
        ?>
    </div>

</div>



</body>



</html>