<?php
include 'm_header.php';
include 'db.php';

// Fetch products from the database
$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);
?>

<div class="container">
    <h1>Welcome to PharmEasy Clone</h1>
    <div class="product-list">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="product-item">
                <h2><?php echo $row['name']; ?></h2>
                <p><?php echo $row['use_of_medicine']; ?></p>
                <p>Price: <?php echo $row['price']; ?></p>
                <br> 
                <img src="<?php echo $row['image']; ?>" alt="Product Image" width="100">
                <br>
				 <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
	
                <a href="manage_products.php?id=<?php echo $row['id']; ?>">View Details</a>
            </div>
        <?php } ?>
    </div>
</div>

<?php
include 'footer.php';
?>