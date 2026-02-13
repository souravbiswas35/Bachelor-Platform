<?php
session_start();
include('includes/config.php');

// Ensure admin is logged in
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
    exit;
}

// Check if the 'id' query parameter is present
if (isset($_GET['id'])) {
    $groupId = intval($_GET['id']);

    // SQL to delete the community group
    $sql = "DELETE FROM community_groups WHERE id = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $groupId, PDO::PARAM_INT);

    try {
        if ($query->execute()) {
            $_SESSION['msg'] = "Community group deleted successfully";
            header('Location: manage_community_groups.php');
            exit;
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again.";
            header('Location: manage_community_groups.php');
            exit;
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Database error: " . $e->getMessage();
        header('Location: manage_community_groups.php');
        exit;
    }
} else {
    $_SESSION['error'] = "Invalid request";
    header('Location: manage_community_groups.php');
    exit;
}
?>
