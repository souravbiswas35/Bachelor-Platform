<?php 
session_start();
include('includes/config.php');
error_reporting(0);

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // header("Location: index.php");
    echo '<script>
         alert("Please log in the server to Post Product.");
         window.location.href = "buy-sell.php";
     </script>';
     exit;
 }

// Handle form submission for posting a product
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $area = $_POST['area'];
    $image = isset($_FILES['image']['tmp_name']) ? file_get_contents($_FILES['image']['tmp_name']) : null;
    $image2 = isset($_FILES['image2']['tmp_name']) ? file_get_contents($_FILES['image2']['tmp_name']) : null;
    $image3 = isset($_FILES['image3']['tmp_name']) ? file_get_contents($_FILES['image3']['tmp_name']) : null;

    // Validate input fields
    if (!empty($title) && !empty($description) && !empty($category) && !empty($price) && !empty($area) && !empty($image) 
    && !empty($image2) && !empty($image3)) {
        try {
            // Insert product into the database
            $sql = "INSERT INTO products (user_id, title, description, category, price, area, images, images2, images3, created_at) 
                    VALUES (:user_id, :title, :description, :category, :price, :area, :images, :images2, :images3, NOW())";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':category', $category);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':area', $area);
            $stmt->bindParam(':images', $image, PDO::PARAM_LOB);
            $stmt->bindParam(':images2', $image2, PDO::PARAM_LOB);
            $stmt->bindParam(':images3', $image3, PDO::PARAM_LOB);
            $stmt->execute();

            $_SESSION['msg'] = "Product posted successfully.";
        } catch (PDOException $e) {
            $_SESSION['error'] = "Error posting product: " . $e->getMessage();
        }
    } else {
        $_SESSION['error'] = "Please fill in all the fields.";
    }
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Post Product</title>
    <!-- Include all necessary stylesheets and scripts -->
      <!--Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <!--Custom Style -->
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <!--OWL Carousel slider-->
    <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
    <!--Slick-slider -->
    <link href="assets/css/slick.css" rel="stylesheet">
    <!--Bootstrap-slider -->
    <link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
    <!--FontAwesome Font Style -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <!-- SWITCHER -->
    <link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all"
        data-default-color="true" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />
    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
</head>
<body>

<!-- Start Switcher -->
<?php include('includes/colorswitcher.php'); ?>
<!-- /Switcher -->
<?php include('includes/header.php'); ?>

<?php if (isset($_SESSION['msg'])): ?>
    <div class="alert alert-success">
        <?php echo $_SESSION['msg']; unset($_SESSION['msg']); ?>
    </div>
<?php endif; ?>
<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger">
        <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<div class="container">
    <h2>Post Your Product</h2>
    <form method="POST" enctype="multipart/form-data">
        <!-- Form fields -->
        <div class="form-group">
            <label for="title">Product Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" id="category" name="category" required>
                <option value="Electronics">Electronics</option>
                <option value="Furniture">Furniture</option>
                <option value="Books">Books</option>
                <option value="Appliances">Others</option>
            </select>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="area">Area</label>
            <input type="text" class="form-control" id="area" name="area" required>
        </div>
        <div class="form-group">
            <label for="image">Product Image 1</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
        </div>
        <div class="form-group">
            <label for="image2">Product Image 2</label>
            <input type="file" class="form-control" id="image2" name="image2" accept="image/*" required>
        </div>
        <div class="form-group">
            <label for="image3">Product Image 3</label>
            <input type="file" class="form-control" id="image3" name="image3" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary" style="margin-bottom: 15px;">Post Product</button>
        </form>
</div>

<!-- Footer -->
<?php include('includes/footer.php');?>
<!-- /Footer--> 

<!--Back to top-->
<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
<!--/Back to top--> 

<!--Login-Form -->
<?php include('includes/login.php');?>
<!--/Login-Form --> 

<!--Register-Form -->
<?php include('includes/registration.php');?>

<!--/Register-Form --> 

<!--Forgot-password-Form -->
<?php include('includes/forgotpassword.php');?>

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
