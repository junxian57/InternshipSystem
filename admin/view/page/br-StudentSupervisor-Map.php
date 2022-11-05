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

    try{
        $db = new DBController();
        $getInternBatch = $db->runQuery("SELECT * FROM InternshipBatch");
    }catch(Exception $e){
        echo '<script>alert("Database Connection Error")</script>';
    }
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
    <link rel="stylesheet" href="../../scss/br-studentSupervisorMap.css">
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
                                    <input type="search" class="form-control" id="tab1-supervisor" name="supervisor" placeholder="Enter Any Relevant Keyword...." required="true" onkeyup="displaySearchResult(this, this.id)">
                                    <div class="form-control result-box" id="result-box-1">
                                        <!--                                    
                                        //TODO: Javascript to display result box need to fix         
                                        -->
                                        <li>SSSS</li>
                                    </div>
                                </div>

                                <span class="arrow-icon">&#129050</span>

                                <!--                                    
                                //TODO: Select intern batch first only allow to select students group        
                                -->
                                <div class="form-group">
                                    <label for="internBatch-group">Internship Batch <span class="required-star">*</span></label>
                                    <select name="internBatch-group" id="internBatch-group" class="form-control" required="true">
                                        <?php
                                            foreach($getInternBatch as $batch){
                                                echo "<option value='".$batch['internshipBatchID']."'>".$batch['internshipBatchID']."</option>";
                                            }
                                        ?>
                                    </select>

                                    <!--                                    
                                    //TODO: Require AJAX method to retrieve student group from the same faculty as lecturer        
                                    -->
                                    <label for="student-group" class="margin-top-20">Student Group <span class="required-star">*</span></label>
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
                                <input type="reset" class="clickable-btn" href="#" value="Reset Field" onclick="resetInput(document.getElementById('supervisor'), document.getElementById('internBatch-group'), document.getElementById('student-group'))">
                            </div>
                            <hr>
                            <div class="info-group">
                                <p>Supervisor Available Slot: <span>24 / 24</span></p>
                                <span>|</span>
                                <p>Student Group Left Slot: <span>24 / 24</span></p>
                            </div>
                            <hr>
                            <div class="table-title">
                                <h4>Preview Table</h4>
                                <p>Hint: Table Below Is Scrollable</p>
                            </div>
                            <div class="orange-border">
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
                                //TODO: Select intern batch first only allow to select students group        
                                -->
                                <div class="form-group">
                                    <label for="internBatch-group">Internship Batch <span class="required-star">*</span></label>
                                    <select name="internBatch-group" id="tab2-internBatch-group" class="form-control" required="true">
                                    <?php
                                            foreach($getInternBatch as $batch){
                                                echo "<option value='".$batch['internshipBatchID']."'>".$batch['internshipBatchID']."</option>";
                                            }
                                        ?>
                                    </select>
                                    <!--                                    
                                //TODO: Require AJAX method to display searched student
                                -->
                                    <label for="student" class="margin-top-20">Search Student <span class="required-star">*</span></label>
                                    <input type="search" class="form-control" id="tab2-student" name="student" placeholder="Enter Any Relevant Keyword...." required="true" onkeyup="displaySearchResult(this, this.id)">
                                    <div class="form-control result-box" id="result-box-2">
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
                                    <label for="supervisor-select">Supervisor <span class="required-star">*</span></label>
                                    <select name="supervisor-select" id="tab2-supervisor-group" class="form-control" required="true">
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
                                <input type="reset" class="clickable-btn" href="#" value="Reset Field" onclick="resetInput(document.getElementById('tab2-student'), document.getElementById('tab2-internBatch-group'), document.getElementById('tab2-supervisor-group'))">
                            </div>
                            <hr>
                            <div class="table-title">
                                <h4>Preview Table</h4>
                                <p>Hint: Table Below Is Scrollable</p>
                            </div>
                            <div class="table-responsive orange-border">
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
                                    <label for="programme">Search Programme <span class="required-star">*</span></label>
                                    <input type="search" class="form-control" id="tab3-programme" name="programme" placeholder="Enter Any Relevant Keyword...." required="true" onkeyup="displaySearchResult(this, this.id)">
                                    <div class="form-control result-box" id="result-box-3">
                                        <!--                                    
                                        //TODO: Javascript to display result box need to fix         
                                        -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="internBatch-group">Internship Batch <span class="required-star">*</span></label>
                                    <select name="internBatch-group" id="tab3-internBatch-group" class="form-control" required="true">
                                    <?php
                                            foreach($getInternBatch as $batch){
                                                echo "<option value='".$batch['internshipBatchID']."'>".$batch['internshipBatchID']."</option>";
                                            }
                                        ?>
                                    </select>

                                </div>
                            </div>
                            <hr>
                            <div class="hint">
                                <p>Hint: All Tables Below Are Scrollable </p>
                            </div>
                            <div class="checkbox-group">
                                <form id="supervisor-field">
                                    <fieldset>
                                        <legend>Supervisor Field - <span>FOCS</span></legend>
                                        <div class="table-responsive">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Slot Available</th>
                                                        <th>Checkbox</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="tab3-small-table">
                                                    <tr>
                                                        <td>Pong Suk Fun</td>
                                                        <td>10 / 24</td>
                                                        <td><input type="checkbox" name="supervisorID-1" class="tab-3-checkbox"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Lai Joo Choi</td>
                                                        <td>20 / 24</td>
                                                        <td><input type="checkbox" name="supervisorID-2" class="tab-3-checkbox"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sarah</td>
                                                        <td>15 / 24</td>
                                                        <td><input type="checkbox" name="supervisorID-3" class="tab-3-checkbox"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sarah</td>
                                                        <td>15 / 24</td>
                                                        <td><input type="checkbox" name="supervisorID-3" class="tab-3-checkbox"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sarah</td>
                                                        <td>15 / 24</td>
                                                        <td><input type="checkbox" name="supervisorID-3" class="tab-3-checkbox"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sarah</td>
                                                        <td>15 / 24</td>
                                                        <td><input type="checkbox" name="supervisorID-3" class="tab-3-checkbox"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sarah</td>
                                                        <td>15 / 24</td>
                                                        <td><input type="checkbox" name="supervisorID-3" class="tab-3-checkbox"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sarah</td>
                                                        <td>15 / 24</td>
                                                        <td><input type="checkbox" name="supervisorID-3" class="tab-3-checkbox"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sarah</td>
                                                        <td>15 / 24</td>
                                                        <td><input type="checkbox" name="supervisorID-3" class="tab-3-checkbox"></td>
                                                    </tr>

                                                </tbody>

                                            </table>
                                        </div>
                                    </fieldset>
                                </form>

                                <span class="arrow-icon">&#129050</span>

                                <form id="student-field">
                                    <fieldset>
                                        <!--
                                           //!!!!! Query need to match internship batch
                                           //TODO: Remember the batch of internship
                                        -->
                                        <legend>Student Group Field - <span>FOCS</span></legend>
                                        <!--Create a table with 3 column-->
                                        <div class="table-responsive">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Year / Tutorial Group</th>
                                                        <th>Available Student</th>
                                                        <th>Checkbox</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="tab3-small-table">
                                                    <tr>
                                                        <td>3 / 1</td>
                                                        <td>24 / 24</td>
                                                        <td><input type="checkbox" name="supervisorID-1" class="tab-3-checkbox"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>3 / 1</td>
                                                        <td>24 / 24</td>
                                                        <td><input type="checkbox" name="supervisorID-2" class="tab-3-checkbox"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>3 / 1</td>
                                                        <td>24 / 24</td>
                                                        <td><input type="checkbox" name="supervisorID-3" class="tab-3-checkbox"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>3 / 1</td>
                                                        <td>24 / 24</td>
                                                        <td><input type="checkbox" name="supervisorID-3" class="tab-3-checkbox"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </fieldset>
                                </form>

                            </div>
                            <div class="button-group">
                                <!--                                    
                                //TODO: onclick -> start retrieve student list and proceed mapping
                                -->
                                <a class="clickable-btn" onclick="confirm('Confirm For Mapping?')">Assign</a>
                                <!-- 
                                //TODO: While click on Mapping, check whether it is already inside the preview table, if yes, then alert user...return false 
                                -->
                                <input type="reset" class="clickable-btn" href="#" value="Reset Field" onclick="resetInput(document.getElementById('tab3-programme'), document.getElementById('tab3-internBatch-group'), null, true)">
                            </div>
                            <hr>
                            <div class="table-title">
                                <h4>Preview Table</h4>
                            </div>
                            <div class="table-responsive orange-border">
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

    function resetInput(valueInput, selectionInput1, selectionInput2 = null, deleteTable = false){
        valueInput.value = "";
        selectionInput1.selectedIndex = "0";
        
        if(selectionInput2 != null){
            selectionInput2.selectedIndex = "0";
        }

        if(deleteTable){
           const tableArr = document.getElementsByClassName("tab3-small-table");
              for(let i = 0; i < tableArr.length; i++){
                removeAllChildNodes(tableArr[i]);
              }
        }
    }

    function changeTab(evt, tabName) {
        let i, tabcontent, tablinks;

        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.querySelectorAll(".tabcontent");
        tabcontent.forEach(i => {
            i.style.display = "none";
        });

        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.querySelectorAll(".tablinks");
        tablinks.forEach(i => {
            i.classList.remove("active");
        });

        // Show the current tab, and add an "active" class to the button that opened the tab
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>
<script>

    //Hide the Search Box
    document.querySelector('body').addEventListener('click', () => {
        const getResultBox = document.querySelectorAll('.result-box');
        getResultBox.forEach(i => {
            i.style.display = "none";          
        });
    });

      //Search Result on Search Bar
      function inputSearchResult(tabID, resultBox) {
        const getSearchResultArr = document.getElementById(resultBox).childNodes;
        const getSearchBar = document.getElementById(tabID);
        const getResultBox = document.getElementById(resultBox);

        if (getSearchResultArr.length > 0) {
            for (let i = 0; i < getSearchResultArr.length; i++) {
                getSearchResultArr[i].addEventListener('click', (list) => {
                    getSearchBar.value = list.target.innerText;
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

    async function displaySearchResult(searchBarTab, tabID) {
        
        if(tabID == 'tab1-supervisor'){
            resultBoxNo = "result-box-1";
        }else if(tabID == 'tab2-student'){
            resultBoxNo = "result-box-2";
        }else if(tabID == 'tab3-programme'){
            resultBoxNo = "result-box-3";
        }

        const getResultBox = document.getElementById(resultBoxNo);
        const respondResult = await searchBarData(searchBarTab, tabID);
        let resultArr = [];

        if (respondResult === null || respondResult === undefined || respondResult.length == 0) {
            getResultBox.style.display = 'none';
            return;
        }

        if(getResultBox.hasChildNodes()){
            removeAllChildNodes(getResultBox);
        }

        if (respondResult !== null || respondResult !== undefined || respondResult.length != 0) {
            if(tabID == 'tab1-supervisor'){
                for (let i = 0; i < respondResult.length; i++) {
                    resultArr.push(
                       `<li>${respondResult[i].lecturerID} : ${respondResult[i].lecName}</li>` 
                    );
                }
            }else if(tabID == 'tab2-student'){
                for (let i = 0; i < respondResult.length; i++) {
                    resultArr.push(
                        `<li>${respondResult[i].studentID} : ${respondResult[i].studName}</li>` 
                    );
                }
            }else if(tabID == 'tab3-programme'){
                for (let i = 0; i < respondResult.length; i++) {
                    resultArr.push(
                        `<li>${respondResult[i].programmeID} : ${respondResult[i].programmeName.substr(12)}</li>` 
                        );
                }
            }
        } else {
           getResultBox.style.display = 'none';
           return;
        }

        getResultBox.style.display = 'block';
        getResultBox.innerHTML = resultArr.join('');
       inputSearchResult(tabID, resultBoxNo);
    }

    async function searchBarData(searchBarTab, tabID) {
        const getSearchInput = searchBarTab.value;
        let resultBoxNo, url, internBatch;

        if(tabID == 'tab1-supervisor'){
            resultBoxNo = "result-box-1";
        }else if(tabID == 'tab2-student'){
            resultBoxNo = "result-box-2";
            internBatch = document.getElementById('tab2-internBatch-group').value;
        }else if(tabID == 'tab3-programme'){
            resultBoxNo = "result-box-3";
        }

        const getResultBox = document.getElementById(resultBoxNo);
        
        if (getSearchInput == '') {
            getResultBox.style.display = 'none';
            return;
        } else {
            if (tabID == 'tab1-supervisor') {
                url = '../../app/DAL/ajaxMapSearchBar.php?supervisor=' + getSearchInput;
            } else if (tabID == 'tab2-student') {
                url = `../../app/DAL/ajaxMapSearchBar.php?student=${getSearchInput}&internBatch=${internBatch}`;
            } else if (tabID == 'tab3-programme') {
                url = '../../app/DAL/ajaxMapSearchBar.php?programme=' + getSearchInput;
            } 

            const response = await fetch(url);
            const data = await response.json();

            return data;
        }
    }
</script>


</html>