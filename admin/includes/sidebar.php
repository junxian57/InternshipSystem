<?php
if (session_status() == PHP_SESSION_NONE) session_start();

if(isset($_SESSION)){
    $lecturerID = isset($_SESSION['lecturerID']) ? $_SESSION['lecturerID'] : false;
    $committeeID = isset($_SESSION['committeeID']) ? $_SESSION['committeeID'] : false;
    $adminID = isset($_SESSION['adminID']) ? $_SESSION['adminID'] : false;
    $studentID = isset($_SESSION['studentID']) ? $_SESSION['studentID'] : false;
    $companyID = isset($_SESSION['companyID']) ? $_SESSION['companyID'] : false;
}else{
  //header("Location: ../index.php");
}
?>

<div class=" sidebar" role="navigation">
  <div class="navbar-collapse">
    <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
      <ul class="nav" id="side-menu">
        <li>
          <a href="dashboard.php"><i class="fa fa-home nav_icon"></i>Dashboard</a>
        </li>

        <li>
          <a href="#"><i class="fa fa-user nav_icon"></i>Users<span class="fa arrow"></span> </a>
          <ul class="nav nav-second-level collapse">
            <li>
              <a href="#">Add Users</a>
            </li>
            <li>
              <a href="#">Manage Users</a>
            </li>
          </ul>
        </li>

        <?php if($adminID || $committeeID) { ?>
          <li>
          <a href="#"><i class="fas fa-wrench"></i>Maintenance<span class="fa arrow"></span> </a>
            <ul class="nav nav-third-level collapse">
              <li>
                <a href="../page/ky-cmpMaintain.php">Maintain Company</a>
              </li>
              <li>
                <a href="../page/ky-studentMaintain.php">Maintain Student</a>
              </li>
            </ul>
          </li>
        <?php
        }
        ?>

        <?php if($adminID || $committeeID) { ?>
          <li>
          <a href="#"><i class="fas fa-wrench"></i>Invitation<span class="fa arrow"></span> </a>
            <ul class="nav nav-third-level collapse">
              <li>
                <a href="../page/ky-intCmpRegister.php">Invite Company</a>
              </li>
              <li>
                <a href="../page/ky-intStudRegister.php">Invite Student</a>
              </li>
            </ul>
          </li>
        <?php
        }
        ?>

        <?php if($adminID || $committeeID) { ?>
          <li>
            <a href="#"><i class="fa fa-building-o nav_icon"></i>Company<span class="fa arrow"></span> </a>
            <ul class="nav nav-second-level collapse">
              <li>
                <a href="../page/br-cmpAppTableReview.php">Company Application List</a>
              </li>
            </ul>
          </li>
        <?php } ?>

        <?php if($adminID || $committeeID) { ?>
          <li>
            <a href="#"><i class="fa fa-building-o nav_icon"></i>Student-Supervisor Mapping<span class="fa arrow"></span> </a>
            <ul class="nav nav-second-level collapse">
              <li>
                <a href="../page/br-StudentSupervisor-Map.php">Map Assignment</a>
              </li>
              <li>
                <a href="../page/br-StudentSupervisor-Maintain.php">Map Maintenance</a>
              </li>
            </ul>
          </li>
        <?php } ?>
        <li class="">
          <a href="about-us.php"><i class="fa fa-book nav_icon"></i>About <span class="fa arrow"></span></a>
          <ul class="nav nav-second-level collapse">
            <li>
              <a href="#">About Us</a>
            </li>
            <li>
              <a href="contact-us.php">Contact Us</a>
            </li>
          </ul>
          <!-- /nav-second-level -->
        </li>

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

        <li>
          <a href="../admin/view/page/viewWorkProgress.php"><i class="fa fa-book nav_icon"></i>Student Work Progress<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level collapse">
            <li>
              <a href="../admin/view/page/viewWorkProgress.php">All Work Progress</a>
            </li>
            <li>
              <a href="printWorkProgress.php">Print Reports</a>
            </li>
          </ul>
        </li>

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

        <li>
          <a href="#"><i class="fa fa-check-square-o nav_icon"></i>Assessment Rubrics<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level collapse">
            <li>
              <a href="../page/viewRubricAssessment.php">View All Assessment Rubrics</a>
            </li>
            <li>
              <a href="../page/addRubricAssessment.php">Add Rubric Assessment</a>
            </li>
            <li>
              <a href="../page/addRubricComponentCriteria.php">Add Rubric Criteria</a>
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
          <a href="index.php" class="chart-nav"><i class="fa fa-sign-out nav_icon"></i>Sign Out</a>
        </li>
        <hr style="background-color:transparent; border:none;">
        <hr style="background-color:transparent; border:none;">
        <div class="clearfix"> </div>
      </ul>
    </nav>
  </div>
</div>