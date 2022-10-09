<?php
session_start();
error_reporting(0);
//include_once("../../includes/db_connection.php");
require_once('../../app/BLL/rubricAssessmentBLL.php');
require_once("../../app/DTO/rubricAssessmentDTO.php");
require_once("../../app/DAL/rubricAssessmentDAL.php");
/*if (strlen($_SESSION['bpmsaid'] == 0)) {
	//header('location:logout.php');
} else {*/
$rubricAssessmentBllObj  = new rubricAssessmentBLL();

$all_rubricAssessment = $rubricAssessmentBllObj->GenerateHtmlForAllRubricAssessment();

?>
<!DOCTYPE HTML>
<html>

<head>
    <title>ITP System | View Rubric Assessment</title>
    <link href="../../css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="../../css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="../../css/style.css" rel='stylesheet' type='text/css' />
    <link href="../../css/font-awesome.css" rel="stylesheet">
    <link href="../../css/navtab.css" rel="stylesheet">
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
                    <h3 class="page-title">Rubric Assessment & Component</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                        <div class="tab">
                            <button class="tablinks" id="activeTab" onclick="changeTab(event, 'RubricCmpTbl')">Rubric Assessment</button>
                            <button class="tablinks" onclick="changeTab(event, 'Final')">Final Work Progress Report</button>
                        </div>


                        <div id="RubricCmpTbl" class="tabcontent">
                            <div class="row">
                                <div class="table-title">
                                    <h4 class="col-md-9 text-left">Preview Table</h4>
                                    <p class="col-md-3 text-right">Hint: Table Below Is Scrollable</p>
                                </div>
                                <div class="text-right col-sm-12">
                                    <button type="button" class="btn btn-primary" data-target="#theModal" data-toggle="modal" href="../popUp/addeditRubricAssessment.php?act">Add New Rubric Assessment</button>
                                </div>
                            </div>

                            <?php
                            echo $all_rubricAssessment;
                            ?>

                            <div class="modal fade text-center" id="theModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div id="Final" class="tabcontent">
                            <div class="table-title">
                                <h4>Preview Table</h4>
                                <p>Hint: Table Below Is Scrollable</p>
                            </div>

                            <table id="finalTable" class="table-responsive">
                                <tr>
                                    <th>#</th>
                                    <th>Final Report ID</th>
                                    <th>Submit Date Time</th>
                                    <th>Report</th>
                                    <th>Submit On Time</th>
                                    <th style="border-right: 0;">Action</th>
                                    <th style="border-left: 0;"></th>
                                </tr>

                                <tr>
                                    <td>1</td>
                                    <td>FRPT000001</td>
                                    <td>2023-07-30 12:00:00</td>
                                    <td>Maria Anders</td>
                                    <td>YES</td>
                                    <td>
                                        <a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
                                    </td>
                                    <td>
                                        <a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>2</td>
                                    <td>FRPT000002</td>
                                    <td>2023-07-30 12:00:00</td>
                                    <td>Maria Anders</td>
                                    <td>YES</td>
                                    <td>
                                        <a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
                                    </td>
                                    <td>
                                        <a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>3</td>
                                    <td>FRPT000003</td>
                                    <td>2023-07-30 12:00:00</td>
                                    <td>Maria Anders</td>
                                    <td>YES</td>
                                    <td>
                                        <a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
                                    </td>
                                    <td>
                                        <a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>4</td>
                                    <td>FRPT000004</td>
                                    <td>2023-07-30 12:00:00</td>
                                    <td>Maria Anders</td>
                                    <td>YES</td>
                                    <td>
                                        <a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
                                    </td>
                                    <td>
                                        <a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>5</td>
                                    <td>FRPT000005</td>
                                    <td>2023-07-30 12:00:00</td>
                                    <td>Maria Anders</td>
                                    <td>YES</td>
                                    <td>
                                        <a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
                                    </td>
                                    <td>
                                        <a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
                                    </td>
                                </tr>

                                <td>6</td>
                                <td>FRPT000006</td>
                                <td>2023-07-30 12:00:00</td>
                                <td>Maria Anders</td>
                                <td>YES</td>
                                <td>
                                    <a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
                                </td>
                                <td>
                                    <a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
                                </td>
                                </tr>

                                <td>7</td>
                                <td>FRPT000007</td>
                                <td>2023-07-30 12:00:00</td>
                                <td>Maria Anders</td>
                                <td>YES</td>
                                <td>
                                    <a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
                                </td>
                                <td>
                                    <a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
                                </td>
                                </tr>

                                <td>8</td>
                                <td>FRPT000008</td>
                                <td>2023-07-30 12:00:00</td>
                                <td>Maria Anders</td>
                                <td>YES</td>
                                <td>
                                    <a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
                                </td>
                                <td>
                                    <a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
                                </td>
                                </tr>

                                <td>9</td>
                                <td>FRPT000009</td>
                                <td>2023-07-30 12:00:00</td>
                                <td>Maria Anders</td>
                                <td>YES</td>
                                <td>
                                    <a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
                                </td>
                                <td>
                                    <a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
                                </td>
                                </tr>

                                <td>10</td>
                                <td>FRPT000010</td>
                                <td>2023-07-30 12:00:00</td>
                                <td>Maria Anders</td>
                                <td>YES</td>
                                <td>
                                    <a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
                                </td>
                                <td>
                                    <a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
                                </td>
                                </tr>

                                <td>11</td>
                                <td>FRPT000011</td>
                                <td>2023-07-30 12:00:00</td>
                                <td>Maria Anders</td>
                                <td>YES</td>
                                <td>
                                    <a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
                                </td>
                                <td>
                                    <a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
                                </td>
                                </tr>

                                <td>12</td>
                                <td>FRPT000012</td>
                                <td>2023-07-30 12:00:00</td>
                                <td>Maria Anders</td>
                                <td>YES</td>
                                <td>
                                    <a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
                                </td>
                                <td>
                                    <a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
                                </td>
                                </tr>

                                <td>13</td>
                                <td>FRPT000013</td>
                                <td>2023-07-30 12:00:00</td>
                                <td>Maria Anders</td>
                                <td>YES</td>
                                <td>
                                    <a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
                                </td>
                                <td>
                                    <a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
                                </td>
                                </tr>

                                <td>14</td>
                                <td>FRPT000014</td>
                                <td>2023-07-30 12:00:00</td>
                                <td>Maria Anders</td>
                                <td>YES</td>
                                <td>
                                    <a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
                                </td>
                                <td>
                                    <a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
                                </td>
                                </tr>

                                <td>15</td>
                                <td>FRPT000015</td>
                                <td>2023-07-30 12:00:00</td>
                                <td>Maria Anders</td>
                                <td>YES</td>
                                <td>
                                    <a class="view" href="view-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">View</a>
                                </td>
                                <td>
                                    <a class="view" href="print-workprogress.php?workprogressid=<?php echo "weeklyReportID"; ?>">Print</a>
                                </td>
                                </tr>
                            </table>
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
            </script>
            <!--change tab-->
            <script>
                function changeTab(evt, tabName) {
                    let i, tabcontent, tablinks;

                    // Get all elements with class="tabcontent" and hide them
                    tabcontent = document.querySelectorAll(".tabcontent");
                    tabcontent.forEach(i => {
                        console.log(i)
                        i.style.display = "none";
                    });

                    // Get all elements with class="tablinks" and remove the class "active"
                    tablinks = document.querySelectorAll(".tablinks");
                    tablinks.forEach(i => {
                        console.log(i)
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
                });
            </script>
            <!--dispose modal when close the modal -->
            <script>
                $("#theModal").on('hidden.bs.modal', function() {
                    $(this).data('bs.modal', null);
                });
            </script>

            <script src="../../js/classie.js"></script>
            <script src="../../js/bootstrap.js"> </script>

            <script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="../../js/dataTables.bootstrap.min.js"></script>
</body>
<footer><?php include_once('includes/footer.php'); ?></footer>

</html>