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
	<title>ITP System | Student Job Application</title>
	<link href="../../css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="../../css/style.css" rel='stylesheet' type='text/css' />
	<link href="../../css/font-awesome.css" rel="stylesheet">
	<link href="../../css/xt-companyResponse.css" rel="stylesheet">
	<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
	<link href="../../css/animate.css" rel="stylesheet" type="text/css" media="all">
	<link href="../../css/custom.css" rel="stylesheet">

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

<body class="cbp-spmenu-push">
	<div class="main-content">
		<?php include_once('../../includes/sidebar.php'); ?>
		<?php include_once('../../includes/header.php'); ?>
		<div id="page-wrapper">
			<div class="main-page">
				<div class="tables">
					<h3 class="title1">Student Job Application</h3>
					<div class="tab">
						<button class="tablinks" id="activeTab" onclick="appType(event, 'All')">All</button>
						<button class="tablinks" onclick="appType(event, 'Pending')">Pending</button>
						<button class="tablinks" onclick="appType(event, 'Shortlisted')">Shortlisted</button>
						<button class="tablinks" onclick="appType(event, 'Accepted')">Accepted</button>
						<button class="tablinks" onclick="appType(event, 'Rejected')">Rejected</button>
					</div>
					
					<div id="All" class="tabcontent">
						<div class="panel-body">
            	<div class="input-group">
								<input type="text" class="form-control" id="filterAllList" data-filters="#dev-cat" data-action="filter" placeholder="Search..." style="background-color: transparent;">
								<a class="input-group-addon" style="border: 1px solid #797d7a;">
									<i class="fa fa-search"></i>
								</a>
							</div>
						</div>
						<table id="allTable" class="sortable">
							<thead>
								<tr>
									<th>#</th>
									<th>
										<button>
											<span aria-hidden="true">Application ID</span>
										</button>
									</th>
									<th>
										<button>
											<span aria-hidden="true">Student ID</span>
										</button>
									</th>
									<th>
										<button>
											<span aria-hidden="true">Student Name</span>
										</button>
									</th>
									<th>
										<button>
											<span aria-hidden="true">Job ID</span>
										</button>
									</th>
                  <th>
										<button>
											<span aria-hidden="true">Job Title</span>
										</button>
									</th>
                  <th>
										<button>
											<span aria-hidden="true">Status</span>
										</button>
									</th>
								</tr>
							</thead>

							<tbody>
							<?php
								$host = "sql444.main-hosting.eu";
								$user = "u928796707_group34";
								$password = "u1VF3KYO1r|";
								$database = "u928796707_internshipWeb";
																						
								$conn = mysqli_connect($host, $user, $password, $database); 

									$get_intern = "SELECT * FROM InternJob WHERE companyID = 'CMP00001'";
									$run_intern = mysqli_query($conn, $get_intern);
									while($row_intern = mysqli_fetch_array($run_intern)){
										$internJobID = $row_intern['internJobID'];
										$jobTitle = $row_intern['jobTitle'];

										$get_internApp = "SELECT * FROM InternApplicationMap WHERE internJobID = '$internJobID'";
										$run_internApp = mysqli_query($conn, $get_internApp);
										while($row_internApp = mysqli_fetch_array($run_internApp)){
											$internJob_ID = $row_internApp['internJobID'];
											$internApp_ID = $row_internApp['internAppID'];
											$studentID = $row_internApp['studentID'];
											$app_Status = $row_internApp['appStatus'];

											$getStud = "SELECT * FROM Student WHERE studentID = '$studentID'";
											$runStud = mysqli_query($conn, $getStud);
											if($rowStud = mysqli_fetch_array($runStud)){
												$studName = $rowStud['studName'];
											}
											$i++;
              ?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $internApp_ID; ?></td>
									<td><?php echo $studentID; ?></td>
									<td><?php echo $studName; ?></td>
									<td><?php echo $internJob_ID; ?></td>
									<td><?php echo $jobTitle; ?></td>
                  <td><?php echo $app_Status; ?></td>
                </tr>
								<?php } } ?>
							</tbody>
						</table>
					</div>

					<div id="Pending" class="tabcontent">
						<div class="panel-body">
            	<div class="input-group">
								<input type="text" class="form-control" id="filterPendingList" data-filters="#dev-cat" data-action="filter" placeholder="Search..." style="background-color: transparent;">
								<a class="input-group-addon" style="border: 1px solid #797d7a;">
									<i class="fa fa-search"></i>
								</a>
							</div>
						</div>
						<table id="pendingTable" class="sortable">
							<thead>
								<tr>
									<th>#</th>
									<th>
										<button>
											<span aria-hidden="true">Application ID</span>
										</button>
									</th>
									<th>
										<button>
											<span aria-hidden="true">Student ID</span>
										</button>
									</th>
									<th>
										<button>
											<span aria-hidden="true">Student Name</span>
										</button>
									</th>
									<th>
										<button>
											<span aria-hidden="true">Job ID</span>
										</button>
									</th>
                  <th>
										<button>
											<span aria-hidden="true">Job Title</span>
										</button>
									</th>
                  <th>
										<button>
											<span aria-hidden="true">Status</span>
										</button>
									</th>
                  <th>Action</th>
								</tr>
							</thead>

							<tbody>
							<?php $i = 0; ?>
							<?php
								$host = "sql444.main-hosting.eu";
								$user = "u928796707_group34";
								$password = "u1VF3KYO1r|";
								$database = "u928796707_internshipWeb";
																						
								$conn = mysqli_connect($host, $user, $password, $database); 

									$get_intern = "SELECT * FROM InternJob WHERE companyID = 'CMP00001'";
									$run_intern = mysqli_query($conn, $get_intern);
									while($row_intern = mysqli_fetch_array($run_intern)){
										$internJobID = $row_intern['internJobID'];
										$jobTitle = $row_intern['jobTitle'];

										$get_internApp = "SELECT * FROM InternApplicationMap WHERE internJobID = '$internJobID' AND appStatus = 'Pending Review'";
										$run_internApp = mysqli_query($conn, $get_internApp);
										while($row_internApp = mysqli_fetch_array($run_internApp)){
											$internJob_ID = $row_internApp['internJobID'];
											$internApp_ID = $row_internApp['internAppID'];
											$studentID = $row_internApp['studentID'];
											$app_Status = $row_internApp['appStatus'];

											$getStud = "SELECT * FROM Student WHERE studentID = '$studentID'";
											$runStud = mysqli_query($conn, $getStud);
											if($rowStud = mysqli_fetch_array($runStud)){
												$studName = $rowStud['studName'];
											}
											
											$i++;
              ?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $internApp_ID; ?></td>
									<td><?php echo $studentID; ?></td>
									<td><?php echo $studName; ?></td>
									<td><?php echo $internJob_ID; ?></td>
									<td><?php echo $jobTitle; ?></td>
                  <td><?php echo $app_Status; ?></td>
                  <td><a class="view" href="xt-studentAppReview.php?InternAppID=<?php echo $internApp_ID; ?>">View</a></td>
                </tr>
								<?php } } ?>
							</tbody>
						</table>
					</div>

					<div id="Shortlisted" class="tabcontent">
						<div class="panel-body">
            	<div class="input-group">
								<input type="text" class="form-control" id="filterShortlistedList" data-filters="#dev-cat" data-action="filter" placeholder="Search..." style="background-color: transparent;">
								<a class="input-group-addon" style="border: 1px solid #797d7a;">
									<i class="fa fa-search"></i>
								</a>
							</div>
						</div>
						<table id="shortlistedTable" class="sortable">
							<thead>
								<tr>
									<th>#</th>
									<th>
										<button>
											<span aria-hidden="true">Application ID</span>
										</button>
									</th>
									<th>
										<button>
											<span aria-hidden="true">Student ID</span>
										</button>
									</th>
									<th>
										<button>
											<span aria-hidden="true">Student Name</span>
										</button>
									</th>
									<th>
										<button>
											<span aria-hidden="true">Job ID</span>
										</button>
									</th>
                  <th>
										<button>
											<span aria-hidden="true">Job Title</span>
										</button>
									</th>
                  <th>
										<button>
											<span aria-hidden="true">Status</span>
										</button>
									</th>
									<th>
										<button>
											<span aria-hidden="true">Student Response</span>
										</button>
									</th>
                  <th>Action</th>
								</tr>
							</thead>

							<tbody>
							<?php $i = 0; ?>
							<?php
								$host = "sql444.main-hosting.eu";
								$user = "u928796707_group34";
								$password = "u1VF3KYO1r|";
								$database = "u928796707_internshipWeb";
																						
								$conn = mysqli_connect($host, $user, $password, $database); 

									$get_intern = "SELECT * FROM InternJob WHERE companyID = 'CMP00001'";
									$run_intern = mysqli_query($conn, $get_intern);
									while($row_intern = mysqli_fetch_array($run_intern)){
										$internJobID = $row_intern['internJobID'];
										$jobTitle = $row_intern['jobTitle'];

										$get_internApp = "SELECT * FROM InternApplicationMap WHERE internJobID = '$internJobID' AND appStatus = 'Shortlisted'";
										$run_internApp = mysqli_query($conn, $get_internApp);
										while($row_internApp = mysqli_fetch_array($run_internApp)){
											$internJob_ID = $row_internApp['internJobID'];
											$internApp_ID = $row_internApp['internAppID'];
											$studentID = $row_internApp['studentID'];
											$app_Status = $row_internApp['appStatus'];
											$appStudentFeedback = $row_internApp['appStudentFeedback'];

											$getStud = "SELECT * FROM Student WHERE studentID = '$studentID'";
											$runStud = mysqli_query($conn, $getStud);
											if($rowStud = mysqli_fetch_array($runStud)){
												$studName = $rowStud['studName'];
											}
											
											$i++;
              ?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $internApp_ID; ?></td>
									<td><?php echo $studentID; ?></td>
									<td><?php echo $studName; ?></td>
									<td><?php echo $internJob_ID; ?></td>
									<td><?php echo $jobTitle; ?></td>
                  <td><?php echo $app_Status; ?></td>
									<td><?php echo $appStudentFeedback; ?></td>
                  <td><a class="view" href="xt-studAppResponse.php?InternAppID=<?php echo $internApp_ID; ?>">View</a></td>
                </tr>
								<?php } } ?>
							</tbody>
						</table>
					</div>

					<div id="Accepted" class="tabcontent">
						<div class="panel-body">
            	<div class="input-group">
								<input type="text" class="form-control" id="filterAcceptedList" data-filters="#dev-cat" data-action="filter" placeholder="Search..." style="background-color: transparent;">
								<a class="input-group-addon" style="border: 1px solid #797d7a;">
									<i class="fa fa-search"></i>
								</a>
							</div>
						</div>
						<table id="acceptedTable" class="sortable">
							<thead>
								<tr>
									<th>#</th>
									<th>
										<button>
											<span aria-hidden="true">Application ID</span>
										</button>
									</th>
									<th>
										<button>
											<span aria-hidden="true">Student ID</span>
										</button>
									</th>
									<th>
										<button>
											<span aria-hidden="true">Student Name</span>
										</button>
									</th>
									<th>
										<button>
											<span aria-hidden="true">Job ID</span>
										</button>
									</th>
                  <th>
										<button>
											<span aria-hidden="true">Job Title</span>
										</button>
									</th>
                  <th>
										<button>
											<span aria-hidden="true">Status</span>
										</button>
									</th>
                  <th>Action</th>
								</tr>
							</thead>

							<tbody>
							<?php $i = 0; ?>
							<?php
								$host = "sql444.main-hosting.eu";
								$user = "u928796707_group34";
								$password = "u1VF3KYO1r|";
								$database = "u928796707_internshipWeb";
																						
								$conn = mysqli_connect($host, $user, $password, $database); 

									$get_intern = "SELECT * FROM InternJob WHERE companyID = 'CMP00001'";
									$run_intern = mysqli_query($conn, $get_intern);
									while($row_intern = mysqli_fetch_array($run_intern)){
										$internJobID = $row_intern['internJobID'];
										$jobTitle = $row_intern['jobTitle'];

										$get_internApp = "SELECT * FROM InternApplicationMap WHERE internJobID = '$internJobID' AND appStatus = 'Accepted'";
										$run_internApp = mysqli_query($conn, $get_internApp);
										while($row_internApp = mysqli_fetch_array($run_internApp)){
											$internJob_ID = $row_internApp['internJobID'];
											$internApp_ID = $row_internApp['internAppID'];
											$studentID = $row_internApp['studentID'];
											$app_Status = $row_internApp['appStatus'];

											$getStud = "SELECT * FROM Student WHERE studentID = '$studentID'";
											$runStud = mysqli_query($conn, $getStud);
											if($rowStud = mysqli_fetch_array($runStud)){
												$studName = $rowStud['studName'];
											}
											
											$i++;
              ?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $internApp_ID; ?></td>
									<td><?php echo $studentID; ?></td>
									<td><?php echo $studName; ?></td>
									<td><?php echo $internJob_ID; ?></td>
									<td><?php echo $jobTitle; ?></td>
                  <td><?php echo $app_Status; ?></td>
                  <td><a class="view" href="xt-studentAppReview.php?InternAppID=<?php echo $internApp_ID; ?>">View</a></td>
                </tr>
								<?php } } ?>
							</tbody>
						</table>
					</div>

					<div id="Rejected" class="tabcontent">
						<div class="panel-body">
            	<div class="input-group">
								<input type="text" class="form-control" id="filterRejectedList" data-filters="#dev-cat" data-action="filter" placeholder="Search..." style="background-color: transparent;">
								<a class="input-group-addon" style="border: 1px solid #797d7a;">
									<i class="fa fa-search"></i>
								</a>
							</div>
						</div>
						<table id="rejectedTable" class="sortable">
							<thead>
								<tr>
									<th>#</th>
									<th>
										<button>
											<span aria-hidden="true">Application ID</span>
										</button>
									</th>
									<th>
										<button>
											<span aria-hidden="true">Student ID</span>
										</button>
									</th>
									<th>
										<button>
											<span aria-hidden="true">Student Name</span>
										</button>
									</th>
									<th>
										<button>
											<span aria-hidden="true">Job ID</span>
										</button>
									</th>
                  <th>
										<button>
											<span aria-hidden="true">Job Title</span>
										</button>
									</th>
                  <th>
										<button>
											<span aria-hidden="true">Status</span>
										</button>
									</th>
                  <th>Action</th>
								</tr>
							</thead>

							<tbody>
							<?php $i = 0; ?>
							<?php
								$host = "sql444.main-hosting.eu";
								$user = "u928796707_group34";
								$password = "u1VF3KYO1r|";
								$database = "u928796707_internshipWeb";
																						
								$conn = mysqli_connect($host, $user, $password, $database); 

									$get_intern = "SELECT * FROM InternJob WHERE companyID = 'CMP00001'";
									$run_intern = mysqli_query($conn, $get_intern);
									while($row_intern = mysqli_fetch_array($run_intern)){
										$internJobID = $row_intern['internJobID'];
										$jobTitle = $row_intern['jobTitle'];

										$get_internApp = "SELECT * FROM InternApplicationMap WHERE internJobID = '$internJobID' AND appStatus = 'Rejected'";
										$run_internApp = mysqli_query($conn, $get_internApp);
										while($row_internApp = mysqli_fetch_array($run_internApp)){
											$internJob_ID = $row_internApp['internJobID'];
											$internApp_ID = $row_internApp['internAppID'];
											$studentID = $row_internApp['studentID'];
											$app_Status = $row_internApp['appStatus'];

											$getStud = "SELECT * FROM Student WHERE studentID = '$studentID'";
											$runStud = mysqli_query($conn, $getStud);
											if($rowStud = mysqli_fetch_array($runStud)){
												$studName = $rowStud['studName'];
											}
											
											$i++;
              ?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $internApp_ID; ?></td>
									<td><?php echo $studentID; ?></td>
									<td><?php echo $studName; ?></td>
									<td><?php echo $internJob_ID; ?></td>
									<td><?php echo $jobTitle; ?></td>
                  <td><?php echo $app_Status; ?></td>
                  <td><a class="view" href="xt-studentAppReview.php?InternAppID=<?php echo $internApp_ID; ?>">View</a></td>
                </tr>
								<?php } } ?>
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
		function appType(evt, applicationType) {
			var i, tabcontent, tablinks;
			tabcontent = document.getElementsByClassName("tabcontent");
  		for (i = 0; i < tabcontent.length; i++) {
    		tabcontent[i].style.display = "none";
  		}
  		tablinks = document.getElementsByClassName("tablinks");
  		for (i = 0; i < tablinks.length; i++) {
    		tablinks[i].className = tablinks[i].className.replace(" active", "");
  		}
  		document.getElementById(applicationType).style.display = "block";
  		evt.currentTarget.className += " active";
		}
		document.getElementById("activeTab").click();
	</script>

<script>
		function filterAllTable(event) {
    	var filter = event.target.value.toUpperCase();
    	var rows = document.querySelector("#allTable tbody").rows;
    
    	for (var i = 0; i < rows.length; i++) {
				var firstCol = rows[i].cells[1].textContent.toUpperCase();
      	var secondCol = rows[i].cells[2].textContent.toUpperCase();
				var thirdCol = rows[i].cells[3].textContent.toUpperCase();
      	var forthCol = rows[i].cells[4].textContent.toUpperCase();
        var fifthCol = rows[i].cells[5].textContent.toUpperCase();
      	if (firstCol.indexOf(filter) > -1 || secondCol.indexOf(filter) > -1 || thirdCol.indexOf(filter) > -1 || forthCol.indexOf(filter) > -1 || fifthCol.indexOf(filter) > -1) {
					rows[i].style.display = "";
				} else {
        	rows[i].style.display = "none";
      	}      
			}
		}
		document.querySelector('#filterAllList').addEventListener('keyup', filterAllTable, false);
	</script>

<script>
		function filterPendingTable(event) {
    	var filter = event.target.value.toUpperCase();
    	var rows = document.querySelector("#pendingTable tbody").rows;
    
    	for (var i = 0; i < rows.length; i++) {
				var firstCol = rows[i].cells[1].textContent.toUpperCase();
      	var secondCol = rows[i].cells[2].textContent.toUpperCase();
				var thirdCol = rows[i].cells[3].textContent.toUpperCase();
      	var forthCol = rows[i].cells[4].textContent.toUpperCase();
        var fifthCol = rows[i].cells[5].textContent.toUpperCase();
      	if (firstCol.indexOf(filter) > -1 || secondCol.indexOf(filter) > -1 || thirdCol.indexOf(filter) > -1 || forthCol.indexOf(filter) > -1 || fifthCol.indexOf(filter) > -1) {
					rows[i].style.display = "";
				} else {
        	rows[i].style.display = "none";
      	}      
			}
		}
		document.querySelector('#filterPendingList').addEventListener('keyup', filterPendingTable, false);
	</script>

	<script>
		function filterShortlistedTable(event) {
    	var filter = event.target.value.toUpperCase();
    	var rows = document.querySelector("#shortlistedTable tbody").rows;
    
    	for (var i = 0; i < rows.length; i++) {
				var firstCol = rows[i].cells[1].textContent.toUpperCase();
      	var secondCol = rows[i].cells[2].textContent.toUpperCase();
				var thirdCol = rows[i].cells[3].textContent.toUpperCase();
      	var forthCol = rows[i].cells[4].textContent.toUpperCase();
        var fifthCol = rows[i].cells[5].textContent.toUpperCase();
      	if (firstCol.indexOf(filter) > -1 || secondCol.indexOf(filter) > -1 || thirdCol.indexOf(filter) > -1 || forthCol.indexOf(filter) > -1 || fifthCol.indexOf(filter) > -1) {
					rows[i].style.display = "";
				} else {
        	rows[i].style.display = "none";
      	}      
			}
		}
		document.querySelector('#filterShortlistedList').addEventListener('keyup', filterShortlistedTable, false);
	</script>

	<script>
		function filterAcceptedTable(event) {
    	var filter = event.target.value.toUpperCase();
    	var rows = document.querySelector("#acceptedTable tbody").rows;
    
    	for (var i = 0; i < rows.length; i++) {
				var firstCol = rows[i].cells[1].textContent.toUpperCase();
      	var secondCol = rows[i].cells[2].textContent.toUpperCase();
				var thirdCol = rows[i].cells[3].textContent.toUpperCase();
      	var forthCol = rows[i].cells[4].textContent.toUpperCase();
        var fifthCol = rows[i].cells[5].textContent.toUpperCase();
      	if (firstCol.indexOf(filter) > -1 || secondCol.indexOf(filter) > -1 || thirdCol.indexOf(filter) > -1 || forthCol.indexOf(filter) > -1 || fifthCol.indexOf(filter) > -1) {
					rows[i].style.display = "";
				} else {
        	rows[i].style.display = "none";
      	}      
			}
		}
		document.querySelector('#filterAcceptedList').addEventListener('keyup', filterAcceptedTable, false);
	</script>

	<script>
		function filterRejectedTable(event) {
    	var filter = event.target.value.toUpperCase();
    	var rows = document.querySelector("#allTable tbody").rows;
    
    	for (var i = 0; i < rows.length; i++) {
				var firstCol = rows[i].cells[1].textContent.toUpperCase();
      	var secondCol = rows[i].cells[2].textContent.toUpperCase();
				var thirdCol = rows[i].cells[3].textContent.toUpperCase();
      	var forthCol = rows[i].cells[4].textContent.toUpperCase();
        var fifthCol = rows[i].cells[5].textContent.toUpperCase();
      	if (firstCol.indexOf(filter) > -1 || secondCol.indexOf(filter) > -1 || thirdCol.indexOf(filter) > -1 || forthCol.indexOf(filter) > -1 || fifthCol.indexOf(filter) > -1) {
					rows[i].style.display = "";
				} else {
        	rows[i].style.display = "none";
      	}      
			}
		}
		document.querySelector('#filterRejectedList').addEventListener('keyup', filterRejectedTable, false);
	</script>

	<script src="../../js/jquery.nicescroll.js"></script>
	<script src="../../js/scripts.js"></script>
	<script src="../../js/bootstrap.js"> </script>

	<script>
		class SortableTable {
  	constructor(tableNode) {
    	this.tableNode = tableNode;
    	this.columnHeaders = tableNode.querySelectorAll('thead th');
    	this.sortColumns = [];

    	for (var i = 0; i < this.columnHeaders.length; i++) {
      	var ch = this.columnHeaders[i];
      	var buttonNode = ch.querySelector('button');
      	if (buttonNode) {
        	this.sortColumns.push(i);
        	buttonNode.setAttribute('data-column-index', i);
        	buttonNode.addEventListener('click', this.handleClick.bind(this));
      	}
    	}
			
			this.optionCheckbox = document.querySelector(
      	'input[type="checkbox"][value="show-unsorted-icon"]'
    	);

    	if (this.optionCheckbox) {
      	this.optionCheckbox.addEventListener(
        	'change',
        this.handleOptionChange.bind(this)
      );
			
				if (this.optionCheckbox.checked) {
        	this.tableNode.classList.add('show-unsorted-icon');
      	}
    	}
		}

  	setColumnHeaderSort(columnIndex) {
    	if (typeof columnIndex === 'string') {
      	columnIndex = parseInt(columnIndex);
    	}

    	for (var i = 0; i < this.columnHeaders.length; i++) {
      	var ch = this.columnHeaders[i];
      	var buttonNode = ch.querySelector('button');
      	if (i === columnIndex) {
        	var value = ch.getAttribute('aria-sort');
        	if (value === 'descending') {
          	ch.setAttribute('aria-sort', 'ascending');
          	this.sortColumn(
            	columnIndex,
            	'ascending',
            	ch.classList.contains('num')
          	);
        	} else {
          	ch.setAttribute('aria-sort', 'descending');
          	this.sortColumn(
            	columnIndex,
            	'descending',
            	ch.classList.contains('num')
          	);
        	}
      	} else {
        	if (ch.hasAttribute('aria-sort') && buttonNode) {
          	ch.removeAttribute('aria-sort');
        	}
      	}
			}
		}

  	sortColumn(columnIndex, sortValue, isNumber) {
    	function compareValues(a, b) {
      	if (sortValue === 'ascending') {
        	if (a.value === b.value) {
          	return 0;
        	} else {
          	if (isNumber) {
            	return a.value - b.value;
          	} else {
            	return a.value < b.value ? -1 : 1;
          	}
        	}
      	} else {
        	if (a.value === b.value) {
          	return 0;
        	} else {
          	if (isNumber) {
            	return b.value - a.value;
          	} else {
            	return a.value > b.value ? -1 : 1;
          	}
        	}
      	}
    	}

    	if (typeof isNumber !== 'boolean') {
      	isNumber = false;
    	}

    	var tbodyNode = this.tableNode.querySelector('tbody');
    	var rowNodes = [];
    	var dataCells = [];
    	var rowNode = tbodyNode.firstElementChild;
    	var index = 0;

    	while (rowNode) {
      	rowNodes.push(rowNode);
      	var rowCells = rowNode.querySelectorAll('th, td');
      	var dataCell = rowCells[columnIndex];
				var data = {};
      	data.index = index;
      	data.value = dataCell.textContent.toLowerCase().trim();
      
				if (isNumber) {
        	data.value = parseFloat(data.value);
      	}
      	dataCells.push(data);
      	rowNode = rowNode.nextElementSibling;
      	index += 1;
    	}

    	dataCells.sort(compareValues);

    	while (tbodyNode.firstChild) {
      	tbodyNode.removeChild(tbodyNode.lastChild);
    	}

    	for (var i = 0; i < dataCells.length; i += 1) {
      	tbodyNode.appendChild(rowNodes[dataCells[i].index]);
    	}
  	}

  	handleClick(event) {
    	var tgt = event.currentTarget;
    	this.setColumnHeaderSort(tgt.getAttribute('data-column-index'));
  	}

  	handleOptionChange(event) {
    	var tgt = event.currentTarget;

    	if (tgt.checked) {
      	this.tableNode.classList.add('show-unsorted-icon');
    	} else {
      	this.tableNode.classList.remove('show-unsorted-icon');
    	}
  	}
	}

	window.addEventListener('load', function () {
  	var sortableTables = document.querySelectorAll('table.sortable');
  	for (var i = 0; i < sortableTables.length; i++) {
    	new SortableTable(sortableTables[i]);
  	}
	});
</script>
</body>
</html>