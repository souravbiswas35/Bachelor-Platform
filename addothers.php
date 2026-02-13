<?php 
     include_once 'database/Session.php';
     Session::checkSession();
    
    ?>
  
   <?php   $msg="";?>
<?php 
     
      include("database/Formet.php");
      $fm=new Format();
      include_once 'database/Connection.php'; 
        $ob=new Database();
    ?>

    
         <?php 


      if(isset($_POST['submit'])){
        $name=$_POST['name'];
       $phone=$_POST['phone'];
       $address=$_POST['address'];
       $blood=$_POST['blood'];
       $rent=$_POST['rent']; 
       $net=$_POST['net'];  
       $gass=$_POST['gass']; 
       $khala=$_POST['khala'];
       $current=$_POST['current'];
       $water=$_POST['water'];
       $others=$_POST['others'];
        $fine=$_POST['fine'];
                    $email=Session::get("email");
                    $query2="UPDATE addmember SET name='$name',address='$address',blood='$blood',rent='$rent',net='$net',gass='$gass',khala='$khala',current1='$current',water='$water',others='$others',fine='$fine'  WHERE phone='$phone' AND email='$email' ";


                    $result2=$ob->update($query2);
                    
                  if($result2){
                    $msg="<div class='alert alert-success'><span>Updated Successfully</span></div>";

                  }
                   else{
                   $msg="<div class='alert alert-danger'><span>Please Try Again!</span></div>";

                 }

                }
              
           

        


      



    ?>
    



<!DOCTYPE html>
<html lang="en">
<head>
 <title>Meal Management</title>
    <link rel="icon"  href="img/logo1.png">
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
  <style type="text/css">

body{
    font-family:'Acme';
     font-family: "Times New Roman", Times, serif;
    }
  
   .navbar-dark .navbar-nav .active > .nav-link:hover{
   
        color:red;

   }
   
   .navbar-dark .navbar-nav .nav-link:hover{
  color: rgba(251, 6, 6, 0.75);
}
      .dropdown .dropdown-menu .dropdown-item:hover {
  background: #D6E0E0;
  color: black;
  display: block;
}
      .navbar-dark .navbar-nav .nav-item{
        width:177px;
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
      .form3  {
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

.facebooklogo  {
    font-size: 2rem;
    width: 40px;
    height: 40px;
    background: #3560B7;
    border-radius: 50px;
   
    color: #fefefe;
}
.navbar-dark .navbar-brand {
    color:red;
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
.navbar-dark .navbar-nav .show > .nav-link, .navbar-dark .navbar-nav .active > .nav-link, .navbar-dark .navbar-nav .nav-link.show, .navbar-dark .navbar-nav .nav-link.active {
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
  color:#0B8D8D;
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
  padding-bottom:0px;
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
  
}
.formmain{
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
</style>
</head>
<body>
 <?php  if(isset($_GET['action']) && $_GET['action']=='logout')
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
<div class="addform">
  <h3 style="text-align:center;">Update Members Information</h3>
  <?php 
   if(isset($msg)){
      echo $msg;
   }
  ?>
  <form class="formmain" method="post" enctype="multipart/form-data">
 <?php if(isset($_GET['update'])){
  $phone=$_GET['update'];
  $query1="SELECT*FROM addmember WHERE phone='$phone' ";
  $result1=$ob->select($query1);
  $row1=$result1->fetch_assoc();

 }?>
   <div class="form-group">
    <label for="pwd">Name</label>
  <input class="form-control"  name="name" value="<?php echo $row1['name'];?>">
  </div>
  <div class="form-group">
    <label for="pwd">Phone</label>
  <input class="form-control"  name="phone" readonly="" value="<?php echo $row1['phone'];?>">
  </div>
  <div class="form-group">
    <label for="pwd">Address</label>
  <input class="form-control"  name="address" value="<?php echo $row1['address'];?>">
  </div>
  <div class="form-group">
    <label for="pwd">Email</label>
  <input class="form-control"  name="blood" value="<?php echo $row1['blood'];?>">
  </div>
  <div class="form-group">
    <label for="pwd">Rent</label>
  <input class="form-control"  name="rent" value="<?php echo $row1['rent'];?>">
  </div>
  <div class="form-group">
    <label for="pwd">Net</label>
  <input class="form-control"  name="net" value="<?php echo $row1['net'];?>">
  </div>
  <div class="form-group">
    <label for="pwd">Gass</label>
  <input class="form-control"  name="gass" value="<?php echo $row1['gass'];?>">
  </div>
  <div class="form-group">
    <label for="pwd">Khala</label>
  <input class="form-control"  name="khala" value="<?php echo $row1['khala'];?>">
  </div>
  <div class="form-group">
    <label for="pwd">Current</label>
  <input class="form-control"  name="current" value="<?php echo $row1['current1'];?>">
  </div>
  <div class="form-group">
    <label for="pwd">Water</label>
  <input class="form-control"  name="water" value="<?php echo $row1['water'];?>">
  </div>
  <div class="form-group">
    <label for="pwd">Others</label>
  <input class="form-control"  name="others" value="<?php echo $row1['others'];?>">
  </div>
   <div class="form-group">
    <label for="pwd">Fine</label>
  <input class="form-control"  name="fine" value="<?php echo $row1['fine'];?>">
  </div>
   
  
      <input type="submit" class="btn btn-primary mb-2" style="float: right;margin-top:-6px;padding: 7px 40px;" name="submit" value="Update">          


</form>
  </div>
</div>
<div class="container">
<div class="row addextra" style="margin-bottom:4px">
          <div class="col-md-4">
            <div class="animated slideInLeft yourElement">
            <h4 class="bb" style=" background: #ea721ae6; padding: 80px; color: #f9f9f9;text-align: center;font-size: 30px;"><a href="addmember.php" style="text-decoration:none;color:#f6f1f1"><img class="img1" src="img/add.jpg"> Add Member</a> </h4>
          </div>
          </div>

           <div class="col-md-4">
           <div class="animated flip yourElement1">
            <h4 class="bb" style="background: #67baef;padding: 80px; color: #f9f9f9;text-align: center;font-size: 30px;"><a href="deposit.php" style="text-decoration:none;color:#f6f1f1"><img class="img1" src="img/deposit.png"> Deposit</a></h4>
          </div>
          </div>

           <div class="col-md-4">
            <div class="animated slideInRight yourElement2">
           <h4 class="bb" style="background:#2fb7a4;padding: 84px; color: #f9f9f9;text-align: center;font-size: 25px;"><a href="mcount.php" style="text-decoration:none;color:#f6f1f1"><img class="img1" src="img/daily.jpg">  Daily Meal Count</a></h4>
          </div>
          </div>

  </div>
</div>

  <!--Footer -->
  <?php include('includes/footer.php'); ?>
  <!-- /Footer-->

</body>
</html>

