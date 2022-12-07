<?php
session_start();
error_reporting(0);
include('includes/db_connection.php');
require_once('../../app/BLL/documentManagementBLL.php');
require_once('../../app/DTO/documentManagementDTO.php');
require_once('../../app/DAL/documentManagementDAL.php');

$documentManagementDALObj  = new documentManagementDAL();
/*if (strlen($_SESSION['bpmsaid'] == 0)) {
	header('location:logout.php');
} else {
}*/
$documentManagementBLLObj = new documentManagementBLL();
if ($_GET['act'] == "edit") {
    $id = str_replace("'", "", $_GET['id']);
    $id = str_replace("'", "", $_GET['id']);
    $aDocumentMngt = $documentManagementBLLObj->GetDocument($id);
    if (isset($_POST['SubmitButton']) && $_POST['SubmitButton'] == 'Edit Document') {
        $documentID = $_POST['documentID'];
        $documentTitle = $_POST['documentTitle'];
        $Information = $_POST['Information'];
        $newdocumentMngt = new documentManagementDTO($documentID, $documentTitle,"", null, $Information);
        $documentManagementBLLObj->UpdDocumentMngt($newdocumentMngt);
    }
} else {
    if (isset($_POST['SubmitButton']) && $_POST['SubmitButton'] == 'Add Document') {

        $documentID = $_POST['documentID'];
        $documentTitle = $_POST['documentTitle'];
        $Information = $_POST['Information'];
        $newdocumentMngt = new documentManagementDTO($documentID, $documentTitle,"", null, $Information);
        $documentManagementBLLObj->UpdDocumentMngt($newdocumentMngt);
    }
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>ITP System | Document</title>
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
                        echo "<script> warning('Document cant be update. Operation failed!');</script>";
                    } elseif ($_GET['status'] == 'success') {
                        echo "<script> addSuccess('Update document successful!'); </script>";
                    } elseif ($documentManagementBLLObj->errorMessage != '') {
                        echo "<script> warning('$documentManagementBLLObj->errorMessage'); </script>";
                    }
                } else {
                    if ($_GET['status'] == 'failed') {
                        echo "<script> warning('Document cant be added. Operation failed!');</script>";
                    } elseif ($_GET['status'] == 'success') {
                        echo "<script> addSuccess('Add document successful!'); </script>";
                    } elseif ($documentManagementBLLObj->errorMessage != '') {
                        echo "<script> warning('$documentManagementBLLObj->errorMessage'); </script>";
                    }
                }
                ?>
                <div class="forms">
                    <?php
                    if ($_GET['act'] == "edit") {
                        echo '<h3 class="title1">Edit Document</h3>';
                    } else {
                        echo '<h3 class="title1">Add Document</h3>';
                    }
                    ?>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                        <div class="form-title">
                            <h4>Document</h4>
                        </div>
                        <div class="form-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group col-md-2"> <label>Document ID</label><input type="text" id="documentID" name="documentID" class="form-control" value="<?php echo isset($_GET['act']) && $_GET['act'] == "edit" ? $id : $documentManagementDALObj->generateID(); ?>" readonly="readonly"></div>
                                <div class="form-group col-md-2">
                                </div>

                                <div class="form-group col-md-8"> <label>Document Title</label> <input type="text" id="documentTitle" name="documentTitle" class="form-control" value="<?php echo isset($_GET['act']) && $_GET['act'] == "edit" ? $aDocumentMngt->getdocumentTitle(): "" ?>" placeholder="TITLE" onchange="changeHandler(this)" required="true">
                                </div>

                                <div class="form-group col-md-8"> <label>Document Information</label> <input type="text" id="Information" name="Information" class="form-control" value="<?php echo isset($_GET['act']) && $_GET['act'] == "edit" ? $aDocumentMngt->getInformation() : "" ?>" placeholder="INFORMATION" onchange="changeHandler(this)" required="true">
                                </div>

                                <div class="form-group col-md-12 text-right"> <button type="submit" name="SubmitButton" id="SubmitButton" value="<?php echo isset($_GET['act']) && $_GET['act'] == "edit" ? "Edit Document" : "Add Document" ?>" class="form-group btn btn-default">Save</button></div>
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

            /*function changeHandler(val) {
                var phoneno = /^\(?([0-9]{1})\)?[-]?([0-9]{2})$/;
                if (val.value.match(phoneno)) {
                    warning("Total Weight not more than 3 Digit number");
                    val.value = "";
                }
            }*/
        </script>
        <!-- Bootstrap Core JavaScript -->
        <script src="../../js/bootstrap.js"> </script>
</body>

</html>
<?php //} 
?>