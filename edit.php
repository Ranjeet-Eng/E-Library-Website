<?php
include('includes/connection.php');
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- fon awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>

    <!-- navbar -->
    <?php
    include('navbar.php'); ?>


    <div class="container mt-5 w-50 h-50">
        <h2 class="text-center">Edit Book Detail</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label"><strong>Book Name:</strong> </label>
                <input type="text" class="form-control" name="b_name" placeholder="Enter book name" value="<?php echo $editdata['b_name']; ?>" required>

            </div>
            <div class="mb-3">
                <label class="form-label"><strong> Author Name:</strong></label>
                <input type="text" class="form-control" name="a_name" placeholder="Enter author name" value="<?php echo $editdata['a_name']; ?>" required>

            </div>
            <div class="mb-3">
                <label class="form-label"><strong>Description:</strong> </label>
                <textarea name="des" type="text" cols="10" rows="5" class="form-control" placeholder="Enter description here" required><?php echo $editdata['des'] ?></textarea>


            </div>

            <div class="mb-3 mt-3">

                <label for="email"><strong> Old image</strong></label><br>
                <img src="uploads/<?php echo $editdata['image']; ?>" style="height:300px;width:300px" class="form-control">
                <input type="hidden" name="oldimage" value="<?php echo $editdata['image']; ?>"><br>

                <label for="exampleInputEmail1" class="form-label">Upload Image</label>
                <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="image">
                <div class="form-text"></div>
            </div>


            <button type="submit" class="btn btn-primary" name="submit">Update</button>
        </form>
    </div>


</body>

</html>