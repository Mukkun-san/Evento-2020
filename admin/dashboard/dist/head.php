<?php

include "config.php";

// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["adminloggedin"]) || $_SESSION["adminloggedin"] !== true){
    header("location: ../");
    exit;
}

?>
<style></style>
<!DOCTYPE html>
<html lang="en">
    <head> 
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Admin Dashboard</title>
        <link
            rel="shortcut icon"
            href="../../../assets/images/93670627-571269746842714-5752841786544357376-n-195x129.png"
            type="image/x-icon"
        />
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://use.fontawesome.com/152556e78f.js"></script>
    </head>
    <body class="sb-nav-fixed sb-sidenav-toggled">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">
                Welcome!
            </a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button
            >
            <ul class="navbar-nav d-none d-md-inline-block ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <li class="nav-item dropdown"> 
                    <a class="nav-link " href="../../logout.php"><i class="fas fa-user fa-fw"></i>&nbsp;Logout</a>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading"> <br></div>
                            
                            <a class="nav-link" href="index.php"
                                ><div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Registered Users</a
                            >
                            <a class="nav-link" href="reservations.php"
                                ><div class="sb-nav-link-icon"><i class="far fa-calendar-check"></i></div>
                                Reservations</a
                            >
                            <a class="nav-link" href="messages.php"
                                ><div class="sb-nav-link-icon"><i class="fas fa-comment"></i></div>
                                Messages</a
                            >
                            <a class="nav-link" href="subs.php"
                                ><div class="sb-nav-link-icon"><i class="far fa-newspaper"></i></div>
                                Subscriptions</a
                            >
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo htmlspecialchars($_SESSION["adminusername"]    ); ?>
                    </div>
                </nav>
            </div>