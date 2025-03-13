<?php
// customer_login.php
include 'db.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assume a database connection is established
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch customer details from database
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);
    $customer = mysqli_fetch_assoc($result);

    if ($customer && password_verify($password, $customer['password'])) {
        $_SESSION['customer_id'] = $customer['id'];
        header("Location: customer_dashboard.php");
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Login - PharmEasy Clone</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="main.php">Home</a></li>	
            <li><a href="customer_dashboard">Customer</a></li>
		    <li><a href="customer_register.php">Register</a></li>
        </ul>
    </nav>
</header>
<main>
    <h1>Customer Login</h1>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST" action="customer_login.php">
        Email: <input type="email" name="email" required><br>
        Password: <input type="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
</main>
</body>
</html>