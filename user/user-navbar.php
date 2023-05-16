<?php
// session_start();
if (!isset($_SESSION['name'])) {
    header('location:user-login.php');
    die();
}
require('header.php');
require('../includes/connection.php');
?>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="user_dashboard.php">E-Library</a>
            </div>
            <font style="color: white"><span><strong>Welcome: <?php echo $_SESSION['name']; ?></strong></span></font>
            <font style="color: white"><span><strong>Email: <?php echo $_SESSION['userEmail']; ?></strong></font>
            <ul class="nav navbar-nav navbar-right">

                <a href="user_dashboard.php" class="nav-link">Home </a>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">My Profile </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="view_profile.php">View Profile</a>
                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="edit_profile.php?id=<?php echo $_SESSION['userId']; ?>">Edit Profile</a>
                    </div>
                </li>

                <li class=" nav-item">
                    <a class="nav-link" href="../logout.php">Logout</a>
                </li>
                <li>
                    <a href="issue_book.php" class="btn btn-primary sm float-end">My Cart</a>

                </li>
            </ul>


        </div>
    </nav>
    <?php require('../marquee.php'); ?>

</body>

</html>