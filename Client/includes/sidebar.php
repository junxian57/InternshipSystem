<?php
if (session_status() == PHP_SESSION_NONE) session_start();

if (isset($_SESSION)) {
  $companyID = isset($_SESSION['companyID']) ? $_SESSION['companyID'] : false;
  $studentID = isset($_SESSION['studentID']) ? $_SESSION['studentID'] : false;
  $lecturerID = isset($_SESSION['lecturerID']) ? $_SESSION['lecturerID'] : false;
  $committeeID = isset($_SESSION['committeeID']) ? $_SESSION['committeeID'] : false;
} else {
  //header("Location: ../index.php");
}
?>
<div class=" sidebar" role="navigation">
  <div class="navbar-collapse">
    <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
      <ul class="nav" id="side-menu">
        <?php if ($lecturerID) { ?>
          <li>
            <a href="add-services.php"><i class="fa fa-user nav_icon"></i>Supervisor<span class="fa arrow"></span> </a>
            <ul class="nav nav-second-level collapse">
              <li>
                <a href="../page/br-StudentSupervisor-Manage.php">Student Management</a>
              </li>

            </ul>
          </li>
          <li>
            <a href="#"><i class="fa fa-check-square-o nav_icon"></i>Assessment Rubrics<span class="fa arrow"></span> </a>
            <ul class="nav nav-second-level collapse">
              <li>
                <a href="../page/listStudEvaluationByLecture.php">Evaluation Student Performance</a>
              </li>
            </ul>
          </li>
        <?php } ?>

        <?php if ($companyID) { ?>
          <li>
            <a href="#"><i class="fa fa-building-o nav_icon"></i>Company<span class="fa arrow"></span> </a>
            <ul class="nav nav-second-level collapse">
              <li>
                <a href="../page/br-companyInfo.php">Company Profile</a>
              </li>
              <li>
                <a href="../page/br-companyCreateJob.php">Internship Job Creation</a>
              </li>
              <li>
                <a href="../page/br-companyJobList.php">Internship Job List</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#"><i class="fa fa-building-o nav_icon"></i>Assessment Rubrics<span class="fa arrow"></span> </a>
            <ul class="nav nav-second-level collapse">
              <li>
                <a href="../page/jx-listStudEvaluationByCompany.php">Evaluation Student Performance</a>
              </li>
            </ul>
          </li>
        <?php } ?>

        <?php if ($studentID) { ?>
          <li>
            <a href="add-services.php"><i class="fa fa-user nav_icon"></i>Student<span class="fa arrow"></span> </a>
            <ul class="nav nav-second-level collapse">
              <li>
                <a href="../page/ky-updateCV.php">Update CV</a>
              </li>
            </ul>
          </li>
        <?php } ?>

        <li>
          <a href="all-appointment.php"><i class="fa fa-check-square-o nav_icon"></i>Appointment<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level collapse">
            <li>
              <a href="all-appointment.php">All Appointment</a>
            </li>
            <li>
              <a href="new-appointment.php">New Appointment</a>
            </li>
            <li>
              <a href="accepted-appointment.php">Accepted Appointment</a>
            </li>
            <li>
              <a href="rejected-appointment.php">Rejected Appointment</a>
            </li>
          </ul>
        </li>

        <li>
          <a href="#"><i class="fa fa-sitemap nav_icon"></i>Internship Batch<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level collapse">
            <li>
              <a href="#">Add New Internship Batch</a>
            </li>
            <li>
              <a href="#">Manage Internship Batch</a>
            </li>
          </ul>
        </li>

        <?php if ($studentID) { ?>
          <li>
            <a href="../page/xt-companiesList.php"><i class="fa fa-book nav_icon"></i>Companies<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
              <li>
                <a href="../page/xt-companiesList.php">Companies List</a>
              </li>
              <li>
                <a href="../page/xt-searchJob.php">Search Job</a>
              </li>
            </ul>
          </li>
        <?php } ?>

        <?php if ($studentID) { ?>
          <li>
            <a href="xt-displayRptTemplate.php"><i class="fa fa-book nav_icon"></i>Student Work Progress<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
              <li>
                <a href="../page/xt-displayRptTemplate.php">Report Template & Sample</a>
              </li>
              <li>
                <a href="../page/xt-viewWorkProgress.php">Monthly Work Progress</a>
              </li>
              <li>
                <a href="../page/xt-viewFinalReport.php">Final Report</a>
              </li>
            </ul>
          </li>
        <?php } ?>

        <?php if ($lecturerID) { ?>
          <li>
            <a href="xt-viewProgressList.php"><i class="fa fa-book nav_icon"></i>Student Work Progress<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
              <li>
                <a href="../page/xt-viewProgressList.php">All Work Progress</a>
              </li>
            </ul>
          </li>
        <?php } ?>

        <?php if ($studentID) { ?>
          <li>
            <a href="xt-studentJobApp.php"><i class="fa fa-book nav_icon"></i>Student Job Application<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
              <li>
                <a href="../page/xt-studInterviewList.php">My Interview</a>
              </li>
              <li>
                <a href="../page/xt-studOfferList.php">My Offer</a>
              </li>
            </ul>
          </li>
        <?php } ?>

        <?php if ($companyID) { ?>
          <li>
            <a href="xt-companyResponse.php"><i class="fa fa-book nav_icon"></i>Student Job Application<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
              <li>
                <a href="../page/xt-companyResponse.php">Application List</a>
              </li>
            </ul>
          </li>
        <?php } ?>

        <li>
          <a href="#"><i class="fa fa-users nav_icon"></i>Company Visitation<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level collapse">
            <li>
              <a href="#">A</a>
            </li>
            <li>
              <a href="#">B</a>
            </li>
          </ul>
        </li>
        <?php if ($studentID) { ?>
          <li>
            <a href="jx-displayEvaluationTemplate.php"><i class="fa fa-check-square-o nav_icon"></i>Assessment Rubrics<span class="fa arrow"></span></a>
          </li>
        <?php } ?>
        <li>
          <a href="all-document.php"><i class="fa fa-file-text nav_icon"></i>Document<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level collapse">
            <li>
              <a href="ty-documentList.php">Document List</a>
            </li>
          </ul>
        </li>


        <li>
          <a href="all-communcation.php"><i class="fa fa-comments nav_icon"></i>Communication<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level collapse">
            <li>
              <a href="joel-messageList.php">View Available Message</a>
            </li>
          </ul>
        </li>



        <li>
          <a href="#"><i class="fa fa-bell-o nav_icon"></i>Alerts<span class="fa arrow"></span> </a>
          <ul class="nav nav-second-level collapse">
            <li>
              <a href="#">Add Alerts</a>
            </li>
            <li>
              <a href="#">Manage Alerts</a>
            </li>
          </ul>
        </li>



        <li>
          <a href="#"><i class="fa fa-file nav_icon"></i>Reports<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level collapse">
            <li><a href="#">A</a></li>

            <li><a href="#">B</a></li>
          </ul>
        </li>

        <li>
          <a href="../../app/BLL/logoutBLL.php" class="chart-nav"><i class="fa fa-sign-out nav_icon"></i>Sign Out</a>
        </li>
        <hr style="background-color:transparent; border:none;">
        <hr style="background-color:transparent; border:none;">
        <div class="clearfix"> </div>
      </ul>
    </nav>
  </div>
</div>