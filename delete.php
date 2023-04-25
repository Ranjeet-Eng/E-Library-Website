<?php
include('includes/connection.php');

session_start();
if (!isset($_SESSION['user_name'])) {
    header('location:login.php');
}


if (isset($_GET['delid'])) {
    $delid = $_GET['delid'];



    $sql = "DELETE FROM `add_books` WHERE id=$delid";
    $result = mysqli_query($conn,  $sql);
    if ($result) {
        echo 'Data Deleted';
        header('location:index.php');
    } else {
        echo 'error';
    }
}
