<?php
session_start();
error_reporting(0);
include "includes/db_connection.php";

//prettier client\view\page\br-StudentSupervisor-Manage.php --write
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
                    <form action="#">
                        <div class="horizon-wrap">
                            <div class="input-style width-45 name-address-group">
                            <label for="jobTitle">Job Title</label>
                            <input
                                type="text"
                                name="jobTitle"
                                placeholder="e.g. Java Programmer Internship"
                                required
                            />
                            </div>

                            <div class="input-style width-45 name-address-group">
                            <!-- 
                                TODO: Check maximum number job placement allowed
                            -->
                            <label for="jobNumberPlacement"
                                >Number of Placement Needed (Max:
                                <span id="maxNoOfQuota">2</span>
                                )
                            </label>
                            <input
                                type="number"
                                name="jobNumberPlacement"
                                placeholder="0"
                                min="0"
                                required
                            />
                            </div>
                        </div>

                        <div class="vertical-wrap">
                            <div class="input-style width-100 name-address-group">
                            <label for="jobDesc">Job Description</label>
                            <input type="text" name="jobDesc" required />
                            <p>
                                <span>* </span>Maximum 250 Characters (<span id="maxCharsDesc"
                                >0</span
                                >/250)
                            </p>
                            </div>

                            <div class="input-style width-100 name-address-group">
                            <label for="jobQualification">Job Qualification</label>
                            <input
                                type="text"
                                name="jobQualification"
                                placeholder="e.g. Degree in Computer Science or Relevant Qualification"
                                required
                            />
                            <p>
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
                                required
                            />
                            </div>

                            <div class="input-style width-45 name-address-group">
                            <label for="jobAllowance">Job Allowance (RM)</label>
                            <input
                                type="number"
                                name="jobAllowance"
                                placeholder="1000"
                                min="0"
                                required
                            />
                            </div>
                        </div>

                        <div class="horizon-wrap">
                            <div class="input-style width-45 name-address-group">
                            <label for="jobWorkingDay">Job Working Day</label>
                            <div class="horizon-wrap-maintain">
                                <select name="workingDaySelection" id="workingDaySelection" class="width-45-Imp">
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                </select>
    
                                <select name="workingDaySelection" id="workingDaySelection" class="width-45-Imp">
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                </select>
                            </div>
                            </div>

                            <div class="input-style width-45 name-address-group">
                            <label for="jobWorkingHour">Job Working Hour</label>
                            <div class="horizon-wrap-maintain">
                            <select class="width-45-Imp">
                                <?php 
                                for($hours=0; $hours<24; $hours++) {
                                    for($mins=0; $mins<60; $mins+=30) { 
                                        $time = str_pad($hours,2,'0',STR_PAD_LEFT).':'.str_pad($mins,2,'0',STR_PAD_LEFT);
                                        echo '<option value= "'.$time.'">'.$time.'</option>';
                                    }
                                }
                                ?>
                            </select>

                            <select class="width-45-Imp">
                                <?php 
                                for($hours=0; $hours<24; $hours++) {
                                    for($mins=0; $mins<60; $mins+=30) { 
                                        $time = str_pad($hours,2,'0',STR_PAD_LEFT).':'.str_pad($mins,2,'0',STR_PAD_LEFT);
                                        echo '<option value= "'.$time.'">'.$time.'</option>';
                                    }
                                }
                                ?>
                            </select>
                            </div>
                            
                            </div>
                        </div>

                        <div class="horizon-wrap">
                            <div class="name-address-group input-style width-45">
                            <label for="fieldAreaSelection">Job Field Area</label>
                            <select name="fieldAreaSelection" id="fieldAreaSelection">
                                <option value="IT">IT</option>
                                <option value="Marketing">Marketing</option>
                                <option value="Finance">Finance</option>
                                <option value="Accounting">Accounting</option>
                                <option value="Banking">Banking</option>
                            </select>
                            </div>

                            <div class="input-style width-45 name-address-group">
                            <label for="jobTrainingPeriod">Training Period (In Week)</label>
                            <input
                                type="number"
                                name="jobTrainingPeriod"
                                placeholder="0"
                                min="0"
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

                        <div class="horizon-wrap"></div>

                        <div class="selection-group margin-top-20 select-style">
                            <label for="jobRespon">Job Responsibilities</label>
                            <div id="respon-row" class="task-row">
                                <div class="row">
                                    <p>Handle Daily Bug Resolving</p>
                                    <span class="deleteRow" onclick="deleteTaskRow(this)">❌</span>
                                </div>
                                <div class="row">
                                    <p>Handle Daily Bug Resolving</p>
                                    <span class="deleteRow" onclick="deleteTaskRow(this)">❌</span>
                                </div>
                                <div class="row">
                                    <p>Handle Daily Bug Resolving</p>
                                    <span class="deleteRow" onclick="deleteTaskRow(this)">❌</span>
                                </div>
                            </div>
                            <input name="jobRespon" id="jobRespon" />
                            <input type="button" id="addNewJobRespon" value="Add New">
                        </div>

                        <div class="selection-group margin-top-20 select-style width-100">
                            <label for="jobSkills">Skills Required</label>
                            <div id="skills-row" class="task-row">
                                <div class="row">
                                    <p>Handle Daily Bug Resolving Handle Daily Bug Resolving Handle Daily Bug Resolving</p>              
                                    <span class="deleteRow" onclick="deleteTaskRow(this)">❌</span>
                                </div>
                                <div class="row">
                                    <p>Handle Daily Bug Resolving</p>
                                    <span class="deleteRow" onclick="deleteTaskRow(this)">❌</span>
                                </div>
                                <div class="row">
                                    <p>Handle Daily Bug Resolving</p>
                                    <span class="deleteRow" onclick="deleteTaskRow(this)">❌</span>
                                </div>
                            </div>
                            <input name="jobSkills" id="jobSkills" />
                            <input type="button" id="addNewJobSkills" value="Add New">
                        </div>
                        <hr />
                        <div class="button-group">
                            <!-- 
                            TODO:Remove all disabled and, don't remove name, and date join field 
                            TODO:Remove grey-bg class
                            -->
                            <input type="submit" class="clickable-btn" value="Add" />

                            <!-- 
                            TODO: Use js, if yes, then move to next page, ask does the company details all correct? 
                            -->
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

    function searchInTable(tableID, inputID) {
        let input, filter, table, tr, td, i, txtValue;
        input = inputID;
        filter = input.value;
        table = tableID;
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[3];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    document.getElementById('addNewJobRespon').addEventListener('click',() => {
        addNewRow('respon-row', document.getElementById('jobRespon'))
    });

    document.getElementById('addNewJobSkills').addEventListener('click',() => {
        addNewRow('skills-row', document.getElementById('jobSkills'))
    });

    function addNewRow(taskGroup, newTaskValue){
        let value = newTaskValue.value;
        
        if (value === ""){
            alert("Please Enter A Task");
            return;
        }

        let taskRow = document.getElementById(taskGroup);
        let newTask = document.createElement("div");
        newTask.className = "row";
        newTask.innerHTML = `<p>${value}</p><span class="deleteRow" onclick="deleteTaskRow(this)">❌</span>`;
        taskRow.appendChild(newTask);
        newTaskValue.value = "";
    }

    function deleteTaskRow(taskGroup){
        taskGroup.parentElement.remove();
    };

</script>
<script>
 
</script>


</html>