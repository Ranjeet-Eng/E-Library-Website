<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('location:admin-login.php');
    die();
}

include('../includes/connection.php');
$id = $_GET['id'];
$query = "select * from `add_books` where id = $id ";
$query_run = mysqli_query($conn, $query);

$data = mysqli_fetch_array($query_run);   // fetched from database which books stored



?>




<?php include('admin-navbar.php') ?>



<div class="container mt-5 w-75">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Book Details
                        <a href="book-manage.php" class="btn btn-primary float-end">Back</a>
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