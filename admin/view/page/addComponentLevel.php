<?php
session_start();
error_reporting(0);
include('includes/db_connection.php');
require_once('../../app/BLL/componentLvlBLL.php');
require_once('../../app/DTO/componentLvlDTO.php');
require_once('../../app/DAL/ComponentLvlDAL.php');

$rubricCmpLvlDALObj  = new ComponentLvlDAL();
/*if (strlen($_SESSION['bpmsaid'] == 0)) {
	header('location:logout.php');
} else {
}*/
$rubricCmpLvlBLLObj = new componentLvlBLL();
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

        $cmpLvlID = $_POST['cmpLvlID'];
        $title = $_POST['CmpLvlName'];
        $level = $_POST['cmplv'];
        $newRubricCmpLvl = new componentLvlDTO($cmpLvlID, $title, $level);
        $rubricCmpLvlBLLObj->AddRubricCmpLvl($newRubricCmpLvl);
    }
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>ITP System | Component Level</title>
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
                        echo "<script> addSuccess('Update Component Level successful'); </script>";
                    } elseif ($rubricCmpLvlBLLObj->errorMessage != '') {
                        echo "<script> warning('$rubricCmpLvlBLLObj->errorMessage'); </script>";
                    }
                } else {
                    if ($_GET['status'] == 'failed') {
                        echo "<script> warning('Record cant be added. Operation failed.');</script>";
                    } elseif ($_GET['status'] == 'success') {
                        echo "<script> addSuccess('Add Rubric Component Level successful'); </script>";
                    } elseif ($rubricCmpLvlBLLObj->errorMessage != '') {
                        echo "<script> warning('$rubricCmpLvlBLLObj->errorMessage'); </script>";
                    }
                }
                ?>
                <div class="forms">
                    <?php
                    if ($_GET['act'] == "edit") {
                        echo '<h3 class="title1">Edit Assessment Component Level</h3>';
                    } else {
                        echo '<h3 class="title1">Add Assessment Component Level</h3>';
                    }
                    ?>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                        <div class="form-title">
                            <h4>Component Level</h4>
                        </div>
                        <div class="form-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group col-md-2"> <label>Component Level ID</label><input type="text" id="cmpLvlID" name="cmpLvlID" class="form-control" value="<?php echo isset($_GET['act']) && $_GET['act'] == "edit" ? $id : $rubricCmpLvlDALObj->generateID(); ?>" readonly="readonly"></div>
                                <div class="form-group col-md-2">
                                    <label for="inputState">Component Level Name</label>
                                    <!--Change option to array for Role For Mark-->
                                    <select id="inputState" name="CmpLvlName" class="form-control" required>
                                        <option selected disabled value="">Choose...</option>
                                        <?php
                                        $options = array('Poor', 'Average', 'Good', 'Excellent');
                                        foreach ($options as $option) {
                                            if ($_GET['act'] == "edit") {
                                                if ($aRubricCmpLvl->getcmpTitle() == $option) {
                                                    echo "<option selected='selected' value='$option'>$option</option>";
                                                } else {
                                                    echo "<option value='$option'>$option</option>";
                                                }
                                            } else {
                                                echo "<option value='$option'>$option</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-8"> <label>Component Level Score</label> <input type="text" id="cmplv" name="cmplv" class="form-control" value="<?php echo isset($_GET['act']) && $_GET['act'] == "edit" ? $aRubricCmpLvl->getValue() : "" ?>" placeholder="0-2" onchange="changeHandler(this)" required="true">
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
        </script>
        <!-- Bootstrap Core JavaScript -->
        <script src="../../js/bootstrap.js"> </script>
</body>

</html>
<?php //} 
?>