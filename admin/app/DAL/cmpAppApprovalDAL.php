<?php
require_once '../../includes/db_connection.php';
require_once '../../../config/email.php';

$db = new DBController();
$emailConfig = new EmailConfig();

if(isset($_GET['companyID']) && isset($_GET['approve'])){
    $companyID = $_GET['companyID'];

    //Get Company Details
    $sql = "SELECT * FROM Company WHERE companyID = '$companyID'";
    $result = $db->runQuery($sql);

    $email = $result[0]['cmpEmail'];
    $companyName = $result[0]['cmpName'];
    $encodedName = urlencode($companyName);

    //Create Company Account
    $shuffleNumber = substr(str_shuffle('0123456789'), 0, 3);
    $shuffleCharacter1 = substr(str_shuffle('!@#$%&*'), 0, 1);
    $shuffleCharacter2 = substr(str_shuffle('0123456789abcdefgh'), 0, 1);
    $companyAccount = explode(' ', $companyName)[0].$shuffleCharacter1.$shuffleNumber.$shuffleCharacter2;
    
    //Create Company Initial Password
    $initialPassword = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%&*'), 0, 8);
    $afterHashed = password_hash($initialPassword, PASSWORD_DEFAULT);

    //Update Company Account, Password, Status
    $sql = "UPDATE Company SET cmpAccountStatus = 'InitialPass', cmpUsername = '$companyAccount', cmpPassword = '$afterHashed' WHERE companyID = '$companyID'";

    $result = $db->executeQuery($sql);

    //If update success, send email to company
    if($result){ 
        $emailConfig->singleEmail(
            $email, 
            'Approval of Application to TARUMT Internship System', 
            createHTMLEmailForSuccess($companyName, $companyAccount, $initialPassword)
        );
        
        header("Location: ../../view/page/br-cmpAppTableReview.php?companyID=$companyID&companyName=$encodedName&approve=1");
    }else{
        header("Location: ../../view/page/br-cmpAppTableReview.php?companyID=$companyID&companyName=$encodedName&failed=1");
    }

}else if(isset($_GET['companyID']) && isset($_GET['reject']) && isset($_GET['comment'])){
    $companyID = $_GET['companyID'];
    $comment = urldecode($_GET['comment']);

    //Get Company Details
    $sql = "SELECT * FROM Company WHERE companyID = '$companyID'";
    $result = $db->runQuery($sql);

    $email = $result[0]['cmpEmail'];
    $companyName = $result[0]['cmpName'];
    $encodedName = urlencode($companyName);

    //Update Company Account, Password, Status
    $sql = "UPDATE Company SET cmpAccountStatus = 'Rejected', cmpRejectReason = '$comment' WHERE companyID = '$companyID'";

    $result = $db->executeQuery($sql);

    //If update success, send email to company
    if($result){ 
        $emailConfig->singleEmail(
            $email, 
            'Rejection of Application to TARUMT Internship System', 
            createHTMLEmailForFailed($companyName, $comment)
        );
        
        header("Location: ../../view/page/br-cmpAppTableReview.php?companyID=$companyID&companyName=$encodedName&reject=1");
    }else{
        header("Location: ../../view/page/br-cmpAppTableReview.php?companyID=$companyID&companyName=$encodedName&failed=1");
    }
    
}

//Todo: Connect Link for Login and Setup Password
function createHTMLEmailForSuccess($companyName, $companyAccount, $initialPassword){
    $loginLink = "http://localhost/internshipSystem/Client/view/page/clientLogin.php";
    $html = "
    <html>
    <head>
        <title>Company Application Approval</title>
    </head>
    <body>
        <p>Dear Sir/Madam,</p>
        <p>Welcome To TARUMT Internship System.</p>
        <br>
        <p>Your company  <span style='font-weight: bold;'>($companyName)</span> application as our internship partner has been <span style='color:#44ab15; font-weight: bold; text-decoration:underline;'>Approved</span>.</p> 
        <p>Please <a href='$loginLink' style='font-weight: bold; text-decoration:underline;'>Login</a> to your account to change your password and complete your company portfolio by using Company Account and Initial Password provided below.</p><br>
        <p>Company Account: <span style='color:#ff4500; font-weight: bold;'>$companyAccount</span></p>
        <p>Initial Password: <span style='color:#ff4500; font-weight: bold;'>$initialPassword</span></p>
        <br>
        <p>Thank you.</p>
    </body>
    </html>";

    return $html;
}

function createHTMLEmailForFailed($companyName, $rejectReason){
    $companyID = $_GET['companyID'];

    $amendLink = "http://localhost/internshipSystem/Client/view/page/br-cmpSelfAppModification.php?companyID=$companyID&rejected=1&amend=1";

    $html = "
    <html>
    <head>
        <title>Company Application Approval</title>
    </head>
    <body>
        <p>Dear Sir/Madam,</p>
        <p>Thanks For Approaching TARUMT Internship System.</p>
        <br>
        <p>Your company <span style='font-weight: bold;'>($companyName)</span> application as our internship partner has been <span style='color:#ff4500; font-weight: bold; text-decoration:underline;'>Rejected</span>.</p>
        <br>
        <p>Rejected Reason: <span style='font-weight: bold;'>$rejectReason</span></p>
        <p>Please click on this <a href='$amendLink' style='font-weight: bold; text-decoration:underline;'>Link</a> to amend the requirement and submit the application again.</p><br>
        <br>
        <p>Thank you.</p>
    </body>
    </html>";

    return $html;
}
?>