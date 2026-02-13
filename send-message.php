<?php
include('includes/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $buyerName = htmlspecialchars($_POST['buyerName']);
    $buyerEmail = htmlspecialchars($_POST['buyerEmail']);
    $buyerContact = htmlspecialchars($_POST['buyerContact']);
    $message = htmlspecialchars($_POST['message']);
    $productId = intval($_POST['productId']);
    $sellerId = intval($_POST['sellerId']);

    $sql = "INSERT INTO messages (product_id, seller_id, buyer_name, buyer_email, buyer_contact, message, created_at) 
            VALUES (:product_id, :seller_id, :buyer_name, :buyer_email, :buyer_contact, :message, NOW())";
    $query = $dbh->prepare($sql);
    $query->bindParam(':product_id', $productId, PDO::PARAM_INT);
    $query->bindParam(':seller_id', $sellerId, PDO::PARAM_INT);
    $query->bindParam(':buyer_name', $buyerName, PDO::PARAM_STR);
    $query->bindParam(':buyer_email', $buyerEmail, PDO::PARAM_STR);
    $query->bindParam(':buyer_contact', $buyerContact, PDO::PARAM_STR);
    $query->bindParam(':message', $message, PDO::PARAM_STR);

    if ($query->execute()) {
        echo "Message sent successfully!";
    } else {
        echo "Failed to send the message. Please try again.";
    }
}
?>
