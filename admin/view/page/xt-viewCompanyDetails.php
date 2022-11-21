<?php
session_start();
error_reporting(0);
include('../../includes/db_connection.php');
?>

<?php
  $host = "sql444.main-hosting.eu";
  $user = "u928796707_group34";
  $password = "u1VF3KYO1r|";
  $database = "u928796707_internshipWeb";
                              
  $conn = mysqli_connect($host, $user, $password, $database); 

  if(isset($_GET['cmpID'])){
    $cmpID = $_GET['cmpID'];
    $get_cmp = "SELECT * FROM Company WHERE companyID = '$cmpID'";
    $run_cmp = mysqli_query($conn, $get_cmp);
    $row_cmp = mysqli_fetch_array($run_cmp);
    $cmpID = $row_cmp['companyID'];
    $cmpName = $row_cmp['cmpName'];
    $cmpEmail = $row_cmp['cmpEmail'];
    $cmpContactNumber = $row_cmp['cmpContactNumber'];
    $cmpAddress = $row_cmp['cmpAddress'];
    $cmpState = $row_cmp['cmpState'];
    $cmpCity = $row_cmp['cmpCity'];
    $cmpPostCode = $row_cmp['cmpPostCode'];
    $cmpSize = $row_cmp['cmpCompanySize'];
    $cmpFieldsArea = $row_cmp['cmpFieldsArea'];
    $cmpRating = $row_cmp['cmpRating'];
    $cmpAverageAllowanceGiven = $row_cmp['cmpAverageAllowanceGiven'];
  }
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
					<h3 class="title1">Company Review</h3>
          <div class="container">
            <div class="subtitle">
              <h2 class="sub-1">Company General Information</h2>
            </div>
            
            <div class="inputBox">
              <div class="viewInput">
                <span>Company Name</span>
                
                <input type="text" name="cmpName" readonly value="<?php echo $cmpName; ?>">
              </div>
            
              <div class="viewInput">
                <span>Email</span>
                <input type="text" name="cmpEmail" readonly value="<?php echo $cmpEmail; ?>">
              </div>
            
              <div class="viewInput">
                <span>Contact Number</span>
                <input type="text" name="cmpContactNumber" readonly value="<?php echo $cmpContactNumber; ?>">
              </div>
            </div>

            <div class="subtitle">
              <h2 class="sub-2">Company Address</h2>
            </div>
            
            <div class="inputBox">
              <div class="viewInput" style="width:100%;">
                <span>Address</span>
                <textarea type="text" name="cmpAddress" readonly><?php echo $cmpAddress; ?></textarea>
              </div>   

              <div class="viewInput">
                <span>State</span>
                <input type="text" name="cmpState" readonly value="<?php echo $cmpState; ?>">
              </div>

              <div class="viewInput">
                <span>City</span>
                <input type="text" name="cmpCity" readonly value="<?php echo $cmpCity; ?>">
              </div>

              <div class="viewInput">
                <span>Postcode</span>
                <input type="text" name="cmpPostcode" readonly value="<?php echo $cmpPostCode; ?>">
              </div>
            </div>

            <div class="subtitle">
              <h2 class="sub-3">Company Details</h2>
            </div>
            
            <div class="inputBox">
              <div class="viewInput">
                <span>Company Size</span>
                <input type="text" name="cmpCompanySize" readonly value="<?php echo $cmpSize; ?>">
              </div>

              <div class="viewInput">
                <span>Fields Area</span>
                <input type="text" name="cmpFieldsArea" readonly value="<?php echo $cmpFieldsArea; ?>">
              </div>

              <div class="viewInput">
                <span>Rating</span>
                <input type="text" name="cmpRating" readonly value="<?php echo $cmpRating; ?>">
              </div>

              <div class="viewInput">
                <span>Average Allowance</span>
                <input type="text" name="cmpFieldsArea" readonly value="<?php echo $cmpAverageAllowanceGiven; ?>">
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