<?php

session_start();
if (!isset($_SESSION['name'])) {
    header('location:user-login.php');
    die();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>E-Library</title>
    <meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
    <script type="text/javascript" src="bootstrap-4.4.1/js/juqery_latest.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>

</head>


<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="../index.php">E-Library</a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item">
                    <a class="nav-link" href="../admin/admin-login.php">Admin Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php"></span>Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user-login.php">Login</a>
                </li>
            </ul>
        </div>
    </nav><br>
    <?php
    require('../marquee.php'); ?><br>


    <div class="container mt-5">

        <h3 class="text-center">Reset Password</h3>

        <div class="d-grid gap-2 col-4 mx-auto">
            <form action="" method="post">

                <label for="exampleInputEmail1" class="form-label" required><strong> Email</strong></label>
                <input type="email" class="form-control " placeholder="Enter your email" name="email" required>


                <button type="submit" name="reset" class="btn btn-primary mt-2">Send Password Reset Link</button>
                <!-- <a href="register.php"> Not registered yet ?</a> -->
            </form>
        </div>
    </div>

    <?php
    include('../includes/connection.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    function sendMail($email, $reset_token)
    {
        require("../smtp/PHPMailer.php");
        require("../smtp/SMTP.php");
        require("../smtp/Exception.php");
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'singhkalsiranjeet9@gmail.com';                     //SMTP username
            $mail->Password   = 'edrdsopbzmmjkejm';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('singhkalsiranjeet9@gmail.com', 'Ranjeet Singh Kalsi');

            $mail->addAddress($email);     //Add a recipient


            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Password reset link Reset your password';
            $mail->Body    = "We got a request from you to reset your password! <br>
            Click the link below <br>
            <a href='http://localhost/Preparatory%20Exercise%202/user/update-password.php?email= $email & reset_token=$reset_token'>Reset password</a>";
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    if (isset($_POST['reset'])) {

        $query = "SELECT * FROM `users` WHERE `email` = '$_POST[email]'";
        $query_run = mysqli_query($conn, $query);
        if ($query_run) {

            if (mysqli_num_rows($query_run) == 1) {
                $reset_token = bin2hex(random_bytes(16));
                date_default_timezone_set('Asia/Kolkata');
                $date = date("Y-m-d");

                // $query = "UPDATE `users` SET `reset_token`='$reset_token' WHERE `email` = '$_POST[email]'";
                $query = "UPDATE `users` SET `reset_token`='$reset_token',`reset-token-expire`='$date' WHERE `email` = '$_POST[email]'";
                if (mysqli_query($conn, $query) && sendMail($_POST['email'], $reset_token)) {

                    echo "<script> alert('Password reset link sent to mail')
                    window.location.href='user-login.php';
                    </script>";
                } else {
                    echo "<script> alert('server down try later')
                    window.location.href='user-login.php';
                    </script>";
                }
            } else {
                echo "<script> alert('email not valid')
                window.location.href='user-login.php';
                </script>";
            }
        } else {

            echo "<script> alert('cannot run query')
                    window.location.href='user-login.php';
                    </script>";
        }
    }


    ?>


    <!-- <?php
            if (isset($_POST['login'])) {
                include('includes/connection.php');
                $email = $_POST['email'];

                $password = $_POST['password'];

                $query = "Select * from `users` where 
		  email='$email' and password='$password'";
                $query_run = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($query_run)) {
                    if ($row['email'] == $_POST['email']) {
                        if ($row['password'] == $_POST['password']) {
                            $_SESSION['name'] =  $row['name'];
                            $_SESSION['email'] =  $row['email'];
                            $_SESSION['id'] =  $row['id'];
                            header("Location: user_dashboard.php");
                        } else {
            ?>
                    <br><br>
                    <center><span class="alert-danger">Wrong Password !!</span></center>
    <?php
                        }
                    }
                }
            }
    ?> -->
</body>

</html>