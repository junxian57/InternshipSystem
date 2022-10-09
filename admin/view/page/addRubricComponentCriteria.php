<?php
session_start();
error_reporting(0);
include('includes/db_connection.php');
/*if (strlen($_SESSION['bpmsaid'] == 0)) {
	header('location:logout.php');
} else {

	if (isset($_POST['submit'])) {
		$sername = $_POST['sername'];
		$cost = $_POST['cost'];



		$query = mysqli_query($con, "insert into  tblservices(ServiceName,Cost) value('$sername','$cost')");
		if ($query) {
			echo "<script>alert('Service has been added.');</script>";
			echo "<script>window.location.href = 'add-services.php'</script>";
			$msg = "";
		} else {
			echo "<script>alert('Something Went Wrong. Please try again.');</script>";
		}
	}*/
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
    <!--//Metis Menu -->
</head>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <!--left-fixed -navigation-->
        <?php include_once('../../includes/sidebar.php'); ?>
        <!--left-fixed -navigation-->
        <!-- header-starts -->
        <?php include_once('../../includes/header.php'); ?>
        <!-- //header-ends -->
        <!-- main content start-->
        <div id="page-wrapper">
            <div class="main-page">
                <div class="forms ">
                    <h3 class="title1">Add Rubric Assessment Criteria</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                        <div class="form-title">
                            <h4>Rubric Assessment Criteria</h4>
                        </div>
                        <div class="form-body">
                            <form method="post">
                                <p style="font-size:16px; color:red" align="center"> <?php if ($msg) {
                                                                                            echo $msg;
                                                                                        }  ?> </p>


                                <div class="form-group col-md-6"> <label for="exampleInputPassword1">Assessment Criteria Title</label> <input type="text" id="cmplv" name="cmplv" class="form-control" placeholder="Component Level" value="" required="true"> </div>
                                <div class="form-group col-md-6">
                                    <label for="inputState">Role for Mark</label>
                                    <select id="inputState" class="form-control">
                                        <option selected>Company</option>
                                        <option>Supervisor</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12"> <label for="exampleInputPassword1">Assessment Criteria Session</label> <input type="text" id="cmplv" name="cmplv" class="form-control" placeholder="Section A. Progress Reports" value="" required="true"> </div>
                                <div class="form-group col-md-12"> <label for="exampleInputEmail1">Assessment Criteria Description</label> <textarea type="text-area" class="form-control" id="cmpname" name="cmpname" placeholder="Component Name" value="" required="true"> </textarea></div>

                                <?php
                                for ($i = 1; $i <= 4; $i++) {
                                    ?>
                                    <div class="row">
                                        <div class="form-group col-md-9"> <label for="exampleInputEmail1">Assessment Criteria Component Description <?php echo ($i); ?></label> <textarea type="text-area" class="form-control" id="cmpname" name="criteriaDesc[]" placeholder="Assessment Criteria Description " value="" required="true"> </textarea></div>
                                        <div class="form-group col-md-3">
                                            <label for="inputState">Component Level</label>
                                            <select id="inputState" class="form-control">
                                                <option selected>0-1</option>
                                                <option>2-3</option>
                                            </select>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="text-right">
                                    <div class="form-group col-md-12"> <button type="submit" name="submit" class="form-group btn btn-default">Save</button></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--footer-->
            <?php include_once('../../includes/footer.php'); ?>
            <!--//footer-->
        </div>

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