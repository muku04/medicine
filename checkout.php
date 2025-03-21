<?php
include 'customer_header.php';
include 'db.php';

?>

<head>
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

<?php

// Check if the user is logged in and has a 'customer' role
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'customer') {
    header('Location: login_seller.php');
    exit;
}

// Check if cart is set and is not empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<center>No items in the cart.</center>";
    exit; // Stop further execution if cart is empty
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user']['id'];
    $total = 0;
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $query = "SELECT * FROM products WHERE id='$product_id'";
        $result = mysqli_query($conn, $query);
        if ($row = mysqli_fetch_assoc($result)) {
            $total += $row['price'] * $quantity;
        }
    }

    $query = "INSERT INTO orders (user_id, total, status, payment_status) VALUES ('$user_id', '$total', 'pending', 'pending')";
    if (mysqli_query($conn, $query)) {
        $order_id = mysqli_insert_id($conn);
        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            $query = "SELECT * FROM products WHERE id='$product_id'";
            $result = mysqli_query($conn, $query);
            if ($row = mysqli_fetch_assoc($result)) {
                $price = $row['price'];
                $query = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ('$order_id', '$product_id', '$quantity', '$price')";
                mysqli_query($conn, $query);
            }
        }
        unset($_SESSION['cart']);
        echo "<center>Order placed successfully.</center>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>


<div class="container">
    <h1>Checkout</h1>
    <form method="POST" action="checkout.php">
        <button type="submit">Place Order</button>
    </form>
</div>

<?php
include 'footer.php';
?>
