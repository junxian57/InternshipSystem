<?php
if (session_status() == PHP_SESSION_NONE) session_start();

include_once('db_connection.php');
$db = new DBController();

if(isset($_SESSION)){
    $lecturerID = isset($_SESSION['lecturerID']) ? $_SESSION['lecturerID'] : false;
    $studentID = isset($_SESSION['studentID']) ? $_SESSION['studentID'] : false;
    $companyID = isset($_SESSION['companyID']) ? $_SESSION['companyID'] : false;
}else{
  header("Location: ../view/page/clientLogin.php");
}
?>

<div class="sticky-header header-section ">
  <div class="header-left">
    <!--toggle button start-->
    <button id="showLeftPush"><i class="fa fa-bars"></i></button>
    <!--toggle button end-->
    <!--logo -->
    <div class="logo">
      <a href="
        <?php
          if($lecturerID){
            echo "../view/page/br-StudentSupervisor-Manage.php";
          }else if($studentID){
            echo "../view/page/ky-maintainStud.php";
          }else if($companyID){
            echo "../view/page/br-companyInfo.php";
          }
        ?>
      ">
        Internship System
      </a>
    </div>
    <!--//logo-->
    <div class="clearfix"> </div>
  </div>
  <div class="uni_details">
  <h3>Tunku Abdul Rahman University College</h3>
  </div>
  <div class="header-right">
    <div class="profile_details_left">
      <!--notifications of menu start -->
      <ul class="nofitications-dropdown">
        <?php
        //$ret1 = mysqli_query($con, "select ID,Name from  tblappointment where Status=''");
        //$num = mysqli_num_rows($ret1);

        ?>
        <li class="dropdown head-dpdn">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue"><?php echo $num; ?></span></a>

          <ul class="dropdown-menu">
            <li>
              <div class="notification_header">
                <h3>You have <?php echo $num; ?> new notification</h3>
              </div>
            </li>
            <li>
              <div class="notification_desc">
                <?php if ($num > 0) {
                  while ($result = mysqli_fetch_array($ret1)) {
                ?>
                    <a class="dropdown-item" href="view-appointment.php?viewid=<?php echo $result['ID']; ?>">New appointment received from <?php echo $result['Name']; ?> </a><br />
                  <?php }
                } else { ?>
                  <a class="dropdown-item" href="all-appointment.php">No New Appointment Received</a>
                <?php } ?>

              </div>
              <div class="clearfix"></div>
              </a>
            </li>
            <li>
              <div class="notification_bottom">
                <a href="new-appointment.php">See all notifications</a>
              </div>
            </li>
          </ul>
        </li>

      </ul>
      <div class="clearfix"> </div>
    </div>
    <!--notification menu end -->
    <div class="profile_details">
      <?php
        if($companyID){
          //Get company name from database
          $sqlGetCmpName = "SELECT cmpName FROM Company WHERE companyID = '$companyID';";
          $resultGetCmpName = $db->runQuery($sqlGetCmpName);
          $name = $resultGetCmpName[0]['cmpName'];
        }elseif($studentID){
          //Get student name from database
          $sqlGetStudName = "SELECT studName FROM Student WHERE studentID = '$studentID';";
          $resultGetStudName = $db->runQuery($sqlGetStudName);
          $name = $resultGetStudName[0]['studName'];
        }elseif($lecturerID){
          //Get lecturer name from database
          $sqlGetLectName = "SELECT lecName FROM Lecturer WHERE lecturerID = '$lecturerID';";
          $resultGetLectName = $db->runQuery($sqlGetLectName);
          $name = $resultGetLectName[0]['lectName'];
        }

      ?>
      <?php if($companyID) { ?>
            <li class="dropdown profile_details_drop" style="list-style-type: none;">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <div class="profile_img">
                  <div class="user-name">
                    <p><?php echo $name; ?></p>
                    <span>Company</span>
                  </div>
                  <i class="fa fa-angle-down lnr"></i>
                  <i class="fa fa-angle-up lnr"></i>
                  <div class="clearfix"></div>
                </div>
              </a>
              <ul class="dropdown-menu drp-mnu">
                <li> <a href="../../../Client/view/page/ky-maintainCmp.php"><i class="fa fa-user"></i> Profile</a> </li>
                <li> <a href="../page/clientChangePassword.php"><i class="fa fa-cog"></i> Change Password</a> </li>
                <li> <a href="../../app/BLL/logoutBLL.php"><i class="fa fa-user"></i> Logout</a> </li>
              </ul>
            </li>
        <?php } ?>

        <?php if($studentID) { ?>    
          <li class="dropdown profile_details_drop" style="list-style-type: none;">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <div class="profile_img">
                <div class="user-name">
                  <p><?php echo $name; ?></p>
                  <span>Student</span>
                </div>
                <i class="fa fa-angle-down lnr"></i>
                <i class="fa fa-angle-up lnr"></i>
                <div class="clearfix"></div>
              </div>
            </a>
            <ul class="dropdown-menu drp-mnu">
              <li> <a href="../../../Client/view/page/ky-maintainStud.php"><i class="fa fa-user"></i> Profile</a> </li>
              <li> <a href="../page/clientChangePassword.php"><i class="fa fa-cog"></i> Change Password</a> </li>
              <li> <a href="../../app/BLL/logoutBLL.php"><i class="fa fa-user"></i> Logout</a> </li>
            </ul>
          </li>
        <?php } ?>

        <?php if($lecturerID) { ?>   
          <li class="dropdown profile_details_drop" style="list-style-type: none;">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <div class="profile_img">
                <div class="user-name">
                  <p><?php echo $name; ?></p>
                  <span>Lecturer</span>
                </div>
                <i class="fa fa-angle-down lnr"></i>
                <i class="fa fa-angle-up lnr"></i>
                <div class="clearfix"></div>
              </div>
            </a>
            <ul class="dropdown-menu drp-mnu">
              <li> <a href="../../../Client/view/page/ky-maintainStud.php"><i class="fa fa-user"></i> Profile</a> </li>
              <li> <a href="../page/clientChangePassword.php"><i class="fa fa-cog"></i> Change Password</a> </li>
              <li> <a href="../../app/BLL/logoutBLL.php"><i class="fa fa-user"></i> Logout</a> </li>
            </ul>
          </li>
        <?php } ?>
    </div>
    <div class="clearfix"> </div>
  </div>
  <div class="clearfix"> </div>
</div>