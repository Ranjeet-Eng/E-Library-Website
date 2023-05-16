<?php
// session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>E-Library</title>
    <meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
    <script type="text/javascript" src="bootstrap-4.4.1/js/juqery_latest.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
    <script>
        function preventBack() {
            window.history.forward()
        };
        setTimeout("preventBack()", 0);
        window.onload = function() {
            null;
        }
    </script>
</head>


<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">E-Library</a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item">
                    <a class="nav-link" href="admin/admin-login.php">Admin Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user/register.php"></span>User-Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user/user-login.php">User-Login</a>
                </li>
            </ul>
        </div>
    </nav><br>
    <?php require('marquee.php') ?>

    <div class="container">
        <div class="container col-md-6 my-3">
            <div class="card">
                <img src="images/book.png" class="card-img-top  text-white" width="200px" height="300px" alt="book image" style=" background-color:#d8e8ca;" />
                <div class="card-body text-center" style="background-color:#87cdc4;">
                    <h1 style="color: blue;font-size: 3em; font-family: cursive;">Books:</h1>

                    <p style="font-size: 1.2em; font-family: fantasy;">Books are a uniquely portable magic.<br>The more that you read, the more things you will know.</p>

                </div>
            </div>
        </div>


    </div>

</body>

</html>