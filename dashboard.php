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

$query = "SELECT * FROM products";
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


<body>

<br>  
      <div class="container">
        <div class="row align-items-stretch">
          
<div class="container">
    <br> 
    <h1>Admin Dashboard</h1>

    <br><br>

    <!-- Start of the row -->
    <div class="row">
        <!-- User Stats -->
        <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
            <div class="banner-wrap bg-warning h-100">
                <a href="manage_users.php" class="h-100">
                    <h5>Users</h5><br>
                    <p><?php echo $user_count; ?></p>
                </a>
            </div>
        </div>

        <!-- Product Stats -->
        <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
            <div class="banner-wrap bg-warning h-100">
                <a href="manage_products.php" class="h-100">
                    <h5>Products</h5><br>
                    <p><?php echo $product_count; ?></p>
                </a>
            </div>
        </div>

        <!-- Order Stats -->
        <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
            <div class="banner-wrap bg-warning h-100">
                <a href="manage_orders.php" class="h-100">
                    <h5>Orders</h5><br>
                    <p><?php echo $order_count; ?></p>
                </a>
            </div>
        </div>

        <!-- Notification Stats -->
        <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
            <div class="banner-wrap bg-warning h-100">
                <a href="details.php" class="h-100">
                    <h5>Notifications</h5><br>
                    <p><?php echo $notification_count; ?></p>
                </a>
            </div>
        </div>
    </div>
    <!-- End of the row -->
</div>
          
        </div>
      </div>

</body>

<?php
include 'footer.php';
?>
