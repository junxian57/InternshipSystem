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
					<h3 class="title1">Companies List</h3>
          
          <div class="col-sm-3" style="padding-top: 3rem;">
            <div class="allowance-range-block">
              <p style="font-size: 18px; font-weight: 600;">Company</p>
                <div style="margin:30px auto">
                  <input type="text" name="cmpName" id="cmpName" placeholder="eg. Applicate Sdn Bhd" /> 
                </div>
            </div>

            <div class="allowance-range-block">
              <p style="font-size: 18px; font-weight: 600;">Job Title</p>
                <div style="margin:30px auto">
                  <input type="text" name="jobName" id="jobName" placeholder="eg. Web Developer" /> 
                </div>
            </div>

            <div class="allowance-range-block">
              <p style="font-size: 18px; font-weight: 600;">State</p>
                <div style="margin:15px auto">
                  <select name="cmpState" id="state">
                    <option value="0" disabled selected>All State</option>
                    <option value="Johor">Johor</option>
                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                    <option value="Kedah">Kedah</option>
                    <option value="Kelantan">Kelantan</option>
                    <option value="Melaka">Melaka</option>
                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                    <option value="Pahang">Pahang</option>
                    <option value="Penang">Penang</option>
                    <option value="Perak">Perak</option>
                    <option value="Perlis">Perlis</option>
                    <option value="Sabah">Sabah</option>
                    <option value="Sarawak">Sarawak</option>
                    <option value="Selangor">Selangor</option>
                    <option value="Terengganu">Terengganu</option>
                  </select>
                </div>
            </div>

            <div class="allowance-range-block">
              <p style="font-size: 18px; font-weight: 600; padding-bottom: 10px;">Allowance Range</p>
              <div id="slider-range" class="allowance-filter-range" name="rangeInput"></div>
                <div style="margin:30px auto">RM
                  <input type="number" min=0 max="9999" oninput="validity.valid||(value='0');" id="min_allowance" class="allowance-range-field" /> - 
                  <input type="number" min=0 max="10000" oninput="validity.valid||(value='10000');" id="max_allowance" class="allowance-range-field" />
                </div>
            </div>
          </div>
          
          <div class="col-sm-9">
            <div id="searchResults" class="search-results-block">
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
                        $query = "SELECT * FROM InternJob WHERE jobStatus = 'Accept Student'";
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
        </div>
      </div>
    </div>
  </div>

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
	
  <script type="text/javascript">
    $(document).ready(function(){

      function filterCmp(){
        $("#searchResults").html("<p>Loading......</p>");

        var cmpName = $("#cmpName").val();

        $.ajax({
          url: "xt-fetch_data.php",
          type: "POST",
          data: {cmpName:cmpName},
          success: function(data){
            $("#searchResults").html(data);
          }
        });
      }

      function filterJob(){
        $("#searchResults").html("<p>Loading......</p>");

        var jobTitle = $("#jobName").val();

        //alert(jobTitle);

        $.ajax({
          url: "xt-fetch_data.php",
          type: "POST",
          data: {jobTitle:jobTitle},
          success: function(data){
            $("#searchResults").html(data);
          }
        });
      }

      function filterAllowance(){
        $("#searchResults").html("<p>Loading......</p>");

        var min_allowance = $("#min_allowance").val();
        var max_allowance = $("#max_allowance").val();

        //alert(min_allowance + max_allowance);

        $.ajax({
          url: "xt-fetch_data.php",
          type: "POST",
          data: {min_allowance:min_allowance, max_allowance:max_allowance},
          success: function(data){
            $("#searchResults").html(data);
          }
        });
      }

      function filterState(){
        $("#searchResults").html("<p>Loading......</p>");

        var state = $("#state").val();

        //alert(state);

        $.ajax({
          url: "xt-fetch_data.php",
          type: "POST",
          data: {state:state},
          success: function(data){
            $("#searchResults").html(data);
          }
        });
      }

      $("#cmpName").on('keyup', function(){
        filterCmp();
      });

      $("#jobName").on('keyup', function(){
        filterJob();
      });

      $("#min_allowance, #max_allowance").on('keyup', function(){
        filterAllowance();
      });

      $("#state").on('change', function(){
        filterState();
      });

      $("#slider-range").slider({
        range: true,
        orientation: "horizontal",
        min: 0,
        max: 10000,
        values: [0, 10000],
        step: 100,

        slide: function (event, ui) {
          if (ui.values[0] == ui.values[1]) {
            return false;
          }

          $("#min_allowance").val(ui.values[0]);
          $("#max_allowance").val(ui.values[1]);

          filterAllowance();
        }
      });

      $("#min_allowance").val($("#slider-range").slider("values", 0));
      $("#max_allowance").val($("#slider-range").slider("values", 1));
    });
  </script>
</body>
</html>