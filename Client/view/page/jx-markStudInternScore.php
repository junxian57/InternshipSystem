<?php
session_start();
error_reporting(0);
include('includes/db_connection.php');
$systemPathPrefix = $_SERVER['DOCUMENT_ROOT'] . '/internshipSystem/client/';
require_once $systemPathPrefix . "/app/BLL/rubricAssessmentBLL.php";
require_once $systemPathPrefix . "/app/DTO/rubricAssessmentDTO.php";
require_once $systemPathPrefix . "/app/DTO/rubricAssessmentCriteriaDTO.php";
require_once $systemPathPrefix . "/app/DAL/rubricAssessmentDAL.php";

require_once $systemPathPrefix . "/app/BLL/markingSchemeBLL.php";
require_once $systemPathPrefix . "/app/DTO/markingSchemeDTO.php";
require_once $systemPathPrefix . "/app/DAL/markingSchemeDAL.php";

require_once $systemPathPrefix . "/app/DTO/studResultDTO.php";
$rubricAssessmentDALObj  = new rubricAssessmentDAL();
/*if (strlen($_SESSION['bpmsaid'] == 0)) {
	header('location:logout.php');
} else {

	}*/
$rubricAssmtBllObj = new rubricAssessmentBLL();

$markingSchemeBllObj = new markingSchemeBLL();
if ($_GET['internshipBatchID'] && $_GET['studid']) {
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $date = date('Y-m-d');
    $id = str_replace("'", "", $_GET['internshipBatchID']);
    $markByID = str_replace("'", "", $_GET['companyID']);
    $studid = str_replace("'", "", $_GET['studid']);
    $studResultid = str_replace("'", "", $_GET['studResultId']);
    $studName = str_replace("'", "", $_GET['studName']);
    $studProgrammeName = str_replace("'", "", $_GET['studProgrammeName']);
    $finalScore = str_replace("'", "", $_GET['finalScore']);
    $db_handle = new DBController();


    $query = "SELECT * FROM RubricAssessment Where internshipBatchID=$id and RoleForMark='company'";
    $results = $db_handle->runQuery($query);
    $aRubricAssmt = $rubricAssmtBllObj->GetRubricAssessment($results[0]['assessmentID']);

    $aMarkingScheme = $markingSchemeBllObj->GetMarkingScheme($studResultid, $results[0]['assessmentID']);

    $query2 = "SELECT * FROM StudentResult Where studResultID='$studResultid'";
    $results2 = $db_handle->runQuery($query2);


    if ($aMarkingScheme) {
        $array = array();

        if (!empty($aMarkingScheme)) {
            for ($i = 0; $i < count($aMarkingScheme); $i++) {
                $criterionID = $aMarkingScheme[$i]->getcriteriaID();
                $markingID = $aMarkingScheme[$i]->getmarkingID();
                $score = $aMarkingScheme[$i]->getscore();
                $array[] = array(
                    'criterionID' => $criterionID,
                    'markingID' => $markingID,
                    'score' => $score
                );
            }
            $s_to_json = json_encode($array);
        }
    } else {
        $s_to_json = json_encode("No Data Found");
    }
}
if (isset($_POST['SubmitButton']) && $_POST['SubmitButton'] == 'Add rubric assessment') {
    $finalScore = 0;
    if (count($_POST['score']) == count($_POST['score'])) {
        if ($aMarkingScheme) {
            $countRow = count($_POST['score']);
            for ($i = 0; $i < $countRow; $i++) {

                $newOfMarkingSchemeDto[] = new MarkingSchemeDTO($_POST['markingSchemeID'][$i], $studResultid, $results[0]['assessmentID'], $_POST['criteriaID'][$i], $_POST['score'][$i]);
                $finalScore += $_POST['score'][$i];
            }
            $newOfStudResultDto = new studResultDTO($studResultid, $studid, $finalScore, $_POST['feedback'], $_POST['traineeInfo'], $_POST['absentAttendance'],$_POST['withoutPermissionAbsentAttendance'], $_POST['signature'], $markByID, $date);
            $markingSchemeBllObj->UpdMarkingScheme($newOfStudResultDto, $newOfMarkingSchemeDto);
           
        } else {
            $markingSchemeBALObj  = new markingSchemeDAL();
            $markingSchemeID = $markingSchemeBALObj->generateID();
            $countRow = count($_POST['score']);
            for ($i = 0; $i < $countRow; $i++) {

                $newOfMarkingSchemeDto[] = new MarkingSchemeDTO($markingSchemeID, $studResultid, $results[0]['assessmentID'], $_POST['criteriaID'][$i], $_POST['score'][$i]);
                $markingSchemeID = generateMarkingSchemeID($markingSchemeID);
                $finalScore += $_POST['score'][$i];
            }
            $newOfStudResultDto = new studResultDTO($studResultid, $studid, $finalScore, $_POST['feedback'], $_POST['traineeInfo'], $_POST['absentAttendance'],$_POST['withoutPermissionAbsentAttendance'], $_POST['signature'], $markByID, $date);
            $markingSchemeBllObj->AddMarkingScheme($newOfStudResultDto, $newOfMarkingSchemeDto);
        }
    }
}

function generateMarkingSchemeID($markingSchemeID)
{

    $prefix = 'MARK';

    //Get the first ID 
    $lastID = $markingSchemeID;
    //SubString to last part of ID
    $numberPart = substr($lastID, 4, 6);

    if ((int) $numberPart < 9) {
        $prefix .= '00000' . ((int) $numberPart + 1);
    } else if ((int) $numberPart >= 9) {
        $prefix .= '0000' . ((int) $numberPart + 1);
    }

    return $prefix;
}

?>
<!DOCTYPE HTML>
<html>
<style>
    .no-border {
        border: 0;
        box-shadow: none;
        /* You may want to include this as bootstrap applies these styles too */
    }

    .checkbox-group {
        justify-content: space-between;
        align-items: center;
    }

    .checkbox-group .arrow-icon {
        font-size: 2.5vw;
        color: #f2891f;
    }

    .checkbox-group form {
        max-width: 48%;
    }

    .checkbox-group table {
        width: 100%;
        border-spacing: 0;
        border-collapse: collapse;
    }

    .checkbox-group table thead {
        font-size: 1.1em;
    }

    .checkbox-group table thead,
    .checkbox-group table tbody,
    .checkbox-group table tr {
        display: table;
        width: 100%;
        table-layout: fixed;
    }

    .checkbox-group table th,
    .checkbox-group table td {
        text-align: center;
        padding: 12px;
        vertical-align: middle;
        border: 1px solid #ddd;
        border-collapse: collapse;
        word-wrap: break-word;
    }

    .checkbox-group table th {
        background-color: #eeeded;
    }

    .checkbox-group table tbody {
        display: block;
    }

    .checkbox-group table tbody tr {
        transition: all 0.5s;
    }

    .checkbox-group table tbody tr:hover {
        background-color: rgb(235, 235, 235);
    }

    .checkbox-group table tbody button {
        padding: 5px;
        letter-spacing: 1px;
        font-size: 1.1em;
        background-color: transparent;
        color: #ff4500;
        border: none;
        outline: none;
        cursor: pointer;
        transition: ease-in-out 0.2s;
    }

    .checkbox-group table tbody button:hover {
        background-color: transparent;
        color: #fe6932;
    }

    .button-group {
        padding: 1.2em 0;
    }

    .button-group .clickable-btn {
        cursor: pointer;
        background-color: #f2891f;
        padding: 10px 15px;
        color: #fff;
        outline: none;
        border: 1px solid #f2891f;
        letter-spacing: 1px;
        transition: all 0.1s ease-in-out;
    }

    .button-group .clickable-btn:hover {
        background-color: #f5ae67;
        color: #fff;
        border: 1px solid #f5ae67;
    }

    .button-group .clickable-btn:nth-child(2) {
        margin-left: 20px;
        background-color: #313e85;
        color: #fff;
        border: 1px solid #313e85;
        transition: all 0.1s ease-in-out;
    }

    .button-group .clickable-btn:nth-child(2):hover {
        background-color: #535ea6;
        color: #fff;
    }

    .checkbox-group table th:first-child,
    .checkbox-group table td:first-child {
        width: 20%;
    }

    .checkbox-group table th:nth-child(4),
    .checkbox-group table td:nth-child(4) {
        width: 15%;
    }

    .checkbox-group table th:last-child,
    .checkbox-group table td:last-child {
        width: 15%;
    }

    .checkbox-group table tbody,
    .checkbox-group table tfoot {
        display: block;

        overflow-y: scroll;
    }

    .checkbox-group table tfoot {
        display: block;
        max-height: 50px;
    }
</style>

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
                <div class="forms">
                    <h3 class="title1">Lecture Evaluation Form</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                        <div class="form-body">
                            <form method="post">
                                <div class="form-group col-md-2">
                                    <label>Assessment ID</label>
                                    <input type="text" id="assessmentID" name="assessmentID" class="form-control col-md-2" value="<?php echo  $aRubricAssmt->getAssmtId() ?>" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Role for Mark</label>
                                    <input type="text" id="RoleForMark" name="RoleForMark" class="form-control" value="<?php echo  $aRubricAssmt->getRoleForMark() ?>" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Intern Start Day</label>
                                    <?php
                                    include('includes/db_connection.php');
                                    $db_handle = new DBController();
                                    $query = "SELECT * FROM InternshipBatch";
                                    $results = $db_handle->runQuery($query);
                                    for ($i = 0; $i < count($results); $i++) {
                                        if ($aRubricAssmt->getInternshipBatchID() == $results[$i]['internshipBatchID']) {
                                            echo " <input type='text' id='InternStartDate' name='internshipBatchID' class='form-control' value=" . $results[$i]['officialStartDate'] . " readonly>";
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Intern End Day</label>
                                    <input type="text" id="InternEndDate" name="InternEndDate" class="form-control" placeholder="1/1/2022" value="" readonly="readonly">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Earliest Start Date </label>
                                    <input type="text" id="EarliestStartDate" class="form-control" placeholder="1/1/2022" value="" readonly="readonly">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Latest End Date</label>
                                    <input type="text" id="LatestEndDate" class="form-control" placeholder="1/1/2022" value="" readonly="readonly">
                                </div>

                                <div class="form-group col-md-12"> <label for="exampleInput">Assessment Title</label> <input type="text" id="Title" name="Title" class="form-control" value="<?php echo   $aRubricAssmt->getTitle() ?>" readonly> </div>
                                <div class="form-group col-md-12"> <label>Assessment Instruction</label><textarea rows="6" readonly class="form-control" id="Instructions" name="Instructions" placeholder="Component Name" required><?php echo $aRubricAssmt->getInstructions() ?></textarea></div>
                                <div class="form-group col-md-4">
                                    <label>Name of Company</label>
                                    <input type="text" id="" class="form-control" placeholder="XXX Sdn Bhd" value="" readonly="readonly">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Name of Company Supervisior</label>
                                    <input type="text" id="studName" class="form-control" placeholder="Tan Ah Gau" value="<?php ?>" readonly="readonly">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Name of Student Trainee</label>
                                    <input type="text" id="studName" class="form-control" placeholder="Tan Ah Gau" value="<?php echo $studName ?>" readonly="readonly">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>ID of Student Trainee</label>
                                    <input type="text" id="" class="form-control" placeholder="2101234" value="<?php echo $studid ?>" readonly="readonly">
                                </div>
                                <div class="form-group col-md-12 checkbox-group">
                                    <label id="session"></label>
                                    <div class="form-group table-responsive">
                                        <table>
                                            <thead id="thead">
                                                <tr>
                                                    <th>Criteria</th>
                                                    <th>Very Poor</th>
                                                    <th>Poor</th>
                                                    <th>Average</th>
                                                    <th>Good</th>
                                                    <th>Excellent</th>
                                                    <th>Score</th>
                                                </tr>
                                            </thead>
                                            <tbody class="tab3-small-table" id="selected-rubric-assessment-criteria-table">
                                            </tbody>
                                            <tfoot id="test-table">
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="form-group col-md-12">Student's Attendance</h4>
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <label class=""> Number of days absent with permission:</label>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input type="text" class="form-control" id="absentAttendance" name="absentAttendance" value="<?php echo $results2[0]['absentAttendance'] ?>">
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <label class="">Number of days absent without permission :</label>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input type="text" id="withoutPermissionAbsentAttendance" name="withoutPermissionAbsentAttendance" class="form-control" value="<?php echo $results2[0]['withoutPermissionAbsentAttendance'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12"> <span>Other comments about this student trainee?</span><textarea rows="6" class="form-control" id="feedback" name="feedback" placeholder=""><?php echo $results2[0]['feedback'] ?></textarea></div>
                                    <div class="form-group col-md-12">
                                        <span>Please include a few words about the type of training the student trainee underwent. For e.g. nature of work, department attached to, duration of attachment, etc.</span>
                                        <textarea rows="6" class="form-control" id="traineeInfo" name="traineeInfo" placeholder=""><?php echo $results2[0]['traineeInfo'] ?></textarea></div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label class="">Signature:</label>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input type="text" class="form-control" name="signature" value="<?php echo $results2[0]['signature'] ?>">
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label class="">Name:</label>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input type="text" id="Title" name="Title" class="form-control " readonly>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label class="">Designation</label>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input type="text" class="form-control" value="Company Supervisor" readonly>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label class="">Date: (DD/MM/YYYY)</label>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input type="text" class="form-control " value="<?php echo $date ?>" readonly>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <textarea class="col-md-12 form-control" rows="15" readonly>Affix company stamp</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-12 text-right"> <button type="submit" name="SubmitButton" id="SubmitButton" value="Add rubric assessment" class="form-group btn btn-default">Save</button></div>
                            </form>
                        </div>
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
    <script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../../js/dataTables.bootstrap.min.js"></script>
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

        window.onload = function() {
            insertDate();
            InsertSelectedRubricCriteriaTable();
        }

        async function fetchInternDate() {
            const internBatchID = <?php echo $aRubricAssmt->getInternshipBatchID() ?>;
            const getInternDatePhp = '../../app/DAL/internBatchDAL.php?internshipBatchID=' + internBatchID;

            let getInternDateRespond = await fetch(getInternDatePhp);
            let internObj = await getInternDateRespond.json();
            return internObj;
        }

        //Calling async function need to be async as well
        async function insertDate() {
            const internObj = await fetchInternDate();
            if (internObj.length != 0) {
                document.getElementById('InternEndDate').value = internObj[0].officialEndDate;
                document.getElementById('EarliestStartDate').value = internObj[0].earliestStartDate;
                document.getElementById('LatestEndDate').value = internObj[0].latestEndDate;
            }

        }

        async function fetchRubricCriteriaTitle() {
            const RoleForMark = document.getElementById("RoleForMark").value;
            const getManagerPhp = '../../app/DAL/ajaxGetRubricCriteria.php?RoleForMark=' + RoleForMark;
            let getComponentLvlRespond = await fetch(getManagerPhp);
            let CmpLvlObj = await getComponentLvlRespond.json();
            return CmpLvlObj;
        }

        async function fetchSelectedRubricCriteria() {
            const assessmentID = document.getElementById("assessmentID").value;
            const getRubricCriteriaPhp = '../../app/DAL/ajaxGetSeletedRubricCriteria.php?assessmentID=' + assessmentID;
            let getRubricCriteriaPhpRespond = await fetch(getRubricCriteriaPhp);
            let RubricCriteriaObj = await getRubricCriteriaPhpRespond.json();
            return RubricCriteriaObj;
        }

        let countScore = 0;
        async function InsertSelectedRubricCriteriaTable() {
            const criteriaResult = await fetchSelectedRubricCriteria();
            const table = document.getElementById("selected-rubric-assessment-criteria-table");
            const thead = document.getElementById("thead");
            const tableB = document.getElementById("session-B-tbody");
            const Bthead = document.getElementById("session-B-thead");
            const s_to_json = <?php echo $s_to_json ?: "" ?>;
            //console.log(thead.rows[0].cells[1]);
            if (table.hasChildNodes()) {
                removeAllChildNodes(table);
            }
            let currentScoreRange = criteriaResult[0].score;
            thead.rows[0].cells[1].innerHTML = `<tr> Very Poor (${criteriaResult[0].score.split(',')[0]})</tr>`;
            thead.rows[0].cells[2].innerHTML = `<tr> Poor (${criteriaResult[0].score.split(',')[1]})</tr>`;
            thead.rows[0].cells[3].innerHTML = `<tr> Average (${criteriaResult[0].score.split(',')[2]})</tr>`;
            thead.rows[0].cells[4].innerHTML = `<tr> Good (${criteriaResult[0].score.split(',')[3]})</tr>`;
            thead.rows[0].cells[5].innerHTML = `<tr> Excellent (${criteriaResult[0].score.split(',')[4]})</tr>`;
            let currentRowMaxScore = criteriaResult[0].score.split(',')[4];
            if (criteriaResult !== "No Data Found") {
                for (let i = 0; i < criteriaResult.length; i++) {
                    let maxScore = criteriaResult[i].TotalWeight;
                    let trHead = document.createElement("tr");
                    if (currentScoreRange != criteriaResult[i].score) {

                        trHead.innerHTML = `
                        <th>Criteria</th>
                        <th> Very Poor (${criteriaResult[i].score.split(',')[0]})</th>
                        <th> Poor (${criteriaResult[i].score.split(',')[1]})</th>
                        <th> Average (${criteriaResult[i].score.split(',')[2]})</th>
                        <th> Good (${criteriaResult[i].score.split(',')[3]})</th>
                        <th> Excellent (${criteriaResult[i].score.split(',')[4]})</th>
                        <th></th>
                        `;
                        table.appendChild(trHead);
                        currentScoreRange = criteriaResult[i].score;
                        currentRowMaxScore = criteriaResult[i].score.split(',')[4];
                        currentRowMaxScore = currentRowMaxScore.slice(-2);
                    }
                    let trLeft = document.createElement("tr");
                    trLeft.setAttribute("data-Title", criteriaResult[i].Title);
                    trLeft.setAttribute("data-CriteriaSession", criteriaResult[i].CriteriaSession);
                    trLeft.setAttribute("data-Title", criteriaResult[i].Title);
                    trLeft.setAttribute("data-score", criteriaResult[i].score);
                    trLeft.setAttribute("data-maxScore", "");
                    trLeft.innerHTML = `
                    <td>${criteriaResult[i].Title}<input type="hidden" name="criteriaID[]" value="${criteriaResult[i].criterionID}" ></input></td>
                    <td>${criteriaResult[i].description.split(',')[0]}</td>
                    <td>${criteriaResult[i].description.split(',')[1]}</td>
                    <td>${criteriaResult[i].description.split(',')[2]}</td>
                    <td>${criteriaResult[i].description.split(',')[3]}</td>
                    <td>${criteriaResult[i].description.split(',')[4]}</td>
                    <td><input type="text" class="text-center" name="score[]" value="${Number(s_to_json[i].score)}" onchange="changeHandler(this,${currentRowMaxScore});" required></input></td>
                `;
                    table.appendChild(trLeft);


                    countScore += Number.parseInt(maxScore);
                }

                const testTable = document.getElementById("test-table");
                let trRight = document.createElement("tr");
                if (testTable.hasChildNodes()) {
                    removeAllChildNodes(testTable);
                }

                if (s_to_json == "No Data Found") {
                    $('#selected-rubric-assessment-criteria-table').find('input[type=text]').each(function() {
                        $(this).val("");
                    });
                }

                trRight.innerHTML = `
            
            <td style="width:85%">Total Score</td>
            <td> 0 / ${countScore}</td>
            `;
                testTable.appendChild(trRight);
            } else {
                //alert("No Data Found");
                return;
            }
        }

        function changeHandler(val, maxScore) {
            if (Number(val.value) > Number(maxScore)) {
                warning("Total Weight not more than Current Row Max weight");
                val.value = "";
            } else if (isNaN(val.value)) {
                warning("Please input a Number!");
                val.value = "";
            }

        }

        function removeAllChildNodes(parent) {
            while (parent.firstChild) {
                parent.removeChild(parent.firstChild);
            }
        }
    </script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../js/bootstrap.js"> </script>
</body>

</html>
<?php //} 
?>