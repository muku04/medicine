<?php
include 'customer_header.php';
include 'db.php';

// Handle updating the cart quantity or removing an item
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
        // Updating product quantity
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        // Only update or add to the cart if the quantity is greater than 0
        if ($quantity > 0) {
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            // Update quantity if the product is already in the cart
            if (isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id] = $quantity; // Update to the new quantity
            } else {
                $_SESSION['cart'][$product_id] = $quantity;
            }
        } else {
            // Optionally, display an error or message that quantity cannot be zero
           
        }
    } elseif (isset($_POST['remove_product_id'])) {
        // Remove product from cart
        $product_id = $_POST['remove_product_id'];
        if (isset($_SESSION['cart'][$product_id])) {
            unset($_SESSION['cart'][$product_id]); // Remove product from cart
        }
    }
}

// Fetch cart items, excluding products with quantity 0
$products = [];
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        // Skip the product if the quantity is 0
        if ($quantity > 0) {
            $query = "SELECT * FROM products WHERE id='$product_id'";
            $result = mysqli_query($conn, $query);
            if ($row = mysqli_fetch_assoc($result)) {
                $row['quantity'] = $quantity;
                $products[] = $row;
            }
        }
    }
}
?>

<head>
  <title>Your Cart</title>
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
    <h1>Your Cart</h1>
    
    <?php if (empty($products)) { ?>
        <p>Your cart is empty. </p> <br>  <a href="customer_dashboard.php">Continue shopping</a></p>
    <?php } else { ?>
        <div class="cart-items">
            <?php foreach ($products as $product) { ?>
                <div class="cart-item" style="display: flex; align-items: center; border-bottom: 1px solid #ddd; padding: 10px;">
                    <img src="<?php echo $product['image']; ?>" alt="Product Image" style="width: 100px; height: 100px; object-fit: contain; margin-right: 20px;">
                    <div>
                        <h2><?php echo $product['name']; ?></h2>
                        <p>Price: ₹<?php echo $product['price']; ?></p>

                        <!-- Update Quantity Form -->
                        <form method="POST" action="cart.php" style="display:inline-block;">
                            <label for="quantity">Quantity:</label>
                            <input type="number" name="quantity" value="<?php echo $product['quantity']; ?>" min="1" max="10" required>
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <button type="submit">Update Quantity</button>
                        </form>

                        <!-- Remove Product from Cart Form -->
                        <form method="POST" action="cart.php" style="display:inline-block; margin-left: 10px;">
                            <input type="hidden" name="remove_product_id" value="<?php echo $product['id']; ?>">
                            <button type="submit" style="color: red;">Remove from Cart</button>
                        </form>

                        <p>Total: ₹<?php echo $product['price'] * $product['quantity']; ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>

        <br>
        <a href="customer_dashboard.php" class="btn btn-secondary">Back to Product List</a>
<Br> 
        <!-- Link to Proceed to Checkout -->
        <a href="checkout.php" class="btn btn-primary">Proceed to Checkout</a>
        <br>

        <!-- Link back to Product List -->
    <?php } ?>
</div>

<?php
include 'footer.php';
?>
