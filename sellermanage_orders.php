<?php
include 'seller_header.php';
include 'db.php';



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['order_id'];
    $status = $_POST['statusa'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id); // "si" means string and integer

    if ($stmt->execute()) {
        // Success message
        $message = "Order status updated successfully.";
    } else {
        // Error message
        $message = "Error updating order status: " . $stmt->error;
    }

    $stmt->close();
}

$seller_id = $_SESSION['user']['id'];
$query = "SELECT orders.id, users.name AS customer,orders.address, orders.total, orders.status, orders.payment_status, orders.created_at FROM orders JOIN users ON orders.user_id = users.id";
$result = mysqli_query($conn, $query);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Orders</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,700|Crimson+Text:400,400i" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h1>Manage Orders</h1>
    <?php if (isset($message)) { echo "<div class='alert alert-info'>$message</div>"; } ?>
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
				<th>Address</th>
                <th>Total</th>
                <th>Status</th>
                <th>Payment Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['customer']); ?></td>
					<td><?php echo htmlspecialchars($row['address']); ?></td>
                    <td><?php echo htmlspecialchars($row['total']); ?></td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                    <td><?php echo htmlspecialchars($row['payment_status']); ?></td>
                    <td>
                        <form method="POST" action="sellermanage_orders.php">
                            <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                            <select name="statusa">
                                <option value="pending" <?php echo $row['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                <option value="dispatched" <?php echo $row['status'] == 'dispatched' ? 'selected' : ''; ?>>Dispatched</option>
                                <option value="delivered" <?php echo $row['status'] == 'delivered' ? 'selected' : ''; ?>>Delivered</option>
                            </select>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php
include 'footer.php';
?>
</body>
</html>