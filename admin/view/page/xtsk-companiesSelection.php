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
	<title>ITP System | Companies Selection</title>
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
	<style>
		table {
  		border-collapse: collapse;
  		width: 100%;
		}
		
		table tbody td, th {
  		border: 1px solid #797d7a;
  		text-align: left;
  		padding: 8px;
		}
</style>
</head>

<body class="cbp-spmenu-push">
	<div class="main-content">
		<?php include_once('../../includes/sidebar.php'); ?>
		<?php include_once('../../includes/header.php'); ?>
		<div id="page-wrapper">
			<div class="main-page">
				<div class="tables">
					<h3 class="title1">Companies Selection</h3>
						<table>
							<thead>
								<tr>
									<th>#</th>
									<th>Company Name</th>
									<th>Industry</th>
									<th>Location</th>
									<th>Company Size</th>
									<th>Rating</th>
									<th>Allowance</th>
									<th>Action</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td>1</td>
									<td>Unilifesity SDN BHD</td>
									<td>Finance and Accounting</td>
									<td>Kampus Utama, Jalan Genting Kelang, 53300 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur</td>
									<td>50 - 100</td>
									<td>3</td>
									<td>RM 800 - RM 1000</td>
									<td><a class="view" href="view-companies.php?cmpID=<?php echo "cmpID"; ?>">View</a></td>
								</tr>

								<tr>
									<td>2</td>
									<td>Samsung Malaysia</td>
									<td>Finance and Accounting</td>
									<td>Kampus Utama, Jalan Genting Kelang, 53300 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur</td>
									<td>50 - 100</td>
									<td>4</td>
									<td>RM 800 - RM 1000</td>
									<td><a class="view" href="view-companies.php?cmpID=<?php echo "cmpID"; ?>">View</a></td>
								</tr>

								<tr>
									<td>3</td>
									<td>Hap Seng SDN BHD</td>
									<td>Finance and Accounting</td>
									<td>Kampus Utama, Jalan Genting Kelang, 53300 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur</td>
									<td>50 - 100</td>
									<td>4</td>
									<td>RM 800 - RM 1000</td>
									<td><a class="view" href="view-companies.php?cmpID=<?php echo "cmpID"; ?>">View</a></td>
								</tr>

								<tr>
									<td>4</td>
									<td>Smazh Premium SDN BHD</td>
									<td>Finance and Accounting</td>
									<td>Kampus Utama, Jalan Genting Kelang, 53300 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur</td>
									<td>50 - 100</td>
									<td>5</td>
									<td>RM 800 - RM 1000</td>
									<td><a class="view" href="view-companies.php?cmpID=<?php echo "cmpID"; ?>">View</a></td>
								</tr>

								<tr>
									<td>5</td>
									<td>SkyWorld Development SDN BHD</td>
									<td>Finance and Accounting</td>
									<td>Kampus Utama, Jalan Genting Kelang, 53300 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur</td>
									<td>50 - 100</td>
									<td>5</td>
									<td>RM 800 - RM 1000</td>
									<td><a class="view" href="view-companies.php?cmpID=<?php echo "cmpID"; ?>">View</a></td>
								</tr>

								<tr>
									<td>6</td>
									<td>Unilifesity SDN BHD</td>
									<td>Finance and Accounting</td>
									<td>Kampus Utama, Jalan Genting Kelang, 53300 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur</td>
									<td>50 - 100</td>
									<td>2</td>
									<td>RM 800 - RM 1000</td>
									<td><a class="view" href="view-companies.php?cmpID=<?php echo "cmpID"; ?>">View</a></td>
								</tr>

								<tr>
									<td>7</td>
									<td>BMW Coding SDN BHD</td>
									<td>Finance and Accounting</td>
									<td>Kampus Utama, Jalan Genting Kelang, 53300 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur</td>
									<td>50 - 100</td>
									<td>3</td>
									<td>RM 800 - RM 1000</td>
									<td><a class="view" href="view-companies.php?cmpID=<?php echo "cmpID"; ?>">View</a></td>
								</tr>

								<tr>
									<td>8</td>
									<td>KK Supermart & Superstore Sdn Bhd</td>
									<td>Finance and Accounting</td>
									<td>Kampus Utama, Jalan Genting Kelang, 53300 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur</td>
									<td>50 - 100</td>
									<td>3</td>
									<td>RM 800 - RM 1000</td>
									<td><a class="view" href="view-companies.php?cmpID=<?php echo "cmpID"; ?>">View</a></td>
								</tr>

								<tr>
									<td>9</td>
									<td>Arissto (Malaysia) Sdn Bhd</td>
									<td>Finance and Accounting</td>
									<td>Kampus Utama, Jalan Genting Kelang, 53300 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur</td>
									<td>50 - 100</td>
									<td>4</td>
									<td>RM 800 - RM 1000</td>
									<td><a class="view" href="view-companies.php?cmpID=<?php echo "cmpID"; ?>">View</a></td>
								</tr>

								<tr>
									<td>10</td>
									<td>Prosains (M) Sdn Bhd</td>
									<td>Finance and Accounting</td>
									<td>Kampus Utama, Jalan Genting Kelang, 53300 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur</td>
									<td>50 - 100</td>
									<td>4</td>
									<td>RM 800 - RM 1000</td>
									<td><a class="view" href="view-companies.php?cmpID=<?php echo "cmpID"; ?>">View</a></td>
								</tr>

								<tr>
									<td>11</td>
									<td>Origin Integrated Studios Sdn Bhd</td>
									<td>Finance and Accounting</td>
									<td>Kampus Utama, Jalan Genting Kelang, 53300 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur</td>
									<td>50 - 100</td>
									<td>2</td>
									<td>RM 800 - RM 1000</td>
									<td><a class="view" href="view-companies.php?cmpID=<?php echo "cmpID"; ?>">View</a></td>
								</tr>

								<tr>
									<td>12</td>
									<td>Dommal Food Services Sdb Bhd</td>
									<td>Finance and Accounting</td>
									<td>Kampus Utama, Jalan Genting Kelang, 53300 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur</td>
									<td>50 - 100</td>
									<td>4</td>
									<td>RM 800 - RM 1000</td>
									<td><a class="view" href="view-companies.php?cmpID=<?php echo "cmpID"; ?>">View</a></td>
								</tr>

								<tr>
									<td>13</td>
									<td>Sunway Money Sdn Bhd</td>
									<td>Finance and Accounting</td>
									<td>Kampus Utama, Jalan Genting Kelang, 53300 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur</td>
									<td>50 - 100</td>
									<td>4</td>
									<td>RM 800 - RM 1000</td>
									<td><a class="view" href="view-companies.php?cmpID=<?php echo "cmpID"; ?>">View</a></td>
								</tr>

								<tr>
									<td>14</td>
									<td>Fire Pos Sdn Bhd</td>
									<td>Finance and Accounting</td>
									<td>Kampus Utama, Jalan Genting Kelang, 53300 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur</td>
									<td>50 - 100</td>
									<td>4</td>
									<td>RM 800 - RM 1000</td>
									<td><a class="view" href="view-companies.php?cmpID=<?php echo "cmpID"; ?>">View</a></td>
								</tr>
							</tbody>
						</table>
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
<footer><?php include_once('includes/footer.php'); ?></footer>

</html>