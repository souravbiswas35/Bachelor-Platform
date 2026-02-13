<?php
session_start();
include('includes/config.php');
error_reporting(E_ALL);
ini_set('display_errors', 1); // Enable error reporting for debugging

if (!isset($_SESSION['user_id'])) {
    // header("Location: index.php");
    echo '<script>
         alert("Please log in to view community.");
         window.location.href = "index.php";
     </script>';
     exit;
 }

$user_id = $_SESSION['user_id'];

// Fetch user's area from the database
$user_query = "SELECT area FROM users WHERE id = ?";
$user_stmt = $dbh->prepare($user_query);
$user_stmt->bindParam(1, $user_id);
$user_stmt->execute();
$user_area = $user_stmt->fetch(PDO::FETCH_ASSOC)['area'];

// Check if user has an unresolved group creation request
$check_request = "SELECT * FROM group_requests WHERE user_id = ? AND is_verified = 0";
$request_stmt = $dbh->prepare($check_request);
$request_stmt->bindParam(1, $user_id);
$request_stmt->execute();
$request_exists = $request_stmt->fetch(PDO::FETCH_ASSOC);

$sql_groups = "SELECT * FROM community_groups WHERE area_name = ? ORDER BY created_at DESC";
$query_groups = $dbh->prepare($sql_groups);
$query_groups->execute([$user_area]);
$groups = $query_groups->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bachelor Platform | Community Group</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- SWITCHER -->
		<link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all" data-default-color="true" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />
        
<!-- Fav and touch icons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
</head>
<body>

    <!-- Start Switcher -->
<?php include('includes/colorswitcher.php');?>
<!-- /Switcher --> 
    <?php include('includes/header.php'); ?>

    <!-- Page Header -->
    <section class="cg-header listing_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>Community Group</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li>Community Group</li>
      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>

    <!-- Community Group Listing Section -->
    <section class="section-padding white-bg">
        <div class="container">
            <div class="row">
                <?php if (!empty($groups)): foreach ($groups as $group): ?>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <h5 class="card-title"><?= htmlentities($group['title']); ?></h5>
                            <p class="card-text"><?= htmlentities($group['description']); ?></p>
                            <a href="community_group2.php?group_id=<?= $group['id']; ?>" class="btn btn-primary">Join Group</a>
                        </div>
                    </div>
                <?php endforeach; else: ?>
                    <p class="text-center">No community groups available in your area.</p>
                <?php endif; ?>
                <?php if (!$request_exists): ?>
                    <div class="text-center">
                        <button class="btn btn-warning" data-toggle="modal" data-target="#requestModal">Request a New Community Group</button>
                    </div>
                <?php else: ?>
                    <p class="text-center">Your previous request is still being processed. Please wait until it is resolved.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Modal for New Group Request -->
    <div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="requestModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="requestModalLabel">Request New Group</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="request_group.php" method="post">
                        <div class="form-group">
                            <label for="userArea">Area</label>
                            <input type="text" class="form-control" id="userArea" name="userArea" value="<?= $user_area; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="groupRequest">Why do you need a group in your area?</label>
                            <textarea class="form-control" id="groupRequest" name="groupRequest" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Request</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>
</body>
</html>
