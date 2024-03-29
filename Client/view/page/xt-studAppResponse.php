<?php
	include('../../includes/db_connection.php');

  if(session_status() != PHP_SESSION_ACTIVE) session_start();
    
  if (!isset($_SESSION['companyID'])) {
    echo "<script>
        window.location.href = 'clientLogin.php';
    </script>";
	} else {
    $companyID = $_SESSION['companyID'];
  }

	if(isset($_GET['InternAppID'])){
    $internAppID = $_GET['InternAppID'];
  }
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

  <style>
    #studentCV{
      width: 890px;
      height: 1000px;
    }
  </style>
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
            
            <?php
								$host = "sql444.main-hosting.eu";
                $user = "u928796707_group34";
                $password = "u1VF3KYO1r|";
                $database = "u928796707_internshipWeb";
                                              
                $conn = mysqli_connect($host, $user, $password, $database); 

                $get_app = "SELECT * FROM InternApplicationMap WHERE internAppID = '$internAppID'";
                $run_app = mysqli_query($conn, $get_app);
                $row_app = mysqli_fetch_array($run_app);
                $internJobID = $row_app['internJobID'];
                $studentID = $row_app['studentID'];
                $appInternStartDate = $row_app['appInternStartDate'];
                $appInternEndDate = $row_app['appInternEndDate'];
                $appInterviewDateTime = $row_app['appInterviewDateTime'];
                $appInterviewLocation = $row_app['appInterviewLocation'];

                $get_intern = "SELECT * FROM InternJob WHERE internJobID = '$internJobID'";
								$run_intern = mysqli_query($conn, $get_intern);
								$row_intern = mysqli_fetch_array($run_intern);
                $cmpID = $row_intern['companyID'];
								$jobTitle = $row_intern['jobTitle'];
                $jobLocationOfWork = $row_intern['jobLocationOfWork'];
                $jobAllowance = $row_intern['jobAllowance'];
                $jobCmpSupervisor = $row_intern['jobCmpSupervisor'];
                $jobSupervisorEmail = $row_intern['jobSupervisorEmail'];
                $jobSupervisorContactNo = $row_intern['jobSupervisorContactNo'];

                $get_cmp = "SELECT * FROM Company WHERE companyID = '$cmpID'";
								$run_cmp = mysqli_query($conn, $get_cmp);
								$row_cmp = mysqli_fetch_array($run_cmp);
                $cmpName = $row_cmp['cmpName'];

								$getStud = "SELECT * FROM Student WHERE studentID = '$studentID'";
								$runStud = mysqli_query($conn, $getStud);
								$rowStud = mysqli_fetch_array($runStud);
                $programmeID = $rowStud['programmeID'];
								$studName = $rowStud['studName'];
                $studEmail = $rowStud['studEmail'];
                $studContactNumber = $rowStud['studContactNumber'];
                $studHomeAddress = $rowStud['studHomeAddress'];
                $studApplicationQuota = $rowStud['studApplicationQuota'];
                $applicationQuota = intval($studApplicationQuota);

                $getProgramme = "SELECT * FROM Programme WHERE programmeID = '$programmeID'";
                $runProgramme = mysqli_query($conn, $getProgramme);
                $rowProgramme = mysqli_fetch_array($runProgramme);
                $programmeName = $rowProgramme['programmeName'];
                $departmentID = $rowProgramme['departmentID'];

                $getDept = "SELECT * FROM Department WHERE departmentID = '$departmentID'";
                $runDept = mysqli_query($conn, $getDept);
                $rowDept = mysqli_fetch_array($runDept);
                $facultyID = $rowDept['facultyID'];

                $getFac = "SELECT * FROM Faculty WHERE facultyID = '$facultyID'";
                $runFac = mysqli_query($conn, $getFac);
                $rowFac = mysqli_fetch_array($runFac);
                $facName = $rowFac['facName'];

                $date1 = $appInternStartDate;
                $date2 = $appInternEndDate;
                $d1=new DateTime($date2); 
                $d2=new DateTime($date1);                                  
                $months = $d2->diff($d1); 
                $monthDuration = (($months->y) * 12) + ($months->m);
              ?>

            <div class="inputBox">
              <div class="viewInput">
                <span>Interview Date & Time</span>
                <input type="text" name="inDateTime" readonly value="<?php echo $appInterviewDateTime; ?>">
              </div>

              <div class="viewInput" style="width:100%;">
                <span>Location</span>
                <textarea type="text" name="inLocation" readonly><?php echo $appInterviewLocation; ?></textarea>
              </div> 
            </div>

            <div class="subtitle">
              <h2 class="sub-1">Student General Information</h2>
            </div>
            
            <div class="inputBox">
              <div class="viewInput">
                <span>Student ID</span>
                <input type="text" name="studID" readonly value="<?php echo $studentID; ?>">
              </div>
            
              <div class="viewInput">
                <span>Student Name</span>
                <input type="text" name="studName" readonly value="<?php echo $studName; ?>">
              </div>

              <div class="viewInput">
                <span>Email</span>
                <input type="text" name="studEmail" readonly value="<?php echo $studEmail; ?>">
              </div>
            
              <div class="viewInput">
                <span>Contact Number</span>
                <input type="text" name="studContactNumber" readonly value="<?php echo $studContactNumber; ?>">
              </div>

              <div class="viewInput" style="width:100%;">
                <span>Address</span>
                <textarea type="text" name="studHomeAddress" readonly><?php echo $studHomeAddress; ?></textarea>
              </div> 
            </div>
            
            <div class="subtitle">
              <h2 class="sub-1">Academic Details</h2>
            </div>
            
            <div class="inputBox">
              <div class="viewInput">
                <span>Faculty</span>
                <input type="text" name="studFaculty" readonly value="<?php echo $facName; ?>">
              </div>
            
              <div class="viewInput">
                <span>Programme</span>
                <input type="text" name="studProgramme" readonly value="<?php echo $programmeName; ?>">
              </div>
            </div>

            <div class="subtitle">
              <h2 class="sub-2">Job Applied</h2>
            </div>
            
            <div class="inputBox">
              <div class="viewInput">
                <span>Job ID</span>
                <input type="text" name="jobID" readonly value="<?php echo $internJobID; ?>">
              </div>

              <div class="viewInput">
                <span>Job Title</span>
                <input type="text" name="jobTitle" readonly value="<?php echo $jobTitle; ?>">
              </div>
            </div>

            <div class="subtitle">
              <h2 class="sub-2">Internship Details</h2>
            </div>

            <div class="inputBox">
              <div class="viewInput">
                <span>Internship Start Date</span>
                <input type="date" name="internStart" readonly value="<?php echo $appInternStartDate; ?>" style="height: 41.5px;">
              </div>
            
              <div class="viewInput">
                <span>Internship End Date</span>
                <input type="date" name="internEnd" readonly value="<?php echo $appInternEndDate; ?>" style="height: 41.5px;">
              </div>
            </div>

            <div class="subtitle">
              <h2 class="sub-3">Supporting Document - Student CV</h2>
            </div>
            
            <div class="inputBox">
              <div class="viewInput">
                <div id="studentCV">
                <?php
                  echo '<iframe src="../../../Client/view/document/StudentCV/'.$studentID.' - '.$studName.'.pdf" width="100%" style="height:100%"></iframe>';
                ?>
                </div>
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
        <h1 id="heading1" name="cmpName" class="accept-header title">Offer Letter Details - <?php echo $cmpName; ?></h1>
        <div class="close">+</div>
      </div> 
      <form action="xt-offerLetter.php?internAppID=<?php echo $internAppID;?>" id="acceptForm" method="POST">
        <span>Student Details</span><br>
        <input type="text" id="studName" name="studName" placeholder="Student Name*" value="<?php echo $studName; ?>" readonly>
        <input type="text" id="studID" name="studID" placeholder="Student ID*" value="<?php echo $studentID; ?>" readonly>
        <span>Intern Job Details</span><br>
        <input type="text" id="internJobID" name="internJobID" placeholder="Intern Job ID*" value="<?php echo "$internJobID"; ?>" readonly>
        <input type="text" id="position" name="position" placeholder="Intern Position*" value="<?php echo $jobTitle; ?>" readonly>
        <input type="text" id="allowance" name="allowance" placeholder="Allowance*" value="<?php echo "$jobAllowance"; ?>" readonly>
        <textarea id="location" name="location" rows="4" placeholder="Working Location*" readonly><?php echo $jobLocationOfWork; ?></textarea>
        <input type="text" id="period" name="period" placeholder="Intern Period*" value="<?php echo "$monthDuration months"?>" style="width: 91.5%;" readonly>
        <input type="date" name="start" style="margin-right: 5px" value="<?php echo $appInternStartDate; ?>" readonly>to<input type="date" name="end" style="margin-left: 5px" value="<?php echo $appInternEndDate; ?>" readonly>
        <span>Supervisor Details</span><br>
        <input type="text" id="supName" name="supName" placeholder="Supervisor Name*" value="<?php echo $jobCmpSupervisor; ?>" readonly>
        <input type="tel" id="supContact" name="supContact" placeholder="Contact*" value="<?php echo $jobSupervisorContactNo; ?>" readonly>
        <input type="email" id="supEmail" name="supEmail" placeholder="Email*" value="<?php echo $jobSupervisorEmail; ?>" readonly><br>
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
        <button type="submit" id="confirmBtn" class="confirmBtn" name="reject">Confirm</button>
      </form>
    </div>
  </div>

  <?php
    if(isset($_POST['reject'])){
      require '../../../config/email.php';
      $mailConfig = new EmailConfig();
      $reason = $_POST['reason'];
      $subject = "Internship Applicant Immediate Rejection";

      $sql = "UPDATE InternApplicationMap SET appRejectReason='$reason', appStatus='Rejected' WHERE internAppID='$internAppID'";
      $applicationQuota = $applicationQuota + 1;
      $query = "UPDATE Student SET studApplicationQuota ='$applicationQuota' WHERE studentID='$studentID'";

      if ((mysqli_query($conn, $sql)) && (mysqli_query($conn, $query))){
        $success = $mailConfig->singleEmail(
          'wongxt-wm19@student.tarc.edu.my', 
          $subject, 
          rejectApp($studName, $cmpName, $internAppID, $reason)
        );
      }
    }

    function rejectApp($name, $cmpName, $internAppID, $reason){
      $html = "
      <html>
        <head>
          <title>Internship Applicant Immediate Rejection</title>
        </head>
        <body>
          <p>Dear $name,</p>
          <p>Thank you for your application to $cmpName.</p>
          <p>We have evaluated your resume and determined that your experience and coursework do not match our hiring criteria for this position. Your intern job application <span style='font-weight: bold; color: blue;'>[$internAppID]</span> has been <span style='color:#ff4500; font-weight: bold; text-decoration:underline;'>rejected</span>.</p>
          <p>Reject reason: <span style='font-weight: bold;'>$reason</span></p>
          <p>Your interest in our organization is greatly appreciated and we wish you success in your future endeavors.</p>
          <br>
          <p>Thank you.</p>
        </body>
      </html>";

      return $html;
    }
  ?>


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