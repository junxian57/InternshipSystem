<?php
session_start();
error_reporting(0);
include('includes/db_connection.php');

date_default_timezone_set("Asia/Kuala_Lumpur");
$date = date('Y-m-d');
require_once('../../app/BLL/generalCommunicationBLL.php');
require_once("../../app/DTO/generalCommunicationDTO.php");
require_once("../../app/DAL/generalCommunicationDAL.php");
$generalCommunicationDALObj  = new generalCommunicationDAL();

/*if (strlen($_SESSION['bpmsaid'] == 0)) {
	header('location:logout.php');
} else {
	} */

$generalCommunicationBLLObj = new generalCommunicationBLL(); 
 
if (isset($_POST['SubmitButton']) && $_POST['SubmitButton'] == 'Create Message') {
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $date = date('Y-m-d');
    $messageID = $_POST['messageID'];
    $msgTitle = $_POST['msgTitle'];
    $msgSender = $_POST['msgSender'];
    $msgReceiver = $_POST['msgReceiver'];
    $msgContent = $_POST['msgContent'];
    
    $newgeneralComm = new generalCommunicationDTO($messageID, $msgTitle, $msgSender, $msgReceiver, $msgContent);

    $generalCommunicationBLLObj->AddGeneralComm($newgeneralComm);
} 


?>
<!DOCTYPE HTML>
<html>

<head>
    <title>ITP SYSTEM | Create Message</title>
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
                        echo "<script> warning('Message cant be updated. Operation failed!');</script>";
                    } elseif ($_GET['status'] == 'success') {
                        echo "<script> addSuccess('Update Message Successful!'); </script>";
                    } elseif ($generalCommunicationBLLObj->errorMessage != '') {
                        echo "<script> warning('$generalCommunicationBLLObj->errorMessage'); </script>";
                    }
                } else {
                    if ($_GET['status'] == 'failed') {
                        echo "<script> warning('Message cant be created. Operation failed!');</script>";
                    } elseif ($_GET['status'] == 'success') {
                        echo "<script> addSuccess('Create Message Successful!'); </script>";
                    } elseif ($generalCommunicationBLLObj->errorMessage != '') {
                        echo "<script> warning('$generalCommunicationBLLObj->errorMessage'); </script>";
                    }
                } 
                ?>
                <div class="forms ">
                    <?php
                    if ($_GET['act'] == "edit") {
                        echo '<h3 class="title1">Edit Message</h3>';
                    } else {
                        echo '<h3 class="title1">Create Message</h3>';
                    }
                    ?>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                        <div class="form-title">
                            <h4>General Communication</h4>
                        </div>
                        <div class="form-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group col-md-2"> 
                                    <label for="exampleInput">Message ID</label>
                                    <input type="text" id="messageID" name="messageID" class="form-control" value="<?php echo isset($_GET['act']) && $_GET['act'] == "edit" ? $id : $generalCommunicationDALObj->generateID() ?>" readonly>
                                </div>
                                <div class="form-group col-md-6"> 
                                    <label for="exampleInput">Message Title</label>
                                    <input type="text" id="msgTitle" name="msgTitle" class="form-control" placeholder="MESSAGE TITLE" value="<?php echo  isset($_GET['act']) && $_GET['act'] == "edit" ? $aGeneralComm->getmsgTitle() : "" ?>" required="true"> 
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputState">Sender</label>
                                    <!--Change option to array for Sender-->
                                    <select id="inputState" name="msgSender" class="form-control" required>
                                        <option selected disabled value="0">Users</option>
                                        <?php
                                        $options = array('Admin', 'ITP Committee');
                                        foreach ($options as $option) {
                                            if ($_GET['act'] == "edit") {
                                                if ($aGeneralComm->getmsgSender() == $option) {
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
                                    <label for="inputState">Receiver</label>
                                    <!--Change option to array for Receiver-->
                                    <select id="inputState" name="msgReceiver" class="form-control" required>
                                        <option selected disabled value="0">Users</option>
                                        <?php
                                        $options = array('Student', 'Admin', 'ITP Committee','Company','Supervisors');
                                        foreach ($options as $option) {
                                            if ($_GET['act'] == "edit") {
                                                if ($aGeneralComm->getmsgReceiver() == $option) {
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
                                    <label for="exampleInput">Message Date</label>
                                    <input type="text" id="msgDate" name="msgDate" class="form-control" value="<?php echo isset($_GET['act']) && $_GET['act'] == "edit" ? $id : $date ?>" readonly>
                                </div>
                            
                                <div class="form-group col-md-12"> 
                                    <label>Message Content</label>
                                    <textarea rows="5" class="form-control" id="msgContent" name="msgContent" placeholder="CONTENT" required><?php echo isset($_GET['act']) && $_GET['act'] == "edit" ? $aGeneralComm->getmsgContent() : "" ?></textarea>
                                </div>

                                <div class="form-group col-md-12 text-right"> <button type="submit" name="SubmitButton" id="SubmitButton" value= "Create Message" class="form-group btn btn-default">Create</button></div>

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
            var menuLeft = message.getElementById('cbp-spmenu-s1'),
            showLeftPush = message.getElementById('showLeftPush'),
            body = message.body;
            
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