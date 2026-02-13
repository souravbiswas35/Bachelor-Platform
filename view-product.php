<?php
session_start();
include('includes/config.php');
error_reporting(0);

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch product details along with the seller's FullName and ID
$sql = "SELECT p.*, u.FullName AS seller_name, u.id AS seller_id 
        FROM products p 
        JOIN users u ON p.user_id = u.id 
        WHERE p.id = :id";
$query = $dbh->prepare($sql);
$query->bindParam(':id', $id, PDO::PARAM_INT);
$query->execute();
$product = $query->fetch(PDO::FETCH_ASSOC);

// Handle product not found
if (!$product) {
    echo "<div class='container my-4'><h3>Product not found.</h3><a href='buy-sell.php' class='btn btn-primary'>Go Back</a></div>";
    exit;
}
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <title><?php echo htmlspecialchars($product['title']); ?> - View Product</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
    <link href="assets/css/slick.css" rel="stylesheet">
    <link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
</head>

<body>

    <!--Header-->
    <?php include('includes/header.php'); ?>
    <!-- /Header -->

    <div class="container my-4">
        <div class="card" style="width: 100%; height: auto; display: flex; flex-direction: row-reverse;">
            <div class="row no-gutters" style="width: 100%; height: auto; display: flex;">
                <!-- Left Section: Product Images -->
                <div class="col-md-6" style="padding: 20px; background-color: #f0f0f0;">
                    <div id="productImagesCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php 
                            $images = ['images', 'images2', 'images3'];
                            $active = 'active';
                            foreach (array_reverse($images) as $image) {
                                if (!empty($product[$image])): ?>
                                    <div class="carousel-item <?php echo $active; ?>">
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($product[$image]); ?>" class="d-block w-100" alt="Product Image" style="width: 100%; height: 400px; object-fit: cover;">
                                    </div>
                                    <?php $active = ''; ?>
                                <?php endif;
                            } ?>
                        </div>
                        <a class="carousel-control-prev" href="#productImagesCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#productImagesCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>

                <!-- Right Section: Product Details -->
                <div class="col-md-6" style="display: flex; flex-direction: column; justify-content: center; padding: 20px;">
                    <div class="card-body">
                        <h1 class="card-title"><?php echo htmlspecialchars($product['title']); ?></h1>
                        <p class="card-text"><strong>Category:</strong> <?php echo htmlspecialchars($product['category']); ?></p>
                        <p class="card-text"><strong>Price:</strong> ৳<?php echo number_format($product['price'], 2); ?></p>
                        <p class="card-text"><strong>Description:</strong></p>
                        <p class="card-text"><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
                        <p class="card-text"><strong>Product Posted By:</strong> <?php echo htmlspecialchars($product['seller_name']); ?></p>
                        <div class="mt-4">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#contactSellerModal">Contact Seller</button>
                            <?php if (isset($_SESSION['userid']) && $_SESSION['userid'] == $product['user_id']): ?>
                                <a href="mark-sold.php?id=<?php echo $product['id']; ?>" class="btn btn-success">Mark as Sold</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Seller Modal -->
    <div class="modal fade" id="contactSellerModal" tabindex="-1" role="dialog" aria-labelledby="contactSellerModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactSellerModalLabel">Contact Seller</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="contactSellerForm">
                        <div class="form-group">
                            <label for="buyerName">Your Name</label>
                            <input type="text" class="form-control" id="buyerName" name="buyerName" required>
                        </div>
                        <div class="form-group">
                            <label for="buyerEmail">Your Email</label>
                            <input type="email" class="form-control" id="buyerEmail" name="buyerEmail" required>
                        </div>
                        <div class="form-group">
                            <label for="buyerContact">Your Contact Number</label>
                            <input type="text" class="form-control" id="buyerContact" name="buyerContact" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                        </div>
                        <input type="hidden" name="productId" value="<?php echo $product['id']; ?>">
                        <input type="hidden" name="sellerId" value="<?php echo $product['seller_id']; ?>">
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Footer-->
    <?php include('includes/footer.php'); ?>
    <!-- /Footer -->

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script>
        // Handle form submission via AJAX
        $('#contactSellerForm').submit(function(e) {
            e.preventDefault(); // Prevent default form submission

            $.ajax({
                url: 'send-message.php', // Endpoint for handling messages
                type: 'POST',
                data: $(this).serialize(), // Send the form data
                success: function(response) {
                    alert(response); // Show success or error message
                    $('#contactSellerModal').modal('hide'); // Close modal on success
                },
                error: function() {
                    alert('An error occurred while sending the message.');
                }
            });
        });
    </script>
</body>

</html>
