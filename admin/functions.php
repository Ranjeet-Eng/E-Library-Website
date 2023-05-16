<?php

function get_user_count()
{
    include('../includes/connection.php');

    $user_count = 0;
    $query = "select count(*) as user_count from users";
    $query_run = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($query_run)) {
        $user_count = $row['user_count'];
    }
    return ($user_count);
}

function get_book_count()
{
    include('../includes/connection.php');

    $book_count = 0;
    $query = "select count(*) as book_count from add_books";
    $query_run = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($query_run)) {
        $book_count = $row['book_count'];
    }
    return ($book_count);
}

function get_issuebook_count()
{
    include('../includes/connection.php');

    $issuebook_count = 0;
    $query = "select count(*) as issuebook_count from issued_book";
    $query_run = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($query_run)) {
        $issuebook_count = $row['issuebook_count'];
    }
    return ($issuebook_count);
}
