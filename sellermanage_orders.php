<?php
include 'seller_header.php';
include 'db.php';

//session_start(); // Start the session if it's not already started

// Check if the seller is logged in
//if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'store') {
    //header('Location: login.php');
   // exit;
//}

// Fetch seller's orders
$seller_id = $_SESSION['user']['id'];
$query = "SELECT orders.id, users.name AS customer, orders.total, orders.status, orders.payment_status, orders.created_at 
          FROM orders 
          JOIN users ON orders.user_id = users.id 
          JOIN order_items ON orders.id = order_items.order_id 
          JOIN products ON order_items.product_id = products.id 
          WHERE products.store_id = '$seller_id' 
          GROUP BY orders.id";
$result = mysqli_query($conn, $query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];
    
    $update_query = "UPDATE orders SET status='$status' WHERE id='$order_id'";
    if (mysqli_query($conn, $update_query)) {
        echo "Order status updated successfully.";
    } else {
        echo "Error: " . $update_query . "<br>" . mysqli_error($conn);
    }
}
?>
<head>
  <title>Admin Register</title>
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
<div class="container">
    <h1>Manage Orders</h1>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Total</th>
                <th>Status</th>
                <th>Payment Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['customer']; ?></td>
                    <td><?php echo $row['total']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo $row['payment_status']; ?></td>
                    <td>
                        <form method="POST" action="manage_orders.php">
                            <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                            <select name="status">
                                <option value="pending" <?php echo $row['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                <option value="dispatched" <?php echo $row['status'] == 'dispatched' ? 'selected' : ''; ?>>Dispatched</option>
                                <option value="delivered" <?php echo $row['status'] == 'delivered' ? 'selected' : ''; ?>>Delivered</option>
                            </select>
                            <button type="submit">Update</button>
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