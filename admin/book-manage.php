<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('location:admin-login.php');
    die();
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Books Manage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>

    <?php require('admin-navbar.php'); ?>

    <div class="container my-1 ">
        <h1 class="my-1 text-center">Books List:</h1><br>

        <div class="container" style="padding-left :50px;margin:-15px 0px 0px 0px;">
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
                                    <a type="reset" class="btn btn-primary mx-1" href="Reg_books.php">Reset</a>


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

                            <a href="adm-read.php?id=<?php echo $data['id']; ?>" class="btn btn-info btn-sm">Read More</a>

                            <a href="edit.php?editid=<?php echo $data['id']; ?>" class="btn btn-success btn-sm">Edit</a>

                            <a href="delete.php?delid=<?php echo $data['id']; ?>" onclick="return confirm('Do you want to delete data')" class="btn btn-danger btn-sm">Delete</a>

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
                    echo '<li><a href="book-manage.php?page=' . ($page - 1) . '" class="btn btn-primary mx-1 btn-sm">Prev</a></li>';
                }

                for ($i = 1; $i <= $total_page; $i++) {
                    if ($i == $page) {
                        $active = "active";
                    } else {
                        $active = " ";
                    }
                    echo  '<li class="' . $active . ' "><a class="btn btn-primary mx-1 btn-sm" href="book-manage.php?page=' . $i . '"> ' . $i . '</a> </li>';
                }
                if ($total_page > $page) {
                    echo '<li><a href="book-manage.php?page=' . ($page + 1) . '" class="btn btn-primary mx-1 btn-sm">Next</a></li>';
                }
                echo   '</ul>';
            }
            ?>
        </div>

    </div>