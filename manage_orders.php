<?php

include 'admin_header.php';
include 'db.php';

// Fetch orders
$query = "SELECT orders.id,orders.address, users.name AS customer, orders.total, orders.status, orders.payment_status, orders.created_at FROM orders JOIN users ON orders.user_id = users.id";
//$query= "SELECT * FROM orders ";
$result = mysqli_query($conn, $query);

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
                <th>ID</th>
                <th>Customer</th>
			    <th>Address</th>
                <th>Total</th>
                <th>Status</th>
                <th>Payment Status</th>
               
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['customer']; ?></td>
					<td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['total']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo $row['payment_status']; ?></td>
                    
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php
include 'footer.php';
?>