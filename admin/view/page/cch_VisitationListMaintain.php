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
require_once('../../app/BLL/visitationListBLL.php');
require_once("../../app/DTO/visitationListDTO.php");
require_once("../../app/DAL/visitationListDAL.php");

/*if (strlen($_SESSION['bpmsaid'] == 0)) {
	//header('location:logout.php');
} else {*/

$visitationListBLLObj  = new visitationListBLL();
$visitationList = $visitationListBLLObj->GenerateHtmlForAllvisitationList();

?>
<!DOCTYPE HTML>
<html>

<head>
    <title>ITP System | View Visitation Company</title>
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
                    <h3 class="page-title">Visitation Company</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                        <div class="tab">
                            <button class="tablinks" id="activeTab" onclick="changeTab(event, 'visitationListTbl')">Visitation Company list</button>
                            <button class="tablinks" onclick="changeTab(event, 'supervisorCompanyMapListTbl')">Maping list</button>
                        </div>
                        <div id="visitationListTbl" class="tabcontent" style="display:block">
                            <div class="row">
                                <div class="table-title">
                                    <h4>Preview Visitation Company table</h4>
                                </div>
                            </div>

                            <?php
                            echo $visitationList;
                            ?>
                        </div>
                        <div id="supervisorCompanyMapListTbl" class="tabcontent">
                            <div class="row">
                                <div class="table-title">
                                    <h4>Preview Maping Table</h4>
                                </div>
                                <div class="text-right col-sm-12">
                                    <button type="button" class="btn btn-primary" onclick="location.href='cch_AddVisitationList.php'">Add New Company List/Batch</button>
                                </div>
                            </div>

                            <?php
                            echo $all_supervisorCompanyMapList;
                            ?>
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
            async function terminateVisitationList(Visitation_ID) {
                let text = "Do you want to delete the message?\nChoose OK or Cancel.";

                if (confirm(text)) {
                    let url = `../../app/DAL/ajaxTerminateVisitationList.php?Visitation_ID=${Visitation_ID}`;
                    console.log(url);
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
                $('#visitationListTbl').DataTable({
                    //custom search bar 
                    "language": {
                        searchPlaceholder: "Search Document"
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
                $('#supervisorCompanyMapListTbl').DataTable({
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
</body>
<footer><?php include_once('includes/footer.php'); ?></footer>

</html>