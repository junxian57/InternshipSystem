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
    <link rel="stylesheet" href="../../scss/studentRegister.css">
    <style>

    </style>
</head>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once('../../includes/sidebar.php'); ?>
        <?php include_once('../../includes/header.php'); ?>
        <div id="page-wrapper">
            <div class="main-page">
            <div class="forms">
                    <h3 class="page-title">Student Maintenance</h3>

            <table class="content-table">
                <thead>
                    <tr>
                    <th>User Id</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Faculty</th>
                    <th>Programme</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>1</td>
                    <td>Kang Yi</td>
                    <td>KY001</td>
                    <td>KL</td>
                    <td>017-59797976</td>
                    <td>FOCS</td>
                    <td>REI</td>
                    <td><div class="button-group">
                            <!--                                    
                            //TODO: onclick -> start retrieve student list and proceed mapping
                            -->
                            <button class="clickable-btn" onclick="confirm('Confirm For Mapping?')" href="index.php">Assign</button>
                            <buyyon class="clickable-btn" href="#">Reset All</buyyon>
                        </div>
                    </td>
                    </tr>
                    <tr>
                    <td>2</td>
                    <td>Jame</td>
                    <td>JM007</td>
                    <td>JB</td>
                    <td>012-56444448</td>
                    <td>FOCS</td>
                    <td>RIS</td>
                    <td><div class="button-group">
                            <!--                                    
                            //TODO: onclick -> start retrieve student list and proceed mapping
                            -->
                            <button class="clickable-btn" onclick="confirm('Confirm For Mapping?')" href="index.php">Assign</button>
                            <buyyon class="clickable-btn" href="#">Reset All</buyyon>
                        </div>
                    </td>
                    </tr>
                    <tr>
                    <td>3</td>
                    <td>Lily</td>
                    <td>llily</td>
                    <td>Perlis</td>
                    <td>018-56228899</td>
                    <td>FAFB</td>
                    <td>RRD</td>
                    <td><div class="button-group">
                            <!--                                    
                            //TODO: onclick -> start retrieve student list and proceed mapping
                            -->
                            <button class="clickable-btn" onclick="confirm('Confirm For Mapping?')" href="index.php">Assign</button>
                            <buyyon class="clickable-btn" href="#">Reset All</buyyon>
                        </div>
                    </td>
                    </tr>
                    <tr>
                    <td>4</td>
                    <td>Steve</td>
                    <td>sstts</td>
                    <td>Kedah</td>
                    <td>013-38299494</td>
                    <td>FAFB</td>
                    <td>RRD</td>
                    <td><div class="button-group">
                            <!--                                    
                            //TODO: onclick -> start retrieve student list and proceed mapping
                            -->
                            <button class="clickable-btn" onclick="confirm('Confirm For Mapping?')" href="index.php">Assign</button>
                            <buyyon class="clickable-btn" href="#">Reset All</buyyon>
                        </div>
                    </td>
                    </tr>
                </tbody>
            </table>
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
    document.getElementById("defaultOpen").click();

    function changeTab(evt, tabName) {
        // Declare all variables
        let i, tabcontent, tablinks;

        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Show the current tab, and add an "active" class to the button that opened the tab
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
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