<?php
include('includes/connection.php');

session_start();
if (!isset($_SESSION['user_name'])) {
    header('location:login.php');
}

$editid = $_GET['editid'];

$editsql = "select * from `add_books` where id = $editid ";
$edit_result = mysqli_query($conn, $editsql);

$editdata = mysqli_fetch_array($edit_result);




if (isset($_POST['submit'])) {

    if (!empty($_FILES['image']['name'])) {
        $filename = $_FILES['image']['name'];
        $tempname = $_FILES['image']['tmp_name'];
        move_uploaded_file($tempname, 'uploads/' . $filename);
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
        header('location:index.php');
    } else {
        echo "error";
    }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Data </title>
    <!-- bootstrap css links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- fon awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>

    <!-- navbar -->
    <?php
    include('navbar.php'); ?>

    <div class="container mt-5 w-75">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Book Details
                            <a href="index.php" class="btn btn-primary float-end">Back</a>
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
                            <img src="uploads/<?php echo $editdata['image']; ?>" style="height:300px;width:500px" class="form-control">
                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>