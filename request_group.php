<?php
session_start();
include('includes/config.php');

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$msg = '';
$error = '';

// Check if the form data has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['userArea'], $_POST['groupRequest'])) {
    $area = htmlspecialchars($_POST['userArea']);
    $request_message = htmlspecialchars($_POST['groupRequest']);

    // Prepare SQL to insert the new group request
    $sql = "INSERT INTO group_requests (user_id, area, request_message, is_verified) VALUES (?, ?, ?, 0)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
    $stmt->bindParam(2, $area, PDO::PARAM_STR);
    $stmt->bindParam(3, $request_message, PDO::PARAM_STR);
    
    // Execute the query and check if it was successful
    if ($stmt->execute()) {
        $msg = "Your request has been submitted successfully and is pending approval.";
    } else {
        $error = "There was an error submitting your request. Please try again.";
    }
}

// Redirect back to community_group1.php with a message indicating success or failure
header("Location: community_group1.php");
if ($msg) {
    $_SESSION['success_msg'] = $msg;
} else {
    $_SESSION['error_msg'] = $error;
}
exit;
?>
