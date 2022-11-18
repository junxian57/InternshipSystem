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
	<title>ITP System | Student Job Application</title>
	<link href="../../css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="../../css/style.css" rel='stylesheet' type='text/css' />
	<link href="../../css/font-awesome.css" rel="stylesheet">
	<link href="../../css/xt-studentAppReview.css" rel="stylesheet">
	<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
	<link href="../../css/animate.css" rel="stylesheet" type="text/css" media="all">
	<link href="../../css/custom.css" rel="stylesheet">

	<script src="../../js/jquery-1.11.1.min.js"></script>
	<script src="../../js/modernizr.custom.js"></script>
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
					<h3 class="title1">Student Job Application Review</h3>
          <div class="container">
          <div class="subtitle">
              <h2 class="sub-1">Interview Details</h2>
            </div>
            
            <div class="inputBox">
              <div class="viewInput">
                <span>Interview Date</span>
                <input type="text" name="studID" readonly value="<?php echo$studID; ?>">
              </div>
            
              <div class="viewInput">
                <span>Interview Time</span>
                <input type="text" name="studName" readonly value="<?php echo$studName; ?>">
              </div>

              <div class="viewInput" style="width:100%;">
                <span>Location</span>
                <textarea type="text" name="cmpAddress" readonly value="<?php echo$cmpAddress; ?>"></textarea>
              </div> 
            </div>

            <div class="subtitle">
              <h2 class="sub-1">Student General Information</h2>
            </div>
            
            <div class="inputBox">
              <div class="viewInput">
                <span>Student ID</span>
                <input type="text" name="studID" readonly value="<?php echo$studID; ?>">
              </div>
            
              <div class="viewInput">
                <span>Student Name</span>
                <input type="text" name="studName" readonly value="<?php echo$studName; ?>">
              </div>

              <div class="viewInput">
                <span>Email</span>
                <input type="text" name="studEmail" readonly value="<?php echo$studEmail; ?>">
              </div>
            
              <div class="viewInput">
                <span>Contact Number</span>
                <input type="text" name="studContactNumber" readonly value="<?php echo$studContactNumber; ?>">
              </div>

              <div class="viewInput" style="width:100%;">
                <span>Address</span>
                <textarea type="text" name="cmpAddress" readonly value="<?php echo$cmpAddress; ?>"></textarea>
              </div> 
            </div>
            
            <div class="subtitle">
              <h2 class="sub-1">Academic Details</h2>
            </div>
            
            <div class="inputBox">
              <div class="viewInput">
                <span>Faculty</span>
                <input type="text" name="studFaculty" readonly value="<?php echo$studFaculty; ?>">
              </div>
            
              <div class="viewInput">
                <span>Programme</span>
                <input type="text" name="studProgramme" readonly value="<?php echo$studProgramme; ?>">
              </div>
            </div>

            <div class="subtitle">
              <h2 class="sub-2">Job Applied</h2>
            </div>
            
            <div class="inputBox">
              <div class="viewInput">
                <span>Job ID</span>
                <input type="text" name="jobID" readonly value="<?php echo$jobID; ?>">
              </div>

              <div class="viewInput">
                <span>Job Title</span>
                <input type="text" name="jobTitle" readonly value="<?php echo$jobTitle; ?>">
              </div>
            </div>

            <div class="subtitle">
              <h2 class="sub-2">Skill & Experience</h2>
            </div>
            
            <div class="inputBox">
              <div class="viewInput" style="width:100%;">
                <span>Skills</span>
                <textarea type="text" name="studSkill" readonly value="<?php echo$studSkill; ?>"></textarea>
              </div> 

              <div class="viewInput" style="width:100%;">
                <span>Working Experiences</span>
                <textarea type="text" name="studWorkExpc" readonly value="<?php echo$studWorkExpc; ?>"></textarea>
              </div> 

              <div class="viewInput" style="width:100%;">
                <span>Languages Proficiency</span>
                <input type="text" name="studLanguage" readonly value="<?php echo$studLanguage; ?>">
              </div>
            </div>

            <div class="subtitle">
              <h2 class="sub-3">Supporting Document</h2>
            </div>
            
            <div class="inputBox">
              <div class="viewInput">
                <span>Student CV</span>
                <input type="file" name="cmpCompanySize" readonly value="<?php echo$cmpCompanySize; ?>">
              </div>
            </div>
            
            <div class="button-group">
              <button type="submit" id="acceptBtn" class="acceptBtn"><i class="fa fa-check" aria-hidden="true"></i>  Accept</button>
              <button type="submit" id="rejectBtn" class="rejectBtn"><i class="fa fa-times" aria-hidden="true"></i>  Reject</button>
            </div>
          </div>
        </div>
		</div>
	</div>

  <div class="acceptForm">
    <div class="formContent">
      <div class="formWidget">
        <h1 id="heading1" class="accept-header title">Offer Letter Details - <?php echo $cmpName; ?></h1>
        <div class="close">+</div>
      </div> 
      <form action="xt-offerLetter.php" id="acceptForm" method="POST">
        <span>Student Details</span><br>
        <input type="text" id="studName" name="studName" placeholder="Student Name*" required>
        <input type="text" id="nric" name="nric" placeholder="NRIC*" required>
        <span>Intern Job Details</span><br>
        <input type="text" id="allowance" name="allowance" placeholder="Allowance*" required>
        <input type="text" id="position" name="position" placeholder="Intern Position*" required>
        <textarea id="location" name="location" rows="4" placeholder="Working Location*" required></textarea>
        <select id="period" name="period" style="width: 91.5%" required>
          <option selected disabled value="period">Intern Period*</option>
          <option value="3">3 Months</option>
          <option value="6">6 Months</option>
          <option value="9">9 Months</option>
          <option value="12">12 Months</option>
        </select>
        <input type="date" value="2022-12-01" name="start" style="margin-right: 5px" required>to<input type="date" value="2022-12-01" name="end" style="margin-left: 5px" required>
        <span>Supervisor Details</span><br>
        <input type="text" id="supName" name="supName" placeholder="Supervisor Name*" required>
        <input type="tel" id="supContact" name="supContact" placeholder="Contact*" required>
        <input type="email" id="supEmail" name="supEmail" placeholder="Email*" required><br>
        <button type="submit" id="confirmBtn" class="confirmBtn" name="create">Confirm</button>
      </form>
    </div>
  </div>

  <div class="rejectForm">
    <div class="formContent">
      <div class="formWidget">
        <h1 id="heading1" class="reject-header title">Reject Application - <?php echo $cmpName; ?></h1>
        <div class="closeR">+</div>
      </div> 
      <form id="rejectForm" method="POST">
        <textarea id="reason" name="reason" rows="4" placeholder="Reason of Reject*" required></textarea>
        <button type="submit" id="confirmBtn" class="confirmBtn">Confirm</button>
      </form>
    </div>
  </div>

  <script>
    document.getElementById('acceptBtn').addEventListener('click',
      function(){
        document.querySelector('.acceptForm').style.display = 'flex';
      });
      
      document.querySelector('.close').addEventListener('click',
        function(){
          document.querySelector('.acceptForm').style.display = 'none';
        })

    document.getElementById('rejectBtn').addEventListener('click',
      function(){
        document.querySelector('.rejectForm').style.display = 'flex';
      });
      
      document.querySelector('.closeR').addEventListener('click',
        function(){
          document.querySelector('.rejectForm').style.display = 'none';
        })
  </script>
	
	<script src="../../js/classie.js"></script>
	<script src="../../js/jquery.nicescroll.js"></script>
	<script src="../../js/scripts.js"></script>
	<script src="../../js/bootstrap.js"> </script>
</body>
</html>