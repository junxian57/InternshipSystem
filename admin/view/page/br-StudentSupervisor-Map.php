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
    <link rel="stylesheet" type="text/css" href="../../css/dataTables.bootstrap.css" />
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
                                <div class="form-group">
                                    <label for="supervisor">Search Supervisor <span class="required-star">*</span></label>
                                    <input type="search" class="form-control" id="tab1-supervisor" name="supervisor" placeholder="Enter Any Relevant Keyword...." required="true" onkeyup="displaySearchResult(this, this.id)" data-lectureid="" disabled>
                                    <div class="form-control result-box" id="result-box-1">                                   </div>
                                </div>

                                <span class="arrow-icon">&#129050</span>

                                <div class="form-group">
                                    <label for="internBatch-group">Internship Batch <span class="required-star">*</span></label>
                                    <select name="internBatch-group" id="internBatch-group" class="form-control" required="true" onchange="enableOther(document.getElementById('tab1-supervisor'), document.getElementById(this.id))">
                                        <option value="" selected disabled>Select Internship Batch</option>
                                        <?php
                                            foreach($getInternBatch as $batch){
                                                echo "<option value='".$batch['internshipBatchID']."'>".$batch['internshipBatchID']."</option>";
                                            }
                                        ?>
                                    </select>

                                    <label for="student-group" class="margin-top-20">Tutorial Group <span class="required-star">*</span></label>
                                    <select name="student-group" id="student-group" class="form-control" required="true" disabled onchange="changeStudentSlotNo()">
                                    </select>
                                </div>
                            </div>

                            <div class="button-group">
                                <!--                                    
                                //TODO: onclick -> start retrieve student list and proceed mapping
                                -->
                                <a class="clickable-btn" id="tab1-assign-btn" onclick="tab1MapTable()">Assign</a>
                                <input type="reset" class="clickable-btn" href="#" value="Reset Field" onclick="resetInput(document.getElementById('tab1-supervisor'), document.getElementById('internBatch-group'), document.getElementById('student-group'))">
                            </div>
                            <hr>
                            <div class="info-group">
                                <p>Supervisor Current Slot: <span id="tab1-supervisor-slot">0 / 0</span></p>
                                <span>|</span>
                                <p>Student Group Left Slot: <span id="tab1-student-slot">0 / 0</span></p>
                            </div>
                            <hr>
                            <div class="table-title">
                                <h4>Preview Table</h4>
                            </div>
                            <div>
                                <table class="table-view" id="tab1-top-table">
                                    <thead>
                                        <th>#</th>
                                        <th>Student ID</th>
                                        <th>Student Name</th>
                                        <th>Supervisor</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody id="tab1-preview-table">
                                         <tr>
                                            <td>1</td>
                                            <td>21WMR08523</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td>
                                                <button class="remove" onclick="deleteRow('tab1-top-table', this)">Remove</button>
                                            </td>
                                        </tr>
                                         <tr>
                                            <td>2</td>
                                            <td>21WMR08523</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><button class="remove">Remove</button></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>Bryson</td>
                                            <td>Pong Suk Fun</td>
                                            <td><a class="remove" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
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
                                <button class="grey-btn" id="tab1-update-btn" onclick="tab1UpdateMapDb()" disabled>Update Mapping</button>
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
                                    <select name="internBatch-group" id="tab2-internBatch-group" class="form-control" required="true" onchange="enableOther(document.getElementById('tab2-student'), document.getElementById(this.id))">
                                    <option value="" selected disabled>Select Internship Batch</option>
                                    <?php
                                            foreach($getInternBatch as $batch){
                                                echo "<option value='".$batch['internshipBatchID']."'>".$batch['internshipBatchID']."</option>";
                                            }
                                        ?>
                                    </select>
                                    
                                    <label for="student" class="margin-top-20">Search Student <span class="required-star">*</span></label>
                                    <input type="search" class="form-control" id="tab2-student" name="student" disabled placeholder="Enter Any Relevant Keyword...." required="true" onkeyup="displaySearchResult(this, this.id)">
                                    <div class="form-control result-box" id="result-box-2">

                                    </div>
                                </div>

                                <span class="arrow-icon">&#129050</span>
                                <div class="form-group">
                                    <label for="supervisor-select">Supervisor <span class="required-star">*</span></label>
                                    <select name="supervisor-select" id="tab2-supervisor-group" class="form-control" required="true" disabled>
                                      
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
                                <input type="reset" class="clickable-btn" value="Reset Field" onclick="resetInput(document.getElementById('tab2-student'), document.getElementById('tab2-internBatch-group'), document.getElementById('tab2-supervisor-group'))">
                            </div>
                            <hr>
                            <div class="table-title">
                                <h4>Preview Table</h4>
                            </div>
                            <div>
                                <table class="table-view">
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
                                <div class="form-group">
                                    <label for="internBatch-group">Internship Batch <span class="required-star">*</span></label>
                                    <select name="internBatch-group" id="tab3-internBatch-group" class="form-control" required="true" onchange="enableOther(document.getElementById('tab3-programme'), document.getElementById(this.id))">
                                    <option value="" selected disabled>Select Internship Batch</option>
                                    <?php
                                            foreach($getInternBatch as $batch){
                                                echo "<option value='".$batch['internshipBatchID']."'>".$batch['internshipBatchID']."</option>";
                                            }
                                        ?>
                                    </select>

                                </div>

                                <div class="form-group">
                                    <label for="programme">Search Programme <span class="required-star">*</span></label>
                                    <input type="search" class="form-control" id="tab3-programme" name="programme" placeholder="Enter Any Relevant Keyword...." required="true" onkeyup="displaySearchResult(this, this.id)" disabled>
                                    <div class="form-control result-box" id="result-box-3">
                                    </div>
                                </div>

                            </div>
                            <hr>
                            <div class="hint">
                                <p>Hint: Both Tables Below Are Scrollable </p>
                            </div>
                            <div class="checkbox-group">
                                <form id="supervisor-field">
                                    <fieldset>
                                        <legend>Supervisor Field - <span class="facAcronym-span">FOCS</span></legend>
                                        <div>
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Curr / Max</th>
                                                        <th>Checkbox</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="tab3-small-table" id="tab3-supervisor-table">
                                                    <tr>
                                                        <td>Hello</td>
                                                        <td>1 / 1</td>
                                                        <td><input type="checkbox" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Hello</td>
                                                        <td>1 / 1</td>
                                                        <td><input type="checkbox" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Hello</td>
                                                        <td>1 / 1</td>
                                                        <td><input type="checkbox" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Hello</td>
                                                        <td>1 / 1</td>
                                                        <td><input type="checkbox" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Hello</td>
                                                        <td>1 / 1</td>
                                                        <td><input type="checkbox" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Hello</td>
                                                        <td>1 / 1</td>
                                                        <td><input type="checkbox" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Hello</td>
                                                        <td>1 / 1</td>
                                                        <td><input type="checkbox" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Hello</td>
                                                        <td>1 / 1</td>
                                                        <td><input type="checkbox" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Hello</td>
                                                        <td>1 / 1</td>
                                                        <td><input type="checkbox" name="" id=""></td>
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
                                        <legend>Student Group Field - <span class="facAcronym-span">FOCS</span></legend>
                                        <!--Create a table with 3 column-->
                                        <div class="table-responsive">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Prog / Year / Tutorial</th>
                                                        <th>Left / Total</th>
                                                        <th>Checkbox</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="tab3-small-table" id="tab3-student-table2">
                                                   
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
                            <div class="tables">
                                <table class="table-view">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Student ID</th>
                                            <th>Faculty</th>
                                            <th>Student Name</th>
                                            <th>Supervisor</th>
                                            <th>Action</th>
                                        </tr>
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
        "searching": false,
        "bLengthChange": false,
        "info": false
        });         
    });
    
</script>
<script>
    document.getElementById("defaultOpen").click();

    function resetInput(valueInput, selectionInput1, selectionInput2 = null, deleteTable = false){
        valueInput.value = "";
        selectionInput1.selectedIndex = "0";
        const supervisorSlot = document.getElementById("tab1-supervisor-slot");
        const getStudentSlot = document.getElementById("tab1-student-slot");

        if(valueInput.id == "tab1-supervisor"){
            valueInput.disabled = true;
            selectionInput1.disabled = false;
            selectionInput2.disabled = true;
            removeAllChildNodes(selectionInput2);
            supervisorSlot.textContent = "0 / 0";
            getStudentSlot.textContent = "0 / 0";
            let assignBtn = document.getElementById("tab1-assign-btn");
            assignBtn.disabled = false;
            assignBtn.classList.remove("grey-btn");
            assignBtn.classList.add("clickable-btn");

            document.getElementById('tab1-supervisor').disabled = false;
            document.getElementById('student-group').disabled = false;

            let updateBtn = document.getElementById('tab1-update-btn');
            updateBtn.disabled = true;
            updateBtn.classList.remove('clickable-btn');
            updateBtn.classList.add('grey-btn')

        }else if(valueInput.id == "tab2-student"){
            valueInput.disabled = true;
            selectionInput1.disabled = false;
            selectionInput2.disabled = true;
            removeAllChildNodes(selectionInput2);
        }else if(valueInput.id == "tab3-programme"){
            valueInput.disabled = true;
            selectionInput1.disabled = false;
        }
        
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

    function enableOther(inputBox, typeBox){
        inputBox.disabled = false;
        typeBox.disabled = true;
    }

    //Search Result on Search Bar
    function inputSearchResult(tabID, resultBox) {
        const getSearchResultArr = document.getElementById(resultBox).childNodes;
        const getSearchBar = document.getElementById(tabID);
        const getResultBox = document.getElementById(resultBox);
        const supervisorSlot = document.getElementById("tab1-supervisor-slot");
        
        if (getSearchResultArr.length > 0) {
            for (let i = 0; i < getSearchResultArr.length; i++) {
                getSearchResultArr[i].addEventListener('click', (list) => {
                    getSearchBar.value = list.target.innerText;
                    getResultBox.style.display = 'none';

                    if(tabID == "tab1-supervisor"){
                        supervisorSlot.textContent = `${list.target.dataset.currno} / ${list.target.dataset.maxno}`;
                        getSearchBar.setAttribute("data-lectureid", list.target.dataset.lectureid);
                        tutorialGroupData(list.target.dataset.facultyid);
                    }else if(tabID == "tab2-student"){
                        tab2SupervisorGroupData(list.target.dataset.facultyid);
                    }else if(tabID == "tab3-programme"){
                        tab3InsertTable(list.target.dataset.facultyid, list.target.dataset.programmeid);
                    }
                    
                });
            }
        } else {
            return;
        }
    }

    //Tab 1 - Change Student Slot Number
    function changeStudentSlotNo(){
        let getStudent = document.getElementById("student-group");
        let getStudentSlot = document.getElementById("tab1-student-slot");
        let tutorialGroupArr = getStudent.childNodes;

        getStudentSlot.textContent = `${getStudent[getStudent.selectedIndex].dataset.noselectstudent} / ${getStudent[getStudent.selectedIndex].dataset.studentcount}`;
    }

    //Tab 1 Selection
    async function tutorialGroupData(facultyID) {
        const respondResult = await getTutorialGroupData(facultyID);
        const studentSelect = document.getElementById("student-group");
        const studentSlot = document.getElementById("tab1-student-slot");
        const defaultOption = document.createElement("option");

        if(studentSelect.hasChildNodes()){
            removeAllChildNodes(studentSelect);
        }

        if(respondResult !== "No Data Found"){
            studentSelect.disabled = false;
            for(let i = 0; i < respondResult.length; i++){
                const option = document.createElement("option");
                option.value = respondResult[i].tutorialGroupNo;
                option.setAttribute("data-noSelectStudent", respondResult[i].noSelectStudent);
                option.setAttribute("data-studentCount", respondResult[i].studentCount);
                option.setAttribute("data-tutorialGroupNo", respondResult[i].tutorialGroupNo);
                option.setAttribute("data-programmeID", respondResult[i].programmeID);

                option.innerText = `${respondResult[i].programmeAcronym} : Year ${respondResult[i].studentYear} Sem ${respondResult[i].studentSemester} Group ${respondResult[i].tutorialGroupNo}`;

                studentSelect.appendChild(option);
            }
            changeStudentSlotNo();
        }else{
            const option = document.createElement("option");
            option.value = "No Data";
            option.innerText = "No Data";
            studentSelect.appendChild(option);
            studentSelect.disabled = true;

            studentSlot.textContent = "0 / 0";

        }
    }

    //Tab 1 Selection - Fetch Tutorial Group Data
    async function getTutorialGroupData(facultyID){
        let internNo = document.getElementById("internBatch-group").value;
        let url = `../../app/DAL/ajaxMapSelectionGroup.php?facultyID=${facultyID}&internNo=${internNo}`;

        const response = await fetch(url);
        const data = await response.json();

        return data;
    }

    //Tab 2 Selection
    async function tab2SupervisorGroupData(facultyID){
        const respondResult = await getTab2SupervisorGroupData(facultyID);
        const supervisorSelect = document.getElementById("tab2-supervisor-group");

        if(supervisorSelect.hasChildNodes()){
            removeAllChildNodes(supervisorSelect);
        }

        if(respondResult !== "No Data Found"){
            supervisorSelect.disabled = false;
            for(let i = 0; i < respondResult.length; i++){
                const option = document.createElement("option");
                option.value = respondResult[i].lecturerID;

                option.innerText = `${respondResult[i].facAcronym} : ${respondResult[i].lecName} - ${respondResult[i].currNoOfStudents} / ${respondResult[i].maxNoOfStudents}`;

                supervisorSelect.appendChild(option);
            }
        }else{
            const option = document.createElement("option");
            option.value = "No Data";
            option.innerText = "No Data";
            supervisorSelect.appendChild(option);
            supervisorSelect.disabled = true;
        }
    }

    //Tab 2 Selection - Fetch Supervisor Data
    async function getTab2SupervisorGroupData(facultyID){
        let url = `../../app/DAL/ajaxMapSelectionGroup.php?facultyID=${facultyID}&tab2=true`;

        const response = await fetch(url);
        const data = await response.json();

        return data;
    }

    //Tab 3 Programme
    async function tab3InsertTable(facultyID, programmeID){
        const supervisorResult = await getTab3SupervisorTable(facultyID);
        const studentResult = await getTab3StudentTable(programmeID);
        const supervisorTable = document.getElementById("tab3-supervisor-table");
        const studentTable = document.getElementById("tab3-student-table2");
        const getSpan = document.getElementsByClassName("facAcronym-span");

        if(supervisorTable.hasChildNodes()){
            removeAllChildNodes(supervisorTable);
        }

        if(studentTable.hasChildNodes()){
            removeAllChildNodes(studentTable);
        }

        if(supervisorResult !== "No Data Found" && studentResult !== "No Data Found"){  
            //Change Faculty Acronym
            for(let k = 0; k < getSpan.length; k++){
                getSpan[k].innerText = supervisorResult[0].facAcronym;
            }

            //Insert Supervisor Table Row
            for(let i = 0; i < supervisorResult.length; i++){
                let trLeft = document.createElement("tr");
                trLeft.innerHTML = `
                    <td>${supervisorResult[i].lecName}</td>
                    <td>${supervisorResult[i].currNoOfStudents} / ${supervisorResult[i].maxNoOfStudents}</td>
                    <td>
                        <input type="checkbox" name="${supervisorResult[i].lecturerID}" class="tab-3-checkbox">
                    </td>
                `;
                supervisorTable.appendChild(trLeft);
            }

            //Insert Student Table Row
            for(let j = 0; j < studentResult.length; j++){
                let trRight = document.createElement("tr");
                trRight.innerHTML = `
                    <td>${studentResult[j].programmeAcronym} / ${studentResult[j].studentYear} / ${studentResult[j].tutorialGroupNo}</td>
                    <td>${studentResult[j].noSelectStudent} / ${studentResult[j].studentCount}</td>
                    <td>
                        <input type="checkbox" data-progAcronym="${studentResult[j].programmeAcronym}" data-tutorialGroup="${studentResult[j].tutorialGroupNo}" class="tab-3-checkbox">
                    </td>
                `;
                studentTable.appendChild(trRight);
            }
            
        }else{
            alert("No Data Found");
        }
    }

    //Tab 3 - Fetch Supervisor Data
    async function getTab3SupervisorTable(facultyID){
        let url = `../../app/DAL/ajaxMapSelectionGroup.php?facultyID=${facultyID}&tab3-supervisor=true`;

        const response = await fetch(url);
        const data = await response.json();

        return data;
    }

    //Tab 3 - Fetch Student Data
    async function getTab3StudentTable(programmeID){
        let batchID = document.getElementById("tab3-internBatch-group").value;
        let url = `../../app/DAL/ajaxMapSelectionGroup.php?programmeID=${programmeID}&batchID=${batchID}&tab3-student=true`;

        const response = await fetch(url);
        const data = await response.json();

        return data;
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

        if (respondResult == "No Data Found") {
            getResultBox.style.display = 'none';
            return;
        }

        if(getResultBox.hasChildNodes()){
            removeAllChildNodes(getResultBox);
        }

        if(respondResult != "No Data Found" ){
            if(tabID == 'tab1-supervisor'){
                for (let i = 0; i < respondResult.length; i++) {
                    resultArr.push(
                       `<li data-facultyid=${respondResult[i].facultyID} data-currNo=${respondResult[i].currNoOfStudents} data-maxNo=${respondResult[i].maxNoOfStudents} data-lectureid=${respondResult[i].lecturerID}>${respondResult[i].facAcronym} : ${respondResult[i].lecName}</li>`
                    );
                }
            }else if(tabID == 'tab2-student'){
                for (let i = 0; i < respondResult.length; i++) {
                    resultArr.push(
                        `<li data-facultyID=${respondResult[i].facultyID}>${respondResult[i].studentID} : ${respondResult[i].studName}</li>`
                    );
                }
            }else if(tabID == 'tab3-programme'){
                for (let i = 0; i < respondResult.length; i++) {
                    resultArr.push(
                        `<li data-programmeID=${respondResult[i].programmeID} data-facultyID=${respondResult[i].facultyID}> ${respondResult[i].facAcronym} : ${respondResult[i].programmeName.substr(12)}</li>` 
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
<script>
    function deleteRow(table, row) {
        let i = row.parentNode.parentNode.rowIndex;
        document.getElementById(table).deleteRow(i);
    }

    async function tab1MapTable(){
        let studentGroup = document.getElementById("student-group");
        let lectureID = document.getElementById("tab1-supervisor").getAttribute("data-lectureid");
        let internshipBatch = document.getElementById("internBatch-group").value;
        let tutorialGroupNo = studentGroup[studentGroup.selectedIndex].dataset.tutorialgroupno;
        let programmeID = studentGroup[studentGroup.selectedIndex].dataset.programmeid;
        let tab1previewBody = document.getElementById("tab1-preview-table");

        if(!studentGroup.hasChildNodes()){
            alert("No Tutorial Group Selected");
        }

        if(tab1previewBody.hasChildNodes()){
            removeAllChildNodes(tab1previewBody);
        }

        const respondResult = await getStudentLectureData(lectureID, internshipBatch, tutorialGroupNo, programmeID);

        //create table row and insert
        let resultArr = [];

        if(respondResult != "No Data Found"){
            for (let i = 0; i < respondResult.length; i++) {
                resultArr.push(
                    `<tr>
                        <td>${i + 1}</td>
                        <td>${respondResult[i].studentID}</td>
                        <td>${respondResult[i].studName}</td>
                        <td>${respondResult[i].lecName}</td>
                        <td><button class="remove" onclick="deleteRow('tab1-top-table', this)">Remove</button></td>
                    </tr>`
                );
            }
            tab1previewBody.innerHTML = resultArr.join('');

            let assignBtn = document.getElementById("tab1-assign-btn");
            assignBtn.disabled = true;
            assignBtn.classList.remove("clickable-btn");
            assignBtn.classList.add("grey-btn");

            document.getElementById('tab1-supervisor').disabled = true;
            document.getElementById('student-group').disabled = true;

            let updateBtn = document.getElementById('tab1-update-btn');
            updateBtn.disabled = false;
            updateBtn.classList.remove('grey-btn');
            updateBtn.classList.add('clickable-btn')
            
        }else{
            alert("No Data Found");
        }
        
    }

    async function getStudentLectureData(lectureID, internshipBatch, tutorialGroupNo, programmeID){
        let url = `../../app/DAL/ajaxMapTab1InsertTable.php?lectureID=${lectureID}&internshipBatch=${internshipBatch}&tutorialGroupNo=${tutorialGroupNo}&programmeID=${programmeID}&tab1-map=true`;

        const response = await fetch(url);
        const data = await response.json();

        return data;
    }

    async function tab1UpdateMapDb(){
        let confirm = window.confirm("Are you sure you want to update the map?");
        if(confirm == true){
            let lecturerID = document.getElementById("tab1-supervisor").getAttribute("data-lectureid");
            let studentIDArr = document.querySelectorAll("#tab1-preview-table tr td:nth-child(2)");
            let studentIDTextArr = [];

            //Get Student ID Text
            studentIDArr.forEach((studentID) => {
                studentIDTextArr.push(studentID.innerText);
            });

            let responseResult = await tab1FetchUpdateMapDb(lecturerID, studentIDTextArr);
            
            if(responseResult == "Success"){
                alert("Map Updated");
            }else{
                alert("Map Update Failed");
            }
        }else{
            return;
        }
    }

    async function tab1FetchUpdateMapDb(lecturerID, studentIDTextArr){
        let url = `../../app/DAL/ajaxMapTab1UpdateMap.php?lectureID=${lecturerID}&studentIDArr=${JSON.stringify(studentIDTextArr)}`;

        let response = await fetch(url);
        let data = await response.json();

        return data;
    }

</script>

</html>