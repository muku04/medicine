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
// Use the correct session variable to check if the user is logged in and has the 'stores' role
if (!isset($_SESSION['user']['username']) || $_SESSION['user']['role'] != 'stores') {
    header("Location: login_seller.php");
    exit();
}
?>

<header>
    <nav>
        <ul>
            <li><a href="seller_dashboard.php">Dashboard</a></li>
            <li><a href="seller_addmedicine.php">Manage Medicine</a></li>
            <li><a href="sellermanage_orders.php">Manage Orders</a></li>
            <li><a href="logout.php">Logout</a></li>
            <li><font color="black"><span>Welcome, <?php echo $_SESSION['user']['username']; ?>!</span> </font></li>
        </ul>
    </nav>
    <div class="user-info">
            </div>
</header>
</body>
</html>
