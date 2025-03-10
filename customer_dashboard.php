<?php
// customer_dashboard.php
session_start();
if (!isset($_SESSION['customer_id'])) {
    header("Location: customer_login.php");
    exit();
}

// Assume a database connection is established
$customer_id = $_SESSION['customer_id'];

// Fetch customer information
$query = "SELECT * FROM customers WHERE id='$customer_id'";
$result = mysqli_query($conn, $query);
$customer_info = mysqli_fetch_assoc($result);

// Fetch orders placed by the customer
$orders_query = "SELECT * FROM orders WHERE customer_id='$customer_id'";
$orders_result = mysqli_query($conn, $orders_query);

// Fetch payments made by the customer
$payments_query = "SELECT * FROM payments WHERE customer_id='$customer_id'";
$payments_result = mysqli_query($conn, $payments_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard - PharmEasy Clone</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="customer_dashboard.php">Dashboard</a></li>
            <li><a href="order_history.php">Order History</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>
<main>
    <h1>Welcome, <?php echo htmlspecialchars($customer_info['name']); ?></h1>
    <section>
        <h2>Your Information</h2>
        <p>Name: <?php echo htmlspecialchars($customer_info['name']); ?></p>
        <p>Email: <?php echo htmlspecialchars($customer_info['email']); ?></p>
    </section>
    <section>
        <h2>Orders Placed</h2>
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
        <h2>Payments Made</h2>
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