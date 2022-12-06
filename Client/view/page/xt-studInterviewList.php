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
	<title>ITP System | My Interviews</title>
	<link href="../../css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="../../css/style.css" rel='stylesheet' type='text/css' />
	<link href="../../css/font-awesome.css" rel="stylesheet">
	<link href="../../css/xt-studInterviewList.css" rel="stylesheet">
  <link href="../../css/filter.css" rel="stylesheet">
	<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
	<link href="../../css/animate.css" rel="stylesheet" type="text/css" media="all">
	<link href="../../css/custom.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css" media="all" />
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
					<h3 class="title1">My Interviews</h3>
     
            <div id="searchResults" class="search-results-block">
              <section class="cmpList" id="cmpList">
                <div class="cmpList-container">
                <?php 
                    $host = "sql444.main-hosting.eu";
                    $user = "u928796707_group34";
                    $password = "u1VF3KYO1r|";
                    $database = "u928796707_internshipWeb";
                                            
                    $conn = mysqli_connect($host, $user, $password, $database); 

                    $per_page=6; 

                    if(isset($_GET['page'])){
                      $page = $_GET['page'];
                    }else{
                      $page = 1;
                    }

                    $start_from = ($page - 1) * $per_page;
                    $get_interview = "SELECT * FROM InternApplicationMap WHERE studentID = '22REI00003' AND appStatus = 'Shortlisted' LIMIT $start_from, $per_page";
                    $run_interview = mysqli_query($conn, $get_interview);
                    while($row_interview = mysqli_fetch_array($run_interview)){
                      $internAppID = $row_interview['internAppID'];
                      $internJobID = $row_interview['internJobID'];
                      $appStudFeedback = $row_interview['appStudentFeedback'];
                      $appInterviewDateTime = $row_interview['appInterviewDateTime'];
                      $appInterviewDuration = $row_interview['appInterviewDuration'];
                      $appInterviewLocation = $row_interview['appInterviewLocation'];

                      $get_job = "SELECT * FROM InternJob WHERE internJobID= '$internJobID'";
                      $run_job = mysqli_query($conn, $get_job);
                      $row_job = mysqli_fetch_array($run_job);
                      $cmpID = $row_job['companyID'];
                      $jobTitle = $row_job['jobTitle'];

                      $get_cmp = "SELECT * FROM Company WHERE companyID = '$cmpID'";
                      $run_cmp = mysqli_query($conn, $get_cmp);
								      $row_cmp = mysqli_fetch_array($run_cmp);
								      $cmpName = $row_cmp['cmpName'];
                  ?>

                  <div class='cmpL'>
                    <div class='cmpLimage'>
                      <img src='../images/taruc-logo.jpg'>
                    </div>
                    <div class='cmpLcontent'>
                      <h3><?php echo $cmpName; ?></h3>
                      <table class="table">
                        <tbody>
                          <tr>
                            <th>Interview Date & Time</th>
                            <td><?php echo $appInterviewDateTime; ?></td>
                          </tr>
                          <tr>
                            <th>Interview Duration</th>
                            <td><?php echo $appInterviewDuration; ?></td>
                          </tr>
                          <tr>
                            <th>Interview Location</th>
                            <td><?php echo $appInterviewLocation; ?></td>
                          </tr>
                          <?php
                            if(($appStudFeedback <> 'Accept Interview') && ($appStudFeedback <> 'Reject Interview')){
                              echo "</tbody>
                              </table>
                              <div class='cmpLFooter'>
                                <a class='cmpL-btn' id='acceptInterview' href='xt-studInterviewList.php?acceptInterview=$internAppID' style='background: #6af071;'>Accept</a>
                                <a class='cmpL-btn' id='rejectInterview' href='xt-studInterviewList.php?rejectInterview=$internAppID' style='background: tomato;'>Reject</a>
                              </div>";
                            }elseif ($appStudFeedback == 'Accept Interview'){
                              echo "</tbody>
                              </table>
                              <div class='cmpLFooter'>
                                <a class='cmpL-btn' id='acceptInterview' style='background: #6af071;'>Accepted</a>
                              </div>";
                            }else{
                              echo "</tbody>
                              </table>
                              <div class='cmpLFooter'>
                                <a class='cmpL-btn' id='acceptInterview' style='background: tomato;'>Rejected</a>
                              </div>";
                            }
                          ?>
                       
                    </div>
                  </div>
                  <?php } ?>
                  
                  <center>
                    <ul class="job-pagination">
                      <?php
                        $query = "SELECT * FROM InternApplicationMap WHERE studentID = '22REI00003' AND appStatus = 'Shortlisted'";
                        $result = mysqli_query($conn,$query);
                        $total_records = mysqli_num_rows($result);
                        $total_pages = ceil($total_records / $per_page);
                        echo "
                              <li>
                              <a href='xt-studInterviewList?page=1' class='fa-solid fa-arrow-left'></a></li>";
                              for($i=1; $i<=$total_pages; $i++){
                                echo "
                                      <li>
                                      <a href='xt-studInterviewList.php?page=".$i."'> ".$i." </a></li>";    
                                    };
                                    echo "
                                          <li>
                                          <a href='xt-studInterviewList.php?page=$total_pages' class='fa-solid fa-arrow-right'></a></li>"; 
                      ?> 
                    </ul>
                  </center>
                </section>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php
      require '../../../config/email.php';
      $mailConfig = new EmailConfig();

      if(isset($_GET['acceptInterview'])){
        $internAppID = $_GET['acceptInterview'];
        $sql = "SELECT * FROM InternApplicationMap WHERE internAppID = '$internAppID'";
        $run_intvw = mysqli_query($conn, $sql);
        $row_intvw = mysqli_fetch_array($run_intvw);
        $internJobID = $row_intvw['internJobID'];
        $studentID = $row_intvw['studentID'];
        $appInterviewDateTime = $row_intvw['appInterviewDateTime'];
        $appInterviewDuration = $row_intvw['appInterviewDuration'];
        $appInterviewLocation = $row_intvw['appInterviewLocation'];

        $get_job = "SELECT * FROM InternJob WHERE internJobID= '$internJobID'";
        $run_job = mysqli_query($conn, $get_job);
        $row_job = mysqli_fetch_array($run_job);
        $jobCmpSupervisor = $row_job['jobCmpSupervisor'];
        $jobSupervisorEmail = $row_job['jobSupervisorEmail'];

        $get_stud = "SELECT * FROM Student WHERE studentID = '$studentID'";
        $run_stud = mysqli_query($conn, $get_stud);
				$row_stud = mysqli_fetch_array($run_stud);
				$studentName = $row_stud['studName'];

        $query = "UPDATE InternApplicationMap SET appStudentFeedback ='Accept Interview' WHERE internAppID='$internAppID'";
        if ((mysqli_query($conn, $query))){
            $success = $mailConfig->singleEmail(
              $jobSupervisorEmail, 
              'Accept Interview Session', 
              acceptInterview($jobCmpSupervisor, $studentName, $appInterviewDateTime, $appInterviewDuration, $appInterviewLocation)
            );
            if($success){
              echo "<script>alert('You have accepted the interview session.')</script>";
            }
        }
      }

      if(isset($_GET['rejectInterview'])){
        $internAppID = $_GET['rejectInterview'];
        $sql = "SELECT * FROM InternApplicationMap WHERE internAppID = '$internAppID'";
        $run_intvw = mysqli_query($conn, $sql);
        $row_intvw = mysqli_fetch_array($run_intvw);
        $internJobID = $row_intvw['internJobID'];
        $studentID = $row_intvw['studentID'];
        $appInterviewDateTime = $row_intvw['appInterviewDateTime'];
        $appInterviewDuration = $row_intvw['appInterviewDuration'];
        $appInterviewLocation = $row_intvw['appInterviewLocation'];

        $get_job = "SELECT * FROM InternJob WHERE internJobID= '$internJobID'";
        $run_job = mysqli_query($conn, $get_job);
        $row_job = mysqli_fetch_array($run_job);
        $jobCmpSupervisor = $row_job['jobCmpSupervisor'];
        $jobSupervisorEmail = $row_job['jobSupervisorEmail'];

        $get_stud = "SELECT * FROM Student WHERE studentID = '$studentID'";
        $run_stud = mysqli_query($conn, $get_stud);
				$row_stud = mysqli_fetch_array($run_stud);
				$studentName = $row_stud['studName'];

        $query = "UPDATE InternApplicationMap SET appStudentFeedback ='Reject Interview' WHERE internAppID='$internAppID'";
        if ((mysqli_query($conn, $query))){
          $success = $mailConfig->singleEmail(
            $jobSupervisorEmail, 
            'Reject Interview Session', 
            rejectInterview($jobCmpSupervisor, $studentName)
          );
          if($success){
            echo "<script>alert('You have rejected the interview session.')</script>";
          }
        }
      }

      function acceptInterview($name, $studentName, $appInterviewDateTime, $appInterviewDuration, $appInterviewLocation){
        $html = "
        <html>
          <head>
            <title>Accept Interview Session</title>
          </head>
          <body>
            <p>Dear $name,</p>
            <p>The student <span style='font-weight: bold; color: blue;'>[$studentName]</span> have <span style='color:#ff4500; font-weight: bold; text-decoration:underline;'>accepted </span>the interview session.</p>
            <p>Interview Date & Time: <span style='font-weight: bold;'>$appInterviewDateTime</span></p>
            <p>Interview Duration: <span style='font-weight: bold;'>$appInterviewDuration</span></p>
            <p>Interview Location: <span style='font-weight: bold;'>$appInterviewLocation</span></p>
            <br>
            <p>Thank you.</p>
          </body>
        </html>";
  
        return $html;
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

  <script src="../../js/classie.js"></script>
	<script src="../../js/jquery.nicescroll.js"></script>
	<script src="../../js/scripts.js"></script>
	<script src="../../js/bootstrap.js"></script>
  <script src="../../js/filter.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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

  <script>
    $(document).ready(function(){
      function getInternJob(){
        var sPath = '';
        var aInputs = $('li').find('.get_cat');
        var aKeys = Array();
        var aValues = Array();
        
        iKey = 0;
        $.each(aInputs, function(key, oInput){
          if(oInput.checked){
            aKeys[iKey] = oInput.value
          };
          iKey++;
        });
        if(aKeys.length>0){
          var sPath = '';
          for(var i = 0; i < aKeys.length; i++){
            sPath = sPath + 'cat[]=' + aKeys[i]+'&';
          }
        }
        $.ajax({
          url:"load.php",
          method:"POST",
          data: sPath+'sAction=getInternJob',
          success:function(data){
            $('#cmpList').html('');
            $('#cmpList').html(data);
          }
        });
        
        $.ajax({
          url:"load.php",
          method:"POST",
          data: sPath+'sAction=getPaginator',
          success:function(data){
            $('.job-pagination').html('');
            $('.job-pagination').html(data);
          }
        });
      }
      
      $('.get_cat').click(function(){
        getInternJob();
        getPaginator();
      });
    });
  </script>

</body>
</html>