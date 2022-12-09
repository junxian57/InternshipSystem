<?php
session_start();
error_reporting(0);
include('../../includes/db_connection.php');
if (session_status() != PHP_SESSION_ACTIVE) session_start();

if (isset($_SESSION['studentChangePass'])) {
    header('Location: clientChangePassword.php?requireChangePass&notAllowed');
}
$internshipBatchID = trim($_SESSION['internshipBatchID']);
$facultyID = trim($_SESSION['facultyID']);
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>ITP System | Report Template</title>
    <link href="../../css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="../../css/style.css" rel='stylesheet' type='text/css' />
    <link href="../../css/font-awesome.css" rel="stylesheet">
    <link href="../../css/xt-displayRptTemplate.css" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href="../../css/animate.css" rel="stylesheet" type="text/css" media="all">
    <link href="../../css/custom.css" rel="stylesheet">

    <script src="../../js/jquery-1.11.1.min.js"></script>
    <script src="../../js/modernizr.custom.js"></script>
    <script src="../../js/wow.min.js"></script>
    <script src="../../js/metisMenu.min.js"></script>
    <script src="../../js/custom.js"></script>

    <style>
        #myiframe {
            width: 600px;
            height: 100%;
        }

        .tabcontent {
            min-height: 1100px;
        }

        #CompanyEvalautionForm {
            height: 1000px;
        }

        #LecturerEvalautionForm {
            height: 1000px;
        }
    </style>

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
                    <h3 class="title1">Evalaution Form</h3>
                    <div class="tab">
                        <button class="tablinks" id="activeTab" onclick="appType(event, 'CompanyEvalautionForm')">Company Evalaution Form</button>
                        <button class="tablinks" onclick="appType(event, 'LecturerEvalautionForm')">Lecturer Evalaution Form</button>
                    </div>

                    <div id="CompanyEvalautionForm" class="tabcontent">
                        <?php echo "<a href='jx-companyEvaluationRubric.php?internshipBatchID=$internshipBatchID&facultyID=$facultyID' class='btn btn-success' id='btn-save' name='record'>"; ?>Company Evalaution</a>

                        <div id="CompanyEvalautionForm">
                            <?php
                            echo "<iframe src=\"jx-companyEvaluationRubric.php?internshipBatchID=$internshipBatchID&facultyID=$facultyID\" width=\"100%\" style=\"height:100%\"></iframe>";
                            ?>
                        </div>
                    </div>

                    <div id="LecturerEvalautionForm" class="tabcontent">
                        <?php echo "<a href='jx-lecturerEvaluationRubric.php?internshipBatchID=$internshipBatchID&facultyID=$facultyID' class='btn btn-success' id='btn-save' name='record'>"; ?>Lecturer Evaluation</a>

                        <div id="LecturerEvalautionForm">
                            <?php
                            echo "<iframe src=\"jx-lecturerEvaluationRubric.php?internshipBatchID=$internshipBatchID&facultyID=$facultyID\" width=\"100%\" style=\"height:100%\"></iframe>";
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../js/classie.js"></script>
    <script>
        var menuLeft = document.getElementById('cbp-spmenu-s1'),
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

    <script>
        function appType(evt, applicationType) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(applicationType).style.display = "block";
            evt.currentTarget.className += " active";
        }
        document.getElementById("activeTab").click();
    </script>

    <script src="../../js/jquery.nicescroll.js"></script>
    <script src="../../js/scripts.js"></script>
    <script src="../../js/bootstrap.js"> </script>

</body>

</html>