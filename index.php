<?php
session_start();
include('includes/config.php');
error_reporting(0);



?>


<!DOCTYPE HTML>
<html lang="en">

<head>

  <title>Bachelor Platform</title>
  <!--Bootstrap -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
  <link rel="stylesheet" href="assets/css/style.css" type="text/css">
  <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
  <link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
  <link href="assets/css/slick.css" rel="stylesheet">
  <link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
  <link href="assets/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all"
    data-default-color="true" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />
  <link rel="apple-touch-icon-precomposed" sizes="144x144"
    href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114"
    href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
  <link rel="apple-touch-icon-precomposed" sizes="72x72"
    href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">

  <style>
    .custom-card:hover {
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
      /* Add shadow on hover */
      transform: translateY(-5px);
      /* Lift card slightly on hover */
      transition: all 0.3s ease-in-out;
    }

    .custom-card img {
      border-top-left-radius: 10px;
      /* Rounded corners for the image */
      border-top-right-radius: 10px;
    }

    .custom-card {
      border: none;
      /* Remove default border */
      border-radius: 10px;
      /* Smooth card corners */
      overflow: hidden;
      /* Clip overflowing content */
    }

    .custom-card .card-body {
      padding: 20px;
      /* Add padding inside the card */
    }

    .custom-card h5 {
      color: #007bff;
      /* Make the title stand out */
      font-weight: bold;
    }

    .custom-card .text-muted {
      color: #6c757d;
      font-style: italic;
      /* Slightly unique styling for the small text */
    }
  </style>
</head>

<body>

  <!-- Start Switcher -->
  <?php include('includes/colorswitcher.php'); ?>
  <!-- /Switcher -->

  <!--Header-->
  <?php include('includes/header.php'); ?>
  <!-- /Header -->

  <!-- Banners -->
  <section id="banner" class="banner-section">
    <div class="container">
      <div class="div_zindex">
        <div class="row">
          <div class="col-md-5 col-md-push-7">
            <div class="banner_content">
              <h1>&nbsp;</h1>
              <p>&nbsp; </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /Banners -->


  <!-- Resent Cat-->
  <section class="section-padding gray-bg">
    <div class="container" >
      <div class="section-header text-center">
        <h2>Find the Best <span>Service For You</span></h2>
        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in
          some form, by injected humour, or randomised words which don't look even slightly believable. If you are going
          to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of
          text.</p>
      </div>
      <div class="row" >

        <!-- Nav tabs -->
        <div class="recent-tab">
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#resentnewcar" role="tab" data-toggle="tab">New Seats</a>
            </li>
          </ul>
        </div>
        <!-- Recently Listed New Cars -->
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="resentnewcar">

            <?php $sql = "SELECT seats.SeatTitle,area.BrandName,seats.PricePerMonth,seats.BudgetType,seats.Year,seats.id,seats.SeatingCapacity,seats.SeatArea,seats.Vimage1 from seats join area on area.id=seats.SeatArea limit 9";
            $query = $dbh->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            $cnt = 1;
            if ($query->rowCount() > 0) {
              foreach ($results as $result) {
                ?>

                <div class="col-list-3">
                  <div class="recent-car-list">
                    <div class="car-info-box"> <a href="seat-details.php?vhid=<?php echo htmlentities($result->id); ?>"><img
                          src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1); ?>" class="img-responsive"
                          alt="image"></a>
                      <ul>
                        <li><i class="fa fa-money" aria-hidden="true"></i><?php echo htmlentities($result->BudgetType); ?>
                        </li>
                        <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->Year); ?> </li>
                        <li><i class="fa fa-user"
                            aria-hidden="true"></i><?php echo htmlentities($result->SeatingCapacity); ?> seats</li>
                      </ul>
                    </div>
                    <div class="car-title-m">
                      <h6><a href="seat-details.php?vhid=<?php echo htmlentities($result->id); ?>">
                          <?php echo htmlentities($result->SeatTitle); ?></a></h6>
                      <span class="price">৳<?php echo htmlentities($result->PricePerMonth); ?> /Month</span>
                    </div>
                    <div class="inventory_info_m">
                      <p><?php echo substr($result->SeatOverview, 0, 70); ?></p>
                    </div>
                  </div>
                </div>
              <?php }
            } ?>

          </div>
        </div>
      </div>



  </section>
  <!-- /Resent Cat --> 

  <section class="section-padding gray-bg">

  <div class="container" style="margin-bottom: 80px;"> <!-- Add margin-bottom for spacing -->
    <a href="m_index.php" class="text-decoration-none">
      <div class="card custom-card mb-4" style="height: auto; max-height: 420px; overflow: hidden; display: flex; flex-direction: column; justify-content: space-between;">
        <img src="assets/images/mindex.webp" class="card-img-top" alt="Sample Image" style="max-height: 240px; object-fit: cover;">
        <div class="card-body" style="padding: 10px;">
          <h5 class="card-title" style="font-size: 3rem; margin-bottom: 5px;">Bachelor Meal Management</h5>
          <p class="card-text" style="font-size: 1.4rem; margin-bottom: 5px;">
            Simplify your meal planning and tracking with our Bachelor Meal Management system. Perfect for students and professionals looking to manage meals efficiently while saving time and reducing food waste.
          </p>
          <p class="card-text" style="font-size: 0.75rem; margin-bottom: 0;">
            <small class="text-muted"></small>
          </p>
        </div>
      </div>
    </a>
  </div>

  <div class="container" style="margin-top: 80px;"> <!-- Add margin-top for spacing -->
    <a href="community_group1.php" class="text-decoration-none">
      <div class="card custom-card mb-4" style="height: auto; max-height: 420px; overflow: hidden; display: flex; flex-direction: column; justify-content: space-between;">
        <img src="assets/images/community-banner.jpg" class="card-img-top" alt="Sample Image" style="max-height: 240px; object-fit: cover;">
        <div class="card-body" style="padding: 10px;">
          <h5 class="card-title" style="font-size: 3rem; margin-bottom: 5px;"> Join Community Group</h5>
          <p class="card-text" style="font-size: 1.4rem; margin-bottom: 5px;">
            Connect with like-minded individuals in your community. Share ideas, collaborate on projects, and grow your network in a welcoming and inclusive space.
          </p>
          <p class="card-text" style="font-size: 0.75rem; margin-bottom: 0;">
            <small class="text-muted"></small>
          </p>
        </div>
      </div>
    </a>
  </div>

  <div class="container" style="margin-top: 80px;"> <!-- Add margin-top for spacing -->
    <a href="buy-sell.php" class="text-decoration-none">
      <div class="card custom-card mb-4" style="height: auto; max-height: 420px; overflow: hidden; display: flex; flex-direction: column; justify-content: space-between;">
        <img src="assets/images/bs.png" class="card-img-top" alt="Sample Image" style="max-height: 240px; object-fit: cover;">
        <div class="card-body" style="padding: 10px;">
          <h5 class="card-title" style="font-size: 3rem; margin-bottom: 5px;"> Buy sell Products</h5>
          <p class="card-text" style="font-size: 1.4rem; margin-bottom: 5px;">
            A hassle-free platform for buying and selling products. From everyday essentials to unique finds, discover amazing deals or reach potential buyers with ease.
          </p>
          <p class="card-text" style="font-size: 0.75rem; margin-bottom: 0;">
            <small class="text-muted"></small>
          </p>
        </div>
      </div>
    </a>
  </div>

</section>






  <!-- Fun Facts-->
  <section class="fun-facts-section">
    <div class="container div_zindex">
      <div class="row">
        <div class="col-lg-3 col-xs-6 col-sm-3">
          <div class="fun-facts-m">
            <div class="cell">
              <h2><i class="fa fa-calendar" aria-hidden="true"></i>1+</h2>
              <p>Years In Business</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6 col-sm-3">
          <div class="fun-facts-m">
            <div class="cell">
              <h2><i class="fa fa-building" aria-hidden="true"></i>12+</h2>
              <p>New Seat available</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6 col-sm-3">
          <div class="fun-facts-m">
            <div class="cell">
              <h2><i class="fa fa-data" aria-hidden="true"></i>100+</h2>
              <p> Accessories For Sale</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6 col-sm-3">
          <div class="fun-facts-m">
            <div class="cell">
              <h2><i class="fa fa-user-circle-o" aria-hidden="true"></i>10+</h2>
              <p>Satisfied Customers</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Dark Overlay-->
    <div class="dark-overlay"></div>
  </section>
  <!-- /Fun Facts-->


  <!--Testimonial -->
  <section class="section-padding testimonial-section parallex-bg">
    <div class="container div_zindex">
      <div class="section-header white-text text-center">
        <h2>Our Satisfied <span>Bachelors</span></h2>
      </div>
      <div class="row">
        <div id="testimonial-slider">
          <?php
          $tid = 1;
          $sql = "SELECT testimonial.Testimonial,users.FullName from testimonial join users on testimonial.UserEmail=users.EmailId where testimonial.status=:tid limit 4";
          $query = $dbh->prepare($sql);
          $query->bindParam(':tid', $tid, PDO::PARAM_STR);
          $query->execute();
          $results = $query->fetchAll(PDO::FETCH_OBJ);
          $cnt = 1;
          if ($query->rowCount() > 0) {
            foreach ($results as $result) { ?>


              <div class="testimonial-m">

                <div class="testimonial-content">
                  <div class="testimonial-heading">
                    <h5><?php echo htmlentities($result->FullName); ?></h5>
                    <p><?php echo htmlentities($result->Testimonial); ?></p>
                  </div>
                </div>
              </div>
            <?php }
          } ?>



        </div>
      </div>
    </div>
    <!-- Dark Overlay-->
    <div class="dark-overlay"></div>
  </section>
  <!-- /Testimonial-->


  <!--Footer -->
  <?php include('includes/footer.php'); ?>
  <!-- /Footer-->

  <!--Back to top-->
  <div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
  <!--/Back to top-->

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