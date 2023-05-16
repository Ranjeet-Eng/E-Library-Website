<?php
session_start();
if (!isset($_SESSION['name'])) {
    header('location:user-login.php');
    die();
}

include('../includes/connection.php');
$id = $_GET['id'];
$query = "select * from `add_books` where id = $id ";
$query_run = mysqli_query($conn, $query);

$data = mysqli_fetch_array($query_run);   // fetched from database which books stored



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Books Detail</title>
</head>

<body>

    <?php include('user-navbar.php') ?>



    <div class="container mt-5 w-75">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Book Details
                            <a href="user_dashboard.php" class="btn btn-primary float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">


                        <div class="mb-3">
                            <label> <strong>Book Name</strong></label>
                            <p class="">
                                <?php echo $data['b_name']; ?>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label><strong>Author Name</strong></label>
                            <p class="">
                                <?php echo $data['a_name']; ?>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label><strong>Description</strong> </label>
                            <p>
                                <?php echo $data['des'] ?>
                            </p>
                        </div>


                        <div class="mb-3">

                            <label><strong>Image</strong></label><br>
                            <img src="../uploads/<?php echo $data['image']; ?>" style="height:700px;width:700px" class="form-control">
                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>



</body>

</html>