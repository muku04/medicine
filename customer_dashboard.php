<?php
include 'customer_header.php';
include 'db.php';

$search_query = "";
$type_filter = "";
$description = "";

if (isset($_GET['search'])) {
    $search_query = $_GET['search'];
}
if (isset($_GET['type'])) {
    $type_filter = $_GET['type'];
}

if (isset($_GET['description'])) {
    $description = $_GET['description'];
}

// Fetch all approved products or search results
$query = "SELECT * FROM products WHERE approved=1 AND name LIKE '%$search_query%' AND use_of_medicine LIKE '%$description%' AND type LIKE '%$type_filter%' ";

$result = mysqli_query($conn, $query);
?>
<head>
  <title>Available Medicines</title>
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
    <h1>Available Medicines</h1>
    <form method="GET" action="customer_dashboard.php">
        <input type="text" name="search" placeholder="Name of Medicine..." value="<?php echo htmlspecialchars($search_query); ?>">

        <!-- Dropdown for Type filter -->
        <select name="type">
            <option value="">Select Type</option>
            <option value="Tablet" <?php echo ($type_filter == 'Tablet') ? 'selected' : ''; ?>>Tablet</option>
            <option value="Injection" <?php echo ($type_filter == 'Injection') ? 'selected' : ''; ?>>Injection</option>
            <option value="Bottle" <?php echo ($type_filter == 'Bottle') ? 'selected' : ''; ?>>Bottle</option>
        </select>

        <input type="text" name="description" placeholder="Description..." value="<?php echo htmlspecialchars($description); ?>">
        <button type="submit">Search</button>
    </form>

    <div class="product-list">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="product-item" style="display: flex; align-items: center; border-bottom: 1px solid #ddd; padding: 10px;">
              <br>  <img src="<?php echo $row['image']; ?>" alt="Product Image" style="width: 150px; height: 150px; object-fit: contain; margin-right: 20px;">
                <div>
                    <h2><?php echo $row['name']; ?></h2>
                    <p><?php echo $row['use_of_medicine']; ?></p>
                    <p>Price: ₹<?php echo $row['price']; ?></p>
                    <a href="view_detail_medicine.php?id=<?php echo $row['id']; ?>">View Details</a>
                    <br><br>
                    
                    <form method="POST" action="cart.php">
                        <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                        <label for="quantity">Quantity:</label>
                        <input type="number" name="quantity" value="0" min="0" max="10" required>
                        <button type="submit">Add to Cart</button>
                    </form>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php
include 'footer.php';
?>
