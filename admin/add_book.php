<?php

session_start();
if (!isset($_SESSION['email'])) {
    header('location:admin-login.php');
    die();
}
include('../includes/connection.php');
// add books query
if (isset($_POST['submit'])) {
    $b_name = $_POST['b_name'];
    $a_name = $_POST['a_name'];
    $desc = $_POST['des'];
    $filename = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    move_uploaded_file($tempname, '../uploads/' . $filename);

    $sql = "INSERT INTO `add_books`(`b_name`, `a_name`, `des`, `image`) VALUES ('$b_name','$a_name','$desc','$filename')";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script> alert('Data Added Successfully. ')
        window.location.href='admin_dashboard.php';
        
        </script>";
    } else {
        echo "error";
    }
}

?>





<!-- navbar -->
<?php require('admin-navbar.php'); ?>

<!-- Add books form -->

<div class="container mt-5 w-50 ">
    <h2 class="text-center">Add Book Detail</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Book Name:</label>
            <input type="text" class="form-control" name="b_name" placeholder="Enter book name" required>

        </div>
        <div class="mb-3">
            <label class="form-label">Author Name:</label>
            <input type="text" class="form-control" name="a_name" placeholder="Enter author name" required>

        </div>
        <div class="mb-3">
            <label class="form-label">Description:</label>
            <textarea name="des" type="text" cols="10" rows="5" class="form-control" placeholder="Enter description here" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Book Image:</label>
            <input type="file" class="form-control" name="image" required>

        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        <a href="admin_dashboard.php" class="btn btn-primary mx-2">Back</a>
    </form>
</div>