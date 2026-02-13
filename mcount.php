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
$date = date('d-m-y');

?>
<?php
$email = Session::get("email");
?>




<?php
if (isset($_GET["delete"])) {
  $email12 = $_GET["delete"];

  $query1 = "DELETE FROM deposit WHERE email='$email12'";
  $result1 = $ob->delete($query1);
  $query2 = "DELETE FROM bazarcost WHERE email='$email12'";
  $result2 = $ob->delete($query2);
  $query3 = "DELETE FROM mealcount WHERE email='$email12'";
  $result3 = $ob->delete($query3);
  $query4 = "DELETE FROM bazardate WHERE email='$email12'";
  $result4 = $ob->delete($query4);

  if ($result4) {
    $msg3 =
      "<div style='text-align:center;margin-top:5px;' class='alert alert-success alert-dismissible'>
    <button type='button' class='close' data-dismiss='alert'>&times;</button>Successfully Deleted From Table Deposit,Daily Meal Count & Bazarcost!
  </div>";

  } else {
    $msg3 = "<div class='alert alert-danger'><span>Please Try Again!</span></div>";

  }
}

?>

<?php

if (isset($_POST['submit'])) {

  $attend = $_POST['attend'];
  $date1 = $_POST['date1'];
  // $attend=mysqli_real_escape_string($ob->link,$attend);
  //$date1=mysqli_real_escape_string($ob->link,$date1);
  $query = "SELECT*from mealcount WHERE date1='$date1'  AND email='$email' ";
  $outattendance = $ob->select($query);
  $row = $outattendance->fetch_assoc();



  if ($date1 == $row['date1']) {

    $msg = "<div style='text-align:center;margin-top:5px;' class='alert alert-danger alert-dismissible'>
    <button type='button' class='close' data-dismiss='alert'>&times;</button>Meal Count Already Have Taken
  </div>";



  } else {







    foreach ($attend as $key1 => $value) {
      if ($value == "A") {
        $query = "INSERT INTO mealcount(email,phone,meal,date1) VALUES('$email','$key1',0,'$date1')";
        $result = $ob->insert($query);

      } elseif ($value == "B") {
        $query = "INSERT INTO mealcount(email,phone,meal,date1) VALUES('$email','$key1',.5,'$date1')";
        $result = $ob->insert($query);

      } elseif ($value == "C") {
        $query = "INSERT INTO mealcount(email,phone,meal,date1) VALUES('$email','$key1',1,'$date1')";
        $result = $ob->insert($query);

      } elseif ($value == "D") {
        $query = "INSERT INTO mealcount(email,phone,meal,date1) VALUES('$email','$key1',1.5,'$date1')";
        $result = $ob->insert($query);

      } elseif ($value == "E") {
        $query = "INSERT INTO mealcount(email,phone,meal,date1) VALUES('$email','$key1',2,'$date1')";
        $result = $ob->insert($query);

      } elseif ($value == "F") {
        $query = "INSERT INTO mealcount(email,phone,meal,date1) VALUES('$email','$key1',2.5,'$date1')";
        $result = $ob->insert($query);

      } elseif ($value == "G") {
        $query = "INSERT INTO mealcount(email,phone,meal,date1) VALUES('$email','$key1',3,'$date1')";
        $result = $ob->insert($query);

      } elseif ($value == "H") {
        $query = "INSERT INTO mealcount(email,phone,meal,date1) VALUES('$email','$key1',3.5,'$date1')";
        $result = $ob->insert($query);

      } elseif ($value == "I") {
        $query = "INSERT INTO mealcount(email,phone,meal,date1) VALUES('$email','$key1',4,'$date1')";
        $result = $ob->insert($query);

      } elseif ($value == "J") {
        $query = "INSERT INTO mealcount(email,phone,meal,date1) VALUES('$email','$key1',4.5,'$date1')";
        $result = $ob->insert($query);

      } elseif ($value == "K") {
        $query = "INSERT INTO mealcount(email,phone,meal,date1) VALUES('$email','$key1',5,'$date1')";
        $result = $ob->insert($query);

      } elseif ($value == "L") {
        $query = "INSERT INTO mealcount(email,phone,meal,date1) VALUES('$email','$key1',6,'$date1')";
        $result = $ob->insert($query);

      }




    }

    if ($result) {
      $msg = "<div style='text-align:center;margin-top:5px;' class='alert alert-success alert-dismissible'>
    <button type='button' class='close' data-dismiss='alert'>&times;</button>Meal Count Have Taken Successfully
  </div>";



    } else {
      $msg = "<div style='text-align:center;margin-top:5px;' class='alert alert-danger alert-dismissible'>
    <button type='button' class='close' data-dismiss='alert'>&times;</button>Please Try Again
  </div>";


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

  <script>
    $(function () {
      $("#datepicker").datepicker();
    });
  </script>


  <script type="text/javascript">
    $(document).ready(function () {
      $("form").submit(function () {
        var roll = true;
        $(":radio").each(function () {
          name = $(this).attr('name');
          if (roll && !$(':radio[name="' + name + '"]:checked').length) {
            alert(name + "  Number Missing");
            roll = false;
          }
        });
        return roll;
      });
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

    input[type="radio"] {
      margin-left: 4px;
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

  <?php
  error_reporting(0);
  $email = Session::get("email");

  $query = "SELECT*FROM addmember WHERE email='$email' ";
  $result = $ob->select($query);
  $able = mysqli_num_rows($result);
  if ($able <= 0) {
    ?>
    <div class="container">
      <h3 style="font-size: 1.75rem;padding: 93px 20px;text-align: center;color: red;">Please,At First Add Somes Member To
        Continue This Whole Process.Thanks</h3>
    </div>
  <?php } else { ?>
    <div class="container" style="margin-bottom: 83px;">
      <div class="date">
      <h3 style="padding-top: 10px; text-align: center;">Daily Meal Count</h3>

        <h4><span><iframe
              src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=en&size=medium&timezone=Asia%2FDhaka"
              width="100%" height="115" frameborder="0" seamless></iframe></span></h4>
        <?php if (isset($msg)) {
          echo $msg;
        }
        ?>
        <button class="btn btn-primary animated bounce  "
          style="float:right;display: block;margin-top: 8px;margin-bottom:8px" data-toggle="collapse"
          data-target="#abc">Notice</button>

        <div id="abc" class="collapse animated bounce  ">
          <h5>
            <ul>
              <li>
                Before New Month Transaction Start You Must Delete Previous Month All Records Like Deposit,Daily Meal
                Count , Bazar Cost & Bazar Schedule Table .Otherswise It Will Be Produced Error Result .
              </li>
              <li style="list-style-type:none;text-align:center;padding-top:5px;">
                <a class="btn btn-success"
                  onclick="return confirm('Are you want to delete All Records From Deposit,Daily Count meal & BazarCost & Bazar Schedule Table?')"
                  href="mcount.php?delete=<?php echo Session::get("email"); ?>">Delete</a>
                </td>

              </li>
            </ul>
          </h5>
          <?php if (isset($msg3)) {
            echo $msg3;
          } ?>

        </div>


      </div>



      <form action="" method="post">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>No.</th>
              <th>name</th>
              <th>Phone</th>
              <th>Meal</th>


            </tr>
          </thead>
          <tbody>
            <?php
            error_reporting(0);
            $email = Session::get("email");

            $query = "SELECT*FROM addmember WHERE email='$email' ";
            $result = $ob->select($query);
            if ($result) {
              $i = 1;
              while ($row = $result->fetch_assoc()) {

                ?>
                <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['phone']; ?></td>

                  <td>
                    <input type="radio" name="attend[<?php echo $row['phone']; ?>]" value="A">0
                    <input type="radio" name="attend[<?php echo $row['phone']; ?>]" value="B">.5
                    <input type="radio" name="attend[<?php echo $row['phone']; ?>]" value="C">1
                    <input type="radio" name="attend[<?php echo $row['phone']; ?>]" value="D">1.5
                    <input type="radio" name="attend[<?php echo $row['phone']; ?>]" value="E">2
                    <input type="radio" name="attend[<?php echo $row['phone']; ?>]" value="F">2.5
                    <input type="radio" name="attend[<?php echo $row['phone']; ?>]" value="G">3
                    <input type="radio" name="attend[<?php echo $row['phone']; ?>]" value="H">3.5
                    <input type="radio" name="attend[<?php echo $row['phone']; ?>]" value="I">4
                    <input type="radio" name="attend[<?php echo $row['phone']; ?>]" value="J">4.5
                    <input type="radio" name="attend[<?php echo $row['phone']; ?>]" value="K">5
                    <input type="radio" name="attend[<?php echo $row['phone']; ?>]" value="L">6

                  </td>
                </tr>
              <?php }
            } ?>

          </tbody>
        </table>
        <div class="form-group">
          <label for="pwd">Date</label>


          <input class="form-control" id="datepicker" name="date1"
            placeholder="  <?php echo "Today Date Is:" . date('d/m/y'); ?> " required="">



        </div>

<input type="submit" name="submit" value="Save " class="btn btn-success" style="float:right;margin-bottom:10px;">
      </form>


    </div>
    <div class="container">
      <div>
        <div class="row" style="padding-top:10px;margin-top: 8px;margin-bottom: 8px;">
          <div class="col-md-12">
            <div>

              <h4 class="bb" style="background:#18b04a;padding:39px 54px;color: #fff;">
                <p>Meal Count Started:<?php
                $email = Session::get("email");
                $query = "SELECT DISTINCT date1 FROM mealcount WHERE email='$email'  ";
                $result1 = $ob->select($query);
                $totalmeal = mysqli_num_rows($result1);
                $row1 = $result1->fetch_assoc();
                echo $row1['date1'];
                ?></p>
                Total Daily Meal Count:<?php echo $totalmeal; ?>
                <p style="text-align: right;"> <a class="btn btn-success" href="view.php"
                    style="color:white;text-align: center;">Update</a></p>
              </h4>

            </div>
          </div>

        </div>
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





  <script type="text/javascript"
    src="https://platform-api.sharethis.com/js/sharethis.js#property=5ecf3c71cbdf4100127d4019&product=inline-share-buttons"
    async="async"></script>

      <!--Footer -->
  <?php include('includes/footer.php'); ?>
  <!-- /Footer-->
</body>

</html>