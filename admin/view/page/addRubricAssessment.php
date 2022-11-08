<?php
session_start();
error_reporting(0);
include('includes/db_connection.php');
require_once('../../app/BLL/rubricAssessmentBLL.php');
require_once("../../app/DTO/rubricAssessmentDTO.php");
require_once("../../app/DAL/rubricAssessmentDAL.php");
$rubricAssessmentDALObj  = new rubricAssessmentDAL();
/*if (strlen($_SESSION['bpmsaid'] == 0)) {
	header('location:logout.php');
} else {

	}*/
if (isset($_POST['SubmitButton']) && $_POST['SubmitButton'] == 'Add rubric assessment') {

    $rubricAssmtBllObj = new rubricAssessmentBLL();
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $date = date('Y-m-d');
    $assessmentID = $_POST['assessmentID'];
    $internshipBatchID = $_POST['internshipBatchID'];
    $Title = $_POST['Title'];
    $Instructions = $_POST['Instructions'];
    $TotalWeight = $_POST['TotalWeight'];
    $RoleForMark = $_POST['RoleForMark'];
    $CreateByID = $_POST['CreateByID'];
    $CreateDate = $date;
    $newRubricAssmt = new rubricAssessmentDTO($assessmentID, $internshipBatchID, $Title, $Instructions, $TotalWeight, $RoleForMark, $CreateByID, $CreateDate);
    $rubricAssmtBllObj->AddRubricAssmt($newRubricAssmt);
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
    <!-- Bootstrap Core CSS -->
    <link href="../../css/bootstrap.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="../../css/style.css" rel='stylesheet' type='text/css' />
    <!-- font CSS -->
    <!-- font-awesome icons -->
    <link href="../../css/font-awesome.css" rel="stylesheet">
    <!-- //font-awesome icons -->
    <!-- js-->
    <script src="../../js/jquery-1.11.1.min.js"></script>
    <script src="../../js/modernizr.custom.js"></script>
    <!--webfonts-->
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <!--//webfonts-->
    <!--animate-->
    <link href="../../css/animate.css" rel="stylesheet" type="text/css" media="all">
    <script src="../../js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <!--//end-animate-->
    <!-- Metis Menu -->
    <script src="../../js/metisMenu.min.js"></script>
    <script src="../../js/custom.js"></script>
    <link href="../../css/custom.css" rel="stylesheet">
    <script src="../../js/toastr.min.js"></script>
    <link href="../../css/toastr.min.css" rel="stylesheet">
    <script src="../../js/customToastr.js"></script>
    <!--//Metis Menu -->
</head>
<!--left-fixed -navigation-->
<?php include_once('../../includes/sidebar.php'); ?>
<!--left-fixed -navigation-->
<!-- header-starts -->
<?php include_once('../../includes/header.php'); ?>
<!-- //header-ends -->

<body class="cbp-spmenu-push">
    <div class="main-content">
        <!-- main content start-->
        <div id="page-wrapper">
            <div class="main-page">
                <?php if ($_GET['addRubricAssessment'] == 'failed') : echo "<script> warning('Record cant be added. Operation failed.');</script>"; ?>
                <?php elseif ($_GET['addRubricAssessment'] == 'success') : echo "<script> addSuccess('Add Rubric Assessment successful'); </script>"; ?>
                <?php elseif ($rubricAssmtBllObj->errorMessage != '') : echo "<script> warning('$rubricAssmtBllObj->errorMessage'); </script>"; ?>
                <?php endif; ?>
                <div class="forms ">
                    <h3 class="title1">Add Rubric Assessment</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                        <div class="form-title">
                            <h4>Rubric Assessment</h4>
                        </div>
                        <div class="form-body">
                            <form method="post">
                                <div class="form-group col-md-2"> <label for="exampleInput">Assessment ID</label><input type="text" id="assessmentID" name="assessmentID" class="form-control" value="<?php echo $rubricAssessmentDALObj->generateID(); ?>" readonly="readonly"></div>
                                <div class="form-group col-md-6"> <label for="exampleInput">Assessment Title</label> <input type="text" id="Title" name="Title" class="form-control" placeholder="INDUSTRIAL TRAINING SUPERVISOR’S EVALUATION ON STUDENT" required="true"> </div>
                                <div class="form-group col-md-2">
                                    <label for="inputState">Role for Mark</label>
                                    <select id="inputState" name="RoleForMark" class="form-control" required>
                                        <option selected disabled value="">Choose...</option>
                                        <option>Company</option>
                                        <option>Supervisor</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2"> <label for="exampleInput">Total Weight</label> <input type="tel" id="TotalWeight" name="TotalWeight" class="form-control" placeholder="60" onchange="changeHandler(this)" required="true"> </div>
                                <div class="form-group col-md-3">
                                    <label for="inputState">Intern Start Day</label>
                                    <select id="InternStartDate" name="internshipBatchID" class="form-control" onchange="insertDate();" required>
                                        <option selected disabled value="">Choose...</option>
                                        <?php
                                        include('includes/db_connection.php');
                                        $db_handle = new DBController();
                                        $query = "SELECT * FROM InternshipBatch";
                                        $results = $db_handle->runQuery($query);

                                        for ($i = 0; $i < count($results); $i++) {
                                            echo "<option value='" . $results[$i]['internshipBatchID'] . "'>" . $results[$i]['officialStartDate'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3"> <label>Intern End Day</label> <input type="text" id="InternEndDate" name="InternEndDate" class="form-control" placeholder="1/1/2022" value="" readonly="readonly"></div>
                                <div class="form-group col-md-3"> <label>Earliest Start Date </label> <input type="text" id="EarliestStartDate" class="form-control" placeholder="1/1/2022" value="" readonly="readonly"></div>
                                <div class="form-group col-md-3"> <label>Latest End Date</label> <input type="text" id="LatestEndDate" class="form-control" placeholder="1/1/2022" value="" readonly="readonly"></div>
                                <div class="form-group col-md-12"> <label>Assessment Instruction</label><textarea class="form-control" id="Instructions" name="Instructions" placeholder="Component Name" required></textarea></div>
                                <div class="form-group col-md-12 text-right"> <button type="submit" name="SubmitButton" id="SubmitButton" value="Add rubric assessment" class="form-group btn btn-default">Save</button></div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--footer-->
        <?php include_once('../../includes/footer.php'); ?>
        <!--//footer-->
        <!-- Classie -->
        <script src="../../js/classie.js"></script>

        <script>
            var menuLeft = document.getElementById('cbp-spmenu-s1'),
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

            function changeHandler(val) {
                if (Number(val.value) > 100) {
                    warning("Total Weight not more than 100!");
                    val.value = "";
                } else if (isNaN(val.value)) {
                    warning("Please input a Number!");
                    val.value = "";
                }

            }
            async function fetchInternDate() {
                const internBatchID = document.getElementById('InternStartDate').value;
                const getInternDatePhp = '../../app/DAL/internBatchDAL.php?internshipBatchID=' + internBatchID;

                let getInternDateRespond = await fetch(getInternDatePhp);
                let internObj = await getInternDateRespond.json();
                return internObj;
            }

            //Calling async function need to be async as well
            async function insertDate() {
                const internObj = await fetchInternDate();
                document.getElementById('InternEndDate').value = internObj[0].officialEndDate;
                document.getElementById('EarliestStartDate').value = internObj[0].earliestStartDate;
                document.getElementById('LatestEndDate').value = internObj[0].latestEndDate;
            }
        </script>
        <!-- Bootstrap Core JavaScript -->
        <script src="../../js/bootstrap.js"> </script>
</body>

</html>
<?php //} 
?>