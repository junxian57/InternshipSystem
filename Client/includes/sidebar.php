<?php
if (session_status() == PHP_SESSION_NONE) session_start();

if(isset($_SESSION)){
    $companyID = isset($_SESSION['companyID']) ? $_SESSION['companyID'] : false;
    $studentID = isset($_SESSION['studentID']) ? $_SESSION['studentID'] : false;
    $lecturerID = isset($_SESSION['lecturerID']) ? $_SESSION['lecturerID'] : false;
    $committeeID = isset($_SESSION['committeeID']) ? $_SESSION['committeeID'] : false;
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

        <?php if($lecturerID){ ?>
          <li>
            <a href="add-services.php"><i class="fa fa-user nav_icon"></i>Supervisor<span class="fa arrow"></span> </a>
            <ul class="nav nav-second-level collapse">
              <li>
                <a href="../page/br-StudentSupervisor-Manage.php">Student Management</a>
              </li>
              <!-- <li>
                <a href="#">Manage Users</a>
              </li> -->
            </ul>
          </li>
        <?php } ?>

        <?php if($companyID){ ?>
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

        <li>
          <a href="xt-recordWorkProgress.php"><i class="fa fa-book nav_icon"></i>Student Work Progress<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level collapse">
            <li>
              <a href="xt-displayRptTemplate.php">Report Template</a>
            </li>
            <li>
              <a href="xt-recordWorkProgress.php">Sample Report Format</a>
            </li>
            <li>
              <a href="print-work-progress.php">Print Reports</a>
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
              <a href="#">A</a>
            </li>
            <li>
              <a href="#">B</a>
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