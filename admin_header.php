<?php
session_start(); // Start session at the top of the file

// Ensure the user is logged in and has the 'admin' role
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: admin_login.php");
    exit(); // Stop execution after redirect
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - PharmEasy Clone</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="manage_users.php">Manage Users</a></li>
            <li><a href="manage_products.php">Manage Products</a></li>
            <li><a href="manage_orders.php">Manage Orders</a></li>
            <li><a href="details.php">Notifications</a></li>
            <li><a href="logout.php">Logout</a></li>
            <li><font color="black"><span>Welcome, <?php echo $_SESSION['user']['username']; ?>!</span> </font></li>
        </ul>
    </nav>
</header>
</body>
</html>
