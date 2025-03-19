<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard - PharmEasy Clone</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'customer') {
    header('Location: login_customer.php');
    exit;
}
?>
<header>
    <nav>
        <ul>
            <li><a href="customer_dashboard.php">Dashboard</a></li>
            <li><a href="cusindex.php">Search Products</a></li>
            <li><a href="cart.php">Cart</a></li>
			<li><a href="register_customer.php"> Register</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>