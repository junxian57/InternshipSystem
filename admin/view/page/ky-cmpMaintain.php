<?php
session_start();
error_reporting(0);
include('includes/db_connection.php');
/*if (strlen($_SESSION['bpmsaid'] == 0)) {
	header('location:logout.php');
} else {

	if (isset($_POST['submit'])) {
		$sername = $_POST['sername'];
		$cost = $_POST['cost'];



		$query = mysqli_query($con, "insert into  tblservices(ServiceName,Cost) value('$sername','$cost')");
		if ($query) {
			echo "<script>alert('Service has been added.');</script>";
			echo "<script>window.location.href = 'add-services.php'</script>";
			$msg = "";
		} else {
			echo "<script>alert('Something Went Wrong. Please try again.');</script>";
		}
	}*/
?>
<!DOCTYPE HTML>
<html>

<head>
<title>ITP SYSTEM</title>
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <link href="../../css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="../../css/style.css" rel='stylesheet' type='text/css' />
    <link href="../../css/font-awesome.css" rel="stylesheet">
    <script src="../../js/jquery-1.11.1.min.js"></script>
    <script src="../../js/modernizr.custom.js"></script>
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href="../../css/animate.css" rel="stylesheet" type="text/css" media="all">
    <script src="../../js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <script src="../../js/metisMenu.min.js"></script>
    <script src="../../js/custom.js"></script>
    <link href="../../css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="../../scss/br-cmpAppReview.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.co">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



</head>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once('../../includes/sidebar.php'); ?>
        <?php include_once('../../includes/header.php'); ?>
        <div id="page-wrapper">
            <div class="main-page">
                <div class="forms">
                    <h3 class="page-title">Company Maintenance</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                        <!-- Tab Content 1-->
                        <div id="StudentToSupervisor" class="tabcontent">
                            <div class="table-title">
                                <input type="search" id="keyInput" onkeyup="searchInTable()" placeholder="Enter Keyword of Company Name...">
                                <p>Hint: Table Below Is Scrollable</p>
                            </div>
                            <div class="table-responsive black-border">
                    <div class="table_section">
                    <table id="myTable">
                            <thead>
                                <tr>
                                <th>Company Id</th>
                                <th>Name</th>
                                <th>Contact No</th>
                                <th>Email</th>
                                <th>Field Area</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td>1</td>
                                <td>Dell</td>
                                <td>012334555</td>
                                <td>dell@gmail.com</td>
                                <td>IT</td>
                                <td>
                                    <div class="button-group">
                                        <!--                                    
                                        //TODO: onclick -> start retrieve student list and proceed mapping
                                        -->
                                        <button><i class="uil uil-pen" style="color:#0298cf"></i></button>
                                        <button><i class="fa fa-eye" style ="color:red"></i></button>
                                    </div>
                                </td>
                                </tr>
                                <tr>
                                <td>2</td>
                                <td>Intel</td>
                                <td>01562344</td>
                                <td>intel@gmail.com</td>
                                <td>IT</td>
                                <td>
                                    <div class="button-group">
                                        <!--                                    
                                        //TODO: onclick -> start retrieve student list and proceed mapping
                                        -->
                                        <button><i class="uil uil-pen" style="color:#0298cf"></i></button>
                                        <button><i class="fa fa-eye" style ="color:red"></i></button>
                                    </div>
                                </td>
                                </tr>
                                <tr>
                                <td>3</td>
                                <td>Dell</td>
                                <td>012334555</td>
                                <td>dell@gmail.com</td>
                                <td>IT</td>
                                <td>
                                    <div class="button-group">
                                        <!--                                    
                                        //TODO: onclick -> start retrieve student list and proceed mapping
                                        -->
                                        <button><i class="uil uil-pen" style="color:#0298cf"></i></button>
                                        <button><i class="fa fa-eye" style ="color:red"></i></button>
                                    </div>
                                </td>
                                </tr>
                                <tr>
                                <td>4</td>
                                <td>Dell</td>
                                <td>012334555</td>
                                <td>dell@gmail.com</td>
                                <td>IT</td>
                                <td>
                                    <div class="button-group">
                                        <!--                                    
                                        //TODO: onclick -> start retrieve student list and proceed mapping
                                        -->
                                        <button><i class="uil uil-pen" style="color:#0298cf"></i></button>
                                        <button><i class="fa fa-eye" style ="color:red"></i></button>
                                    </div>
                                </td>
                                </tr>
                                <tr>
                                <td>5</td>
                                <td>Dell</td>
                                <td>012334555</td>
                                <td>dell@gmail.com</td>
                                <td>IT</td>
                                <td>
                                    <div class="button-group">
                                        <!--                                    
                                        //TODO: onclick -> start retrieve student list and proceed mapping
                                        -->
                                        <button><i class="uil uil-pen" style="color:#0298cf"></i></button>
                                        <button><i class="fa fa-eye" style ="color:red"></i></button>
                                    </div>
                                </td>
                                </tr>
                                <tr>
                                <td>6</td>
                                <td>Dell</td>
                                <td>012334555</td>
                                <td>dell@gmail.com</td>
                                <td>IT</td>
                                <td>
                                    <div class="button-group">
                                        <!--                                    
                                        //TODO: onclick -> start retrieve student list and proceed mapping
                                        -->
                                        <button><i class="uil uil-pen" style="color:#0298cf"></i></button>
                                        <button><i class="fa fa-eye" style ="color:red"></i></button>
                                    </div>
                                </td>
                                </tr>
                                <tr>
                                <td>7</td>
                                <td>Dell</td>
                                <td>012334555</td>
                                <td>dell@gmail.com</td>
                                <td>IT</td>
                                <td>
                                    <div class="button-group">
                                        <!--                                    
                                        //TODO: onclick -> start retrieve student list and proceed mapping
                                        -->
                                        <button><i class="uil uil-pen" style="color:#0298cf"></i></button>
                                        <button><i class="fa fa-eye" style ="color:red"></i></button>
                                    </div>
                                </td>
                                </tr>
                                <tr>
                                <td>8</td>
                                <td>Dell</td>
                                <td>012334555</td>
                                <td>dell@gmail.com</td>
                                <td>IT</td>
                                <td>
                                    <div class="button-group">
                                        <!--                                    
                                        //TODO: onclick -> start retrieve student list and proceed mapping
                                        -->
                                        <button><i class="uil uil-pen" style="color:#0298cf"></i></button>
                                        <button><i class="fa fa-eye" style ="color:red"></i></button>
                                    </div>
                                </td>
                                </tr>
                                
                            
                                <tr>
                                <td>9</td>
                                <td>Dell</td>
                                <td>012334555</td>
                                <td>dell@gmail.com</td>
                                <td>IT</td>
                                <td>
                                    <div class="button-group">
                                        <!--                                    
                                        //TODO: onclick -> start retrieve student list and proceed mapping
                                        -->
                                        <button><i class="uil uil-pen" style="color:#0298cf"></i></button>
                                        <button><i class="fa fa-eye" style ="color:red"></i></button>
                                    </div>
                                </td>
                                </tr>
                                <tr>
                                <td>10</td>
                                <td>Dell</td>
                                <td>012334555</td>
                                <td>dell@gmail.com</td>
                                <td>IT</td>
                                <td>
                                    <div class="button-group">
                                        <!--                                    
                                        //TODO: onclick -> start retrieve student list and proceed mapping
                                        -->
                                        <button><i class="uil uil-pen" style="color:#0298cf"></i></button>
                                        <button><i class="fa fa-eye" style ="color:red"></i></button>
                                    </div>
                                </td>
                                </tr>
                            
                                
                            </tbody>
                        </table>
                    </div>
            
                 </div>
            </div>
        </div>
        <footer><?php include_once('../../includes/footer.php'); ?></footer>
</body>

<script src="../../js/classie.js"></script>
<script src="../../js/bootstrap.js"> </script>
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
    function searchInTable() {
        let input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("keyInput");
        filter = input.value;
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    //Search Result on Search Bar
    function inputSearchResult() {
        const getSearchResultArr = document.getElementsByClassName('search-result');
        const getSearchBar = document.getElementById('searchBar');
        const getResultBox = document.querySelector('.result-box');

        if (getSearchResultArr.length > 0) {
            for (let i = 0; i < getSearchResultArr.length; i++) {
                getSearchResultArr[i].addEventListener('click', (btn) => {
                    getSearchBar.value = btn.target.innerText;
                    getResultBox.style.display = 'none';
                });
            }
        } else {
            return;
        }
    }

    function removeAllChildNodes(parent) {
        while (parent.firstChild) {
            parent.removeChild(parent.firstChild);
        }
    }

    async function displaySearchResult() {
        const getResultBox = document.querySelector('.result-box');
        const respondResult = await searchBarData();
        let resultArr = [];

        if (respondResult === null || respondResult === undefined || respondResult.length == 0) {
            getResultBox.style.display = 'none';
            return;
        }
        //Clear the existing box
        removeAllChildNodes(getResultBox);

        if (respondResult !== null || respondResult !== undefined || respondResult.length != 0) {
            for (let i = 0; i < Object.keys(respondResult).length; i++) {
                resultArr[i] =
                    `<li class='search-result'>${respondResult[i].employeeID}: ${respondResult[i].fullName}</li>`;
            }
        } else {
            getResultBox.style.display = 'none';
            return;
        }

        getResultBox.style.display = 'block';
        getResultBox.innerHTML = resultArr.join('');
        inputSearchResult();
    }

    async function searchBarData() {
        const getSearchInput = document.getElementById('searchBar').value;
        const getResultBox = document.querySelector('.result-box');
        let url;

        if (getSearchInput == '') {
            getResultBox.style.display = 'none';
            return;
        } else {
            if (Number.isInteger(parseInt(getSearchInput))) {
                url = '../php-inc/ajaxSearchEmployee.php?icNo=' + getSearchInput;
            } else {
                url = '../php-inc/ajaxSearchEmployee.php?fullName=' + getSearchInput;
            }
            const response = await fetch(url);
            const data = await response.json();
            return data;
        }
    }
</script>


</html>