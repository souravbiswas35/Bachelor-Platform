<?php
session_start();
include('includes/config.php');

// Ensure admin is logged in
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
    exit;
}

$msg = $error = '';

// Fetch the group details for editing
if (isset($_GET['id'])) {
    $groupId = intval($_GET['id']);

    $sql = "SELECT * FROM community_groups WHERE id = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $groupId, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);

    if (!$result) {
        header('Location: manage_community_groups.php');
        exit;
    }
} else {
    header('Location: manage_community_groups.php');
    exit;
}

// Update the group details
if (isset($_POST['update'])) {
    $area_name = htmlspecialchars($_POST['area_name']);
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);

    $sqlUpdate = "UPDATE community_groups SET area_name = :area_name, title = :title, description = :description WHERE id = :id";
    $queryUpdate = $dbh->prepare($sqlUpdate);
    $queryUpdate->bindParam(':area_name', $area_name, PDO::PARAM_STR);
    $queryUpdate->bindParam(':title', $title, PDO::PARAM_STR);
    $queryUpdate->bindParam(':description', $description, PDO::PARAM_STR);
    $queryUpdate->bindParam(':id', $groupId, PDO::PARAM_INT);

    if ($queryUpdate->execute()) {
        $msg = "Community group updated successfully!";
    } else {
        $error = "Something went wrong. Please try again.";
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">
    <title>Edit Community Group | Admin</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include('includes/header.php'); ?>
    <div class="ts-main-content">
        <?php include('includes/leftbar.php'); ?>
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-title">Edit Community Group</h2>

                        <?php if($error): ?><div class="alert alert-danger"><?php echo htmlentities($error); ?></div><?php endif; ?>
                        <?php if($msg): ?><div class="alert alert-success"><?php echo htmlentities($msg); ?></div><?php endif; ?>

                        <form method="POST" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Area Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="area_name" required value="<?php echo htmlentities($result->area_name); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title" required value="<?php echo htmlentities($result->title); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="description" required><?php echo htmlentities($result->description); ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-2">
                                    <button class="btn btn-primary" name="update" type="submit">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
