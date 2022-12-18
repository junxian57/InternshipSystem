<?php
	include('../../includes/db_connection.php');

  if(session_status() != PHP_SESSION_ACTIVE) session_start();

	if (isset($_SESSION['studentChangePass'])) {
		header('Location: clientChangePassword.php?requireChangePass&notAllowed');
	}
    
  if (!isset($_SESSION['studentID'])) {
    echo "<script>
        window.location.href = 'clientLogin.php';
    </script>";
	} else {
    $studID = $_SESSION['studentID'];
  }
?>

<!DOCTYPE HTML>
<html>
<head>
	<title>ITP System | View Final Report</title>
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

  <style>
    h3.title1{
      padding-right: 30px;
      float: left;
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
					<h3 class="title1">View Final Report</h3><a href='xt-recordFinalReport.php' class='btn btn-success' id='btn-save' name='record'>Record Final Report</a>
					<hr>
					<div class="tab">
						<button class="tablinks" id="activeTab" onclick="statusType(event, 'Saved')">Saved</button>
						<button class="tablinks" onclick="statusType(event, 'Submitted')">Submitted</button>
					</div>

					<div id="Saved" class="tabcontent">
						<div class="panel-body">
            	<div class="input-group">
								<input type="text" class="form-control" id="filterProgress" data-filters="#dev-cat" data-action="filter" placeholder="Search..." style="background-color: transparent;">
								<a class="input-group-addon" style="border: 1px solid #797d7a;">
									<i class="fa fa-search"></i>
								</a>
							</div>
						</div>
						<table id="progressTable" class="sortable">
							<thead>
								<tr>
									<th>
										<button>
											<span aria-hidden="true">Monthly Report ID</span>
										</button>
									</th>
									<th>
										<button>
											<span aria-hidden="true">Company ID</span>
										</button>
									</th>
									<th>
										<button>
											<span aria-hidden="true">Company Name</span>
										</button>
									</th>
                  <th>
										<button>
											<span aria-hidden="true">Month of Training</span>
										</button>
									</th>
                  <th>
										<button>
											<span aria-hidden="true">Status</span>
										</button>
									</th>
                  <th style="border-right: 0;">Action</th>
									<th style="border-left: 0;"></th>
								</tr>
							</thead>

							<tbody>
							<?php
								$host = "sql444.main-hosting.eu";
                $user = "u928796707_group34";
                $password = "u1VF3KYO1r|";
                $database = "u928796707_internshipWeb";
                                              
                $conn = mysqli_connect($host, $user, $password, $database); 

                $get_month = "SELECT * FROM weeklyReport WHERE studentID = '$studID' AND reportStatus = 'Saved'";
                $run_month = mysqli_query($conn, $get_month);
                while($row_month = mysqli_fetch_array($run_month)){
                  $monthlyRptID = $row_month['monthlyReportID'];
                  $cmpID = $row_month['companyID'];
                  $monthOfTraining = $row_month['monthOfTraining'];
									$status = $row_month['reportStatus'];

									$get_cmp = "SELECT * FROM Company WHERE companyID = '$cmpID'";
                	$run_cmp = mysqli_query($conn, $get_cmp);
									$row_cmp = mysqli_fetch_array($run_cmp);
									$cmpName = $row_cmp['cmpName'];
              ?>
								<tr>
									<td><?php echo $monthlyRptID; ?></td>
									<td><?php echo $cmpID; ?></td>
									<td><?php echo $cmpName; ?></td>
									<td><?php echo $monthOfTraining; ?></td>
                  <td><?php echo $status; ?></td>
                  <td><a class="view" href="xt-editWorkProgress.php?monthlyReportID=<?php echo $monthlyRptID; ?>">Edit</a></td>
									<td><a class="view" onclick='javascript:confirmationDelete($(this));return false;' href="xt-deleteWorkProgress.php?monthlyReportID=<?php echo $monthlyRptID; ?>">Delete</a></td>
                </tr>
                <?php } ?>
							</tbody>
						</table>
					</div>

					<div id="Submitted" class="tabcontent">
						<div class="panel-body">
            	<div class="input-group">
								<input type="text" class="form-control" id="filterSProgress" data-filters="#dev-cat" data-action="filter" placeholder="Search..." style="background-color: transparent;">
								<a class="input-group-addon" style="border: 1px solid #797d7a;">
									<i class="fa fa-search"></i>
								</a>
							</div>
						</div>
						<table id="progressSTable" class="sortable">
							<thead>
								<tr>
									<th>
										<button>
											<span aria-hidden="true">Monthly Report ID</span>
										</button>
									</th>
									<th>
										<button>
											<span aria-hidden="true">Company ID</span>
										</button>
									</th>
									<th>
										<button>
											<span aria-hidden="true">Company Name</span>
										</button>
									</th>
                  <th>
										<button>
											<span aria-hidden="true">Month of Training</span>
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
							<?php
								$host = "sql444.main-hosting.eu";
                $user = "u928796707_group34";
                $password = "u1VF3KYO1r|";
                $database = "u928796707_internshipWeb";
                                              
                $conn = mysqli_connect($host, $user, $password, $database); 

                $get_month = "SELECT * FROM weeklyReport WHERE studentID = '$studID' AND reportStatus='Submitted'";
                $run_month = mysqli_query($conn, $get_month);
                while($row_month = mysqli_fetch_array($run_month)){
                  $monthlyRptID = $row_month['monthlyReportID'];
                  $cmpID = $row_month['companyID'];
                  $monthOfTraining = $row_month['monthOfTraining'];
									$status = $row_month['reportStatus'];

									$get_cmp = "SELECT * FROM Company WHERE companyID = '$cmpID'";
                	$run_cmp = mysqli_query($conn, $get_cmp);
									$row_cmp = mysqli_fetch_array($run_cmp);
									$cmpName = $row_cmp['cmpName'];

									$get_stud = "SELECT * FROM Student WHERE studentID = '$studID'";
                	$run_stud = mysqli_query($conn, $get_stud);
									$row_stud = mysqli_fetch_array($run_stud);
									$studName = $row_stud['studName'];
              ?>
								<tr>
									<td><?php echo $monthlyRptID; ?></td>
									<td><?php echo $cmpID; ?></td>
									<td><?php echo $cmpName; ?></td>
									<td><?php echo $monthOfTraining; ?></td>
                  <td><?php echo $status; ?></td>
									

                  <td><?php echo '<a href="../page/monthlyRpt/'.$monthlyRptID.'_'.$studName.'_'.$monthOfTraining.'.pdf" target="_blank">';?>View</a></td>
                </tr>
                <?php } ?>
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
		function confirmationDelete(anchor){
   		var conf = confirm('Are you sure want to delete this report?');
   			if(conf)
      		window.location=anchor.attr("href");
		}
	</script>

	<script>
		function statusType(evt, statusType) {
			var i, tabcontent, tablinks;
			tabcontent = document.getElementsByClassName("tabcontent");
  		for (i = 0; i < tabcontent.length; i++) {
    		tabcontent[i].style.display = "none";
  		}
  		tablinks = document.getElementsByClassName("tablinks");
  		for (i = 0; i < tablinks.length; i++) {
    		tablinks[i].className = tablinks[i].className.replace(" active", "");
  		}
  		document.getElementById(statusType).style.display = "block";
  		evt.currentTarget.className += " active";
		}
		document.getElementById("activeTab").click();
	</script>

	<script>
		function filterProgressTable(event) {
    	var filter = event.target.value.toUpperCase();
    	var rows = document.querySelector("#progressTable tbody").rows;
    
    	for (var i = 0; i < rows.length; i++) {
				var firstCol = rows[i].cells[0].textContent.toUpperCase();
      	var secondCol = rows[i].cells[1].textContent.toUpperCase();
				var thirdCol = rows[i].cells[2].textContent.toUpperCase();
      	var forthCol = rows[i].cells[3].textContent.toUpperCase();
				var fifthCol = rows[i].cells[4].textContent.toUpperCase();
      	var sixthCol = rows[i].cells[5].textContent.toUpperCase();
      	if (firstCol.indexOf(filter) > -1 || secondCol.indexOf(filter) > -1 || thirdCol.indexOf(filter) > -1 || forthCol.indexOf(filter) > -1 || fifthCol.indexOf(filter) > -1 || sixthCol.indexOf(filter) > -1) {
					rows[i].style.display = "";
				} else {
        	rows[i].style.display = "none";
      	}      
			}
		}
		document.querySelector('#filterProgress').addEventListener('keyup', filterProgressTable, false);
	
		function filterSProgressTable(event) {
    	var filter = event.target.value.toUpperCase();
    	var rows = document.querySelector("#progressSTable tbody").rows;
    
    	for (var i = 0; i < rows.length; i++) {
				var firstCol = rows[i].cells[0].textContent.toUpperCase();
      	var secondCol = rows[i].cells[1].textContent.toUpperCase();
				var thirdCol = rows[i].cells[2].textContent.toUpperCase();
      	var forthCol = rows[i].cells[3].textContent.toUpperCase();
				var fifthCol = rows[i].cells[4].textContent.toUpperCase();
      	var sixthCol = rows[i].cells[5].textContent.toUpperCase();
      	if (firstCol.indexOf(filter) > -1 || secondCol.indexOf(filter) > -1 || thirdCol.indexOf(filter) > -1 || forthCol.indexOf(filter) > -1 || fifthCol.indexOf(filter) > -1 || sixthCol.indexOf(filter) > -1) {
					rows[i].style.display = "";
				} else {
        	rows[i].style.display = "none";
      	}      
			}
		}
		document.querySelector('#filterSProgress').addEventListener('keyup', filterSProgressTable, false);
	
	
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