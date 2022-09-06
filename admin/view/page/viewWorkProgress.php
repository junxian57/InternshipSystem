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
	<title>ITP System | Student Work Progress</title>
	<link href="../../css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="../../css/style.css" rel='stylesheet' type='text/css' />
	<link href="../../css/font-awesome.css" rel="stylesheet">
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
				<div class="tables">
					<h3 class="title1">Student Work Progress</h3>
					<div class="table-responsive bs-example widget-shadow">
						<h4>Weekly Work Progress Report:</h4>
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Weekly Report ID</th>
										<th>Submit Date Time</th>
										<th>Report</th>
										<th>Submit On Time</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$get_weekRpt = "SELECT * FROM weeklyReport";
									$run_weekRpt = mysqli_query($conn, $get_weekRpt);
									while($row_WeekRpt = mysqli_fetch_array($run_weekRpt)){
										$weekRptID = $row_WeekRpt['weeklyReportID'];
										$submitDateTime = $row_WeekRpt['submitDateTime'];
										$submitOnTime = $row_WeekRpt['submitOnTime'];
									?>
									<tr>
									  <td><?php echo $weekRptID; ?></td>
										<td><?php echo $submitDateTime; ?></td>
										<td><?php echo $submitOnTime ?></td>
										<td><a href="view-appointment.php?viewid=<?php echo $weekRptID; ?>">View</a></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="js/classie.js"></script>
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
	<footer><?php include_once('includes/footer.php'); ?></footer>
	</html>