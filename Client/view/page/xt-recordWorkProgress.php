<?php
	include('../../includes/db_connection.php');

  $host = "sql444.main-hosting.eu";
  $user = "u928796707_group34";
  $password = "u1VF3KYO1r|";
  $database = "u928796707_internshipWeb";
                                              
  $conn = mysqli_connect($host, $user, $password, $database); 
	
  if(session_status() != PHP_SESSION_ACTIVE) session_start();

	if (isset($_SESSION['studentChangePass'])) {
		header('Location: clientChangePassword.php?requireChangePass&notAllowed');
	}
    
  if(isset($_SESSION['studentID'])){
    $studID = $_SESSION['studentID'];
    $getStudApp = "SELECT * FROM InternApplicationMap WHERE studentID = '$studID' AND appStudentFeedback = 'Accept Offer'";
		$runStudApp = mysqli_query($conn, $getStudApp);
    if(!(mysqli_num_rows($runStudApp) > 0)){
			echo "<script>alert('Access blocked! You have not found an internship company yet!')</script>";     
      echo "<script>window.open('xt-viewWorkProgress.php','_self')</script>";
		}
  }
?>

<?php
if(isset($_POST['signaturesave'])){
  $host = "sql444.main-hosting.eu";
  $user = "u928796707_group34";
  $password = "u1VF3KYO1r|";
  $database = "u928796707_internshipWeb";
                                
  $conn = mysqli_connect($host, $user, $password, $database); 

  $query = "SELECT * FROM weeklyReport ORDER BY monthlyReportID DESC LIMIT 1";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);
	$lastID = $row['monthlyReportID'];
	if($lastID == "") {
		$monthlyReportID = "MRPT1001";
	} else {
		$monthlyReportID = substr($lastID, 4);
		$monthlyReportID = intval($monthlyReportID);
		$monthlyReportID = "MRPT".($monthlyReportID + 1);
	}

  $cmpID = "CMP00001";
  $studName = $_POST['studName'];
  $cmpName = $_POST['cmpName'];
  $monthYear = $_POST['monthYear'];
  $week1 = $_POST['week1'];
  $week2 = $_POST['week2'];
  $week3 = $_POST['week3'];
  $week4 = $_POST['week4'];
  $problem = $_POST['problem'];
  $leaveTaken = $_POST['leaveTaken'];
  $leaveTakens = $_POST['leaveDays'];
  $status = "Saved";

  if($leaveTaken == 'NO'){
    $leaveReasons = "N/A";
  }
  else{
    $leaveReasons = $_POST['leaveReason'];
  }

  $sql = "INSERT INTO weeklyReport (monthlyReportID, studentID, companyID, monthOfTraining, firstWeekDeliverables, secondWeekDeliverables, thirdWeekDeliverables, forthWeekDeliverables, issuesEncountered, leaveTaken, leaveReason, reportStatus) VALUES ('$monthlyReportID','$studID','$cmpID','$monthYear','$week1','$week2','$week3','$week4','$problem','$leaveTakens','$leaveReasons', '$status')";
  if (mysqli_query($conn, $sql)) {
    echo "<script>alert('The report have been saved into database.')</script>";     
    echo "<script>window.open('xt-viewWorkProgress.php','_self')</script>";
  } else {
    echo "Error: " . $sql . mysqli_error($conn);
  }   
}
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
  <script src="../../js/signature.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>

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
          <form method="post" action="xt-recordWorkProgress.php" enctype="multipart/form-data" id="signatureform">
            <div class="container">
              <div class="subtitle">
                <h2 class="sub-1">Student General Information</h2>
              </div>

              <?php
								$host = "sql444.main-hosting.eu";
                $user = "u928796707_group34";
                $password = "u1VF3KYO1r|";
                $database = "u928796707_internshipWeb";
                                              
                $conn = mysqli_connect($host, $user, $password, $database); 

                $get_stud = "SELECT * FROM Student WHERE studentID = '$studID'";
                $run_stud = mysqli_query($conn, $get_stud);
                $row_stud = mysqli_fetch_array($run_stud);
                $studName = $row_stud['studName'];
              ?>
              
              <div class="inputBox">
                <div class="viewInput">
                  <span>Name of Trainee</span>
                  <input type="text" name="studName" readonly value="<?php echo $studName;?>">
                </div>
                
                <div class="viewInput">
                  <span>Name of Company</span>
                  <input type="text" name="cmpName" id="cmpName" readonly value="Smart Teq Solution Sdn Bhd">
                </div>

                <div class="viewInput">
                  <span>Month / Year</span>
                  <input type="text" name="monthYear" id="monthYear" readonly value="<?php echo date('F Y'); ?>">
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
                <h2 class="sub-3">Problems Faced / Comments / Additional information</h2>
              </div>
            
              <div class="inputBox">
                <div class="viewInput" style="width:100%;">
                  <span>Problems Faced / Comments / Additional information (if any)</span>
                  <textarea type="text" name="problem" placeholder="Have you encountered any problems during the internship this month? What was the problem and how did you solve it?"></textarea>
                </div>
              </div>

              <div class="subtitle">
                <h2 class="sub-4">Leave Application / Leave Taken</h2>
              </div>

              <div class="inputBox">
                <div class="viewInput" style="width:100%;">
                  <span>Any leave taken?</span><br>
                  <select name="leaveTaken" id="leaveTaken">
                    <option value="YES">Yes</option>
                    <option value="NO" selected>No</option>
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
                  <input type="text" name="leaveReason" id="leaveReason" value="N/A" disabled>
                </div>
              </div>

              <div class="subtitle">
                <h2 class="sub-4">Digital Signature</h2>
              </div>

              <div id="signature-pad">
                  <div id="canvasDiv"></div>
                  <br>
                  <button type="button" class="btn btn-danger" id="reset-btn">Reset</button>
                  <button type="button" class="btn btn-success" id="btn-save" name="save">Save</button>
              </div>

              <input type="hidden" id="signature" name="signature">
              <input type="hidden" name="signaturesave" value="1">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(() => {
      var canvasDiv = document.getElementById('canvasDiv');
      var canvas = document.createElement('canvas');
      canvas.setAttribute('id', 'canvas');
      canvasDiv.appendChild(canvas);
      $("#canvas").attr('height', $("#canvasDiv").outerHeight());
      $("#canvas").attr('width', $("#canvasDiv").width());
      if (typeof G_vmlCanvasManager != 'undefined') {
        canvas = G_vmlCanvasManager.initElement(canvas);
      }
        
      context = canvas.getContext("2d");
      $('#canvas').mousedown(function(e) {
        var offset = $(this).offset()
        var mouseX = e.pageX - this.offsetLeft;
        var mouseY = e.pageY - this.offsetTop;
        
        paint = true;
        addClick(e.pageX - offset.left, e.pageY - offset.top);
        redraw();
      });
      
      $('#canvas').mousemove(function(e) {
        if (paint) {
          var offset = $(this).offset()
          //addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, true);
          addClick(e.pageX - offset.left, e.pageY - offset.top, true);
          console.log(e.pageX, offset.left, e.pageY, offset.top);
          redraw();
        }
      });
      
      $('#canvas').mouseup(function(e) {
        paint = false;
      });
      
      $('#canvas').mouseleave(function(e) {
        paint = false;
      });

      var clickX = new Array();
      var clickY = new Array();
      var clickDrag = new Array();
      var paint;

      function addClick(x, y, dragging) {
        clickX.push(x);
        clickY.push(y);
        clickDrag.push(dragging);
      }
      
      $("#reset-btn").click(function() {
        context.clearRect(0, 0, window.innerWidth, window.innerWidth);
        clickX = [];
        clickY = [];
        clickDrag = [];
        document.getElementById("week1").value = "";
        document.getElementById("week2").value = "";
        document.getElementById("week3").value = "";
        document.getElementById("week4").value = "";
        document.getElementById("problem").value = "";
        document.getElementById("fromDate").value = "";
        document.getElementById("toDate").value = "";
        document.getElementById("leaveDays").value = "0";
        document.getElementById("leaveReason").value = "";
      });

      $(document).on('click', '#btn-save', function() {
        var mycanvas = document.getElementById('canvas');
        var img = mycanvas.toDataURL("image/png");
        anchor = $("#signature");
        anchor.val(img);
        $("#signatureform").submit();
      });
      
      var drawing = false;
      var mousePos = {
        x: 0,
        y: 0
      };
      var lastPos = mousePos;

      canvas.addEventListener("touchstart", function(e) {
        mousePos = getTouchPos(canvas, e);
        var touch = e.touches[0];
        var mouseEvent = new MouseEvent("mousedown", {
          clientX: touch.clientX,
          clientY: touch.clientY
        });
          canvas.dispatchEvent(mouseEvent);
        }, false);
        
        canvas.addEventListener("touchend", function(e) {
          var mouseEvent = new MouseEvent("mouseup", {});
          canvas.dispatchEvent(mouseEvent);
        }, false);

        canvas.addEventListener("touchmove", function(e) {
          var touch = e.touches[0];
          var offset = $('#canvas').offset();
          var mouseEvent = new MouseEvent("mousemove", {
            clientX: touch.clientX,
            clientY: touch.clientY
          });
          canvas.dispatchEvent(mouseEvent);
        }, false);

        // Get the position of a touch relative to the canvas
        function getTouchPos(canvasDiv, touchEvent) {
          var rect = canvasDiv.getBoundingClientRect();
          return {
            x: touchEvent.touches[0].clientX - rect.left,
            y: touchEvent.touches[0].clientY - rect.top
          };
        }

        var elem = document.getElementById("canvas");

        var defaultPrevent = function(e) {
            e.preventDefault();
        }

        elem.addEventListener("touchstart", defaultPrevent);
        elem.addEventListener("touchmove", defaultPrevent);

        function redraw() {
          lastPos = mousePos;
          for (var i = 0; i < clickX.length; i++) {
            context.beginPath();
            if (clickDrag[i] && i) {
              context.moveTo(clickX[i - 1], clickY[i - 1]);
            } else {
              context.moveTo(clickX[i] - 1, clickY[i]);
            }
              context.lineTo(clickX[i], clickY[i]);
              context.closePath();
              context.stroke();
            }
          }
        })
  </script>

  <script>
    var wrapper = document.getElementById("signature-pad");
    var clearButton = wrapper.querySelector("[data-action=clear]");
    var savePNGButton = wrapper.querySelector("[data-action=save-png]");
    var canvas = wrapper.querySelector("canvas");
    var el_note = document.getElementById("note");
    var signaturePad;
    signaturePad = new SignaturePad(canvas);
    clearButton.addEventListener("click", function (event) {
      document.getElementById("note").innerHTML="Please draw your signature inside the box.";
      signaturePad.clear();
    });

    savePNGButton.addEventListener("click", function (event){
      if (signaturePad.isEmpty()){
        alert("Please provide signature first.");
        event.preventDefault();
      }else{
        var canvas  = document.getElementById("the_canvas");
        var dataUrl = canvas.toDataURL();
        document.getElementById("signature").value = dataUrl;
      }
    });
    
    function my_function(){
      document.getElementById("note").innerHTML="";
    }
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
        document.getElementById("leaveReason").value = "N/A";
      }else{
        document.getElementById("fromDate").disabled = false;
        document.getElementById("toDate").disabled = false;
        document.getElementById("leaveReason").disabled = false;
        document.getElementById("leaveReason").value = "";
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

	<script src="../../js/classie.js"></script>
	<script src="../../js/jquery.nicescroll.js"></script>
	<script src="../../js/scripts.js"></script>
	<script src="../../js/bootstrap.js"> </script>
</body>
</html>