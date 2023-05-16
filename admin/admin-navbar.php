<?php
if (!isset($_SESSION['email'])) {
    header('location:admin-login.php');
    die();
}
require('header.php');
?>
<!-- top navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="admin_dashboard.php">E-Library</a>
        </div>
        <font style="color: white"><span><strong>Welcome: <?php echo $_SESSION['name']; ?></strong></span></font>
        <font style="color: white"><span><strong>Email: <?php echo $_SESSION['email']; ?></strong></font>


        <ul class="nav navbar-nav navbar-right">
            <li class="nav-item">
                <a class="nav-link" href="admin_dashboard.php">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">My Profile </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="admin-profile.php">View Profile</a>

                </div>
            </li>




            <li class="nav-item">
                <a class="nav-link" href="../logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav><br>

<!-- dashboard navbar -->
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd">
    <div class="container-fluid">

        <ul class="nav navbar-nav navbar-center">
            <li class="nav-item">
                <a class="nav-link" href="admin_dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Books </a>

                <div class="dropdown-menu">
                    <a class="dropdown-item" href="add_book.php">Add New Book</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="book-manage.php">Manage Books</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">Admins</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="add-admin.php">Add New Admin</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="manage_admins.php">Manage Admin</a>
                </div>
            </li>

        </ul>
    </div>
</nav>

<?php require('../marquee.php'); ?><br>