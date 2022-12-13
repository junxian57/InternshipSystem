<?php
session_start();
error_reporting(0);
if (session_status() != PHP_SESSION_ACTIVE) session_start();

try {
    if (!isset($_SESSION['lecturerID'])) {
        echo "<script>
            window.location.href = 'clientLogin.php';
        </script>";
    } else {
        //Get lecturerID ID from Session
        $lecturerID = $_SESSION['lecturerID'];
    }

} catch (Exception $e) {
    echo "<script>
        alert('Database Connection Error');
        window.location.href = 'clientLogin.php';
    </script>";
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
    <link href="../../scss/navtab.css" rel="stylesheet">
    <script src="../../js/toastr.min.js"></script>
    <link href="../../css/toastr.min.css" rel="stylesheet">
    <script src="../../js/customToastr.js"></script>

</head>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once('../../includes/sidebar.php'); ?>
        <?php include_once('../../includes/header.php'); ?>
        <div id="page-wrapper">
            <div class="main-page">
                <?php
                if ($_GET['status'] == 'failed') {
                    echo "<script> warning('Record cant be Updated. Operation failed.');</script>";
                } elseif ($_GET['status'] == 'success') {
                    echo "<script> addSuccess('Update Student Evaluation successful'); </script>";
                }
                ?>
                <div class="tables">
                    <h3 class="page-title">Evaluation Form</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                        <div class="tab">
                            <button class="tablinks" id="activeTab" onclick="changeTab(event, 'RubricCmpTbl')">Evaluation By Supervisor</button>
                        </div>
                        <input id="lectureID" value="<?php echo $lecturerID ?>" hidden> </input>

                        <div id="RubricCmpTbl" class="tabcontent">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="inputState">Intern Start Day</label>
                                    <select id="internshipBatchID" name="internshipBatchID" class="form-control" onchange="insertStudDetail();">
                                        <option selected disabled value="">Choose...</option>
                                        <?php
                                        include('../../includes/db_connection.php');
                                        $db_handle = new DBController();
                                        $query = "SELECT * FROM InternshipBatch";
                                        $results = $db_handle->runQuery($query);

                                        for ($i = 0; $i < count($results); $i++) {
                                            echo "<option value='" . $results[$i]['internshipBatchID'] . "'>" . $results[$i]['officialStartDate'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="table-title">
                                    <h4>Preview Table</h4>
                                </div>
                            </div>
                            <table id="studentTbl">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Student ID</th>
                                        <th>Student Name</th>
                                        <th>Programme</th>
                                        <th>Intern Company</th>
                                        <th>Intern Job</th>
                                        <th>Total Weight</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="studentTbl">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <script src="../../js/classie.js"></script>
            <script src="../../js/bootstrap.js"> </script>
            <script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="../../js/dataTables.bootstrap.min.js"></script>
            <script src="https://cdn.datatables.net/fixedheader/3.3.1/js/dataTables.fixedHeader.min.js"></script>
            <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
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
                    let table = $('#studentTbl').DataTable({
                        "bLengthChange": false,
                        "info": false,
                        responsive: true
                    });

                });
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

            <script>
                function removeAllChildNodes(parent) {
                    while (parent.firstChild) {
                        parent.removeChild(parent.firstChild);
                    }
                }

                async function fetchStudResult() {
                    const internshipBatchID = document.getElementById("internshipBatchID").value;
                    const lectureID = document.getElementById("lectureID").value;
                    const getStudPhp = '../../app/DAL/ajaxGetStudListForEvaluation.php?lectureID=' + lectureID + '&internshipBatchID=' + internshipBatchID;
                    let getStudRespond = await fetch(getStudPhp);
                    let StudObj = await getStudRespond.json();
                    return StudObj;
                }
                async function insertStudDetail() {
                    const StudResult = await fetchStudResult();
                    const supervisorTable = document.getElementById("studentTbody");
                    let dataTable = $(`#studentTbl`).DataTable();

                    dataTable.clear().draw();

                    let count = 1;
                    if (StudResult !== "No Data Found") {
                        StudResult.forEach(i => {
                            dataTable.row.add([
                                count,
                                i.studentID,
                                i.studName,
                                i.programmeName,
                                i.cmpName,
                                i.jobTitle,
                                Number(i.finalScore) + ` / ` + Number(i.TotalWeight),
                                `<a type="button" class="btn btn-primary btn-xs dt-edit glyphicon glyphicon-pencil"aria-hidden="true" href="../../view/page/markStudInternScore.php?lectureID='${lectureID.value}'&facultyID='${i.facultyID}'&cmpName='${i.cmpName}'&studResultId='${i.studResultID}'&studid='${i.studentID}'&internshipBatchID='${internshipBatchID.value}'&studName='${i.studName}'&studProgrammeName='${i.programmeName}'&finalScore='${i.finalScore}'"></a>`
                            ]).draw();
                            count++;
                        })
                    } else {
                        //alert("No Data Found");
                        return;
                    }
                }
            </script>
</body>
<footer><?php include_once('includes/footer.php'); ?></footer>

</html>