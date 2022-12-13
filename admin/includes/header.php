<?php
  if (session_status() == PHP_SESSION_NONE) session_start();

  include_once('db_connection.php');
  $db = new DBController();
  
  if(isset($_SESSION)){
      $committeeID = isset($_SESSION['committeeID']) ? $_SESSION['committeeID'] : false;
      $adminID = isset($_SESSION['adminID']) ? $_SESSION['adminID'] : false;
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
      <a href="dashboard.php">
        <h1>ITP System</h1>
        <span>AdminPanel</span>
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
       if($committeeID){
        //Get Committee Name from DB
        $sqlGetCommitteeName = "SELECT commName FROM ITPCommittee WHERE committeeID = '$committeeID';";
        $resultGetCommitteeName = $db->runQuery($sqlGetCommitteeName);
        $name = $resultGetCommitteeName[0]['commName'];  
      }else if($adminID){
        //Get Admin Name from DB
        $sqlGetAdminName = "SELECT adminUserName FROM Admin WHERE adminID = '$adminID';";
        $resultGetAdminName = $db->runQuery($sqlGetAdminName);
        $name = $resultGetAdminName[0]['adminName'];
      }

      ?>
      <ul>
        <li class="dropdown profile_details_drop">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <div class="profile_img">
              <div class="user-name">
                <p><?php echo $name; ?></p>
                <span>Administrator</span>
              </div>
              <i class="fa fa-angle-down lnr"></i>
              <i class="fa fa-angle-up lnr"></i>
              <div class="clearfix"></div>
            </div>
          </a>
          <ul class="dropdown-menu drp-mnu">
            <li> <a href="../page/adminChangePassword.php"><i class="fa fa-cog"></i> Change Password</a> </li>
            <li> <a href="../../app/BLL/logoutBLL.php"><i class="fa fa-user"></i> Logout</a> </li>
          </ul>
        </li>
      </ul>
    </div>
    <div class="clearfix"> </div>
  </div>
  <div class="clearfix"> </div>
</div>