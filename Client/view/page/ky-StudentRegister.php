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
                    <h3 class="page-title">Student Registration</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">

                        <!-- Tab Button 
                        <div class="tab">
                            <button class="tablinks" onclick="changeTab(event, 'StudentToSupervisor')" id='defaultOpen'>Assign Students <span class="arrow-icon">&#129050</span> Supervisors</button>
                            <button class="tablinks" onclick="changeTab(event, 'SupervisorToStudent')">Assign Supervisors <span class="arrow-icon">&#129050</span> Students</button>
                            <button class="tablinks" onclick="changeTab(event, 'AutomatedMap')">Automated Mapping</button>
                        </div>-->
                        

                        <!-- Tab Content 1
                        <div id="StudentToSupervisor" class="tabcontent"></div>-->
                           
                                <div class="form-group">
                                    <label for="username">User name <span class="required-star">*</span></label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter user name" required minlength="3" maxlength="11">
                                    <div class="form-control result-box">
                                        <!--                                    
                                        //TODO: Javascript need to fix         
                                        -->
                                    </div>
                                </div>

                                <!--                                    
                                //TODO: Require AJAX method to retrieve student group         
                                -->
                            
                                <div class="form-row">
                                    <div class="form-group">
                                    <b><label for="firstName">First Name:</label></b>
                                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" required>
                                    </div>
                                    <div class="form-group">
                                    <b><label for="lastName">Last name:</label></b>
                                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last name" required>
                                    </div>
                                </div>

                                </div>
                                    <div class="form-group">
                                        <b><label>Gender:</label></b><br>
                                        <input style="margin-left: 80px" type="radio" id="male" name="gender" value="Male" class = "radio"/>Male
                                        <input style="margin-left: 90px" type="radio" id="female" name="gender" value="Female" class = "radio"/>Female
                                    </div>
                                <div class="form-group">
                                    <b><label for="email">Email:</label></b>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email" required>
                                </div>
                                <div class="form-group">
                                    <b><label for="phone">Phone No:</label></b>
                                    <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon">+60</span>
                                    </div>
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter Your Phone Number" required pattern="[0-9]{10}" maxlength="10">
                                    </div>
                                </div>
                                    <div class="text-left my-2">
                                    <b><label for="address">Address:</label></b>
                                    <input class="form-control" id="address" name="address" placeholder="Enter Address" type="text" required>
                                </div>
                                <div class="text-left my-2">
                                    <b><label for="password">Password:</label></b>
                                    <input class="form-control" id="password" name="password" placeholder="Enter Password" type="password" required data-toggle="password" minlength="4" maxlength="21">
                                </div>
                                <div class="text-left my-2">
                                    <b><label for="password1">Renter Password:</label></b>
                                    <input class="form-control" id="cpassword" name="cpassword" placeholder="Renter Password" type="password" required data-toggle="password" minlength="4" maxlength="21">
                                </div>
                        
                            <div class="button-group">
                                <!--                                    
                                //TODO: onclick -> start retrieve student list and proceed mapping
                                -->
                                <a class="clickable-btn" onclick="confirm('Confirm For Mapping?')" href="index.php">Register</a>
                                <a class="clickable-btn" href="#">Reset All</a>
                            </div>
                            <hr>
                           
                            
                            <div class="update-group">
                                <!--                                    
                                //TODO: get all data from above and input into database
                                -->
                                <button class="clickable-btn" href="#">Update Mapping</button>
                            </div>
                        

                    
                        <!-- <div class="form-body">
                            <form method="post">
                                <p style="font-size:16px; color:red" align="center"></p>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Component Name</label>
                                    <input type="text" class="form-control" id="cmpname" name="cmpname" placeholder="Component Name" value="" required="true">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Component Level</label>
                                    <input type="text" id="cmplv" name="cmplv" class="form-control" placeholder="Component Level" value="" required="true">
                                </div>

                                <button type="submit" name="submit" class="btn btn-default ">Add</button>
                            </form>
                        </div> -->

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