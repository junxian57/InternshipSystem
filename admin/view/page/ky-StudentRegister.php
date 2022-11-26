<?php
session_start();
error_reporting(0);
include('../../includes/db_connection.php');
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
    <link rel="stylesheet" href="../../scss/ky-studentRegistration.css">
     <!-- ===== Iconscout CSS ===== -->
     <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>


    </style>
</head>

<body>
    
            <div class="container">
            
            <div class="cover">
                <img src="../../../admin/view/images/register.jpg" alt="">
                <div class="text">
                <span class="text-1">New user?</span>
                <span class="text-2">Register here.</span>
                
            </div>
            
            </div>
            <div class="main-page">
                <div class="forms">
                    <div class="content">
                        <form action="#">
                            <h3 class="page-title">Student Registration</h3>
                            <div class="user-details">
                                <div class="input-box">
                                    <input type="text" placeholder="Enter user name" required>
                                    <i class="uil uil-user icon"></i>
                                </div>

                                <div class="input-box">
                                    <input type="text" placeholder="Enter your name" required>
                                    <i class="uil uil-user-circle icon"></i>
                                </div>

                                <div class="input-box">
                                    <input type="text" placeholder="Enter your email" required>
                                    <i class="uil uil-envelope icon"></i>
                                </div>

                                <div class="input-box">
                                    <input type="text" placeholder="Enter your address" required>
                                    <i class="uil uil-estate icon"></i>
                                    
                                </div>
                                <div class="input-box">
                                    <input type="text" placeholder="Enter contact number" required>
                                    <i class="uil uil-phone icon"></i>
                                </div>
                                
                    
                                <div class="pass-box">
                                    <input type="password" class="password" placeholder="Create a password" required>
                                    <i class="uil uil-lock icon"></i>
                                </div>
                                <div class="pass-box">
                                    <input type="password" class="password" placeholder="Confirm a password" required>
                                    <i class="uil uil-lock icon"></i>
                                    <i class="uil uil-eye-slash showHidePw"></i>
                                </div>
                            

                                <div class="input-box">
                                    <select name="student-group" id="student-group" required="true">
                                        <option selected disabled>Choose Faculty</option>
                                        <option>FOCS</option>
                                        <option>FAFB</option>
                                        <option>FOET</option>
                                        <option>FOAS</option>
                                    </select>
                                    <i class="uil uil-graduation-cap icon"></i>
                                </div>

                                <div class="input-box">
                                    <select name="student-group" id="student-group" required="true">                             
                                        <option selected disabled>Choose Programme</option>    
                                        <option>REI</option>
                                        <option>RIS</option>
                                        <option>RIT</option>
                                        <option>RDS</option>
                                    </select>
                                    <i class="uil uil-book-open icon"></i>
                                </div>
                                
                                <div class="input-box">
                                    <input type="radio" name="gender" id="dot-1">
                                    <input type="radio" name="gender" id="dot-2">
                                    <input type="radio" name="gender" id="dot-3">
                                    
                                    <div class="category">
                                        <label>Gender</label>
                                        <i class="fa fa-venus-mars icon"></i>
                                        <label for="dot-1">
                                        <span class="dot one"></span>
                                        <span class="gender">Male</span>
                                        </label>
                                        <label for="dot-2">
                                            <span class="dot two"></span>
                                            <span class="gender">Female</span>
                                        </label>
                                        <label for="dot-3">
                                            <span class="dot three"></span>
                                            <span class="gender">Prefer not to say</span>
                                        </label>
                                        
                                    </div>
                                </div>
                            </div>

                            
                            <div class="checkbox-text">
                                <div class="checkbox-content">
                                    <input type="checkbox" id="termCon" required="true">
                                    <label for="termCon" class="text">I accepted all terms and conditions</label>
                                </div>
                            </div>
                            <div class="button">
                            <input type="submit" onclick="confirm('Confirm For Register?')" value="Register">
                            </div>
                            
                        </form>
                    </div>

                </div>
       
       
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