<?php
session_start();
error_reporting(0);
if (session_status() != PHP_SESSION_ACTIVE) session_start();

if (!isset($_SESSION['adminID'])) {
    if (!isset($_SESSION['committeeID'])) {
        echo "<script>
          window.location.href = 'adminLogin.php';
      </script>";
    }
}
//include_once("../../includes/db_connection.php");
require_once('../../app/BLL/rubricAssessmentBLL.php');
require_once("../../app/DTO/rubricAssessmentDTO.php");
require_once("../../app/DAL/rubricAssessmentDAL.php");

require_once('../../app/DAL/ComponentLvlDAL.php');
require_once('../../app/BLL/componentLvlBLL.php');
require_once('../../app/DTO/componentLvlDTO.php');

require_once('../../app/BLL/rubricAssessmentComponentBLL.php');
require_once("../../app/DTO/rubricAssessmentComponentDTO.php");
require_once("../../app/DTO/rubricComponentDTO.php");
require_once("../../app/DAL/rubricAssessmentComponentDAL.php");



$rubricAssessmentBllObj  = new rubricAssessmentBLL();
$all_rubricAssessment = $rubricAssessmentBllObj->GenerateHtmlForAllRubricAssessment();

$rubricCmpLvlBLLObj = new componentLvlBLL();

$all_rubricCmpLvl = $rubricCmpLvlBLLObj->GenerateHtmlForAllRubricCmpLvl();

$rubricAssessmentComponentBllObj = new rubricAssessmentComponentBLL();
$all_rubricCmpCriteria = $rubricAssessmentComponentBllObj->GenerateHtmlForAllRubricCmpCriteria();
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>ITP System | View Rubric Assessment</title>
    <link href="../../css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="../../css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="../../css/style.css" rel='stylesheet' type='text/css' />
    <link href="../../css/font-awesome.css" rel="stylesheet">
    <link href="../../scss/navtab.css" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href="../../css/animate.css" rel="stylesheet" type="text/css" media="all">
    <link href="../../css/custom.css" rel="stylesheet">

    <script src="../../js/jquery-1.11.1.min.js"></script>
    <script src="../../js/modernizr.custom.js"></script>>
    <script src="../../js/wow.min.js"></script>
    <script src="../../js/metisMenu.min.js"></script>
    <script src="../../js/custom.js"></script>

    <script>
        new WOW().init();
    </script>

    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
</head>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once('../../includes/sidebar.php'); ?>
        <?php include_once('../../includes/header.php'); ?>
        <div id="page-wrapper">
            <div class="main-page">
                <div class="tables">
                    <h3 class="page-title">Supervisor - Company mapping</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                        <!-- Tab Button -->
                        <div class="tab">
                            <button class="tablinks" id="activeTab" onclick="changeTab(event, 'SupervisorCmpMappingTab')">Assign supervisor<span class="arrow-icon">&#129050</span>company</button>
                            <button class="tablinks" onclick="changeTab(event, 'AutoSupervisorCmpMappingTab')">Automated mapping</button>
                        </div>

                        <!-- Tab Content 1 SupervisorCmpMappingTab-->
                        <div id="SupervisorCmpMappingTab" class="tabcontent">
                            <div class="row">
                                <div class="table-title">
                                    <h4>Supervisor & company Mapping</h4>
                                </div>
                            </div>
                            <div class="search-group">

                                <div class="form-group">
                                    <label for="internBatch-group">Internship Batch <span class="required-star">*</span></label>
                                    <select name="internBatch-group" id="tab2-internBatch-group" class="form-control" required="true" onchange="enableOther(document.getElementById('tab2-student'), document.getElementById(this.id))">
                                        <option value="" selected disabled>Select Internship Batch</option>
                                        <?php
                                        foreach ($getInternBatch as $batch) {
                                            echo "<option value='" . $batch['internshipBatchID'] . "'>" . $batch['internshipBatchID'] . "</option>";
                                        }
                                        ?>
                                    </select>

                                    <label for="student" class="margin-top-20">Search Student <span class="required-star">*</span></label>
                                    <input type="search" class="form-control" id="tab2-student" name="student" disabled placeholder="Enter Any Relevant Keyword...." required="true" onkeyup="displaySearchResult(this, this.id)">
                                    <div class="form-control result-box" id="result-box-2" autocomplete="off">

                                    </div>
                                </div>

                                <span class="arrow-icon">&#129050</span>
                                <div class="form-group">
                                    <label for="supervisor-select">Supervisor <span class="required-star">*</span></label>
                                    <select name="supervisor-select" id="tab2-supervisor-group" class="form-control" required="true" disabled>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12 checkbox-group">

                                    <fieldset>
                                        <legend>Select Rubric Criteria Field </legend>
                                        <div>
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Company ID</th>
                                                        <th>Company Name</th>
                                                        <th>Size</th>
                                                        <th>Acccpted Student</th>
                                                        <th>Checkbox</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="tab3-small-table" id="visitation-Company-List-table">
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
                                                        <th>Company ID</th>
                                                        <th>Company Name</th>
                                                        <th>Size</th>
                                                        <th>Acccpted Student</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="tab3-small-table" id="selected-visitation-Company-List-table">

                                                </tbody>
                                                <tfoot id="test-table">
                                                </tfoot>
                                            </table>
                                        </div>
                                    </fieldset>


                                </div>
                        </div>

                        <!-- Tab Content 2 automatedmap-->
                        <div id="AutoSupervisorCmpMappingTab" class="tabcontent">
                            <div class="row">
                                <div class="table-title">
                                    <h4>Automated Mapping</h4>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

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

                async function activateRubricAssmt(rubricAssmtID) {
                    let text = "Are Your want to reactivate the Rubric Assessment?\nEither OK or Cancel.";

                    if (confirm(text)) {
                        let url = `../../app/DAL/ajaxReactivateRubric.php?assessmentID=${rubricAssmtID}&rubricAssessment=rubricAssessment`;
                        let response = await fetch(url);
                        let data = await response.json();

                        if (data == "Success") {
                            location.reload();
                            alert("Update Successfully");
                        } else {
                            alert("Update Failed");
                        }
                    }
                }

                async function terminateRubricAssmt(rubricAssmtID) {
                    let text = "Are Your want to terminate the Rubric Assessment?\nEither OK or Cancel.";

                    if (confirm(text)) {
                        let url = `../../app/DAL/ajaxTerminateRubric.php?assessmentID=${rubricAssmtID}&rubricAssessment=rubricAssessment`;
                        let response = await fetch(url);
                        let data = await response.json();

                        if (data == "Success") {
                            location.reload();
                            alert("Update Successfully");
                        } else {
                            alert("Update Failed");
                        }
                    }
                }

                async function activateRubricCriteria(RubricCriteriaID) {
                    let text = "Are Your want to reactivate the Rubric Assessment?\nEither OK or Cancel.";

                    if (confirm(text)) {
                        let url = `../../app/DAL/ajaxReactivateRubric.php?RubricCriteriaID=${RubricCriteriaID}&rubricCriteria=rubricCriteria`;
                        let response = await fetch(url);
                        let data = await response.json();

                        if (data == "Success") {
                            location.reload();
                            alert("Update Successfully");
                        } else {
                            alert("Update Failed");
                        }
                    }
                }

                async function terminateRubricCriteria(RubricCriteriaID) {
                    let text = "Are Your want to terminate the Rubric Assessment?\nEither OK or Cancel.";

                    if (confirm(text)) {
                        let url = `../../app/DAL/ajaxTerminateRubric.php?RubricCriteriaID=${RubricCriteriaID}&rubricCriteria=rubricCriteria`;
                        let response = await fetch(url);
                        let data = await response.json();

                        if (data == "Success") {
                            location.reload();
                            alert("Update Successfully");
                        } else {
                            alert("Update Failed");
                        }
                    }
                }
            </script>
            <!--change tab-->
            <script>
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
                document.getElementById("activeTab").click();
            </script>

            <!--Table JS sorting,searchinh,pagination-->
            <script>
                $(document).ready(function() {
                    $('#rubricCmpTbl').DataTable({
                        //custom search bar 
                        "language": {
                            searchPlaceholder: "Search records"
                        },
                        "searchBox": {
                            "addClass": 'form-control input-lg col-xs-12'
                        },

                        "fnDrawCallback": function() {
                            $("input[type='search']").attr("id", "searchBox");
                            $('#dialPlanListTable').css('cssText', "margin-top: 0px !important;");
                            $("select[name='dialPlanListTable_length'], #searchBox").removeClass("input-sm");
                            $("select[name='dialPlanListTable_length'], #searchBox").addClass("input-md");
                            //$('#searchBox').css("width", "250px");
                            $('#dialPlanListTable_filter').removeClass('dataTables_filter');

                            $('.sorting').css("width", "");
                            //$('#test1').style.remove('width');
                        },
                    });
                    $('#RubricCmpLvlTbl').DataTable({
                        //custom search bar 
                        "language": {
                            searchPlaceholder: "Search records"
                        },
                        "searchBox": {
                            "addClass": 'form-control input-lg col-xs-12'
                        },

                        "fnDrawCallback": function() {
                            $("input[type='search']").attr("id", "searchBox");
                            $('#dialPlanListTable').css('cssText', "margin-top: 0px !important;");
                            $("select[name='dialPlanListTable_length'], #searchBox").removeClass("input-sm");
                            $("select[name='dialPlanListTable_length'], #searchBox").addClass("input-md");
                            //$('#searchBox').css("width", "250px");
                            $('#dialPlanListTable_filter').removeClass('dataTables_filter');

                            $('.sorting').css("width", "");
                            //$('#test1').style.remove('width');
                        },
                    });
                    $('#RubricCmpCriteriaTbl').DataTable({
                        //custom search bar 
                        "language": {
                            searchPlaceholder: "Search records"
                        },
                        "searchBox": {
                            "addClass": 'form-control input-lg col-xs-12'
                        },

                        "fnDrawCallback": function() {
                            $("input[type='search']").attr("id", "searchBox");
                            $('#dialPlanListTable').css('cssText', "margin-top: 0px !important;");
                            $("select[name='dialPlanListTable_length'], #searchBox").removeClass("input-sm");
                            $("select[name='dialPlanListTable_length'], #searchBox").addClass("input-md");
                            //$('#searchBox').css("width", "250px");
                            $('#dialPlanListTable_filter').removeClass('dataTables_filter');

                            $('.sorting').css("width", "");
                            //$('#test1').style.remove('width');
                        },
                    });
                });
            </script>

            <script src="../../js/classie.js"></script>
            <script src="../../js/bootstrap.js"> </script>

            <script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="../../js/dataTables.bootstrap.min.js"></script>
            <script src="https://cdn.datatables.net/fixedheader/3.3.1/js/dataTables.fixedHeader.min.js"></script>
            <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
</body>
<footer><?php include_once('includes/footer.php'); ?></footer>

</html>