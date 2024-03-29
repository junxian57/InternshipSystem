<?php
session_start();
error_reporting(0);
include('includes/db_connection.php');
require_once('../../app/BLL/rubricAssessmentComponentBLL.php');
require_once("../../app/DTO/rubricAssessmentComponentDTO.php");
require_once("../../app/DTO/rubricComponentDTO.php");
require_once("../../app/DAL/rubricAssessmentComponentDAL.php");

if (session_status() != PHP_SESSION_ACTIVE) session_start();

if (!isset($_SESSION['adminID'])) {
    if (!isset($_SESSION['committeeID'])) {
        echo "<script>
          window.location.href = 'adminLogin.php';
      </script>";
    }
}

$rubricAssessmentComponentDALObj  = new rubricAssessmentComponentDAL();
$rubricAssessmentComponentBllObj = new rubricAssessmentComponentBLL();
if ($_GET['act'] == "edit") {
    $id = str_replace("'", "", $_GET['id']);
    $id = str_replace("'", "", $_GET['id']);
    $aRubricAssmtCmptCriteria = $rubricAssessmentComponentBllObj->GetRubricCmptCriteria($id);
    $aRubricAssmtCmpt = $rubricAssessmentComponentBllObj->GetRubricCmpt($id);
    if (isset($_POST['SubmitButton']) && $_POST['SubmitButton'] == 'Edit Rubric Criteria Component') {
        $newOfRubricCmpDto = array();
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $date = date('Y-m-d');

        $assessmentCriteriaID = $_POST['assessmentCriteriaID'];
        $facultyID = $_POST['facultyID'];
        $assessmentCriteriaTitle = $_POST['assessmentCriteriaTitle'];
        $RoleForMark = $_POST['RoleForMark'];
        $assessmentCriteriaSession = $_POST['assessmentCriteriaSession'];
        $assessmentCriteriaDesc = $_POST['assessmentCriteriaDesc'];
        $CreateByID = $_SESSION['adminID'];
        $CreateByID = $_SESSION['committeeID'];
        $CreateDate = $date;
        if (count($_POST['cmpLvlValue']) == count($_POST['CriteriaCmpDesc'])) {
            $countRow = count($_POST['cmpLvlValue']);
            for ($i = 0; $i < $countRow; $i++) {
                $newOfRubricCmpDto[] = new rubricComponentDTO($_POST['cmptID'][$i], $assessmentCriteriaID, $_POST['cmplvTitle'][$i], $_POST['cmpLvlValue'][$i], $_POST['CriteriaCmpDesc'][$i]);
            }
        }
        //print_r($newOfRubricCmpDto);
        $newRubricCmpCriteria = new rubricAssessmentComponentDTO($assessmentCriteriaID, $assessmentCriteriaTitle, $RoleForMark, $assessmentCriteriaSession, $assessmentCriteriaDesc, $CreateByID, $CreateDate);
        $newRubricCmpCriteria->setfacultyID($facultyID);
        //print_r($newRubricCmpCriteria);
        $rubricAssessmentComponentBllObj->UpdRubricCmpCriteria($newRubricCmpCriteria, $newOfRubricCmpDto);
    }
} else {
    if (isset($_POST['SubmitButton']) && $_POST['SubmitButton'] == 'Add Rubric Criteria Component') {
        $newOfRubricCmpDto = array();
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $date = date('Y-m-d');

        $assessmentCriteriaID = $_POST['assessmentCriteriaID'];
        $facultyID = $_POST['facultyID'];
        $assessmentCriteriaTitle = $_POST['assessmentCriteriaTitle'];
        $RoleForMark = $_POST['RoleForMark'];
        $assessmentCriteriaSession = $_POST['assessmentCriteriaSession'];
        $assessmentCriteriaDesc = $_POST['assessmentCriteriaDesc'];
        $CreateByID = $_POST['CreateByID'];
        $CreateDate = $date;

        if (count($_POST['cmpLvlValue']) == count($_POST['CriteriaCmpDesc'])) {
            $countRow = count($_POST['cmpLvlValue']);
            $componentId = $rubricAssessmentComponentDALObj->generateRubricCmptID();
            for ($i = 0; $i < $countRow; $i++) {
                $newOfRubricCmpDto[] = new rubricComponentDTO($componentId, $assessmentCriteriaID, $_POST['cmplvTitle'][$i], $_POST['cmpLvlValue'][$i], $_POST['CriteriaCmpDesc'][$i]);
                $componentId = generateRubricCmptID($componentId);
            }
        }
        //print_r($newOfRubricCmpDto);
        $newRubricCmpCriteria = new rubricAssessmentComponentDTO($assessmentCriteriaID, $assessmentCriteriaTitle, $RoleForMark, $assessmentCriteriaSession, $assessmentCriteriaDesc, $CreateByID, $CreateDate);
        $newRubricCmpCriteria->setfacultyID($facultyID);
        $rubricAssessmentComponentBllObj->AddRubricCmpCriteria($newRubricCmpCriteria, $newOfRubricCmpDto);
    }
}

function generateRubricCmptID($componentId)
{

    $prefix = 'CMP';

    //Get the first ID 
    $lastID = $componentId;
    //SubString to last part of ID
    $numberPart = substr($lastID, 3, 6);
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
    <!--//Metis Menu -->
    <script src="../../js/toastr.min.js"></script>
    <link href="../../css/toastr.min.css" rel="stylesheet">
    <script src="../../js/customToastr.js"></script>
</head>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <!--left-fixed -navigation-->
        <?php include_once('../../includes/sidebar.php'); ?>
        <!--left-fixed -navigation-->
        <!-- header-starts -->
        <?php include_once('../../includes/header.php'); ?>
        <!-- //header-ends -->
        <!-- main content start-->
        <div id="page-wrapper">
            <div class="main-page">
                <?php
                if ($_GET['act'] == "edit") {
                    if ($_GET['status'] == 'failed') {
                        echo "<script> warning('Record cant be Update. Operation failed.');</script>";
                    } elseif ($_GET['status'] == 'success') {
                        echo "<script> addSuccess('Update Rubric Assessment Criteria successful'); </script>";
                    } elseif ($rubricAssessmentComponentBllObj->errorMessage != '') {
                        echo "<script> warning('$rubricAssessmentComponentBllObj->errorMessage'); </script>";
                    }
                } else {
                    if ($_GET['status'] == 'failed') {
                        echo "<script> warning('Record cant be added. Operation failed.');</script>";
                    } elseif ($_GET['status'] == 'success') {
                        echo "<script> addSuccess('Add Rubric Assessment Criteria successful'); </script>";
                    } elseif ($rubricAssessmentComponentBllObj->errorMessage != '') {
                        echo "<script> warning('$rubricAssessmentComponentBllObj->errorMessage'); </script>";
                    }
                }

                ?>
                <div class="forms ">
                    <?php
                    if ($_GET['act'] == "edit") {
                        echo '<h3 class="title1">Edit Rubric Assessment Criteria</h3>';
                    } else {
                        echo '<h3 class="title1">Add Rubric Assessment Criteria</h3>';
                    }
                    ?>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                        <div class="form-title">
                            <h4>Rubric Assessment Criteria</h4>
                        </div>
                        <div class="form-body">
                            <form method="post">
                                <div class="form-group col-md-2"> <label for="exampleInput">Assessment Criteria ID</label><input type="text" id="assessmentCriteriaID" name="assessmentCriteriaID" class="form-control" value="<?php echo isset($_GET['act']) && $_GET['act'] == "edit" ? $id : $rubricAssessmentComponentDALObj->generateID() ?>" readonly="readonly"></div>
                                <div class="form-group col-md-7"> <label for="exampleInputPassword1">Assessment Criteria Title</label> <input type="text" id="assessmentCriteriaTitle" name="assessmentCriteriaTitle" class="form-control" placeholder="Component Level" value="<?php echo isset($_GET['act']) && $_GET['act'] == "edit" ? $aRubricAssmtCmptCriteria->getTitle() : "" ?>" required="true"> </div>
                                <div class="form-group col-md-3">
                                    <label for="inputState">Role for Mark</label>
                                    <select id="inputState" name="RoleForMark" class="form-control" required>
                                        <option selected disabled value="">Choose...</option>
                                        <?php
                                        $options = array('Company', 'Supervisor');
                                        foreach ($options as $option) {
                                            if ($_GET['act'] == "edit") {
                                                if ($aRubricAssmtCmptCriteria->getRoleForMark() == $option) {
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
                                <div class="form-group col-md-12">
                                    <label for="exampleInputPassword1">Assessment Criteria Session</label>
                                    <select type="text" id="assessmentCriteriaSession" name="assessmentCriteriaSession" class="form-control" placeholder="Section A. Progress Reports" value="<?php echo isset($_GET['act']) && $_GET['act'] == "edit" ? $aRubricAssmtCmptCriteria->getCriteriaSession() : "" ?>" required="true">

                                        <option value="Section A. Progress Reports" <?php echo isset($_GET['act']) && $_GET['act'] == "edit" ? $aRubricAssmtCmptCriteria->getCriteriaSession() == 'Section A. Progress Reports' ? 'selected' : '' : "" ?>>Section A. Progress Reports</option>
                                        <option value="Section B. Final Reports" <?php echo isset($_GET['act']) && $_GET['act'] == "edit" ? $aRubricAssmtCmptCriteria->getCriteriaSession() == 'Section B. Final Reports' ? 'selected' : '' : "" ?>>Section B. Final Reports</option>
                                        <option value="N/A" <?php echo isset($_GET['act']) && $_GET['act'] == "edit" ? $aRubricAssmtCmptCriteria->getCriteriaSession() == 'N/A' ? 'selected' : '' : "" ?>>N/A</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputState">Selected Faculty</label>
                                    <select id="facultyID" name="facultyID" class="form-control" required>
                                        <option selected disabled value="">Choose...</option>
                                        <?php
                                        include('includes/db_connection.php');
                                        $db_handle = new DBController();
                                        $query = "SELECT * FROM Faculty";
                                        $results = $db_handle->runQuery($query);

                                        for ($i = 0; $i < count($results); $i++) {

                                            if ($_GET['act'] == "edit") {
                                                if ($aRubricAssmtCmptCriteria->getfacultyID() == $results[$i]['facultyID']) {
                                                    echo "<option selected='selected' value='" . $results[$i]['facultyID'] . "'>" . $results[$i]['facName'] . "</option>";
                                                } else {
                                                    echo "<option value='" . $results[$i]['facultyID'] . "'>" . $results[$i]['facName'] . "</option>";
                                                }
                                            } else {
                                                echo "<option value='" . $results[$i]['facultyID'] . "'>" . $results[$i]['facName'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-12"> <label for="exampleInputEmail1">Assessment Criteria Description</label> <textarea type="text-area" class="form-control" id="assessmentCriteriaDesc" name="assessmentCriteriaDesc" placeholder="Component Name" required="true"><?php echo isset($_GET['act']) && $_GET['act'] == "edit" ? $aRubricAssmtCmptCriteria->getDesc() : "" ?></textarea></div>
                                <div id="CriteriaDesc">
                                    <?php
                                    $count = 1;
                                    $valueName = array('Very Poor', 'Poor', 'Average', 'Good', 'Excellent');
                                    for ($i = 0; $i < 5; $i++) {
                                        echo "<div class='row'>";
                                        echo '<input class="form-group hide" name="cmptID[]" value="', isset($_GET['act']) && $_GET['act'] == "edit" ? $aRubricAssmtCmpt[$i]->getcmptID() : "", '"></input>';
                                        echo '<div class="form-group col-md-6"> <label for="exampleInputEmail1">Assessment Criteria Component Description ' . $count . '</label>';
                                        echo '<textarea type="text-area" class="form-control" id="CriteriaCmpDesc" name="CriteriaCmpDesc[]" placeholder="Assessment Criteria Description" required>', isset($_GET['act']) && $_GET['act'] == "edit" ? $aRubricAssmtCmpt[$i]->getcriteriaCmpDesc() : '', '</textarea>';
                                        echo "</div>";
                                        echo "<div class='form-group col-md-3'>";
                                        echo '<label for="inputState">Component Level Title</label>';
                                        echo '<input type="text" id="cmplvTitle" name="cmplvTitle[]" class="form-control" value="' . $valueName[$i] . '" readonly>';
                                        echo '</div>';
                                        echo '<div class="form-group col-md-3">';
                                        echo '<label for="inputState">Component Level</label>';
                                        echo '<input type="text" id="cmpLvlValue_' . $count . '" name="cmpLvlValue[]" class="form-control cmpLvlValue_" placeholder="0-2" value="', isset($_GET['act']) && $_GET['act'] == "edit" ? $aRubricAssmtCmpt[$i]->getscore() : "", '" onchange="changeHandler(this)" required>';
                                        echo '</div>';
                                        echo '</div>';
                                        $count++;
                                    }

                                    ?>

                                </div>
                                <div class="form-group col-md-12 text-right"> <button type="submit" name="SubmitButton" id="SubmitButton" value="<?php echo isset($_GET['act']) && $_GET['act'] == "edit" ? "Edit Rubric Criteria Component" : "Add Rubric Criteria Component" ?>" class="form-group btn btn-default">Save</button></div>
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



            $('body').on('click', '.btnRemove', function() {
                $(this).closest('div.row').remove()
                cloneCount--;
                //$("#btnAddNewRow").attr("disabled", "true");
                document.getElementById('btnAddNewRow').removeAttribute('disabled');
                document.getElementById('btnAddNewRow').style = "";
            });

            var cloneCount = 2;

            function clone() {
                var div = document.getElementById('CloneCriteriaDesc'),
                    clone = div.cloneNode(true); // true means clone all childNodes and all event handlers
                clone.getElementsByTagName('select')[0].id = "cmplvTitle_" + cloneCount;
                clone.getElementsByTagName('select')[1].id = "ComponentLevel_" + cloneCount;
                //set select onchange pass value
                clone.getElementsByTagName('select')[0].setAttribute("onchange", "insertCmpLvlValue('cmplvTitle_" + cloneCount + "', 'ComponentLevel_" + cloneCount + "')");
                clone.getElementsByTagName('select')[0].className = "form-control ComponentLevel_ " + cloneCount;

                //remove button
                clone.getElementsByTagName('button')[0].className = "btn btn-primary btnRemove";
                if (cloneCount == 5) {
                    $("#btnAddNewRow").attr("disabled", "disabled");
                    document.getElementById('btnAddNewRow').style = "pointer-events: none;";
                }
                cloneCount++;

                var example = document.getElementById('CriteriaDesc');
                example.appendChild(clone);
            }

            async function fetchCmptLvlValue2(cmplvTitleId) {
                const cmpValue = document.getElementById(cmplvTitleId).value;
                const getManagerPhp = '../../app/DAL/ComponentLvlDAL.php?ComponentLevelTitle=' + cmpValue;

                let getComponentLvlRespond = await fetch(getManagerPhp);
                let CmpLvlObj = await getComponentLvlRespond.json();
                return CmpLvlObj;
            }

            async function insertCmpLvlValue(cmplvTitleId, ComponentLevelId) {
                const CmpLvlObj = await fetchCmptLvlValue2(cmplvTitleId);
                const CmpLvlSelect = document.getElementById(ComponentLevelId);
                if (Object.keys(CmpLvlObj).length != 0) {
                    CmpLvlSelect.innerHTML = "";
                    for (let i = 0; i < CmpLvlObj.length; i++) {
                        CmpLvlSelect.innerHTML += "<option value='" + CmpLvlObj[i].levelID + "'>" + CmpLvlObj[i].Value + "</option>";
                    }
                } else {
                    CmpLvlSelect.innerHTML = "<option value='None'>None</option>";
                }
            }

            function setInputFilter(textbox, inputFilter, errMsg) {
                ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop", "focusout"].forEach(function(event) {
                    textbox.addEventListener(event, function(e) {
                        if (inputFilter(this.value)) {
                            // Accepted value
                            if (["keydown", "mousedown", "focusout"].indexOf(e.type) >= 0) {
                                this.classList.remove("input-error");
                                this.setCustomValidity("");
                            }
                            this.oldValue = this.value;
                            this.oldSelectionStart = this.selectionStart;
                            this.oldSelectionEnd = this.selectionEnd;
                        } else if (this.hasOwnProperty("oldValue")) {
                            // Rejected value - restore the previous one
                            this.classList.add("input-error");
                            this.setCustomValidity(errMsg);
                            this.reportValidity();
                            this.value = this.oldValue;
                            this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                        } else {
                            // Rejected value - nothing to restore
                            this.value = "";
                        }
                    });
                });
            }
            /*setInputFilter(document.getElementById("cmpLvlValue_1"), function(value) {
                return /^-?\d*[.,]?\d{0,2}$/.test(value);
            }, "Must be a currency value");*/
            /*setInputFilter($('[id^=cmpLvlValue_]'), function(value) {
                return /^-?\d*[-]?\d{0,2}$/.test(value);
            }, "Must be a currency value");*/

            //change
            function changeHandler(val) {

                var scoreRange = /^-?\d*[-]?\d{0,2}$/;
                if (!val.value.match(scoreRange)) {
                    warning("Must be a Number value exp: 1 - 10 The last digit only accept 2");
                    val.value = "";
                }
            }
        </script>
        <!-- Bootstrap Core JavaScript -->
        <script src="../../js/bootstrap.js"> </script>
</body>

</html>
<?php //} 
?>