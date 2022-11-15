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
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
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
    <link rel="stylesheet" href="../../scss/ky-invite.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.co">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../css/dataTables.bootstrap.css" />

</head>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once('../../includes/sidebar.php'); ?>
        <?php include_once('../../includes/header.php'); ?>
        <div id="page-wrapper">
            <div class="main-page">
                <div class="forms">
                    <h3 class="page-title">Student Invitation</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                        <!-- Tab Content 1-->
                        <div id="StudentToSupervisor" class="tabcontent">
                            
                            <div class="table-responsive black-border">
                            <div class="table_section">
                            <table  class="table-view" id="myTable">
                            <thead>
                                <tr>
                                <th>User Id</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Programme</th> 
                                <th>Address</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                    <?php
                                    
                                        $server = "localhost";
                                        $username = "root";
                                        $password = "";
                                        $database = "westorn";

                                        $conn = mysqli_connect($server, $username, $password, $database);
                                        if (!$conn){
                                            die("Error". mysqli_connect_error());
                                        }

                                        $sql = "select * from student"; 
                                        $result = mysqli_query($conn, $sql);
                                        
                                        while($row=mysqli_fetch_assoc($result)) {
                                            $Id = $row['studentID'];
                                            $username = $row['studName'];
                                            $gender = $row['studGender'];
                                            $email = $row['studEmail'];
                                            $phone = $row['studContactNumber'];
                                            $programme = $row['programmeID'];
                                            $address = $row['studHomeAddress'];
                                        
                                            echo '<tr>
                                                <td>' .$Id. '</td>
                                                <td>' .$username. '</td>
                                                <td>' .$gender. '</td>
                                                <td>' .$email. '</td>
                                                <td>' .$phone. '</td>
                                                <td>' .$programme. '</td>
                                                <td>' .$address. '</td>
                                                <td>
                                                <form action="ky-send.php" method="post">
                                                <input type="hidden" name="email" id="email" value="'.$email.'">
                                                <input type="hidden" name="username" id="username" value="'.$username.'">
                                                <input type="hidden" name="id" id="id" value="'.$Id.'">
                                                    <div class="button">
                                                        <input type="submit" name="submit" value="Invite">
                                                    </div>
                                                </form>
                                                    
                                                </td>
                                            </tr>';
                                        }
                                    ?>
                                    
                            </tbody>
                        </table>
                    </div>
                                
                 </div>
            </div>
        </div>
        <footer><?php include_once('../../includes/footer.php'); ?></footer>   
</body>

    <div id="login-modal">
        <div class="model">
            <div class="top-form">
                <h2>Student Details</h2>
                <div class="close-modal">
                    &#10006;
                </div>  
            </div>
            <div class="login-form">
                <div class="content">
                    <form action="">
                        <div class="user-details">
                            
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
                                <select name="student-group" id="student-group" required="true">
                                    <option selected disabled>Choose Faculty</option>
                                    <option>FOCS</option>
                                    <option>FAFB</option>
                                    <option>FOET</option>
                                    <option>FOAS</option>
                                </select>
                                <i class="uil uil-graduation-cap icon"></i>
                            </div>

                            <div class="pass-box">
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
                                    <label>Gender :</label>
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

                            <div class="input-box">
                                <input type="radio" name="status" id="dot-4">
                                <input type="radio" name="status" id="dot-5">
                                <input type="radio" name="status" id="dot-6">
                                <div class="category">
                                    <label>Account Status :</label>
                                    <i class="fa fa-venus-mars icon"></i>
                                    <label for="dot-4">
                                    <span class="dot four"></span>
                                    <span class="status">Withdraw</span>
                                    </label>
                                    <label for="dot-5">
                                        <span class="dot five"></span>
                                        <span class="status">Active</span>
                                    </label>
                                    <label for="dot-6">
                                        <span class="dot six"></span>
                                        <span class="status">Deactive</span>
                                    </label>
                                    
                                </div>
                            </div>

                            <button type = "button" class="submit-btn">Update</button>
                            <button type = "button" class="submit-btn">Cancel</button>
                        </div> 
                    </form>
                </div>
            </div>
        </div>  
    </div>

    
    <script type="text/javascript">
        $(function(){
            $('#login-show').click(function(){
                $('#login-modal').fadeIn().css("display", "flex");
            });
        
            $('.close-modal').click(function(){
                $('#login-modal').fadeOut();
            });
        });
    </script>

<script src="../../js/classie.js"></script>
<script src="../../js/bootstrap.js"> </script>
<script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../../js/dataTables.bootstrap.min.js"></script>
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

    $(document).ready(function() {
        $('.table-view').DataTable({
        "bLengthChange": false,
        "info": false
        });         
    });
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