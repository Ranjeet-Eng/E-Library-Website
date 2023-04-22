<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location:login.php');
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>
<body>
    <h1 class="text-center text-warning mt-5" >Welcome
        <?php echo $_SESSION['username'];?></h1>

        <div class="container">
            <a href="logout.php" class="btn btn-primary mt-5">Logout</a>
        </div>
    
</body>
</html>