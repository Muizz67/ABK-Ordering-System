<?php 
    session_start();
    if(isset($_SESSION['admin_username'])){
        $admin_username = $_SESSION['admin_username'];
    include("../dbconn.php");
?>

<html>
    <head>
        <title>ABK - Admin</title>

        <link rel="stylesheet" href="../css/admin.css">
    </head>
    
    <body>
        <!-- Menu Section Starts -->
        <div class="menu text-center">
            <div class="wrapper">
                <ul>
                    <li><a href="index.php">Dashboard</a></li>
                    <li><a href="manage-sets.php">Sets</a></li>
                    <li><a href="manage-alacarte.php">Add-Ons</a></li>
                    <li><a href="manage-order.php">Order Section</a></li>
                    <li><a href="manage-admin.php">Manage Admin</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
        <!-- Menu Section Ends -->

<?php
}
else{
   header("Location: login.php");
}
?>