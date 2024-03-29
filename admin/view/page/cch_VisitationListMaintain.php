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

require_once('../../app/BLL/visitationMapBLL.php');
require_once("../../app/DTO/visitationMapDTO.php");
require_once("../../app/DTO/visitationCompanyListDTO.php");
require_once("../../app/DAL/visitationMapDAL.php");

/*if (strlen($_SESSION['bpmsaid'] == 0)) {
	//header('location:logout.php');
} else {*/

$visitationListBLLObj  = new visitationListBLL();
$all_visitationList = $visitationListBLLObj->GenerateHtmlForAllvisitationList();

$visitationMapBLLObj  = new visitationMapBLL();
$all_visitationMap = $visitationMapBLLObj->GenerateHtmlForAllvisitationMap();

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
                            <button class="tablinks" onclick="changeTab(event, 'supervisorCompanyMapListTbl')">Visitation Maping list</button>
                        </div>
                        <div id="visitationListTbl" class="tabcontent" style="display:block">
                            <div class="row">
                                <div class="table-title">
                                    <h4>Preview Visitation Company table</h4>
                                </div>
                            </div>

                            <?php
                            echo $all_visitationList;
                            ?>
                        </div>
                        <div id="supervisorCompanyMapListTbl" class="tabcontent">
                            <div class="row">
                                <div class="table-title">
                                    <h4>Preview Maping Table</h4>
                                </div>
                            </div>

                            <?php
                            echo $all_visitationMap;
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
                async function terminateVisitationList(Visitation_ID) {
                    let text = "Do you want to delete the visitation list?\nChoose OK or Cancel.";

                    if (confirm(text)) {
                        let url = `../../app/DAL/ajaxTerminateVisitationList.php?Visitation_ID=${Visitation_ID}`;
                        console.log(url);
                        let response = await fetch(url);
                        let data = await response.json();

                        if (data == "Success") {
                            location.reload();
                            alert("terminate Successfully");
                        } else {
                            alert("terminate Failed");
                        }
                    }
                }
                async function terminateVisitationMapList(Visitation_AppMapID) {
                    let text = "Do you want to delete the visitation map?\nChoose OK or Cancel.";

                    if (confirm(text)) {
                        let url = `../../app/DAL/ajaxterminateVisitationMapList.php?Visitation_AppMapID=${Visitation_AppMapID}`;
                        console.log(url);
                        let response = await fetch(url);
                        let data = await response.json();

                        if (data == "Success") {
                            location.reload();
                            alert("terminate Successfully");
                        } else {
                            alert("terminate Failed");
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
                    $('#visitationListTBL').DataTable({
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
                    $('#supervisorCompanyMapListTBL').DataTable({
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