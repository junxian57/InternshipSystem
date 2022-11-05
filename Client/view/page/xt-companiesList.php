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
	<title>ITP System | Companies List</title>
	<link href="../../css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="../../css/style.css" rel='stylesheet' type='text/css' />
	<link href="../../css/font-awesome.css" rel="stylesheet">
	<link href="../../css/xt-companiesSelection.css" rel="stylesheet">
	<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
	<link href="../../css/animate.css" rel="stylesheet" type="text/css" media="all">
	<link href="../../css/custom.css" rel="stylesheet">

	<script src="../../js/jquery-1.11.1.min.js"></script>
	<script src="../../js/modernizr.custom.js"></script>>
	<script src="../../js/wow.min.js"></script>
	<script src="../../js/metisMenu.min.js"></script>
	<script src="../../js/custom.js"></script>

  <style>
    table {
  border-collapse: collapse;
  width: 100%;
}

button {
  border: none;
}

table tbody td,
th {
  border: 1px solid #797d7a;
  text-align: left;
  padding: 8px;
}

table.sortable th.no-sort {
  padding-top: 0.35em;
}

table.sortable th[aria-sort="descending"] span::after {
  color: currentcolor;
  font-size: 100%;
  top: 0;
}

table.sortable th[aria-sort="ascending"] span::after {
  color: currentcolor;
  font-size: 100%;
  top: 0;
}

table.show-unsorted-icon th:not([aria-sort]) button span::after {
  color: currentcolor;
  font-size: 100%;
  position: relative;
}

table.sortable th:not([aria-sort]) button:focus span::after,
table.sortable th:not([aria-sort]) button:hover span::after {
  color: currentcolor;
  font-size: 100%;
  top: 0;
}

.tables .panel-body {
  padding: 30px 0;
}

.tables .bs-example {
  padding: 50px 25px;
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
				<div class="tables">
					<h3 class="title1">Company List</h3>
					<div class="table-responsive bs-example widget-shadow" style="background: transparent; border: 1px solid #797d7a;">
					<div class="panel-body">
            <div class="input-group">
							<input type="text" class="form-control" id="filterCmp" data-filters="#dev-cat" data-action="filter" placeholder="Search..." style="background-color: transparent;">
							<a class="input-group-addon" style="border: 1px solid #797d7a;">
								<i class="fa fa-search"></i>
							</a>
						</div>
					</div>
						<table id="cmpTable" class="sortable">
							<thead>
								<tr>
									<th>#</th>
									<th>
										<button>
											<span aria-hidden="true">Company Name ▼</span>
										</button>
									</th>
									<th>
										<button>
											<span aria-hidden="true">Address ▼</span>
										</button>
									</th>
									<th>
										<button>
											<span aria-hidden="true">Email ▼</span>
										</button>
									</th>
									<th class="num">
										<button>
											<span aria-hidden="true">Allowance (RM) ▼</span>
										</button>
									</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td>1</td>
									<td>Unilifesity SDN BHD</td>
									<td>Level 29, Menara Olympia, No 8, Jalan Raja Chulan, 50200 Kuala Lumpur, 50200, Kuala Lumpur</td>
									<td>unilifesity@gmail.com</td>
									<td>550 - 800</td>
								</tr>

								<tr>
									<td>2</td>
									<td>Samsung Malaysia</td>
									<td>Phase 3, Bayan Lepas Free Industrial Zone, 11900 Penang, 11900, Johor</td>
									<td>info@samsung.com</td>
									<td>1500 - 1500</td>
								</tr>

								<tr>
									<td>3</td>
									<td>Hap Seng SDN BHD</td>
									<td>D-35-05, Menara Suezcap 1,KL Gateway, Jalan Kerinchi, 59200 Kuala Lumpur, 46300, Selangor</td>
									<td>jasmineyy@hapseng.com</td>
									<td>500 - 1000</td>
								</tr>

								<tr>
									<td>4</td>
									<td>Smazh Premium SDN BHD</td>
									<td>D-35-05, Menara Suezcap 1,KL Gateway, Jalan Kerinchi, 59200 Kuala Lumpur, 46300, Selangor</td>
									<td>jasmineyy@gmail.com</td>
									<td>500 - 1000</td>
								</tr>

								<tr>
									<td>5</td>
									<td>SkyWorld Development SDN BHD</td>
									<td>D-35-05, Menara Suezcap 1,KL Gateway, Jalan Kerinchi, 59200 Kuala Lumpur, 46300, Selangor</td>
									<td>jasmineyy@gmail.com</td>
									<td>500 - 1000</td>
								</tr>

								<tr>
									<td>6</td>
									<td>Unilifesity SDN BHD</td>
									<td>D-35-05, Menara Suezcap 1,KL Gateway, Jalan Kerinchi, 59200 Kuala Lumpur, 46300, Selangor</td>
									<td>jasmineyy@gmail.com</td>
									<td>500 - 1000</td>
								</tr>

								<tr>
									<td>7</td>
									<td>BMW Coding SDN BHD</td>
									<td>D-35-05, Menara Suezcap 1,KL Gateway, Jalan Kerinchi, 59200 Kuala Lumpur, 46300, Selangor</td>
									<td>jasmineyy@gmail.com</td>
									<td>500 - 1000</td>
								</tr>

								<tr>
									<td>8</td>
									<td>KK Supermart & Superstore Sdn Bhd</td>
									<td>D-35-05, Menara Suezcap 1,KL Gateway, Jalan Kerinchi, 59200 Kuala Lumpur, 46300, Selangor</td>
									<td>jasmineyy@gmail.com</td>
									<td>500 - 1000</td>
								</tr>

								<tr>
									<td>9</td>
									<td>Arissto (Malaysia) Sdn Bhd</td>
									<td>D-35-05, Menara Suezcap 1,KL Gateway, Jalan Kerinchi, 59200 Kuala Lumpur, 46300, Selangor</td>
									<td>jasmineyy@gmail.com</td>
									<td>500 - 1000</td>
								</tr>

								<tr>
									<td>10</td>
									<td>Prosains (M) Sdn Bhd</td>
									<td>D-35-05, Menara Suezcap 1,KL Gateway, Jalan Kerinchi, 59200 Kuala Lumpur, 46300, Selangor</td>
									<td>jasmineyy@gmail.com</td>
									<td>2000 - 2000</td>
								</tr>

								<tr>
									<td>11</td>
									<td>Origin Integrated Studios Sdn Bhd</td>
									<td>D-35-05, Menara Suezcap 1,KL Gateway, Jalan Kerinchi, 59200 Kuala Lumpur, 46300, Selangor</td>
									<td>jasmineyy@gmail.com</td>
									<td>200 - 500</td>
								</tr>

								<tr>
									<td>12</td>
									<td>Dommal Food Services Sdb Bhd</td>
									<td>D-35-05, Menara Suezcap 1,KL Gateway, Jalan Kerinchi, 59200 Kuala Lumpur, 46300, Selangor</td>
									<td>jasmineyy@gmail.com</td>
									<td>200 - 500</td>
								</tr>

								<tr>
									<td>13</td>
									<td>Sunway Money Sdn Bhd</td>
									<td>D-35-05, Menara Suezcap 1,KL Gateway, Jalan Kerinchi, 59200 Kuala Lumpur, 46300, Selangor</td>
									<td>jasmineyy@gmail.com</td>
									<td>200 - 500</td>
								</tr>

								<tr>
									<td>14</td>
									<td>Fire Pos Sdn Bhd</td>
									<td>D-35-05, Menara Suezcap 1,KL Gateway, Jalan Kerinchi, 59200 Kuala Lumpur, 46300, Selangor</td>
									<td>jasmineyy@gmail.com</td>
									<td>200 - 500</td>
								</tr>
							</tbody>
						</table>
					</div>
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

<script>
		function filterFinalTable(event) {
    	var filter = event.target.value.toUpperCase();
    	var rows = document.querySelector("#cmpTable tbody").rows;
    
    	for (var i = 0; i < rows.length; i++) {
				var firstCol = rows[i].cells[1].textContent.toUpperCase();
      	var secondCol = rows[i].cells[2].textContent.toUpperCase();
				var thirdCol = rows[i].cells[3].textContent.toUpperCase();
      	var forthCol = rows[i].cells[4].textContent.toUpperCase();
				var fifthCol = rows[i].cells[5].textContent.toUpperCase();
      	var sixthCol = rows[i].cells[6].textContent.toUpperCase();
      	if (firstCol.indexOf(filter) > -1 || secondCol.indexOf(filter) > -1 || thirdCol.indexOf(filter) > -1 || forthCol.indexOf(filter) > -1 || fifthCol.indexOf(filter) > -1 || sixthCol.indexOf(filter) > -1) {
					rows[i].style.display = "";
				} else {
        	rows[i].style.display = "none";
      	}      
			}
		}
		document.querySelector('#filterCmp').addEventListener('keyup', filterFinalTable, false);
	</script>

	<script src="../../js/jquery.nicescroll.js"></script>
	<script src="../../js/scripts.js"></script>
	<script src="../../js/bootstrap.js"> </script>
</body>
</html>