<?php
include 'header.php';
include 'db.php';

session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'customer') {
    header('Location: login_seller.php');
    exit;
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
        echo "Order placed successfully.";
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