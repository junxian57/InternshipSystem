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
	<link href="../../css/workProgress.css" rel="stylesheet">
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
					<div class="tab">
						<button class="tablinks" id="activeTab" onclick="rptType(event, 'Monthly')">Monthly Work Progress Report</button>
						<button class="tablinks" onclick="rptType(event, 'Final')">Final Work Progress Report</button>
					</div>
					
					<div id="Monthly" class="tabcontent">
					<div class="panel-body">
            <div class="input-group">
							<input type="text" class="form-control" id="dev-table-filter" data-filters="#dev-cat" data-action="filter" placeholder="Search..." style="background-color: transparent;">
							<a class="input-group-addon" style="border: 1px solid #797d7a;">
								<i class="fa fa-search"></i>
							</a>
						</div>
					</div>
						<table id="monthlyTable">
							<tr>
								<th>#</th>
								<th>Monthly Report ID</th>
    						<th>Submit Date Time</th>
								<th>Report</th>
    						<th>Submit On Time</th>
								<th style="border-right: 0;">Action</th>
								<th style="border-left: 0;"></th>
  						</tr>
						
							<tr>
								<td>1</td>
								<td>WRPT000001</td>
								<td>2023-07-30 12:00:00</td>
								<td>Maria Anders</td>
								<td>YES</td>
								<td>
									<a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
								</td>
								<td>
									<a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
								</td>
							</tr>

							<tr>
								<td>2</td>
								<td>WRPT000002</td>
								<td>2023-07-30 12:00:00</td>
								<td>Maria Anders</td>
								<td>NO</td>
								<td>
									<a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
								</td>
								<td>
									<a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
								</td>
							</tr>

							<tr>
								<td>3</td>
								<td>WRPT000003</td>
								<td>2023-07-30 12:00:00</td>
								<td>Maria Anders</td>
								<td>YES</td>
								<td>
									<a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
								</td>
								<td>
									<a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
								</td>
							</tr>

							<tr>
								<td>4</td>
								<td>WRPT000004</td>
								<td>2023-07-30 12:00:00</td>
								<td>Maria Anders</td>
								<td>YES</td>
								<td>
									<a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
								</td>
								<td>
									<a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
								</td>
							</tr>

							<tr>
								<td>5</td>
								<td>WRPT000005</td>
								<td>2023-07-30 12:00:00</td>
								<td>Maria Anders</td>
								<td>YES</td>
								<td>
									<a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
								</td>
								<td>
									<a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
								</td>
							</tr>

							<td>6</td>
								<td>WRPT000006</td>
								<td>2023-07-30 12:00:00</td>
								<td>Maria Anders</td>
								<td>YES</td>
								<td>
									<a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
								</td>
								<td>
									<a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
								</td>
							</tr>

							<td>7</td>
								<td>WRPT000007</td>
								<td>2023-07-30 12:00:00</td>
								<td>Maria Anders</td>
								<td>YES</td>
								<td>
									<a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
								</td>
								<td>
									<a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
								</td>
							</tr>

							<td>8</td>
								<td>WRPT000008</td>
								<td>2023-07-30 12:00:00</td>
								<td>Maria Anders</td>
								<td>YES</td>
								<td>
									<a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
								</td>
								<td>
									<a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
								</td>
							</tr>

							<td>9</td>
								<td>WRPT000009</td>
								<td>2023-07-30 12:00:00</td>
								<td>Maria Anders</td>
								<td>YES</td>
								<td>
									<a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
								</td>
								<td>
									<a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
								</td>
							</tr>

							<td>10</td>
								<td>WRPT000010</td>
								<td>2023-07-30 12:00:00</td>
								<td>Maria Anders</td>
								<td>YES</td>
								<td>
									<a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
								</td>
								<td>
									<a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
								</td>
							</tr>

							<td>11</td>
								<td>WRPT000011</td>
								<td>2023-07-30 12:00:00</td>
								<td>Maria Anders</td>
								<td>YES</td>
								<td>
									<a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
								</td>
								<td>
									<a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
								</td>
							</tr>

							<td>12</td>
								<td>WRPT000012</td>
								<td>2023-07-30 12:00:00</td>
								<td>Maria Anders</td>
								<td>YES</td>
								<td>
									<a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
								</td>
								<td>
									<a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
								</td>
							</tr>

							<td>13</td>
								<td>WRPT000013</td>
								<td>2023-07-30 12:00:00</td>
								<td>Maria Anders</td>
								<td>YES</td>
								<td>
									<a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
								</td>
								<td>
									<a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
								</td>
							</tr>

							<td>14</td>
								<td>WRPT000014</td>
								<td>2023-07-30 12:00:00</td>
								<td>Maria Anders</td>
								<td>YES</td>
								<td>
									<a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
								</td>
								<td>
									<a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
								</td>
							</tr>

							<td>15</td>
								<td>WRPT000015</td>
								<td>2023-07-30 12:00:00</td>
								<td>Maria Anders</td>
								<td>YES</td>
								<td>
									<a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
								</td>
								<td>
									<a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
								</td>
							</tr>
						</table>
					</div>

					<div id="Final" class="tabcontent">
					<div class="panel-body">
            <div class="input-group">
							<input type="text" class="form-control" id="finalTable-filter" data-filters="#dev-cat" data-action="filter" placeholder="Search..." style="background-color: transparent;">
							<a class="input-group-addon" style="border: 1px solid #797d7a;">
								<i class="fa fa-search"></i>
							</a>
						</div>
					</div>
						<table id="finalTable">
							<tr>
								<th>#</th>
								<th>Final Report ID</th>
    						<th>Submit Date Time</th>
								<th>Report</th>
    						<th>Submit On Time</th>
								<th style="border-right: 0;">Action</th>
								<th style="border-left: 0;"></th>
  						</tr>
						
							<tr>
								<td>1</td>
								<td>FRPT000001</td>
								<td>2023-07-30 12:00:00</td>
								<td>Maria Anders</td>
								<td>YES</td>
								<td>
									<a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
								</td>
								<td>
									<a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
								</td>
							</tr>

							<tr>
								<td>2</td>
								<td>FRPT000002</td>
								<td>2023-07-30 12:00:00</td>
								<td>Maria Anders</td>
								<td>YES</td>
								<td>
									<a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
								</td>
								<td>
									<a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
								</td>
							</tr>

							<tr>
								<td>3</td>
								<td>FRPT000003</td>
								<td>2023-07-30 12:00:00</td>
								<td>Maria Anders</td>
								<td>YES</td>
								<td>
									<a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
								</td>
								<td>
									<a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
								</td>
							</tr>

							<tr>
								<td>4</td>
								<td>FRPT000004</td>
								<td>2023-07-30 12:00:00</td>
								<td>Maria Anders</td>
								<td>YES</td>
								<td>
									<a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
								</td>
								<td>
									<a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
								</td>
							</tr>

							<tr>
								<td>5</td>
								<td>FRPT000005</td>
								<td>2023-07-30 12:00:00</td>
								<td>Maria Anders</td>
								<td>YES</td>
								<td>
									<a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
								</td>
								<td>
									<a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
								</td>
							</tr>

							<td>6</td>
								<td>FRPT000006</td>
								<td>2023-07-30 12:00:00</td>
								<td>Maria Anders</td>
								<td>YES</td>
								<td>
									<a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
								</td>
								<td>
									<a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
								</td>
							</tr>

							<td>7</td>
								<td>FRPT000007</td>
								<td>2023-07-30 12:00:00</td>
								<td>Maria Anders</td>
								<td>YES</td>
								<td>
									<a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
								</td>
								<td>
									<a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
								</td>
							</tr>

							<td>8</td>
								<td>FRPT000008</td>
								<td>2023-07-30 12:00:00</td>
								<td>Maria Anders</td>
								<td>YES</td>
								<td>
									<a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
								</td>
								<td>
									<a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
								</td>
							</tr>

							<td>9</td>
								<td>FRPT000009</td>
								<td>2023-07-30 12:00:00</td>
								<td>Maria Anders</td>
								<td>YES</td>
								<td>
									<a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
								</td>
								<td>
									<a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
								</td>
							</tr>

							<td>10</td>
								<td>FRPT000010</td>
								<td>2023-07-30 12:00:00</td>
								<td>Maria Anders</td>
								<td>YES</td>
								<td>
									<a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
								</td>
								<td>
									<a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
								</td>
							</tr>

							<td>11</td>
								<td>FRPT000011</td>
								<td>2023-07-30 12:00:00</td>
								<td>Maria Anders</td>
								<td>YES</td>
								<td>
									<a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
								</td>
								<td>
									<a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
								</td>
							</tr>

							<td>12</td>
								<td>FRPT000012</td>
								<td>2023-07-30 12:00:00</td>
								<td>Maria Anders</td>
								<td>YES</td>
								<td>
									<a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
								</td>
								<td>
									<a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
								</td>
							</tr>

							<td>13</td>
								<td>FRPT000013</td>
								<td>2023-07-30 12:00:00</td>
								<td>Maria Anders</td>
								<td>YES</td>
								<td>
									<a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
								</td>
								<td>
									<a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
								</td>
							</tr>

							<td>14</td>
								<td>FRPT000014</td>
								<td>2023-07-30 12:00:00</td>
								<td>Maria Anders</td>
								<td>YES</td>
								<td>
									<a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
								</td>
								<td>
									<a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
								</td>
							</tr>

							<td>15</td>
								<td>FRPT000015</td>
								<td>2023-07-30 12:00:00</td>
								<td>Maria Anders</td>
								<td>YES</td>
								<td>
									<a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
								</td>
								<td>
									<a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
								</td>
							</tr>
						</table>
					</div>
			</div>
		</div>
	</div>
	
	<script>
    let menuLeft = document.getElementById('cbp-spmenu-s1'),
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
		function rptType(evt, reportType) {
			var i, tabcontent, tablinks;
			tabcontent = document.getElementsByClassName("tabcontent");
  		for (i = 0; i < tabcontent.length; i++) {
    		tabcontent[i].style.display = "none";
  		}
  		tablinks = document.getElementsByClassName("tablinks");
  		for (i = 0; i < tablinks.length; i++) {
    		tablinks[i].className = tablinks[i].className.replace(" active", "");
  		}
  		document.getElementById(reportType).style.display = "block";
  		evt.currentTarget.className += " active";
		}
		document.getElementById("activeTab").click();
	</script>

	<script>
		function filterMonthlyTable(event) {
    	var filter = event.target.value.toUpperCase();
    	var rows = document.querySelector("#monthlyTable tbody").rows;
    
    	for (var i = 1; i < rows.length; i++) {
				var firstCol = rows[i].cells[1].textContent.toUpperCase();
      	var secondCol = rows[i].cells[2].textContent.toUpperCase();
				var thirdCol = rows[i].cells[3].textContent.toUpperCase();
      	var forthCol = rows[i].cells[4].textContent.toUpperCase();
      	if (firstCol.indexOf(filter) > -1 || secondCol.indexOf(filter) > -1 || thirdCol.indexOf(filter) > -1 || forthCol.indexOf(filter) > -1) {
					rows[i].style.display = "";
				} else {
        	rows[i].style.display = "none";
      	}      
			}
		}
		document.querySelector('#dev-table-filter').addEventListener('keyup', filterMonthlyTable, false);
	</script>

<script>
		function filterFinalTable(event) {
    	var filter = event.target.value.toUpperCase();
    	var rows = document.querySelector("#finalTable tbody").rows;
    
    	for (var i = 1; i < rows.length; i++) {
				var firstCol = rows[i].cells[1].textContent.toUpperCase();
      	var secondCol = rows[i].cells[2].textContent.toUpperCase();
				var thirdCol = rows[i].cells[3].textContent.toUpperCase();
      	var forthCol = rows[i].cells[4].textContent.toUpperCase();
      	if (firstCol.indexOf(filter) > -1 || secondCol.indexOf(filter) > -1 || thirdCol.indexOf(filter) > -1 || forthCol.indexOf(filter) > -1) {
					rows[i].style.display = "";
				} else {
        	rows[i].style.display = "none";
      	}      
			}
		}
		document.querySelector('#finalTable-filter').addEventListener('keyup', filterFinalTable, false);
	</script>
	
	<script src="../../js/classie.js"></script>
	<script src="../../js/jquery.nicescroll.js"></script>
	<script src="../../js/scripts.js"></script>
	<script src="../../js/bootstrap.js"> </script>
</body>
<footer><?php include_once('includes/footer.php'); ?></footer>
</html>