<?php

session_start();
if (!isset($_SESSION['email'])) {
    header('location:admin-login.php');
    die();
}
include('../includes/connection.php');

if (isset($_GET['delid'])) {
    $delid = $_GET['delid'];



    $sql = "DELETE FROM `add-admin` WHERE id=$delid";
    $result = mysqli_query($conn,  $sql);
    if ($result) {
        echo "<script>
         window.location.href = 'admin_dashboard.php';
    </script>";
    } else {
        echo 'error';
    }
}
