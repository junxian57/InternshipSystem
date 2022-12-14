<?php
include('../../includes/db_connection.php');

if(session_status() != PHP_SESSION_ACTIVE) session_start();

if (!isset($_SESSION['adminID'])) {
  if (!isset($_SESSION['committeeID'])) {
    echo "<script>
        window.location.href = 'adminLogin.php';
    </script>";
  }
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>ITP System | Student Work Progress</title>
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
							<thead>
								<tr>
									<th>#</th>
									<th>Monthly Report ID</th>
									<th>Student ID</th>
									<th>Student Name</th>
    							<th>Status</th>
									<th>Submit Date Time</th>
									<th>Action</th>
  							</tr>
							</thead>

							<tbody>
							<?php
								$host = "sql444.main-hosting.eu";
                $user = "u928796707_group34";
                $password = "u1VF3KYO1r|";
                $database = "u928796707_internshipWeb";
                                              
                $conn = mysqli_connect($host, $user, $password, $database); 

								$i=0;
                $get_month = "SELECT * FROM weeklyReport WHERE reportStatus = 'Submitted'";
                $run_month = mysqli_query($conn, $get_month);
                while($row_month = mysqli_fetch_array($run_month)){
                  $monthlyRptID = $row_month['monthlyReportID'];
                  $cmpID = $row_month['companyID'];
									$studentID = $row_month['studentID'];
                  $monthOfTraining = $row_month['monthOfTraining'];
									$submitDateTime = $row_month['submitDateTime'];
									$status = $row_month['reportStatus'];
									
									$get_cmp = "SELECT * FROM Company WHERE companyID = '$cmpID'";
                	$run_cmp = mysqli_query($conn, $get_cmp);
									$row_cmp = mysqli_fetch_array($run_cmp);
									$cmpName = $row_cmp['cmpName'];

									$get_stud = "SELECT * FROM Student WHERE studentID = '$studentID'";
                	$run_stud = mysqli_query($conn, $get_stud);
									$row_stud = mysqli_fetch_array($run_stud);
									$studName = $row_stud['studName'];
									$i++;
              ?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $monthlyRptID; ?></td>
								<td><?php echo $studentID; ?></td>
								<td><?php echo $studName; ?></td>
								<td><?php echo $status; ?></td>
								<td><?php echo $submitDateTime; ?></td>
								<td><?php echo '<a href="/InternshipSystem/Client/view/page/monthlyRpt/'.$monthlyRptID.'_'.$studName.'_'.$monthOfTraining.'.pdf" target="_blank">';?>View & Print</a></td>
							</tr>
							<?php } ?>
							</tbody>
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
							<thead>
								<tr>
									<th>#</th>
									<th>Final Report ID</th>
									<th>Student ID</th>
									<th>Student Name</th>
    							<th>Status</th>
									<th>Submit Date Time</th>
									<th>Action</th>
  							</tr>
							</thead>
						
							<tbody>
							<?php
								$host = "sql444.main-hosting.eu";
                $user = "u928796707_group34";
                $password = "u1VF3KYO1r|";
                $database = "u928796707_internshipWeb";
                                              
                $conn = mysqli_connect($host, $user, $password, $database); 

								$i=0;
                $get_month = "SELECT * FROM weeklyReport WHERE reportStatus = 'T'";
                $run_month = mysqli_query($conn, $get_month);
                while($row_month = mysqli_fetch_array($run_month)){
                  $monthlyRptID = $row_month['monthlyReportID'];
                  $cmpID = $row_month['companyID'];
									$studentID = $row_month['studentID'];
                  $monthOfTraining = $row_month['monthOfTraining'];
									$submitDateTime = $row_month['submitDateTime'];
									$status = $row_month['reportStatus'];
									
									$get_cmp = "SELECT * FROM Company WHERE companyID = '$cmpID'";
                	$run_cmp = mysqli_query($conn, $get_cmp);
									$row_cmp = mysqli_fetch_array($run_cmp);
									$cmpName = $row_cmp['cmpName'];

									$get_stud = "SELECT * FROM Student WHERE studentID = '$studentID'";
                	$run_stud = mysqli_query($conn, $get_stud);
									$row_stud = mysqli_fetch_array($run_stud);
									$studName = $row_stud['studName'];
									$i++;
              ?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $monthlyRptID; ?></td>
								<td><?php echo $studentID; ?></td>
								<td><?php echo $studName; ?></td>
								<td><?php echo $status; ?></td>
								<td><?php echo $submitDateTime; ?></td>
								<td><?php echo '<a href="/InternshipSystem/Client/view/page/monthlyRpt/'.$monthlyRptID.'_'.$studName.'_'.$monthOfTraining.'.pdf" target="_blank">';?>View & Print</a></td>
							</tr>
							<?php } ?>
							</tbody>
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