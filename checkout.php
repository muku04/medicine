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
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</head>

<?php
// Check if the user is logged in and has a 'customer' role
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'customer') {
    header('Location: login_customer.php');
    exit;
}

// Check if cart is set and is not empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<center>No items in the cart.</center>";
    exit; // Stop further execution if cart is empty
}

// Initialize total cost
$total = 0;
$products = [];

foreach ($_SESSION['cart'] as $product_id => $quantity) {
    $query = "SELECT * FROM products WHERE id='$product_id'";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $row['quantity'] = $quantity;
        $products[] = $row;
        $total += $row['price'] * $quantity;
    }
}

// Place order
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user']['id'];
    $user_address = $_SESSION['user']['address'];

    // Insert the order into the orders table
    $query = "INSERT INTO orders (user_id, total,  address, status, payment_status) 
              VALUES ('$user_id', '$total', '$user_address', 'pending', 'pending')";
    
    if (mysqli_query($conn, $query)) {
        $order_id = mysqli_insert_id($conn);

        // Insert the order items into the order_items table
        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            $query = "SELECT * FROM products WHERE id='$product_id'";
            $result = mysqli_query($conn, $query);
            if ($row = mysqli_fetch_assoc($result)) {
                $price = $row['price'];
                $query = "INSERT INTO order_items (order_id, product_id, quantity, price) 
                          VALUES ('$order_id', '$product_id', '$quantity', '$price')";
                mysqli_query($conn, $query);
            }
        }

        // Clear the cart after the order is placed
        unset($_SESSION['cart']);
        echo "<center><h1><font color=\"green\">Order placed successfully. You will be redirected shortly.</font></h1></center>";
        header("refresh:3;url=customer_dashboard.php"); // Redirect after 3 seconds
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>

<div class="container">
    <h1>Checkout</h1>

    <h2>Your Cart</h2>
    <?php if (!empty($products)) { ?>
        <div class="cart-items">
            <?php foreach ($products as $product) { ?>
                <div class="cart-item" style="display: flex; align-items: center; border-bottom: 1px solid #ddd; padding: 10px;">
                    <img src="<?php echo $product['image']; ?>" alt="Product Image" style="width: 100px; height: 100px; object-fit: contain; margin-right: 20px;">
                    <div>
                        <h3><?php echo $product['name']; ?></h3>
                        <p>Price: ₹<?php echo $product['price']; ?></p>
                        <p>Quantity: <?php echo $product['quantity']; ?></p>
                        <p>Total: ₹<?php echo $product['price'] * $product['quantity']; ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>

        <hr>
        <h3>Total Amount: ₹<?php echo $total; ?></h3>

        <br>
        <a href="cart.php" class="btn btn-secondary">Back to Cart</a>

        <!-- Payment Dropdown -->
        <button class="btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#paymentDetails" aria-expanded="false" aria-controls="paymentDetails">
            Enter Payment Details
        </button>

        <div class="collapse" id="paymentDetails">
            <form method="POST" action="checkout.php">
                <h4>Payment Details</h4>
                <div class="form-group">
                    <label for="card_number">Card Number:</label>
                    <input type="text" pattern="\d{1,16}" maxlength="16" id="card_number" placeholder="Enter card number" name="card_number" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="expiry_date">Expiry Date (MM/YY):</label>
                    <input type="text" id="expiry_date" name="expiry_date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="cvv">CVV:</label>
                    <input type="text" id="cvv" name="cvv" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary" name="submit_payment">Make Payment & Place Order</button>
            </form>
        </div>

        <br>

    <?php } else { ?>
        <p>Your cart is empty. Please add items to your cart before proceeding.</p><br>
    <?php } ?>
</div>

<?php
include 'footer.php';
?>
