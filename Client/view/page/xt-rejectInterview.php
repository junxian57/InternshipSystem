<?php
$host = "sql444.main-hosting.eu";
$user = "u928796707_group34";
$password = "u1VF3KYO1r|";
$database = "u928796707_internshipWeb";
                              
$conn = mysqli_connect($host, $user, $password, $database); 

require '../../../config/email.php';
$mailConfig = new EmailConfig();

include('../../includes/db_connection.php');

if(session_status() != PHP_SESSION_ACTIVE) session_start();

if (isset($_SESSION['studentChangePass'])) {
	header('Location: clientChangePassword.php?requireChangePass&notAllowed');
}
    
if (!isset($_SESSION['studentID'])) {
  echo "<script>
    window.location.href = 'clientLogin.php';
    </script>";
} else {
  $studID = $_SESSION['studentID'];
}


if(isset($_GET['rejectInterview'])){
  $internAppID = $_GET['rejectInterview'];
  $sql = "SELECT * FROM InternApplicationMap WHERE internAppID = '$internAppID'";
  $run_intvw = mysqli_query($conn, $sql);
  $row_intvw = mysqli_fetch_array($run_intvw);
  $internJobID = $row_intvw['internJobID'];
  $studentID = $row_intvw['studentID'];
  $appStudFeedback = $row_intvw['appStudentFeedback'];
  $appInterviewDateTime = $row_intvw['appInterviewDateTime'];
  $appInterviewDuration = $row_intvw['appInterviewDuration'];
  $appInterviewLocation = $row_intvw['appInterviewLocation'];
              
  $get_job = "SELECT * FROM InternJob WHERE internJobID= '$internJobID'";
  $run_job = mysqli_query($conn, $get_job);
  $row_job = mysqli_fetch_array($run_job);
  $cmpID = $row_job['companyID'];
  $jobTitle = $row_job['jobTitle'];
	$jobAllowance = $row_job['jobAllowance'];
  $jobCmpSupervisor = $row_job['jobCmpSupervisor'];
  $jobSupervisorEmail = $row_job['jobSupervisorEmail'];
              
  $get_stud = "SELECT * FROM Student WHERE studentID = '$studentID'";
  $run_stud = mysqli_query($conn, $get_stud);
  $row_stud = mysqli_fetch_array($run_stud);
  $studentName = $row_stud['studName'];

	$get_cmp = "SELECT * FROM Company WHERE companyID = '$cmpID'";
  $run_cmp = mysqli_query($conn, $get_cmp);
	$row_cmp = mysqli_fetch_array($run_cmp);
	$cmpName = $row_cmp['cmpName'];
}

if(isset($_GET['internAppID'])){
  $internAppID = $_GET['internAppID'];
  $appStudRejectReason = $_POST['appStudRejectReason'];
  $sql = "SELECT * FROM InternApplicationMap WHERE internAppID = '$internAppID'";
  $run_intvw = mysqli_query($conn, $sql);
  $row_intvw = mysqli_fetch_array($run_intvw);
  $internJobID = $row_intvw['internJobID'];
  $studentID = $row_intvw['studentID'];
  $appStudFeedback = $row_intvw['appStudentFeedback'];
  $appInterviewDateTime = $row_intvw['appInterviewDateTime'];
  $appInterviewDuration = $row_intvw['appInterviewDuration'];
  $appInterviewLocation = $row_intvw['appInterviewLocation'];
              
  $get_job = "SELECT * FROM InternJob WHERE internJobID= '$internJobID'";
  $run_job = mysqli_query($conn, $get_job);
  $row_job = mysqli_fetch_array($run_job);
  $cmpID = $row_job['companyID'];
  $jobTitle = $row_job['jobTitle'];
	$jobAllowance = $row_job['jobAllowance'];
  $jobCmpSupervisor = $row_job['jobCmpSupervisor'];
  $jobSupervisorEmail = $row_job['jobSupervisorEmail'];
              
  $get_stud = "SELECT * FROM Student WHERE studentID = '$studentID'";
  $run_stud = mysqli_query($conn, $get_stud);
  $row_stud = mysqli_fetch_array($run_stud);
  $studentName = $row_stud['studName'];

	$get_cmp = "SELECT * FROM Company WHERE companyID = '$cmpID'";
  $run_cmp = mysqli_query($conn, $get_cmp);
	$row_cmp = mysqli_fetch_array($run_cmp);
	$cmpName = $row_cmp['cmpName'];
  
  $query = "UPDATE InternApplicationMap SET appStudentFeedback ='Reject Interview', appStudRejectReason = '$appStudRejectReason' WHERE internAppID='$internAppID'";
  if ((mysqli_query($conn, $query))){
    $success = $mailConfig->singleEmail(
      'wongxt-wm19@student.tarc.edu.my', 
      'Reject Interview Session', 
      rejectInterview($jobCmpSupervisor, $studentName)
    );
    if($success){
      echo "<script>alert('You have rejected the interview session.')</script>";
      echo "<script>window.open('xt-rejectInterview.php?rejectInterview=$internAppID','_self')</script>";
    }
  }
}

function rejectInterview($name, $studentName){
  $html = "
    <html>
      <head>
        <title>Reject Interview Session</title>
      </head>
      <body>
        <p>Dear $name,</p>
        <p>The student <span style='font-weight: bold; color: blue;'>[$studentName]</span> have <span style='color:#ff4500; font-weight: bold; text-decoration:underline;'>rejected </span>the interview session.</p>
        <br>
        <p>Thank you.</p>
      </body>
    </html>";
  return $html;
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
	<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
	<title>ITP System | Job Details</title>
	
	
	<script src="../../js/jquery-1.11.1.min.js"></script>
  <script src="../../js/toastr.min.js"></script>
  <script src="../../js/customToastr.js"></script>
	
	<link href="../../css/toastr.min.css" rel="stylesheet">
	<link href="../../css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="../../css/style.css" rel='stylesheet' type='text/css' />
	<link href="../../css/font-awesome.css" rel="stylesheet">
	<link href="../../css/xt-jobDetails.css" rel="stylesheet">
	<link href="../../css/animate.css" rel="stylesheet" type="text/css" media="all">
	<link href="../../css/custom.css" rel="stylesheet">
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
	
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
				<div class="tables">
					<section class="details" id="details">
						<div class="details-row">
              <div class="detailsimage">
								<img src='../images/taruc-logo.jpg'>
							</div> 
						</div>
						
						<div class="details-row">
							<div class="details-content">
                <h1 class="heading" >Reject Interview Session</h1>
            	</div>
        		</div>
					</section>

					<section class="cmpdetails" id="cmpdetails">
						<h1 class="heading"> <span>Interview Session</span> Info </h1>
						<div class="cmpdetails-row">
							<div class="cmpdetails-image">
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.53663221214!2d101.72591861475746!3d3.2155572976588167!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc3843bfb6a031%3A0x2dc5e067aae3ab84!2sTunku%20Abdul%20Rahman%20University%20College%20(TAR%20UC)!5e0!3m2!1sen!2smy!4v1667794201482!5m2!1sen!2smy" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
							</div>
							
							<div class="cmpdetails-content">
								<h3><i class="fa-regular fa-envelope"></i>&nbsp Company Name</h3>
								<p><?php echo $cmpName; ?></p><br>
            		<h3><i class="fa-regular fa-address-book"></i>&nbsp Job Title</h3>
            		<p><?php echo $jobTitle; ?></p><br>
            		<h3><i class="fa-regular fa-building"></i>&nbsp Job Allowance</h3>
            		<p><?php echo $jobAllowance; ?></p><br>
            		<h3><i class="fa-solid fa-calendar-days"></i>&nbsp Interview Date & Time</h3>
            		<p><?php echo $appInterviewDateTime; ?></p><br>
								<h3><i class="fa-solid fa-calendar-days"></i>&nbsp Interview Duration</h3>
            		<p><?php echo $appInterviewDuration; ?></p><br>
                <h3><i class="fa-solid fa-signs-post"></i>&nbsp Interview Location</h3>
            		<p><?php echo $appInterviewLocation; ?></p><br>
        			</div>   
              <?php
              if(($appStudFeedback <> 'Accept Interview') && ($appStudFeedback <> 'Reject Interview')){
                echo "<div class='button-group'>
                        <button class='backBtn'><a href='xt-studInterviewList.php'>Back</a></button>
              	        <button type='submit' class='rejectInterview' id='rejectInterview'>Reject</button>
                      </div>";
              }elseif ($appStudFeedback == 'Accept Interview'){
                echo "<div class='button-group'>
                        <button class='backBtn'><a href='xt-studInterviewList.php'>Back</a></button>
                      </div>";
              }else{
                echo "<div class='button-group'>
                        <button class='backBtn'><a href='xt-studInterviewList.php'>Back</a></button>
                      </div>";
              }
              ?>
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>
	
  <div class="rejectForm">
    <div class="formContent">
      <div class="formWidget">
        <h1 id="heading1" class="reject-header title">Reject Interview Session - <?php echo $cmpName; ?></h1>
        <div class="closeR">+</div>
      </div> 
      <form id="rejectForm" method="POST" action="xt-rejectInterview.php?internAppID=<?php echo $internAppID; ?>">
        <textarea id="reason" name="appStudRejectReason" rows="4" placeholder="Reason of Reject Interview Session*" required></textarea>
        <button type="submit" id="confirmBtn" class="confirmBtn" name="confirm">Confirm</button>
      </form>
    </div>
  </div>

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

		function dateStrToObj(dateStr) {
      const [year, month, date] = dateStr.split('-').map(Number);
      return new Date(year, month - 1, date);
    }
    
    function onChange() {
			let internStart = new Date(document.getElementById("internStart").value);
      let internEnd = new Date(document.getElementById("internEnd").value);
      const startDateStr = document.querySelector('#internStart').value;
      const endDateStr = document.querySelector('#internEnd').value;
      
      if (!startDateStr || !endDateStr) return
      const startDate = dateStrToObj(startDateStr);
      const endDate = dateStrToObj(endDateStr);
      
      if (endDate.valueOf() < startDate.valueOf()) {
        warning('Intern End date is before intern start date!');
        document.getElementById("internEnd").value = document.getElementById("internStart").value;
      }
			else{
        if(internStart.getTime() && internEnd.getTime()){
          let timeDifference = internEnd.getTime() - internStart.getTime();

          let dayDifference = Math.abs(timeDifference / (1000 * 3600 *24));
          if(dayDifference < 60){
						info("Minimum training period is 3 months");
						var d = new Date(internStart);
						var y = d.getFullYear();
						var da = d.getDate();
						if(d.getMonth() >= 10){
							var y = d.getFullYear() + 1;
							var mm = d.getMonth() + 4;
							var m = mm - 12;
						}else{
							var y = d.getFullYear();
							var m = d.getMonth() + 4;
						}
						document.getElementById("internEnd").value = (da+'-'+m+'-'+y);
					}
        }
      }
    }
    
    for (const dateInput of document.querySelectorAll('input[type=date]')) {
      dateInput.addEventListener('change', onChange);
    }
	</script>

	<script>
    document.getElementById('rejectInterview').addEventListener('click',
      function(){
        document.querySelector('.rejectForm').style.display = 'flex';
      });
      
      document.querySelector('.closeR').addEventListener('click',
        function(){
          document.querySelector('.rejectForm').style.display = 'none';
        })
  </script>

	<script src="../../js/jquery.nicescroll.js"></script>
	<script src="../../js/scripts.js"></script>
	<script src="../../js/bootstrap.js"> </script>
</body>
</html>