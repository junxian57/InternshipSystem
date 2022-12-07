<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
/*if (strlen($_SESSION['bpmsaid'] == 0)) {
	//header('location:logout.php');
} else {*/
require '../../../config/email.php';
$mailConfig = new EmailConfig();
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>ITP System | My Offers</title>
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
					<h3 class="title1">My Offers</h3>
     
            <div id="searchResults" class="search-results-block">
              <section class="cmpList" id="cmpList">
                <div class="cmpList-container">
                <?php 
                    $host = "sql444.main-hosting.eu";
                    $user = "u928796707_group34";
                    $password = "u1VF3KYO1r|";
                    $database = "u928796707_internshipWeb";
                                            
                    $conn = mysqli_connect($host, $user, $password, $database); 

                    $get_offer = "SELECT * FROM InternApplicationMap WHERE studentID = '22REI00003' AND appStatus = 'Accepted'";
                    $run_offer = mysqli_query($conn, $get_offer);
                    while($row_offer = mysqli_fetch_array($run_offer)){
                      $internAppID = $row_offer['internAppID'];
                      $internJobID = $row_offer['internJobID'];
                      $appInternStartDate = $row_offer['appInternStartDate'];
                      $appInternEndDate = $row_offer['appInternEndDate'];
                      $appStudFeedback = $row_offer['appStudentFeedback'];

                      $get_job = "SELECT * FROM InternJob WHERE internJobID = '$internJobID'";
                      $run_job = mysqli_query($conn, $get_job);
                      $row_job = mysqli_fetch_array($run_job);
                      $cmpID = $row_job['companyID'];
                      $jobTitle = $row_job['jobTitle'];
                      $jobAllowance = $row_job['jobAllowance'];

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
                            <th>Job Title</th>
                            <td><?php echo $jobTitle; ?></td>
                          </tr>
                          <tr>
                            <th>Job Allowance</th>
                            <td>RM <?php echo $jobAllowance; ?></td>
                          </tr>
                          <tr>
                            <th>Intern Start Date</th>
                            <td><?php echo $appInternStartDate; ?></td>
                          </tr>
                          <tr>
                            <th>Intern End Date</th>
                            <td><?php echo $appInternEndDate; ?></td>
                          </tr>
                          <?php
                            if(($appStudFeedback <> 'Accept Offer') && ($appStudFeedback <> 'Decline Offer')){ ?>
                                </tbody>
                              </table>
                              <div class='cmpLFooter'>
                                <a class='cmpL-btn' id='acceptOffer' href='xt-studOfferList.php?acceptOffer=<?php echo "$internAppID"; ?>' style='background: #6af071;'>Accept</a>
                                <a class='cmpL-btn' id='declineOffer' href='xt-studOfferList.php?declineOffer=<?php echo "$internAppID"; ?>' style='background: tomato;'>Decline</a>
                              </div>
                            <?php }elseif ($appStudFeedback == 'Accept Offer'){ ?>
                                </tbody>
                              </table>
                              <div class='cmpLFooter'>
                                <a class='cmpL-btn' id='acceptOffer' style='background: #6af071;'>Accepted</a>
                              </div>
                            <?php }elseif ($appStudFeedback == 'Decline Offer'){ ?>
                                </tbody>
                              </table>
                              <div class='cmpLFooter'>
                                <a class='cmpL-btn' id='declinedOffer' style='background: tomato;'>Declined</a>
                              </div>
                            <?php } ?>
                       
                    </div>
                  </div>
                  <?php } ?>
                  
                  <center>
                    <ul class="job-pagination">
                      <?php
                        $query = "SELECT * FROM InternApplicationMap WHERE studentID = '22REI00003' AND appStatus = 'Accepted'";
                        $result = mysqli_query($conn,$query);
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
      if(isset($_GET['acceptOffer'])){
        $internAppID = $_GET['acceptOffer'];
        $sql = "SELECT * FROM InternApplicationMap WHERE internAppID = '$internAppID'";
        $run_off = mysqli_query($conn, $sql);
        $row_off = mysqli_fetch_array($run_off);
        $internJobID = $row_off['internJobID'];
        $studentID = $row_off['studentID'];
        $internStartDate = $row_off['appInternStartDate'];

        $get_job = "SELECT * FROM InternJob WHERE internJobID= '$internJobID'";
        $run_job = mysqli_query($conn, $get_job);
        $row_job = mysqli_fetch_array($run_job);
        $companyID = $row_job['companyID'];
        $jobTitle = $row_job['jobTitle'];
        $jobCmpSupervisor = $row_job['jobCmpSupervisor'];
        $jobSupervisorEmail = $row_job['jobSupervisorEmail'];

        $get_stud = "SELECT * FROM Student WHERE studentID = '$studentID'";
        $run_stud = mysqli_query($conn, $get_stud);
				$row_stud = mysqli_fetch_array($run_stud);
				$studentName = $row_stud['studName'];

        $get_cmp = "SELECT * FROM Company WHERE companyID = '$companyID'";
        $run_cmp = mysqli_query($conn, $get_cmp);
				$row_cmp = mysqli_fetch_array($run_cmp);
				$cmpName = $row_cmp['cmpName'];

        $query = "UPDATE InternApplicationMap SET appStudentFeedback ='Accept Offer' WHERE internAppID = '$internAppID'";
        if ((mysqli_query($conn, $query))){
            $success = $mailConfig->singleEmail(
              'wongxt-wm19@student.tarc.edu.my', 
              'Accept Internship Offer', 
              acceptOffer($jobCmpSupervisor, $jobTitle, $cmpName, $internStartDate, $studentName)
            );
            if($success){
              echo "<script>alert('You have accepted the internship offer.')</script>";
            }
        }
      }

      if(isset($_GET['declineOffer'])){
        $internAppID = $_GET['declineOffer'];
        $sql = "SELECT * FROM InternApplicationMap WHERE internAppID = '$internAppID'";
        $run_off = mysqli_query($conn, $sql);
        $row_off = mysqli_fetch_array($run_off);
        $internJobID = $row_off['internJobID'];
        $studentID = $row_off['studentID'];

        $get_job = "SELECT * FROM InternJob WHERE internJobID= '$internJobID'";
        $run_job = mysqli_query($conn, $get_job);
        $row_job = mysqli_fetch_array($run_job);
        $jobTitle = $row_job['jobTitle'];
        $jobCmpSupervisor = $row_job['jobCmpSupervisor'];
        $jobSupervisorEmail = $row_job['jobSupervisorEmail'];

        $get_stud = "SELECT * FROM Student WHERE studentID = '$studentID'";
        $run_stud = mysqli_query($conn, $get_stud);
				$row_stud = mysqli_fetch_array($run_stud);
				$studentName = $row_stud['studName'];

        $query = "UPDATE InternApplicationMap SET appStudentFeedback = 'Decline Offer' WHERE internAppID = '$internAppID'";
        if (mysqli_query($conn, $query)){
          $success = $mailConfig->singleEmail(
            'wongxt-wm19@student.tarc.edu.my', 
            'Decline an Internship Offer', 
            declineOffer($jobCmpSupervisor, $jobTitle, $studentName)
          );
          if($success){
            echo "<script>alert('You have declined the internship offer.')</script>";
          }
        }else{
          echo "Error: " . $sql . mysqli_error($conn);
        }
      }

      function acceptOffer($name, $jobTitle, $cmpName, $internStartDate, $studName){
        $html = "
        <html>
          <head>
            <title>Accept Internship Offer</title>
          </head>
          <body>
            <p>Dear $name,</p>
            <p>Thank you for the offer to become a $jobTitle intern at $cmpName. I am very pleased to <span style='color:#ff4500; font-weight: bold; text-decoration:underline;'>accept </span>this opportunity. I look forward to making a positive contribution to the company and learn as much as possible from the $cmpName.</p>
            <br>
            <p>I am excited to begin the internship on $internStartDate. If there is any additional information you need prior to then, please let me know.</p>
            <br>
            <p>Thank you.</p>
            <br>
            <p>Sincerely,</p>
            <p>$studName</p>
          </body>
        </html>";
  
        return $html;
      }

      function declineOffer($name, $jobTitle, $studName){
        $html = "
        <html>
          <head>
            <title>Decline an Internship Offer</title>
          </head>
          <body>
            <p>Dear $name,</p>
            <p>Thank you for the time and effort you spent considering me for a position as $jobTitle intern. I appreciate your time and effort, as well as those of your staff. I am grateful for your offer to serve and learn as an intern.</p>
            <p>After much thought and careful deliberation, however, I have decided <span style='color:#ff4500; font-weight: bold; text-decoration:underline;'>declined </span>your offer. I wish you and your employer the best continued success. I hope our paths will cross again in the future. Thank you again for your time and consideration.</p>
            <br>
            <p>Sincerely,</p>
            <p>$studName</p>
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