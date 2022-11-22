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
	<title>ITP System | Weekly Work Progress</title>
	<link href="../../css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="../../css/style.css" rel='stylesheet' type='text/css' />
	<link href="../../css/font-awesome.css" rel="stylesheet">
	<link href="../../css/xt-workProgress.css" rel="stylesheet">
	<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
	<link href="../../css/animate.css" rel="stylesheet" type="text/css" media="all">
	<link href="../../css/custom.css" rel="stylesheet">

	<script src="../../js/jquery-1.11.1.min.js"></script>
	<script src="../../js/modernizr.custom.js"></script>
	<script src="../../js/wow.min.js"></script>
	<script src="../../js/metisMenu.min.js"></script>
	<script src="../../js/custom.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
					<h3 class="title1">Weekly Work Progress</h3>
          <div class="container">
          <div class="subtitle">
              <h2 class="sub-1">Student General Information</h2>
            </div>
            
            <div class="inputBox">
              <div class="viewInput">
                <span>Name of Trainee</span>
                <input type="text" name="studName" readonly value="<?php echo$studName; ?>">
              </div>
            
              <div class="viewInput">
                <span>Name of Company</span>
                <input type="text" name="cmpName" id="cmpName" readonly value="<?php echo$cmpName; ?>">
              </div>

              <div class="viewInput">
                <span>Month / Year</span>
                <input type="text" name="cmpName" id="cmpName" readonly value="<?php echo date('F Y'); ?>">
              </div> 
            </div>

            <div class="subtitle">
              <h2 class="sub-2">Weekly Projects / Activities</h2>
            </div>
            
            <div class="inputBox">
              <div class="viewInput" style="width:100%;">
                <span>Week 1</span>
                <textarea type="text" name="week1"></textarea>
              </div> 

              <div class="viewInput" style="width:100%;">
                <span>Week 2</span>
                <textarea type="text" name="week2"></textarea>
              </div> 

              <div class="viewInput" style="width:100%;">
                <span>Week 3</span>
                <textarea type="text" name="week3"></textarea>
              </div> 

              <div class="viewInput" style="width:100%;">
                <span>Week 4</span>
                <textarea type="text" name="week4"></textarea>
              </div> 
            </div>
            
            <div class="subtitle">
              <h2 class="sub-3">Suggestions / Comments / Additional information</h2>
            </div>
            
            <div class="inputBox">
              <div class="viewInput" style="width:100%;">
                <span>Suggestions / Comments / Additional information (if any)</span>
                <textarea type="text" name="suggestion"></textarea>
              </div>
            </div>

            <div class="subtitle">
              <h2 class="sub-4">Leave Application / Leave Taken</h2>
            </div>

            <div class="inputBox">
              <div class="viewInput">
                <span>Leave From</span>
                <input type="date" name="fromDate" id="fromDate">
              </div>
            
              <div class="viewInput">
                <span>Leave Till</span>
                <input type="date" name="toDate" id="toDate">
              </div>

              <div class="viewInput">
                <span>Number of Days Taken</span>
                <input type="text" name="leaveDays" id="leaveDays" value="0">
              </div>

              <div class="viewInput">
                <span>Reasons for taking leave</span>
                <input type="text" name="leaveDays" id="leaveDays">
              </div>
            </div>

            <div class="button-group">
              <button type="submit" id="acceptBtn" class="acceptBtn"><i class="fa fa-check" aria-hidden="true"></i>  Save</button>
              <button type="submit" id="rejectBtn" class="rejectBtn"><i class="fa fa-times" aria-hidden="true"></i>  Submit</button>
            </div>
          </div>
        </div>
		</div>
	</div>

  <script>
    document.getElementById('acceptBtn').addEventListener('click',
      function(){
        document.querySelector('.acceptForm').style.display = 'flex';
      });
      
      document.querySelector('.close').addEventListener('click',
        function(){
          document.querySelector('.acceptForm').style.display = 'none';
        })

    document.getElementById('rejectBtn').addEventListener('click',
      function(){
        document.querySelector('.rejectForm').style.display = 'flex';
      });
      
      document.querySelector('.closeR').addEventListener('click',
        function(){
          document.querySelector('.rejectForm').style.display = 'none';
        })
  </script>

  <script type="text/javaScript">
    /*$(document).ready(function(){
      $("#cmpName-1").keyup(function(){
        var input = $(this).val();

        if(input != ""){
          $.ajax({
            url:"xt-livesearch.php",
            method:"POST",
            data:{input:input},

            success:function(data){
              $("#searchCmp").html(data);
              $("#searchCmp").css("display", "block");
            }
          });
        }else{
          $("#searchCmp").css("display", "none");
        }
      });
    });*/
    let submit = document.getElementById("toDate");
    let output = document.getElementById("leaveDays");

    submit.addEventListener("change", () => {
      let fromDate = new Date(document.getElementById("fromDate").value);
      let toDate = new Date(document.getElementById("toDate").value);

      if(fromDate.getTime() && toDate.getTime()){
        let timeDifference = toDate.getTime() - fromDate.getTime();

        let dayDifference = Math.abs(timeDifference / (1000 * 3600 *24));
        output.value = dayDifference;
      }
    });
  </script>
	
	<script src="../../js/classie.js"></script>
	<script src="../../js/jquery.nicescroll.js"></script>
	<script src="../../js/scripts.js"></script>
	<script src="../../js/bootstrap.js"> </script>
</body>
</html>