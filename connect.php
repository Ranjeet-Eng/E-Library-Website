<?php
// session_start();
// if (!isset($_SESSION['username'])) {
//     header('location:login.php');
// }


$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'signupforms';

$con = mysqli_connect($hostname, $username, $password, $database);


if (!$con) {
    die(mysqli_error($conn));
}
