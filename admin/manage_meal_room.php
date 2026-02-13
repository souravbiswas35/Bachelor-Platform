<?php
ob_start();
include_once 'database/Session2.php';
Session::checkSession();
?>

<?php
$msg = " ";

include("database/Connection.php");
include("database/Formet.php");
$db = new Database();
$fm = new Format();
?>

<?php
// Handle delete functionality
if (isset($_GET["delete"])) {
    $email12 = $_GET["delete"];

    $query4 = "DELETE FROM reg WHERE email='$email12'";
    $result4 = $db->delete($query4);

    if ($result4) {
        $msg3 = "<div class='alert alert-success'><span>Successfully Deleted!</span></div>";
    } else {
        $msg3 = "<div class='alert alert-danger'><span>Please Try Again!</span></div>";
    }
}

// Handle approve functionality
if (isset($_GET["approve"])) {
    $email = $_GET["approve"];

    // Check if active is already 1
    $checkQuery = "SELECT active FROM reg WHERE email='$email'";
    $checkResult = $db->select($checkQuery);
    if ($checkResult) {
        $row = $checkResult->fetch_assoc();
        if ($row['active'] == 1) {
            $msg3 = "<div class='alert alert-danger'><span>This mess already exists!</span></div>";
        } else {
            // Update active to 1
            $updateQuery = "UPDATE reg SET active=1 WHERE email='$email'";
            $updateResult = $db->update($updateQuery);
            if ($updateResult) {
                $msg3 = "<div class='alert alert-success'><span>Mess Approved Successfully!</span></div>";
            } else {
                $msg3 = "<div class='alert alert-danger'><span>Approval Failed! Please Try Again!</span></div>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">

    <title>Bachelor Platform |Admin Manage Subscribers </title>

    <!-- Font awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Sandstone Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap Datatables -->
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <!-- Bootstrap social button library -->
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <!-- Bootstrap select -->
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <!-- Bootstrap file input -->
    <link rel="stylesheet" href="css/fileinput.min.css">
    <!-- Awesome Bootstrap checkbox -->
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <!-- Admin Stye -->
    <link rel="stylesheet" href="css/style.css">
    <style type="text/css">
        body {
            font-family: 'Lato';
        }

        label {
            font-size: 20px;
        }

        .side ul li a {
            text-decoration: none;
        }
    </style>
</head>

<body>

    <?php if (isset($_GET['action']) && $_GET['action'] == "logout")
        Session::destroy();
    ?>
    <?php include('includes/header.php'); ?>

    <div class="ts-main-content">
        <?php include('includes/leftbar.php'); ?>
        <div class="content-wrapper">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">

                        <h2 class="page-title">Manage Meal Rooms</h2>

                        <!-- Zero Configuration Table -->
                        <div class="panel panel-default">
                            <div class="panel-heading">All Mess List</div>
                            <div class="panel-body">
                                <?php if (isset($msg3)) echo $msg3; ?>
                                <table id="zctb" class="display table table-striped table-bordered table-hover"
                                    cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Mess Name</th>
                                            <th>Mess Email</th>
                                            <th>Password</th>
                                            <th>Manager</th>
                                            <th>Confirmation</th>
                                            <th>Delete</th>
                                            <th>Approve</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Mess Name</th>
                                            <th>Mess Email</th>
                                            <th>Password</th>
                                            <th>Manager</th>
                                            <th>Confirmation</th>
                                            <th>Delete</th>
                                            <th>Approve</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                        <?php
                                        $query = "SELECT * FROM reg";
                                        $result = $db->select($query);
                                        if ($result) {
                                            $i = 1;
                                            while ($row = $result->fetch_assoc()) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $row['messname']; ?></td>
                                                    <td><?php echo $row['email']; ?></td>
                                                    <td><?php echo $row['password']; ?></td>
                                                    <td><?php echo $row['mname']; ?></td>
                                                    <td><?php echo $row['active']; ?></td>
                                                    <td>
                                                        <a class="btn btn-danger" onclick="return confirm('Are you sure you want to Block This Mess?')" href="?delete=<?php echo $row['email']; ?>">Delete</a>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-success" onclick="return confirm('Do you want to Approve this Mess?')" href="?approve=<?php echo $row['email']; ?>">Approve</a>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
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

</body>

</html>
