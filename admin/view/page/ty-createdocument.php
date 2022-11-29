<?php
session_start();
error_reporting(0);
include('includes/db_connection.php');

date_default_timezone_set("Asia/Kuala_Lumpur");
$date = date('Y-m-d');
/* require_once('../../app/BLL/rubricAssessmentBLL.php');
require_once("../../app/DTO/rubricAssessmentDTO.php");
require_once("../../app/DAL/rubricAssessmentDAL.php");
$rubricAssessmentDALObj  = new rubricAssessmentDAL();
/*if (strlen($_SESSION['bpmsaid'] == 0)) {
	header('location:logout.php');
} else {

	}
$rubricAssmtBllObj = new rubricAssessmentBLL();
if ($_GET['act'] == "edit") {
    $id = str_replace("'", "", $_GET['id']);
    $id = str_replace("'", "", $_GET['id']);
    $aRubricAssmt = $rubricAssmtBllObj->GetRubricAssessment($id);
    if (isset($_POST['SubmitButton']) && $_POST['SubmitButton'] == 'Edit Document') {
        $assessmentID = $aRubricAssmt->getAssmtId();
        echo $assessmentID;
        $internshipBatchID = $_POST['internshipBatchID'];
        $Title = $_POST['Title'];
        $Instructions = $_POST['Instructions'];
        $TotalWeight = $_POST['TotalWeight'];
        $RoleForMark = $_POST['RoleForMark'];
        $CreateByID = $_POST['CreateByID'];
        $CreateDate = $_POST['createDate'];
        $updRubricAssmt = new rubricAssessmentDTO($assessmentID, $internshipBatchID, $Title, $Instructions, $TotalWeight, $RoleForMark, $CreateByID, $CreateDate);
        $rubricAssmtBllObj->UpdRubricAssmt($updRubricAssmt);
    }
} else {
    if (isset($_POST['SubmitButton']) && $_POST['SubmitButton'] == 'Create Document') {
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $date = date('Y-m-d');
        $assessmentID = $_POST['assessmentID'];
        $internshipBatchID = $_POST['internshipBatchID'];
        $Title = $_POST['Title'];
        $Instructions = $_POST['Instructions'];
        $TotalWeight = $_POST['TotalWeight'];
        $RoleForMark = $_POST['RoleForMark'];
        $CreateByID = $_POST['CreateByID'];
        $CreateDate = $date;
        $newRubricAssmt = new rubricAssessmentDTO($assessmentID, $internshipBatchID, $Title, $Instructions, $TotalWeight, $RoleForMark, $CreateByID, $CreateDate);
        $rubricAssmtBllObj->AddRubricAssmt($newRubricAssmt);
    }
} */

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

    <!-- bootstrap 5.x or 4.x is supported. You can also use the bootstrap css 3.3.x versions -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
 
 <!-- default icons used in the plugin are from Bootstrap 5.x icon library (which can be enabled by loading CSS below) -->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
  
 <!-- alternatively you can use the font awesome icon library if using with `fas` theme (or Bootstrap 4.x) by uncommenting below. -->
 <!-- link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" crossorigin="anonymous" -->
  
 <!-- the fileinput plugin styling CSS file -->
 <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
  
 <!-- if using RTL (Right-To-Left) orientation, load the RTL CSS file after fileinput.css by uncommenting below -->
 <!-- link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/css/fileinput-rtl.min.css" media="all" rel="stylesheet" type="text/css" /-->
  
 <!-- the jQuery Library -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  
 <!-- buffer.min.js and filetype.min.js are necessary in the order listed for advanced mime type parsing and more correct
      preview. This is a feature available since v5.5.0 and is needed if you want to ensure file mime type is parsed 
      correctly even if the local file's extension is named incorrectly. This will ensure more correct preview of the
      selected file (note: this will involve a small processing overhead in scanning of file contents locally). If you 
      do not load these scripts then the mime type parsing will largely be derived using the extension in the filename
      and some basic file content parsing signatures. -->
 <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/buffer.min.js" type="text/javascript"></script>
 <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/filetype.min.js" type="text/javascript"></script>
  
 <!-- piexif.min.js is needed for auto orienting image files OR when restoring exif data in resized images and when you
     wish to resize images before upload. This must be loaded before fileinput.min.js -->
 <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/piexif.min.js" type="text/javascript"></script>
  
 <!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview. 
     This must be loaded before fileinput.min.js -->
 <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/sortable.min.js" type="text/javascript"></script>
  
 <!-- bootstrap.bundle.min.js below is needed if you wish to zoom and preview file content in a detail modal
     dialog. bootstrap 5.x or 4.x is supported. You can also use the bootstrap js 3.3.x versions. -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  
 <!-- the main fileinput plugin script JS file -->
 <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/fileinput.min.js"></script>
  
 <!-- following theme script is needed to use the Font Awesome 5.x theme (`fa5`). Uncomment if needed. -->
 <!-- script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/themes/fa5/theme.min.js"></script -->
  
 <!-- optionally if you need translation for your language then include the locale file as mentioned below (replace LANG.js with your language locale) -->
 <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/locales/LANG.js"> //SELECT FILES UPLOAD FILES


 </script>
    
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
                        echo "<script> warning('Document cant be updated. Operation failed.');</script>";
                    } elseif ($_GET['status'] == 'success') {
                        echo "<script> addSuccess('Update Document Successful!'); </script>";
                    } elseif ($documentManagementBLLObj->errorMessage != '') {
                        echo "<script> warning('$documentManagementBLLObj->errorMessage'); </script>";
                    }
                } else {
                    if ($_GET['status'] == 'failed') {
                        echo "<script> warning('Document cant be created. Operation failed.');</script>";
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
                        echo '<h3 class="title1">Edit Rubric Assessment</h3>';
                    } else {
                        echo '<h3 class="title1">Create Document</h3>';
                    }
                    ?>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                        <div class="form-title">
                            <h4>Documents</h4>
                        </div>
                        <div class="form-body">
                            <form method="post">
                                <div class="form-group col-md-2"> <label for="exampleInput">Document ID</label><input type="text" id="documentID" name="documentID" class="form-control" value="<?php echo isset($_GET['act']) && $_GET['act'] == "edit" ? $id : /* $rubricAssessmentDALObj->generateID() */ "" ?>" readonly="readonly"></div>
                                <div class="form-group col-md-6"> <label for="exampleInput">Document Title</label> <input type="text" id="documentTitle" name="documentTitle" class="form-control" placeholder="TITLE" value="<?php echo  isset($_GET['act']) && $_GET['act'] == "edit" ? $aRubricAssmt->getTitle() : "" ?>" required="true"> </div>
                                <div class="form-group col-md-2">
                                    <label for="inputState">Uploader</label>
                                    <!--Change option to array for Uploader-->
                                    <select id="inputState" name="Uploader" class="form-control" required>
                                        <option selected disabled value="">Options</option>
                                        <?php
                                        $options = array('ITP Supervisor', 'ITP Committee');
                                        foreach ($options as $option) {
                                            if ($_GET['act'] == "edit") {
                                                if ($aRubricAssmt->getRoleForMark() == $option) {
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
                                <div class="form-group col-md-2"> <label for="exampleInput">Upload Date</label><input type="text" id="uploadDate" name="uploadDate" class="form-control" value="<?php echo isset($_GET['act']) && $_GET['act'] == "edit" ? $id : $date ?>" readonly="readonly"></div>
                                <label for="input-folder-3">Select files</label>
                                <div class="file-loading">
                                <input id="uploadDocument" name="uploadDocument[]" type="file" multiple>
                            </div>
                            <script>
                            $(document).ready(function() {
                                $("#uploadDocument").fileinput({
                                    uploadUrl: "/file-upload-batch/2",
                                    hideThumbnailContent: true // hide image, pdf, text or other content in the thumbnail preview
                                });
                                });
                                </script>
                                <div class="form-group col-md-12"> <label>Document Information</label><textarea rows="5" class="form-control" id="Information" name="Information" placeholder="INTRUCTION" required><?php echo isset($_GET['act']) && $_GET['act'] == "edit" ? $aRubricAssmt->getInstructions() : "" ?></textarea></div>
                                <div class="form-group col-md-12 text-right"> <button type="submit" name="SubmitButton" id="SubmitButton" value="<?php echo isset($_GET['act']) && $_GET['act'] == "edit" ? "Edit Document" : "Create Document" ?>" class="form-group btn btn-default">Upload</button></div>

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

</html>
<?php //} 
?>