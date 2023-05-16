<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('location:admin-login.php');
    die();
}
include('../includes/connection.php');




if (isset($_GET['delid'])) {
    $delid = $_GET['delid'];



    $sql = "DELETE FROM `add_books` WHERE id=$delid";
    $result = mysqli_query($conn,  $sql);
    if ($result) {
        echo 'Data Deleted';
        header('location:book-manage.php');
    } else {
        echo 'error';
    }
}
