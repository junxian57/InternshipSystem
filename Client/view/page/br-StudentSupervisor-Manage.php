<?php
session_start();
include('../../includes/db_connection.php');

try{
    $db = new DBController();
    $getInternBatch = $db->runQuery("SELECT * FROM InternshipBatch");
}catch(Exception $e){
    echo '<script>alert("Database Connection Error")</script>';
}

//Session get logged in LECTURER ID
$lecturerID = 'LEC00001';

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
    <link rel="stylesheet" href="../../scss/br-StudentSupervisor-Manage.css">
</head>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once "../../includes/sidebar.php"; ?>
        <?php include_once "../../includes/header.php"; ?>
        <div id="page-wrapper">
            <div class="main-page">
                <div class="forms">
                    <h3 class="page-title">Student Management</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">

                        <div id="ViewSupervisorMap" class="tabcontent">
                            <div class="search-group">

                                <!--                                    
                                //TODO: Require AJAX method to display searched supervisor         
                                -->
                                <div class="form-group">
                                    <label for="batch-number">Internship Batch Number <span class="required-star">*</span></label>
                                    <select name="batch-number" id="batch-number" class="form-control" required="true" onchange="enableBtn()">
                                        <option value="0" selected disabled>Select a Batch Number</option>
                                        <?php
                                            foreach($getInternBatch as $batch){
                                                echo "<option value='".$batch['internshipBatchID']."'>".$batch['internshipBatchID']."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>

                            </div>

                            <div class="button-group">
                                <!--                                    
                                //TODO: onclick -> start retrieve student list and proceed mapping
                                -->
                                <button class="grey-btn" id="search-btn" onclick="searchStudent()" disabled>Search</button>

                                <button class="clear-btn" id="clear-btn" onclick="resetAll()">Reset All</button>
                            </div>
                            <hr>
                            <div class="table-title">
                                <h4>Result Table</h4>
                            </div>
                            <div>
                                <table id="preview-table">
                                    <thead>
                                        <th>#</th>
                                        <th>Student ID</th>
                                        <th>Student Name</th>
                                        <th>Programme</th>
                                        <th>Year</th>
                                        <th>Tutorial Group</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody id="table-body">                 
                                                                       
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
        $('#preview-table').DataTable({
            "bLengthChange": false,
            "info": false,
            "dom": 'lrtp'
        });
    });
</script>
<script>
    function enableBtn(){
        searchBtn = document.getElementById('search-btn');
        searchBtn.disabled = false;
        searchBtn.classList.add('clickable-btn');
        searchBtn.classList.remove('grey-btn');
    }

    function resetAll(){
        searchBtn = document.getElementById('search-btn');
        searchBtn.disabled = true;
        searchBtn.classList.remove('clickable-btn');
        searchBtn.classList.add('grey-btn');

        $('#preview-table').DataTable().clear().draw();

        document.getElementById('batch-number').value = 0;
    }

    async function searchStudent(){
        let dataTable = $('#preview-table').DataTable();
        let batchNumber = document.getElementById('batch-number').value;
        let url = `../../app/DAL/ajaxStudentMapManageGetStudent.php?batchNumber=${batchNumber}&lecturerID=<?php echo $lecturerID;?>`;

        let data = await fetch(url).then(response => response.json());

        data.forEach(student => {
            let rowNo = dataTable.context[0].aoData.length + 1;
            dataTable.row.add([
                rowNo,
                student.studentID,
                student.studName,
                student.programmeAcronym,
                student.studentYear,
                student.tutorialGroupNo,
                `<a href='mailto:${student.studEmail}'>Send Email</a>`,
                `<a target="_blank" class="view button" href="br-studentMapIndividualReview.php?studentID=${student.studentID}&individualView=true&accountStatus=${student.studAccountStatus}">View</a>`
            ]).draw();
        });    
    }


</script>
</html>