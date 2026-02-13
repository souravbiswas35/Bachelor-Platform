<?php
session_start();
include('includes/config.php');

// Ensure user is logged in
if (!isset($_SESSION['login'])) {
    header('location:index.php');
    exit;
}

// Ensure user_id is set in session
if (!isset($_SESSION['user_id'])) {
    die('User ID not set. Please log in again.');
}

// Attempt to set group_id from GET request if not in session
if (isset($_GET['group_id'])) {
    $_SESSION['group_id'] = $_GET['group_id'];
} elseif (!isset($_SESSION['group_id'])) {
    die('No group selected. Please select a group.');
}

// Fetch posts along with user and group information
$sql = "SELECT p.id, p.group_id, p.user_id, p.content, p.image, p.created_at, u.fullName AS username
        FROM posts p
        JOIN users u ON p.user_id = u.id
        WHERE p.group_id = :group_id";
$query = $dbh->prepare($sql);
$query->bindParam(':group_id', $_SESSION['group_id'], PDO::PARAM_INT);
$query->execute();
$posts = $query->fetchAll(PDO::FETCH_OBJ);

$msg = "";
$error = "";

// Handle post submission
if (isset($_POST['submit'])) {
    $content = $_POST['content'];
    $image = !empty($_FILES['image']['tmp_name']) ? file_get_contents($_FILES['image']['tmp_name']) : null;
    $user_id = $_SESSION['user_id'];

    $insert_sql = "INSERT INTO posts (group_id, user_id, content, image) VALUES (:group_id, :user_id, :content, :image)";
    $insert_query = $dbh->prepare($insert_sql);
    $insert_query->bindParam(':group_id', $_SESSION['group_id'], PDO::PARAM_INT);
    $insert_query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $insert_query->bindParam(':content', $content, PDO::PARAM_STR);
    $insert_query->bindParam(':image', $image, PDO::PARAM_LOB);

    if ($insert_query->execute()) {
        $msg = "Post added successfully.";
        header("Location: community_group2.php");
        exit;
    } else {
        $error = "Failed to add the post.";
    }
}

// Handle report submission
if (isset($_POST['report'])) {
    $reason = $_POST['report_reason'];
    $post_id = $_POST['post_id'];
    $reported_by = $_SESSION['user_id'];

    $report_sql = "INSERT INTO reports (post_id, reported_by, reason) VALUES (:post_id, :reported_by, :reason)";
    $report_query = $dbh->prepare($report_sql);
    $report_query->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $report_query->bindParam(':reported_by', $reported_by, PDO::PARAM_INT);
    $report_query->bindParam(':reason', $reason, PDO::PARAM_STR);

    if ($report_query->execute()) {
        $msg = "Report submitted successfully.";
    } else {
        $error = "Failed to submit the report.";
    }
}

// Handle post deletion
if (isset($_POST['delete_post'])) {
    $post_id = $_POST['post_id'];

    $delete_sql = "DELETE FROM posts WHERE id = :post_id AND user_id = :user_id";
    $delete_query = $dbh->prepare($delete_sql);
    $delete_query->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $delete_query->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);

    if ($delete_query->execute()) {
        $msg = "Post deleted successfully.";
        header("Location: community_group2.php");
        exit;
    } else {
        $error = "Failed to delete the post.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Groups</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <!--Custome Style -->
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <!--OWL Carousel slider-->
    <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!--slick-slider -->
    <link href="assets/css/slick.css" rel="stylesheet">
    <!--bootstrap-slider -->
    <link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
    <!--FontAwesome Font Style -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">



    <!--
<script src="https://cdn.tailwindcss.com"></script>
    
    
-->
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
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
        href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
        href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">

    <style>
        .post-card {
            background: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 15px;
            overflow: hidden;
        }

        .post-card img {
            width: 100%;
            max-height: 300px;
            object-fit: contain;
            margin-top: 10px;
        }

        .post-card .meta {
            font-size: 0.875rem;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <!-- Start Switcher -->
    <?php include('includes/colorswitcher.php'); ?>
    <!-- /Switcher -->
    <?php include('includes/header.php'); ?>

    <h5 style="text-align: center; margin: 20px 0;">Post To This Community</h5>

    <div class="container mt-5">
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlentities($error); ?></div>
        <?php endif; ?>
        <?php if ($msg): ?>
            <div class="alert alert-success"><?= htmlentities($msg); ?></div>
        <?php endif; ?>

        <!-- Form for creating a new post -->
        <div class="mb-3">
            <form action="" method="post" enctype="multipart/form-data">
                <textarea name="content" class="form-control mb-2" placeholder="Write something..."></textarea>
                <input type="file" name="image" class="form-control mb-2">
                <button type="submit" name="submit" class="btn btn-primary" style="margin: 20px 0;">Post</button>
            </form>
        </div>

        <?php foreach (array_reverse($posts) as $post): ?>
            <div class="post-card">
                <div style="padding: 1rem; position: relative;">
                    <h2 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 0.5rem;">
                        <?= htmlentities($post->username); ?></h2>
                    <p style="color: #4A5568;"><?= htmlentities($post->content); ?></p>
                    <div style="margin-top: 0.75rem;">
                        <?php if ($post->image): ?>
                            <img src="data:image/jpeg;base64,<?= base64_encode($post->image); ?>"
                                style="width: 100%; object-fit: contain;" />
                        <?php endif; ?>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1rem;">
                        <span
                            style="font-size: 0.875rem; color: #4A5568;"><?= date('F j, Y, g:i a', strtotime($post->created_at)); ?></span>
                        <?php if ($_SESSION['user_id'] == $post->user_id): ?>
                            <a href="edit_post.php?id=<?= $post->id; ?>"
                                style="padding: 0.75rem 1.5rem; background-color: #3182CE; color: white; font-size: 1rem; font-weight: bold; border-radius: 0.25rem; text-decoration: none; transition: background-color 0.2s;">Edit</a>
                            <form action="" method="post" style="display:inline;">
                                <input type="hidden" name="post_id" value="<?= $post->id; ?>">
                                <button type="submit" name="delete_post"
                                    style="padding: 0.75rem 1.5rem; background-color: #E53E3E; color: white; font-size: 1rem; font-weight: bold; border-radius: 0.25rem; transition: background-color 0.2s; border: none;">Delete</button>
                            </form>
                        <?php endif; ?>
                        <button onclick="reportPost(<?= $post->id; ?>);"
                            style="padding: 0.75rem 1.5rem; background-color: #E53E3E; color: white; font-size: 1rem; font-weight: bold; border-radius: 0.25rem; transition: background-color 0.2s;">Report</button>
                    </div>
                    <?php if ($post->image): ?>
                        <button onclick="downloadImage('<?= base64_encode($post->image); ?>', 'post_image.jpg');"
                            style="position: absolute; top: 10px; right: 10px; padding: 0.5rem 1rem; background-color: #3182CE; color: white; font-size: 1rem; font-weight: bold; border-radius: 0.25rem;">Download Image</button>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <script>
        function reportPost(postId) {
            var reason = prompt("Please enter your reason for reporting this post:");
            if (reason) {
                document.getElementById('report_reason').value = reason;
                document.getElementById('post_id').value = postId;
                document.getElementById('report_form').submit();
            }
        }
    </script>
    <form id="report_form" method="POST" style="display:none;">
        <input type="hidden" id="report_reason" name="report_reason">
        <input type="hidden" id="post_id" name="post_id">
    </form>
</body>
<script>
    function downloadImage(imageData, filename) {
        var link = document.createElement('a');
        link.href = 'data:image/jpeg;base64,' + imageData;
        link.download = filename;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
</script>
    <?php include('includes/footer.php'); ?>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>

</html>