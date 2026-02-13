<?php
session_start();
include('includes/config.php');

// Ensure admin is logged in
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
    exit;
}

$msg = $error = '';

// Handle form submission for adding a new community group
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_group'])) {
    $area_name = htmlspecialchars($_POST['area_name']);
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $default_user_id = 1; // Default system user ID for creating groups

    $sql = "INSERT INTO community_groups (user_id, area_name, title, description) VALUES (:user_id, :area_name, :title, :description)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':user_id', $default_user_id, PDO::PARAM_INT);
    $query->bindParam(':area_name', $area_name, PDO::PARAM_STR);
    $query->bindParam(':title', $title, PDO::PARAM_STR);
    $query->bindParam(':description', $description, PDO::PARAM_STR);

    try {
        if ($query->execute()) {
            $msg = "Community group added successfully!";
        } else {
            $error = "Something went wrong. Please try again.";
        }
    } catch (PDOException $e) {
        $error = "Database error: " . $e->getMessage();
    }
}

// Handle approving a request
if (isset($_GET['approve'])) {
    $requestId = intval($_GET['approve']);
    $sqlApprove = "UPDATE group_requests SET is_verified = 1 WHERE id = :id";
    $queryApprove = $dbh->prepare($sqlApprove);
    $queryApprove->bindParam(':id', $requestId, PDO::PARAM_INT);
    if ($queryApprove->execute()) {
        $msg = "Request approved successfully!";
    } else {
        $error = "Unable to approve the request.";
    }
}

// Handle rejecting a request
if (isset($_GET['reject'])) {
    $requestId = intval($_GET['reject']);
    $sqlReject = "UPDATE group_requests SET is_verified = 2 WHERE id = :id";
    $queryReject = $dbh->prepare($sqlReject);
    $queryReject->bindParam(':id', $requestId, PDO::PARAM_INT);
    if ($queryReject->execute()) {
        $msg = "Request rejected.";
    } else {
        $error = "Unable to reject the request.";
    }
}

// Fetch all community groups
$sql = "SELECT * FROM community_groups";
$query = $dbh->prepare($sql);
$query->execute();
$communityGroups = $query->fetchAll(PDO::FETCH_OBJ);

// Fetch pending group creation requests
$sqlRequests = "SELECT * FROM group_requests WHERE is_verified = 0";
$queryRequests = $dbh->prepare($sqlRequests);
$queryRequests->execute();
$requests = $queryRequests->fetchAll(PDO::FETCH_OBJ);
?>
<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">
    <title>Bachelor Platform | Admin Manage Community Groups</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
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
                        <h2 class="page-title">Manage Community Groups</h2>
                        <?php if ($error): ?><div class="errorWrap"><strong>ERROR</strong>: <?php echo htmlentities($error); ?></div><?php endif; ?>
                        <?php if ($msg): ?><div class="succWrap"><strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?></div><?php endif; ?>

                        <div class="panel panel-default">
                            <div class="panel-heading">Add Community Group</div>
                            <div class="panel-body">
                                <form method="POST">
                                    <div class="form-group">
                                        <label for="area_name">Area Name</label>
                                        <select name="area_name" id="area_name" class="form-control" required>
                                            <option value="">Select Area</option>
                                            <option value="Notun Bazar">Notun Bazar</option>
                                            <option value="Baridhara">Baridhara</option>
                                            <option value="Bashundhara R/A">Bashundhara R/A</option>
						                    <option value="Badda">Badda</option>
                                            <option value="Rampura">Rampura</option>
                                            <option value="Mohakhali">Mohakhali</option>
                                            <option value="Gulshan">Gulshan</option>
                                            <option value="Banani">Banani</option>
                                            <option value="Dhanmondi">Dhanmondi</option>
                                            <option value="Mirpur">Mirpur</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" id="title" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
                                    </div>
                                    <button type="submit" name="add_group" class="btn btn-primary">Add Community Group</button>
                                </form>
                            </div>
                        </div>


                        <!-- Display Community Groups -->
<div class="panel panel-default">
    <div class="panel-heading">Existing Community Groups</div>
    <div class="panel-body">
        <table class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Area Name</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Action</th> <!-- Assuming you might want some actions like edit/delete -->
                </tr>
            </thead>
            <tbody>
                <?php if ($communityGroups): ?>
                    <?php foreach ($communityGroups as $group): ?>
                    <tr>
                        <td><?php echo htmlentities($group->area_name); ?></td>
                        <td><?php echo htmlentities($group->title); ?></td>
                        <td><?php echo htmlentities($group->description); ?></td>
                        <td>
                            <a href="edit_community_group.php?id=<?php echo $group->id; ?>" class="btn btn-primary">Edit</a>
                            <a href="delete_community_group.php?id=<?php echo $group->id; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this group?');">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No community groups found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

                        <!-- Pending Group Requests -->
                        <div class="panel panel-default">
                            <div class="panel-heading">Pending Group Creation Requests</div>
                            <div class="panel-body">
                                <table class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Area</th>
                                            <th>Request Message</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($requests as $request): ?>
                                        <tr>
                                            <td><?php echo htmlentities($request->user_id); ?></td>
                                            <td><?php echo htmlentities($request->area); ?></td>
                                            <td><?php echo htmlentities($request->request_message); ?></td>
                                            <td>
                                                <a href="manage_community_groups.php?approve=<?php echo $request->id; ?>" class="btn btn-success">Approve</a>
                                                <a href="manage_community_groups.php?reject=<?php echo $request->id; ?>" class="btn btn-danger">Reject</a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
