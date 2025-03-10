<?php
include 'admin_header.php';
include 'db.php';

// Fetch data for the dashboard
$user_count_query = "SELECT COUNT(*) AS user_count FROM users";
$product_count_query = "SELECT COUNT(*) AS product_count FROM products";
$order_count_query = "SELECT COUNT(*) AS order_count FROM orders";
$notification_count_query = "SELECT COUNT(*) AS notification_count FROM notifications";

$user_count_result = mysqli_query($conn, $user_count_query);
$product_count_result = mysqli_query($conn, $product_count_query);
$order_count_result = mysqli_query($conn, $order_count_query);
$notification_count_result = mysqli_query($conn, $notification_count_query);

$user_count = mysqli_fetch_assoc($user_count_result)['user_count'];
$product_count = mysqli_fetch_assoc($product_count_result)['product_count'];
$order_count = mysqli_fetch_assoc($order_count_result)['order_count'];
$notification_count = mysqli_fetch_assoc($notification_count_result)['notification_count'];
?>

<div class="container">
    <h1>Admin Dashboard</h1>
    <div class="dashboard-stats">
        <div class="stat-item">
            <h2>Users</h2>
            <p><?php echo $user_count; ?></p>
        </div>
        <div class="stat-item">
            <h2>Products</h2>
            <p><?php echo $product_count; ?></p>
        </div>
        <div class="stat-item">
            <h2>Orders</h2>
            <p><?php echo $order_count; ?></p>
        </div>
        <div class="stat-item">
            <h2>Notifications</h2>
            <p><?php echo $notification_count; ?></p>
        </div>
		
    </div>
</div>

<?php
include 'footer.php';
?>