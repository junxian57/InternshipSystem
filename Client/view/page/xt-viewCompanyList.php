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
	<title>ITP System | Companies List</title>
	<link href="../../css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="../../css/style.css" rel='stylesheet' type='text/css' />
	<link href="../../css/font-awesome.css" rel="stylesheet">
	<link href="../../css/xt-viewCompanyList.css" rel="stylesheet">
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
				<div class="tablesr">
					<h3 class="title1">Companies List</h3>
          <section class="cmpList" id="cmpList">
            <div class="cmpList-container">
              <div class='cmpL'>
                <div class='cmpLimage'>
                  <img src='../images/taruc-logo.jpg'>
                </div>
                <div class='cmpLcontent'>
                  <h3>Tunku Abdul Rahman University College</h3>
                  <table class="table">
                    <tbody>
                      <tr>
                        <th>Job Title</th>
                        <td>Software Developer Intern (6 months)-Kuala Lumpur</td>
                      </tr>
                      <tr>
                        <th>Address</th>
                        <td>Suite 29-2, Level 29, Vertical Corporate Tower B, Avenue 10, Bangsar South City, No.8 Jalan Kerinchi Kuala Lumpur, Malaysia., 59200, Kuala Lumpur</td>
                      </tr>
                      <tr>
                        <th>Fields Area</th>
                        <td>Finance & Accounting</td>
                      </tr>
                      <tr>
                        <th>Allowance</th>
                        <td>RM 1,500.00 - RM 1,500.00</td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="cmpLFooter">
                    <p></p>
                    <a href='' class='cmpL-btn'>View</a>
                  </div>
                </div>
              </div>

              <div class='cmpL'>
                <div class='cmpLimage'>
                  <img src='../images/taruc-logo.jpg'>
                </div>
                <div class='cmpLcontent'>
                  <h3>Guidewire Software Sdn. Bhd.</h3>
                  <table class="table">
                    <tbody>
                      <tr>
                        <th>Job Title</th>
                        <td>Software Developer Intern (6 months)-Kuala Lumpur</td>
                      </tr>
                      <tr>
                        <th>Address</th>
                        <td>Suite 29-2, Level 29, Vertical Corporate Tower B, Avenue 10, Bangsar South City, No.8 Jalan Kerinchi Kuala Lumpur, Malaysia., 59200, Kuala Lumpur</td>
                      </tr>
                      <tr>
                        <th>Fields Area</th>
                        <td>Finance & Accounting</td>
                      </tr>
                      <tr>
                        <th>Allowance</th>
                        <td>RM 1,500.00 - RM 1,500.00</td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="cmpLFooter">
                    <p></p>
                    <a href='' class='cmpL-btn'>View</a>
                  </div>
                </div>
              </div>

              <div class='cmpL'>
                <div class='cmpLimage'>
                  <img src='../images/taruc-logo.jpg'>
                </div>
                <div class='cmpLcontent'>
                  <h3>Safeguards CS Sdn Bhd</h3>
                  <table class="table">
                    <tbody>
                      <tr>
                        <th>Job Title</th>
                        <td>Software Developer Intern (6 months)-Kuala Lumpur</td>
                      </tr>
                      <tr>
                        <th>Address</th>
                        <td>Suite 29-2, Level 29, Vertical Corporate Tower B, Avenue 10, Bangsar South City, No.8 Jalan Kerinchi Kuala Lumpur, Malaysia., 59200, Kuala Lumpur</td>
                      </tr>
                      <tr>
                        <th>Fields Area</th>
                        <td>Finance & Accounting</td>
                      </tr>
                      <tr>
                        <th>Allowance</th>
                        <td>RM 1,500.00 - RM 1,500.00</td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="cmpLFooter">
                    <p></p>
                    <a href='' class='cmpL-btn'>View</a>
                  </div>
                </div>
              </div>

              <div class='cmpL'>
                <div class='cmpLimage'>
                  <img src='../images/taruc-logo.jpg'>
                </div>
                <div class='cmpLcontent'>
                  <h3>Safeguards CS Sdn Bhd</h3>
                  <table class="table">
                    <tbody>
                      <tr>
                        <th>Job Title</th>
                        <td>Software Developer Intern (6 months)-Kuala Lumpur</td>
                      </tr>
                      <tr>
                        <th>Address</th>
                        <td>Suite 29-2, Level 29, Vertical Corporate Tower B, Avenue 10, Bangsar South City, No.8 Jalan Kerinchi Kuala Lumpur, Malaysia., 59200, Kuala Lumpur</td>
                      </tr>
                      <tr>
                        <th>Fields Area</th>
                        <td>Finance & Accounting</td>
                      </tr>
                      <tr>
                        <th>Allowance</th>
                        <td>RM 1,500.00 - RM 1,500.00</td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="cmpLFooter">
                    <p></p>
                    <a href='' class='cmpL-btn'>View</a>
                  </div>
                </div>
              </div>

              <div class='cmpL'>
                <div class='cmpLimage'>
                  <img src='../images/taruc-logo.jpg'>
                </div>
                <div class='cmpLcontent'>
                  <h3>Safeguards CS Sdn Bhd</h3>
                  <table class="table">
                    <tbody>
                      <tr>
                        <th>Job Title</th>
                        <td>Software Developer Intern (6 months)-Kuala Lumpur</td>
                      </tr>
                      <tr>
                        <th>Address</th>
                        <td>Suite 29-2, Level 29, Vertical Corporate Tower B, Avenue 10, Bangsar South City, No.8 Jalan Kerinchi Kuala Lumpur, Malaysia., 59200, Kuala Lumpur</td>
                      </tr>
                      <tr>
                        <th>Fields Area</th>
                        <td>Finance & Accounting</td>
                      </tr>
                      <tr>
                        <th>Allowance</th>
                        <td>RM 1,500.00 - RM 1,500.00</td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="cmpLFooter">
                    <p></p>
                    <a href='' class='cmpL-btn'>View</a>
                  </div>
                </div>
              </div>
            
          </section>
        </div>
		</div>
	</div>
	
	<script src="../../js/classie.js"></script>
	<script src="../../js/jquery.nicescroll.js"></script>
	<script src="../../js/scripts.js"></script>
	<script src="../../js/bootstrap.js"> </script>
</body>
</html>