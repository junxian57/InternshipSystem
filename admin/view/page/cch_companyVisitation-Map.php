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

require_once('../../app/BLL/visitationMapBLL.php');
require_once("../../app/DTO/visitationMapDTO.php");
require_once("../../app/DAL/visitationMapDAL.php");

$visitationMapListDALObj  = new visitationMapDAL();
$visitationMapBllObj = new visitationMapBLL();

if (isset($_POST['SubmitButton']) && $_POST['SubmitButton'] == 'Add Supervisor Company Mapping') {
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $date = date('Y-m-d');
    $Visitation_CompanyID = $_POST['Visitation_AppMapID'];
    $Visitation_CriteriaID = $_POST['Visitation_CompanyID'];
    $CreateByID = $_SESSION['adminID'];
    $CreateByID = $_SESSION['committeeID'];
    $CreateDate = $date;
    $newcompanyvisitationMapList = new visitationMapDTO($Visitation_AppMapID, $Visitation_CompanyID, $CreateByID, $CreateDate);
    if (count($_POST['lecturerID']) == count($_POST['lecName'])) {
        $countRow = count($_POST['lecturerID']);
        for ($i = 0; $i < $countRow; $i++) {
            $newOfcompanyvisitationMapDto[] = new visitationCompanyListDTO($Visitation_AppMapID, $_POST['lecturerID'][$i], $_POST['lecName'][$i]);
        }
    }

    $visitationMapBllObj->AddvisitationMapList($newcompanyvisitationMapList, $newOfcompanyvisitationMapDto);
}

?>


<!DOCTYPE HTML>
<html>

<head>
    <title>ITP System | View Rubric Assessment</title>
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css">
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
    <link rel="stylesheet" href="../../scss/navtab.css">
</head>
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

    .button-group .clickable-btn:nth-child(3) {
        margin-left: 870px;
        background-color: #735ea6;
        color: #fff;
        border: 1px solid #735ea6;
        transition: all 0.1s ease-in-out;
    }

    .button-group .clickable-btn:nth-child(3):hover {
        background-color: #935ea6;
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

<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once('../../includes/sidebar.php'); ?>
        <?php include_once('../../includes/header.php'); ?>
        <div id="page-wrapper">
            <div class="main-page">
                <?php

                if ($_GET['status'] == 'failed') {
                    echo "<script> warning('List cant be added. Operation failed.');</script>";
                } elseif ($_GET['status'] == 'success') {
                    echo "<script> addSuccess('Add visitation List successful'); </script>";
                } elseif ($rubricAssmtBllObj->errorMessage != '') {
                    echo "<script> warning('$rubricAssmtBllObj->errorMessage'); </script>";
                }

                ?>

                <div class="forms ">
                    <h3 class="title1">Supervisor - Company mapping</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                        <!-- Tab Content 1 SupervisorCmpMappingTab-->
                        <div id="SupervisorCmpMappingTab" class="tabcontent">
                            <div class="form-title">
                                <h4>Supervisor & company Mapping Add</h4>
                            </div>

                            <div class="form-body">
                                <form method="post">
                                    <div class="search-group">
                                        <div class="form-group col-md-3"> <label for="exampleInput">Visitation ID</label><input type="text" id="Visitation_AppMapID" name="Visitation_AppMapID" class="form-control" value="<?php echo $visitationMapListDALObj->generateID() ?>" readonly="readonly"></div>
                                        <div class="form-group">
                                            <label for="internBatch-group">Company Visitation List <span class="required-star">*</span></label>
                                            <select name="Visitation_CompanyID" id="Visitation_CompanyID" class="form-control" required="true" onchange="getVisitationCompany();">
                                                <option value="" selected disabled>Select Visitation List</option>
                                                <?php
                                                include('includes/db_connection.php');
                                                $db_handle = new DBController();
                                                $query = "SELECT * FROM VisitationCompany";
                                                $results = $db_handle->runQuery($query);

                                                for ($i = 0; $i < count($results); $i++) {
                                                    echo "<option value='" . $results[$i]['Visitation_CompanyID'] . "'>" . $results[$i]['Visitation_CompanyID'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="table-title">
                                        <h4>Result Table</h4>
                                    </div>
                                    <div>
                                        <table id="tab1-table">
                                            <thead>
                                                <th>#</th>
                                                <th>Company Name</th>
                                                <th>Company State</th>
                                                <th>Company Address</th>
                                                <th>Company Conctact No</th>
                                                <th>Comapny Conctact Person</th>
                                            </thead>
                                            <tbody id="tab1-table2">

                                            </tbody>
                                        </table>
                                    </div>



                                    <div class="form-group col-md-12 checkbox-group">

                                        <fieldset>
                                            <legend>Select Lecturer Field </legend>
                                            <div>
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th>Lecturer ID</th>
                                                            <th>Lecturer Name</th>
                                                            <th>Gender</th>
                                                            <th>Conctact No</th>
                                                            <th>Position</th>
                                                            <th>CheckBox</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tab3-small-table" id="lec-table">
                                                        <?php
                                                        $db = new DBController();
                                                        $sql = "select * from Lecturer";
                                                        $result = $db->runQuery($sql);

                                                        if (count($result) > 0) {
                                                            foreach ($result as $company) {
                                                                $lecturerID  = $company['lecturerID'];
                                                                $lecName = $company['lecName'];
                                                                $lecGender = $company['lecGender'];
                                                                $lecContactNumber = $company['lecContactNumber'];
                                                                $lecJobPosition = $company['lecJobPosition'];
                                                                ?>
                                                                <tr data-lecturerID='<?php echo $lecturerID ?>' data-lecName='<?php echo $lecName ?>' data-gender='<?php echo $lecGender ?>' data-contactNo='<?php echo $lecContactNumber ?>' data-position='<?php echo $lecJobPosition ?>'>
                                                                    <td><?php echo $lecturerID ?></td>
                                                                    <td><?php echo $lecName ?></td>
                                                                    <td><?php echo $lecGender ?></td>
                                                                    <td><?php echo $lecContactNumber ?></td>
                                                                    <td><?php echo $lecJobPosition ?></td>
                                                                    <td><input type="checkbox" name="<?php echo $lecturerID ?>" class="tab-3-checkbox"></td>
                                                                </tr>
                                                        <?php
                                                            }
                                                        }

                                                        ?>
                                                </table>
                                            </div>
                                        </fieldset>


                                        <span class="arrow-icon">🠚</span>


                                        <fieldset>
                                            <legend>Existing Selected Lecturer Field </legend>
                                            <div class="table-responsive">
                                                <table name="test">
                                                    <thead>
                                                        <tr>
                                                            <th>Lecturer ID</th>
                                                            <th>Lecturer Name</th>
                                                            <th>Gender</th>
                                                            <th>Conctact No</th>
                                                            <th>Position</th>
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
                                    <div class="button-group">
                                        <a class="clickable-btn" id="assign-btn" onclick="assign()">Assign</a>
                                        <input type="text" readonly class="clickable-btn" href="#" value="Reset All Selected" onclick="resetSelect(document.getElementById('lec-table'), document.getElementById('selected-visitation-Company-List-table'),document.getElementById('Visitation_CompanyID'))">

                                    </div>


                                    <div class="form-group col-md-12 text-right"> <button type="submit" name="SubmitButton" id="SubmitButton" value="Add Supervisor Company Mapping" class="form-group btn btn-default">Save</button></div>
                                
                                </form>
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
                $(document).ready(function() {
                    let table = $('#tab1-table').DataTable({
                        "bLengthChange": false,
                        "info": false,
                        responsive: true
                    });
                });

                function disableOther(button) {
                    if (button !== 'showLeftPush') {
                        classie.toggle(showLeftPush, 'disabled');
                    }
                }

                async function fetchVisitCmpResult() {
                    const visitationID = document.getElementById("Visitation_CompanyID").value;
                    const getStudPhp = '../../app/DAL/ajaxGetCompanyList.php?Visitation_CompanyID=' + visitationID;
                    let getStudRespond = await fetch(getStudPhp);
                    let StudObj = await getStudRespond.json();
                    return StudObj;
                }

                async function getVisitationCompany() {
                    const StudResult = await fetchVisitCmpResult();
                    let dataTable = $(`#tab1-table`).DataTable();

                    dataTable.clear().draw();

                    $("#Visitation_CompanyID").attr("disabled", "disabled");
                    document.getElementById('Visitation_CompanyID').style = "pointer-events: none;";

                    let count = 1;
                    if (StudResult !== "No Data Found") {
                        StudResult.forEach(i => {
                            dataTable.row.add([
                                count,
                                i.cmpName,
                                i.cmpState,
                                i.cmpAddress,
                                i.cmpContactNumber,
                                i.cmpContactPerson

                            ]).draw();
                            count++;
                        })
                    } else {
                        //alert("No Data Found");
                        return;
                    }

                }

                function assign() {
                    var table = document.getElementById("lec-table");

                    const lecSelectedTable = document.getElementById("selected-visitation-Company-List-table");
                    const rCount = table.rows.length;
                    // var cmpvisittable = document.querySelectorAll("#tab-table2");
                    let dataTable = $(`#tab1-table`).DataTable();
                    for (var i = 0; i < table.rows.length; i++) {
                        if (table.rows[i].cells[5].children[0].checked) {
                            if (isExistingAssign(table.rows[i].getAttribute('data-lecturerID'))) {
                                let trRight = document.createElement("tr");
                                trRight.setAttribute("data-lecturerID", table.rows[i].getAttribute('data-lecturerID'));
                                trRight.setAttribute("data-lecName", table.rows[i].getAttribute('data-lecName'));
                                trRight.setAttribute("data-gender", table.rows[i].getAttribute('data-gender'));
                                trRight.setAttribute("data-contactNo", table.rows[i].getAttribute('data-contactNo'));
                                trRight.setAttribute("data-position", table.rows[i].getAttribute('data-genpositionder'));
                                trRight.innerHTML = `
                    <td>${table.rows[i].getAttribute('data-lecturerID')}<input hidden name="lecID[]" value="${table.rows[i].getAttribute('data-lecturerID')}"></input></td>
                    <td>${table.rows[i].getAttribute('data-lecName')}</td>
                    <td>${table.rows[i].getAttribute('data-gender')}</td>
                    <td>${table.rows[i].getAttribute('data-contactNo')}</td>
                    <td>${table.rows[i].getAttribute('data-position')}</td>
                    <td><button type="button" onClick="removeChildNode(this);">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				    </button>
                    
                    </td>
                `;
                                lecSelectedTable.appendChild(trRight);


                            }
                        }

                    }
                }

                function removeChildNode(currentRow) {
                    $(currentRow).closest('tr').remove();
                }

                function isExistingAssign(lecID) {
                    var table = document.getElementById("selected-visitation-Company-List-table");
                    var rCount = table.rows.length;
                    //console.log(table.rows[0].cells[1].getAttribute('data-lecName'));
                    var value_check = "";
                    for (var i = 0; i < table.rows.length; i++) {
                        if (table.rows[i].getAttribute('data-lecturerID') == lecID) {
                            return false;
                        }
                    }
                    return true;
                }

                function removeAllChildNodes(parent) {
                    while (parent.firstChild) {
                        parent.removeChild(parent.firstChild);
                    }
                }

                function resetSelect(table1, table2, input1) {
                    if (table2.hasChildNodes()) {
                        removeAllChildNodes(table2);
                    }

                    var rCount = table1.rows.length;
                    for (var i = 0; i < table1.rows.length; i++) {
                        if (table1.rows[i].cells[5].children[0].checked) {
                            table1.rows[i].cells[5].children[0].checked = false;
                        }
                    }

                    if (input1.id == "Visitation_CompanyID") {
                        document.getElementById('Visitation_CompanyID').removeAttribute('disabled');
                        document.getElementById('Visitation_CompanyID').style = "";
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
            <script src="../../js/classie.js"></script>
            <script src="../../js/bootstrap.js"> </script>

            <script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="../../js/dataTables.bootstrap.min.js"></script>
            <script src="https://cdn.datatables.net/fixedheader/3.3.1/js/dataTables.fixedHeader.min.js"></script>
            <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
</body>
<footer><?php include_once('includes/footer.php'); ?></footer>

</html>