<?php
include('header.php');
include('db_connection.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    echo '<script>
        alert("Please log in to access the chatroom.");
        window.location.href = "login.php";
    </script>';
    exit();
}

$product_id = $_GET['product_id'];
$seller_id = $_GET['seller_id'];
$buyer_id = $_SESSION['user_id'];

// Fetch messages
$query = "SELECT * FROM messages WHERE product_id = '$product_id' AND 
         ((sender_id = '$buyer_id' AND receiver_id = '$seller_id') OR 
         (sender_id = '$seller_id' AND receiver_id = '$buyer_id')) ORDER BY sent_time ASC";
$result = $conn->query($query);

?>

<div class="chatroom">
    <div class="messages">
        <?php while ($message = $result->fetch_assoc()) { ?>
            <div class="<?php echo $message['sender_id'] == $buyer_id ? 'sent' : 'received'; ?>">
                <p><?php echo $message['message']; ?></p>
                <span><?php echo $message['sent_time']; ?></span>
            </div>
        <?php } ?>
    </div>

    <!-- Message Input -->
    <form method="POST" action="send-message.php">
        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
        <input type="hidden" name="receiver_id" value="<?php echo $seller_id; ?>">
        <textarea name="message" placeholder="Type your message..." required></textarea>
        <button type="submit">Send</button>
    </form>
</div>

<?php
include('footer.php');
?>
