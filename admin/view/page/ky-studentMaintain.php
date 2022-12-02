<?php
session_start();
error_reporting(0);
include('../../includes/db_connection.php');
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
    <link rel="stylesheet" href="../../scss/ky-Maintain.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.co">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../css/dataTables.bootstrap.css" />
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once('../../includes/sidebar.php'); ?>
        <?php include_once('../../includes/header.php'); ?>
        <div id="page-wrapper">
            <div class="main-page">
                <div class="forms">
                    <h3 class="page-title">Student Maintenance</h3>
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
                                    $db = new DBController();
                                        
                                    $sql = "select * from Student"; 
                                    $result = $db->runQuery($sql);

                                    if(count($result) > 0){
                                         foreach ($result as $student) {

                                            $Id = $student['studentID'];
                                            $programme = $student['programmeID'];
                                            $lecturer = $student['lecturerID'];
                                            $internBatch = $student['internshipBatchID'];
                                            $username = $student['studName'];
                                            $gender = $student['studGender'];
                                            $email = $student['studEmail'];
                                            $phone = $student['studContactNumber'];
                                            $address = $student['studHomeAddress'];
                                            $dateJoined = $student['studDateJoined'];
                                            $applicationQuota = $student['studApplicationQuota'];
                                            $currentApplication = $student['studCurrentNoOfApp'];
                                            $status = $student['studAccountStatus'];
                                            $tutorial = $student['tutorialGroupNo'];
                                ?>

                                        <tr>
                                            <td><?php echo $Id ?></td>
                                            <td><?php echo $username ?></td>
                                            <td><?php echo $gender ?></td>
                                            <td><a href="mailto:<?php echo $email ?>">Email</td>
                                            <td><?php echo $phone ?></td>
                                            <td><?php echo $programme ?></td>
                                            <td><?php echo $status ?></td>
                                            <td>
                                                <div class="button-group">
                                                <button onclick="viewModal('<?php echo $Id ?>', '<?php echo $programme ?>', '<?php echo $lecturer ?>', '<?php echo $internBatch ?>', '<?php echo $username ?>', '<?php echo $gender ?>',  '<?php echo $email ?>', '<?php echo $phone ?>', '<?php echo $address ?>', '<?php echo $dateJoined ?>', '<?php echo $applicationQuota ?>', '<?php echo $currentApplication ?>' ,'<?php echo $status ?>' ,'<?php echo $tutorial ?>')"><i class="fa fa-eye" style ="color:red"></i></button>
                                                <button onclick="toModal('<?php echo $Id ?>', '<?php echo $programme ?>', '<?php echo $lecturer ?>', '<?php echo $internBatch ?>', '<?php echo $username ?>', '<?php echo $gender ?>',  '<?php echo $email ?>', '<?php echo $phone ?>', '<?php echo $address ?>', '<?php echo $dateJoined ?>', '<?php echo $applicationQuota ?>', '<?php echo $currentApplication ?>' , '<?php echo $status ?>' ,'<?php echo $tutorial ?>' )"><i class="uil uil-pen" style="color:#0298cf"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <?php                                                                           
                                        }
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
     

<!-- VIEW MODAL -->
    <div id="view-modal">
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
                    <div class="scroll-bg">
                        <div class="user-details">
            
                            <input type="hidden" placeholder="Enter your id" id="input_id2" required readonly>
                                
                            <div class="title">
                                <h2>Student Name & Contact</h2>
                            </div>
                            <div class="input-box">
                                <label>Student Name :</label>
                                <input type="text" placeholder="Enter your name" id="input_name2" required readonly>
                                <i class="uil uil-user-circle icon"></i>
                            </div>

                            <div class="pass-box">
                                <label>Gender :</label>
                                <input type="text" placeholder="Enter gender" id="input_gender2" required readonly>
                                <i class="uil uil-book-open icon"></i>
                            </div>
 
                            <div class="pass-box">
                                <label>Email :</label>
                                <input type="text" placeholder="Enter email" id="input_email2" required readonly>
                                <i class="uil uil-envelope icon"></i>
                            </div> 
                            
                            <div class="pass-box">
                                <label>Contact Number:</label>
                                <input type="text" placeholder="Enter contact number" id="input_phone2" required readonly>
                                <i class="uil uil-phone icon"></i>
                            </div>

                            <div class="pass-box">
                                <label>Date Jioned :</label>
                                <input type="text" id="input_dateJoined2" required readonly>
                                <i class='far fa-calendar-check icon'></i>
                            </div>

                            <label style="color:silver; margin-top: 10px;">____________________________________________________________________________________________</label>

                            <div class="title">
                                <h2>Address</h2>
                            </div>

                            <div class="input-box">
                                <label>Address :</label>
                                <input type="text" placeholder="Enter address" id="input_address2" required readonly>
                                <i class="uil uil-estate icon"></i>
                            </div>

                            <label style="color:silver; margin-top: 10px;">____________________________________________________________________________________________</label>

                            <div class="title">
                                <h2>Academic Details</h2>
                            </div>

                            <div class="pass-box">
                                <label>Programme ID :</label>
                                <input type="text" placeholder="Enter programme id" id="input_programme2" required readonly>
                                <i class="uil uil-graduation-cap icon"></i>
                            </div>

                            <div class="pass-box">
                                <label>Lecturer ID :</label>
                                <input type="text" placeholder="Enter lecturer id" id="input_lecturer2" required readonly>
                                <i class="uil uil-book-reader icon"></i>
                            </div>
                    
                            <div class="pass-box">
                                <label>Internship Batch ID :</label>
                                <input type="text" placeholder="Enter internship batch" id="input_internBatch2" required readonly>
                                <i class="uil uil-book-open icon"></i>
                            </div>

                            <div class="pass-box">
                                <label>Tutorial Group :</label>
                                <input type="text" placeholder="Enter tutorial group"  id="input_tutorial2" required readonly>
                                <i class='far fa-lightbulb icon'></i>
                            </div>

                            <div class="pass-box">
                                <label>Application Quota :</label>
                                <input type="text" placeholder="Enter programme" id="input_applicationQuota2" required readonly>
                                <i class="fa fa-address-card icon"></i>
                            </div>

                            <div class="pass-box">
                                <label>Current No Application :</label>
                                <input type="text" placeholder="Enter no application" id="input_currentApplication2" required readonly>
                                <i class="fa fa-address-card-o icon"></i>
                            </div>

                            <div class="pass-box">
                                <label>Account Status :</label>
                                <input type="text" placeholder="Enter account status" id="input_status2" required readonly>
                                <i class='far fa-lightbulb icon'></i>
                            </div>

                            <label style="color:silver; margin-top: 10px;">____________________________________________________________________________________________</label>

                        </div> 
                        </div>

                        <button id="close-modal" type="button" style="margin-left:200px;">Cancel</button>
                           
                    </form>
                </div>
            </div>
        </div>  
    </div>

<!-- EDIT MODAL -->
    <div id="login-modal">
        <div class="model">
            <div class="top-form">
                <h2>Edit Student Details</h2>
                <div class="close-modal">
                    &#10006;
                </div>  
            </div>
            <div class="login-form">
                <div class="content">
                    <form action="ky-updateStudent.php" method="POST">
                    <div class="scroll-bg">
                        <div class="user-details">
                        
                            <input type="hidden" placeholder="Enter your id" name="update_id" id="input_id" required readonly>
                               
                            <div class="title">
                                <h2>Student Name & Contact</h2>
                            </div>

                            <div class="input-box">
                                <label>Student Name :</label>
                                <input type="text" placeholder="Enter student name" name="studName" id="input_name" required>
                                <i class="uil uil-user-circle icon"></i>
                            </div>

                            <div class="pass-box">
                                <label>Gender :</label>
                                <input type="text" placeholder="Enter gender" name="gender" id="input_gender" required >
                                <i class="uil uil-book-open icon"></i>
                            </div>
 
                            <div class="pass-box">
                                <label>Email :</label>
                                <input type="text" placeholder="Enter email" name="email" id="input_email" required>
                                <i class="uil uil-envelope icon"></i>
                            </div> 
                            
                            <div class="pass-box">
                                <label>Contact Number:</label>
                                <input type="text" placeholder="Enter contact number" name="phone" id="input_phone" required>
                                <i class="uil uil-phone icon"></i>
                            </div>

                            <div class="pass-box">
                                <label>Date Jioned :</label>
                                <input type="text" name="dateJoined" id="input_dateJoined" required readonly>
                                <i class='far fa-calendar-check icon'></i>
                            </div>
                            <label style="color:silver; margin-top: 10px;">____________________________________________________________________________________________</label>

                            <div class="title">
                                <h2>Address</h2>
                            </div>

                            <div class="input-box">
                                <label>Address :</label>
                                <input type="text" placeholder="Enter address" name="address" id="input_address" required>
                                <i class="uil uil-estate icon"></i>
                            </div>

                            <label style="color:silver; margin-top: 10px;">____________________________________________________________________________________________</label>

                            <div class="title">
                                <h2>Academic Details</h2>
                            </div>

                            <div class="pass-box">
                                <label>Programme :</label>
                                <input type="text" placeholder="Enter programme" name="programme" id="input_programme" required>
                                <i class="uil uil-graduation-cap icon"></i>
                            </div>

                            <div class="pass-box">
                                <label>Lecturer ID :</label>
                                <input type="text" placeholder="Enter Lecturer ID" name="lecturer" id="input_lecturer" required>
                                <i class="uil uil-book-reader icon"></i>
                            </div>
                    
                            <div class="pass-box">
                                <label>Internship Batch ID :</label>
                                <input type="text" placeholder="Enter Internship Batch ID" name="internBatch" id="input_internBatch" required>
                                <i class="uil uil-book-open icon"></i>
                            </div>

                            <div class="pass-box">
                                <label>Tutorial Group :</label>
                                <input type="text" placeholder="Enter tutorial group" name="tutorial" id="input_tutorial" required>
                                <i class='far fa-lightbulb icon'></i>
                            </div>
                            
                            <div class="pass-box">
                                <label>Application Quota :</label>
                                <input type="text" placeholder="Enter Application Quota" name="appQuota" id="input_applicationQuota" required>
                                <i class="fa fa-address-card icon"></i>
                            </div>

                            <div class="pass-box">
                                <label>Current No Application :</label>
                                <input type="text" placeholder="Enter Current No Application"  name="currentApp" id="input_currentApplication" required>
                                <i class="fa fa-address-card-o icon"></i>
                            </div>

                            <div class="pass-box">
                                <label>Account Status :</label>
                                <input type="text" placeholder="Enter status" name="status" id="input_status" required>
                                <i class='far fa-lightbulb icon'></i>
                            </div>
                            
                            <!--<div class="input-box">
                                <input type="radio" name="gender" id="dot-1" <?php echo $gender =="Male"?
                                   "checked=checked":""?> />Male
                                <input type="radio" name="gender" id="dot-2" <?php echo $gender =="Female"?
                                   "checked=checked":""?> />Female
                               
                                
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
                            </div>-->

                        </div> 
                        </div>
                        
                        <button type = "submit" name="updatedata" style="margin-left:200px;">Update</button>
                            
                    </form>
                </div>
            </div>
        </div>  
    </div>

    <script type="text/javascript">
        function viewModal(Id ,programme ,lecturer ,internBatch ,username ,gender ,email ,phone ,address ,dateJoined ,applicationQuota ,currentApplication ,status, tutorial){
            
            $('#view-modal').fadeIn().css("display", "flex");

            input_id = document.getElementById('input_id2').value = Id;
            input_preogramme = document.getElementById('input_programme2').value = programme;
            input_lecturer = document.getElementById('input_lecturer2').value = lecturer;
            input_internBatch = document.getElementById('input_internBatch2').value = internBatch;
            input_name = document.getElementById('input_name2').value = username;
            input_gender = document.getElementById('input_gender2').value = gender;
            input_email = document.getElementById('input_email2').value = email;
            input_phone = document.getElementById('input_phone2').value = phone;
            input_address = document.getElementById('input_address2').value = address;
            input_dateJoined = document.getElementById('input_dateJoined2').value = dateJoined; 
            input_applicationQuota = document.getElementById('input_applicationQuota2').value = applicationQuota;
            input_currentApplication = document.getElementById('input_currentApplication2').value = currentApplication;
            input_status = document.getElementById('input_status2').value = status;
            input_tutorial = document.getElementById('input_tutorial2').value = tutorial;

            $('.close-modal').click(function(){
                $('#view-modal').fadeOut();
            });

            $('.close-modal').click(function(){
                $('#login-modal').fadeOut();
            });
        }
           
    </script>

    <script type="text/javascript">
        function toModal(Id ,programme ,lecturer ,internBatch ,username ,gender ,email ,phone ,address ,dateJoined ,applicationQuota ,currentApplication ,status, tutorial){
           
        $('#login-modal').fadeIn().css("display", "flex");
            input_id = document.getElementById('input_id').value = Id;
            input_preogramme = document.getElementById('input_programme').value = programme;
            input_lecturer = document.getElementById('input_lecturer').value = lecturer;
            input_internBatch = document.getElementById('input_internBatch').value = internBatch;
            input_name = document.getElementById('input_name').value = username;
            input_gender = document.getElementById('input_gender').value = gender;
            input_email = document.getElementById('input_email').value = email;
            input_phone = document.getElementById('input_phone').value = phone;
            input_address = document.getElementById('input_address').value = address;
            input_dateJoined = document.getElementById('input_dateJoined').value = dateJoined; 
            input_applicationQuota = document.getElementById('input_applicationQuota').value = applicationQuota;
            input_currentApplication = document.getElementById('input_currentApplication').value = currentApplication;
            input_status = document.getElementById('input_status').value = status;
            input_tutorial = document.getElementById('input_tutorial').value = tutorial;

            $('.close-modal').click(function(){
                $('#login-modal').fadeOut();
            });

            $('.close-modal').click(function(){
                $('#view-modal').fadeOut();
            });
        }
           
    </script>

    <script type="text/javascript">
        $(function(){
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
                $('#studName').val(data[1]);
                $('#gender').val(data[2]);
                $('#email').val(data[3]);
                $('#phone').val(data[4]);
                $('#programme').val(data[5]);
                $('#address').val(data[6]);
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
                $('#update_id2').val(data[0]);
                $('#studName2').val(data[1]);
                $('#gender2').val(data[2]);
                $('#email2').val(data[3]);
                $('#phone2').val(data[4]);
                $('#programme2').val(data[5]);
                $('#address2').val(data[6]);
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