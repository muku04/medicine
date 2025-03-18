<?php

include 'admin_header.php';
include 'db.php';

// Fetch orders
$query = "SELECT orders.id, users.name AS customer, orders.total, orders.status, orders.payment_status, orders.created_at FROM orders JOIN users ON orders.user_id = users.id";
$result = mysqli_query($conn, $query);
?>

<div class="container">
    <h1>Manage Orders</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
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
                        <form method="POST" action="update_order_status.php">
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