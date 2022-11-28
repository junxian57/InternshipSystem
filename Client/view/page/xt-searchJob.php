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
	<title>ITP System | Companies List</title>
	<link href="../../css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="../../css/style.css" rel='stylesheet' type='text/css' />
	<link href="../../css/font-awesome.css" rel="stylesheet">
	<link href="../../css/xt-searchJob.css" rel="stylesheet">
	<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
	<link href="../../css/animate.css" rel="stylesheet" type="text/css" media="all">
	<link href="../../css/custom.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

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
					<h3 class="title1">Companies List</h3>
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
              $get_job = "SELECT * FROM InternJob WHERE jobStatus = 'Accept Student' LIMIT $start_from, $per_page";
              $run_job = mysqli_query($conn, $get_job);
              while($row_job = mysqli_fetch_array($run_job)){
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
                    <a href='' class='cmpL-btn'>View</a>
                  </div>
                  </div>
              </div>
                <?php
                  }
                ?>
                
              <center>
                <ul class="job-pagination">
                  <?php
                    $query = "SELECT * FROM InternJob";
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
        </div>
		</div>
	</div>

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
	
	<script src="../../js/classie.js"></script>
	<script src="../../js/jquery.nicescroll.js"></script>
	<script src="../../js/scripts.js"></script>
	<script src="../../js/bootstrap.js"> </script>
</body>
</html>