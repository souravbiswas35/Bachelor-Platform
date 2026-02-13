<?php
session_start();
include('includes/config.php');

// Ensure user is logged in
if (!isset($_SESSION['login'])) {
    header('location:index.php');
    exit;
}

// Ensure a post ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('Invalid post ID.');
}

$post_id = intval($_GET['id']);
$user_id = $_SESSION['user_id']; // Assume user_id is stored in session

// Fetch the post details
$sql = "SELECT content, image FROM posts WHERE id = :post_id AND user_id = :user_id";
$query = $dbh->prepare($sql);
$query->bindParam(':post_id', $post_id, PDO::PARAM_INT);
$query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$query->execute();
$post = $query->fetch(PDO::FETCH_OBJ);

if (!$post) {
    die('Post not found or you do not have permission to edit this post.');
}

$msg = "";
$error = "";

// Handle post update
if (isset($_POST['update'])) {
    $content = $_POST['content'];
    $image = !empty($_FILES['image']['tmp_name']) ? file_get_contents($_FILES['image']['tmp_name']) : null;

    // Update query
    if ($image) {
        $update_sql = "UPDATE posts SET content = :content, image = :image WHERE id = :post_id AND user_id = :user_id";
        $update_query = $dbh->prepare($update_sql);
        $update_query->bindParam(':image', $image, PDO::PARAM_LOB);
    } else {
        $update_sql = "UPDATE posts SET content = :content WHERE id = :post_id AND user_id = :user_id";
        $update_query = $dbh->prepare($update_sql);
    }

    $update_query->bindParam(':content', $content, PDO::PARAM_STR);
    $update_query->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $update_query->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    if ($update_query->execute()) {
        // Redirect to the main page after successful update
        header('Location: index.php');
        exit;
    } else {
        $error = "Failed to update the post.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <?php include('includes/header.php'); ?>

    <div class="container mt-5">
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlentities($error); ?></div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header">
                <h3>Edit Post</h3>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea name="content" id="content" class="form-control" rows="5"><?= htmlentities($post->content); ?></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <label for="image">Upload New Image (optional)</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <div class="form-group mt-3">
                        <?php if ($post->image): ?>
                            <p>Current Image:</p>
                            <img src="data:image/jpeg;base64,<?= base64_encode($post->image); ?>" alt="Current Image" class="img-fluid">
                        <?php endif; ?>
                    </div>
                    <button type="submit" name="update" class="btn btn-primary mt-3">Update Post</button>
                    <a href="index.php" class="btn btn-secondary mt-3">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
