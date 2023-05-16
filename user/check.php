<?php
// session_start();
// if (!isset($_SESSION['name'])) {
//     header('location:../index.php');
// }
include('../includes/connection.php');
$id = mysqli_real_escape_string($conn, $_GET['id']);
mysqli_query($conn, "update users set verification_status='1' where verification_id='$id'");
echo '    <h2 class="mt-5 mx-5 text-center">Your account verified</h2>
';
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Database Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <div class="d-grid gap-2 col-4 mx-auto">
        <a href="user-login.php" class="btn btn-primary mt-3"> Click here to Login</a>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>