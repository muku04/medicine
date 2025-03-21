<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard - PharmEasy Clone</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>

    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/aos.js"></script>

    <script src="js/main.js"></script>
</head>
<body>
<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'customer') {
    header('Location: login_customer.php');
    exit;
}
?>


<div class="site-wrap">


<div class="site-navbar py-2">

  <div class="search-wrap">
    <div class="container">
      <a href="#" class="search-close js-search-close"><span class="icon-close2"></span></a>
      <form action="#" method="post">
        <input type="text" class="form-control" placeholder="Search keyword and hit enter...">
      </form>
    </div>
  </div>

  <div class="container">
    <div class="d-flex align-items-center justify-content-between">
      <div class="logo">
        <div class="site-logo">
          <a href="main1.php" class="js-logo-clone">Pharma</a>
        </div>
      </div>
      <div class="main-nav d-none d-lg-block">
        <nav class="site-navigation text-right text-md-center" role="navigation">
          <ul class="site-menu js-clone-nav d-none d-lg-block">
          <li><a href="customer_dashboard.php">Dashboard</a></li>
           <!-- <li><a href="cusindex.php">Search Products</a></li>
            <li><a href="register_customer.php"> Register</a></li>
-->
            <li><a href="cart.php">Cart</a></li>
			
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</div>



