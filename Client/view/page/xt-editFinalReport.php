<?php

  $host = "sql444.main-hosting.eu";
  $user = "u928796707_group34";
  $password = "u1VF3KYO1r|";
  $database = "u928796707_internshipWeb";
                                              
  $conn = mysqli_connect($host, $user, $password, $database); 

	include('../../includes/db_connection.php');

  if(session_status() != PHP_SESSION_ACTIVE) session_start();

	if (isset($_SESSION['studentChangePass'])) {
		header('Location: clientChangePassword.php?requireChangePass&notAllowed');
	}
    
  if (!isset($_SESSION['studentID'])) {
    echo "<script>
        window.location.href = 'clientLogin.php';
    </script>";
	} else {
    $studID = $_SESSION['studentID'];
  }

	if(isset($_GET['finalReportID'])){
    $finalReportID = $_GET['finalReportID'];
  }

  $get_stud = "SELECT * FROM Student WHERE studentID = '$studID'";
  $run_stud = mysqli_query($conn, $get_stud);
  $row_stud = mysqli_fetch_array($run_stud);
  $studName = $row_stud['studName'];

  $get_final = "SELECT * FROM finalReport WHERE finalReportID = '$finalReportID'";
  $run_final = mysqli_query($conn, $get_final);
  $row_final = mysqli_fetch_array($run_final);

  $internAppID = $row_final['internAppID'];
  $acknowledgements = $row_final['acknowledgements'];
  $abstract = $row_final['abstract'];
  $trainingScheme = $row_final['trainingScheme'];
  $trainingScope = $row_final['trainingScope'];
  $cmpBackground = $row_final['cmpBackground'];
  $businessOperation = $row_final['businessOperation'];
  $projectStructure = $row_final['projectStructure'];
  $trainingDept = $row_final['trainingDept'];
  $trainingPersonnel = $row_final['trainingPersonnel'];
  $projectBackground = $row_final['projectBackground'];
  $conclusion = $row_final['recommendation'];

  $getInternApp = "SELECT * FROM InternApplicationMap WHERE internAppID = '$internAppID'";
  $runInternApp = mysqli_query($conn, $getInternApp);
 	$rowInternApp = mysqli_fetch_array($runInternApp);
  $internJobID = $rowInternApp['internJobID'];
	$appInternStartDate = $rowInternApp['appInternStartDate'];
	$appInternEndDate = $rowInternApp['appInternEndDate'];

  $getCmpInfo = "SELECT * FROM InternJob WHERE internJobID = '$internJobID'";
  $runCmpInfo = mysqli_query($conn, $getCmpInfo);
  $rowCmpInfo = mysqli_fetch_array($runCmpInfo);
  $cmpID = $rowCmpInfo['companyID'];

	$get_cmp = "SELECT * FROM Company WHERE companyID = '$cmpID'";
  $run_cmp = mysqli_query($conn, $get_cmp);
	$row_cmp = mysqli_fetch_array($run_cmp);
	$cmpName = $row_cmp['cmpName'];
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
  <title>ITP System | Edit Final Report</title>
  
  <script src="../../js/jquery-1.11.1.min.js"></script>
  <script src="../../js/toastr.min.js"></script>
  <script src="../../js/customToastr.js"></script>

  <link href="../../css/toastr.min.css" rel="stylesheet">
	<link href="../../css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="../../css/style.css" rel='stylesheet' type='text/css' />
	<link href="../../css/font-awesome.css" rel="stylesheet">
	<link href="../../css/xt-finalReport.css" rel="stylesheet">
	
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

  <style>
    .tablesr{
      margin-top: 100px;
    }

    .title1{
      margin-top: 20px;
      margin-left: 50px;
    }

    .container{
      margin-top: 30px;
      margin-bottom: 50px;
    }

    #reset-btn {
      width: 70px;
    }

    #btn-save {
      width: 70px;
    }

    #btn-submit {
      background: #9c9dff;
      width: 70px;
    }
  </style>
</head>

<body class="cbp-spmenu-push">
	<div class="main-content">
		<?php include_once('../../includes/sidebar.php'); ?>
		<?php include_once('../../includes/header.php'); ?>
		<div id="page-wrapper">
			<div class="main-page">
				<div class="tablesr">
					<h3 class="title1">Edit Final Report</h3>
          <form method="POST" enctype="multipart/form-data" id="signatureform">
            <div class="container">
              <div class="subtitle">
                <h2 class="sub-1">Student General Information</h2>
              </div>
              
              <div class="inputBox">
                <div class="viewInput">
                  <span>Name of Trainee</span>
                  <input type="text" name="studName" readonly value="<?php echo $studName;?>">
                </div>
                
                <div class="viewInput">
                  <span>Name of Company</span>
                  <input type="text" name="cmpName" id="cmpName" readonly value="<?php echo $cmpName;?>">
                </div>

                <div class="viewInput">
                  <span>Intern Start Date</span>
                  <input type="date" name="internStartDate" id="internStartDate" readonly value="<?php echo $appInternStartDate; ?>">
                </div> 

                <div class="viewInput">
                  <span>Intern End Date</span>
                  <input type="date" name="internEndDate" id="internEndDate" readonly value="<?php echo $appInternEndDate; ?>">
                </div>  
              </div>

              <div class="subtitle">
                <h2 class="sub-2">Acknowledgements</h2>
              </div>
            
              <div class="inputBox">
                <div class="viewInput" style="width:100%;">
                  <textarea type="text" name="acknowledgements" id="acknowledgements" oninput="countWord()" onPaste="return false" placeholder="Expression of appreciation to the company, faculty, individuals, etc."><?php echo $acknowledgements; ?></textarea>
                  <div class="wordCount"><span> [Word Count: </span><span id="show">0</span><span> / 300]</span></div>
                </div> 
              </div>

              <div class="subtitle">
                <h2 class="sub-3">Abstract</h2>
              </div>

              <div class="inputBox">
                <div class="viewInput" style="width:100%;">
                  <textarea type="text" name="abstract" id="abstract" oninput="countWord2()" onPaste="return false" placeholder="Summary of report with 200 to 300 words. It is to be written in the past tense. The abstract description should include the organisation and department with which the student was attached to, the assigned tasks, the achievements, and the learning experience gained during the training period."><?php echo $abstract; ?></textarea>
                  <div class="wordCount"><span> [Word Count: </span><span id="show2">0</span><span> / 300]</span></div>
                </div> 
              </div>

              <div class="subtitle">
                <h2 class="sub-4">Chapter 1: Introduction</h2>
              </div>

              <div class="inputBox">
                <div class="viewInput" style="width:100%;">
                  <span>Industrial training scheme</span>
                  <textarea type="text" name="trainingScheme" id="trainingScheme" oninput="countWord3()" onPaste="return false" placeholder="A brief description on the course objectives, duration, etc"><?php echo $trainingScheme; ?></textarea>
                  <div class="wordCount"><span> [Word Count: </span><span id="show3">0</span><span> / 200]</span></div>
                </div> 

                <div class="viewInput" style="width:100%;">
                  <span>Industrial training scopes</span>
                  <textarea type="text" name="trainingScope" id="trainingScope" oninput="countWord4()" onPaste="return false" placeholder="A summary of trainee’s job roles and responsibilities, etc."><?php echo $trainingScope; ?></textarea>
                  <div class="wordCount"><span> [Word Count: </span><span id="show4">0</span><span> / 200]</span></div>
                </div> 

                <div class="viewInput" style="width:100%;">
                  <span>Company background</span>
                  <textarea type="text" name="cmpBackground" id="cmpBackground" oninput="countWord5()" onPaste="return false" placeholder="Describe the background and details of the company."><?php echo $cmpBackground; ?></textarea>
                  <div class="wordCount"><span> [Word Count: </span><span id="show5">0</span><span> / 200]</span></div>
                </div> 

                <div class="viewInput" style="width:100%;">
                  <span>Business operation</span>
                  <textarea type="text" name="businessOperation" id="businessOperation" oninput="countWord6()" onPaste="return false" placeholder="Describe the basic operation perform by the company."><?php echo $businessOperation; ?></textarea>
                  <div class="wordCount"><span> [Word Count: </span><span id="show6">0</span><span> / 200]</span></div>
                </div> 

                <div class="viewInput" style="width:100%;">
                  <span>Structures of project</span>
                  <textarea type="text" name="projectStructure" id="projectStructure" oninput="countWord7()" onPaste="return false" placeholder="Describe the structures of organisation/project."><?php echo $projectStructure; ?></textarea>
                  <div class="wordCount"><span> [Word Count: </span><span id="show7">0</span><span> / 200]</span></div>
                </div> 

                <div class="viewInput" style="width:100%;">
                  <span>Training department</span>
                  <textarea type="text" name="trainingDept" id="trainingDept" oninput="countWord8()" onPaste="return false" placeholder="Explain the structure your training department."><?php echo $trainingDept; ?></textarea>
                  <div class="wordCount"><span> [Word Count: </span><span id="show8">0</span><span> / 200]</span></div>
                </div> 

                <div class="viewInput" style="width:100%;">
                  <span>Training personnel</span>
                  <textarea type="text" name="trainingPersonnel" id="trainingPersonnel" oninput="countWord9()" onPaste="return false" placeholder="Describe the personnel of training organisation and department."><?php echo $trainingPersonnel; ?></textarea>
                  <div class="wordCount"><span> [Word Count: </span><span id="show9">0</span><span> / 200]</span></div>
                </div> 
              </div>
            
              <div class="subtitle">
                <h2 class="sub-5">Chapter 2: Project Background and Responsibilities</h2>
              </div>
            
              <div class="inputBox">
                <div class="viewInput" style="width:100%;">
                  <textarea type="text" name="projectBackground" id="projectBackground" oninput="countWord10()" onPaste="return false" placeholder="Describe the project background, job responsibilities, experiences, details of work undertaken, problems faced, technology exposure, whether you have become aware of business opportunities and gained entrepreneurial skills as well as describe how you plan practise entrepreneurship in the future."><?php echo $projectBackground; ?></textarea>
                  <div class="wordCount"><span> [Word Count: </span><span id="show10">0</span><span> / 500]</span></div>
                </div>
              </div>

              <div class="subtitle">
                <h2 class="sub-6">Chapter 3: Conclusions & Recommendations</h2>
              </div>

              <div class="inputBox">
                <div class="viewInput" style="width:100%;">
                  <textarea type="text" name="conclusion" id="conclusion" oninput="countWord11()" onPaste="return false" placeholder="State your opinion and recommendations regarding experiences in the industry and future expectation, etc."><?php echo $conclusion; ?></textarea>
                  <div class="wordCount"><span> [Word Count: </span><span id="show11">0</span><span> / 500]</span></div>
                </div>
              </div>

              <div id="signature-pad">
                  <div id="canvasDiv" style="display: none;"></div>
                  <br>
                  <button type="button" class="btn btn-danger" id="reset-btn">Reset</button>
                  <input type="submit" class="btn btn-success" id="btn-save" name="signatureedit" value="Save">
                  <input type="submit" class="btn btn-success" id="btn-submit" name="submit" value="Submit">
              </div>

              <input type="hidden" id="signature" name="signature">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php
    if(isset($_POST['signatureedit'])){
      $acknowledgements = $_POST['acknowledgements'];
      $abstract = $_POST['abstract'];
      $trainingScheme = $_POST['trainingScheme'];
      $trainingScope = $_POST['trainingScope'];
      $cmpBackground = $_POST['cmpBackground'];
      $businessOperation = $_POST['businessOperation'];
      $projectStructure = $_POST['projectStructure'];
      $trainingDept = $_POST['trainingDept'];
      $trainingPersonnel = $_POST['trainingPersonnel'];
      $projectBackground = $_POST['projectBackground'];
      $conclusion = $_POST['conclusion'];
      $status = "Saved";
    
      $sql = "UPDATE finalReport SET acknowledgements='$acknowledgements', abstract='$abstract', trainingScheme='$trainingScheme', trainingScope='$trainingScope', cmpBackground='$cmpBackground', businessOperation='$businessOperation', projectStructure='$projectStructure', trainingDept='$trainingDept', trainingPersonnel='$trainingPersonnel', projectBackground='$projectBackground', recommendation='$conclusion' WHERE finalReportID='$finalReportID'";
    
      if (mysqli_query($conn, $sql)) {
        echo "<script>alert('The report have been saved into database.')</script>";     
        echo "<script>window.open('xt-viewFinalReport.php','_self')</script>";
      }else{
        echo "Error: " . $sql . mysqli_error($conn);
      }
    }
?>

<?php
  if(isset($_POST['submit'])){
    $acknowledgements = $_POST['acknowledgements'];
    $abstract = $_POST['abstract'];
    $trainingScheme = $_POST['trainingScheme'];
    $trainingScope = $_POST['trainingScope'];
    $cmpBackground = $_POST['cmpBackground'];
    $businessOperation = $_POST['businessOperation'];
    $projectStructure = $_POST['projectStructure'];
    $trainingDept = $_POST['trainingDept'];
    $trainingPersonnel = $_POST['trainingPersonnel'];
    $projectBackground = $_POST['projectBackground'];
    $conclusion = $_POST['conclusion'];
    $status = "Saved";
    
    $sql = "UPDATE finalReport SET acknowledgements='$acknowledgements', abstract='$abstract', trainingScheme='$trainingScheme', trainingScope='$trainingScope', cmpBackground='$cmpBackground', businessOperation='$businessOperation', projectStructure='$projectStructure', trainingDept='$trainingDept', trainingPersonnel='$trainingPersonnel', projectBackground='$projectBackground', recommendation='$conclusion' WHERE finalReportID='$finalReportID'";
    
    if (mysqli_query($conn, $sql)) {
      echo "<script>window.open('xt-submitFinalReport.php?finalReportID=$finalReportID','_self')</script>";
    }else{
      echo "Error: " . $sql . mysqli_error($conn);
    }
  }
?>

  <script>
    $(document).ready(function(){
      var form = $('#signatureform'),
        original = form.serialize()
      
        form.submit(function(){
        window.onbeforeunload = null
      })

      window.onbeforeunload = function(){
        if (form.serialize() != original)
          return 'Are you sure you want to leave?'
      }
    })

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
        document.getElementById("acknowledgements").value = "";
        document.getElementById("abstract").value = "";
        document.getElementById("trainingScheme").value = "";
        document.getElementById("trainingScope").value = "";
        document.getElementById("cmpBackground").value = "";
        document.getElementById("businessOperation").value = "";
        document.getElementById("projectStructure").value = "";
        document.getElementById("trainingDept").value = "";
        document.getElementById("trainingPersonnel").value = "";
        document.getElementById("projectBackground").value = "";
        document.getElementById("conclusion").value = "";
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

        /*$("#btn-submit").click(function() {
          let week1 = document.getElementById('week1').value;
          let week2 = document.getElementById('week2').value;
          let week3 = document.getElementById('week3').value;
          let week4 = document.getElementById('week4').value;
          let problem = document.getElementById('problem').value;
          var minLength = 100;

            if (week1 == '' || week2 == '' || week3 == '' || week4 == '' || problem == '') {
              warning("Please fill in all fields");
            }else if(week1.length < minLength || week2.length < minLength || week3.length < minLength || week4.length < minLength || problem.length < minLength) {
              info("Please write a summary of your work in at least 100 words.");
            }else{
              window.location.href = '../../view/page/xt-submitWorkProgress.php?monthlyReportID=<?php echo $monthlyReportID; ?>';
            }
        })*/
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
    function dateStrToObj(dateStr) {
      const [year, month, date] = dateStr.split('-').map(Number)
      return new Date(year, month - 1, date)
    }
    
    function onChange() {
      let output = document.getElementById("leaveDays");
      let fromDate = new Date(document.getElementById("fromDate").value);
      let toDate = new Date(document.getElementById("toDate").value);
      const startDateStr = document.querySelector('#fromDate').value
      const endDateStr = document.querySelector('#toDate').value
      
      if (!startDateStr || !endDateStr) return
      const startDate = dateStrToObj(startDateStr)
      const endDate = dateStrToObj(endDateStr)
      
      if (endDate.valueOf() < startDate.valueOf()) {
        warning('End date is before start date!');
        document.getElementById("toDate").value = document.getElementById("fromDate").value
      }
      else{
        if(fromDate.getTime() && toDate.getTime()){
          let timeDifference = toDate.getTime() - fromDate.getTime();

          let dayDifference = Math.abs(timeDifference / (1000 * 3600 *24));
          output.value = dayDifference;
        }
      }
    }
    
    for (const dateInput of document.querySelectorAll('input[type=date]')) {
      dateInput.addEventListener('change', onChange)
    }
  </script>

<script>
    function countWord() {
      var words = document.getElementById("acknowledgements").value;
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
      var words = document.getElementById("abstract").value;
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
      var words = document.getElementById("trainingScheme").value;
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
      var words = document.getElementById("trainingScope").value;
      var count = 0;
      var split = words.split(' ');
      for (var i = 0; i < split.length; i++) {
        if (split[i] != "") {
          count += 1;
        }
      }
    
      document.getElementById("show4").innerHTML = count;
    }

    function countWord5() {
      var words = document.getElementById("cmpBackground").value;
      var count = 0;
      var split = words.split(' ');
      for (var i = 0; i < split.length; i++) {
        if (split[i] != "") {
          count += 1;
        }
      }
    
      document.getElementById("show5").innerHTML = count;
    }

    function countWord6() {
      var words = document.getElementById("businessOperation").value;
      var count = 0;
      var split = words.split(' ');
      for (var i = 0; i < split.length; i++) {
        if (split[i] != "") {
          count += 1;
        }
      }
    
      document.getElementById("show6").innerHTML = count;
    }

    function countWord7() {
      var words = document.getElementById("projectStructure").value;
      var count = 0;
      var split = words.split(' ');
      for (var i = 0; i < split.length; i++) {
        if (split[i] != "") {
          count += 1;
        }
      }
    
      document.getElementById("show7").innerHTML = count;
    }

    function countWord8() {
      var words = document.getElementById("trainingDept").value;
      var count = 0;
      var split = words.split(' ');
      for (var i = 0; i < split.length; i++) {
        if (split[i] != "") {
          count += 1;
        }
      }
    
      document.getElementById("show8").innerHTML = count;
    }

    function countWord9() {
      var words = document.getElementById("trainingPersonnel").value;
      var count = 0;
      var split = words.split(' ');
      for (var i = 0; i < split.length; i++) {
        if (split[i] != "") {
          count += 1;
        }
      }
    
      document.getElementById("show9").innerHTML = count;
    }

    function countWord10() {
      var words = document.getElementById("projectBackground").value;
      var count = 0;
      var split = words.split(' ');
      for (var i = 0; i < split.length; i++) {
        if (split[i] != "") {
          count += 1;
        }
      }
    
      document.getElementById("show10").innerHTML = count;
    }

    function countWord11() {
      var words = document.getElementById("conclusion").value;
      var count = 0;
      var split = words.split(' ');
      for (var i = 0; i < split.length; i++) {
        if (split[i] != "") {
          count += 1;
        }
      }
    
      document.getElementById("show11").innerHTML = count;
    }
    
    document.getElementById("acknowledgements").addEventListener("keypress", function(evt){
      var words = this.value.split(/\s+/);
      var numWords = words.length;    // Get # of words in array
      var maxWords = 300;
      
      if(numWords > maxWords){
        evt.preventDefault(); // Cancel event
      }
    });

    document.getElementById("abstract").addEventListener("keypress", function(evt){
      var words = this.value.split(/\s+/);
      var numWords = words.length;    // Get # of words in array
      var maxWords = 300;
      
      if(numWords > maxWords){
        evt.preventDefault(); // Cancel event
      }
    });

    document.getElementById("trainingScheme").addEventListener("keypress", function(evt){
      var words = this.value.split(/\s+/);
      var numWords = words.length;    // Get # of words in array
      var maxWords = 200;
      
      if(numWords > maxWords){
        evt.preventDefault(); // Cancel event
      }
    });

    document.getElementById("trainingScope").addEventListener("keypress", function(evt){
      var words = this.value.split(/\s+/);
      var numWords = words.length;    // Get # of words in array
      var maxWords = 200;
      
      if(numWords > maxWords){
        evt.preventDefault(); // Cancel event
      }
    });

    document.getElementById("cmpBackground").addEventListener("keypress", function(evt){
      var words = this.value.split(/\s+/);
      var numWords = words.length;    // Get # of words in array
      var maxWords = 200;
      
      if(numWords > maxWords){
        evt.preventDefault(); // Cancel event
      }
    });

    document.getElementById("businessOperation").addEventListener("keypress", function(evt){
      var words = this.value.split(/\s+/);
      var numWords = words.length;    // Get # of words in array
      var maxWords = 200;
      
      if(numWords > maxWords){
        evt.preventDefault(); // Cancel event
      }
    });

    document.getElementById("projectStructure").addEventListener("keypress", function(evt){
      var words = this.value.split(/\s+/);
      var numWords = words.length;    // Get # of words in array
      var maxWords = 200;
      
      if(numWords > maxWords){
        evt.preventDefault(); // Cancel event
      }
    });

    document.getElementById("trainingDept").addEventListener("keypress", function(evt){
      var words = this.value.split(/\s+/);
      var numWords = words.length;    // Get # of words in array
      var maxWords = 200;
      
      if(numWords > maxWords){
        evt.preventDefault(); // Cancel event
      }
    });

    document.getElementById("trainingPersonnel").addEventListener("keypress", function(evt){
      var words = this.value.split(/\s+/);
      var numWords = words.length;    // Get # of words in array
      var maxWords = 200;
      
      if(numWords > maxWords){
        evt.preventDefault(); // Cancel event
      }
    });

    document.getElementById("projectBackground").addEventListener("keypress", function(evt){
      var words = this.value.split(/\s+/);
      var numWords = words.length;    // Get # of words in array
      var maxWords = 500;
      
      if(numWords > maxWords){
        evt.preventDefault(); // Cancel event
      }
    });

    document.getElementById("conclusion").addEventListener("keypress", function(evt){
      var words = this.value.split(/\s+/);
      var numWords = words.length;    // Get # of words in array
      var maxWords = 500;
      
      if(numWords > maxWords){
        evt.preventDefault(); // Cancel event
      }
    });

    var select_element = document.getElementById("leaveTaken");
    
    select_element.addEventListener("change", () => {
      
    var selected = select_element.options[select_element.selectedIndex ].value
      if(selected == "No" || selected == "NO"){
        document.getElementById("fromDate").disabled = true;
        document.getElementById("fromDate").value = "";
        document.getElementById("toDate").disabled = true;
        document.getElementById("toDate").value = "";
        document.getElementById("leaveDays").value = "0";
        document.getElementById("leaveReason").disabled = true;
      }else if(selected == "Yes" || selected == "YES"){
        document.getElementById("fromDate").disabled = false;
        document.getElementById("toDate").disabled = false;
        document.getElementById("leaveReason").disabled = false;
      }
    });

    window.onload = function() {
      
      var selected = select_element.options[select_element.selectedIndex ].value
        if(selected == "No" || selected == "NO"){
          document.getElementById("fromDate").disabled = true;
          document.getElementById("fromDate").value = "";
          document.getElementById("toDate").disabled = true;
          document.getElementById("toDate").value = "";
          document.getElementById("leaveDays").value = "0";
          document.getElementById("leaveReason").disabled = true;
        }else if(selected == "Yes" || selected == "YES"){
          document.getElementById("fromDate").disabled = false;
          document.getElementById("toDate").disabled = false;
          document.getElementById("leaveReason").disabled = false;
        }
      };
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