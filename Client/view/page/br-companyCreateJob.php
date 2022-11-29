<?php
session_start();
$systemPathPrefix = $_SERVER['DOCUMENT_ROOT'].'/internshipSystem/client/';

require_once $systemPathPrefix."app/DAL/companyDAL.php";

//TODO: Check if user is logged in, get company ID
//$companyID = $_SESSION['cmpID'];
$companyID = 'CMP00008';

if(isset($_GET['inserted']) && isset($_GET['success']) && $_GET['success'] == 1 && $_GET['inserted'] == 1){
    echo "<script> 
            alert('New Internship Job Created Successfully.'); 

            window.location.href='br-companyJobList.php';
        </script>";
}else if(isset($_GET['inserted']) && isset($_GET['failed']) && $_GET['failed'] == 1 && $_GET['inserted'] == 0){
    echo "<script> 
            alert('New Internship Job Created Failed.\\nPlease Try Again.');

            window.location.href='br-companyJobList.php';
        </script>";
}

//Get Company Info
try{
    $companyInfo = getCompanyDetails($companyID);
    $companyFields = $companyInfo[0]['cmpFieldsArea'];
    
    $getCmpRemainingQuota = getRemainQuota($companyID);

    if($getCmpRemainingQuota == null){
        echo "<script> 
                alert('You have NO quota left to create new internship job. \\nPlease contact TARUMT ITP Committee for further assistance.');

                window.location.href = 'br-companyInfo.php';
            </script>"; 
    }

    $currQuota = $getCmpRemainingQuota[0]['TotalQuota'];
    $cmpMaxQuota = $getCmpRemainingQuota[0]['cmpNumberOfInternshipPlacements'];
    
    if($currQuota == '' || $currQuota == null || $cmpMaxQuota == '' || $cmpMaxQuota == null ){
        echo "<script> 
            alert('Something went wrong.\\nPlease Try Again.');

            window.location.href = 'br-companyInfo.php';
        </script>"; 

    }else{

        $quotaLeft =  (int)$cmpMaxQuota - (int)$currQuota;
    
        if($quotaLeft == 0 || $quotaLeft < 0 ){
            echo "<script> 
                alert('You have NO internship placements left.\\nPlease contact TARUMT ITP Committee for further assistance.'); 
    
                window.location.href='br-companyInfo.php';
            </script>";
        }
    }
}catch(PDOException $e){
    echo "<script> 
        alert('$e');
        window.location.href = 'br-companyInfo.php';
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
    <link rel="stylesheet" href="../../scss/br-companyCreateJob.css">
</head>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once "../../includes/sidebar.php"; ?>
        <?php include_once "../../includes/header.php"; ?>
        <div id="page-wrapper">
            <div class="main-page">
                <div class="forms">
                <h3 class="page-title">Job Posting</h3>
                <div class="form-grids row widget-shadow" data-example-id="basic-forms">

                <div class="wrapper">
                    <form action="../../app/BLL/cmpCreateJobBLL.php" onsubmit="setHiddenInputValue()" method="GET">
                        <input type="hidden" name="companyID" value="<?php echo $companyID; ?>">
                        <div class="title">
                            <h2 class="margin-top-20">
                                Job's Details
                            </h2>
                        </div>
                        <div class="horizon-wrap">
                            <div class="input-style width-45 name-address-group">
                            <label for="jobTitle">Job Title</label>
                            <input
                                type="text"
                                name="jobTitle"
                                placeholder="e.g. Java Programmer Internship"
                                pattern="[a-zA-Z ]{1,}"
                                title="Only Alphabets Is Allowed"
                                required
                            />
                            </div>

                            <div class="input-style width-45 name-address-group">
                            <!-- 
                                TODO: Check maximum number job placement allowed
                            -->
                            <label for="jobNumberPlacement"
                                >Number of Placement Needed (Max:
                                <span id="maxNoOfQuota"><?php echo $quotaLeft; ?></span>
                                )
                            </label>
                            <input
                                type="number"
                                name="jobNumberPlacement"
                                id="jobNumberPlacement"
                                placeholder="e.g. <?php echo $quotaLeft; ?>"
                                min="1"
                                max="<?php echo $quotaLeft; ?>"              
                                pattern="[0-100]{1,}"
                                title="Only Number Is Allowed"
                                required
                            />
                            </div>
                        </div>

                        <div class="vertical-wrap">
                            <div class="input-style width-100 name-address-group">
                            <label for="jobDesc">Job Description</label>
                            <input 
                                type="text" 
                                name="jobDesc" 
                                id="jobDesc" 
                                pattern="[a-zA-Z ]{1,}"
                                title="Only Alphabets Is Allowed"
                                onkeyup="countCharacter(this, document.getElementById('maxCharsDesc'))" maxlength="250" 
                                required />
                            <p class="charCountHint">
                                <span>* </span>Maximum 250 Characters (<span id="maxCharsDesc">0</span>/250)
                            </p>
                            </div>

                            <div class="input-style width-100 name-address-group">
                            <label for="jobQualification">Job Qualification</label>
                            <input
                                type="text"
                                name="jobQualification"
                                placeholder="e.g. Degree in Computer Science or Equivalent Qualification"
                                pattern="[a-zA-Z ]{1,}"
                                title="Only Alphabets Is Allowed"
                                maxlength="250"
                                onkeyup="countCharacter(this, document.getElementById('maxCharsQual'))"
                                required
                            />
                            <p class="charCountHint">
                                <span>* </span>Maximum 250 Characters (<span id="maxCharsQual"
                                >0</span
                                >/250)
                            </p>
                            </div>
                        </div>

                        <div class="horizon-wrap">
                            <div class="input-style width-45 name-address-group">
                            <label for="jobWorkLocation">Job Work Location</label>
                            <input
                                type="text"
                                name="jobWorkLocation"
                                placeholder="e.g. Setapak, Kuala Lumpur"
                                pattern="[a-zA-Z ,-]{1,}"
                                title="Only Alphabets, ',' and '-' Is Allowed"
                                required
                            />
                            </div>

                            <div class="input-style width-45 name-address-group">
                            <label for="jobAllowance">Job Allowance (RM)</label>
                            <input
                                type="number"
                                name="jobAllowance"
                                placeholder="1000"
                                pattern="[0-99999]{1,}"
                                title="Only Number Is Allowed"
                                min="0"
                                required
                            />
                            </div>
                        </div>

                        <div class="horizon-wrap">
                            <div class="input-style width-45 name-address-group">
                            <label for="jobWorkingDay">Job Working Day</label>
                            <div class="horizon-wrap-maintain">
                                <select id="workingDayStart" class="width-45-Imp" onchange="checkDayDiff()">
                                    <option value="Monday"  selected>Monday</option>
                                    <option value="Tuesday" >Tuesday</option>
                                    <option value="Wednesday" >Wednesday</option>
                                    <option value="Thursday" >Thursday</option>
                                    <option value="Friday" >Friday</option>
                                    <option value="Saturday" >Saturday</option>
                                    <option value="Sunday" >Sunday</option>
                                </select>
                                <span class="arrow-icon">&#129050</span>
                                <select id="workingDayEnd" class="width-45-Imp" onchange="checkDayDiff()">
                                    <option value="Monday" >Monday</option>
                                    <option value="Tuesday" >Tuesday</option>
                                    <option value="Wednesday" >Wednesday</option>
                                    <option value="Thursday" >Thursday</option>
                                    <option value="Friday"  selected>Friday</option>
                                    <option value="Saturday" >Saturday</option>
                                    <option value="Sunday" >Sunday</option>
                                </select>
                                <input type="hidden" name="jobWorkingDay" id="jobWorkingDay">
                            </div>
                            </div>

                            <div class="input-style width-45 name-address-group">
                            <label for="jobWorkingHour">Job Working Hour</label>
                            <div class="horizon-wrap-maintain">
                                <input type="time" id="startWorkingHour" min="07:30" max="22:00" value="09:00" class="width-45-Imp" onchange="checkTimeDiff()">

                                <span class="arrow-icon">&#129050</span>

                                <input type="time" id="endWorkingHour" min="07:30" max="22:00" value="18:00" class="width-45-Imp" onchange="checkTimeDiff()">
                                <input type="hidden" name="jobWorkingHour" id="jobWorkingHour">
                            </div>
                            
                            </div>
                        </div>

                        <div class="horizon-wrap">
                            <div class="name-address-group input-style width-45">
                            <label for="fieldAreaSelection">Job Field Area</label>
                            <select name="fieldAreaSelection" id="fieldAreaSelection">
                                <?php
                                    $fieldsArray = explode("-", $companyFields);

                                    foreach($fieldsArray as $fields){
                                        if($fields == "") continue;
                                        echo '<option value="'.$fields.'">'.$fields.'</option>';
                                    }
                                ?>
                            </select>
                            </div>

                            <div class="input-style width-45 name-address-group">
                            <label for="jobTrainingPeriod">Training Period (In Week)</label>
                            <input
                                type="number"
                                name="jobTrainingPeriod"
                                id="jobTrainingPeriod"
                                placeholder="Minimum 4 Weeks"
                                pattern="[0-99]{1,}"
                                title="Only Number Is Allowed"
                                min="4"
                                required
                            />
                            </div>
                        </div>

                        <hr />
                        <div class="title">
                            <h2 class="margin-top-20">
                                Job's Company Supervisor Details
                            </h2>
                        </div>

                        <div class="vertical-wrap">
                            <div class="input-style width-100 name-address-group">
                            <label for="jobSupervisor">Supervisor <span style="color:#f2891f; text-decoration:underline;">Name</span></label>
                            <input 
                            type="text" 
                            pattern="[a-zA-Z ]{1,}" 
                            title="Only Alphabets Is Allowed" 
                            name="jobSupervisor"
                            maxlength="50"
                            onkeyup="countCharacter(this, document.getElementById('jobSupervisorChar'))"
                            required />
                            <p class="charCountHint">
                                <span>* </span>Maximum 50 Characters (<span id="jobSupervisorChar"
                                >0</span>/50)
                            </p>
                            </div>                       
                        </div>
                        
                        <div class="horizon-wrap">
                            <div class="input-style width-45 name-address-group">
                                <label for="jobSupervisorEmail">Email</label>
                                <input
                                    type="email"
                                    name="jobSupervisorEmail"
                                    placeholder="e.g. Supervisor Email"
                                    required
                                />
                                </div>

                                <div class="input-style width-45 name-address-group">
                                <label for="jobSupervisorContact">Contact Number</label>
                                <input
                                    type="text"
                                    name="jobSupervisorContact"
                                    placeholder="E.g. 0123456789 - Without Dash"
                                    pattern="[0-9]{10,11}"
                                    title="Only Number Is Allowed"
                                    required
                                />
                            </div>
                        </div>

                        <hr />
                        <div class="title">
                            <h2 class="margin-top-20">
                                Job Responsibilities & Skills Required
                            </h2>
                        </div>


                        <div class="selection-group margin-top-20 select-style">
                            <label for="jobRespon">Job Responsibilities</label>
                            <div id="respon-row" class="task-row">
                                
                            </div>
                            <input type="hidden" name="jobResponStr" id="jobResponStr">
                            <input id="jobRespon"/>
                            <p class="charCountHint">
                                <span>* </span>Maximum 1500 Characters (<span id="maxCharRespon">0</span>/1500)
                            </p>
                            <input type="button" id="addNewJobRespon" value="Add New">
                        </div>

                        <div class="selection-group margin-top-20 select-style width-100">
                            <label for="jobSkills">Skills Required</label>
                            <div id="skills-row" class="task-row">
                                
                            </div>
                            <input type="hidden" name="jobSkillsStr" id="jobSkillsStr">
                            <input id="jobSkills" />
                            <p class="charCountHint">
                                <span>* </span>Maximum 250 Characters (<span id="maxCharSkill">0</span>/1500)
                            </p>
                            <input type="button" id="addNewJobSkills" value="Add New">
                        </div>
                        <hr />
                        <div class="button-group">
                            <input type="submit" class="clickable-btn" value="Create" />
                            <input type="reset" class="clickable-btn" value="Reset All" />
                        </div>
                    </form>
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

    document.getElementById('jobNumberPlacement').addEventListener('change', (e) => {
        if (e.target.value > <?php echo $quotaLeft; ?>) {
            alert("You Have Only <?php echo $quotaLeft; ?> Quota Left");
            e.target.value = <?php echo $quotaLeft; ?>;
        }
    });

    document.getElementById('jobTrainingPeriod').addEventListener('change', (e) => {
        if (e.target.value < 4) {
            alert("Minimum Training Period Is 4 Weeks");
            e.target.value = 4;
        }
    });

    document.getElementById('addNewJobRespon').addEventListener('click',() => {
        addNewRow('respon-row', document.getElementById('jobRespon'))
    });

    document.getElementById('addNewJobSkills').addEventListener('click',() => {
        addNewRow('skills-row', document.getElementById('jobSkills'))
    });
    
</script>
<script>
    //Display Current Character Count
    function countCharacter(input, display) {
        let count = input.value.length;
        display.innerHTML = `${count}`;
    }

    function checkDayDiff(){
        let startDay = document.getElementById('workingDayStart');
        let endDay = document.getElementById('workingDayEnd');
        let startDayIndex = startDay.selectedIndex;
        let endDayIndex = endDay.selectedIndex;
        
        if(startDayIndex > endDayIndex){
            alert('Start Day Cannot Be Greater Than End Day');
            startDay.selectedIndex = 0;
            endDay.selectedIndex = 4;
        }
    }

    function checkTimeDiff(){
        let startTime = document.getElementById('startWorkingHour');
        let endTime = document.getElementById('endWorkingHour');
        let [startHour, startMin] = startTime.value.split(':');
        let [endHour, endMin] = endTime.value.split(':');
        
        if(startHour > endHour){
            alert('Start Time Cannot Be Greater Than End Time');
            startTime.value = '09:00';
            endTime.value = '18:00';
        }else if(startHour == endHour){
            if(startMin > endMin){
                alert('Start Time Cannot Be Greater Than End Time');
                startTime.value = '09:00';
                endTime.value = '18:00';
            }
        }
    }

    function checkIsAlphabet(value){
      let regex = /^[0-9a-zA-Z ,]+$/;
      return regex.test(value);
    }

    let maxCharRespon = 0;
    let maxCharSkill = 0;

    function addNewRow(taskGroup, newTaskValue){
        let inputValue = newTaskValue.value;
        let taskRow = document.getElementById(taskGroup);

        if (inputValue === ""){
            alert("Please Enter A Task");
            return;
        }

        //Check whether total task row has exceed 1500 characters
        let checkExceed1500 = inputValue.length + (taskGroup == 'respon-row' ? maxCharRespon : maxCharSkill) > 1500;
        if(checkExceed1500){
            alert('Maximum 1500 Characters');
            document.getElementById('jobRespon').value = '';
            return;
        }

        //To count the total number of task
        let countTaskRow = taskRow.childElementCount + 1;
        if(countTaskRow > 10){
            alert('Maximum 10 Task Can Be Added');
            document.getElementById('jobRespon').value = '';
            return;
        }

        //Entering Alphabet Only
        if(!checkIsAlphabet(newTaskValue.value)){
            alert('Please Enter Alphabet, Number, Space, and ',' Only');
            newTaskValue.value = '';
            return;
        }
        
        let newTask = document.createElement("div");
        newTask.className = "row";
        newTask.innerHTML = `<p>${inputValue}</p><span class="deleteRow" onclick="deleteTaskRow(this)">✖</span>`;
        taskRow.appendChild(newTask);

        //To count the total number of characters
        let getTaskRowPElement = document.querySelectorAll(`#${taskGroup} .row p`);
        //Dynamic for display max character box
        let countDisplay = document.getElementById(`${taskGroup == 'respon-row' ? 'maxCharRespon' : 'maxCharSkill'}`);
        let tempCount = 0;

        tempCount = getTaskRowPElement[getTaskRowPElement.length - 1].innerHTML.length;
        
        if(taskGroup == 'respon-row'){
            maxCharRespon += tempCount;
        }else if(taskGroup == 'skills-row'){
            maxCharSkill += tempCount;
        }

        countDisplay.innerHTML = `${taskGroup == 'respon-row' ? maxCharRespon : maxCharSkill}`;

        newTaskValue.value = "";
        newTaskValue.focus();
    }

    function deleteTaskRow(taskGroup){
        let taskCharCount = taskGroup.parentElement.children[0].innerHTML.length;
        let taskGroupID = taskGroup.parentElement.parentElement.id;

        let countDisplay = document.getElementById(`${taskGroupID == 'respon-row' ? 'maxCharRespon' : 'maxCharSkill'}`);

        if(taskGroupID == 'respon-row'){
            maxCharRespon -= taskCharCount;
        }else if(taskGroupID == 'skills-row'){
            maxCharSkill -= taskCharCount;
        }

        countDisplay.innerHTML = `${taskGroupID == 'respon-row' ? maxCharRespon : maxCharSkill}`;

        taskGroup.parentElement.remove();
    };

    function setHiddenInputValue(){
        let workingDayStart = document.getElementById('workingDayStart');
        let workingDayEnd = document.getElementById('workingDayEnd');
        let jobWorkingDay = workingDayStart.value + '-' + workingDayEnd.value;
        document.getElementById('jobWorkingDay').value = jobWorkingDay;

        let startWorkingHour = document.getElementById('startWorkingHour');
        let endWorkingHour = document.getElementById('endWorkingHour');
        let jobWorkingHour = startWorkingHour.value + '-' + endWorkingHour.value;
        document.getElementById('jobWorkingHour').value = jobWorkingHour;

        let responValue = "";
        let responRow = document.querySelectorAll('#respon-row .row p');

        let skillsValue = "";
        let skillsRow = document.querySelectorAll('#skills-row .row p');


        responRow.forEach((task) => {
        responValue += task.innerHTML + "-";
        });

        skillsRow.forEach((task) => {
        skillsValue += task.innerHTML + "-";
        });

        document.getElementById('jobResponStr').value = responValue;
        document.getElementById('jobSkillsStr').value = skillsValue;

        if(responRow.length == 0 || skillsRow.length == 0){
            alert('Please enter a field area');
            return false;
        }
    }
</script>


</html>