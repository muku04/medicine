<?php
include 'db.php';

session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: login_seller.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $query = "UPDATE users SET approved = !approved WHERE id = '$user_id'";
    if (mysqli_query($conn, $query)) {
        $store_query = "UPDATE stores SET approved = !approved WHERE user_id = '$user_id'";
        mysqli_query($conn, $store_query);
        header('Location: manage_users.php');
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>