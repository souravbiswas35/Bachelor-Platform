<?php
session_start();
include('includes/config.php');

// Ensure user is logged in
if (!isset($_SESSION['users_id'])) {
   header("Location: index.php");
   exit;
}

// Validate `group_id` from the URL
if (!isset($_GET['group_id'])) {
    echo "<script>
            alert('Invalid group selection.');
            window.location.href='community_group1.php';
          </script>";
    exit;
}

$group_id = intval($_GET['group_id']); // Sanitize input
$user_id = $_SESSION['user_id']; // Get logged-in user ID

// Fetch user's area
$sql_user = "SELECT area FROM users WHERE id = :user_id";
$query_user = $dbh->prepare($sql_user);
$query_user->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$query_user->execute();
$user = $query_user->fetch(PDO::FETCH_ASSOC);

// Handle missing user record
if (!$user) {
    echo "<script>
            alert('User not found. Please log in again.');
            window.location.href='index.php';
          </script>";
    exit;
}

// Fetch group's area
$sql_group = "SELECT area_name FROM community_groups WHERE id = :group_id";
$query_group = $dbh->prepare($sql_group);
$query_group->bindParam(':group_id', $group_id, PDO::PARAM_INT);
$query_group->execute();
$group = $query_group->fetch(PDO::FETCH_ASSOC);

// Handle missing group record
if (!$group) {
    echo "<script>
            alert('Community group not found.');
            window.location.href='community_group1.php';
          </script>";
    exit;
}

// Compare user's area with group's area
if ($user['area'] === $group['area_name']) {
    // Redirect to group feed if areas match
    header("Location: group_feed.php?group_id=$group_id");
    exit;
} else {
    // Show error message for mismatched area
    echo "<script>
            alert('You can only join the group for your area.');
            window.location.href='community_group1.php';
          </script>";
    exit;
}
?>
