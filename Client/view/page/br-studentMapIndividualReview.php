<?php
$systemPathPrefix = $_SERVER['DOCUMENT_ROOT'].'/InternshipSystem/Client/';
require_once $systemPathPrefix.'app/DAL/studentMapDAL.php';

if(session_status() != PHP_SESSION_ACTIVE) session_start();

if(!isset($_SESSION['lecturerID'])){
  echo "<script>
      window.location.href = 'clientLogin.php';
  </script>";
}

if(!isset($_GET['studentID']) && !isset($_GET['individualView']) && !isset($_GET['accountStatus']) && !isset($_SESSION['lecturerID'])){
    header("Location: br-StudentSupervisor-Manage.php");
    exit();
}

$accountStatus = $_GET['accountStatus'];
$studentArr = array();

if(isset($_GET['studentID']) && isset($_GET['individualView']) && isset($_GET['accountStatus']) && $_GET['accountStatus'] == 'Active'){
  
  $studentID = $_GET['studentID'];
  $result = getStudentInfoOnly($studentID);

  if(count($result) > 0){
    foreach($result as $student){
      $studentArr[] = array(
        "studentID" => $student['studentID'],
        "studName" => $student['studName'],
        "studContactNumber" => $student['studContactNumber'],
        "studEmail" => $student['studEmail'],
        "internshipBatchID" => $student['internshipBatchID'],
        "programmeAcronym" => $student['programmeAcronym'],
        "tutorialGroupNo" => $student['tutorialGroupNo'],
        "studentYear" => $student['studentYear'],
        "studentSemester" => $student['studentSemester'],
        "studentCVdocument" => $student['studentCVdocument']
      );
    }
  }else{
    echo "<script>alert('No Data Found');</script>";
  }

}elseif(isset($_GET['studentID']) && isset($_GET['individualView']) && isset($_GET['accountStatus']) && $_GET['accountStatus'] == 'Intern'){
  $studentID = $_GET['studentID'];
  
  $result = getStudentAndInternCompany($studentID);
  
  if( $result != null && count($result) > 0){
    foreach($result as $student){
      $studentArr[] = array(
        "studentID" => $student['studentID'],
        "studName" => $student['studName'],
        "studContactNumber" => $student['studContactNumber'],
        "studEmail" => $student['studEmail'],
        "internshipBatchID" => $student['internshipBatchID'],
        "programmeAcronym" => $student['programmeAcronym'],
        "tutorialGroupNo" => $student['tutorialGroupNo'],
        "studentYear" => $student['studentYear'],
        "studentSemester" => $student['studentSemester'],
        "studentCVdocument" => $student['studentCVdocument'],

        "cmpName" => $student['cmpName'],
        "appInternStartDate" => $student['appInternStartDate'],
        "appInternEndDate" => $student['appInternEndDate'],
        "jobCmpSupervisor" => $student['jobCmpSupervisor'],
        "jobSupervisorContactNo" => $student['jobSupervisorContactNo'],
        "jobSupervisorEmail" => $student['jobSupervisorEmail']
      );
    }
  }else{
    echo "<script>
    alert('No Data Found');
    window.location.href = 'br-StudentSupervisor-Manage.php';
    </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Details | Name</title>
    <link href="../../css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="../../css/style.css" rel="stylesheet" type="text/css" />
    <link href="../../css/font-awesome.css" rel="stylesheet" />
    <script src="../../js/jquery-1.11.1.min.js"></script>
    <script src="../../js/modernizr.custom.js"></script>
    <link
      href="//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="../../css/animate.css"
      rel="stylesheet"
      type="text/css"
      media="all"
    />
    <script src="../../js/wow.min.js"></script>
    <script>
      new WOW().init();
    </script>
    <script src="../../js/metisMenu.min.js"></script>
    <script src="../../js/custom.js"></script>
    <link href="../../css/custom.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../scss/br-studentMapReview.css" />
  </head>
  <body>
    <header>
      <div class="page-title">
        <h4>Tunku Abdul Rahman University College</h4>
        <h3>Internship System</h3>
      </div>
    </header>

    <div class="content">
      <div class="wrapper">
        <form action="#">
          <h3 class="form-title">Student Information</h3>
          <div class="title">
            <h2>Student Details</h2>
          </div>

          <div class="horizon-wrap">
            <div class="input-style name-address-group">
              <label for="studentName">Name</label>
              <input type="text" name="studentName" readonly value="<?php echo $studentArr[0]['studName'] ?>" />
            </div>

            <div class="input-style name-address-group">
              <label for="studentID">ID No.</label>
              <input type="text" name="studentID" readonly value="<?php echo $studentArr[0]['studentID'] ?>" />
            </div>
          </div>

          <div class="horizon-wrap">
            <div class="input-style name-address-group">
              <label for="studentContactNo">Contact No.</label>
              <input type="text" name="studentContactNo" readonly value="<?php echo $studentArr[0]['studContactNumber'] ?>" />
            </div>

            <div class="input-style name-address-group">
              <label for="studentEmail">Email Address</label>
              <input type="email" name="studentEmail" readonly value="<?php echo $studentArr[0]['studEmail'] ?>" />
            </div>
          </div>

          <div class="horizon-wrap">
            <div class="input-style name-address-group">
              <label for="studentInternNo">Internship Batch Number</label>
              <input type="text" name="studentInternNo" readonly value="<?php echo $studentArr[0]['internshipBatchID'] ?>" />
            </div>

            <div class="input-style name-address-group">
              <label for="studentProgramme">Programme</label>
              <input type="text" name="studentProgramme" readonly value="<?php echo $studentArr[0]['programmeAcronym'] ?>" />
            </div>
          </div>

          <div class="horizon-wrap">
            <div class="input-style name-address-group">
              <label for="studyYear">Year</label>
              <input type="text" name="studyYear" readonly value="<?php echo $studentArr[0]['studentYear'] ?>" />
            </div>

            <div class="input-style name-address-group">
              <label for="studySemGroup">Semester / Group</label>
              <input type="text" name="studentProgramme" readonly value="<?php echo $studentArr[0]['studentSemester'].' / '.$studentArr[0]['tutorialGroupNo'] ?>" />
            </div>
          </div>

          <hr />
          <div class="title">
            <h2 class="margin-top-20">Internship Company</h2>
          </div>

          <?php
            if($accountStatus == 'Intern'){
          ?>

            <div class="horizon-wrap">
              <div class="input-style name-address-group">
                <label for="companyName">Company Name</label>
                <input type="text" name="companyName" readonly value="<?php echo $studentArr[0]['cmpName'] ?>"/>
              </div>

              <div class="input-style name-address-group">
                <label for="companySupervisor">Supervisor</label>
                <input type="text" name="companySupervisor" readonly value="<?php echo $studentArr[0]['jobCmpSupervisor'] ?>"/>
              </div>
            </div>

            <div class="horizon-wrap">
              <div class="input-style name-address-group">
                <label for="companyContact">Contact No.</label>
                <input type="text" name="companyContact" readonly value="<?php echo $studentArr[0]['jobSupervisorContactNo'] ?>"/>
              </div>

              <div class="input-style name-address-group">
                <label for="companyEmail">Email Address</label>
                <input type="email" name="companyEmail" readonly value="<?php echo $studentArr[0]['jobSupervisorEmail'] ?>"/>
              </div>
            </div>
            
            <div class="horizon-wrap">
              <div class="input-style name-address-group">
                <label for="internStartDate">Internship Start Date</label>
                <input type="text" name="internStartDate" readonly value="<?php echo $studentArr[0]['appInternStartDate'] ?>"/>
              </div>

              <span class="arrow-icon">&#129050</span>

              <div class="input-style name-address-group">
                <label for="internEndDate">Internship End Date</label>
                <input type="text" name="internEndDate" readonly value="<?php echo $studentArr[0]['appInternEndDate'] ?>"/>
              </div>
            </div>

          <?php
            }else{
          ?>
            <div>
              <marquee direction="right" 
                  behavior="alternate" 
                  style="border:#ff4500 2px solid; margin-top:10px; letter-spacing:2px; font-weight:bold; font-size:1.5em;">
                  Student Has No Company Yet
              </marquee>
            </div>
          <?php
            }
          ?>

          <hr />
          <div class="title margin-btm-20">
            <h2 class="margin-top-20">Student Document</h2>
          </div>   
          <div class="horizon-wrap">
            <div class="name-address-group margin-top-20 select-style">
              <label for="weeklyReport">CV / Resume</label>
              <?php
                if($studentArr[0]['studentCVdocument'] != null){
                  $studentCV = $studentArr[0]['studentCVdocument'];
              ?>
                <a id="cvBtn" target="_blank" href="../../app/BLL/previewCV.php?path=<?php echo $studentCV; ?>">Preview</a>
              <?php
                }else{
              ?>
                <a id="cvBtn" class="grey-btn" disabled>Not Available</a>
              <?php
                }
              ?>
            </div>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
