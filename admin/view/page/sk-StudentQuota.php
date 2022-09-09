<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
/*if (strlen($_SESSION['bpmsaid'] == 0)) {
	//header('location:logout.php');
} else {*/



?>
<!DOCTYPE HTML>
<html>

<head>
    <title>ITP System | Companies Table</title>
    <link href="../../css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="../../css/style.css" rel='stylesheet' type='text/css' />
    <link href="../../css/font-awesome.css" rel="stylesheet">
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

                <div class="forms">
                    <h3 class="title1">Student Quota</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">

                        <div class="tab">
                            <button class="tablinks" onclick="changeTab(event, 'studentlimit')">Student Limit</button>
                            <button class="tablinks" onclick="changeTab(event, 'setquota')">Set Quota</button>
                        </div>

                        <div id="studentlimit" class="tabcontent">
                            <div class="search-group">

                                <div class="search-studentQuota">

                                    <div class="form-group">
                                        <label for="companies">Search Student Quota<span class="required-star">*</span></label>
                                        <input type="search" class="form-control" id="companies" name="companies" placeholder="Please Enter Information...." required="true">
                                        <div class="form-control result-box">

                                        </div>
                                    </div>
                                </div>

                                <div class="button-group">
                                    <a class="clickable-btn" onclick="confirm('Confirm For Searching?')" href="index.php">Assign</a>
                                    <a class="clickable-btn" href="#">Reset All</a>
                                </div>

                                <hr>
                                <div class="table-title">
                                    <h4>Student Quota List</h4>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Student Name</th>
                                            <th>Student ID</th>
                                            <th>Falculty</th>
                                            <th>No. Quota</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Sam Kuen</td>
                                            <td>21WMR10306</td>
                                            <td>FOCS</td>
                                            <td>5</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Sam Kuen</td>
                                            <td>21WMR10306</td>
                                            <td>FOCS</td>
                                            <td>5</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Sam Kuen</td>
                                            <td>21WMR10306</td>
                                            <td>FOCS</td>
                                            <td>5</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Sam Kuen</td>
                                            <td>21WMR10306</td>
                                            <td>FOCS</td>
                                            <td>5</td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Sam Kuen</td>
                                            <td>21WMR10306</td>
                                            <td>FOCS</td>
                                            <td>5</td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>Sam Kuen</td>
                                            <td>21WMR10306</td>
                                            <td>FOCS</td>
                                            <td>5</td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>Sam Kuen</td>
                                            <td>21WMR10306</td>
                                            <td>FOCS</td>
                                            <td>5</td>
                                        </tr>
                                        <tr>
                                            <td>8</td>
                                            <td>Sam Kuen</td>
                                            <td>21WMR10306</td>
                                            <td>FOCS</td>
                                            <td>5</td>
                                        </tr>
                                        <tr>
                                            <td>9</td>
                                            <td>Sam Kuen</td>
                                            <td>21WMR10306</td>
                                            <td>FOCS</td>
                                            <td>5</td>
                                        </tr>
                                        <tr>
                                            <td>10</td>
                                            <td>Sam Kuen</td>
                                            <td>21WMR10306</td>
                                            <td>FOCS</td>
                                            <td>5</td>
                                        </tr>
                                        <tr>
                                            <td>11</td>
                                            <td>Sam Kuen</td>
                                            <td>21WMR10306</td>
                                            <td>FOCS</td>
                                            <td>5</td>
                                        </tr>
                                        <tr>
                                            <td>12</td>
                                            <td>Sam Kuen</td>
                                            <td>21WMR10306</td>
                                            <td>FOCS</td>
                                            <td>5</td>
                                        </tr>
                                        <tr>
                                            <td>13</td>
                                            <td>Sam Kuen</td>
                                            <td>21WMR10306</td>
                                            <td>FOCS</td>
                                            <td>5</td>
                                        </tr>
                                        <tr>
                                            <td>14</td>
                                            <td>Sam Kuen</td>
                                            <td>21WMR10306</td>
                                            <td>FOCS</td>
                                            <td>5</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/classie.js"></script>
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
    <script src="../../js/jquery.nicescroll.js"></script>
    <script src="../../js/scripts.js"></script>
    <script src="../../js/bootstrap.js"> </script>

</body>
<footer><?php include_once('includes/footer.php'); ?></footer>

</html>