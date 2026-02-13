<?php
session_start();
include('includes/config.php');

// Ensure admin is logged in
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
    exit;
}

// Delete product logic
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $productId = intval($_GET['id']);

    // Delete query
    $sql = "DELETE FROM products WHERE id = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $productId, PDO::PARAM_INT);

    if ($query->execute()) {
        $_SESSION['msg'] = "Product deleted successfully.";
    } else {
        $_SESSION['error'] = "Unable to delete the product. Please try again.";
    }
}

// Redirect back to manage_buy_sell.php
header('location:manage_buy_sell.php');
exit;
?>
