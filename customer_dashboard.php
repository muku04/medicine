<?php
 include 'customer_header.php';
 //include 'm_header.php';
 include 'db.php';

//session_start();
//if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'customer') {
  //  header('Location: cusindex.php');
  //  exit;
//}

$search_query = "";
$type_filter = "";
$contain_filter = "";
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
if (isset($_GET['contain'])) {
    $contain_filter = $_GET['contain'];
}

// Fetch all approved products or search results
$query = "SELECT * FROM products WHERE approved=1 AND name LIKE '%$search_query%' AND use_of_medicine LIKE '%$description%' AND type LIKE '%$type_filter%' AND ingredients LIKE '%$contain_filter%'";

$result = mysqli_query($conn, $query);
?>

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
        <input type="text" name="contain" placeholder="Ingredients..." value="<?php echo htmlspecialchars($contain_filter); ?>">
        <button type="submit">Search</button>
    </form>
    
    <div class="product-list">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="product-item">
                <h2><?php echo $row['name']; ?></h2>
                <p><?php echo $row['use_of_medicine']; ?></p>
                <p>Price: <?php echo $row['price']; ?></p>
                <a href="view_detail_medicine.php?id=<?php echo $row['id']; ?>">View Details</a>
                <br>
                <img src="<?php echo $row['image']; ?>" alt="Product Image" width="100">
                <br>
                <form method="POST" action="cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
        <?php } ?>
    </div>
</div>

<?php
include 'footer.php';
?>