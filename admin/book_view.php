<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('location:admin-login.php');
    die();
}
include('../includes/connection.php');

$editid = $_GET['editid'];

$editsql = "select * from `add_books` where id = $editid ";
$edit_result = mysqli_query($conn, $editsql);

$editdata = mysqli_fetch_array($edit_result);




if (isset($_POST['submit'])) {

    if (!empty($_FILES['image']['name'])) {
        $filename = $_FILES['image']['name'];
        $tempname = $_FILES['image']['tmp_name'];
        move_uploaded_file($tempname, '../uploads/' . $filename);
    } else {
        $filename = $_POST['oldimage'];
    }



    $b_name = $_POST['b_name'];
    $a_name = $_POST['a_name'];
    $desc = $_POST['des'];

    $sql = "UPDATE `add_books` SET `b_name`='$b_name',`a_name`='$a_name',`des`='$desc',`image`='$filename' WHERE id=$editid";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Data Updated Successfully";
        header('location:../index.php');
    } else {
        echo "error";
    }
}

?>

<!-- navbar -->

<?php require('admin-navbar.php'); ?>



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
                            <?php echo $editdata['b_name']; ?>
                        </p>
                    </div>
                    <div class="mb-3">
                        <label><strong>Author Name</strong></label>
                        <p class="">
                            <?php echo $editdata['a_name']; ?>
                        </p>
                    </div>
                    <div class="mb-3">
                        <label><strong>Description</strong> </label>
                        <p>
                            <?php echo $editdata['des'] ?>
                        </p>
                    </div>


                    <div class="mb-3">

                        <label><strong>Image</strong></label><br>
                        <img src="../uploads/<?php echo $editdata['image']; ?>" style="height:300px;width:500px" class="form-control">
                    </div>




                </div>
            </div>
        </div>
    </div>
</div>