<?php
include 'seller_header.php';
include 'db.php';

// Fetch seller's medicines
$seller_id = $_SESSION['users']['id'];
$query = "SELECT * FROM products WHERE store_id='$seller_id'";
$result = mysqli_query($conn, $query);
?>

<div class="container">
    <h1>Seller Dashboard</h1>
    <div class="product-list">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="product-item">
                <h2><?php echo $row['name']; ?></h2>
                <p><?php echo $row['use_of_medicine']; ?></p>
                <p>Price: <?php echo $row['price']; ?></p>
            </div>
        <?php } ?>
    </div>
</div>

<?php
include 'footer.php';
?>