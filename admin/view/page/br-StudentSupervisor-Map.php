<?php
$systemPathPrefix = $_SERVER['DOCUMENT_ROOT'] . '/InternshipSystem/admin/';

require_once $systemPathPrefix . "app/DAL/studentMapDAL.php";

if (session_status() != PHP_SESSION_ACTIVE) session_start();

try {
    if (!isset($_SESSION['adminID'])) {
        if (!isset($_SESSION['committeeID'])) {
            echo "<script>
                window.location.href = 'adminLogin.php';
            </script>";
        }
    }

    $getInternBatch = getInternshipBatch();
} catch (Exception $e) {
    echo '<script>alert("Database Connection Error")</script>';
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
    <link rel="stylesheet" href="../../scss/br-studentSupervisorMap.css">
</head>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once('../../includes/sidebar.php'); ?>
        <?php include_once('../../includes/header.php'); ?>
        <div id="page-wrapper">
            <div class="main-page">
                <div class="forms">
                    <h3 class="page-title">Student & Supervisor Mapping</h3>

                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">

                        <!-- Tab Button -->
                        <div class="tab">
                            <button class="tablinks tab1" onclick="changeTab(event, 'StudentToSupervisor')" id='defaultOpen'>Assign Students <span class="arrow-icon">&#129050</span> Supervisors</button>
                            <button class="tablinks tab2" onclick="changeTab(event, 'SupervisorToStudent')">Assign Supervisors <span class="arrow-icon">&#129050</span> Students</button>
                            <button class="tablinks tab3" onclick="changeTab(event, 'AutomatedMap')">Automated Mapping</button>
                        </div>

                        <!-- Tab Content 1-->
                        <div id="StudentToSupervisor" class="tabcontent">
                            <div class="search-group">
                                <div class="form-group">
                                    <label for="supervisor">Search Supervisor <span class="required-star">*</span></label>
                                    <input type="search" class="form-control" id="tab1-supervisor" name="supervisor" placeholder="Enter Any Relevant Keyword...." required="true" onkeyup="displaySearchResult(this, this.id)" data-lectureid="" disabled autocomplete="off">
                                    <div class="form-control result-box" id="result-box-1"> </div>
                                </div>

                                <span class="arrow-icon">&#129050</span>

                                <div class="form-group">
                                    <label for="internBatch-group">Internship Batch <span class="required-star">*</span></label>
                                    <select name="internBatch-group" id="tab1-internBatch-group" class="form-control" required="true" onchange="enableOther(document.getElementById('tab1-supervisor'), document.getElementById(this.id))">
                                        <option value="" selected disabled>Select Internship Batch</option>
                                        <?php
                                        foreach ($getInternBatch as $batch) {
                                            echo "<option value='" . $batch['internshipBatchID'] . "'>" . $batch['internshipBatchID'] . "</option>";
                                        }
                                        ?>
                                    </select>

                                    <label for="student-group" class="margin-top-20">Tutorial Group <span class="required-star">*</span></label>
                                    <select name="student-group" id="tab1-student-group" class="form-control" required="true" disabled onchange="changeStudentSlotNo()">
                                    </select>
                                </div>
                            </div>

                            <div class="button-group">
                                <button class="grey-btn" id="tab1-assign-btn" onclick="tab1MapTable()" disabled>Assign</button>
                                <input type="reset" class="clickable-btn" href="#" value="Reset All" onclick="resetInput(document.getElementById('tab1-supervisor'), document.getElementById('tab1-internBatch-group'), document.getElementById('tab1-student-group'))">
                            </div>
                            <hr>
                            <div class="info-group">
                                <p>Supervisor Current Slot: <span class="orange-font" id="tab1-supervisor-slot">0 / 0</span></p>
                                <span>|</span>
                                <p>Student Group Left Slot: <span class="orange-font" id="tab1-student-slot">0 / 0</span></p>
                            </div>
                            <hr>
                            <div class="table-title">
                                <h4>Preview Table</h4>
                            </div>
                            <div>
                                <table class="table-view" id="tab1-top-table">
                                    <thead>
                                        <th>#</th>
                                        <th>Student ID</th>
                                        <th>Student Name</th>
                                        <th>Supervisor</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody id="tab1-preview-table">
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <div class="update-group">
                                <button class="grey-btn" id="tab1-update-btn" onclick="tab1UpdateMapDb()" disabled>Update Mapping</button>
                            </div>
                        </div>

                        <!-- Tab Content 2-->
                        <div id="SupervisorToStudent" class="tabcontent">
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

                            <div class="button-group">
                                <button class="grey-btn" id="tab2-assign-btn" disabled>Assign</button>

                                <input type="reset" class="clickable-btn" value="Reset Field" onclick="resetInput(document.getElementById('tab2-student'), document.getElementById('tab2-internBatch-group'), document.getElementById('tab2-supervisor-group'))">
                            </div>
                            <hr>
                            <div class="table-title">
                                <h4>Preview Table</h4>
                            </div>
                            <div>
                                <table class="table-view" id="tab2-top-table">
                                    <thead>
                                        <th>#</th>
                                        <th>Student ID</th>
                                        <th>Faculty</th>
                                        <th>Programme</th>
                                        <th>Student Name</th>
                                        <th>Supervisor</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody id="tab2-preview-table">
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <div class="update-group">
                                <button class="blue-btn clickable-btn" onclick="dataTableClear('#tab2-top-table')">Clear</button>
                                <button class="grey-btn" id="tab2-update-btn" onclick="tab2NTab3UpdateMapDB(2)" disabled>Update Mapping</button>
                            </div>
                        </div>

                        <!-- Tab Content 3-->
                        <div id="AutomatedMap" class="tabcontent">
                            <div class="search-group">
                                <div class="form-group">
                                    <label for="internBatch-group">Internship Batch <span class="required-star">*</span></label>
                                    <select name="internBatch-group" id="tab3-internBatch-group" class="form-control" required="true" onchange="enableOther(document.getElementById('tab3-programme'), document.getElementById(this.id))">
                                        <option value="" selected disabled>Select Internship Batch</option>
                                        <?php
                                        foreach ($getInternBatch as $batch) {
                                            echo "<option value='" . $batch['internshipBatchID'] . "'>" . $batch['internshipBatchID'] . "</option>";
                                        }
                                        ?>
                                    </select>

                                </div>

                                <div class="form-group">
                                    <label for="programme">Search Programme <span class="required-star">*</span></label>
                                    <input type="search" class="form-control" id="tab3-programme" name="programme" placeholder="Enter Any Relevant Keyword...." required="true" onkeyup="displaySearchResult(this, this.id)" disabled>
                                    <div class="form-control result-box" id="result-box-3" autocomplete="off">
                                    </div>
                                </div>

                            </div>
                            <hr>
                            <div class="hint">
                                <p>Hint: Both Tables Below Are Scrollable </p>
                            </div>
                            <div class="checkbox-group">
                                <form id="supervisor-field">
                                    <fieldset>
                                        <legend>Supervisor Field - <span class="facAcronym-span"></span></legend>
                                        <div>
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Fulfilled / Max</th>
                                                        <th>Checkbox</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="tab3-small-table" id="tab3-supervisor-table">
                                                </tbody>
                                            </table>
                                        </div>
                                    </fieldset>
                                </form>

                                <span class="arrow-icon">&#129050</span>

                                <form id="student-field">
                                    <fieldset>
                                        <legend>Student Group Field - <span class="facAcronym-span"></span></legend>
                                        <!--Create a table with 3 column-->
                                        <div class="table-responsive">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Prog / Year / Tutorial</th>
                                                        <th>Left / Total</th>
                                                        <th>Checkbox</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="tab3-small-table" id="tab3-student-table">

                                                </tbody>
                                            </table>
                                        </div>
                                    </fieldset>
                                </form>

                            </div>
                            <div class="button-group">
                                <button class="grey-btn" id="tab3-assign-btn" disabled>Assign</button>
                                <input type="reset" class="clickable-btn" href="#" value="Reset All" onclick="resetInput(document.getElementById('tab3-programme'), document.getElementById('tab3-internBatch-group'), null, true)">
                            </div>
                            <hr>
                            <div class="table-title">
                                <h4>Preview Table</h4>
                            </div>
                            <div class="tables">
                                <table class="table-view" id="tab3-top-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Student ID</th>
                                            <th>Faculty</th>
                                            <th>Programme</th>
                                            <th>Tutorial Group</th>
                                            <th>Student Name</th>
                                            <th>Supervisor</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tab3-preview-table">
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <div class="update-group">
                                <button class="grey-btn" id="tab3-update-btn" onclick="tab2NTab3UpdateMapDB(3)" disabled>Update Mapping</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <footer><?php include_once('../../includes/footer.php'); ?></footer>
</body>

<script src="../../js/classie.js"></script>
<script src="../../js/bootstrap.js"> </script>
<script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../../js/dataTables.bootstrap.min.js"></script>
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
        let table = $('#tab1-top-table').DataTable({
            "searching": false,
            "bLengthChange": false,
            "info": false,
            "dom": 'lrtp',
        });
    });

    $(document).ready(function() {
        let table = $('#tab2-top-table').DataTable({
            "searching": false,
            "bLengthChange": false,
            "info": false,
            "dom": 'lrtp',
            "columnDefs": [{
                "targets": 5,
                "createdCell": function(td, cellData, rowData, row, col) {
                    $(td).attr('data-lectureid', function() {
                        return document.getElementById('tab2-supervisor-group').value;
                    });
                }
            }],
        });
    })

    $(document).ready(function() {
        let table = $('#tab3-top-table').DataTable({
            "searching": false,
            "bLengthChange": false,
            "info": false,
            "dom": 'lrtp',
            "columnDefs": [{
                "targets": 6,
                "createdCell": function(td, cellData, rowData, row, col) {
                    $(td).attr('data-lectureid', function() {
                        return tab3StoreLectureID;
                    });
                }
            }],
        });
    })
</script>
<script>
    document.getElementById("defaultOpen").click();

    function resetInput(valueInput, selectionInput1, selectionInput2 = null, deleteTable = false) {
        valueInput.value = "";
        selectionInput1.selectedIndex = "0";

        if (valueInput.id == "tab1-supervisor") {
            valueInput.disabled = true;
            selectionInput1.disabled = false;
            selectionInput2.disabled = true;
            removeAllChildNodes(selectionInput2);

            document.getElementById("tab1-supervisor-slot").textContent = "0 / 0";
            document.getElementById("tab1-student-slot").textContent = "0 / 0";

            let assignBtn = document.getElementById("tab1-assign-btn");
            assignBtn.disabled = false;
            assignBtn.classList.remove("grey-btn");
            assignBtn.classList.add("clickable-btn");

            document.getElementById('tab1-supervisor').disabled = true;
            document.getElementById('tab1-student-group').disabled = true;

            //Reset JSON Object
            tab1LectureSlotCount = {};

            let updateBtn = document.getElementById('tab1-update-btn');
            updateBtn.disabled = true;
            updateBtn.classList.remove('clickable-btn');
            updateBtn.classList.add('grey-btn');
            dataTableClear('#tab1-top-table');

            document.getElementById('tab1-assign-btn').disabled = true;
            document.getElementById('tab1-assign-btn').classList.remove('clickable-btn');
            document.getElementById('tab1-assign-btn').classList.add('grey-btn');

        } else if (valueInput.id == "tab2-student") {
            valueInput.disabled = true;
            selectionInput1.disabled = false;
            selectionInput2.disabled = true;
            removeAllChildNodes(selectionInput2);

            tab2LectureSlotCount = {};
            tab2StoreStudent = {};

            let updateBtn = document.getElementById('tab2-update-btn');
            updateBtn.disabled = true;
            updateBtn.classList.add('grey-btn');
            updateBtn.classList.remove('clickable-btn');

            dataTableClear("#tab2-top-table");

            document.getElementById('tab2-assign-btn').disabled = true;
            document.getElementById('tab2-assign-btn').classList.remove('clickable-btn');
            document.getElementById('tab2-assign-btn').classList.add('grey-btn');

        } else if (valueInput.id == "tab3-programme") {
            valueInput.disabled = true;
            selectionInput1.disabled = false;

            dataTableClear("#tab3-top-table");

            tab3LectureSlotCount = {};
            tab3StoreStudent = {};
            tab3StoreLectureID = "";

            let updateBtn = document.getElementById('tab3-update-btn');
            updateBtn.disabled = true;
            updateBtn.classList.add('grey-btn');
            updateBtn.classList.remove('clickable-btn');

            document.getElementById("tab3-programme").removeAttribute("data-programmeid");

            document.querySelectorAll(".facAcronym-span").forEach((item) => {
                item.textContent = "";
            });

            document.getElementById('tab3-assign-btn').disabled = true;
            document.getElementById('tab3-assign-btn').classList.remove('clickable-btn');
            document.getElementById('tab3-assign-btn').classList.add('grey-btn');
        }

        if (selectionInput2 != null) {
            selectionInput2.selectedIndex = 0;
        }

        if (deleteTable) {
            const tableArr = document.getElementsByClassName("tab3-small-table");
            for (let i = 0; i < tableArr.length; i++) {
                removeAllChildNodes(tableArr[i]);
            }
        }
    }

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

    document.querySelectorAll(".tab .tablinks").forEach((item) => {
        item.addEventListener('click', (tab) => {
            if (item.classList.contains('tab1')) {
                resetInput(
                    document.getElementById('tab1-supervisor'),
                    document.getElementById('tab1-internBatch-group'),
                    document.getElementById('tab1-student-group')
                );
            } else if (item.classList.contains('tab2')) {
                resetInput(
                    document.getElementById('tab2-student'),
                    document.getElementById('tab2-internBatch-group'),
                    document.getElementById('tab2-supervisor-group')
                );
            } else if (item.classList.contains('tab3')) {
                resetInput(
                    document.getElementById('tab3-programme'),
                    document.getElementById('tab3-internBatch-group'),
                    null,
                    true
                );
            }
        });
    });
</script>
<script>
    //Hide the Search Box
    document.querySelector('body').addEventListener('click', () => {
        const getResultBox = document.querySelectorAll('.result-box');
        getResultBox.forEach(i => {
            i.style.display = "none";
        });
    });

    function enableOther(inputBox, typeBox) {
        inputBox.disabled = false;
        typeBox.disabled = true;
    }

    //Search Result on Search Bar
    function inputSearchResult(tabID, resultBox) {
        const getSearchResultArr = document.getElementById(resultBox).childNodes;
        const getSearchBar = document.getElementById(tabID);
        const getResultBox = document.getElementById(resultBox);
        const supervisorSlot = document.getElementById("tab1-supervisor-slot");

        if (getSearchResultArr.length > 0) {
            for (let i = 0; i < getSearchResultArr.length; i++) {
                getSearchResultArr[i].addEventListener('click', (list) => {
                    getSearchBar.value = list.target.innerText;
                    getResultBox.style.display = 'none';

                    if (tabID == "tab1-supervisor") {
                        supervisorSlot.textContent = `${list.target.dataset.currno} / ${list.target.dataset.maxno}`;
                        getSearchBar.setAttribute("data-lectureid", list.target.dataset.lectureid);
                        getSearchBar.setAttribute("data-availableslot", list.target.dataset.maxno - list.target.dataset.currno);
                        getSearchBar.setAttribute("data-maxno", list.target.dataset.maxno);
                        tutorialGroupData(list.target.dataset.facultyid);
                        getSearchBar.disabled = true;
                    } else if (tabID == "tab2-student") {
                        getSearchBar.setAttribute("data-studentid", list.target.dataset.studentid);
                        getSearchBar.setAttribute("data-studname", decodeURIComponent(list.target.dataset.studname));
                        getSearchBar.setAttribute("data-facAcronym", list.target.dataset.facacronym);
                        getSearchBar.setAttribute("data-progAcronym", list.target.dataset.progacronym);
                        tab2SupervisorGroupData(list.target.dataset.facultyid);
                    } else if (tabID == "tab3-programme") {
                        getSearchBar.setAttribute("data-programmeid", list.target.dataset.programmeid);
                        tab3InsertTable(list.target.dataset.facultyid, list.target.dataset.programmeid);
                        document.getElementById('tab3-assign-btn').disabled = false;
                        document.getElementById('tab3-assign-btn').classList.add('clickable-btn');
                        document.getElementById('tab3-assign-btn').classList.remove('grey-btn');
                    }
                });
            }
        } else {
            return;
        }
    }

    //Show Result Box
    async function displaySearchResult(searchBarTab, tabID) {

        if (tabID == 'tab1-supervisor') {
            resultBoxNo = "result-box-1";
        } else if (tabID == 'tab2-student') {
            resultBoxNo = "result-box-2";
        } else if (tabID == 'tab3-programme') {
            resultBoxNo = "result-box-3";
        }

        const getResultBox = document.getElementById(resultBoxNo);
        const respondResult = await fetchSearchBarData(searchBarTab, tabID);
        const getSearchBarValue = searchBarTab.value;
        let resultArr = [];

        if (respondResult == "No Data Found" || getSearchBarValue == "") {
            getResultBox.style.display = 'none';
            return;
        }

        if (getResultBox.hasChildNodes()) {
            removeAllChildNodes(getResultBox);
        }

        if (respondResult != "No Data Found") {
            if (tabID == 'tab1-supervisor') {
                for (let i = 0; i < respondResult.length; i++) {
                    resultArr.push(
                        `<li data-facultyid=${respondResult[i].facultyID} data-currNo=${respondResult[i].currNoOfStudents} data-maxNo=${respondResult[i].maxNoOfStudents} data-lectureid=${respondResult[i].lecturerID}>${respondResult[i].facAcronym} : ${respondResult[i].lecName}</li>`
                    );
                }
            } else if (tabID == 'tab2-student') {
                for (let i = 0; i < respondResult.length; i++) {
                    resultArr.push(
                        `<li data-facultyID=${respondResult[i].facultyID} data-facAcronym=${respondResult[i].facAcronym} data-progAcronym=${respondResult[i].programmeAcronym} data-studName=${encodeURIComponent(respondResult[i].studName)} data-studentID=${respondResult[i].studentID}>${respondResult[i].studentID} : ${respondResult[i].studName}</li>`
                    );
                }
            } else if (tabID == 'tab3-programme') {
                for (let i = 0; i < respondResult.length; i++) {
                    resultArr.push(
                        `<li data-programmeID=${respondResult[i].programmeID} data-facultyID=${respondResult[i].facultyID}> ${respondResult[i].facAcronym} : ${respondResult[i].programmeName.substr(12)}</li>`
                    );
                }
            }
        } else {
            getResultBox.style.display = 'none';
            return;
        }

        getResultBox.style.display = 'block';
        getResultBox.innerHTML = resultArr.join('');
        inputSearchResult(tabID, resultBoxNo);
    }

    //Fetch Search Bar Data from DB
    async function fetchSearchBarData(searchBarTab, tabID) {
        const getSearchInput = searchBarTab.value;
        let resultBoxNo, url, internBatch;

        if (tabID == 'tab1-supervisor') {
            resultBoxNo = "result-box-1";
        } else if (tabID == 'tab2-student') {
            resultBoxNo = "result-box-2";
            internBatch = document.getElementById('tab2-internBatch-group').value;
        } else if (tabID == 'tab3-programme') {
            resultBoxNo = "result-box-3";
        }

        const getResultBox = document.getElementById(resultBoxNo);

        if (getSearchInput == '') {
            getResultBox.style.display = 'none';
            return;
        } else {
            if (tabID == 'tab1-supervisor') {
                url = '../../app/DAL/ajaxMapSearchBar.php?supervisor=' + getSearchInput;
            } else if (tabID == 'tab2-student') {
                url = `../../app/DAL/ajaxMapSearchBar.php?student=${getSearchInput}&internBatch=${internBatch}`;
            } else if (tabID == 'tab3-programme') {
                url = '../../app/DAL/ajaxMapSearchBar.php?programme=' + getSearchInput;
            }

            const response = await fetch(url);
            const data = await response.json();

            return data;
        }
    }

    //Tab 1 - Change Student Slot Number
    function changeStudentSlotNo() {
        let getStudent = document.getElementById("tab1-student-group");
        let getStudentSlot = document.getElementById("tab1-student-slot");
        let tutorialGroupArr = getStudent.childNodes;

        getStudentSlot.textContent = `${getStudent[getStudent.selectedIndex].dataset.noselectstudent} / ${getStudent[getStudent.selectedIndex].dataset.studentcount}`;
    }

    //Tab 1 Selection
    async function tutorialGroupData(facultyID) {
        const respondResult = await getTutorialGroupData(facultyID);
        const studentSelect = document.getElementById("tab1-student-group");
        const studentSlot = document.getElementById("tab1-student-slot");
        const defaultOption = document.createElement("option");

        if (studentSelect.hasChildNodes()) {
            removeAllChildNodes(studentSelect);
        }

        if (respondResult !== "No Data Found") {
            studentSelect.disabled = false;
            for (let i = 0; i < respondResult.length; i++) {
                const option = document.createElement("option");
                option.value = respondResult[i].tutorialGroupNo;
                option.setAttribute("data-noSelectStudent", respondResult[i].noSelectStudent);
                option.setAttribute("data-studentCount", respondResult[i].studentCount);
                option.setAttribute("data-tutorialGroupNo", respondResult[i].tutorialGroupNo);
                option.setAttribute("data-programmeID", respondResult[i].programmeID);

                option.innerText = `${respondResult[i].programmeAcronym} : Year ${respondResult[i].studentYear} Sem ${respondResult[i].studentSemester} Group ${respondResult[i].tutorialGroupNo}`;

                studentSelect.appendChild(option);
            }
            changeStudentSlotNo();

            document.getElementById('tab1-assign-btn').disabled = false;
            document.getElementById('tab1-assign-btn').classList.add('clickable-btn');
            document.getElementById('tab1-assign-btn').classList.remove('grey-btn');
        } else {
            const option = document.createElement("option");
            option.value = "No Data";
            option.innerText = "No Data";
            studentSelect.appendChild(option);
            studentSelect.disabled = true;

            studentSlot.textContent = "0 / 0";
        }
    }

    //Tab 1 Selection - Fetch Tutorial Group Data
    async function getTutorialGroupData(facultyID) {
        let internNo = document.getElementById("tab1-internBatch-group").value;
        let url = `../../app/DAL/ajaxMapSelectionGroup.php?facultyID=${facultyID}&internNo=${internNo}`;

        const response = await fetch(url);
        const data = await response.json();

        return data;
    }

    //Tab 2 Selection
    async function tab2SupervisorGroupData(facultyID) {
        const respondResult = await getTab2SupervisorGroupData(facultyID);
        const supervisorSelect = document.getElementById("tab2-supervisor-group");

        if (supervisorSelect.hasChildNodes()) {
            removeAllChildNodes(supervisorSelect);
        }

        if (respondResult !== "No Data Found") {
            supervisorSelect.disabled = false;
            for (let i = 0; i < respondResult.length; i++) {
                const option = document.createElement("option");
                option.value = respondResult[i].lecturerID;

                option.innerText = `${respondResult[i].facAcronym} : ${respondResult[i].lecName} - ${respondResult[i].currNoOfStudents} / ${respondResult[i].maxNoOfStudents}`;

                option.setAttribute("data-lecturername", respondResult[i].lecName);
                option.setAttribute("data-ableMapCount", respondResult[i].maxNoOfStudents - respondResult[i].currNoOfStudents);

                supervisorSelect.appendChild(option);

                document.getElementById('tab2-assign-btn').disabled = false;
                document.getElementById('tab2-assign-btn').classList.add('clickable-btn');
                document.getElementById('tab2-assign-btn').classList.remove('grey-btn');
            }
        } else {
            const option = document.createElement("option");
            option.value = "No Data";
            option.innerText = "No Data";
            supervisorSelect.appendChild(option);
            supervisorSelect.disabled = true;
        }
    }

    //Tab 2 Selection - Fetch Supervisor Data
    async function getTab2SupervisorGroupData(facultyID) {
        let url = `../../app/DAL/ajaxMapSelectionGroup.php?facultyID=${facultyID}&tab2=true`;

        const response = await fetch(url);
        const data = await response.json();

        return data;
    }

    //Tab 3 Programme
    async function tab3InsertTable(facultyID, programmeID) {
        const supervisorResult = await getTab3SupervisorTable(facultyID);
        const studentResult = await getTab3StudentTable(programmeID);
        const supervisorTable = document.getElementById("tab3-supervisor-table");
        const studentTable = document.getElementById("tab3-student-table");
        const getSpan = document.getElementsByClassName("facAcronym-span");

        if (supervisorTable.hasChildNodes()) {
            removeAllChildNodes(supervisorTable);
        }

        if (studentTable.hasChildNodes()) {
            removeAllChildNodes(studentTable);
        }

        if (supervisorResult !== "No Data Found" && studentResult !== "No Data Found") {
            //Change Faculty Acronym
            for (let k = 0; k < getSpan.length; k++) {
                getSpan[k].innerText = supervisorResult[0].facAcronym;
            }

            //Insert Supervisor Table Row
            for (let i = 0; i < supervisorResult.length; i++) {
                let trLeft = document.createElement("tr");
                trLeft.setAttribute("data-lecturerid", supervisorResult[i].lecturerID);
                trLeft.setAttribute("data-lecname", supervisorResult[i].lecName);
                trLeft.setAttribute("data-maxstudent", supervisorResult[i].maxNoOfStudents);
                trLeft.setAttribute("data-currstudent", supervisorResult[i].currNoOfStudents);
                trLeft.setAttribute("data-ablemapcount", supervisorResult[i].maxNoOfStudents - supervisorResult[i].currNoOfStudents);

                trLeft.innerHTML = `
                    <td>${supervisorResult[i].lecName}</td>
                    <td>${supervisorResult[i].currNoOfStudents} / ${supervisorResult[i].maxNoOfStudents}</td>
                    <td>
                        <input type="checkbox" name="${supervisorResult[i].lecturerID}" class="tab-3-checkbox">
                    </td>
                `;

                supervisorTable.appendChild(trLeft);
            }

            //Insert Student Table Row
            for (let j = 0; j < studentResult.length; j++) {
                let trRight = document.createElement("tr");
                trRight.setAttribute("data-tutorialgroup", studentResult[j].tutorialGroupNo);
                trRight.setAttribute("data-progid", studentResult[j].programmeID);
                trRight.setAttribute("data-noselectstudent", studentResult[j].noSelectStudent);
                trRight.setAttribute("data-studentcount", studentResult[j].studentCount);
                trRight.setAttribute('data-tutorialyear', studentResult[j].studentYear);

                trRight.innerHTML = `
                    <td>${studentResult[j].programmeAcronym} / ${studentResult[j].studentYear} / ${studentResult[j].tutorialGroupNo}</td>
                    <td>${studentResult[j].noSelectStudent} / ${studentResult[j].studentCount}</td>
                    <td>
                        <input type="checkbox" data-progAcronym="${studentResult[j].programmeAcronym}" data-tutorialGroup="${studentResult[j].tutorialGroupNo}" class="tab-3-checkbox">
                    </td>
                `;

                studentTable.appendChild(trRight);
            }

        } else {
            info("No Data Found");
            document.getElementById('tab3-programme').value = "";
            return;
        }
    }

    //Tab 3 - Fetch Supervisor Data
    async function getTab3SupervisorTable(facultyID) {
        let url = `../../app/DAL/ajaxMapSelectionGroup.php?facultyID=${facultyID}&tab3-supervisor=true`;

        const response = await fetch(url);
        const data = await response.json();

        return data;
    }

    //Tab 3 - Fetch Student Data
    async function getTab3StudentTable(programmeID) {
        let batchID = document.getElementById("tab3-internBatch-group").value;
        let url = `../../app/DAL/ajaxMapSelectionGroup.php?programmeID=${programmeID}&batchID=${batchID}&tab3-student=true`;

        const response = await fetch(url);
        const data = await response.json();

        return data;
    }

    function removeAllChildNodes(parent) {
        while (parent.firstChild) {
            parent.removeChild(parent.firstChild);
        }
    }
</script>
<script>
    function deleteRow(table, row) {
        let tabTable = $(`#${table}`).DataTable();
        tabTable.row(row.parentNode.parentNode).remove().draw();
        let tabUpdateBtn;

        if (table == 'tab1-top-table') {
            tabUpdateBtn = 'tab1-update-btn';

        } else if (table == 'tab2-top-table') {
            tabUpdateBtn = 'tab2-update-btn';

            //Remove Student
            delete tab2StoreStudent[row.parentNode.parentNode.childNodes[1].innerText];
            //Reset Lecture Count
            tab2LectureSlotCount[row.parentNode.parentNode.childNodes[5].getAttribute('data-lectureid')]++;
        } else if (table = 'tab3-top-table') {
            tabUpdateBtn = 'tab3-update-btn';

            //Remove Student
            delete tab3StoreStudent[row.parentNode.parentNode.childNodes[4].innerText].student[row.parentNode.parentNode.childNodes[1].innerText];
            //Add back count to student object
            tab3StoreStudent[row.parentNode.parentNode.childNodes[4].innerText].studentCount++;
            //Reset Lecture Count
            tab3LectureSlotCount[row.parentNode.parentNode.childNodes[6].getAttribute('data-lectureid')].slotCount++;
        }

        if (tabTable.row().count() === 0) {
            document.getElementById(tabUpdateBtn).disabled = true;
            document.getElementById(tabUpdateBtn).classList.add('grey-btn');
            document.getElementById(tabUpdateBtn).classList.remove('clickable-btn');
        }
    }

    function dataTableClear(tableID) {
        $(tableID).DataTable().clear().draw();

        if (tableID == "#tab2-top-table") {
            //Reset JSON Data
            tab2LectureSlotCount = {};
            tab2StoreStudent = {};
        } else if (tableID == "#tab3-top-table") {
            //Reset JSON Data
            tab3StoreStudent = {};
            tab3LectureSlotCount = {};
        }
    }

    //Tab 1 - Number for Preview Table Row
    let tab1LectureSlotCount = {};

    //Tab 1 - Map Supervisor and Student Data Into Preview Table
    async function tab1MapTable() {
        let lectureID = document.getElementById("tab1-supervisor").getAttribute("data-lectureid");
        let lectureSlot = document.getElementById("tab1-supervisor").getAttribute("data-availableslot");
        let maxLectureSlot = document.getElementById("tab1-supervisor").getAttribute("data-maxno");
        let internshipBatch = document.getElementById("tab1-internBatch-group").value;

        let studentGroup = document.getElementById("tab1-student-group");
        let tutorialGroupNo = studentGroup[studentGroup.selectedIndex].dataset.tutorialgroupno;
        let programmeID = studentGroup[studentGroup.selectedIndex].dataset.programmeid;

        let tab1previewBody = document.getElementById("tab1-preview-table");
        let dataTable = $('#tab1-top-table').DataTable();

        if (!studentGroup.hasChildNodes()) {
            info("No Tutorial Group Selected");
            return;
        }

        if (tab1previewBody.hasChildNodes()) {
            removeAllChildNodes(tab1previewBody);
        }

        let respondResult = await tab1GetStudentLectureData(lectureID, internshipBatch, tutorialGroupNo, programmeID);

        //Store Lecture Slot Count
        tab1LectureSlotCount[lectureID] = lectureSlot;

        //create table row and insert        
        if (respondResult != "No Data Found") {
            for (let i = 0; i < respondResult.length; i++) {
                //Set Row Index
                let rowNo = dataTable.context[0].aoData.length + 1;

                if (tab1LectureSlotCount[lectureID] > 0) {
                    dataTable.row.add([
                        rowNo,
                        respondResult[i].studentID,
                        respondResult[i].studName,
                        respondResult[i].lecName,
                        `<button class="remove" onclick="deleteRow('tab1-top-table', this)">Remove</button>`
                    ]).draw();

                    tab1LectureSlotCount[lectureID]--;
                    document.getElementById("tab1-supervisor-slot").innerText = `${ maxLectureSlot - tab1LectureSlotCount[lectureID]} / ${maxLectureSlot}`;
                }
            }

            let assignBtn = document.getElementById("tab1-assign-btn");
            assignBtn.disabled = true;
            assignBtn.classList.remove("clickable-btn");
            assignBtn.classList.add("grey-btn");

            document.getElementById('tab1-supervisor').disabled = true;
            document.getElementById('tab1-student-group').disabled = true;

            let updateBtn = document.getElementById('tab1-update-btn');
            updateBtn.disabled = false;
            updateBtn.classList.remove('grey-btn');
            updateBtn.classList.add('clickable-btn');

        } else {
            info("No Data Found");
        }

    }

    async function tab1GetStudentLectureData(lectureID, internshipBatch, tutorialGroupNo, programmeID) {
        let url = `../../app/DAL/ajaxMapTab1InsertTable.php?lectureID=${lectureID}&internshipBatch=${internshipBatch}&tutorialGroupNo=${tutorialGroupNo}&programmeID=${programmeID}&tab1-map=true`;

        const response = await fetch(url);
        const data = await response.json();

        return data;
    }

    //Tab 1 - Update Supervisor and Student Mapping
    async function tab1UpdateMapDb() {
        let confirm = window.confirm("Are you sure you want to update the map?");
        if (confirm == true) {
            let lecturerID = document.getElementById("tab1-supervisor").getAttribute("data-lectureid");
            let studentIDArr = document.querySelectorAll("#tab1-preview-table tr td:nth-child(2)");
            let studentIDTextArr = [];

            //Get Student ID Text
            studentIDArr.forEach((studentID) => {
                studentIDTextArr.push(studentID.innerText);
            });

            let responseResult = await tab1FetchUpdateMapDb(lecturerID, studentIDTextArr);

            if (responseResult == "Success") {
                addSuccess("Mapping Updated");
            } else {
                warning("Mapping Update Failed");
            }

            resetInput(
                document.getElementById('tab1-supervisor'),
                document.getElementById('tab1-internBatch-group'),
                document.getElementById('tab1-student-group')
            );

        } else {
            return;
        }
    }

    async function tab1FetchUpdateMapDb(lecturerID, studentIDTextArr) {
        let url = `../../app/DAL/ajaxMapTab1UpdateMap.php?lectureID=${lecturerID}&studentIDArr=${JSON.stringify(studentIDTextArr)}`;

        let response = await fetch(url);
        let data = await response.json();

        return data;
    }

    //Tab 2 - Number for Preview Table Row
    let tab2LectureSlotCount = {};
    let tab2StoreStudent = {};

    document.getElementById("tab2-assign-btn").addEventListener("click", () => {
        let student = document.getElementById("tab2-student");
        let studentID = student.getAttribute("data-studentid");
        let studentName = student.getAttribute("data-studname");
        let facAcronym = student.getAttribute("data-facacronym");
        let progAcronym = student.getAttribute("data-progacronym");

        let lectureOption = document.getElementById("tab2-supervisor-group");
        let lectureName = lectureOption[lectureOption.selectedIndex].dataset.lecturername;
        let lectureSlot = lectureOption[lectureOption.selectedIndex].dataset.ablemapcount;
        let lectureID = lectureOption.value;

        let internshipBatch = document.getElementById("tab2-internBatch-group").value;
        let tab2previewBody = document.getElementById("tab2-preview-table");

        let dataTable = $('#tab2-top-table').DataTable();

        //If lecture selection has no items
        if (!lectureOption.hasChildNodes()) {
            info("No Lecture Selected");
            return;
        }

        //Set Row Index
        let rowNo = dataTable.context[0].aoData.length + 1;

        //create table row and insert
        if (student.value == "") {
            return;
        } else {
            //Update Student Count
            if (tab2StoreStudent[studentID] == undefined) {
                tab2StoreStudent[studentID] = studentID;
            } else {
                info("Student Already Selected");
                student.value = "";
                return;
            }

            //Update Lecture Slot Count - JSON Object
            if (tab2LectureSlotCount[lectureID] == undefined) {
                tab2LectureSlotCount[lectureID] = --lectureSlot;
            } else if (tab2LectureSlotCount[lectureID] > 0) {
                tab2LectureSlotCount[lectureID]--;
            } else {
                info("Lecture Slot Full");
                delete tab2StoreStudent[studentID];
                return;
            }

            dataTable.row.add([
                rowNo,
                studentID,
                studentName,
                facAcronym,
                progAcronym,
                lectureName,
                `<button class="remove" onclick="deleteRow('tab2-top-table', this)">Remove</button>`
            ]).draw();

        }

        //Reset Student Input
        document.getElementById('tab2-update-btn').disabled = false;
        document.getElementById('tab2-update-btn').classList.remove('grey-btn');
        document.getElementById('tab2-update-btn').classList.add('clickable-btn');

        //Remove Attribute in Student Input
        Object.keys(student.dataset).forEach((key) => {
            delete student.dataset[key];
        });

        //Empty Student Input Value
        student.value = "";

    });

    //Tab 2 - Map Supervisor and Student Data Into Preview Table
    async function tab2NTab3UpdateMapDB(tabNo) {
        let confirm = window.confirm("Are you sure you want to update the map?");

        if (confirm == true) {
            let tabtr = document.querySelectorAll(`#tab${tabNo}-preview-table tr`);
            let studentLecMap = {};

            tabtr.forEach((tr) => {
                let td = tr.querySelectorAll("td");
                //If tabNo is 2, lecture ID is in 5th column
                //If tabNo is 3, lecture ID is in 6th column
                studentLecMap[td[1].innerHTML] = td[tabNo == 2 ? 5 : 6].getAttribute("data-lectureid");
            });

            let responseResult = await tab2NTab3FetchUpdateMapDb(studentLecMap);

            if (responseResult == "Success" && tabNo == 2) {
                resetInput(
                    document.getElementById(`tab${tabNo}-student`),
                    document.getElementById(`tab${tabNo}-internBatch-group`),
                    document.getElementById(`tab${tabNo}-supervisor-group`)
                );
                addSuccess("Map Updated");
            } else if (responseResult == "Success" && tabNo == 3) {
                resetInput(
                    document.getElementById('tab3-programme'), 
                    document.getElementById('tab3-internBatch-group'), 
                    null, true
                );
                tab3OpenMapSummary();
            } else {
                warning(`From ${responseResult} Onward, Map Update Failed`);
                return;
            }
        } else {
            return;
        }
    }

    //Tab 2 - Update Map
    async function tab2NTab3FetchUpdateMapDb(studentLecMap) {
        let url = `../../app/DAL/ajaxMapTab2NTab3UpdateMap.php?studentLecMap=${JSON.stringify(studentLecMap)}`;

        let response = await fetch(url);
        let data = await response.json();

        return data;
    }

    //Tab 3 - Number for Preview Table Row
    let tab3LectureSlotCount = {};
    let tab3StoreStudent = {};
    let tab3StoreLectureID;

    document.getElementById("tab3-assign-btn").addEventListener("click", async () => {
        let lectureGroup = document.querySelectorAll("#tab3-supervisor-table input:checked");
        let checkedTutorialGroup = document.querySelectorAll("#tab3-student-table input:checked");
        let studentMap;

        dataTableClear("#tab3-top-table");

        if (lectureGroup.length == 0) {
            info("No Lecture Selected");
            return;
        }

        if (checkedTutorialGroup.length != 0) {
            studentMap = await tab3FetchStudentForPreview();
        } else {
            info("No Student Selected");
            return;
        }

        //Store lecture id and name into tab3LectureSlotCount
        lectureGroup.forEach((lecture) => {
            let lectureRow = lecture.parentNode.parentNode;

            if (tab3LectureSlotCount[lectureRow.dataset.lecturerid] == undefined) {
                tab3LectureSlotCount[lectureRow.dataset.lecturerid] = {
                    "lecName": lectureRow.dataset.lecname,
                    "slotCount": lectureRow.dataset.ablemapcount,
                    "beforeCount": lectureRow.dataset.ablemapcount,
                    "maxSlot": lectureRow.dataset.maxstudent
                }
            }
        });

        let getNoSelectStudent = (tutorialNo) => {
            let noSelectStudent;
            document.querySelectorAll("#tab3-student-table tr").forEach((student) => {
                if (student.dataset.tutorialgroup == tutorialNo) {
                    noSelectStudent = student.dataset.noselectstudent;
                }
            });
            return noSelectStudent;
        };

        let getMaxStudent = (tutorialNo) => {
            let studentCount;
            document.querySelectorAll("#tab3-student-table tr").forEach((student) => {
                if (student.dataset.tutorialgroup == tutorialNo) {
                    studentCount = student.dataset.studentcount;
                }
            })
            return studentCount;
        };

        let getTutorialYear = (tutorialNo) => {
            let tutorialYear;
            document.querySelectorAll("#tab3-student-table tr").forEach((student) => {
                if (student.dataset.tutorialgroup == tutorialNo) {
                    tutorialYear = student.dataset.tutorialyear;
                }
            })
            return tutorialYear;
        };

        //Store Student into tab3StoreStudent
        for (let k = 0; k < studentMap.length; k++) {
            const student = studentMap[k];
            if (tab3StoreStudent[student.tutorialGroupNo] == undefined) {
                //Create object into tab3StoreStudent separate by student id
                tab3StoreStudent[student.tutorialGroupNo] = {
                    "student": {
                        [student.studentID]: {
                            "studentName": student.studName,
                            "facAcronym": student.facAcronym,
                            "progAcronym": student.programmeAcronym,
                            "tutorialGroupNo": student.tutorialGroupNo
                        }
                    },
                    "studentCount": 1,
                    "noselectstudent": getNoSelectStudent(student.tutorialGroupNo),
                    "maxStudent": getMaxStudent(student.tutorialGroupNo),
                    "tutorialGroup": student.tutorialGroupNo,
                    "programme": student.programmeAcronym,
                    "year": getTutorialYear(student.tutorialGroupNo)
                }
            } else {
                //Create object into tab3StoreStudent separate by student id
                tab3StoreStudent[student.tutorialGroupNo]["student"][student.studentID] = {
                        "studentName": student.studName,
                        "facAcronym": student.facAcronym,
                        "progAcronym": student.programmeAcronym,
                        "tutorialGroupNo": student.tutorialGroupNo
                    },
                    tab3StoreStudent[student.tutorialGroupNo]["studentCount"]++;
            }
        }

        let tab3previewBody = document.getElementById("tab3-preview-table");
        let dataTable = $('#tab3-top-table').DataTable();
        let j = 0;
        let m = 0;
        let countStudent = 0;
        let moveNextLecturer = false;

        //Control lecture position
        for (let i = 0; i < Object.keys(tab3LectureSlotCount).length; i++) {
            //Control tutorial group position
            for (; j < Object.keys(tab3StoreStudent).length;) {
                //If the tutorial group count is larger than m
                if (tab3StoreStudent[Object.keys(tab3StoreStudent)[j]].studentCount > m) {
                    //Control the student position
                    for (; m < tab3StoreStudent[Object.keys(tab3StoreStudent)[j]].studentCount;) {
                        //Control Lecture position by its SLOT COUNT
                        if (tab3LectureSlotCount[Object.keys(tab3LectureSlotCount)[i]].slotCount > 0) {
                            //Get Lecture ID for global variable
                            tab3StoreLectureID = Object.keys(tab3LectureSlotCount)[i];
                            //Get lecture object
                            let lecturer = tab3LectureSlotCount[Object.keys(tab3LectureSlotCount)[i]];

                            //Access student object key
                            let student = tab3StoreStudent[Object.keys(tab3StoreStudent)[j]];
                            let studentKey = Object.keys(student["student"])[m];

                            //Set Row Index
                            let rowNo = dataTable.context[0].aoData.length + 1;

                            dataTable.row.add([
                                rowNo,
                                studentKey,
                                student["student"][studentKey].facAcronym,
                                student["student"][studentKey].progAcronym,
                                student["student"][studentKey].tutorialGroupNo,
                                student["student"][studentKey].studentName,
                                lecturer.lecName,
                                `<button class="remove" onclick="deleteRow('tab3-top-table', this)">Remove</button>`
                            ]).draw();
                            //Reduce slot count after add map into table
                            lecturer.slotCount--;
                            //Increase student count after add map into table, for subtracting student group count
                            countStudent++;
                            //Increase the current group student position
                            m++;
                        } else {
                            //If the current lecture slot count is 0, exit third loop
                            moveNextLecturer = true;
                            break;
                        }
                    }

                    //If the current lecture slot count is 0, break the second loop, to ALLOW the first loop to move to next lecture
                    if (moveNextLecturer) {
                        break;
                    }

                } else {
                    //If current tutorial group is done, go to next tutorial group
                    //Subtract the student count from tutorial group count
                    tab3StoreStudent[Object.keys(tab3StoreStudent)[j]]["studentCount"] -= countStudent;
                    //Reset Student Count to 0
                    countStudent = 0;
                    //Reset the student control
                    m = 0;
                    //Move to next tutorial group
                    j++;
                }
            }
            //Reset the next lecturer control
            moveNextLecturer = false;
        }

        //Enable Update Mapping Button
        document.getElementById('tab3-update-btn').disabled = false;
        document.getElementById('tab3-update-btn').classList.remove('grey-btn');
        document.getElementById('tab3-update-btn').classList.add('clickable-btn');
        //Disable Assign Button
        document.getElementById('tab3-assign-btn').disabled = true;
        document.getElementById('tab3-assign-btn').classList.remove('clickable-btn');
        document.getElementById('tab3-assign-btn').classList.add('grey-btn');

    });

    //Tab 3 - Fetch Student for Preview
    async function tab3FetchStudentForPreview() {
        let checkedTutorialGroup = document.querySelectorAll("#tab3-student-table input:checked");
        let programmeID = document.querySelector("#tab3-programme").getAttribute("data-programmeid");
        let internshipID = document.querySelector("#tab3-internBatch-group").value;
        let tutorialGroupArr = [];

        checkedTutorialGroup.forEach((tutorialGroup) => {
            tutorialGroupArr.push(tutorialGroup.getAttribute('data-tutorialgroup'));
        });

        let url = `../../app/DAL/ajaxMapTab3GetStudent.php?programmeID=${programmeID}&internshipID=${internshipID}&tutorialGroup=${JSON.stringify(tutorialGroupArr)}`;

        let response = await fetch(url);
        let data = await response.json();

        return data;
    }

    async function tab3OpenMapSummary() {
        let form = document.createElement("form");
        form.setAttribute("method", "post");
        form.setAttribute("action", `../../view/page/br-StudentMap-summary.php`);
        form.setAttribute("target", "_blank");
        form.setAttribute("id", "tab3-temp-form");

        let input = document.createElement("input");
        input.setAttribute("type", "hidden");
        input.setAttribute("name", "student");
        input.setAttribute("value", JSON.stringify(tab3StoreStudent));

        let input2 = document.createElement("input");
        input2.setAttribute("type", "hidden");
        input2.setAttribute("name", "lecture");
        input2.setAttribute("value", JSON.stringify(tab3LectureSlotCount));

        form.appendChild(input);
        form.appendChild(input2);

        document.body.appendChild(form);
        form.submit();

        document.body.removeChild(form);

        addSuccess("Update Successfully");
    }
</script>

</html>