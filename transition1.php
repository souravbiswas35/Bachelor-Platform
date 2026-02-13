<?php
include_once 'database/Session.php';
Session::checkSession();

?>

<?php $msg = ""; ?>
<?php

include("database/Formet.php");
$fm = new Format();
include_once 'database/Connection.php';
$ob = new Database();
?>
<?php
if (isset($_GET["delete"])) {
  $phone = $_GET["delete"];


  $query = "DELETE FROM bazardate WHERE phone='$phone'";
  $result = $ob->delete($query);

  if ($result) {
    $msg = "<div style='text-align:center;margin-top:5px;' class='alert alert-success alert-dismissible'>
    <button type='button' class='close' data-dismiss='alert'>&times;</button>Successfully Deleted!
  </div>";

  } else {
    $msg = "<div class='alert alert-danger'><span>Please Try Again!</span></div>";

  }
}

?>
<?php
if (isset($_GET["deleteD"])) {
  $phone1 = $_GET["deleteD"];
  $date1 = $_GET["deleteD1"];

  $query1 = "DELETE FROM deposit WHERE phone='$phone1' AND date1='$date1'";
  $result1 = $ob->delete($query1);

  if ($result1) {
    $msg1 = "<div style='text-align:center;margin-top:5px;' class='alert alert-success alert-dismissible'>
    <button type='button' class='close' data-dismiss='alert'>&times;</button>Successfully Deleted!
  </div>";

  } else {
    $msg1 = "<div class='alert alert-danger'><span>Please Try Again!</span></div>";

  }
}

?>

<?php
if (isset($_GET['deleteB'])) {

  $phone2 = $_GET["deleteB"];


  $date2 = $_GET["deleteB1"];


  $query2 = "DELETE FROM bazarcost WHERE phone='$phone2' AND date1='$date2' ";
  $result2 = $ob->delete($query2);

  if ($result2) {
    $msg2 = "<div style='text-align:center;margin-top:5px;' class='alert alert-success alert-dismissible'>
    <button type='button' class='close' data-dismiss='alert'>&times;</button>Successfully Deleted!
  </div>";

  } else {
    $msg2 = "<div class='alert alert-danger'><span>Please Try Again!</span></div>";

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
      font-family: 'Lato';
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
      padding-top: 0px;
      /* background: #efefef; */
      /* color: #f0212166; */
      color: #000;
      padding-bottom: 0px;
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

    .addform {
      border: 9px solid #e9e9e9;
      padding: 36px 10px;
      box-shadow: 0px 5px 7px #c9ced4;
      margin-bottom: 10px;
      margin-top: 14px;
      background: #dee5ec;
      margin-left: -18px;
      margin-right: -18px;
    }

    .formmain {
      max-width: 600px;
      margin: 0px auto;
      display: block;
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

    table {
      font-family: "Lato", sans-serif;
    }

    #myDIV {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      background: red;
      -webkit-animation: mymove 2s infinite;
      animation: mymove 2s infinite;
      text-align: center;
      padding-top: 4px;
      color: #ddd;
    }

    /* Chrome, Safari, Opera */
    @-webkit-keyframes mymove {
      from {
        background-color: red;
      }

      to {
        background-color: blue;
      }
    }

    /* Standard syntax */
    @keyframes mymove {
      from {
        background-color: red;
      }

      to {
        background-color: blue;
      }
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
      <a class="navbar-brand" href="home.php" style="color: white; font-weight: bold; font-size: 18px;">Meal Management
        Home</a>
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
            <a class="nav-link" href="m_index.php" style="color: white; font-weight: bold;">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <?php
  error_reporting(0);
  $email = Session::get("email");

  $query = "SELECT*FROM addmember WHERE email='$email' ";
  $result = $ob->select($query);
  $able = mysqli_num_rows($result);
  if ($able <= 0) {
    ?>
    <div class="container">

      <h3 style="font-size: 1.75rem;padding: 93px 20px;text-align: center;color: red;">No Transaction Held Yet.Thanks</h3>
    </div>
  <?php } else { ?>




    <div class="container">

      <h3 style="text-align: center; margin-top:30px; font-family: 'Lato', cursive, sans-serif;">Welcome To
        <?php echo Session::get("messname"); ?> Mess</h3>
      <h4 style="text-align:center;font-family: 'Lato', cursive, sans-serif;"><?php
      $email = Session::get("email");
      $query1 = "SELECT mname FROM reg WHERE email='$email' ";
      $result1 = $ob->select($query1);
      $count = mysqli_num_rows($result1);
      $row1 = $result1->fetch_assoc();

      if ($count > 0) {
        echo $row1['mname'] . " Is The Manager";
      }

      ?></h4>


      <h4 style="text-align:center;font-family: 'Lato', cursive, sans-serif;">Here is total Transaction</h4>
      <button class="btn btn-primary animated bounce  " style="display: block;margin-bottom:8px;margin-left:-12px;"
        data-toggle="collapse" data-target="#abc">Schedule</button>

      <div style="max-width:1135px;overflow:scroll;margin-left: -16px;margin-right: -20px;" id="abc"
        class="collapse animated bounce  ">
        <h4 style="text-align:center;font-family: 'Lato', cursive, sans-serif;">Bazar Schedule </h4>
        <?php if (isset($msg)) {
          echo $msg;
        } ?>
        <?php
        $email = Session::get("email");
        $query25 = "SELECT*FROM bazardate WHERE email='$email'";

        $result25 = $ob->select($query25);
        $schedule = mysqli_num_rows($result25);
        if ($schedule > 0) {
          ?>

          <table class="table table-striped">
            <tr>
              <th>Name </th>
              <th>Phone</th>
              <th>Date</th>
              <th>Action</th>
            </tr>
            <?php


            while ($row25 = $result25->fetch_assoc()) {





              ?>

              <tr>

                <td>Name:<?php echo $row25['name'] ?></td>
                <td>Phone:<?php echo $row25['phone'] ?></td>
                <td>Date:<?php echo $row25['date1'] ?></td>
                <td> <a class="btn btn-success" onclick="return confirm('Are you Sure want to delete ?')"
                    href="?delete=<?php echo $row25['phone']; ?>">Delete</a></td>

              </tr>

            <?php } ?>

          </table>
        <?php } else { ?>
          <h3 style="color:red;text-align:center;font-family: 'Lato', cursive, sans-serif;"> No Schedule is Available</h3>

        <?php } ?>


      </div>
      <div class="row" style="background: #ededed;box-shadow: 0px 2px 3px 4px #ddd;max-width:1135px;overflow:scroll;">
        <div class="col-md-12">
          <div>
            <h4
              style="text-align: center;padding: 10px;font-family: italic;color:#0b1109e6;font-family: 'Lato', cursive, sans-serif;">
              Deposit Amount</h4>
            <?php if (isset($msg1)) {
              echo $msg1;
            } ?>
            <table class="table table-hover">

              <?php
              $email = Session::get("email");
              $query = "SELECT*FROM deposit WHERE email='$email'  ";
              $sum1 = 0;
              $result = $ob->select($query);

              if ($result) {
                while ($row7 = $result->fetch_assoc()) {
                  $sum1 = $sum1 + $row7['amount'];




                  ?>

                  <tr>
                    <td>Date:<?php echo $row7['date1'] ?></td>
                    <td>Name:<?php echo $row7['name'] ?></td>
                    <td>Phone:<?php echo $row7['phone'] ?></td>
                    <td>Deposit Amount:<?php echo $row7['amount']; ?></td>
                    <td> <a class="btn btn-danger" onclick="return confirm('Are you Sure want to delete ?')"
                        href="?deleteD=<?php echo $row7['phone']; ?>&deleteD1=<?php echo $row7['date1']; ?>">Delete</a></td>

                  </tr>

                <?php } ?>
                <tr>
                  <td colspan="4" style="text-align: right;">Total Deposit:<?php echo $sum1; ?> Taka</td>
                </tr>
              </table>
            <?php } ?>
          </div>
        </div>
      </div>

      <div class="row"
        style="background: #deece8;margin-top: 17px;margin-bottom: 15px;box-shadow: 0px 2px 3px 4px #ddd;max-width:1135px;overflow:scroll;">
        <div class="col-md-12">
          <div>
            <h4 style="text-align: center;padding: 15px;color: #30aea0;font-family: 'Lato', cursive, sans-serif;">Bazar
            </h4>
            <?php if (isset($msg2)) {
              echo $msg2;
            } ?>
            <table class="table table-striped">

              <?php
              $email = Session::get("email");
              $query = "SELECT*FROM bazarcost WHERE email='$email'  ";
              $sum2 = 0;
              $result = $ob->select($query);

              if ($result) {
                while ($row8 = $result->fetch_assoc()) {
                  $sum2 = $sum2 + $row8['amount'];




                  ?>

                  <tr>
                    <td>Date:<?php echo $row8['date1'] ?></td>
                    <td>Name:<?php echo $row8['name'] ?></td>
                    <td>Phone:<?php echo $row8['phone'] ?></td>
                    <td>Amount Cost:<?php echo $row8['amount']; ?></td>
                    <td> <a class="btn btn-danger" onclick="return confirm('Are you Sure want to delete ?')"
                        href="?deleteB=<?php echo $row8['phone']; ?>&deleteB1=<?php echo $row8['date1']; ?>">Delete</a></td>


                  </tr>

                <?php } ?>
                <tr>
                  <td colspan="5" style="text-align: right;">Total Bazar Cost:<?php echo $sum2; ?> Taka</td>
                </tr>
              </table>
            <?php } ?>
          </div>
        </div>


      </div>

      <div class="row" style="background: #dae5e9;box-shadow: 0px 2px 3px 4px #c4cad1;margin-bottom: 10px;">
        <div class="col-md-12">
          <div>
            <h4 style="text-align: center;padding-top: 10px;font-family: 'Lato', cursive, sans-serif;">Total Meal</h4>
            <table class="table ">

              <?php
              $email = Session::get("email");
              $query = "SELECT*FROM mealcount WHERE email='$email' ";
              $sum3 = 0;
              $result = $ob->select($query);

              if ($result) {
                while ($row9 = $result->fetch_assoc()) {
                  $sum3 = $sum3 + $row9['meal'];




                  ?>



                <?php } ?>
                <tr>
                  <td colspan="4" style="text-align: right;">Total Meal:<?php echo $sum3; ?> </td>
                </tr>
                <tr>
                  <td></td>
                  <td>Meal Rate:<?php
                  error_reporting(0);
                  $rate = $sum2 / $sum3;
                  echo round($rate, 2);

                  ?> Taka</td>
                </tr>
              </table>
            <?php } ?>
          </div>
        </div>


      </div>
    </div>
    <div class="container" style="background: #cde4dc;
box-shadow: 0px 1px 2px 3px #cfcfcf;">
      <h3 style="text-align: center;padding: 8px 6px;font-family: 'Lato', cursive, sans-serif;">All Total</h3>
      <table class="table table-striped ">

        <?php

        $email = Session::get("email");
        $query = "SELECT* FROM addmember WHERE email='$email' ";
        $result = $ob->select($query);

        if ($result) {
          $rent = 0;
          $gass = 0;
          $current = 0;
          $khala = 0;
          $net = 0;
          $water = 0;
          $others = 0;
          while ($row = $result->fetch_assoc()) {
            $rent = $rent + $row['rent'];
            $gass = $gass + $row['gass'];
            $current = $current + $row['current1'];
            $khala = $khala + $row['khala'];
            $net = $net + $row['net'];
            $water = $water + $row['water'];
            $others = $others + $row['others'];
          }
        }
        $alltotal = $rent + $gass + $current + $khala + $net + $water + $others;

        ?>

        <tr>
          <th>Total House Rent</th>
          <td><?php echo $rent; ?></td>
        </tr>
        <tr>
          <th>Total Gass Bill</th>
          <td><?php echo $gass; ?></td>
        </tr>
        <tr>
          <th>Total Current Bill</th>
          <td><?php echo $current; ?></td>
        </tr>
        <tr>
          <th>Total Khala Salary</th>
          <td><?php echo $khala; ?></td>
        </tr>
        <tr>
          <th>Total Net Bill</th>
          <td><?php echo $net; ?></td>
        </tr>
        <tr>
          <th>Total Water Bill</th>
          <td><?php echo $water; ?></td>
        </tr>
        <tr>
          <th>Total Others Bill</th>
          <td><?php echo $others; ?></td>
        </tr>
        <tr>
          <th>All Total</th>
          <td><?php echo "=" . $alltotal . " Taka"; ?></td>
        </tr>
      </table>

    </div>
    <div class="container">
      <div class="addform" style="max-width:1140;overflow:scroll;">
        <h4 style="text-align:center;font-family: 'Lato', cursive, sans-serif;">All Total Calculation </h4>
        <table class="table table-striped">
          <tr>

            <th>Name</th>
            <th>Phone</th>
            <th>Rent</th>
            <th>Net</th>
            <th>Gass</th>
            <th>Khala</th>
            <th>Current</th>
            <th>Water</th>
            <th>Others</th>
            <th>Fine</th>
            <th class="table-danger" colspan='2'>Total Meal</th>
            <th class="table-primary">Total Meal Cost</th>
            <th class="table-success">Total Deposit</th>
            <th>Given(-)/Taken(+)</th>
            <th class="table-warning">Total Amount Must Be Paid</th>
          </tr>
          <?php
          $final = 0;
          $email = Session::get("email");
          $query = "SELECT* FROM addmember WHERE email='$email' ";
          $result = $ob->select($query);

          if ($result) {
            while ($row = $result->fetch_assoc()) {




              ?>




              <tr>
                <?php
                Session::set("phone1", $row['phone']);
                ?>
              </tr>
              <?php

              $phone = Session::get("phone1");
              $email = Session::get("email");
              $query = "SELECT*FROM addmember WHERE phone='$phone' ";
              $result1 = $ob->select($query);
              $count = mysqli_num_rows($result1);
              if ($count > 0) {

                while ($row1 = $result1->fetch_assoc()) {

                  ?>

                  <tr>

                    <td><?php echo $row1['name']; ?></td>


                    <td><?php echo $row1['phone']; ?></td>


                    <td><?php echo $row1['rent']; ?></td>


                    <td><?php echo $row1['net']; ?></td>


                    <td><?php echo $row1['gass']; ?></td>

                    <td><?php echo $row1['khala']; ?></td>


                    <td><?php echo $row1['current1']; ?></td>


                    <td><?php echo $row1['water']; ?></td>


                    <td><?php echo $row1['others']; ?></td>
                    <td>
                      <div id='myDIV'>
                        <?php echo $row1['fine']; ?>
                      </div>
                    </td>

                    <td><?php
                    $phone = Session::get("phone1");
                    $query = "SELECT*FROM mealcount WHERE phone=$phone;";
                    $result2 = $ob->select($query);
                    $meal = 0;
                    while ($row2 = $result2->fetch_assoc()) {
                      $meal = $meal + $row2['meal'];

                    }
                    echo $meal;


                    ?></td>
                    <td>
                      <?php $rand = rand(10000, 100000000000); ?>

                      <button class=" btn-success animated bounce  " data-toggle="collapse"
                        data-target="#abcd<?php echo $rand ?>">View</button>

                      <div style="" id="abcd<?php echo $rand; ?>" class="collapse animated bounce  ">
                        <h4 style="text-align:left;">Total Meal</h4>



                        <table class="" style="margin:0px auto;display: block;">
                          <tr>
                            <th>Date</th>
                            <th>Meal</th>


                          </tr>
                          <?php

                          $phone = Session::get("phone1");
                          $query26 = "SELECT*FROM mealcount WHERE  phone='$phone'  ";

                          $result26 = $ob->select($query26);
                          $schedule1 = mysqli_num_rows($result26);
                          if ($schedule1 > 0) {
                            $totalmeal = 0;

                            while ($row26 = $result26->fetch_assoc()) {
                              $totalmeal = $totalmeal + $row26['meal'];




                              ?>

                              <tr>
                                <td><?php echo $row26['date1'] ?></td>
                                <td><?php echo $row26['meal'] ?></td>



                              </tr>

                            <?php }
                          } ?>
                          <tr>
                            <td colspan="2" style="float: right;margin-left: 40px;">
                              <?php echo "Total Meal=" . $totalmeal; ?>
                            </td>
                          </tr>

                        </table>
                      </div>
                    </td>




                    <td><?php
                    $totalmealcharge = $meal * $rate;
                    echo $meal . "*" . round($rate, 2) . "=" . round($totalmealcharge, 2); ?> Taka</td>

                    <td><?php
                    $phone = Session::get("phone1");
                    $query = "SELECT*FROM deposit WHERE phone='$phone';";
                    $result3 = $ob->select($query);
                    $deposit = 0;
                    while ($row3 = $result3->fetch_assoc()) {
                      $deposit = $deposit + $row3['amount'];
                      echo $row3['amount'] . "+";

                    }
                    echo "0=" . $deposit;


                    ?></td>


                    <td>
                      <?php
                      $giventaken = $deposit - $totalmealcharge;
                      echo round($giventaken, 2);
                      ?>
                    </td>

                    <td>
                      <?php

                      $totalamountpaid = $row1['rent'] + $row1['net'] + $row1['gass'] + $row1['khala'] + $row['others'] + $row1['current1'] + $row['fine'] - ($giventaken);
                      $final = $totalamountpaid + $final;
                      echo ceil($totalamountpaid) . " Taka";
                      ?>
                    </td>


                  <?php }
              }
            }
          } ?>
          <tr>

            <td colspan="14" style="text-align:right;"><?php echo "All Total Amount=" . $final; ?></td>
          </tr>
        </table>
      </div>
    </div>
  <?php } ?>

    <!-- Cards -->
    <div class="container">
      <div class="row" style="margin: 50px 0;">
        <div class="col-md-4">
          <div class="card" style="width: 22rem; height: 30rem;">
            <img src="assets/images/add-member.png" class="card-img-top" alt="..."
              style="height: 15rem; object-fit: cover;">
            <div class="card-body">
              <h5 class="card-title">Add Member to Room</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                content.</p>
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
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                content.</p>
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
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                content.</p>
              <a href="mcount.php" class="btn btn-primary">Count Meal</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

      <!--Footer -->
      <?php include('includes/footer.php'); ?>
  <!-- /Footer-->
</body>

</html>