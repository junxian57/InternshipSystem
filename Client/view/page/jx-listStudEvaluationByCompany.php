<?php
session_start();
error_reporting(0);
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
    <script src="../../js/toastr.min.js"></script>
    <link href="../../css/toastr.min.css" rel="stylesheet">
    <script src="../../js/customToastr.js"></script>

</head>
<style>
    .page-title {
        color: #f2891f;
        font-size: 2rem;
        font-weight: 600;
    }

    /* Style the tab */
    .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }

    .tab .tablinks {
        border-left: 1px solid black;
        border-top: 1px solid black;
        border-bottom: 1px solid black;
    }

    .tab .tablinks:last-child {
        border-right: 1px solid black;
    }

    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 9px 10px;
        transition: 0.3s;
        font-size: 1vw;
    }

    .tab button span {
        font-size: 1vw;
    }

    .tab button:hover {
        background-color: #ddd;
    }

    .tab button.active {
        background-color: #ccc;
    }

    .tabcontent {
        padding: 20px;
        border: 1px solid #ccc;
        border-top: none;
        -webkit-animation: fadeEffect 1s;
        animation: fadeEffect 1s;
        /*For Table*/
    }

    @-webkit-keyframes fadeEffect {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes fadeEffect {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .tabcontent .hint {
        color: #ff4500;
        font-size: 0.9rem;
        text-align: center;
    }

    .tabcontent .form-group {
        min-width: 43%;
    }

    .tabcontent .form-group .required-star {
        color: red;
    }

    .tabcontent .form-group .form-control {
        font-size: 16px;
        margin-top: 5px;
    }

    .tabcontent .margin-top-20 {
        margin-top: 20px;
    }

    .tabcontent .search-group {
        display: flex;
        position: relative;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
    }

    .tabcontent .search-group .arrow-icon {
        font-size: 2vw;
        color: #f2891f;
    }

    .tabcontent :is(#result-box-1, #result-box-2) {
        min-height: 200px;
        max-height: 130px;
        max-width: 43%;
        background-color: #ffffff;
        margin-top: 3px;
        overflow-y: auto;
        overflow-x: hidden;
        padding: 5px 10px;
        outline: none;
        display: none;
        position: absolute;
    }

    .tabcontent :is(#result-box-1, #result-box-2) li {
        padding: 5px;
        list-style-type: none;
        text-align: left;
    }

    .tabcontent :is(#result-box-1, #result-box-2) li:hover {
        background-color: #d8d7d6;
        cursor: pointer;
    }

    .tabcontent .button-group {
        padding: 1.2em 0;
    }

    .tabcontent .button-group .clickable-btn {
        cursor: pointer;
        background-color: #f2891f;
        padding: 10px 15px;
        color: #fff;
        outline: none;
        border: 1px solid #f2891f;
        letter-spacing: 1px;
        transition: all 0.1s ease-in-out;
    }

    .tabcontent .button-group .clickable-btn:hover {
        background-color: #f5ae67;
        color: #fff;
        border: 1px solid #f5ae67;
    }

    .tabcontent .button-group .clickable-btn:nth-child(2) {
        margin-left: 20px;
        background-color: #313e85;
        color: #fff;
        border: 1px solid #313e85;
        transition: all 0.1s ease-in-out;
    }

    .tabcontent .button-group .clickable-btn:nth-child(2):hover {
        background-color: #535ea6;
        color: #fff;
    }

    .tabcontent .info-group {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .tabcontent .info-group p {
        font-size: 1.2rem;
        font-weight: 600;
        margin: 0;
        max-width: 40%;
        min-width: 25%;
        text-align: center;
    }

    .tabcontent .info-group span {
        width: 10%;
        text-align: center;
        font-weight: 600;
        font-size: 1.2rem;
    }

    .tabcontent a.remove {
        color: red;
    }

    .tabcontent .update-group {
        display: flex;
        justify-content: flex-end;
    }

    .tabcontent .clickable-btn {
        cursor: pointer;
        background-color: #f2891f;
        padding: 10px 15px;
        color: #fff;
        outline: none;
        border: 1px solid #f2891f;
        letter-spacing: 1px;
        transition: all 0.1s ease-in-out;
    }

    .tabcontent .clickable-btn:hover {
        background-color: #f5ae67;
        color: #fff;
        border: 1px solid #f5ae67;
    }

    .tabcontent .grey-btn {
        background-color: grey;
        padding: 10px 15px;
        color: #fff;
        outline: none;
        border: 1px solid grey;
        letter-spacing: 1px;
        transition: all 0.1s ease-in-out;
    }

    .tabcontent .table-title {
        margin-top: 10px;
        font-size: 1.1em;
        text-align: center;
    }

    .tabcontent .table-title p {
        font-size: 0.8em;
        color: #ff4500;
    }

    .tabcontent .table-title input {
        width: 25%;
        padding: 5px;
        border: 1px solid #f2891f;
        outline: none;
        font-size: 0.8em;
    }

    .tabcontent .bs-example {
        margin-top: 1em;
    }

    .tabcontent :is(#tab1-table_wrapper, #tab2-table_wrapper) .row:first-child {
        margin-top: 1em !important;
    }

    .tabcontent .table-title~div {
        width: 100%;
    }

    .tabcontent table {
        width: 100% !important;
    }

    .tabcontent table th,
    .tabcontent table td {
        text-align: center;
        padding: 12px;
        vertical-align: middle;
        border: 1px solid #ddd;
        border-collapse: collapse;
        word-wrap: break-word;
    }

    .tabcontent table th {
        background-color: #eeeded;
    }

    .tabcontent table tbody tr {
        transition: all 0.5s;
    }

    .tabcontent table tbody tr:hover {
        background-color: rgb(235, 235, 235);
    }

    .tabcontent table tbody .button {
        width: -webkit-fit-content;
        width: -moz-fit-content;
        width: fit-content;
        padding: 0.3em 1em;
        border-radius: 5px;
        color: #ffffff;
        font-size: 16px;
        outline: none;
        border: none;
        transition: ease-in-out 0.2s;
    }

    @media only screen and (max-width: 1260px) {
        .tabcontent table tbody .button {
            min-width: -webkit-fit-content;
            min-width: -moz-fit-content;
            min-width: fit-content;
            max-width: 100%;
            padding: 0.3em 0.5em;
        }
    }

    .tabcontent table tbody .remove {
        background-color: #ff4500;
    }

    .tabcontent table tbody .remove:hover {
        background-color: #f5891d;
        color: #fff;
    }
</style>

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
                            <button class="tablinks" id="activeTab" onclick="changeTab(event, 'RubricCmpTbl')">Evaluation By Company</button>
                        </div>
                        <input id="companyID" value="<?php echo $_SESSION['companyID'] ?>" hidden> </input>

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
                                        <th>Job Title</th>
                                        <th>Job Description</th>
                                        <th>Total Score</th>
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
                async function fetchStudResult() {
                    const internshipBatchID = document.getElementById("internshipBatchID").value;
                    const companyID = document.getElementById("companyID").value;
                    const getStudPhp = '../../app/DAL/ajaxGetStudListForEvaluation.php?companyID=' + companyID + '&internshipBatchID=' + internshipBatchID;
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
                                i.jobTitle,
                                i.jobDescription,
                                Number(i.finalScore) + `/ ` + Number(i.TotalWeight),
                                `<a type="button" class="btn btn-primary btn-xs dt-edit glyphicon glyphicon-pencil"aria-hidden="true" href="../../view/page/jx-markStudInternScore.php?facultyID='${i.facultyID}'&companyID='${companyID.value}'&internJobID='${i.internJobID}'&studResultId='${i.studResultID}'&studid='${i.studentID}'&internshipBatchID='${internshipBatchID.value}'&studName='${i.studName}'&studProgrammeName='${i.programmeName}'&finalScore='${i.finalScore}"></a>`
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