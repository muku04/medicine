<?php
include 'm_header.php';
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        session_start();
        $_SESSION['user'] = mysqli_fetch_assoc($result);
        header('Location: main.php');
    } else {
        echo "Invalid username or password.";
    }
}
?>

<div class="container">
    <h1>Login</h1>
	<link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
    <form method="POST" action="login.php">
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
    </form>
</div>

<?php
include 'footer.php';
?>