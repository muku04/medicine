<?php
include 'seller_header.php';
include 'db.php';

session_start();
if (!isset($_SESSION['users']) || $_SESSION['users']['role'] !== 'stores') {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $store_id = $_SESSION['users']['id'];
    $name = $_POST['name'];
    $use_of_medicine = $_POST['use_of_medicine'];
    $type = $_POST['type'];
    $ingredients = $_POST['ingredients'];
    $company_name = $_POST['company_name'];
    $expiry_date = $_POST['expiry_date'];
    $manufacture_date = $_POST['manufacture_date'];
    $strip = $_POST['strip'];
    $tablet = $_POST['tablet'];
    $price = $_POST['price'];
    $bench_number = $_POST['bench_number'];
    $side_effects = $_POST['side_effects'];

    $query = "INSERT INTO products (stores_id, name, use_of_medicine, type, ingredients, company_name, expiry_date, manufacture_date, strip, tablet, price, bench_number, side_effects) VALUES ('$stores_id', '$name', '$use_of_medicine', '$type', '$ingredients', '$company_name', '$expiry_date', '$manufacture_date', '$strip', '$tablet', '$price', '$bench_number', '$side_effects')";
    if (mysqli_query($conn, $query)) {
        echo "Medicine added successfully.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>

<div class="container">
    <h1>Add Medicine</h1>
    <form method="POST" action="add_medicine.php">
        <label for="name">Name:</label>
        <input type="text" name="name" required>
        <label for="use_of_medicine">Use of Medicine:</label>
        <textarea name="use_of_medicine" required></textarea>
        <label for="type">Type:</label>
        <select name="type" required>
            <option value="tablet">Tablet</option>
            <option value="injection">Injection</option>
            <option value="bottle">Bottle</option>
        </select>
        <label for="ingredients">Ingredients:</label>
        <textarea name="ingredients" required></textarea>
        <label for="company_name">Company Name:</label>
        <input type="text" name="company_name" required>
        <label for="expiry_date">Expiry Date:</label>
        <input type="date" name="expiry_date" required>
        <label for="manufacture_date">Manufacture Date:</label>
        <input type="date" name="manufacture_date" required>
        <label for="strip">Strip:</label>
        <input type="number" name="strip" required>
        <label for="tablet">Tablet:</label>
        <input type="number" name="tablet" required>
        <label for="price">Price:</label>
        <input type="number" step="0.01" name="price" required>
        <label for="bench_number">Bench Number:</label>
        <input type="text" name="bench_number" required>
        <label for="side_effects">Side Effects:</label>
        <textarea name="side_effects"></textarea>
        <button type="submit">Add Medicine</button>
    </form>
</div>

<?php
include 'footer.php';
?>