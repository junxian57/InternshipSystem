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
	$internStart = $_POST['internStart'];
	$internEnd = $_POST['internEnd'];

  $host = "sql444.main-hosting.eu";
  $user = "u928796707_group34";
  $password = "u1VF3KYO1r|";
  $database = "u928796707_internshipWeb";
                                
  $conn = mysqli_connect($host, $user, $password, $database); 

  $query = "SELECT * FROM InternApplicationMap ORDER BY internAppID DESC LIMIT 1";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);
	$lastID = $row['internAppID'];
	if($lastID == "") {
		$internAppID = "InAM10001";
	} else {
		$internAppID = substr($lastID, 4);
		$internAppID = intval($internAppID);
		$internAppID = "InAM".($internAppID + 1);
	}

  $studID = "22REI00003";
	$appStatus = "Pending Review";

	$get_stud = "SELECT * FROM Student WHERE studentID = '$studID'";
	$run_stud = mysqli_query($conn, $get_stud);
  $row_stud = mysqli_fetch_array($run_stud);
  $studentCVdocument = $row_stud['studentCVdocument'];
	$studApplicationQuota = $row_stud['studApplicationQuota'];
	$applicationQuota = intval($studApplicationQuota);

	$get_app = "SELECT * FROM InternApplicationMap WHERE studentID = '$studID' AND internJobID = '$internJobID'";
	$run_app = mysqli_query($conn, $get_app);
  if($row_app = mysqli_fetch_array($run_app)){
		echo "<script>alert('Your have applied for this company before.')</script>";
	}
	else{
		if($applicationQuota >= 1){
			$sql = "INSERT INTO InternApplicationMap (internAppID, studentID, internJobID, appStatus, appStudentCV, appInternStartDate, appInternEndDate) VALUES ('$internAppID', '$studID', '$internJobID','$appStatus','$studentCVdocument', '$internStart', '$internEnd')";
			
			$applicationQuota = $applicationQuota - 1;
	
			$query = "UPDATE Student SET studApplicationQuota ='$applicationQuota' WHERE studentID='$studID'";
			if ((mysqli_query($conn, $sql)) && (mysqli_query($conn, $query))){
				echo "<script>alert('Your application have been sent to the company.')</script>"; 
			} else {
				echo "Error: " . $sql . mysqli_error($conn);
			}   
		}else{
			echo "<script>alert('You have reach your maximum application quota!')</script>"; 
		}
	}  
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>ITP System | Student Job Application</title>
	<link href="../../css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="../../css/style.css" rel='stylesheet' type='text/css' />
	<link href="../../css/font-awesome.css" rel="stylesheet">
	<link href="../../css/xt-companiesList.css" rel="stylesheet">
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
					<h3 class="title1">Job Applied</h3>
					<div class="table-responsive bs-example widget-shadow" style="background: transparent; border: 1px solid #797d7a;">
					<div class="panel-body">
            <div class="input-group">
							<input type="text" class="form-control" id="filterStudAppList" data-filters="#dev-cat" data-action="filter" placeholder="Search..." style="background-color: transparent;">
							<a class="input-group-addon" style="border: 1px solid #797d7a;">
								<i class="fa fa-search"></i>
							</a>
						</div>
					</div>
						<table id="studAppListTable" class="sortable">
							<thead>
								<tr>
									<th>#</th>
									<th>
										<button>
											<span aria-hidden="true">Company Name</span>
										</button>
									</th>
									<th>
										<button>
											<span aria-hidden="true">Job Title</span>
										</button>
									</th>
									<th>
										<button>
											<span aria-hidden="true">Fields</span>
										</button>
									</th>
                  <th>
										<button>
											<span aria-hidden="true">Location</span>
										</button>
									</th>
									<th class="num" style=" width: 150px;">
										<button>
											<span aria-hidden="true">Allowance (RM)</span>
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
						
								$get_internApp = "SELECT * FROM InternApplicationMap WHERE studentID = '22REI00003'";
								$run_internApp = mysqli_query($conn, $get_internApp);
								while($row_internApp = mysqli_fetch_array($run_internApp)){
									$internApp_ID = $row_internApp['internAppID'];
									$internJob_ID = $row_internApp['internJobID'];
									$app_Status = $row_internApp['appStatus'];
									
									$get_intern = "SELECT * FROM InternJob WHERE internJobID = '$internJob_ID'";
									$run_intern = mysqli_query($conn, $get_intern);
									$row_intern = mysqli_fetch_array($run_intern);
									$cmpID = $row_intern['companyID'];
									$jobTitle = $row_intern['jobTitle'];
									$jobAllowance = $row_intern['jobAllowance'];
									$jobFieldsArea = $row_intern['jobFieldsArea'];
								
									$get_cmp = "SELECT * FROM Company WHERE companyID = '$cmpID'";
									$run_cmp = mysqli_query($conn, $get_cmp);
									$row_cmp = mysqli_fetch_array($run_cmp);
									$cmpName = $row_cmp['cmpName'];
									$cmpAddress = $row_cmp['cmpAddress'];
									$cmpEmail = $row_cmp['cmpEmail'];

									$i++;
              ?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $cmpName; ?></td>
									<td><?php echo $jobTitle; ?></td>
									<td><?php echo $jobFieldsArea; ?></td>
									<td><?php echo $cmpAddress; ?></td>
                  <td><?php echo $jobAllowance; ?></td>
                  <td><?php echo $app_Status; ?></td>
                  <td><a class="view" href="xt-viewJobApplied.php?InternAppID=<?php echo "InternAppID"; ?>">View</a></td>
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
		function filterStudAppListTable(event) {
    	var filter = event.target.value.toUpperCase();
    	var rows = document.querySelector("#studAppListTable tbody").rows;
    
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
		document.querySelector('#filterStudAppList').addEventListener('keyup', filterStudAppListTable, false);
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