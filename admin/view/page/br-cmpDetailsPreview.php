<?php
$systemPathPrefix = $_SERVER['DOCUMENT_ROOT'].'/InternshipSystem/admin/';

require_once $systemPathPrefix."app/DAL/companyDAL.php";

if(session_status() != PHP_SESSION_ACTIVE) session_start();

if (!isset($_SESSION['adminID'])) {
    if (!isset($_SESSION['committeeID'])) {
      echo "<script>
          window.location.href = 'adminLogin.php';
      </script>";
    }
}
    
if(isset($_GET['companyID']) && isset($_GET['status']) && isset($_GET['action']) && $_GET['status'] == 1 && $_GET['action'] == 1){
    $companyID = $_GET['companyID'];

    $result = getCompany($companyID);

    if(count($result) > 0){
        $companyID = $result[0]['companyID'];
        $companyName = $result[0]['cmpName'];
        $companyFields = $result[0]['cmpFieldsArea'];
        $companyAddress = $result[0]['cmpAddress'];
        $companyEmail = $result[0]['cmpEmail'];
        $companyPhone = $result[0]['cmpContactNumber'];
        $companyState = $result[0]['cmpState'];
        $companyCity = $result[0]['cmpCity'];
        $companyPostcode = $result[0]['cmpPostCode'];
        $companyContactPerson = $result[0]['cmpContactPerson'];
        $companySize = $result[0]['cmpCompanySize'];
    }
}else{ 
        echo "<script>
            alert('Restricted Action!!!\\nKindly use the formal way for accessing.');
            window.location.href = 'br-cmpAppTableReview.php';
        </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Review</title>
    <link href="../../css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="../../css/style.css" rel='stylesheet' type='text/css' />
    <link href="../../css/font-awesome.css" rel="stylesheet">
    <script src="../../js/jquery-1.11.1.min.js"></script>
    <script src="../../js/modernizr.custom.js"></script>
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href="../../css/animate.css" rel="stylesheet" type="text/css" media="all">
    <script src="../../js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <script src="../../js/metisMenu.min.js"></script>
    <script src="../../js/custom.js"></script>
    <link href="../../css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="../../scss/br-cmpDetailsPreview.css">
</head>
<body>
    <header>
        <div class="page-title">
            <h4>Tunku Abdul Rahman University College</h4>  
            <h3>Internship System</h3>         
        </div>
    </header>
    
    <div class="content">
    <body>
        </body>
        <div class="reject-comment">
            <div class="innerBox">
                <div class="horizon">
                    <h2>Reject Comment</h2>
                    <button id="close-btn">X</button>
                </div>
                <hr>
                <textarea name="rejectComment" id="rejectComment" cols="30" rows="5" placeholder="Reject Reason..." onkeyup="countCharacter()" maxlength="255"></textarea>
                <div class="count">
                    <p id="charCount">Character Count: <span style="color:#f2891f;">0</span> /255</p>
                </div>
                <button id="submit-btn">Submit</button>
            </div>
        </div>
        
        <div class="wrapper">
            <form action="#">
                <h3 class="form-title">Company Review</h3>
                <div class="title">
                    <h2 class="title-1">Company Name & Contact</h2>
                </div>
                <div class="input-style name-address-group">
                    <input type="text" style="width: 100%;" placeholder="Company Name" name="cmpName" readonly 
                    value="<?php echo $companyName; ?>">                  
                </div>

                <div class="input-style name-address-group">
                    <input type="text" placeholder="Contact No." name="cmpContactNo" value="<?php echo $companyPhone; ?>" readonly>   
                    <input type="email" placeholder="Email" name="cmpEmail" value="<?php echo $companyEmail; ?>" readonly>             
                </div>

                <div class="input-style name-address-group">
                    <input type="text" placeholder="Contact Person" name="cmpContactPerson" value="<?php echo $companyContactPerson; ?>" readonly>                
                </div>

                <div class="title">
                    <h2 class="title-2">Company Address</h2>
                </div>
                <div class="input-style name-address-group">
                    <textarea type="text" name="cmpAddress" placeholder="Address" cols="30" results="5" readonly><?php echo $companyAddress; ?></textarea>
                </div>

                <div class="input-style name-address-group">
                    <input type="text" placeholder="State" name="cmpState" value="<?php echo $companyState; ?>" readonly> 
                    <input type="text" placeholder="Postcode" name="cmpPostCode" value="<?php echo $companyPostcode; ?>" readonly>                  
                </div>

                <div class="input-style name-address-group">
                    <input type="text" placeholder="City" name="cmpCity" value="<?php echo $companyCity; ?>" readonly>                   
                </div>

                <div class="title">
                    <h2 class="title-3">Company Details</h2>
                </div>

                <div class="company-details-group input-style">  
                    <input type="text" style="width: 100%;" placeholder="Company Size" name="cmpCompanySize" value="<?php echo $companySize; ?>" readonly>              
                </div>

                <div class="title">
                    <h2 class="title-3">Company Fields</h2>
                </div>
               
                <div class="company-details-group input-style">
                    <div id="fields-row" class="task-row">
                        <?php
                            $fields = explode("-", $companyFields);
                            foreach($fields as $field){
                                if($field == "") continue;
                                echo "<div class='row'>";
                                echo "<p>$field</p>";
                                echo "</div>";
                            }
                        ?>
                      </div>
                </div>
                <hr>

                <div class="button-group">
                    <a class="clickable-btn approve" id="approve-btn">Approve</a>
                    <a class="clickable-btn reject" id="reject-btn">Reject</a>                
                </div>
            </form>
        </div>     
    </div>
</body>

<script>
    
    //Open The Reject Comment Window
    document.getElementById('reject-btn').addEventListener('click', function(){
        document.querySelector('.reject-comment').style.display = "block";
    });
    
    //Close The Reject Comment Window
    document.getElementById('close-btn').addEventListener('click', function(){
        document.querySelector('.reject-comment').style.display = 'none';
        document.getElementById('rejectComment').value = '';
        document.getElementById('charCount').innerHTML = `Character Count: <span style="color:#f2891f;">0</span> /255</p>`;
    });
    
    //Avoid To Press Enter
    document.getElementById('rejectComment').addEventListener('keypress', function(e){
        if(e.key === "Enter"){
            e.preventDefault();
            return;
        }
    });

    //Display Current Character Count
    function countCharacter(){
        let text = document.getElementById('rejectComment');
        let count = text.value.length;

        document.getElementById('charCount').innerHTML = `Character Count: <span style="color:#f2891f;">${count}</span> /255</p>`;
    }

    //Submit The Reject Comment
    document.getElementById('submit-btn').addEventListener('click', function(){
        let comment = document.getElementById('rejectComment').value;

        if(comment == ""){
            alert('Please enter a the reject reason');
            return;
        }

        let companyID = '<?php echo $companyID; ?>';
        let url = `../../app/DAL/cmpAppApprovalDAL.php?companyID=${companyID}&reject=true&comment=${encodeURIComponent(comment)}`;

        let confirmation = window.confirm('Are you sure to reject this company?');
        
        if(confirmation) window.location.href = url;
    });

    document.getElementById('approve-btn').addEventListener('click', function(){
        let companyID = '<?php echo $companyID; ?>';
        let url = `../../app/DAL/cmpAppApprovalDAL.php?companyID=${companyID}&approve=true`;

        let confirmation = window.confirm('Are you sure to approve this company?');

        if(confirmation) window.location.href = url;
    });



</script>
</html>