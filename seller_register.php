<?php
// seller_register.php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assume a database connection is established
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $mobile_no = $_POST['mobile_no'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $business_name = $_POST['business_name'];
    $business_mobile_no = $_POST['business_mobile_no'];
    $business_address = $_POST['business_address'];
    $business_email = $_POST['business_email'];
    $bank_name = $_POST['bank_name'];
    $account_no = $_POST['account_no'];
    $branch = $_POST['branch'];
    $ifsc_code = $_POST['ifsc_code'];

    // Insert seller request into the database
    $query = "INSERT INTO seller_requests (name, address, email, mobile_no, username, password, business_name, business_mobile_no, business_address, business_email, bank_name, account_no, branch, ifsc_code, status) 
              VALUES ('$name', '$address', '$email', '$mobile_no', '$username', '$password', '$business_name', '$business_mobile_no', '$business_address', '$business_email', '$bank_name', '$account_no', '$branch', '$ifsc_code', 'pending')";
    mysqli_query($conn, $query);

    echo "Registration request sent to admin.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Registration - PharmEasy Clone</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="main.php">Home</a></li>
        
            <li><a href="seller_login.php">Seller</a></li>
          
        </ul>
    </nav>
</header>
<main>
    <h1>Seller Registration</h1>
    <form method="POST" action="seller_register.php">
        <h2>Personal Details</h2>
        Name: <input type="text" name="name" required><br>
        Address: <textarea name="address" required></textarea><br>
        E-mail: <input type="email" name="email" required><br>
        Mobile No.: <input type="text" name="mobile_no" required><br>
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        
        <h2>Business Details</h2>
        Business Name: <input type="text" name="business_name" required><br>
        Business Mobile No.: <input type="text" name="business_mobile_no" required><br>
        Business Address: <textarea name="business_address" required></textarea><br>
        Business E-mail: <input type="email" name="business_email" required><br>
        
        <h2>Bank Details</h2>
        Bank Name: <input type="text" name="bank_name" required><br>
        Account No.: <input type="text" name="account_no" required><br>
        Branch: <input type="text" name="branch" required><br>
        IFSC Code: <input type="text" name="ifsc_code" required><br>
        
        <button type="submit">Register</button>
    </form>
</main>
</body>
</html>