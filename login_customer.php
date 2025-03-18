<?php
include 'm_header.php';
include 'db.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password' AND approved=1 AND role='customer'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
    $role = $_SESSION['user']['role'];

        $_SESSION['user'] = mysqli_fetch_assoc($result);
        $role = $_SESSION['user']['role'];
        
        if ($role == 'admin') {
            header('Location: dashboard.php');
        } elseif ($role == 'stores') {
            header('Location: seller_dashboard.php');
        }elseif ($role == 'customer') {
            header('Location: customer_dashboard.php');
        }
         else {
          header('Location: main.php');
        }
        exit; // Ensure the script stops after redirection
    } else {
        echo '<br> <br> <br> <div style="color: red; text-align: center; font-size: 18px;">Invalid username or password, or your account is not approved yet.</div>';
    }

}
?>
<center> 
<div class="container">
<br> <br> 
    <h1>Customer - Login</h1>
    <form method="POST" action="login_customer.php">
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
    </form>
</div>
</center>
<?php
include 'footer.php';
?>