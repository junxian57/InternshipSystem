<?php
session_start();
error_reporting(0);
include('includes/db_connection.php');
require_once('../../app/BLL/ItpCommitteeBLL.php');
require_once('../../app/DTO/ItpCommitteeDTO.php');
require_once('../../app/DAL/ItpCommitteeDAL.php');

$ItpCommitteeDALObj  = new ItpCommitteeDAL();
/*if (strlen($_SESSION['bpmsaid'] == 0)) {
	header('location:logout.php');
} else {
}*/
$ItpCommitteeBLLObj = new ItpCommitteeBLL();
if ($_GET['act'] == "edit") {
    $id = str_replace("'", "", $_GET['id']);
    $id = str_replace("'", "", $_GET['id']);
    $aRubricCmpLvl = $rubricCmpLvlBLLObj->GetCmptLvl($id);
    if (isset($_POST['SubmitButton']) && $_POST['SubmitButton'] == 'Edit Component Level') {
        $cmpLvlID = $_POST['cmpLvlID'];
        $title = $_POST['CmpLvlName'];
        $level = $_POST['cmplv'];
        $newRubricCmpLvl = new componentLvlDTO($cmpLvlID, $title, $level);
        $rubricCmpLvlBLLObj->UpdRubricCmpLvl($newRubricCmpLvl);
    }
} else {
    if (isset($_POST['SubmitButton']) && $_POST['SubmitButton'] == 'Add Component Level') {
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $date = date('Y-m-d');
        $committeeID = $_POST['committeeID'];
        $committeeName = $_POST['committeeName'];
        $gender = $_POST['gender'];
        $committeeEmail = $_POST['committeeEmail'];
        $committeeContactNo = $_POST['committeeContactNo'];
        $committeeAddress = $_POST['committeeAddress'];
        $committeePosition = $_POST['committeePosition'];
        $Confirmpassword = $_POST['Confirmpassword'];
        $newItpCommittee = new ItpCommitteeDTO($committeeID, $committeeName, $gender,$committeeEmail,$committeeContactNo,$committeeAddress,$committeePosition,$Confirmpassword,$date);
        $newItpCommittee->setlecturerID("");
        $ItpCommitteeBLLObj->AddItpCommittee($newItpCommittee);
    }
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>ITP System</title>
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- Bootstrap Core CSS -->
    <link href="../../css/bootstrap.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="../../css/style.css" rel='stylesheet' type='text/css' />
    <!-- font CSS -->
    <!-- font-awesome icons -->
    <link href="../../css/font-awesome.css" rel="stylesheet">
    <!-- //font-awesome icons -->
    <!-- js-->
    <script src="../../js/jquery-1.11.1.min.js"></script>
    <script src="../../js/modernizr.custom.js"></script>
    <!--webfonts-->
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <!--//webfonts-->
    <!--animate-->
    <link href="../../css/animate.css" rel="stylesheet" type="text/css" media="all">
    <script src="../../js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <!--//end-animate-->
    <!-- Metis Menu -->
    <script src="../../js/metisMenu.min.js"></script>
    <script src="../../js/custom.js"></script>
    <link href="../../css/custom.css" rel="stylesheet">
    <script src="../../js/toastr.min.js"></script>
    <link href="../../css/toastr.min.css" rel="stylesheet">
    <script src="../../js/customToastr.js"></script>
    <!--//Metis Menu -->
</head>
<!--left-fixed -navigation-->
<?php include_once('../../includes/sidebar.php'); ?>
<!--left-fixed -navigation-->
<!-- header-starts -->
<?php include_once('../../includes/header.php'); ?>
<!-- //header-ends -->

<body class="cbp-spmenu-push">
    <div class="main-content">
        <!-- main content start-->
        <div id="page-wrapper">
            <div class="main-page">
                <?php
                if ($_GET['act'] == 'edit') {
                    if ($_GET['status'] == 'failed') {
                        echo "<script> warning('Record cant be Update. Operation failed.');</script>";
                    } elseif ($_GET['status'] == 'success') {
                        echo "<script> addSuccess('Update ITP Committee successful'); </script>";
                    } elseif ($rubricCmpLvlBLLObj->errorMessage != '') {
                        echo "<script> warning('$rubricCmpLvlBLLObj->errorMessage'); </script>";
                    }
                } else {
                    if ($_GET['status'] == 'failed') {
                        echo "<script> warning('Record cant be added. Operation failed.');</script>";
                    } elseif ($_GET['status'] == 'success') {
                        echo "<script> addSuccess('Add ITP Committee successful'); </script>";
                    } elseif ($ItpCommitteeBLLObj->errorMessage != '') {
                        echo "<script> warning('$ItpCommitteeBLLObj->errorMessage'); </script>";
                    }
                }
                ?>
                <div class="forms">
                    <?php
                    if ($_GET['act'] == "edit") {
                        echo '<h3 class="title1">Edit ITP Commottee</h3>';
                    } else {
                        echo '<h3 class="title1">Add ITP Commottee</h3>';
                    }
                    ?>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                        <div class="form-title">
                            <h4>ITP Committee</h4>
                        </div>
                        <div class="form-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group col-md-2"> <label>ITP Committee ID</label><input type="text" id="committeeID" name="committeeID" class="form-control" value="<?php echo isset($_GET['act']) && $_GET['act'] == "edit" ? $id : $ItpCommitteeDALObj->generateID(); ?>" readonly="readonly"></div>
                                <div class="form-group col-md-3"> <label>ITP Committee Name</label><input type="text" id="committeeName" name="committeeName" class="form-control" value="<?php echo isset($_GET['act']) && $_GET['act'] == "edit" ? "" : ""; ?>" required></div>
                                <div class="form-group col-md-2">
                                    <label>Gender</label>
                                    <div class="radio">
                                        <label><input type="radio" name="gender" value="Male" required>Male</label>
                                        <label><input type="radio" name="gender" value="Female" required>Female</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-3"> <label>ITP Committee Email</label><input type="email" id="committeeEmail" name="committeeEmail" class="form-control" value="<?php echo isset($_GET['act']) && $_GET['act'] == "edit" ? "" : ""; ?>" required></div>
                                <div class="form-group col-md-2"> <label>ITP Committee Contact No</label><input type="tel" id="committeeContactNo" name="committeeContactNo" class="form-control" pattern="[0-9]{3}-[0-9]{8}" placeholder="012-34567890" value="<?php echo isset($_GET['act']) && $_GET['act'] == "edit" ? "" : ""; ?>" required></div>
                                <div class="form-group col-md-12"> <label>ITP Committee Address</label><input type="text" rows="6" class="form-control" id="committeeAddress" name="committeeAddress" required></input></div>
                                <div class="form-group col-md-4"> <label>ITP Committee Position</label><input type="text" class="form-control" id="committeePosition" name="committeePosition" required></input></div>
                                <div class="form-group col-md-4"> <label>Password</label><input type="password" class="form-control" id="password" name="password" required></input></div>
                                <div class="form-group col-md-4"> <label>Confirm Password</label><input type="password" class="form-control" id="Confirmpassword" name="Confirmpassword" required></input>
                                    <span id='message'></span>
                                </div>
                                <div class="form-group col-md-12 text-right"> <button type="submit" name="SubmitButton" id="SubmitButton" value="<?php echo isset($_GET['act']) && $_GET['act'] == "edit" ? "Edit Component Level" : "Add Component Level" ?>" class="form-group btn btn-default">Save</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--footer-->
        <?php include_once('../../includes/footer.php'); ?>
        <!--//footer-->
        <!-- Classie -->
        <script src="../../js/classie.js"></script>
        <script>
            var menuLeft = document.getElementById('cbp-spmenu-s1'),
                showLeftPush = document.getElementById('showLeftPush'),
                body = document.body;
            $("#SubmitButton").attr("disabled","true");
            document.getElementById('SubmitButton').style = "pointer-events: none;";
            
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

            function changeHandler(val) {
                var phoneno = /^\(?([0-9]{1})\)?[-]?([0-9]{2})$/;
                if (val.value.match(phoneno)) {
                    warning("Total Weight not more than 3 Digit number");
                    val.value = "";
                }
            }

            $('#password, #Confirmpassword').on('keyup', function() {
                if ($('#password').val() == $('#Confirmpassword').val()) {
                    $('#message').html('Matching').css('color', 'green');
                    $('#SubmitButton').prop("disabled", "false");
                    $('#SubmitButton').removeAttr("disabled");
                    $('#SubmitButton').removeAttr("style");
                } else
                    $('#message').html('Not Matching').css('color', 'red');

            });

        </script>
        <!-- Bootstrap Core JavaScript -->
        <script src="../../js/bootstrap.js"> </script>
</body>

</html>
<?php //} 
?>