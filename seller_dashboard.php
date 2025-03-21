<?php

include 'seller_header.php';
include 'db.php';

// Fetch seller's medicines
$seller_id = $_SESSION['user']['id']; // Correct session key to get the user ID
$query = "SELECT * FROM products WHERE store_id='$seller_id'";
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
<div class="container">
    <h1>Welcome to PharmEasy Clone</h1>
    <div class="product-list">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="product-item">
                <h2><?php echo $row['name']; ?></h2>
                <p><?php echo $row['use_of_medicine']; ?></p>
                <p>Price: <?php echo $row['price']; ?></p>
                <img src="<?php echo $row['image']; ?>" alt="Product Image" width="100">
                <br>
                <a href="seller_addmedicine.php?id=<?php echo $row['id']; ?>">View Details</a>
            </div>
        <?php } ?>
    </div>
</div>

<?php
include 'footer.php';
?>
