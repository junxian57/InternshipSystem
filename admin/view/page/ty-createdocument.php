<?php
session_start();
error_reporting(0);
include('includes/db_connection.php');

date_default_timezone_set("Asia/Kuala_Lumpur");
$date = date('Y-m-d');
require_once('../../app/BLL/documentManagementBLL.php');
require_once("../../app/DTO/documentManagementDTO.php");
require_once("../../app/DAL/documentManagementDAL.php");
$documentManagementDALObj  = new documentManagementDAL();

/*if (strlen($_SESSION['bpmsaid'] == 0)) {
	header('location:logout.php');
} else {
	} */

$documentManagementBLLObj = new documentManagementBLL(); 
 
if (isset($_POST['SubmitButton']) && $_POST['SubmitButton'] == 'Create Document') {
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $date = date('Y-m-d');
    $documentID = $_POST['documentID'];
    $documentTitle = $_POST['documentTitle'];
    $uploader = $_POST['uploader'];
    $information = $_POST['information'];
    
    $uploadDocument = $_FILES['uploadDocument'];

    $fileName = $uploadDocument['name'];

    $localPath = $_SERVER['DOCUMENT_ROOT'].'/InternshipSystem/admin/view/document/documentManagement/';

    $newFilePath = $localPath.$fileName;
    
    move_uploaded_file($uploadDocument['tmp_name'], $newFilePath);
    
    $newdocumentMngt = new documentManagementDTO($documentID, $documentTitle, $uploader, $newFilePath, $information);

    print_r($newdocumentMngt); 

    $documentManagementBLLObj->AddDocumentMngt($newdocumentMngt);
} 


?>
<!DOCTYPE HTML>
<html>

<head>
    <title>ITP SYSTEM | Create Document</title>
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
                 if ($_GET['act'] == "edit") {
                    if ($_GET['status'] == 'failed') {
                        echo "<script> warning('Document cant be updated. Operation failed!');</script>";
                    } elseif ($_GET['status'] == 'success') {
                        echo "<script> addSuccess('Update Document Successful!'); </script>";
                    } elseif ($documentManagementBLLObj->errorMessage != '') {
                        echo "<script> warning('$documentManagementBLLObj->errorMessage'); </script>";
                    }
                } else {
                    if ($_GET['status'] == 'failed') {
                        echo "<script> warning('Document cant be created. Operation failed!');</script>";
                    } elseif ($_GET['status'] == 'success') {
                        echo "<script> addSuccess('Create Document Successful!'); </script>";
                    } elseif ($documentManagementBLLObj->errorMessage != '') {
                        echo "<script> warning('$documentManagementBLLObj->errorMessage'); </script>";
                    }
                } 
                ?>
                <div class="forms ">
                    <?php
                    if ($_GET['act'] == "edit") {
                        echo '<h3 class="title1">Edit Document</h3>';
                    } else {
                        echo '<h3 class="title1">Create Document</h3>';
                    }
                    ?>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                        <div class="form-title">
                            <h4>Documents Management</h4>
                        </div>
                        <div class="form-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group col-md-2"> 
                                    <label for="exampleInput">Document ID</label>
                                    <input type="text" id="documentID" name="documentID" class="form-control" value="<?php echo isset($_GET['act']) && $_GET['act'] == "edit" ? $id : $documentManagementDALObj->generateID() ?>" readonly>
                                </div>
                                <div class="form-group col-md-6"> 
                                    <label for="exampleInput">Document Title</label>
                                    <input type="text" id="documentTitle" name="documentTitle" class="form-control" placeholder="TITLE" value="<?php echo  isset($_GET['act']) && $_GET['act'] == "edit" ? $aDocumentMngt->getdocumentTitle() : "" ?>" required="true"> 
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputState">Uploader</label>
                                    <!--Change option to array for Uploader-->
                                    <select id="inputState" name="uploader" class="form-control" required>
                                        <option selected disabled value="0">Options</option>
                                        <?php
                                        $options = array('ITP Supervisor', 'ITP Committee');
                                        foreach ($options as $option) {
                                            if ($_GET['act'] == "edit") {
                                                if ($aDocumentMngt->getUploader() == $option) {
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
                                <div class="form-group col-md-2"> 
                                    <label for="exampleInput">Upload Date</label>
                                    <input type="text" id="uploadDate" name="uploadDate" class="form-control" value="<?php echo isset($_GET['act']) && $_GET['act'] == "edit" ? $id : $date ?>" readonly>
                                </div>

                                <label for="input-folder-3">Select Files</label>

                                <div class="file-loading">
                                    <input id="uploadDocument" name="uploadDocument" type="file" accept=".pdf"><br>
                                    <a type="button" id="previewDocument" target="_blank">Preview</a>
                                </div>
                            
                                <div class="form-group col-md-12"> 
                                    <label>Document Information</label>
                                    <textarea rows="5" class="form-control" id="Information" name="information" placeholder="INSTRUCTION/INFORMATION" required><?php echo isset($_GET['act']) && $_GET['act'] == "edit" ? $aDocumentMngt->getInformation() : "" ?></textarea>
                                </div>

                                <div class="form-group col-md-12 text-right"> <button type="submit" name="SubmitButton" id="SubmitButton" value= "Create Document" class="form-group btn btn-default">Upload</button></div>

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

        </script>
        <!-- Bootstrap Core JavaScript -->
        <script src="../../js/bootstrap.js"> </script>
</body>
    <script>
        document.getElementById('uploadDocument').addEventListener('change', e => {
            let getDocument = e.target.files[0];
            let url = URL.createObjectURL(getDocument);

            document.querySelector('#previewDocument').setAttribute('href', url);
        })
    </script>

</html>
<?php //} 
?>