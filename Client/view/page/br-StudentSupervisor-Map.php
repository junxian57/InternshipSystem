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
    <link rel="stylesheet" href="../../scss/studentSupervisorMap.css">
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
                    <h3 class="page-title">Student & Supervisor Mapping</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">

                        <!-- Tab Button -->
                        <div class="tab">
                            <button class="tablinks" onclick="changeTab(event, 'StudentToSupervisor')" id='defaultOpen'>Assign Students <span class="arrow-icon">&#129050</span> Supervisors</button>
                            <button class="tablinks" onclick="changeTab(event, 'SupervisorToStudent')">Assign Supervisors <span class="arrow-icon">&#129050</span> Students</button>
                            <button class="tablinks" onclick="changeTab(event, 'AutomatedMap')">Automated Mapping</button>
                        </div>

                        <!-- Tab Content 1-->
                        <div id="StudentToSupervisor" class="tabcontent">
                            <div class="search-group">
                                <!--                                    
                                //TODO: Require AJAX method to display searched supervisor         
                                -->
                                <div class="form-group">
                                    <label for="supervisor">Search Supervisor <span class="required-star">*</span></label>
                                    <input type="search" class="form-control" id="supervisor" name="supervisor" placeholder="Enter Any Relevant Keyword...." required="true">
                                    <div class="form-control result-box">
                                        <!--                                    
                                        //TODO: Javascript to display result box need to fix         
                                        -->
                                    </div>
                                </div>

                                <span class="arrow-icon">&#129050</span>

                                <!--                                    
                                //TODO: Require AJAX method to retrieve student group from the same faculty as lecturer        
                                -->
                                <div class="form-group">
                                    <label for="student-group">Student Group <span class="required-star">*</span></label>
                                    <select name="student-group" id="student-group" class="form-control" required="true">
                                        <option value="21WMR00000">Course: Year 3 Sem 1 Group 1</option>
                                        <option value="21WMR00000">Course: Year 3 Sem 1 Group 1</option>
                                        <option value="21WMR00000">Course: Year 3 Sem 1 Group 1</option>
                                        <option value="21WMR00000">Course: Year 3 Sem 1 Group 1</option>
                                    </select>
                                </div>
                            </div>
                            <div class="button-group">
                                <!--                                    
                                //TODO: onclick -> start retrieve student list and proceed mapping
                                -->
                                <a class="clickable-btn" onclick="confirm('Confirm For Mapping?')">Assign</a>
                                <a class="clickable-btn" href="#">Reset All</a>
                            </div>
                            <hr>
                            <div class="info-group">
                                <p style="border-right:1px solid grey;">Supervisor Available Slot: <span>24 / 24</span></p>
                                <p>Student Group Left Slot: <span>24 / 24</span></p>
                            </div>
                            <hr>
                            <div class="table-title">
                                <h4>Preview Table</h4>
                            </div>
                            <div class="table-responsive  orange-border">
                                <table>
                                    <thead>
                                        <th>#</th>
                                        <th>Student ID</th>
                                        <th>Faculty</th>
                                        <th>Student Name</th>
                                        <th>Supervisor</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <div class="update-group">
                                <!--                                    
                                //TODO: get all data from above and input into database
                                -->
                                <button class="clickable-btn" href="#">Update Mapping</button>
                            </div>
                        </div>

                        <!-- Tab Content 2-->
                        <div id="SupervisorToStudent" class="tabcontent">
                            <div class="search-group">
                                <!--                                    
                                //TODO: Require AJAX method to display searched student
                                -->
                                <div class="form-group">
                                    <label for="student">Search Student <span class="required-star">*</span></label>
                                    <input type="search" class="form-control" id="student" name="student" placeholder="Enter Any Relevant Keyword...." required="true">
                                    <div class="form-control result-box">
                                        <!--                                    
                                        //TODO: Javascript to display result box need to fix         
                                        -->
                                    </div>
                                </div>

                                <span class="arrow-icon">&#129050</span>

                                <!--                                    
                                //TODO: Require AJAX method to retrieve student group         
                                -->
                                <div class="form-group">
                                    <label for="supervisor-group">Supervisor Group <span class="required-star">*</span></label>
                                    <select name="supervisor-group" id="supervisor-group" class="form-control" required="true">
                                        <option value="21WMR00000">Supervisor ID: Supervisor 1 - 24 / 24</option>
                                        <option value="21WMR00000">Supervisor ID: Supervisor 1 - 24 / 24</option>
                                        <option value="21WMR00000">Supervisor ID: Supervisor 1 - 24 / 24</option>
                                        <option value="21WMR00000">Supervisor ID: Supervisor 1 - 24 / 24</option>
                                    </select>
                                </div>
                            </div>
                            <div class="button-group">
                                <!--                                    
                                //TODO: onclick -> start retrieve student list and proceed mapping
                                -->
                                <a class="clickable-btn" onclick="confirm('Confirm For Mapping?')">Assign</a>
                                <!-- 
                                //TODO: While click on Mapping, check whether it is already inside the preview table, if yes, then alert user...return false 
                                -->
                                <a class="clickable-btn" href="#">Reset All</a>
                            </div>
                            <hr>
                            <div class="table-title">
                                <h4>Preview Table</h4>
                            </div>
                            <div class="table-responsive  orange-border">
                                <table>
                                    <thead>
                                        <th>#</th>
                                        <th>Student ID</th>
                                        <th>Faculty</th>
                                        <th>Student Name</th>
                                        <th>Supervisor</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <div class="update-group">
                                <!--                                    
                                //TODO: get all data from above and input into database
                                -->
                                <button class="clickable-btn" href="#">Update Mapping</button>
                            </div>
                        </div>

                        <!-- Tab Content 3-->
                        <div id="AutomatedMap" class="tabcontent">
                            <div class="search-group">
                                <!--                                    
                                //TODO: Require AJAX method to display searched student
                                -->
                                <div class="form-group">
                                    <label for="student">Search Student <span class="required-star">*</span></label>
                                    <input type="search" class="form-control" id="student" name="student" placeholder="Enter Any Relevant Keyword...." required="true">
                                    <div class="form-control result-box">
                                        <!--                                    
                                        //TODO: Javascript to display result box need to fix         
                                        -->
                                    </div>
                                </div>

                                <span class="arrow-icon">&#129050</span>

                                <!--                                    
                                //TODO: Require AJAX method to retrieve student group         
                                -->
                                <div class="form-group">
                                    <label for="supervisor-group">Supervisor Group <span class="required-star">*</span></label>
                                    <select name="supervisor-group" id="supervisor-group" class="form-control" required="true">
                                        <option value="21WMR00000">Supervisor ID: Supervisor 1 - 24 / 24</option>
                                        <option value="21WMR00000">Supervisor ID: Supervisor 1 - 24 / 24</option>
                                        <option value="21WMR00000">Supervisor ID: Supervisor 1 - 24 / 24</option>
                                        <option value="21WMR00000">Supervisor ID: Supervisor 1 - 24 / 24</option>
                                    </select>
                                </div>
                            </div>
                            <div class="button-group">
                                <!--                                    
                                //TODO: onclick -> start retrieve student list and proceed mapping
                                -->
                                <a class="clickable-btn" onclick="confirm('Confirm For Mapping?')">Assign</a>
                                <!-- 
                                //TODO: While click on Mapping, check whether it is already inside the preview table, if yes, then alert user...return false 
                                -->
                                <a class="clickable-btn" href="#">Reset All</a>
                            </div>
                            <hr>
                            <div class="table-title">
                                <h4>Preview Table</h4>
                            </div>
                            <div class="table-responsive  orange-border">
                                <table>
                                    <thead>
                                        <th>#</th>
                                        <th>Student ID</th>
                                        <th>Faculty</th>
                                        <th>Student Name</th>
                                        <th>Supervisor</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <div class="update-group">
                                <!--                                    
                                //TODO: get all data from above and input into database
                                -->
                                <button class="clickable-btn" href="#">Update Mapping</button>
                            </div>
                        </div>
                    </div>
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