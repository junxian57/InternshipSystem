<link href="../../css/xt-searchJob.css" rel="stylesheet">

<?php
  $host = "sql444.main-hosting.eu";
  $user = "u928796707_group34";
  $password = "u1VF3KYO1r|";
  $database = "u928796707_internshipWeb";
                        
  $conn = mysqli_connect($host, $user, $password, $database); 

  if(isset($_POST['cmpName'])){
    $cmpName = $_POST['cmpName'];

    $get_company = "SELECT * FROM Company WHERE cmpName LIKE '%{$cmpName}%'";
    $run_company = mysqli_query($conn, $get_company);
    if($row_company = mysqli_fetch_array($run_company)){
      $company_ID = $row_company['companyID'];
    }else{
      echo "Sorry, no data found. Please try again.";
    }

    $query = "SELECT * FROM InternJob WHERE jobStatus = 'Accept Student' AND companyID = '$company_ID'";
    $r = mysqli_query($conn, $query);
    $count = mysqli_num_rows($r);
    if($count == 0){
      echo "Sorry, no data found. Please try again.";
    }
    ?>
    
    <section class="cmpList" id="cmpList">
        <div class="cmpList-container">
          <?php 

            $per_page=6; 

            if(isset($_GET['page'])){
              $page = $_GET['page'];
            }else{
              $page = 1;
            }
            
            $start_from = ($page - 1) * $per_page;
            $get_job = "SELECT * FROM InternJob WHERE jobStatus = 'Accept Student' AND companyID = '$company_ID' LIMIT $start_from, $per_page";
            $run_job = mysqli_query($conn, $get_job);
            while($row_job = mysqli_fetch_array($run_job)){
              $internJobID = $row_job['internJobID'];
              $cmpID = $row_job['companyID'];
              $jobTitle = $row_job['jobTitle'];
              $jobFieldsArea = $row_job['jobFieldsArea'];
              $jobAllowance = $row_job['jobAllowance'];

              $get_cmp = "SELECT * FROM Company WHERE companyID = '$cmpID'";
              $run_cmp = mysqli_query($conn, $get_cmp);
							$row_cmp = mysqli_fetch_array($run_cmp);
							$cmpName = $row_cmp['cmpName'];
              $cmpAddress = $row_cmp['cmpAddress'];
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
                    <th>Address</th>
                    <td><?php echo $cmpAddress; ?></td>
                  </tr>
                  <tr>
                    <th>Fields Area</th>
                    <td><?php echo $jobFieldsArea; ?></td>
                  </tr>
                  <tr>
                    <th>Allowance</th>
                    <td><?php echo $jobAllowance; ?></td>
                  </tr>
                </tbody>
              </table>
              <div class="cmpLFooter">
                <p></p>
                <a class="cmpL-btn" href="xt-jobDetails.php?internJobID=<?php echo $internJobID; ?>">View</a>
              </div>
            </div>
          </div>
          <?php } ?>
          <center>
            <ul class="job-pagination">
              <?php
                $query = "SELECT * FROM InternJob WHERE jobStatus = 'Accept Student' AND companyID = '$company_ID'";
                $result = mysqli_query($conn,$query);
                $total_records = mysqli_num_rows($result);
                $total_pages = ceil($total_records / $per_page);
                echo "
                      <li>
                      <a href='xt-searchJob?page=1' class='fa-solid fa-arrow-left'></a></li>";
                      for($i=1; $i<=$total_pages; $i++){
                        echo "
                              <li>
                              <a href='xt-searchJob.php?page=".$i."'> ".$i." </a></li>";    
                      };
                      echo "
                            <li>
                            <a href='xt-searchJob.php?page=$total_pages' class='fa-solid fa-arrow-right'></a></li>"; 
              ?> 
            </ul>
          </center>
        </section>
  <?php }

  if(isset($_POST['jobTitle'])){
    $jobTitle = $_POST['jobTitle'];

    $query = "SELECT * FROM InternJob WHERE jobStatus = 'Accept Student' AND jobTitle LIKE '%{$jobTitle}%'";
    $r = mysqli_query($conn, $query);
    $count = mysqli_num_rows($r);
    if($count == 0){
      echo "Sorry, no data found. Please try again.";
    }
    ?>
    
    <section class="cmpList" id="cmpList">
        <div class="cmpList-container">
          <?php 

            $per_page=6; 

            if(isset($_GET['page'])){
              $page = $_GET['page'];
            }else{
              $page = 1;
            }
            
            $start_from = ($page - 1) * $per_page;
            $get_job = "SELECT * FROM InternJob WHERE jobStatus = 'Accept Student' AND jobTitle LIKE '%{$jobTitle}%' LIMIT $start_from, $per_page";
            $run_job = mysqli_query($conn, $get_job);
            while($row_job = mysqli_fetch_array($run_job)){
              $internJobID = $row_job['internJobID'];
              $cmpID = $row_job['companyID'];
              $jobTitle = $row_job['jobTitle'];
              $jobFieldsArea = $row_job['jobFieldsArea'];
              $jobAllowance = $row_job['jobAllowance'];

              $get_cmp = "SELECT * FROM Company WHERE companyID = '$cmpID'";
              $run_cmp = mysqli_query($conn, $get_cmp);
							$row_cmp = mysqli_fetch_array($run_cmp);
							$cmpName = $row_cmp['cmpName'];
              $cmpAddress = $row_cmp['cmpAddress'];
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
                    <th>Address</th>
                    <td><?php echo $cmpAddress; ?></td>
                  </tr>
                  <tr>
                    <th>Fields Area</th>
                    <td><?php echo $jobFieldsArea; ?></td>
                  </tr>
                  <tr>
                    <th>Allowance</th>
                    <td><?php echo $jobAllowance; ?></td>
                  </tr>
                </tbody>
              </table>
              <div class="cmpLFooter">
                <p></p>
                <a class="cmpL-btn" href="xt-jobDetails.php?internJobID=<?php echo $internJobID; ?>">View</a>
              </div>
            </div>
          </div>
          <?php } ?>
          <center>
            <ul class="job-pagination">
              <?php
                $query = "SELECT * FROM InternJob WHERE jobStatus = 'Accept Student' AND jobTitle LIKE '%{$jobTitle}%'";
                $result = mysqli_query($conn,$query);
                $total_records = mysqli_num_rows($result);
                $total_pages = ceil($total_records / $per_page);
                echo "
                      <li>
                      <a href='xt-searchJob?page=1' class='fa-solid fa-arrow-left'></a></li>";
                      for($i=1; $i<=$total_pages; $i++){
                        echo "
                              <li>
                              <a href='xt-searchJob.php?page=".$i."'> ".$i." </a></li>";    
                      };
                      echo "
                            <li>
                            <a href='xt-searchJob.php?page=$total_pages' class='fa-solid fa-arrow-right'></a></li>"; 
              ?> 
            </ul>
          </center>
        </section>
    <?php }

  if(isset($_POST['min_allowance']) && isset($_POST['max_allowance'])){
    $min_allowance = $_POST['min_allowance'];
    $max_allowance = $_POST['max_allowance'];

    $query = "SELECT * FROM InternJob WHERE jobStatus = 'Accept Student' AND jobAllowance BETWEEN '$min_allowance' AND '$max_allowance'";
    $r = mysqli_query($conn, $query);
    $count = mysqli_num_rows($r);
    if($count == 0){
      echo "Sorry, no data found. Please try again.";
    }

    ?>
    
    <section class="cmpList" id="cmpList">
        <div class="cmpList-container">
          <?php 

            $per_page=6; 

            if(isset($_GET['page'])){
              $page = $_GET['page'];
            }else{
              $page = 1;
            }
            
            $start_from = ($page - 1) * $per_page;
            $get_job = "SELECT * FROM InternJob WHERE jobStatus = 'Accept Student' AND jobAllowance BETWEEN '$min_allowance' AND '$max_allowance' LIMIT $start_from, $per_page";
            $run_job = mysqli_query($conn, $get_job);
            while($row_job = mysqli_fetch_array($run_job)){
              $internJobID = $row_job['internJobID'];
              $cmpID = $row_job['companyID'];
              $jobTitle = $row_job['jobTitle'];
              $jobFieldsArea = $row_job['jobFieldsArea'];
              $jobAllowance = $row_job['jobAllowance'];

              $get_cmp = "SELECT * FROM Company WHERE companyID = '$cmpID'";
              $run_cmp = mysqli_query($conn, $get_cmp);
							$row_cmp = mysqli_fetch_array($run_cmp);
							$cmpName = $row_cmp['cmpName'];
              $cmpAddress = $row_cmp['cmpAddress'];
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
                    <th>Address</th>
                    <td><?php echo $cmpAddress; ?></td>
                  </tr>
                  <tr>
                    <th>Fields Area</th>
                    <td><?php echo $jobFieldsArea; ?></td>
                  </tr>
                  <tr>
                    <th>Allowance</th>
                    <td><?php echo $jobAllowance; ?></td>
                  </tr>
                </tbody>
              </table>
              <div class="cmpLFooter">
                <p></p>
                <a class="cmpL-btn" href="xt-jobDetails.php?internJobID=<?php echo $internJobID; ?>">View</a>
              </div>
            </div>
          </div>
          <?php } ?>
          <center>
            <ul class="job-pagination">
              <?php
                $query = "SELECT * FROM InternJob WHERE jobStatus = 'Accept Student' AND jobAllowance BETWEEN '$min_allowance' AND '$max_allowance'";
                $result = mysqli_query($conn,$query);
                $total_records = mysqli_num_rows($result);
                $total_pages = ceil($total_records / $per_page);
                echo "
                      <li>
                      <a href='xt-searchJob?page=1' class='fa-solid fa-arrow-left'></a></li>";
                      for($i=1; $i<=$total_pages; $i++){
                        echo "
                              <li>
                              <a href='xt-searchJob.php?page=".$i."'> ".$i." </a></li>";    
                      };
                      echo "
                            <li>
                            <a href='xt-searchJob.php?page=$total_pages' class='fa-solid fa-arrow-right'></a></li>"; 
              ?> 
            </ul>
          </center>
        </section>
    <?php }

if(isset($_POST['state'])){
  $state = $_POST['state'];

  $get_state = "SELECT * FROM InternJob WHERE jobLocationOfWork LIKE '%$state'";
  $run_state = mysqli_query($conn, $get_state);
  $count = mysqli_num_rows($run_state);
  if($count == 0){
    echo "Sorry, no data found. Please try again.";
  }
?>
  
  <section class="cmpList" id="cmpList">
      <div class="cmpList-container">
        <?php 

          $per_page=6; 

          if(isset($_GET['page'])){
            $page = $_GET['page'];
          }else{
            $page = 1;
          }
          
          $start_from = ($page - 1) * $per_page;
          $get_job = "SELECT * FROM InternJob WHERE jobStatus = 'Accept Student' AND jobLocationOfWork LIKE '%$state' LIMIT $start_from, $per_page";
          $run_job = mysqli_query($conn, $get_job);

          while($row_job = mysqli_fetch_array($run_job)){
            $internJobID = $row_job['internJobID'];
            $cmpID = $row_job['companyID'];
            $jobTitle = $row_job['jobTitle'];
            $jobFieldsArea = $row_job['jobFieldsArea'];
            $jobAllowance = $row_job['jobAllowance'];

            $get_cmp = "SELECT * FROM Company WHERE companyID = '$cmpID'";
            $run_cmp = mysqli_query($conn, $get_cmp);
            $row_cmp = mysqli_fetch_array($run_cmp);
            $cmpName = $row_cmp['cmpName'];
            $cmpAddress = $row_cmp['cmpAddress'];
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
                  <th>Address</th>
                  <td><?php echo $cmpAddress; ?></td>
                </tr>
                <tr>
                  <th>Fields Area</th>
                  <td><?php echo $jobFieldsArea; ?></td>
                </tr>
                <tr>
                  <th>Allowance</th>
                  <td><?php echo $jobAllowance; ?></td>
                </tr>
              </tbody>
            </table>
            <div class="cmpLFooter">
              <p></p>
              <a class="cmpL-btn" href="xt-jobDetails.php?internJobID=<?php echo $internJobID; ?>">View</a>
            </div>
          </div>
        </div>
        <?php }?>
        <center>
          <ul class="job-pagination">
            <?php
              $query = "SELECT * FROM InternJob WHERE jobStatus = 'Accept Student' AND jobLocationOfWork LIKE '%$state'";
              $result = mysqli_query($conn,$query);
              $total_records = mysqli_num_rows($result);
              $total_pages = ceil($total_records / $per_page);
              echo "
                    <li>
                    <a href='xt-searchJob?page=1' class='fa-solid fa-arrow-left'></a></li>";
                    for($i=1; $i<=$total_pages; $i++){
                      echo "
                            <li>
                            <a href='xt-searchJob.php?page=".$i."'> ".$i." </a></li>";    
                    };
                    echo "
                          <li>
                          <a href='xt-searchJob.php?page=$total_pages' class='fa-solid fa-arrow-right'></a></li>"; 
            ?> 
          </ul>
        </center>
      </section>
  <?php }
?>