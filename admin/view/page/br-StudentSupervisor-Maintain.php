<?php
session_start();
error_reporting(0);
include('../../includes/db_connection.php');

try{
    $db = new DBController();
    $getFaculty = $db->runQuery("SELECT * FROM Faculty");
}catch(Exception $e){
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
    <link rel="stylesheet" href="../../scss/br-studentSupervisorMaintain.css">
</head>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once "../../includes/sidebar.php"; ?>
        <?php include_once "../../includes/header.php"; ?>
        <div id="page-wrapper">
            <div class="main-page">
                <div class="forms">
                    <h3 class="page-title">Student & Supervisor Mapping Maintenance</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">

                        <!-- Tab Button -->
                        <div class="tab">
                            <button class="tablinks" onclick="changeTab(event, 'updateSupervisorMap')" id='defaultOpen'>Update Student-Supervisor</button>
                            <button class="tablinks" onclick="changeTab(event, 'ViewSupervisorMap')">View Student-Supervisor</button>
                        </div>

                        <!-- Tab Content 1-->
                        <div id="updateSupervisorMap" class="tabcontent">
                            <div class="search-group">
                                <!--                                    
                                //TODO: Require AJAX method to display searched supervisor         
                                -->
                                <div class="form-group">
                                    <label for="tab1-faculty">Faculty <span class="required-star">*</span></label>
                                    <select name="tab1-faculty" id="tab1-faculty" class="form-control" required="true">
                                        <option value="0" disabled selected>Select a Faculty</option>
                                        <?php
                                            foreach($getFaculty as $faculty){
                                                echo "<option value='".$faculty['facultyID']."'>".$faculty['facAcronym']."</option>";
                                            }
                                        ?>
                                    </select>

                                    <label for="curr-supervisor" style="margin-top: 20px;">Current Supervisor <span class="required-star">*</span></label>
                                    <input type="search" class="form-control" id="tab1-supervisor" name="curr-supervisor" placeholder="Enter Supervisor ID or Name...." required="true" onkeyup="displaySearchResult(this, this.id)" disabled>
                                    <div class="form-control" id="result-box-1">
                                        <!--                                    
                                        //TODO: Javascript to display result box need to fix         
                                        -->
                                    </div>
                                </div>

                                <span class="arrow-icon">&#129050</span>

                                <!--                                    
                                //TODO: Select intern batch first only allow to select students group        
                                -->
                                <div class="form-group">
                                    <label for="new-supervisor">New Supervisor | Available Slot <span class="required-star">*</span></label>
                                    <select name="new-supervisor" id="tab1-new-supervisor-select" class="form-control" required="true" disabled>                                   
                                    </select>
                                </div>
                            </div>

                            <div class="button-group">
                                <!--                                    
                                //TODO: onclick -> start retrieve student list and proceed mapping
                                -->
                                <button class="grey-btn" onclick="insertTable('1')" disabled id="tab1-search-btn">Search</button>
                                <input type="reset" class="clickable-btn" href="#" value="Reset All" onclick="resetInput('1')">
                            </div>
                            <hr>
                            <div class="info-group">
                                <p><span style="color:#313e85;">Current</span> Supervisor Available Slot: <span id="tab1-curr-supervisor">0 / 0</span></p>
                                <span>|</span>
                                <p><span style="color:#f2891f;">New</span> Supervisor Available Slot: <span id="tab1-new-supervisor">0 / 0</span></p>
                            </div>
                            <hr>
                            <div class="table-title">
                                <h4>Result Table</h4>
                            </div>
                            <div>
                                <table id="tab1-table">
                                    <thead>
                                        <th>Selection</th>
                                        <th>Internship Batch</th> 
                                        <th>Student ID</th>
                                        <th>Student Name</th>
                                        <th>Programme</th>
                                        <th>Year</th>
                                        <th>Semester</th>
                                        <th>Tutorial Group</th>
                                    </thead>
                                    <tbody id="tab1-table">
                                       
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <div class="update-group">
                                <!--                                    
                                //TODO: get all data from above and input into database
                                -->
                                <button class="grey-btn" disabled id="tab1-update-btn" onclick="tab1UpdateDB()">Update Mapping</button>
                            </div>
                        </div>

                        <!-- Tab Content 2-->
                        <div id="ViewSupervisorMap" class="tabcontent">
                            <div class="search-group">

                                <div class="form-group">
                                    <label for="faculty">Faculty <span class="required-star">*</span></label>
                                    <select name="faculty" id="tab2-faculty" class="form-control" required="true">
                                        <option value="0" disabled selected>Select a Faculty</option>
                                        <?php
                                            foreach($getFaculty as $faculty){
                                                echo "<option value='".$faculty['facultyID']."'>".$faculty['facAcronym']."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>

                                <!--                                    
                                //TODO: Require AJAX method to display searched supervisor         
                                -->
                                <div class="form-group">
                                    <label for="supervisor">Supervisor <span class="required-star">*</span></label>
                                    <input type="search" class="form-control" id="tab2-supervisor" name="supervisor" placeholder="Enter Supervisor ID or Name...." required="true" onkeyup="displaySearchResult(this, this.id)">                                  
                                    <div class="form-control" id="result-box-2">
                                        <!--                                    
                                        //TODO: Javascript to display result box need to fix         
                                        -->
                                    </div>
                                </div>


                            </div>

                            <div class="button-group">
                                <!--                                    
                                //TODO: onclick -> start retrieve student list and proceed mapping
                                -->
                                <button class="grey-btn" onclick="insertTable('2')" id="tab2-search-btn" disabled>Search</button>
                                <input type="reset" class="clickable-btn" href="#" value="Reset All" onclick="resetInput('2')">
                            </div>
                            <hr>
                            <div class="table-title">
                                <h4>Result Table</h4>
                            </div>
                            <div>
                                <table id="tab2-table">
                                    <thead>
                                        <th>#</th>
                                        <th>Internship Batch</th> 
                                        <th>Student ID</th>
                                        <th>Student Name</th>
                                        <th>Programme</th>
                                        <th>Year</th>
                                        <th>Semester</th>
                                        <th>Tutorial Group</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody id="tab2-table">
                                        <!-- <tr>
                                            <td><button class="remove button">Remove</button></td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer><?php include_once "../../includes/footer.php"; ?></footer>
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
        $('#tab1-table').DataTable({
            "bLengthChange": false,
            "info": false,         
        });
    });

    $(document).ready(function() {
        $('#tab2-table').DataTable({
            "bLengthChange": false,
            "info": false,
        });
    });
</script>
<script>
    document.getElementById("defaultOpen").click();

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

    function resetInput(tabID){
        let facultySelect = document.getElementById(`tab${tabID}-faculty`);
        let supervisorInput = document.getElementById(`tab${tabID}-supervisor`);
        let searchBtn = document.getElementById(`tab${tabID}-search-btn`);

        facultySelect.selectedIndex = "0";
        supervisorInput.value = "";

        facultySelect.disabled = false;
        supervisorInput.disabled = true;

        searchBtn.disabled = true;
        searchBtn.classList.add('grey-btn');
        searchBtn.classList.remove('clickable-btn');

        Object.keys(supervisorInput).forEach(i => {
            delete supervisorInput.dataset[i];
        });

        $(`#tab${tabID}-table`).DataTable().clear().draw();

        Object.keys(document.getElementById(`tab${tabID}-supervisor`).dataset).forEach(i => {
            delete document.getElementById(`tab${tabID}-supervisor`).dataset[i];
        });
        
        if(tabID = '1'){
            const newSupervisorSelect = document.getElementById('tab1-new-supervisor-select');
            const currSupervisorSlot = document.getElementById('tab1-curr-supervisor');
            const newSupervisorSlot = document.getElementById('tab1-new-supervisor');
            const updateBtn = document.getElementById('tab1-update-btn');

            //Remove All Options in Select
            newSupervisorSelect.innerHTML = "";

            newSupervisorSelect.disabled = true;

            tab1CurrLecturer = {};
            tab1NewLecturer = {};

            currSupervisorSlot.textContent = "0 / 0";
            newSupervisorSlot.textContent = "0 / 0";

            updateBtn.disabled = true;
            updateBtn.classList.add('grey-btn');
            updateBtn.classList.remove('clickable-btn');
        }
    }

</script>
<script>
    document.querySelector('body').addEventListener('click', () => {
        const getResultBox = document.querySelectorAll('.result-box');
        getResultBox.forEach(i => {
            i.style.display = "none";          
        });
    });

    function removeAllChildNodes(parent) {
        while (parent.firstChild) {
            parent.removeChild(parent.firstChild);
        }
    }

    //Change Tab 1 New Supervisor Slot
    document.getElementById('tab1-new-supervisor-select').addEventListener('change', e => {
        let currNo = e.target.options[e.target.selectedIndex].dataset.currno;
        let maxNo = e.target.options[e.target.selectedIndex].dataset.maxno;
        let newSupervisorSlot = document.getElementById("tab1-new-supervisor");

        newSupervisorSlot.textContent = `${currNo} / ${maxNo}`;
    });

    //Change Tab 1 Faculty
    document.getElementById('tab1-faculty').addEventListener('change', e => {
        document.getElementById('tab1-supervisor').disabled = false;
    })

    //Change Tab 2 Faculty
    document.getElementById('tab2-faculty').addEventListener('change', e => {
        document.getElementById('tab2-supervisor').disabled = false;
    })

    //Change Supervisor Option and Re-store the new lecturer object
    document.getElementById('tab1-new-supervisor-select').addEventListener('change', () => {
        const select = document.getElementById('tab1-new-supervisor-select');
    
        tab1NewLecturer = {};
    
        tab1NewLecturer = {
            lecturerID: select.options[select.selectedIndex].value,
            currNo: select.options[select.selectedIndex].dataset.currno,
            maxNo: select.options[select.selectedIndex].dataset.maxno
        }

        document.querySelectorAll("#tab1-table input[type='checkbox']").forEach(i => {
            i.checked = false;
        });
        
    })

    //For Tab 1 Check or Uncheck Action
    function getAllCheckBox(checkboxInput){
        let checkbox = document.querySelectorAll("#tab1-table input:checked");
        let updateMap = document.getElementById('tab1-update-btn');

        if(checkboxInput.checked == false){
            tab1NewLecturer['currNo'] = tab1NewLecturer['currNo'] - 1;
            tab1CurrLecturer['currNo'] = tab1CurrLecturer['currNo'] + 1;

            document.getElementById('tab1-curr-supervisor').textContent = `${tab1CurrLecturer['currNo']} / ${tab1CurrLecturer['maxNo']}`;

            document.getElementById('tab1-new-supervisor').textContent = `${tab1NewLecturer['currNo']} / ${tab1NewLecturer['maxNo']}`;
        }

        if(checkbox.length > 0){
            updateMap.classList.add('clickable-btn');
            updateMap.classList.remove('grey-btn');
            updateMap.disabled = false;
        }else{
            updateMap.classList.remove('clickable-btn');
            updateMap.classList.add('grey-btn');
            updateMap.disabled = true;
            return;
        }

        if(tab1NewLecturer['currNo'] == tab1NewLecturer['maxNo']){
            checkboxInput.checked = false;
            alert("You have selected more than the maximum number of students allowed for this supervisor");
            return;
        }else if (tab1NewLecturer['currNo'] < tab1NewLecturer['maxNo'] && checkboxInput.checked == true){
            tab1NewLecturer['currNo'] = Number.parseInt(tab1NewLecturer['currNo']) + 1;
            tab1CurrLecturer['currNo'] = Number.parseInt(tab1CurrLecturer['currNo']) - 1;

            document.getElementById('tab1-curr-supervisor').textContent = `${tab1CurrLecturer['currNo']} / ${tab1CurrLecturer['maxNo']}`;

            document.getElementById('tab1-new-supervisor').textContent = `${tab1NewLecturer['currNo']} / ${tab1NewLecturer['maxNo']}`;
        }
    }

    async function tab1UpdateDB(){
        let tab1Table = document.querySelectorAll('#tab1-table tr td input:checked');
        let selectedNewSupervisor = document.getElementById('tab1-new-supervisor-select');
        //New Supervisor
        let newSupervisorID = selectedNewSupervisor.value;
        let newSupervisorCurrNo = tab1NewLecturer['currNo'];

        //Current Supervisor
        let currSupervisorID = tab1CurrLecturer['lecturerID'];
        let currSupervisorCurrNo = tab1CurrLecturer['currNo'];
        let currSupervisorName = document.getElementById('tab1-supervisor').value;

        let studentIDArr = [];
        let confirm = window.confirm(`Are you sure you want to update the NEW mapping?`);

        if(confirm){
            tab1Table.forEach(i => {
                studentIDArr.push(i.parentNode.parentNode.childNodes[2].innerText);
            })
    
            let url = `../../app/DAL/ajaxMapUpdateTab1UpdateMap.php?newLectureID=${newSupervisorID}&oldLectureID=${currSupervisorID}&oldLectureName=${currSupervisorName}&studentIDArr=${JSON.stringify(studentIDArr)}&tab1=true`;
            
            let response = await fetch(url);
            let data = await response.json();
    
            if(data == "Success"){
                alert("Update Successfully");
                resetInput('1');
            }else{
                alert("Update Failed");
            }
        }else{
            return;
        }
        
    }

    //Tab 1 Store Lecturer Object
    let tab1CurrLecturer = {};
    let tab1NewLecturer = {};

    //Search Result on Search Bar
    function inputSearchResult(tabID, resultBox) {
        const getSearchResultArr = document.getElementById(resultBox).childNodes;
        const getSearchBar = document.getElementById(tabID);
        const getResultBox = document.getElementById(resultBox);
        const currSupervisorSlot = document.getElementById("tab1-curr-supervisor");
        let facultyID = document.getElementById(`tab${tabID == "tab1-supervisor" ? '1' : '2'}-faculty`).value;
        
        if (getSearchResultArr.length > 0) {
            for (let i = 0; i < getSearchResultArr.length; i++) {
                getSearchResultArr[i].addEventListener('click', (list) => {
                    getSearchBar.value = list.target.innerText;
                    getResultBox.style.display = 'none';
                        
                        getSearchBar.setAttribute("data-lecturerid", list.target.dataset.lecturerid);

                        if(tabID == "tab1-supervisor"){
                            currSupervisorSlot.textContent = `${list.target.dataset.currno} / ${list.target.dataset.maxno}`;
                            getSearchBar.setAttribute("data-currno", list.target.dataset.currno);
                            getSearchBar.setAttribute("data-maxno", list.target.dataset.maxno);
                            tab1CurrLecturer = {
                                lecturerID: list.target.dataset.lecturerid,
                                currNo: list.target.dataset.currno,
                                maxNo: list.target.dataset.maxno
                            }
                            tab1InsertLecturerData(facultyID, list.target.dataset.lecturerid)
                        }
                        
                        getSearchBar.disabled = true;

                        const searchBtn = document.getElementById(`tab${tabID == 'tab1-supervisor' ? '1' : '2'}-search-btn`);
                        searchBtn.disabled = false;
                        searchBtn.classList.remove('grey-btn');
                        searchBtn.classList.add('clickable-btn');
                });
            }
        } else {
            return;
        }
    }

    //Tab 1 Retrieve Lecturer Data From the Faculty
    async function tab1InsertLecturerData(facultyID, lecturerID){
        let newSupervisorSelect = document.getElementById("tab1-new-supervisor-select");

        let url = `../../app/DAL/ajaxMapUpdateSearchBar.php?facultyID=${facultyID}&lecturerID=${lecturerID}&selection=true`;
        let response = await fetch(url);
        let data = await response.json();

        removeAllChildNodes(newSupervisorSelect);

        if(data != "No Data Found"){
            data.forEach(i => {
                let option = document.createElement("option");
                option.value = i.lecturerID;
                option.textContent = `${i.lecName} | ${i.currNoOfStudents} / ${i.maxNoOfStudents}`;
                option.setAttribute("data-currno", i.currNoOfStudents);
                option.setAttribute("data-maxno", i.maxNoOfStudents);
                option.setAttribute("data-lecname", i.lecName);
                newSupervisorSelect.appendChild(option);
            });

            let currNo = newSupervisorSelect.childNodes[0].dataset.currno;
            let maxNo = newSupervisorSelect.childNodes[0].dataset.maxno;
            let newSupervisorSlot = document.getElementById("tab1-new-supervisor");

            newSupervisorSlot.textContent = `${currNo} / ${maxNo}`;

            tab1NewLecturer = {
                lecturerID: newSupervisorSelect.childNodes[0].value,
                currNo: newSupervisorSelect.childNodes[0].dataset.currno,
                maxNo: newSupervisorSelect.childNodes[0].dataset.maxno
            }
            
        }else{
            let option = document.createElement("option");
            option.value = "0";
            option.textContent = "No Data Found";
            newSupervisorSelect.appendChild(option);
        }
    }

    async function insertTable(tabID){
        const currLecturerID = document.getElementById(`tab${tabID}-supervisor`).dataset.lecturerid;
        let dataTable = $(`#tab${tabID}-table`).DataTable();
        const searchBtn = document.getElementById(`tab${tabID}-search-btn`);

        let url = `../../app/DAL/ajaxMapUpdateInsertTable.php?lecturerID=${currLecturerID}&insertTable=true&tab1=true`;
        let response = await fetch(url);
        let data = await response.json();

        if(data != "No Data Found"){
            if(tabID == '1'){
                data.forEach(i => {
                    dataTable.row.add([
                        `<input type="checkbox" onclick='getAllCheckBox(this)' value="${i.studentID}">`,
                        i.internshipBatchID,
                        i.studentID,
                        i.studName,
                        i.programmeAcronym,
                        i.studentYear,
                        i.studentSemester,
                        i.tutorialGroupNo
                    ]).draw();
                })  
                document.getElementById('tab1-new-supervisor-select').disabled = false;   
            }else if(tabID == '2'){
                data.forEach(i => {
                    let rowNo = dataTable.context[0].aoData.length + 1;

                    dataTable.row.add([
                        rowNo,
                        i.internshipBatchID,
                        i.studentID,
                        i.studName,
                        i.programmeAcronym,
                        i.studentYear,
                        i.studentSemester,
                        i.tutorialGroupNo,
                        `<button onclick="tab2RemoveStudent('${i.studentID}')" class="remove button">Remove</button>`
                    ]).draw();
                }) 
            }
    
            searchBtn.disabled = true;
            searchBtn.classList.add('grey-btn');
            searchBtn.classList.remove('clickable-btn');
            document.getElementById(`tab${tabID}-faculty`).disabled = true;
        }else{
            alert("No Data Found");
        }
    }

    async function tab2RemoveStudent(studentID){
        let confirm = window.confirm(`Are you sure you want to remove this student with student ID : ${studentID}?`);

        if(confirm){
            alert("Delete Successfully");
            let dataTable = $('#tab2-table').DataTable();
            let url = `../../app/DAL/ajaxMapUpdateTab2RemoveStudent.php?studentID=${studentID}&tab2=true`;
            let response = await fetch(url);
            let data = await response.json();
    
            if(data == "Success"){
                dataTable.row($(`#tab2-table tr:contains(${studentID})`)).remove().draw();
                alert("Delete Successfully");
            }else{
                alert("Delete Failed");
            }
        }else{
            return;
        }
    }

    //Show Result Box
    async function displaySearchResult(searchBarTab, tabID) {
        
        resultBoxNo = tabID == 'tab1-supervisor' ? "result-box-1" : "result-box-2";

        const getResultBox = document.getElementById(resultBoxNo);
        const respondResult = await fetchSearchBarData(tabID);
        const getSearchBarValue = searchBarTab.value;
        let resultArr = [];

        if (respondResult == "No Data Found" || getSearchBarValue == "") {
            getResultBox.style.display = 'none';
            return;
        }

        if(getResultBox.hasChildNodes()){
            removeAllChildNodes(getResultBox);
        }

        if(respondResult != "No Data Found" ){
            if(tabID == 'tab1-supervisor'){
                for (let i = 0; i < respondResult.length; i++) {
                    resultArr.push(
                       `<li 
                       data-lecturerid=${respondResult[i].lecturerID} 
                       data-facultyID=${respondResult[i].facultyID} 
                       data-currNo=${respondResult[i].currNoOfStudents} 
                       data-maxNo=${respondResult[i].maxNoOfStudents}>
                        ${respondResult[i].lecName}
                       </li>`
                    );
                }
            }else if(tabID == 'tab2-supervisor'){
                for (let i = 0; i < respondResult.length; i++) {
                    resultArr.push(
                        `<li data-lecturerid=${respondResult[i].lecturerID} data-facultyID=${respondResult[i].facultyID}>${respondResult[i].lecName}</li>`
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
    async function fetchSearchBarData(tabID) {
        let url;
        
        let facultyID = document.getElementById(`tab${tabID == 'tab1-supervisor' ? '1' : '2'}-faculty`).value;

        let getSearchInput = document.getElementById(`tab${tabID == 'tab1-supervisor' ? '1' : '2'}-supervisor`).value;

        const getResultBox = document.getElementById(`result-box-${tabID == 'tab1-supervisor' ? '1' : '2'}`);
        
        if (getSearchInput == '') {
            getResultBox.style.display = 'none';
            return;
        } else {
            if (tabID == 'tab1-supervisor') {
                url = `../../app/DAL/ajaxMapUpdateSearchBar.php?faculty=${facultyID}&supervisor=${getSearchInput}&tab1=true`;
            } else if (tabID == 'tab2-supervisor') {
                url = `../../app/DAL/ajaxMapUpdateSearchBar.php?faculty=${facultyID}&supervisor=${getSearchInput}&tab2=true`;
            }

            const response = await fetch(url);
            const data = await response.json();

            return data;
        }
    }
</script>


</html>