<?php
include_once 'database/Session.php';
Session::checkSession();

?>
<?php include("database/Formet.php");
$fm = new Format();
?>


<?php include_once 'database/Connection.php';
$ob = new Database();
?>
<?php


if (isset($_POST['submit'])) {
  $mname = $_POST['mname'];
  $password = $_POST['password'];


  $email = Session::get("email");
  $query2 = "UPDATE reg SET mname='$mname',password='$password' WHERE email='$email' ";


  $result2 = $ob->update($query2);

  if ($result2) {
    $msg = "<div class='alert alert-success'><span>Updated Successfully</span></div>";

  } else {
    $msg = "<div class='alert alert-danger'><span>Please Try Again!</span></div>";

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
  <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">

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
      width: 177px;
    }

    .form2 {
      max-width: 100%;
      max-width: 416px;
      margin: 0 auto;
      display: block;
      margin-top: 8px;
      border: 10px solid #ddd;
      border-radius: 10px;
      background: #d1d1d166;
      margin-bottom: 30px;
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
    }


    label {
      display: inline-block;
      margin-bottom: 0.5rem;
      font-size: 21px;
      font-family: 'Acme';
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
      font-family: 'Acme';
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

    .indi {
      box-shadow: 0px 2px 3px 4px #c2c3c5;
      padding-top: 20px;
      padding-bottom: 20px;
      margin-top: 13px;
      border-radius: 6px;
      background: #e1e6ea;
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

    .basic {
      text-align: center;
      padding-top: 28px;
      background: #efefef;
      /* color: #f0212166; */
      color: #000;
      padding-bottom: 28px;
      box-shadow: 0px 5px 7px #c9ced4;
      margin-top: 11px;
      margin-bottom: 12px;
      border-radius: 1px;
    }

    .extra {
      background: #f2f2f2;
      margin-top: 8px;
      box-shadow: 0px 2px 3px #a4a4a4;
      padding-top: 10px;
      padding-bottom: 10px;
    }

    .yourElement {

      animation-delay: 1s;

    }

    .yourElement1 {

      animation-delay: 2.5s;

    }

    .yourElement2 {

      animation-delay: 3s;

    }

    .yourElement3 {
      animation-delay: 4s;
    }

    .yourElement4 {
      animation-delay: 5.5s;
    }

    .img1 {
      border-style: none;
      width: 60px;
      height: 60px;
      border-radius: 50px;
      margin: 0 auto;
      display: block;
      /* padding-top: 10px; */
      margin-top: -9px;
    }
  </style>
</head>

<body>
  <?php if (isset($_GET['action']) && $_GET['action'] == 'logout')
    Session::destroy();

  ?>
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
            <div class="header_widgets">
              <div class="circle_icon" style="display: inline-block;">
                <i class="fa fa-envelope" aria-hidden="true"></i>
              </div>
              <p class="uppercase_text" style="display: inline-block; margin-left: 10px;">For Support Mail us: </p>
              <a href="mailto:info@gmail.com" style="display: inline-block; margin-left: 5px;">info@gmail.com</a>
            </div>
            <div class="header_widgets">
              <div class="circle_icon" style="display: inline-block;">
                <i class="fa fa-phone" aria-hidden="true"></i>
              </div>
              <p class="uppercase_text" style="display: inline-block; margin-left: 10px;">Service Helpline Call Us: </p>
              <a href="tel:01717117171" style="display: inline-block; margin-left: 5px;">01717117171</a>
            </div>
            <div class="social-follow"></div>

  
          </div>
        </div>
        <p style="font-weight: bold; margin-top: 10px;">Welcome to Bachelor Platform's Meal Management</p>
      </div>
    </div>
  </div>

<!-- Navbar -->
  <nav class="navbar navbar-expand-lg" style="background-color: black;">
    <div class="container-fluid"> 
      <a class="navbar-brand" href="home.php" style="color: white; font-weight: bold; font-size: 18px;">Meal Management Home</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon" style="color: white;"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="members.php"
              style="color: white; font-weight: bold;">Members</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="bazarshedule.php" style="color: white; font-weight: bold;">Bazar Schedule</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="bazarcost.php" style="color: white; font-weight: bold;">Bazar Cost</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="transition1.php" style="color: white; font-weight: bold;">Calculation</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" style="color: white; font-weight: bold;">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>



  <div class="container">


    <div class="basic">
      <h3 style="text-align: center;" class="animated rubberBand bounce">Welcome <?php
      $email = Session::get("email");
      $query1 = "SELECT*FROM reg WHERE email='$email' ";
      $result1 = $ob->select($query1);
      if ($result1 && $result1->num_rows > 0) {
        $row1 = $result1->fetch_assoc();
        echo $row1['mname'];
      } else {
        echo "User not found";
      }

      ?> To

        <?php echo Session::get("messname"); ?> Mess
      </h3>
    </div>

    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ecf2836a2d5b22c"></script>


    <!-- Cards -->
    <div class="container">
      <div class="row" style="margin: 50px 0;">
      <div class="col-md-4">
        <div class="card" style="width: 22rem; height: 30rem;">
        <img src="assets/images/add-member.png" class="card-img-top" alt="..."
          style="height: 15rem; object-fit: cover;">
        <div class="card-body">
          <h5 class="card-title">Add Member to Room</h5>
          <p class="card-text">Add a new member to the room and manage their details.</p>
          <a href="addmember.php" class="btn btn-primary">Add Member</a>
        </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card" style="width: 22rem; height: 30rem;">
        <img src="assets/images/deposit.png" class="card-img-top" alt="..."
          style="height: 15rem; object-fit: cover;">
        <div class="card-body">
          <h5 class="card-title">Deposit as Bazar</h5>
          <p class="card-text">Deposit funds for the bazar and keep track of expenses.</p>
          <a href="deposit.php" class="btn btn-primary">Deposit</a>
        </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card" style="width: 22rem; height: 30rem;">
        <img src="assets/images/meal-count.png" class="card-img-top" alt="..."
          style="height: 15rem; object-fit: cover;">
        <div class="card-body">
          <h5 class="card-title">Daily Meal Count</h5>
          <p class="card-text">Record and manage the daily meal count for all members.</p>
          <a href="mcount.php" class="btn btn-primary">Count Meal</a>
        </div>
        </div>
      </div>
      </div>
    </div>


  </div>

  <div class="container" style="padding: 20px 10px; background: rgb(248, 248, 247); max-width: 1120px; margin-bottom: 60px;">
    <h4 style="text-align: center;">
      <p class="animated bounce yourElement3">Update Info</p>
    </h4>
    <div style="text-align: center;"> <!-- Added this div to center the button -->
      <button type="button" class="btn animated flip yourElement4"
        style="color: rgb(228, 226, 226); background-color: rgb(59, 167, 182); border-color: #d4e4e2;"
        data-toggle="modal" data-target="#myModal">
        Update
      </button>
    </div>
    <div class="modal" id="myModal">
      <div class="modal-dialog" style="background: #eff0f0;">
        <div class="modal-content">

          <!-- Modal body -->
          <div class="modal-body">
            <div class="container" style="margin-bottom: 80px;">
              <div>
                <h3 class="form3">Update Manager Information</h3>
                <form action=" " method="post">
                  <?php
                  if (isset($msg)) {
                    echo $msg;
                  }
                  ?>
                  <?php
                  $email = Session::get("email");
                  $query1 = "SELECT*FROM reg WHERE email='$email' ";
                  $result1 = $ob->select($query1);
                  $row1 = $result1->fetch_assoc();
                  ?>
                  <div class="form-group">
                    <label for="email" class="text-center">Manager Name</label>
                    <input type="text" class="form-control" id="email" name="mname"
                      value="<?php echo $row1['mname']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="pwd">Change Password</label>
                    <input type="text" class="form-control" id="password" name="password"
                      value="<?php echo $row1['password']; ?>">
                  </div>
                  <div class="form-group">
                    <input class="btn btn-success" type="submit" name="submit" value="Update">
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>







  </div>
  <div class="sharethis-sticky-share-buttons"></div>




  <!--Footer -->
  <?php include('includes/footer.php'); ?>
  <!-- /Footer-->

  <script>
    var a2a_config = a2a_config || {};
    a2a_config.linkname = 'Meal-Management';
    a2a_config.linkurl = 'https://meal-management.000webhostapp.com/home.php';
  </script>

  <script async src="https://static.addtoany.com/menu/page.js"></script>

</body>

</html>