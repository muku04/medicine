<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard - PharmEasy Clone</title>
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
// Use the correct session variable to check if the user is logged in and has the 'stores' role
if (!isset($_SESSION['user']['username']) || $_SESSION['user']['role'] != 'stores') {
    header("Location: login_seller.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmEasy Clone</title>
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

<body>

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
              <li><a href="main1.php">Home</a></li>
            <li><a href="seller_dashboard.php">Dashboard</a></li>
            <li><a href="seller_addmedicine.php">Manage Medicine</a></li>
            <li><a href="sellermanage_orders.php">Manage Orders</a></li>
            <li><a href="logout.php">Logout</a></li>
            <li><font color="black"><span>Welcome, <?php echo $_SESSION['user']['username']; ?>!</span> </font></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>

   
 

</body>