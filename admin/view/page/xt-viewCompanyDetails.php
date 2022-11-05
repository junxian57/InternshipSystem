<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
/*if (strlen($_SESSION['bpmsaid'] == 0)) {
	//header('location:logout.php');
} else {*/
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>ITP System | Company Details</title>
	<link href="../../css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="../../css/style.css" rel='stylesheet' type='text/css' />
	<link href="../../css/font-awesome.css" rel="stylesheet">
	<link href="../../css/xt-viewCompanyDetails.css" rel="stylesheet">
	<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
	<link href="../../css/animate.css" rel="stylesheet" type="text/css" media="all">
	<link href="../../css/custom.css" rel="stylesheet">

	<script src="../../js/jquery-1.11.1.min.js"></script>
	<script src="../../js/modernizr.custom.js"></script>>
	<script src="../../js/wow.min.js"></script>
	<script src="../../js/metisMenu.min.js"></script>
	<script src="../../js/custom.js"></script>

  <script>
		new WOW().init();
	</script>
		
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);
	
		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
</head>

<body class="cbp-spmenu-push">
	<div class="main-content">
		<?php include_once('../../includes/sidebar.php'); ?>
		<?php include_once('../../includes/header.php'); ?>
		<div id="page-wrapper">
			<div class="main-page">
				<div class="tablesr">
					<h3 class="title1">Company Details</h3>
          <div class="container">
            <div class="inputBox">
              <div class="viewInput">
                <span>Company Name</span>
                <input type="text" name="cmpName" readonly value="<?php echo$cmpName; ?>">
              </div>
            
              <div class="viewInput">
                <span>Email</span>
                <input type="text" name="cmpEmail" readonly value="<?php echo$cmpEmail; ?>">
              </div>
            
              <div class="viewInput">
                <span>Contact Number</span>
                <input type="text" name="cmpContactNumber" readonly value="<?php echo$cmpContactNumber; ?>">
              </div>

              <div class="viewInput">
                <span>State</span>
                <input type="text" name="cmpState" readonly value="<?php echo$cmpState; ?>">
              </div>

              <div class="viewInput">
                <span>Company Size</span>
                <input type="text" name="cmpCompanySize" readonly value="<?php echo$cmpCompanySize; ?>">
              </div>

              <div class="viewInput">
                <span>Fields Area</span>
                <input type="text" name="cmpFieldsArea" readonly value="<?php echo$cmpFieldsArea; ?>">
              </div>

              <div class="viewInput">
                <span>Rating</span>
                <input type="text" name="cmpRating" readonly value="<?php echo$cmpRating; ?>">
              </div>

              <div class="viewInput">
                <span>Average Allowance</span>
                <input type="text" name="cmpFieldsArea" readonly value="<?php echo$cmpFieldsArea; ?>">
              </div>

              <div class="viewInput" style="width:100%;">
                <span>Address</span>
                <textarea type="text" name="cmpAddress" readonly value="<?php echo$cmpAddress; ?>"></textarea>
              </div>      
            </div>
            <div class="button-group">
              <button type="submit" class="approveBtn"><i class="fa fa-check" aria-hidden="true"></i>  Accept</button>
              <button type="submit" class="rejectBtn"><i class="fa fa-times" aria-hidden="true"></i>  Reject</button>
            </div>
          </div>
        </div>
		</div>
	</div>
	
	<script src="../../js/classie.js"></script>
	<script src="../../js/jquery.nicescroll.js"></script>
	<script src="../../js/scripts.js"></script>
	<script src="../../js/bootstrap.js"> </script>
</body>
</html>