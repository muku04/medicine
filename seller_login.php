<?php
// seller_login.php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assume a database connection is established
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch seller details from database
    $query = "SELECT * FROM sellers WHERE email='$email'";
    $result = mysqli_query($conn, $query);
    $seller = mysqli_fetch_assoc($result);

    if ($seller && password_verify($password, $seller['password'])) {
        $_SESSION['seller_id'] = $seller['id'];
        header("Location: seller_dashboard.php");
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
    <title>Seller Login - PharmEasy Clone</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="main.php">Home</a></li>
            <li><a href="seller_dashboard.php">Seller</a></li>
            <li><a href="seller_register.php">Register</a></li>
        </ul>
    </nav>
</header>
<main>
    <h1>Seller Login</h1>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST" action="seller_login.php">
        Email: <input type="email" name="email" required><br>
        Password: <input type="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
</main>
</body>
</html>