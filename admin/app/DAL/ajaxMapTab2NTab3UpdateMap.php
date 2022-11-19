<?php
require '../../includes/db_connection.php';
require '../../../config/email.php';

$tempArray = array();
$db = new DBController();

if(isset($_GET['studentLecMap'])){
    $studentLecMapArr = json_decode($_GET['studentLecMap']);
    $result = false;
    $mailConfig = new EmailConfig();

    foreach($studentLecMapArr as $studentID => $lectureID){
        //Update student lecturerID
        $sql = "UPDATE Student SET lecturerID = '$lectureID' WHERE studentID = '$studentID';";
        $result = $db->executeQuery($sql);
       
        if($result){
            //Send Email to student
            $getEmailSql = "SELECT S.studEmail, L.lecName, L.lecEmail FROM Student S, Lecturer L  WHERE S.studentID = '$studentID' AND S.lecturerID = L.lecturerID;";

            $studentEmail = $db->runQuery($getEmailSql);

            $lectureName = $studentEmail[0]['lecName'];
            $lectureEmail = $studentEmail[0]['lecEmail'];

            $sent = $mailConfig->singleEmail(
                $studentEmail[0]['studEmail'], 
                "Internship Supervisor Has Been Assigned", 
                createHTMLmail($lectureName, $lectureEmail)
            );

        }else{
            echo json_encode($studentID);
            break;
        }
        
    }

    if($result){
        echo json_encode("Success");
    }

    exit(0);
}

function createHTMLmail($lectureName, $lectureEmail){
    $html = "
    <html>
        <head>
            <title>Internship Supervisor Has Been Assigned</title>
        </head>
        <body>
            <p>Dear Student,</p>
            <p>Your internship supervisor has been assigned : 
            <span style='color:#ff4500; font-weight: bold;'>$lectureName</span>.
            </p>
            <p>Please contact your supervisor at email: <span style='color:#313e85; font-weight: bold;'>$lectureEmail</span> for further information.</p>
        </body>
    </html>
    ";

    return $html;
}


?>