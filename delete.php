<?php
include('includes/connection.php');


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
