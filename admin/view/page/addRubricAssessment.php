<?php
session_start();
error_reporting(0);
include('includes/db_connection.php');
require_once('../../app/BLL/rubricAssessmentBLL.php');
require_once("../../app/DTO/rubricAssessmentDTO.php");
require_once("../../app/DTO/rubricAssessmentCriteriaDTO.php");
require_once("../../app/DAL/rubricAssessmentDAL.php");
$rubricAssessmentDALObj  = new rubricAssessmentDAL();
/*if (strlen($_SESSION['bpmsaid'] == 0)) {
	header('location:logout.php');
} else {

	}*/
$rubricAssmtBllObj = new rubricAssessmentBLL();

if (isset($_POST['SubmitButton']) && $_POST['SubmitButton'] == 'Add rubric assessment') {
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

    if (count($_POST['criterionID']) == count($_POST['criteriaTitle'])) {
        $countRow = count($_POST['criterionID']);
        for ($i = 0; $i < $countRow; $i++) {
            $newOfRubricCriteriaDto[] = new rubricAssessmentCriteriaDTO($assessmentID, $_POST['criterionID'][$i], $_POST['criteriaTitle'][$i], $_POST['maxScore'][$i]);
        }
    }

    $rubricAssmtBllObj->AddRubricAssmt($newRubricAssmt, $newOfRubricCriteriaDto);
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
        display: flex;
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

    .checkbox-group fieldset {
        border: 1px solid gray;
        padding: 15px;
        margin: 10px 0;
        min-height: 600px;
        max-height: 600px;
    }

    .checkbox-group fieldset legend {
        font-size: calc(1vw + 0.2em);
        font-weight: 600;
        border: none;
        max-width: -webkit-fit-content;
        max-width: -moz-fit-content;
        max-width: fit-content;
        padding: 0 4px;
        margin: 0;
    }

    .checkbox-group fieldset legend span {
        color: #f2891f;
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
        max-height: 435px;
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
                <?php

                if ($_GET['status'] == 'failed') {
                    echo "<script> warning('Record cant be added. Operation failed.');</script>";
                } elseif ($_GET['status'] == 'success') {
                    echo "<script> addSuccess('Add Rubric Assessment successful'); </script>";
                } elseif ($rubricAssmtBllObj->errorMessage != '') {
                    echo "<script> warning('$rubricAssmtBllObj->errorMessage'); </script>";
                }

                ?>
                <div class="forms ">

                    <h3 class="title1">Add Rubric Assessment</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                        <div class="form-title">
                            <h4>Rubric Assessment</h4>
                        </div>
                        <div class="form-body">
                            <form method="post">
                                <div class="form-group col-md-2"> <label for="exampleInput">Assessment ID</label><input type="text" id="assessmentID" name="assessmentID" class="form-control" value="<?php echo $rubricAssessmentDALObj->generateID() ?>" readonly="readonly"></div>
                                <div class="form-group col-md-6"> <label for="exampleInput">Assessment Title</label> <input type="text" id="Title" name="Title" class="form-control" placeholder="INDUSTRIAL TRAINING SUPERVISOR’S EVALUATION ON STUDENT" value="" required="true"> </div>
                                <div class="form-group col-md-2">
                                    <label for="inputState">Role for Mark</label>
                                    <select id="RoleForMark" name="RoleForMark" class="form-control" onchange="insertRubricCriteriaTitle();" required>
                                        <option selected disabled value="">Choose...</option>
                                        <?php
                                        $options = array('Company', 'Supervisor');
                                        foreach ($options as $option) {
                                            if ($_GET['act'] == "edit") {
                                                if ($aRubricAssmt->getRoleForMark() == $option) {
                                                    echo "<option selected='selected' value='$option'>$option</option>";
                                                } else {
                                                    echo "<option value='$option'>$option</option>";
                                                }
                                            } else {
                                                echo "<option value='$option'>$option</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2"> <label for="exampleInput">Total Weight</label> <input type="tel" id="TotalWeight" name="TotalWeight" class="form-control" placeholder="60" value="" onchange="changeHandler(this)" required="true"> </div>
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

                                            if ($_GET['act'] == "edit") {
                                                if ($aRubricAssmt->getInternshipBatchID() == $results[$i]['internshipBatchID']) {
                                                    echo "<option selected='selected' value='" . $results[$i]['internshipBatchID'] . "'>" . $results[$i]['officialStartDate'] . "</option>";
                                                } else {
                                                    echo "<option value='" . $results[$i]['internshipBatchID'] . "'>" . $results[$i]['officialStartDate'] . "</option>";
                                                }
                                            } else {
                                                echo "<option value='" . $results[$i]['internshipBatchID'] . "'>" . $results[$i]['officialStartDate'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <input id="createDate" name="createDate" value="" hidden></input>
                                <div class="form-group col-md-3"> <label>Intern End Day</label> <input type="text" id="InternEndDate" name="InternEndDate" class="form-control" placeholder="1/1/2022" value="" readonly="readonly"></div>
                                <div class="form-group col-md-3"> <label>Earliest Start Date </label> <input type="text" id="EarliestStartDate" class="form-control" placeholder="1/1/2022" value="" readonly="readonly"></div>
                                <div class="form-group col-md-3"> <label>Latest End Date</label> <input type="text" id="LatestEndDate" class="form-control" placeholder="1/1/2022" value="" readonly="readonly"></div>
                                <div class="form-group col-md-12"> <label>Assessment Instruction</label><textarea rows="6" class="form-control" id="Instructions" name="Instructions" placeholder="Component Name" required></textarea></div>

                                <div class="form-group col-md-12 checkbox-group">

                                    <fieldset>
                                        <legend>Select Rubric Criteria Field </legend>
                                        <div>
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Criteria ID</th>
                                                        <th>Session</th>
                                                        <th>Rubric Criteria Title</th>
                                                        <th>Max Score</th>
                                                        <th>Checkbox</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="tab3-small-table" id="rubric-assessment-criteria-table">
                                                </tbody>
                                            </table>
                                        </div>
                                    </fieldset>


                                    <span class="arrow-icon">🠚</span>


                                    <fieldset>
                                        <legend>Existing Selected Rubric Criteria Field </legend>
                                        <div class="table-responsive">
                                            <table name="test">
                                                <thead>
                                                    <tr>
                                                        <th>Criteria ID</th>
                                                        <th>Session</th>
                                                        <th>Title</th>
                                                        <th>Max Score</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="tab3-small-table" id="selected-rubric-assessment-criteria-table">

                                                </tbody>
                                                <tfoot id="test-table">
                                                </tfoot>
                                            </table>
                                        </div>
                                    </fieldset>


                                </div>
                                <div class="button-group">
                                    <a class="clickable-btn" id="assign-btn" onclick="assign()">Assign</a>
                                    <input type="text" readonly class="clickable-btn" href="#" value="Reset All Selected" onclick="resetSelect(document.getElementById('rubric-assessment-criteria-table'), document.getElementById('selected-rubric-assessment-criteria-table'))">
                                </div>

                                <div class="form-group col-md-12 text-right"> <button type="submit" name="SubmitButton" id="SubmitButton" value="Add rubric assessment" class="form-group btn btn-default">Save</button></div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="main-page" style="padding-top:30px ;">
                <div class="forms ">
                    <h3 class="title1">Select Rubric Component Criteria</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                        <div class="form-title">
                            <h4>Rubric Criteria</h4>
                        </div>
                        <!--form method="post">
                                <div class='form-group col-md-12 text-right'> <text class='btn btn-default' id='btnAddNewRow' onclick='clone()'>Add More Rubric Criteria </text></div>
                                <div id="Clone">
                                    <div id="CloneRow">
                                        <div class="form-group col-md-4">
                                            <label for="inputState">Intern Start Day</label>
                                            <select id="Assmt_Criteria_Title" name="Assmt_Criteria_Title" class="form-control" onchange="insertCriteria(this.value,this.parentNode.nextElementSibling.childNodes[3].id,this.parentNode.nextElementSibling.nextElementSibling.childNodes[3].id);" required>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4"> <label>Assessment Criteria Session</label> <input type="text" id="Assmt_Criteria_Session_1" value="None" name="InternEndDate" class="form-control" readonly="readonly"></div>
                                        <div class="form-group col-md-4"> <label>Assessment Criteria Title</label> <input type="text" id="Assmt_Criteria_Title_1" value="None" class="form-control" readonly="readonly"></div>
                                        <div class="form-group col-md-12 text-right"> <button type="submit" name="SubmitButton" id="SubmitButton" value="<?php echo isset($_GET['act']) && $_GET['act'] == "edit" ? "" : "" ?>" class="form-group btn btn-default hide">Save</button></div>
                                    </div>
                                </div>
                            </form-->
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

        function changeHandler(val) {
            if (Number(val.value) > 100) {
                warning("Total Weight not more than 100!");
                val.value = "";
            } else if (isNaN(val.value)) {
                warning("Please input a Number!");
                val.value = "";
            }
            checkScoreIsMatch(countScore);
        }

        async function fetchInternDate() {
            const internBatchID = document.getElementById('InternStartDate').value;
            const getInternDatePhp = '../../app/DAL/internBatchDAL.php?internshipBatchID=' + internBatchID;

            let getInternDateRespond = await fetch(getInternDatePhp);
            let internObj = await getInternDateRespond.json();
            return internObj;
        }

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

        let countScore = 0;

        async function insertRubricCriteriaTitle() {
            InsertCriteriaTable();
            const selectedRubricAssessmentCriteriaTable = document.getElementById("selected-rubric-assessment-criteria-table");
            if (selectedRubricAssessmentCriteriaTable.hasChildNodes()) {
                removeAllChildNodes(selectedRubricAssessmentCriteriaTable);
                countScore = 0;
                const testTable = document.getElementById("test-table");
                if (testTable.hasChildNodes()) {
                    removeAllChildNodes(testTable);
                }
            }

        }

        async function InsertCriteriaTable() {
            const criteriaResult = await fetchRubricCriteriaTitle();
            const supervisorTable = document.getElementById("rubric-assessment-criteria-table");


            if (supervisorTable.hasChildNodes()) {
                removeAllChildNodes(supervisorTable);
            }


            if (criteriaResult !== "No Data Found") {

                for (let i = 0; i < criteriaResult.length; i++) {
                    var str = criteriaResult[i].score;
                    if (typeof str.split('-')[1] != "undefined") {
                        var maxScore = str.split('-')[1];
                    } else {
                        var maxScore = str;
                    }

                    let trLeft = document.createElement("tr");
                    trLeft.setAttribute("data-criterionID", criteriaResult[i].criterionID);
                    trLeft.setAttribute("data-CriteriaSession", criteriaResult[i].CriteriaSession);
                    trLeft.setAttribute("data-Title", criteriaResult[i].Title);
                    trLeft.setAttribute("data-score", criteriaResult[i].score);
                    trLeft.setAttribute("data-maxScore", maxScore);

                    trLeft.innerHTML = `
                    <td>${criteriaResult[i].criterionID}</td>
                    <td>${criteriaResult[i].CriteriaSession}
                    </td>
                    <td>${criteriaResult[i].Title}</td>
                    <td>${maxScore}</td>
                    <td>
                        <input type="checkbox" data-CriteriaSession="${criteriaResult[i].CriteriaSession}" name="${criteriaResult[i].criterionID}" class="tab-3-checkbox">
                    </td>
                `;
                    supervisorTable.appendChild(trLeft);
                }
            } else {
                //alert("No Data Found");
                return;
            }
        }

        function removeAllChildNodes(parent) {
            while (parent.firstChild) {
                parent.removeChild(parent.firstChild);
            }
        }

        function assign() {
            var table = document.getElementById("rubric-assessment-criteria-table");
            const studentTable = document.getElementById("selected-rubric-assessment-criteria-table");
            const rCount = table.rows.length;
            for (var i = 0; i < table.rows.length; i++) {
                if (table.rows[i].cells[4].children[0].checked) {
                    if (isExistingAssign(table.rows[i].getAttribute('data-CriteriaSession'), table.rows[i].getAttribute('data-Title'))) {
                        let trRight = document.createElement("tr");
                        trRight.setAttribute("data-CriteriaSession", table.rows[i].getAttribute('data-CriteriaSession'));
                        trRight.setAttribute("data-Title", table.rows[i].getAttribute('data-Title'));
                        trRight.setAttribute("data-maxScore", table.rows[i].getAttribute('data-maxScore'));
                        trRight.innerHTML = `
                    <td>${table.rows[i].getAttribute('data-criterionID')}<input hidden name="criterionID[]" value="${table.rows[i].getAttribute('data-criterionID')}"></input></td>
                    <td>${table.rows[i].getAttribute('data-CriteriaSession')}</td>
                    <td>${table.rows[i].getAttribute('data-Title')}<input hidden name="criteriaTitle[]" value="${table.rows[i].getAttribute('data-Title')}"></input></td>
                    <td>${table.rows[i].getAttribute('data-maxScore')}<input hidden name="maxScore[]" value="${table.rows[i].getAttribute('data-maxScore')}"></input></td>
                    <td>
                    <button type="button" onClick="removeChildNode(this,Number.parseInt(${table.rows[i].getAttribute('data-maxScore')}));">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				    </button>
                    
                    </td>
                `;
                        studentTable.appendChild(trRight);

                        countScore += Number.parseInt(table.rows[i].getAttribute('data-maxScore'));
                    }
                }

            }
            const testTable = document.getElementById("test-table");
            let trRight = document.createElement("tr");
            if (testTable.hasChildNodes()) {
                removeAllChildNodes(testTable);
            }

            trRight.innerHTML = `
            
            <td style="width:35%">Total Score</td>
            <td>${countScore}</td>
            `;
            testTable.appendChild(trRight);
            checkScoreIsMatch(countScore);
            //alert(value_check);
        }

        function removeChildNode(currentRow, currentScore) {
            $(currentRow).closest('tr').remove();
            countScore -= Number.parseInt(currentScore)
            checkScoreIsMatch(countScore);
            const testTable = document.getElementById("test-table");
            let trRight = document.createElement("tr");
            if (testTable.hasChildNodes()) {
                removeAllChildNodes(testTable);
            }

            trRight.innerHTML = `
            
            <td style="width:35%">Total Score</td>
            <td>${countScore}</td>
            `;
            testTable.appendChild(trRight);
        }

        function checkScoreIsMatch(countScore) {
            let inputScore = document.getElementById("TotalWeight").value;
            inputScore = Number.parseInt(inputScore);
            if (countScore < inputScore) {
                info("Your Selected Rubric Criteria Score Must Be Match With Input Total Weight");
                $("#SubmitButton").attr("disabled", "disabled");
                document.getElementById('SubmitButton').style = "pointer-events: none;";
            } else if (countScore > inputScore) {
                warning("Your Selected Rubric Criteria Score are More than Input Total Weight");
                $("#SubmitButton").attr("disabled", "disabled");
                document.getElementById('SubmitButton').style = "pointer-events: none;";
            } else if (countScore == inputScore) {
                document.getElementById('SubmitButton').removeAttribute('disabled');
                document.getElementById('SubmitButton').style = "";
            }
        }

        function isExistingAssign(criteriaSession, title) {
            var table = document.getElementById("selected-rubric-assessment-criteria-table");
            var rCount = table.rows.length;
            //console.log(table.rows[0].cells[1].getAttribute('data-Title'));
            var value_check = "";
            for (var i = 0; i < table.rows.length; i++) {
                if (table.rows[i].getAttribute('data-CriteriaSession') == criteriaSession && table.rows[i].getAttribute('data-Title') == title) {
                    return false;
                }
            }
            return true;
        }

        function resetSelect(table1, table2) {
            if (table2.hasChildNodes()) {
                removeAllChildNodes(table2);
            }
            const testTable = document.getElementById("test-table");
            if (testTable.hasChildNodes()) {
                removeAllChildNodes(testTable);
            }
            var rCount = table1.rows.length;
            for (var i = 0; i < table1.rows.length; i++) {
                if (table1.rows[i].cells[4].children[0].checked) {
                    table1.rows[i].cells[4].children[0].checked = false;
                }
            }
            countScore = 0;
        }
    </script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../js/bootstrap.js"> </script>
</body>

</html>
<?php //} 
?>