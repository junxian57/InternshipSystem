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
	<link href="../../css/xt-workProgress.css" rel="stylesheet">
	<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
	<link href="../../css/animate.css" rel="stylesheet" type="text/css" media="all">
	<link href="../../css/custom.css" rel="stylesheet">

	<script src="../../js/jquery-1.11.1.min.js"></script>
	<script src="../../js/modernizr.custom.js"></script>>
	<script src="../../js/wow.min.js"></script>
	<script src="../../js/metisMenu.min.js"></script>
	<script src="../../js/custom.js"></script>

  <style>
    .container{
      max-width: 65rem;
      border-radius: .5rem;
      box-shadow: 0 5px 5px #000;
      border: .1rem solid #000;
      background: #fff;
      padding: 4.5rem;
      margin: 0 auto;
    }

    .container .inputBox{
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
    }

    .container .inputBox .viewInput{
      width: 48%;
    }

    .container.inputBox .viewInput span{
      display: block;
      padding: .5rem 0;
      font-size: 17px;
      color: #fff;
      font-weight: bold;
    }

    .container .inputBox .viewInput input,
    .container .inputBox .viewInput textarea,
    .container .inputBox .viewInput select{
      background: #fff;
      border-radius: .5rem;
      padding: .5rem;
      font-size: 15px;
      color: #000;
      text-transform: none;
      margin-bottom: 1rem;
      width: 100%;
    }

    .container .inputBox .viewInput textarea{
      height: 10rem;
      resize: none;
    }
  </style>
		
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

              <div class="viewInput">
                <span>Address</span>
                <textarea type="text" name="cmpAddress" readonly value="<?php echo$cmpAddress; ?>"></textarea>
              </div>      
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
<footer><?php include_once('includes/footer.php'); ?></footer>
</html>