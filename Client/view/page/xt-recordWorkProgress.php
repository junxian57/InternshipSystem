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
          <form id="form">
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
                <textarea type="text" name="week1" id="week1" oninput="countWord()" onPaste="return false" placeholder="Summarize Week 1 projects and activities within 300 words."></textarea>
                <div class="wordCount"><span> [Word Count: </span><span id="show">0</span><span> / 300]</span></div>
              </div> 

              <div class="viewInput" style="width:100%;">
                <span>Week 2</span>
                <textarea type="text" name="week2" id="week2" oninput="countWord2()" onPaste="return false" placeholder="Summarize Week 2 projects and activities within 300 words."></textarea>
                <div class="wordCount"><span> [Word Count: </span><span id="show2">0</span><span> / 300]</span></div>
              </div> 

              <div class="viewInput" style="width:100%;">
                <span>Week 3</span>
                <textarea type="text" name="week3" id="week3" oninput="countWord3()" onPaste="return false" placeholder="Summarize Week 3 projects and activities within 300 words."></textarea>
                <div class="wordCount"><span> [Word Count: </span><span id="show3">0</span><span> / 300]</span></div>
              </div> 

              <div class="viewInput" style="width:100%;">
                <span>Week 4</span>
                <textarea type="text" name="week4" id="week4" oninput="countWord4()" onPaste="return false" placeholder="Summarize Week 4 projects and activities within 300 words."></textarea>
                <div class="wordCount"><span> [Word Count: </span><span id="show4">0</span><span> / 300]</span></div>
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
              <div class="viewInput" style="width:100%;">
                <span>Any leave taken?</span><br>
                <select name="leaveTaken" id="leaveTaken">
                  <option value="Yes">Yes</option>
                  <option value="No" selected>No</option>
                </select>
              </div>

              <div class="viewInput">
                <span>Leave From</span>
                <input type="date" name="fromDate" id="fromDate" disabled>
              </div>
            
              <div class="viewInput">
                <span>Leave Till</span>
                <input type="date" name="toDate" id="toDate" disabled>
              </div>

              <div class="viewInput">
                <span>Number of Days Taken</span>
                <input type="text" name="leaveDays" id="leaveDays" value="0" readonly>
              </div>

              <div class="viewInput">
                <span>Reasons for taking leave</span>
                <input type="text" name="leaveReason" id="leaveReason" disabled>
              </div>
            </div>

            <div class="button-group">
              <button type="submit" id="acceptBtn" class="acceptBtn"><i class="fa fa-check" aria-hidden="true"></i>  Save</button>
              <button type="submit" id="rejectBtn" class="rejectBtn"><i class="fa fa-times" aria-hidden="true"></i>  Submit</button>
            </div>
          </div>
        </form>
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

  <script>
    function countWord() {
      var words = document.getElementById("week1").value;
      var count = 0;
      var split = words.split(' ');
      for (var i = 0; i < split.length; i++) {
        if (split[i] != "") {
          count += 1;
        }
      }
    
      document.getElementById("show").innerHTML = count;
    }

    function countWord2() {
      var words = document.getElementById("week2").value;
      var count = 0;
      var split = words.split(' ');
      for (var i = 0; i < split.length; i++) {
        if (split[i] != "") {
          count += 1;
        }
      }
    
      document.getElementById("show2").innerHTML = count;
    }

    function countWord3() {
      var words = document.getElementById("week3").value;
      var count = 0;
      var split = words.split(' ');
      for (var i = 0; i < split.length; i++) {
        if (split[i] != "") {
          count += 1;
        }
      }
    
      document.getElementById("show3").innerHTML = count;
    }

    function countWord4() {
      var words = document.getElementById("week4").value;
      var count = 0;
      var split = words.split(' ');
      for (var i = 0; i < split.length; i++) {
        if (split[i] != "") {
          count += 1;
        }
      }
    
      document.getElementById("show4").innerHTML = count;
    }
    
    document.getElementById("week1").addEventListener("keypress", function(evt){
      var words = this.value.split(/\s+/);
      var numWords = words.length;    // Get # of words in array
      var maxWords = 300;
      
      if(numWords > maxWords){
        evt.preventDefault(); // Cancel event
      }
    });

    document.getElementById("week2").addEventListener("keypress", function(evt){
      var words = this.value.split(/\s+/);
      var numWords = words.length;    // Get # of words in array
      var maxWords = 300;
      
      if(numWords > maxWords){
        evt.preventDefault(); // Cancel event
      }
    });

    document.getElementById("week3").addEventListener("keypress", function(evt){
      var words = this.value.split(/\s+/);
      var numWords = words.length;    // Get # of words in array
      var maxWords = 300;
      
      if(numWords > maxWords){
        evt.preventDefault(); // Cancel event
      }
    });

    document.getElementById("week4").addEventListener("keypress", function(evt){
      var words = this.value.split(/\s+/);
      var numWords = words.length;    // Get # of words in array
      var maxWords = 300;
      
      if(numWords > maxWords){
        evt.preventDefault(); // Cancel event
      }
    });

    var select_element = document.getElementById("leaveTaken");
    
    select_element.addEventListener("change", () => {
      
    var selected = select_element.options[select_element.selectedIndex ].value
      if(selected == "No"){
        document.getElementById("fromDate").disabled = true;
        document.getElementById("fromDate").value = "";
        document.getElementById("toDate").disabled = true;
        document.getElementById("toDate").value = "";
        document.getElementById("leaveDays").value = "0";
        document.getElementById("leaveReason").disabled = true;
      }else{
        document.getElementById("fromDate").disabled = false;
        document.getElementById("toDate").disabled = false;
        document.getElementById("leaveReason").disabled = false;
      }
    });
  </script>

  <script>
    $(document).ready(function(){ 
      $(document).bind("contextmenu",function(e){
        return false;
      }); 
    })
  </script>

	<script src="../../js/classie.js"></script>
	<script src="../../js/jquery.nicescroll.js"></script>
	<script src="../../js/scripts.js"></script>
	<script src="../../js/bootstrap.js"> </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</body>
</html>