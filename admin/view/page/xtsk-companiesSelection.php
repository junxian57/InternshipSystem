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

		button{
			border: none;
		}
		
		table tbody td, th {
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
											<span aria-hidden="true">Industry ▼</span>
										</button>
									</th>
									<th>
										<button>
											<span aria-hidden="true">Location ▼</span>
										</button>
									</th>
									<th>
										<button>
											<span aria-hidden="true">Company Size ▼</span>
										</button>
									</th>
									<th>
										<button>
											<span aria-hidden="true">Rating ▼</span>
										</button>
									</th>
									<th class="num">
										<button>
											<span aria-hidden="true">Allowance (RM) ▼</span>
										</button>
									</th>
									<th>Action</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td>1</td>
									<td>Unilifesity SDN BHD</td>
									<td>Finance and Accounting</td>
									<td>Selangor</td>
									<td>50 - 100</td>
									<td>3</td>
									<td>800 - 1000</td>
									<td><a class="view" href="view-companies.php?cmpID=<?php echo "cmpID"; ?>">View</a></td>
								</tr>

								<tr>
									<td>2</td>
									<td>Samsung Malaysia</td>
									<td>Finance and Accounting</td>
									<td>Kuala Lumpur</td>
									<td>50 - 100</td>
									<td>4</td>
									<td>1000 - 1200</td>
									<td><a class="view" href="view-companies.php?cmpID=<?php echo "cmpID"; ?>">View</a></td>
								</tr>

								<tr>
									<td>3</td>
									<td>Hap Seng SDN BHD</td>
									<td>Finance and Accounting</td>
									<td>Pulau Pinang</td>
									<td>50 - 100</td>
									<td>4</td>
									<td>1000 - 1200</td>
									<td><a class="view" href="view-companies.php?cmpID=<?php echo "cmpID"; ?>">View</a></td>
								</tr>

								<tr>
									<td>4</td>
									<td>Smazh Premium SDN BHD</td>
									<td>Finance and Accounting</td>
									<td>Selangor</td>
									<td>50 - 100</td>
									<td>5</td>
									<td>1000 - 1200</td>
									<td><a class="view" href="view-companies.php?cmpID=<?php echo "cmpID"; ?>">View</a></td>
								</tr>

								<tr>
									<td>5</td>
									<td>SkyWorld Development SDN BHD</td>
									<td>Finance and Accounting</td>
									<td>Kedah</td>
									<td>50 - 100</td>
									<td>5</td>
									<td>1000 - 1200</td>
									<td><a class="view" href="view-companies.php?cmpID=<?php echo "cmpID"; ?>">View</a></td>
								</tr>

								<tr>
									<td>6</td>
									<td>Unilifesity SDN BHD</td>
									<td>Finance and Accounting</td>
									<td>Kelantan</td>
									<td>50 - 100</td>
									<td>2</td>
									<td>1000 - 1200</td>
									<td><a class="view" href="view-companies.php?cmpID=<?php echo "cmpID"; ?>">View</a></td>
								</tr>

								<tr>
									<td>7</td>
									<td>BMW Coding SDN BHD</td>
									<td>Finance and Accounting</td>
									<td>Kuala Lumpur</td>
									<td>50 - 100</td>
									<td>3</td>
									<td>1000 - 1200</td>
									<td><a class="view" href="view-companies.php?cmpID=<?php echo "cmpID"; ?>">View</a></td>
								</tr>

								<tr>
									<td>8</td>
									<td>KK Supermart & Superstore Sdn Bhd</td>
									<td>Finance and Accounting</td>
									<td>Kuala Lumpur</td>
									<td>50 - 100</td>
									<td>3</td>
									<td>1000 - 1200</td>
									<td><a class="view" href="view-companies.php?cmpID=<?php echo "cmpID"; ?>">View</a></td>
								</tr>

								<tr>
									<td>9</td>
									<td>Arissto (Malaysia) Sdn Bhd</td>
									<td>Finance and Accounting</td>
									<td>Johor</td>
									<td>50 - 100</td>
									<td>4</td>
									<td>1000 - 1200</td>
									<td><a class="view" href="view-companies.php?cmpID=<?php echo "cmpID"; ?>">View</a></td>
								</tr>

								<tr>
									<td>10</td>
									<td>Prosains (M) Sdn Bhd</td>
									<td>Finance and Accounting</td>
									<td>Selangor</td>
									<td>50 - 100</td>
									<td>4</td>
									<td>1200 - 1500</td>
									<td><a class="view" href="view-companies.php?cmpID=<?php echo "cmpID"; ?>">View</a></td>
								</tr>

								<tr>
									<td>11</td>
									<td>Origin Integrated Studios Sdn Bhd</td>
									<td>Finance and Accounting</td>
									<td>Sarawak</td>
									<td>50 - 100</td>
									<td>2</td>
									<td>2000 - 2500</td>
									<td><a class="view" href="view-companies.php?cmpID=<?php echo "cmpID"; ?>">View</a></td>
								</tr>

								<tr>
									<td>12</td>
									<td>Dommal Food Services Sdb Bhd</td>
									<td>Finance and Accounting</td>
									<td>Sabah</td>
									<td>50 - 100</td>
									<td>4</td>
									<td>1000 - 1200</td>
									<td><a class="view" href="view-companies.php?cmpID=<?php echo "cmpID"; ?>">View</a></td>
								</tr>

								<tr>
									<td>13</td>
									<td>Sunway Money Sdn Bhd</td>
									<td>Finance and Accounting</td>
									<td>Melaka</td>
									<td>50 - 100</td>
									<td>4</td>
									<td>1000 - 1200</td>
									<td><a class="view" href="view-companies.php?cmpID=<?php echo "cmpID"; ?>">View</a></td>
								</tr>

								<tr>
									<td>14</td>
									<td>Fire Pos Sdn Bhd</td>
									<td>Finance and Accounting</td>
									<td>Pulau Pinang</td>
									<td>50 - 100</td>
									<td>4</td>
									<td>1000 - 1200</td>
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

    // remove rows
    while (tbodyNode.firstChild) {
      tbodyNode.removeChild(tbodyNode.lastChild);
    }

    // add sorted rows
    for (var i = 0; i < dataCells.length; i += 1) {
      tbodyNode.appendChild(rowNodes[dataCells[i].index]);
    }
  }

  /* EVENT HANDLERS */

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

// Initialize sortable table buttons
window.addEventListener('load', function () {
  var sortableTables = document.querySelectorAll('table.sortable');
  for (var i = 0; i < sortableTables.length; i++) {
    new SortableTable(sortableTables[i]);
  }
});
</script>

</body>
<footer><?php include_once('includes/footer.php'); ?></footer>

</html>