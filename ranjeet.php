<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style.css">


</head>

<body>
    <!-- NavBar -->
    <?php include('navbar.php') ?>
    <!-- NavBar -->

    <header>
        <div class="book1">
            <h1 style="color: blue; text-align: center; font-size: 3em; font-family: cursive;"><img class="logo" src="images/book.png" alt="book image">Books:</h1>
            <p style="height: 0%; text-align: center; font-size: 1.2em; font-family: fantasy;">Books are a uniquely portable magic.<br>The more that you read, the more things you will know.</p>
        </div><br>
    </header>


    <div>
        <h1 class="list">Books List:</h1>
    </div>

    <!-- <div class="col-2">
        <a href="form.php" class="btn btn-primary btn-md">Add Book</a>
    </div> -->

    <!-- cards where books detail -->
    <div class="container my-5 ">

        <div class="container " style="padding-left :50px;">
            <div class="card-body" style="padding-left :135px;">
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
                                    <a type="reset" class="btn btn-primary mx-3" href="index.php">Reset</a>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-2">
                            <a href="form.php" class="btn btn-primary btn-md ">Add Book</a>

                        </div>
                </form>

            </div>


        </div>
    </div>


    <?php
    include('includes/connection.php');



    // search 
    $limit = 3;
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
    // pagination coding with sort
    // $limit = 3;
    // if (isset($_GET['page'])) {
    //     $page = $_GET['page'];
    // } else {
    //     $page = 1;
    // }
    // $offset = ($page - 1) * $limit;
    $sort_query = "SELECT * FROM `add_books` ORDER BY b_name $sort_option LIMIT {$offset},{$limit} ";

    $query = $search ? $search_query : $sort_query;
    $result = mysqli_query($conn, $query);

    ?>
    <!-- sort function end here -->

    <div class="row gy-4 text-center">
        <?php
        include 'includes/connection.php';



        if (mysqli_num_rows($result) > 0) {
            while ($data = mysqli_fetch_array($result)) {
        ?>
                <div class="container col-md-3 my-5">
                    <div class="card">
                        <img src=" uploads/<?php echo $data['image']; ?>" class="card-img-top" width="200px" height="200px" alt="book image" />
                        <div class="card-body text-center" style="background-color:azure;">
                            <h6 class="card-title">Book Name</h6>
                            <p class="card-text"><?php echo $data['b_name']; ?></p>
                            <h6 class="card-title">Author Name</h6>
                            <p class="card-text"><?php echo $data['a_name']; ?></p>


                            <a href="book_view.php?editid=<?php echo $data['id']; ?>" class="btn btn-info btn-sm">Read More</a>

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

        // pagination code
        $sql1 = "SELECT * FROM `add_books`";
        $result1 = mysqli_query($conn, $sql1) or die("Query Failed");

        if (mysqli_num_rows($result1) > 0) {
            $total_records = mysqli_num_rows($result1);

            $total_page = ceil($total_records / $limit);

            echo '<ul class="pagination">';
            if ($page > 1) {
                echo '<li><a href="index.php?page=' . ($page - 1) . '" class="btn btn-primary mx-1  btn-sm">Prev</a></li>';
            }

            for ($i = 1; $i <= $total_page; $i++) {
                if ($i == $page) {
                    $active = "active";
                } else {
                    $active = " ";
                }
                echo  '<li class="' . $active . ' "><a class="btn btn-primary mx-1 btn-sm" href="index.php?page=' . $i . '"> ' . $i . '</a> </li>';
            }
            if ($total_page > $page) {
                echo '<li><a href="index.php?page=' . ($page + 1) . '" class="btn btn-primary mx-1 btn-sm">Next</a></li>';
            }

            echo   '</ul>';
        }


        ?>






    </div>



</body>

</html>