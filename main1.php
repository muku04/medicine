<?php
include 'db.php';

// Fetch products from the database
$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Pharma &mdash; Colorlib Template</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Rubik:400,700|Crimson+Text:400,400i" rel="stylesheet">
  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">


  <link rel="stylesheet" href="css/aos.css">

  <link rel="stylesheet" href="css/style.css">

</head>

<body>


    <div class="site-section bg-secondary bg-image" style="background-image: url('images/bg_2.jpg');">
      <div class="container">
        <div class="row align-items-stretch">
            <div class="col-lg-4 mb-5 mb-lg-0">
                <a href="customer_navigation.php" class="banner-1 h-100 d-flex" style="background-image: url('images/bg_1.jpg');">
                    <div class="banner-1-inner align-self-center">
                        <h2>Customer </h2>
                        <p>Welcome all the customer. You can make your purchase of Medicines here</p>
                    </div>
                </a>
            </div>
                    
            <div class="col-lg-4 mb-5 mb-lg-0">
                <a href="seller_navigation.php" class="banner-1 h-100 d-flex" style="background-image: url('images/bg_1.jpg');">
                    <div class="banner-1-inner align-self-center">
                        <h2>Seller </h2>
                        <p>Welcome all the Seller. You can add your Medicines here</p>
                    </div>
                </a>
            </div>
            
            <div class="col-lg-4 mb-5 mb-lg-0">
                <a href="admin_navigation.php" class="banner-1 h-100 d-flex" style="background-image: url('images/bg_1.jpg');">
                    <div class="banner-1-inner align-self-center">
                        <h2>Admin Login</h2>
                        <p>Welcome all the Admins. You can manage your dashboard here</p>
                    </div>
                </a>
            </div>
        </div>
      </div>
    </div>



    <div class="site-wrap">
        <div class="site-navbar py-2">
            <div class="site-blocks-cover" style="background-image: url('images/hero_1.jpg');">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 mx-auto order-lg-2 align-self-center">
                            <div class="site-block-cover-content text-center">
                                <h2 class="sub-title">Effective Medicine, New Medicine Everyday</h2>
                                <h1>Welcome To Pharma</h1>
                                <p>
                                    <a href="login_customer.php" class="btn btn-primary px-5 py-3">Shop Now</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="title-section text-center col-12">
            <h2 class="text-uppercase">Popular Products</h2>
          </div>
        </div>

        <div class="row">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="col-sm-6 col-lg-4 text-center item mb-4">
            <a href="view_detail_medicine.php?id=<?php echo $row['id']; ?>"> 
            <img src="<?php echo $row['image']; ?>" alt="Product Image" >    
            </a>
            <h3 class="text-dark"><a href="shop-single.html"><?php echo $row['name']; ?></a></h3>
            <p class="price">Price : <?php echo $row['price']; ?></p>
            </div>
            <?php } ?>
      </div>
    </div>




</body>