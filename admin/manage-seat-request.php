<?php
session_start();
error_reporting(0);
include('includes/config.php');

// Check if the admin is logged in
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    // Mark a request as reviewed
    if (isset($_GET['markReviewed'])) {
        $requestId = intval($_GET['markReviewed']);
        $status = 1;
        $sql = "UPDATE seatrequests SET Status=:status WHERE id=:requestId";
        $query = $dbh->prepare($sql);
        $query->bindParam(':status', $status, PDO::PARAM_INT);
        $query->bindParam(':requestId', $requestId, PDO::PARAM_INT);
        $query->execute();
        $_SESSION['msg'] = "Request marked as reviewed successfully.";
        header('location:manage-seat-request.php');
    }
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

    <title>Bachelor Platform | Admin Manage Seat Requests</title>

    <!-- Font awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap Datatables -->
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <!-- Admin Style -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        .errorWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #dd3d36;
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        }

        .succWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #5cb85c;
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        }
    </style>
</head>

<body>
    <?php include('includes/header.php'); ?>

    <div class="ts-main-content">
        <?php include('includes/leftbar.php'); ?>
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-title">Manage Seat Requests</h2>

                        <!-- Display Success or Error Message -->
                        <?php if ($_SESSION['msg']) { ?>
                            <div class="succWrap"><strong>SUCCESS</strong>: <?php echo htmlentities($_SESSION['msg']); ?></div>
                        <?php unset($_SESSION['msg']); } ?>

                        <!-- Seat Requests Table -->
                        <div class="panel panel-default">
                            <div class="panel-heading">All Seat Requests</div>
                            <div class="panel-body">
                                <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Seat Details</th>
                                            <th>Contact Number</th>
                                            <th>Images</th>
                                            <th>Request Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Seat Details</th>
                                            <th>Contact Number</th>
                                            <th>Images</th>
                                            <th>Request Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM seatrequests";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;

                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) {
                                        ?>
                                                <tr>
                                                    <td><?php echo htmlentities($cnt); ?></td>
                                                    <td><?php echo htmlentities($result->fullname); ?></td>
                                                    <td><?php echo htmlentities($result->contactno); ?></td>
                                                    <td>
                                                        <?php
                                                        $images = explode(',', $result->Image1);
                                                        foreach ($images as $image) {
                                                            if (!empty($image)) {
                                                                echo "<img src='uploads/$image' width='50' height='50' style='margin-right:5px;' />";
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php echo htmlentities($result->submission_date); ?></td>
                                                    <td><?php echo $result->Status == 1 ? 'Reviewed' : 'Pending'; ?></td>
                                                    <td>
                                                        <?php if ($result->Status == 0) { ?>
                                                            <a href="manage-seat-request.php?markReviewed=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Mark as reviewed?');">Mark Reviewed</a>
                                                        <?php } else { ?>
                                                            Reviewed
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                        <?php
                                                $cnt++;
                                            }
                                        } else {
                                            echo "<tr><td colspan='7'>No seat requests found.</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/dataTables.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
<?php } ?>
