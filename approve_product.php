<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    
    // Get current approval status
    $query = "SELECT approved FROM products WHERE id=$product_id";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($result);
    
    // Toggle approval status
    $new_status = $product['approved'] ? 0 : 1;
    $query = "UPDATE products SET approved=$new_status WHERE id=$product_id";
    mysqli_query($conn, $query);
}

header('Location: manage_products.php');
exit();
?>