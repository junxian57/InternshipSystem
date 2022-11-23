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
    <link rel="stylesheet" href="../../scss/ky-maintain.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.co">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/dataTables.bootstrap.css" />
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

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
                            <!-- <div class="table-title">
                                <input type="search" id="keyInput" onkeyup="searchInTable()" placeholder="Enter Keyword of Company Name...">
                                <p>Hint: Table Below Is Scrollable</p>
                            </div> -->
                            <div class="table-responsive black-border">
                            <div class="table_section">
                            <table class="table-view" id="myTable">
                            <thead>
                                <tr>
                                <th>Company Id</th>
                                <th>Company Name</th>
                                <th>Email</th>
                                <th>Contact No</th>
                                <th>Address</th>
                                <th>Field Area</th>
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

                                    $sql = "select * from company"; 
                                    $result = mysqli_query($conn, $sql);
                                    
                                    while($row=mysqli_fetch_assoc($result)) {
                                        $Id = $row['companyID'];
                                        $name = $row['cmpName'];
                                        $email = $row['cmpEmail'];
                                        $phone = $row['cmpContactNumber'];
                                        $cmpUsername = $row['cmpUsername'];
                                        $size = $row['cmpCompanySize'];
                                        $address = $row['cmpAddress'];
                                        $fieldArea = $row['cmpFieldsArea'];
                                        $cmpInternshipPlacement = $row['cmpNumberOfInternshipPlacements'];
                                        $allowance = $row['cmpAverageAllowanceGiven'];
                                        $dateJoined = $row['cmpDateJoined'];
                                        $status = $row['cmpAccountStatus'];
                                        $rating= $row['cmpRating'];
                                        
                                ?>
                                    
                                        <tr>
                                    
                                            <td><?php echo $Id ?></td>
                                            <td><?php echo $name ?></td>
                                            <td><?php echo $email?></td>
                                            <td><?php echo $phone ?></td>
                                            <td><?php echo $address?></td> 
                                            <td><?php echo $fieldArea?></td> 
                                
                                            <td>
                                                <div class="button-group">
                                                  
                                                    <button onclick="viewModal('<?php echo $Id ?>', '<?php echo $name ?>', '<?php echo $email ?>', '<?php echo $phone ?>', '<?php echo $cmpUsername ?>', '<?php echo $size ?>',  '<?php echo $address ?>', '<?php echo $fieldArea ?>', '<?php echo $cmpInternshipPlacement ?>', '<?php echo $allowance ?>', '<?php echo $dateJoined ?>', '<?php echo $status ?>' ,'<?php echo $rating ?>')"><i class="fa fa-eye" style ="color:red"></i></button>
                                                    <button onclick="toModal('<?php echo $Id ?>', '<?php echo $name ?>', '<?php echo $email ?>', '<?php echo $phone ?>', '<?php echo $cmpUsername ?>', '<?php echo $size ?>',  '<?php echo $address ?>', '<?php echo $fieldArea ?>', '<?php echo $cmpInternshipPlacement ?>', '<?php echo $allowance ?>', '<?php echo $dateJoined ?>', '<?php echo $status ?>' )"><i class="uil uil-pen" style="color:#0298cf"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                        
                                        
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


    <!-- EDIT MODAL -->
    <div id="login-modal">
        <div class="model">
            <div class="top-form">
                <h2>Edit Company Details</h2>
                <div class="close-modal">
                    &#10006;
                </div>  
            </div>
            <div class="login-form">
                <div class="content">

                    <form action="ky-updateCompany.php" method="POST">
                        <div class="user-details">
        
                            <div class="pass-box">
                                <label>Company ID :</label>
                                <input type="text" placeholder="Enter your id" name="update_id" id="input_id" required readonly>
                                <i class="uil uil-user icon"></i>
                            </div>

                            <div class="pass-box">
                                <label>Company Name :</label>
                                <input type="text" placeholder="Enter your name" name="cmpName" id="input_name" required>
                                <i class="uil uil-user-circle icon"></i>
                            </div>
                            
                            <div class="pass-box">
                                <label>Email :</label>
                                <input type="text" placeholder="Enter programme" name="email" id="input_email" required>
                                <i class="uil uil-envelope icon"></i>
                            </div>

                            <div class="pass-box">
                                <label>Contact No :</label>
                                <input type="text" placeholder="Enter programme" name="ContactNo" id="input_phone" required>
                                <i class="uil uil-phone icon"></i>
                            </div>

                            <div class="input-box">
                                <label>Address :</label>
                                <input type="text" placeholder="Enter programme" name="cmpAddress" id="input_address" required>
                                <i class="uil uil-estate icon"></i>
                            </div>

                            <div class="pass-box">
                                <label>Company Internship Placement :</label>
                                <input type="text" placeholder="Enter programme" name="cmpPlacement" id="input_placement" required >
                                <i class="uil uil-book-open icon"></i>
                            </div>

                            <div class="pass-box">
                                <label>Company User Name :</label>
                                <input type="text" placeholder="Enter your address" name="cmpUserName" id="input_username" required>
                                <i class="uil uil-chat-bubble-user icon"></i>
                            </div>
                            
                            <div class="pass-box">
                                <label>Company Size :</label>
                                <input type="text" placeholder="Enter your email" name="cmpSize" id="input_size" required>
                                <i class='far fa-building icon'></i>
                            </div>

                            <div class="pass-box">
                                <label>Company Fields Area:</label>
                                <input type="text" placeholder="Enter contact number" name="cmpFields" id="input_field" required>
                                <i class='fas fa-briefcase icon'></i>
                            </div>

                            <div class="pass-box">
                                <label>Company Average Allowance :</label>
                                <input type="text" placeholder="Enter programme" name="allowance" id="input_allowance" required>
                                <i class="uil uil-usd-circle icon"></i>
                            </div>

                            <div class="pass-box">
                                <label>Date Jioned :</label>
                                <input type="text" placeholder="Enter programme" name ="dateJoined" id="input_dateJoined" required>
                                <i class='far fa-calendar-check icon'></i>
                            </div>

                            <div class="pass-box">
                                <label>Account Status :</label>
                                <input type="text" name="status" id="input_status" required>
                                <i class='far fa-lightbulb icon'></i>
                            </div>

                            <button type = "submit" name="updatedata" class="submit-btn">Update</button>
                            
                        </div> 
                    </form>
                    
                </div>
            </div>
        </div>  
    </div>

<!-- VIEW MODAL -->
    <div id="view-modal">
        <div class="model">
            <div class="top-form">
                <h2>Company Details</h2>
                <div class="close-modal">
                    &#10006;
                </div>  
            </div>
            <div class="login-form">
                <div class="content">
                    <form action="">
                        <div class="user-details">
                            
                        <div class="pass-box">
                                <label>Company ID :</label>
                                <input type="text" placeholder="Enter your id" name="update_id" id="input_id2" required readonly>
                                <i class="uil uil-user icon"></i>
                            </div>

                            <div class="pass-box">
                                <label>Company Name :</label>
                                <input type="text" placeholder="Enter your name" name="cmpName" id="input_name2" required readonly>
                                <i class="uil uil-user-circle icon"></i>
                            </div>
                            
                            <div class="pass-box">
                                <label>Email :</label>
                                <input type="text" placeholder="Enter programme" name="email" id="input_email2" required readonly>
                                <i class="uil uil-envelope icon"></i>
                            </div>

                            <div class="pass-box">
                                <label>Contact No :</label>
                                <input type="text" placeholder="Enter programme" name="ContactNo" id="input_phone2" required readonly>
                                <i class="uil uil-phone icon"></i>
                            </div>

                            <div class="input-box">
                                <label>Address :</label>
                                <input type="text" placeholder="Enter programme" name="cmpAddress" id="input_address2" required readonly>
                                <i class="uil uil-estate icon"></i>
                            </div>

                            <div class="pass-box">
                                <label>Company Internship Placement :</label>
                                <input type="text" placeholder="Enter programme" name="cmpPlacement" id="input_placement2" required readonly>
                                <i class="uil uil-book-open icon"></i>
                            </div>

                            <div class="pass-box">
                                <label>Company User Name :</label>
                                <input type="text" placeholder="Enter your address" name="cmpUserName" id="input_username2" required readonly>
                                <i class="uil uil-chat-bubble-user icon"></i>
                            </div>
                            
                            <div class="pass-box">
                                <label>Company Size :</label>
                                <input type="text" placeholder="Enter your email" name="cmpSize" id="input_size2" required readonly>
                                <i class='far fa-building icon'></i>
                            </div>

                            <div class="pass-box">
                                <label>Company Fields Area:</label>
                                <input type="text" placeholder="Enter contact number" name="cmpFields" id="input_field2" required readonly>
                                <i class='fas fa-briefcase icon'></i>
                            </div>

                            <div class="pass-box">
                                <label>Company Average Allowance :</label>
                                <input type="text" placeholder="Enter programme" name="allowance" id="input_allowance2" required readonly>
                                <i class="uil uil-usd-circle icon"></i>
                            </div>

                            <div class="pass-box">
                                <label>Date Jioned :</label>
                                <input type="text" placeholder="Enter programme" name ="dateJoined" id="input_dateJoined2" required readonly>
                                <i class='far fa-calendar-check icon'></i>
                            </div>

                            <div class="pass-box">
                                <label>Account Status :</label>
                                <input type="text" name="status" id="input_status2" required readonly>
                                <i class='far fa-lightbulb icon'></i>
                            </div>

                            <div class="pass-box">
                                <label> Company Rating :</label>
                                <input type="text" name="rating" id="input_rating2" required readonly>
                                <i class="uil uil-star icon"></i>
                            </div>

                            <button id="close-modal" type="button" class="submit-btn">Cancel</button>
                           
                        </div> 
                    </form>
                </div>
            </div>
        </div>  
    </div>

    <script type="text/javascript">
        function toModal(Id, name, email , phone , cmpUsername , size , address , fieldArea , cmpInternshipPlacement , allowance, dateJoined, status){
           
        $('#login-modal').fadeIn().css("display", "flex");
            input_id = document.getElementById('input_id').value = Id;
            input_name = document.getElementById('input_name').value = name;
            input_email = document.getElementById('input_email').value = email;
            input_phone = document.getElementById('input_phone').value = phone;
            input_username = document.getElementById('input_username').value = cmpUsername;
            input_size = document.getElementById('input_size').value = size;
            input_address = document.getElementById('input_address').value = address;
            input_field = document.getElementById('input_field').value = fieldArea;
            input_placement = document.getElementById('input_placement').value = cmpInternshipPlacement;
            input_allowance = document.getElementById('input_allowance').value = allowance;
            input_dateJoined = document.getElementById('input_dateJoined').value = dateJoined;
            input_status = document.getElementById('input_status').value = status;
            

            $('.close-modal').click(function(){
                $('#login-modal').fadeOut();
            });

            $('.close-modal').click(function(){
                $('#view-modal').fadeOut();
            });
        }
           
    </script>

    <script type="text/javascript">
        function viewModal(Id, name, email , phone , cmpUsername , size , address , fieldArea , cmpInternshipPlacement , allowance, dateJoined, status, rating){
           
        $('#view-modal').fadeIn().css("display", "flex");
            input_id = document.getElementById('input_id2').value = Id;
            input_name = document.getElementById('input_name2').value = name;
            input_email = document.getElementById('input_email2').value = email;
            input_phone = document.getElementById('input_phone2').value = phone;
            input_username = document.getElementById('input_username2').value = cmpUsername;
            input_size = document.getElementById('input_size2').value = size;
            input_address = document.getElementById('input_address2').value = address;
            input_field = document.getElementById('input_field2').value = fieldArea;
            input_placement = document.getElementById('input_placement2').value = cmpInternshipPlacement;
            input_allowance = document.getElementById('input_allowance2').value = allowance;
            input_dateJoined = document.getElementById('input_dateJoined2').value = dateJoined;
            input_status = document.getElementById('input_status2').value = status;
            input_rating = document.getElementById('input_rating2').value = rating;

            $('.close-modal').click(function(){
                $('#view-modal').fadeOut();
            });

            $('.close-modal').click(function(){
                $('#login-modal').fadeOut();
            });
        }
           
    </script>


    <script type="text/javascript">
        $(function(){

            $('.close-modal').click(function(){
                $('#view-modal').fadeOut();
            });

            $('#close-modal').click(function(){
                $('#view-modal').fadeOut();
            });

            $('.close-modal').click(function(){
                $('#login-modal').fadeOut();
            });

            $('#close-modal').click(function(){
                $('#login-modal').fadeOut();
            });
        });
    </script>

<script>
        $(document).ready(function(){
            $('.editbtn').on('click', function () {
                $('#login-modal').fadeIn().css("display", "flex");
                $tr=$(this).closest('tr');
                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();

                console.log(data);
                $('#update_id').val(data[0]);
                $('#cmpName').val(data[1]);
                $('#email').val(data[2]);
                $('#ContactNo').val(data[3]);
                $('#cmpAddress').val(data[4]);
                $('#cmpInternPlacement').val(data[5]);
                $('#cmpAccountStatus').val(data[6]);
                $('#cmpRejectReason').val(data[7]);
                $('#cmpUserName').val(data[8]);
                $('#cmpSize').val(data[10]);
                $('#cmpFields').val(data[11]);
            });
        
        });
    </script>

<script>
        $(document).ready(function(){
            $('.viewbtn').on('click', function () {
                $('#view-modal').fadeIn().css("display", "flex");
                $tr=$(this).closest('tr');
                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();

                console.log(data);
               
            });

            $('.close-modal').click(function(){
                $('#view-modal').fadeOut();
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