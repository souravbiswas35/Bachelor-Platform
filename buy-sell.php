<?php
session_start();
include('includes/config.php');
error_reporting(0);
?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <title>Bachelor Platform | Buy Sell</title>
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

    <style>
        /* Fixing the card height and layout */
        .product-listing-m {
            margin-bottom: 20px;
            display: flex;
            height: 400px; /* Fixed height for the entire card */
            border: 1px solid #ddd;
            /* Border around the card */
            overflow: hidden; /* Ensure that nothing overflows */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            /* Add a subtle shadow to the card */
        }

        /* Image section (left side) */
        .product-listing-img {
            flex: 0 0 50%;
            /* Image occupies 50% of the card */
            height: 100%;
            overflow: hidden;
            /* Ensure that image doesn't overflow out of the container */
        }

        .product-listing-img img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            /* Ensures that the image fits the container without cropping */
        }

        /* Content section (right side) */
        .product-listing-content {
            flex-grow: 1;
            padding: 15px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            /* Full height */
            padding-left: 20px; /* Added left padding to slightly move content to the right */
        }

        /* Title styling */
        .product-listing-content h5 {
            font-size: 22px;
            /* Larger font size for the title */
            font-weight: bold;
            margin-bottom: 10px;
            margin-top: 60px;
        }

        /* Category and Price styling */
        .product-listing-content h2 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        /* Button styling */
        .product-listing-content .btn {
            margin-top: 20px;
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

    <!--Page Header-->
    <section class="bs-header listing_page">
        <div class="container">
            <div class="page-header_wrap">
                <div class="page-heading">
                    <h1>Buy Sell</h1>
                </div>
                <ul class="coustom-breadcrumb">
                    <li><a href="index.php">Home</a></li>
                    <li>Buy Sell</li>
                </ul>
            </div>
        </div>
        <div class="dark-overlay"></div>
    </section>
    <!-- /Page Header-->

    <section>
        <div style="text-align: center; margin: 20px 0;">
            <a href="post-product.php" class="btn btn-primary">Post Your Product</a>
        </div>
    </section>

    <!--Listing-->
    <section class="listing-page">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-md-push-3">
                    <div class="result-sorting-wrapper">
                        <div class="sorting-count">
                            <?php
                            $sql = "SELECT id FROM products";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $totalProducts = $query->rowCount();
                            ?>
                            <p><span><?php echo htmlentities($totalProducts); ?> Listings</span></p>
                        </div>
                    </div>

                    <?php
                    $sql = "SELECT * FROM products ORDER BY RAND() LIMIT 20";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                    if ($query->rowCount() > 0) {
                        foreach ($results as $product) {
                            ?>
                            <div class="product-listing-m gray-bg">
                                <div class="product-listing-img">
                                    <?php if (!empty($product->images)): ?>
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($product->images); ?>"
                                            class="img-responsive" alt="<?php echo htmlentities($product->title); ?>" />
                                    <?php else: ?>
                                        <img src="assets/images/default-placeholder.png" class="img-responsive"
                                            alt="No Image Available" />
                                    <?php endif; ?>
                                </div>
                                <div class="product-listing-content">
                                    <h5><a
                                            href="view-product.php?id=<?php echo htmlentities($product->id); ?>"><?php echo htmlentities($product->title); ?></a>
                                    </h5>
                                   <h2>Category: <?php echo htmlentities($product->category); ?> </h2> 
                                    <h2>Price: ৳ <?php echo htmlentities($product->price); ?> </h2> 
                                    <a href="view-product.php?id=<?php echo htmlentities($product->id); ?>" class="btn">View
                                        Details <span class="angle_arrow"><i class="fa fa-angle-right"
                                                aria-hidden="true"></i></span></a>
                                </div>
                            </div>
                        <?php }
                    } else { ?>
                        <p>No products found.</p>
                    <?php } ?>
                </div>

                <!--Sidebar-->
                <aside class="col-md-3 col-md-pull-9">
                    <div class="sidebar_widget">
                        <div class="widget_heading">
                            <h5><i class="fa fa-filter" aria-hidden="true"></i> Filter by Category</h5>
                        </div>
                        <div class="sidebar_filter">
                            <form method="GET" action="">
                                <div class="form-group select">
                                    <select class="form-control" name="category">
                                        <option value="">Select Category</option>
                                        <?php
                                        $sql = "SELECT DISTINCT category FROM products";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $categories = $query->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($categories as $category) {
                                            echo '<option value="' . htmlentities($category->category) . '">' . htmlentities($category->category) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block"><i class="fa fa-search" aria-hidden="true"></i> Filter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="sidebar_widget">
                        <div class="widget_heading">
                            <h5><i class="fa fa-tags" aria-hidden="true"></i> Products Found</h5>
                        </div>
                        <div class="recent_addedcars">
                            <ul>
                                <?php
                                if (isset($_GET['category']) && !empty($_GET['category'])) {
                                    $category = $_GET['category'];
                                    $sql = "SELECT * FROM products WHERE category = :category ORDER BY RAND() LIMIT 20";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':category', $category, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $product) {
                                            ?>
                                            <li class="gray-bg" style="height: 150px; display: flex; align-items: center; margin-bottom: 10px;">
                                                <div class="recent_post_img" style="flex: 0 0 40%; height: 100%; overflow: hidden;">
                                                    <?php if (!empty($product->images)): ?>
                                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($product->images); ?>"
                                                            alt="Image" style="width: 100%; height: 100%; object-fit: contain;" />
                                                    <?php else: ?>
                                                        <img src="assets/images/default-placeholder.png" alt="No Image Available" style="width: 100%; height: 100%; object-fit: contain;" />
                                                    <?php endif; ?>
                                                </div>
                                                <div class="recent_post_title" style="flex-grow: 1; padding-left: 10px;">
                                                    <a href="view-product.php?id=<?php echo htmlentities($product->id); ?>"><?php echo htmlentities($product->title); ?></a>
                                                    <p class="widget_price">৳ <?php echo htmlentities($product->price); ?></p>
                                                    <p>Category: <?php echo htmlentities($product->category); ?></p>
                                                    <a href="view-product.php?id=<?php echo htmlentities($product->id); ?>" class="btn btn-primary btn-xs">View Details</a>
                                                </div>
                                            </li>
                                        <?php }
                                    } else { ?>
                                        <p>No products found in this category.</p>
                                    <?php }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>

                    <div class="sidebar_widget">
                        <div class="widget_heading">
                            <h5><i class="fa fa-tags" aria-hidden="true"></i> Recently Listed Products</h5>
                        </div>
                        <div class="recent_addedcars">
                            <ul>
                                <?php
                                $sql = "SELECT * FROM products ORDER BY created_at DESC LIMIT 4";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $recentProducts = $query->fetchAll(PDO::FETCH_OBJ);

                                foreach ($recentProducts as $recent) { ?>
                                    <li class="gray-bg" style="height: 100px; display: flex; align-items: center;">
                                        <div class="recent_post_img" style="flex: 0 0 30%; height: 100%; overflow: hidden;">
                                            <?php if (!empty($recent->images)): ?>
                                                <img src="data:image/jpeg;base64,<?php echo base64_encode($recent->images); ?>"
                                                    alt="Image" style="width: 100%; height: 100%; object-fit: contain;" />
                                            <?php else: ?>
                                                <img src="assets/images/default-placeholder.png" alt="No Image Available" style="width: 100%; height: 100%; object-fit: contain;" />
                                            <?php endif; ?>
                                        </div>
                                        <div class="recent_post_title" style="flex-grow: 1; padding-left: 10px;">
                                            <a href="view-product.php?id=<?php echo htmlentities($recent->id); ?>"><?php echo htmlentities($recent->title); ?></a>
                                            <p class="widget_price">৳ <?php echo htmlentities($recent->price); ?></p>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </aside>
                <!--/Sidebar-->
            </div>
        </div>
    </section>
    <!-- /Listing-->

    <!--Footer -->
    <?php include('includes/footer.php'); ?>
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
