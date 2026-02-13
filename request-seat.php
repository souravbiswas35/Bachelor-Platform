<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $contactno = $_POST['contactno'];
    $message = $_POST['message'];

    // File upload logic for up to 4 images
    $imageFields = ['image1', 'image2', 'image3', 'image4'];
    $images = [];

    foreach ($imageFields as $field) {
        if (isset($_FILES[$field]['name']) && $_FILES[$field]['name'] != '') {
            $imageName = time() . '_' . $_FILES[$field]['name'];
            $target = "uploads/" . $imageName;
            if (move_uploaded_file($_FILES[$field]['tmp_name'], $target)) {
                $images[$field] = $imageName;
            } else {
                $images[$field] = null;
            }
        } else {
            $images[$field] = null;
        }
    }

    $sql = "INSERT INTO seatrequests (fullname, email, contactno, message, image1, image2, image3, image4) 
            VALUES (:fullname, :email, :contactno, :message, :image1, :image2, :image3, :image4)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':fullname', $fullname, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':contactno', $contactno, PDO::PARAM_STR);
    $query->bindParam(':message', $message, PDO::PARAM_STR);
    $query->bindParam(':image1', $images['image1'], PDO::PARAM_STR);
    $query->bindParam(':image2', $images['image2'], PDO::PARAM_STR);
    $query->bindParam(':image3', $images['image3'], PDO::PARAM_STR);
    $query->bindParam(':image4', $images['image4'], PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
        $msg = "Request submitted successfully. Admin will review it shortly.";
    } else {
        $error = "Something went wrong. Please try again.";
    }
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>Bachelor Platform | Request to Post Seat</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
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
<link href="assets/css/font-awesome.min.css" rel="stylesheet">

<!-- SWITCHER -->
		<link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all" data-default-color="true" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />
        
<!-- Fav and touch icons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
<style>
    .errorWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #dd3d36;
        box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    }
    .succWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #5cb85c;
        box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    }
</style>
</head>
<body>
<?php include('includes/header.php');?>

<section class="page-header">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>Request to Post Seat</h1>
      </div>
    </div>
  </div>
</section>

<section class="contact_us section-padding">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h3>Fill in the form below to request a seat listing</h3>
        <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>: <?php echo htmlentities($error); ?></div><?php } 
        else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?></div><?php } ?>
        <div class="contact_form gray-bg">
          <form method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label class="control-label">Full Name <span>*</span></label>
              <input type="text" name="fullname" class="form-control white_bg" required>
            </div>
            <div class="form-group">
              <label class="control-label">Email <span>*</span></label>
              <input type="email" name="email" class="form-control white_bg" required>
            </div>
            <div class="form-group">
              <label class="control-label">Contact Number <span>*</span></label>
              <input type="text" name="contactno" class="form-control white_bg" required maxlength="10" pattern="[0-9]+">
            </div>
            <div class="form-group">
              <label class="control-label">Message <span>*</span></label>
              <textarea class="form-control white_bg" name="message" rows="4" required></textarea>
            </div>
            <div class="form-group">
              <label class="control-label">Upload Image 1</label>
              <input type="file" name="image1" class="form-control white_bg" accept="image/*">
            </div>
            <div class="form-group">
              <label class="control-label">Upload Image 2</label>
              <input type="file" name="image2" class="form-control white_bg" accept="image/*">
            </div>
            <div class="form-group">
              <label class="control-label">Upload Image 3</label>
              <input type="file" name="image3" class="form-control white_bg" accept="image/*">
            </div>
            <div class="form-group">
              <label class="control-label">Upload Image 4</label>
              <input type="file" name="image4" class="form-control white_bg" accept="image/*">
            </div>
            <div class="form-group">
              <button class="btn" type="submit" name="submit">Submit Request <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></button>
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-6">
        <h3>Instructions</h3>
        <p>Please provide accurate details about the seat you want to list. Upload clear images, and ensure your contact number is valid for admin to reach out if necessary.</p>
      </div>
    </div>
  </div>
</section>

<?php include('includes/footer.php');?>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
