<?php
include 'cusindex.php';
include 'db.php';

session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'customer') {
    header('Location: cusindex.php');
    exit;
}

$search_query = "";
$type_filter = "";
$disease_filter = "";
$contain_filter = "";

if (isset($_GET['search'])) {
    $search_query = $_GET['search'];
}
if (isset($_GET['type'])) {
    $type_filter = $_GET['type'];
}
if (isset($_GET['disease'])) {
    $disease_filter = $_GET['disease'];
}
if (isset($_GET['contain'])) {
    $contain_filter = $_GET['contain'];
}

// Fetch all approved products or search results
$query = "SELECT * FROM products WHERE approved=1 AND name LIKE '%$search_query%' AND type LIKE '%$type_filter%' AND use_of_medicine LIKE '%$disease_filter%' AND ingredients LIKE '%$contain_filter%'";
$result = mysqli_query($conn, $query);
?>

<div class="container">
    <h1>Available Medicines</h1>
    <form method="GET" action="customer_dashboard.php">
        <input type="text" name="search" placeholder="Search for medicines..." value="<?php echo htmlspecialchars($search_query); ?>">
        <input type="text" name="type" placeholder="Type..." value="<?php echo htmlspecialchars($type_filter); ?>">
        <input type="text" name="disease" placeholder="Disease..." value="<?php echo htmlspecialchars($disease_filter); ?>">
        <input type="text" name="contain" placeholder="Contain..." value="<?php echo htmlspecialchars($contain_filter); ?>">
        <button type="submit">Search</button>
    </form>
    <div class="product-list">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="product-item">
                <h2><?php echo $row['name']; ?></h2>
                <p><?php echo $row['use_of_medicine']; ?></p>
                <p>Price: <?php echo $row['price']; ?></p>
                <a href="details.php?id=<?php echo $row['id']; ?>">View Details</a>
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