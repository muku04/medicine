<?php
// seller_dashboard.php
session_start();
if (!isset($_SESSION['seller_id'])) {
    header("Location: seller_login.php");
    exit();
}

// Assume a database connection is established
$seller_id = $_SESSION['seller_id'];

// Fetch seller information
$query = "SELECT * FROM sellers WHERE id='$seller_id'";
$result = mysqli_query($conn, $query);
$seller_info = mysqli_fetch_assoc($result);

// Fetch orders received by the seller
$orders_query = "SELECT * FROM orders WHERE seller_id='$seller_id'";
$orders_result = mysqli_query($conn, $orders_query);

// Fetch payments received by the seller
$payments_query = "SELECT * FROM payments WHERE seller_id='$seller_id'";
$payments_result = mysqli_query($conn, $payments_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard - PharmEasy Clone</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="seller_dashboard.php">Dashboard</a></li>
            <li><a href="check_availability.php">Check Availability</a></li>
            <li><a href="confirm_order.php">Confirm Orders</a></li>
            <li><a href="pack_dispatch.php">Pack and Dispatch</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>
<main>
    <h1>Welcome, <?php echo htmlspecialchars($seller_info['name']); ?></h1>
    <section>
        <h2>Your Information</h2>
        <p>Name: <?php echo htmlspecialchars($seller_info['name']); ?></p>
        <p>Email: <?php echo htmlspecialchars($seller_info['email']); ?></p>
    </section>
    <section>
        <h2>Orders Received</h2>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Status</th>
            </tr>
            <?php while ($order = mysqli_fetch_assoc($orders_result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($order['id']); ?></td>
                    <td><?php echo htmlspecialchars($order['product']); ?></td>
                    <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                    <td><?php echo htmlspecialchars($order['status']); ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </section>
    <section>
        <h2>Payments Received</h2>
        <table>
            <tr>
                <th>Payment ID</th>
                <th>Order ID</th>
                <th>Amount</th>
                <th>Status</th>
            </tr>
            <?php while ($payment = mysqli_fetch_assoc($payments_result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($payment['id']); ?></td>
                    <td><?php echo htmlspecialchars($payment['order_id']); ?></td>
                    <td><?php echo htmlspecialchars($payment['amount']); ?></td>
                    <td><?php echo htmlspecialchars($payment['status']); ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </section>
</main>
</body>
</html>