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
        
        <?php if($adminID || $committeeID) { ?>
          <li>
          <a href="#"><i class="fa fa-wrench nav_icon"></i>Maintenance<span class="fa arrow"></span> </a>
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
          <a href="#"><i class="fa fa-users nav_icon"></i>Invitation<span class="fa arrow"></span> </a>
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

        <?php if($adminID || $committeeID) { ?>
        <li>
          <a href="../page/xt-companiesSelection.php"><i class="fa fa-book nav_icon"></i>Companies Selection<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level collapse">
            <li>
              <a href="../page/xt-companiesSelection.php">Company List</a>
            </li>
          </ul>
        </li>
        <?php } ?>

        <?php if($adminID || $committeeID) { ?>
        <li>
          <a href="../page/xt-viewWorkProgress.php"><i class="fa fa-book nav_icon"></i>Student Work Progress<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level collapse">
            <li>
              <a href="../page/xt-viewWorkProgress.php">All Work Progress</a>
            </li>
          </ul>
        </li>
        <?php } ?>

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
          <a href="all-document.php"><i class="fa fa-file-text nav_icon"></i>Upload Document<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level collapse">
            <li>
              <a href="ty-createdocument.php">Upload Document</a>
            </li>
            <li>
              <a href="ty-viewdocument.php">View and Edit Document</a>
            </li>
          </ul>
        </li>

        <li>
          <a href="all-communcation.php"><i class="fa fa-comments nav_icon"></i>Communication<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level collapse">
            <li>
              <a href="joel-createMessage.php">Create Message</a>
            </li>
            <li>
              <a href="joel-viewMessage.php">View and Update Message</a>
            </li>
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