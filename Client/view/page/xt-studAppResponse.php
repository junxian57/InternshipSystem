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
              <button type="submit" id="approveBtn" class="approveBtn"><i class="fa fa-check" aria-hidden="true"></i>  Call for Interview</button>
              <button type="submit" id="rejectBtn" class="rejectBtn"><i class="fa fa-times" aria-hidden="true"></i>  Reject</button>
            </div>
          </div>
        </div>
		</div>
	</div>

  <div class="interviewForm">
    <div class="formContent">
      <div class="formWidget">
        <h1 id="heading1" class="intvw-header title">Interview Requests - <?php echo $cmpName; ?></h1>
        <div class="close">+</div>
      </div> 
      <form id="intvwForm" method="POST">
        <input type="datetime-local" id="start" class="start" name="start" value="2022-12-01T00:00:00" min="2022-12-01T00:00:00" max="2023-12-31T23:59:59">
        <select id="duration" name="duration" required>
          <option selected disabled value="duration">Duration*</option>
          <option value="15 Minutes">15 Minutes</option>
          <option value="30 Minutes">30 Minutes</option>
          <option value="45 Minutes">45 Minutes</option>
          <option value="60 Minutes">60 Minutes</option>
          <option value="75 Minutes">75 Minutes</option>
          <option value="90 Minutes">90 Minutes</option>
        </select>
        <textarea id="address" name="address" rows="4" placeholder="Location for Inteview*" required></textarea>
        <textarea id="things" name="things" rows="4" placeholder="Things to prepare or bring*" required></textarea>
        <button type="submit" id="confirmBtn" class="confirmBtn">Confirm</button>
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
    document.getElementById('approveBtn').addEventListener('click',
      function(){
        document.querySelector('.interviewForm').style.display = 'flex';
      });
      
      document.querySelector('.close').addEventListener('click',
        function(){
          document.querySelector('.interviewForm').style.display = 'none';
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