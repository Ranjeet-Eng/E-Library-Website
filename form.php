<?php
include('includes/connection.php');

session_start();
if (!isset($_SESSION['user_name'])) {
    header('location:login.php');
}

if (isset($_POST['submit'])) {
    $b_name = $_POST['b_name'];
    $a_name = $_POST['a_name'];
    $desc = $_POST['des'];
    $filename = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    move_uploaded_file($tempname, 'uploads/' . $filename);

    $sql = "INSERT INTO `add_books`(`b_name`, `a_name`, `des`, `image`) VALUES ('$b_name','$a_name','$desc','$filename')";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Data Inserted Successfully";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- fon awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>

    <!-- navbar -->
    <?php
    include('navbar.php'); ?>


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
            <a href="index.php" class="btn btn-primary mx-5">Back</a>
        </form>
    </div>


</body>

</html>