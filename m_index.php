<?php
ob_start();
include("database/Session.php");


?>
<?php require("database/Connection.php");
$ob = new Database();
?>

<?php

if (isset($_POST['submit'])) {

  $email = $_POST['email'];
  $password = $_POST['password'];
  $email = mysqli_real_escape_string($ob->link, $email);
  $password = mysqli_real_escape_string($ob->link, $password);

  $query = "SELECT*FROM reg WHERE email='$email' AND password='$password' ";
  $result = $ob->select($query);
  $row = $result->fetch_assoc();
  if (empty($email) || empty($password)) {
    $msg = "<div class='alert alert-danger'><span>Field Must Not Be Empety!</span></div>";
  } elseif ($row && $row['active'] == '0') {
    $msg = "<div class='alert alert-danger'><span>Your id is disabled!</span></div>";
  } else {
    $query = "SELECT*FROM reg WHERE email='$email' AND password='$password' ";
    $result = $ob->select($query);
    if ($row = $result->fetch_assoc()) {
      Session::init();
      Session::set("login", true);
      Session::set("email", $row['email']);
      Session::set("messname", $row['messname']);
      if (!empty($_POST["remember"])) {
        setcookie("email", $_POST["email"], time() + (10 * 365 * 24 * 60 * 60));
        setcookie("password", $_POST["password"], time() + (10 * 365 * 24 * 60 * 60));
      } else {
        if (5 < 6) {
          setcookie("email", "");
          setcookie("password", "");
        }
      }



      echo "<script>window:location='home.php'</script>";
    } else {
      $msg = "<div class='alert alert-danger'><span>Password Or Mess Email Wrong!</span></div>";
    }
  }
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
  <title>Meal Management</title>
  <link rel="icon" href="img/logo1.png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/stylem.css">
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">



  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript"
    src="https://platform-api.sharethis.com/js/sharethis.js#property=5e9f00b93c7b5a00124be21a&product=inline-share-buttons"
    async="async"></script>


  <!--Custome Style -->
  <link rel="stylesheet" href="assets/css/style.css" type="text/css">
  <!--OWL Carousel slider-->
  <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
  <link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
  <!--slick-slider -->
  <link href="assets/css/slick.css" rel="stylesheet">
  <!--bootstrap-slider -->
  <link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
  <!--FontAwesome Font Style -->




  <link rel="stylesheet" type="text/css" href="css/animate.css">
  <link rel="apple-touch-icon-precomposed" sizes="144x144"
    href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114"
    href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
  <link rel="apple-touch-icon-precomposed" sizes="72x72"
    href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
  <script>
    (adsbygoogle = window.adsbygoogle || []).push({
      google_ad_client: "ca-pub-7472876793649569",
      enable_page_level_ads: true
    });
  </script>
  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
  <script>
    (adsbygoogle = window.adsbygoogle || []).push({
      google_ad_client: "pub-7472876793649569",
      enable_page_level_ads: true
    });
  </script>
  <style type="text/css">
    body {
      font-family: 'Lato', sans-serif;
      margin: 0px;
      padding: 0px !important;
      overflow-x: hidden;
      color: #555555;

    }

    * {
      font-family: 'Lato', sans-serif;
    }

    .navbar-dark .navbar-nav .active>.nav-link:hover {

      color: red;

    }

    .navbar-dark .navbar-nav .nav-link:hover {
      color: rgba(251, 6, 6, 0.75);
    }

    .dropdown .dropdown-menu .dropdown-item:hover {
      background: #D6E0E0;
      color: black;
      display: block;
    }

    .navbar-dark .navbar-nav .nav-item {
      width: 180px;
    }

    .form2 {
      max-width: 100%;
      max-width: 416px;
      margin: 0 auto;
      display: block;
      margin-top: 8px;
      border: 10px solid #f2f2f2;
      border-radius: 10px;
      background: #fff6;
      margin-bottom: 30px;
      box-shadow: 0px 2px 3px 4px #d7d7d7;

      font-weight: bold;
      color: #456;

    }

    .form3 {
      font-size: 2rem;
      text-align: center;
      padding-top: 10px;
      box-sizing: border-box;
      /* box-shadow: 0px 3px; */
      border-bottom: 11px solid #d2d2d2;
      text-shadow: 2px 3px 2px #9b8b7f;
      padding-bottom: 4px #456;

      border-radius: 52px;
      padding-bottom: 6px;
      font-weight: bold;
      color: #456
    }


    label {
      display: inline-block;
      margin-bottom: 0.5rem;
      font-size: 21px;
      font-family: 'Lato';
      text-align: center;
    }

    .footer {
      background: #0FA187;
      height: auto;
      color: #d2d2d2;
      padding-bottom: 42px;
      padding-top: 41px;
      text-align: center;
    }

    .facebooklogo {
      font-size: 2rem;
      width: 40px;
      height: 40px;
      background: #3560B7;
      border-radius: 50px;

      color: #fefefe;
    }

    .navbar-dark .navbar-brand {
      color: red;
      width: 70px;
      height: 70px;
      border-radius: 50px;

    }

    .dropdown .dropdown-menu .dropdown-item {
      background: #EFF2F1;
      color: #d53131;
      display: block;
      font-family: 'Lato';
      font-size: 20px;
    }

    img {
      border-style: none;
      width: 99px;
      height: 82px;
      border-radius: 50px;
      margin: 0 auto;
      display: block;
      /* padding-top: 10px; */
      margin-top: -9px;
    }


    .navbar-dark .navbar-nav .show>.nav-link,
    .navbar-dark .navbar-nav .active>.nav-link,
    .navbar-dark .navbar-nav .nav-link.show,
    .navbar-dark .navbar-nav .nav-link.active {
      color: #d81313;
    }

    .navbar-dark .navbar-nav .nav-link {
      color: rgba(242, 18, 18, 0.5);
      font-size: 20px;
      padding: 10px 16px;
    }

    .footer {
      background: #F2F2F2;
      margin-top: 18px;
      outline-offset: 5px;
      outline: 4px solid #e7e6e6;
      border-radius: 6px;
      color: #0B8D8D;
    }

    .face {
      width: 35px;
      height: 35px;
      border-radius: 62px;
      background: #085bae;
      color: #f5eeee;
      margin: 0 auto;
      display: block;
      text-align: center;
      padding-top: 2px;
      margin-bottom: 6px;
      font-size: 26px;
      display: inline-block;
    }

    .form-control {

      color: #456;

    }
  </style>
</head>

<body>

  <!-- Deafault header -->
  <div class="default-header">
    <div class="container">
      <div class="row">
        <div class="col-sm-3 col-md-2">
          <div class="logo">
            <a href="index.php">
              <img src="assets/images/logo.jpg" alt="image" style="width: 200px; height: auto;" />
            </a>
          </div>
        </div>
        <div class="col-sm-9 col-md-10">
          <div class="header_info">

            <div class="header_widgets_container" style="display: flex; gap: 30px;">
              <div class="header_widgets">
                <div class="circle_icon">
                  <i class="fa fa-envelope" aria-hidden="true"></i>
                </div>
                <p class="uppercase_text">For Support Mail us: </p>
                <a href="mailto:info@gmail.com">info@gmail.com</a>
              </div>

              <div class="header_widgets">
                <div class="circle_icon">
                  <i class="fa fa-phone" aria-hidden="true"></i>
                </div>
                <p class="uppercase_text">Service Helpline Call Us: </p>
                <a href="tel:01717117171">01717117171</a>
              </div>
            </div>



          </div>
        </div>
        <p style="font-weight: bold; margin-top: 10px;">Welcome to Bachelor Platform's Meal Management</p>
      </div>
    </div>
  </div>

  <!-- nav -->
  <nav class="navbar navbar-expand-lg" style="background-color: black;">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav" style="gap: 30px;">
            <li class="nav-item">
            <a class="nav-link" href="index.php" style="color: white; font-weight: normal;">
              <i class="fa fa-home fa-lg" aria-hidden="true"></i>
            </a>
            <li class="nav-item">
            <a class="nav-link" href="contact-us.php" style="color: white; font-weight: bold;">Contact Us</a>
            </li>
            </li>
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="seat-listing.php" style="color: white; font-weight: bold;">Seat Listing</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="community_group1.php" style="color: white; font-weight: bold;">Community Group</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="buy-sell.php" style="color: white; font-weight: bold;">Buy Sell</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="m_index.php" style="color: white; font-weight: bold;">Meal Management</a>
            </li>
            
            <li class="nav-item">
            <div class="header_search">
              <div id="search_toggle"><i class="fa fa-search" aria-hidden="true"></i></div>
              <form action="search.php" method="post" id="header-search-form">
              <input type="text" placeholder="Search..." name="searchdata" class="form-control" required="true">
              <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
              </form>
            </div>
            </li>
        </ul>
      </div>
    </div>
  </nav>





  <section class="m-index-header listing_page">
    <div class="container">
      <div class="page-header_wrap">
        <div class="page-heading">
          <h1>Meal Management</h1>
        </div>
        <ul class="coustom-breadcrumb">
          <li><a href="index.php">Home</a></li>
          <li>Login Meal Management</li>
        </ul>
      </div>
    </div>
    <!-- Dark Overlay-->
    <div class="dark-overlay"></div>
  </section>






  <div class="container animated slideInLeft ">
    <div class="form2 slide ">

      <h2 class="form3 animated  rotateInDownRight">Log In</h2>
      <form action="m_index.php" method="post">
        <?php
        if (isset($msg)) {
          echo $msg;
        }
        ?>
        <div class="form-group animated bounceInLeft">
          <label for="email" class="text-center">Email address</label>

          <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php if (isset($_COOKIE["email"])) {
                                                                                                        echo $_COOKIE["email"];
                                                                                                      } ?>">
        </div>
        <div class="form-group animated bounceInRight">
          <label for="pwd">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?php if (isset($_COOKIE["password"])) {
                                                                                                                    echo $_COOKIE["password"];
                                                                                                                  } ?>">
        </div>
        <div class="form-group form-check animated rollIn">
          <label class="form-check-label">
            <input name="remember" class="form-check-input" type="checkbox" <?php if (isset($_COOKIE["password"])) { ?> checked <?php } ?> /> Remember me
          </label>
        </div>
        <div class="form-group">

          <button type="submit" class="btn btn-success animated slideInLeft " name="submit">Submit</button>
        </div>
        <div class="form-group">
          <a href="reg.php" style="float: right;margin-top: -80px;">Register Now</a>
        </div>
        <div class="form-group">
          <a href="#" style="float: right;margin-top: -26px;">Forget Password?</a>
        </div>
      </form>
    </div>

  </div>

  <div class="container-fluid" style="padding-right:0px;padding-left:0px;">
    <div class="footer">
      <div class="row">




      </div>
    </div>
  </div>
  <!--Footer -->
  <?php include('includes/footer.php'); ?>
  <!-- /Footer-->
  <!--Login-Form -->
  <?php include('includes/login.php'); ?>
  <!--/Login-Form -->

  <!--Register-Form -->
  <?php include('includes/registration.php'); ?>

  <!--/Register-Form -->

  <!--Forgot-password-Form -->
  <?php include('includes/forgotpassword.php'); ?>
  <!--/Forgot-password-Form -->

  <!-- Scripts -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/interface.js"></script>
  <!--Switcher-->
  <script src="assets/switcher/js/switcher.js"></script>
  <!--bootstrap-slider-JS-->
  <script src="assets/js/bootstrap-slider.min.js"></script>
  <!--Slider-JS-->
  <script src="assets/js/slick.min.js"></script>
  <script src="assets/js/owl.carousel.min.js"></script>


</body>

</html>