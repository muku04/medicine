<?php
include 'm_header1.php';
include 'db.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]++;
    } else {
        $_SESSION['cart'][$product_id] = 1;
    }
}

// Fetch cart items
$products = [];
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $query = "SELECT * FROM products WHERE id='$product_id'";
        $result = mysqli_query($conn, $query);
        if ($row = mysqli_fetch_assoc($result)) {
            $row['quantity'] = $quantity;
            $products[] = $row;
        }
    }
}
?>
<head>
  <title>Admin Login</title>
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
    <h1>Cart</h1>
    <div class="cart-items">
        <?php foreach ($products as $product) { ?>
            <div class="cart-item">
                <h2><?php echo $product['name']; ?></h2>
                <p>Quantity: <?php echo $product['quantity']; ?></p>
                <p>Price: <?php echo $product['price']; ?></p>
                <p>Total: <?php echo $product['price'] * $product['quantity']; ?></p>
            </div>
        <?php } ?>
    </div>
    <a href="checkout.php">Checkout</a>
</div>

<?php
include 'footer.php';
?>