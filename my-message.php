<?php
session_start();
include('includes/config.php');
error_reporting(0);

// Check if the user is logged in
if (!isset($_SESSION['login']) || empty($_SESSION['login'])) {
    echo "<div class='container my-4'><h3>You must be logged in to view messages.</h3><a href='login.php' class='btn btn-primary'>Login</a></div>";
    exit;
}

$sellerEmail = $_SESSION['login'];
$sql = "SELECT id FROM users WHERE EmailId = :email";
$query = $dbh->prepare($sql);
$query->bindParam(':email', $sellerEmail, PDO::PARAM_STR);
$query->execute();
$seller = $query->fetch(PDO::FETCH_ASSOC);

// If no user found
if (!$seller) {
    echo "<div class='container my-4'><h3>User not found.</h3></div>";
    exit;
}

$sellerId = $seller['id'];

// Fetch messages for this seller
$sql = "SELECT m.*, p.title AS product_title 
        FROM messages m
        JOIN products p ON m.product_id = p.id
        WHERE m.seller_id = :seller_id
        ORDER BY m.created_at DESC";
$query = $dbh->prepare($sql);
$query->bindParam(':seller_id', $sellerId, PDO::PARAM_INT);
$query->execute();
$messages = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <title> Bachelor Platform | View Product</title>
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

    <!-- Header -->
    <?php include('includes/header.php'); ?>
    <!-- /Header -->

    <div class="container my-4">
        <h2>Your Messages</h2>

        <?php if (count($messages) > 0): ?>
            <div class="list-group">
                <?php foreach ($messages as $message): ?>
                    <div class="list-group-item">
                        <h5 class="mb-1"><?php echo htmlspecialchars($message['buyer_name']); ?> <small class="text-muted">(<?php echo htmlspecialchars($message['buyer_email']); ?>)</small></h5>
                        <p><strong>Product: </strong><?php echo htmlspecialchars($message['product_title']); ?></p>
                        <p><strong>Message: </strong><?php echo nl2br(htmlspecialchars($message['message'])); ?></p>
                        <p><small>Received on <?php echo date('d-m-Y H:i:s', strtotime($message['created_at'])); ?></small></p>
                        <p><strong>Contact No : </strong><?php echo htmlspecialchars($message['buyer_contact']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No messages yet.</p>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <?php include('includes/footer.php'); ?>
    <!-- /Footer -->

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>
