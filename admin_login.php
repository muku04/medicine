<?php
include 'm_header.php';
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND role='admin'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];
            header("Location: dashboard.php");
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No admin found with that username.";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
<header>
    <nav>
        <ul><!--
            <li><a href="logout.php">Logout</a></li>
            <li><a href="admin_header.php">Admin</a></li>
            <li><a href="admin_register.php">Register</a></li>
-->
        </ul>
    </nav>
</header>
    <h2>Admin Login</h2>
    <form method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>