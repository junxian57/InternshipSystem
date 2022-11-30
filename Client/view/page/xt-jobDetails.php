<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
/*if (strlen($_SESSION['bpmsaid'] == 0)) {
	//header('location:logout.php');
} else {*/
?>

<?php
	if(isset($_GET['internJobID'])){
    $internJobID = $_GET['internJobID'];
  }
?>

<!DOCTYPE HTML>
<html>
<head>
	<title>ITP System | Job Details</title>
	<link href="../../css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="../../css/style.css" rel='stylesheet' type='text/css' />
	<link href="../../css/font-awesome.css" rel="stylesheet">
	<link href="../../css/xt-jobDetails.css" rel="stylesheet">
	<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
	<link href="../../css/animate.css" rel="stylesheet" type="text/css" media="all">
	<link href="../../css/custom.css" rel="stylesheet">
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
	
	<script src="../../js/jquery-1.11.1.min.js"></script>
	<script src="../../js/modernizr.custom.js"></script>
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

<?php
function  confirmationMsgBox(){
  echo '<script type="text/javascript"> ';
  echo 'function openulr(newurl) {';
  echo 'if (confirm("Are you sure you want to apply for this job?")) {';
  echo '    document.location = newurl;';
  echo '  	}';
  echo '		}';
  echo '</script>';
}
?>

<?php
	confirmationMsgBox();
?>

<body class="cbp-spmenu-push">
	<div class="main-content">
		<?php include_once('../../includes/sidebar.php'); ?>
		<?php include_once('../../includes/header.php'); ?>
		<div id="page-wrapper">
			<div class="main-page">
				<div class="tables">
					<section class="details" id="details">
						<div class="details-row">
						<?php
								$host = "sql444.main-hosting.eu";
                $user = "u928796707_group34";
                $password = "u1VF3KYO1r|";
                $database = "u928796707_internshipWeb";
                                              
                $conn = mysqli_connect($host, $user, $password, $database); 

                $get_intern = "SELECT * FROM InternJob WHERE internJobID = '$internJobID'";
                $run_intern = mysqli_query($conn, $get_intern);
                $row_intern = mysqli_fetch_array($run_intern);
                $internJobID = $row_intern['internJobID'];
                $cmpID = $row_intern['companyID'];
                $jobTitle = $row_intern['jobTitle'];
								$jobDescription = $row_intern['jobDescription'];
								$jobAllowance = $row_intern['jobAllowance'];
								$jobResponsibilities = $row_intern['jobResponsibilities'];
								$jobLocationOfWork = $row_intern['jobLocationOfWork'];
								$jobWorkingDay = $row_intern['jobWorkingDay'];
								$jobWorkingHour = $row_intern['jobWorkingHour'];
								$jobSkillsRequired = $row_intern['jobSkillsRequired'];
								$jobMaxNumberQuota = $row_intern['jobMaxNumberQuota'];
								$jobQualificationRequired = $row_intern['jobQualificationRequired'];
                $jobFieldsArea = $row_intern['jobFieldsArea'];
								$jobTrainingPeriod = $row_intern['jobTrainingPeriod'];
								$jobSupervisorContactNo = $row_intern['jobSupervisorContactNo'];
								$jobSupervisorEmail = $row_intern['jobSupervisorEmail'];
								$jobCmpSupervisor = $row_intern['jobCmpSupervisor'];

								$get_cmp = "SELECT * FROM Company WHERE companyID = '$cmpID'";
                $run_cmp = mysqli_query($conn, $get_cmp);
								$row_cmp = mysqli_fetch_array($run_cmp);
								$cmpName = $row_cmp['cmpName'];
								$cmpCompanySize = $row_cmp['cmpCompanySize'];
								$cmpAddress = $row_cmp['cmpAddress'];
								$cmpEmail = $row_cmp['cmpEmail'];
								$cmpContactNumber= $row_cmp['cmpContactNumber'];
								$cmpDateJoined = $row_cmp['cmpDateJoined'];
              ?>
							<div class="detailsimage">
								<img src='../images/taruc-logo.jpg'>
							</div> 
						</div>
						
						<div class="details-row">
							<div class="details-content">
                <h1 class="heading" >Guidewire Software Sdn. Bhd.</h1>
            	</div>
        		</div>
					</section>
					
					<section class="jobdetails" id="jobdetails">
						<h1 class="heading"> <span>Job</span> Description </h1>
						<div class="jobdetails-row">
							<div class="jobdetails-content" style="border-right: 1px solid #CCCCCC;">
								<h3>Job Details</h3>
								<p><?php echo $jobDescription; ?></p><br>
            		<h3>Responsibilities</h3>
            		<p><?php echo $jobResponsibilities; ?></p><br>
								<h3>Skills Required</h3>
            		<p><?php echo $jobSkillsRequired; ?></p><br>
								<h3>Qualification Required</h3>
            		<p><?php echo $jobQualificationRequired; ?></p><br>
							</div>
							<div class="jobdetails-content">
								<h3>Job Title</h3>
								<p><?php echo $jobTitle; ?></p><br>
            		<h3>Working Day</h3>
            		<p><?php echo $jobWorkingDay; ?></p><br>
            		<h3>Working Hour</h3>
            		<p><?php echo $jobWorkingHour; ?></p><br>
								<h3>Allowance</h3>
            		<p>RM <?php echo $jobAllowance; ?></p><br>
								<h3>Training Period</h3>
            		<p><?php echo $jobTrainingPeriod; ?> Months</p><br>
        			</div>   
							<div class="button-group">
								<button type="submit" class="backBtn"><a href='xt-searchJob.php'>Back</button>
              	<button type="submit" class="applyBtn"><a href="javascript:openulr('xt-studentJobApp.php');">Apply</button>
            	</div>
						</div>
					</section>

					<section class="cmpdetails" id="cmpdetails">
						<h1 class="heading"> <span>Company</span> Info </h1>
						<div class="cmpdetails-row">
							<div class="cmpdetails-image">
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.53663221214!2d101.72591861475746!3d3.2155572976588167!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc3843bfb6a031%3A0x2dc5e067aae3ab84!2sTunku%20Abdul%20Rahman%20University%20College%20(TAR%20UC)!5e0!3m2!1sen!2smy!4v1667794201482!5m2!1sen!2smy" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
							</div>
							
							<div class="cmpdetails-content">
								<h3><i class="fa-regular fa-envelope"></i>&nbsp Email</h3>
								<p><?php echo $cmpEmail; ?></p><br>
            		<h3><i class="fa-regular fa-address-book"></i>&nbsp Contact Number</h3>
            		<p><?php echo $cmpContactNumber; ?></p><br>
            		<h3><i class="fa-regular fa-building"></i>&nbsp Company Size</h3>
            		<p><?php echo $cmpCompanySize; ?></p><br>
            		<h3><i class="fa-solid fa-signs-post"></i>&nbsp Location</h3>
            		<p><?php echo $cmpAddress; ?></p><br>
								<h3><i class="fa-solid fa-calendar-days"></i>&nbsp Date Joined</h3>
            		<p><?php echo $cmpDateJoined; ?></p>
        			</div>   
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>
	<script src="../../js/classie.js"></script>
	<script>
		var menuLeft = document.getElementById('cbp-spmenu-s1'),
			showLeftPush = document.getElementById('showLeftPush'),
			body = document.body;

		showLeftPush.onclick = function() {
			classie.toggle(this, 'active');
			classie.toggle(body, 'cbp-spmenu-push-toright');
			classie.toggle(menuLeft, 'cbp-spmenu-open');
			disableOther('showLeftPush');
		};

		function disableOther(button) {
			if (button !== 'showLeftPush') {
				classie.toggle(showLeftPush, 'disabled');
			}
		}
	</script>

	<script src="../../js/jquery.nicescroll.js"></script>
	<script src="../../js/scripts.js"></script>
	<script src="../../js/bootstrap.js"> </script>
</body>
</html>