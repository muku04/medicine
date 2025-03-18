<?php
include 'm_header.php';
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