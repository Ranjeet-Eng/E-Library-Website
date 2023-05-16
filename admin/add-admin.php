<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('location:admin-login.php');
    die();
}
?>

<?php
include('../includes/connection.php');

use PHPMailer\PHPMailer\PHPMailer;      // used smtp phpmailer
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$msg = "";
if (isset($_POST['submit'])) {           // email verification queries with conditions
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $conpassword = $_POST['conpassword'];

    $check = mysqli_num_rows(mysqli_query($conn, "select * from `add-admin` where email='$email'"));


    if ($check > 0) {
        echo "<script> alert('Email id already present')
    window.location.href='add-admin.php';
    </script>";
    } else {
        $verification_id = rand(111111111, 999999999);
        if ($password === $conpassword) {
            mysqli_query($conn, "insert into `add-admin` (name,email,password,verification_status,verification_id) values('$name','$email','$password',0,'$verification_id')");

            echo "<script> alert('Verification-Link send to your email id')
    window.location.href='admin_dashboard.php';
    </script>";

            $mailHtml = "Please confirm your account registration by clicking the button or link below: <a href='http://localhost/Preparatory%20Exercise%202/admin/check.php?id=$verification_id'>http://localhost/Preparatory%20Exercise%202/admin/check.php?id=$verification_id</a>";

            smtp_mailer($email, 'Account Verification', $mailHtml);
        } else {
            echo "<script> alert('Password doesn't matched')
      window.location.href='add-admin.php';
      </script>";
        }
    }
}

function smtp_mailer($to, $subject, $msg)
{
    require("../smtp/PHPMailer.php");
    require("../smtp/SMTP.php");
    require("../smtp/Exception.php");
    $mail = new PHPMailer(true);


    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'singhkalsiranjeet9@gmail.com';                     //SMTP username
    $mail->Password   = 'edrdsopbzmmjkejm';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('singhkalsiranjeet9@gmail.com', 'Ranjeet Singh');
    // $mail->addAddress($email);     //Add a recipient


    //Content
    $mail->isHTML(true);

    $mail->Subject = $subject;
    $mail->Body = $msg;
    // $mail->AddAddress($to);
    $mail->AddAddress($to);
    if (!$mail->Send()) {
        return 0;
    } else {
        return 1;
    }
}
?>
<?php require('admin-navbar.php'); ?>

<!-- admin registraition form -->

<div class="row">

    <div class="container w-50" id="main_content">
        <center>
            <h3>Admin Registration Form</h3>
        </center>

        <form method="post">
            <div class="mb-1">
                <label for="exampleInputEmail1" class="form-label" required>Name</label>
                <input type="text" class="form-control" placeholder="Enter your name" name="name" required>

            </div>

            <div class="mb-1">
                <label for="exampleInputEmail1" class="form-label" required>Email</label>
                <input type="email" class="form-control" placeholder="Enter your email" name="email" required>

            </div>
            <div class="mb-1">
                <label for="exampleInputPassword1" class="form-label" required>Password</label>
                <input type="password" class="form-control" placeholder="Enter your password" name="password" required>
            </div>

            <div class="mb-1">
                <label for="exampleInputPassword1" class="form-label" required>Confirm Password</label>
                <input type="password" class="form-control" placeholder="Confirm password" name="conpassword" required>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Sign up</button>

        </form>

    </div>
</div>