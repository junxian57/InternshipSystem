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
    <link rel="stylesheet" href="../../scss/ky-cmpMaintain.css">
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
                <div class="container">
                    <div class="forms">
                        <h3 class="page-title">Company Details</h3>
                        <div class="form-grids row widget-shadow" data-example-id="basic-forms">

                            <div class="content">
                                <form action="#">
                                    <div class="user-details">
                                    <div class="title">
                                        <h2 class="title-1">Company Name & Contact</h2>
                                    </div>
                                    <div class="input-style name-address-group">
                                        <input type="text" style="width: 100%;" placeholder="Company Name" name="cmpName" required readonly>                  
                                    </div>

                                    <div class="input-style name-address-group">
                                        <input type="text" placeholder="Contact No." name="cmpContactNo" required readonly>   
                                        <input type="email" placeholder="Email" name="cmpEmail" required readonly>             
                                    </div>

                                    <div class="input-style name-address-group">
                                        <input type="text" placeholder="Contact Person" name="cmpContactPerson" required readonly>                
                                    </div>

                                    <div class="title">
                                        <h2 class="title-2">Company Address</h2>
                                    </div>
                                    <div class="input-style name-address-group">
                                        <textarea type="text" name="cmpAddress" placeholder="Address" cols="30" rows="5" required readonly></textarea>
                                    </div>

                                    <div class="input-style name-address-group">
                                        <input type="text" placeholder="State" name="cmpState" required readonly> 
                                        <input type="text" placeholder="Postcode" name="cmpPostCode" required readonly>                  
                                    </div>

                                    <div class="input-style name-address-group">
                                        <input type="text" placeholder="City" name="cmpCity" required readonly>                   
                                    </div>

                                    <div class="title">
                                        <h2 class="title-3">Company Details</h2>
                                    </div>

                                    <div class="company-details-group input-style">  
                                        <input type="text" style="width: 100%;" placeholder="Company Size" name="cmpFieldArea" required readonly>              
                                    </div>

                                    <div class="title">
                                        <h2 class="title-3">Company Fields</h2>
                                    </div>
                                    
                                    <div class="company-details-group input-style">
                                        <div id="fields-row" class="task-row">
                                            <div class="row">
                                                <p>IT</p>              
                                            </div>
                                            <div class="row">
                                                <p>Accounting</p>
                                            </div>
                                            <div class="row">
                                                <p>Business</p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="button-group">
                                        <a class="clickable-btn Update" href="">Update</a>
                                        <a class="clickable-btn Export" href="">Export</a>
                                    </div>
                                </form>
                            </div>
                         
                           
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <footer><?php include_once('../../includes/footer.php'); ?></footer>
        <script src="../../js/companyLogin.js"></script>
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