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
	<title>ITP System | Companies Table</title>
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
					<h3 class="title1">Companies Table</h3>
					<div class="table-responsive bs-example widget-shadow">
						<!-- <h4>Companies List:</h4>
						 -->
						<div class="search-companiesGroup">

                                <div class="form-group">
                                    <label for="companies">Search Companies <span class="required-star">*</span></label>
                                    <input type="search" class="form-control" id="companies" name="companies" placeholder="Please Enter Information...." required="true">
                                    <!-- <div class="form-control result-box">

                                    </div> -->
                                </div>
                        </div>

						<div class="button-group">
                                <a class="clickable-btn" onclick="confirm('Confirm For Searching?')" href="index.php">Assign</a>
                                <a class="clickable-btn" href="#">Reset All</a>
                        </div>

						<hr>
						<div class="table-title">
                            <h4>Companies List</h4>
                        </div>
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Companies Name</th>
										<th>Hiring Position</th>
										<th>Rating</th>
										<th>Allowance</th>
										<th>Open For</th>
									</tr>
								</thead>
								<tbody>
                                        <tr>
                                            <td>Unilifesity SDN BHD</td>
                                            <td>Internship for IT</td>
                                            <td>1 Star</td>
                                            <td>RM800</td>
                                            <td>Diploma & Degree</td>
                                        </tr>
                                        <tr>
											<td>Samsung Malaysia</td>
                                            <td>Internship for HR</td>
                                            <td>5 Star</td>
                                            <td>RM1000.00 - RM1500.00</td>
                                            <td>Degree</td>
                                        </tr>
                                        <tr>
											<td>Hap Seng SDN BHD</td>
                                            <td>Internship for IT</td>
                                            <td>4 Star</td>
                                            <td>RM900.00 - RM1400.00</td>
                                            <td>Diploma & Degree</td>
                                        </tr>
                                        <tr>
											<td>Smazh Premium SDN BHD</td>
                                            <td>Technical Support</td>
                                            <td>2 Star</td>
                                            <td>RM800.00</td>
                                            <td>Diploma</td>
                                        </tr>
                                        <tr>
											<td>SkyWorld Development SDN BHD</td>
                                            <td>Internship for IT</td>
                                            <td>4 Star</td>
                                            <td>RM1000.00 - RM1700.00</td>
                                            <td>Degree</td>
                                        </tr>
                                        <tr>
											<td>Unilifesity SDN BHD</td>
                                            <td>Internship for IT</td>
                                            <td>3 Star</td>
                                            <td>RM500.00 - RM1000.00</td>
                                            <td>Diploma & Degree</td>
                                        </tr>
                                        <tr>
											<td>BMW Coding SDN BHD</td>
                                            <td>Internship for IT</td>
                                            <td>5 Star</td>
                                            <td>RM1100.00 - RM1800.00</td>
                                            <td>Degree</td>
                                        </tr>
                                        <tr>
											<td>KK Supermart & Superstore Sdn Bhd</td>
                                            <td>Internship for Accounting/ Auditing/ Finance</td>
                                            <td>3 Star</td>
                                            <td>RM700.00 - RM800.00</td>
                                            <td>Diploma & Degree</td>
                                        </tr>
                                        <tr>
											<td>Arissto (Malaysia) Sdn Bhd</td>
                                            <td>Dealership Senior Executive / Executive</td>
                                            <td>2 Star</td>
                                            <td>RM2800.00 - RM3500.00</td>
                                            <td>Diploma</td>
                                        </tr>
                                        <tr>
											<td>Prosains (M) Sdn Bhd</td>
                                            <td>Internship in Graphic Design</td>
                                            <td>3 Star</td>
                                            <td>RM500.00 - RM1000.00</td>
                                            <td>Diploma & Degree</td>
                                        </tr>
                                        <tr>
											<td>Origin Integrated Studios Sdn Bhd</td>
                                            <td>Mass Communication / Marketing (Intern)</td>
                                            <td>5 Star</td>
                                            <td>RM600.00 - RM1000.00</td>
                                            <td>Diploma & Degree</td>
                                        </tr>
                                        <tr>
											<td>Dommal Food Services Sdb Bhd</td>
                                            <td>Application Support - Intern</td>
                                            <td>3 Star</td>
                                            <td>RM500.00 - RM800.00</td>
                                            <td>Diploma & Degree</td>
                                        </tr>
                                        <tr>
											<td>Sunway Money Sdn Bhd</td>
                                            <td>Internship for IT</td>
                                            <td>5 Star</td>
                                            <td>RM800.00 - RM1000.00</td>
                                            <td>Degree</td>
                                        </tr>
                                        <tr>
											<td>Fire Pos Sdn Bhd</td>
                                            <td>Internship - Mobile Apps Developer</td>
                                            <td>4 Star</td>
                                            <td>RM500.00 - RM800.00</td>
                                            <td>Diploma & Degree</td>
                                        </tr>
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