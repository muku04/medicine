<?php
session_start();  // Start session at the top of the file
include 'm_header.php';
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND role='admin'");
    $stmt->bind_param("s", $username); // "s" stands for string (username)
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Setting session variables
            $_SESSION['user'] = $row;  // Store entire user data
            header("Location: dashboard.php");
            exit; // Make sure to stop further execution after the redirect
        } else {
            echo "Invalid password.";
        }
    } else {
        echo '<br><br><br><div style="color: red; text-align: center; font-size: 18px;">No admin found with that username.</div>';
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
<center> 
    <h2>Admin Login</h2>
    <form method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
</center>
</body>
</html>
