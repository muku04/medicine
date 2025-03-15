<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard - PharmEasy Clone</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
<?php
session_start();
if (!isset($_SESSION['users']) || $_SESSION['users']['role'] !== 'stores') {
   // header('Location: seller_dashboard.php');
   // exit;
}
?>
<header>
    <nav>
        <ul>
            <li><a href="seller_dashboard.php">Dashboard</a></li>
            <li><a href="seller_addmedicine.php">Add Medicine</a></li>
            <li><a href="sellermanage_orders.php">Manage Orders</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>