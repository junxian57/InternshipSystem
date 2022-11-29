<?php
require '../../includes/db_connection.php';
require '../../../config/email.php';

$tempArray = array();
$db = new DBController();

if(isset($_GET['studentID']) && isset($_GET['tab2'])){
    $studentID = $_GET['studentID'];
    $mailConfig = new EmailConfig();
    $result = false;
    
    //Get Student Email
    $getEmailSql = "SELECT S.studEmail, L.lecName, L.lecEmail FROM Student S, Lecturer L  WHERE S.studentID = '$studentID' AND S.lecturerID = L.lecturerID;";

    try{
        $infoArray = $db->runQuery($getEmailSql);
    
        $lectureName = $infoArray[0]['lecName'];
        $lectureEmail = $infoArray[0]['lecEmail'];
        $studentEmail = $infoArray[0]['studEmail'];
    }catch(Exception $e){
        echo json_encode($e);
        exit(0);
    }

    //Update New Supervisor Current Count
    $sqlUpdateSupervisorCount = "UPDATE Lecturer SET currNoOfStudents = currNoOfStudents - 1 WHERE lecturerID = (SELECT lecturerID FROM Student WHERE studentID = '$studentID');";

    try{
        $result = $db->executeQuery($sqlUpdateSupervisorCount);
    }catch(Exception $e){
        echo json_encode($e);
        exit(0);
    }

    //Remove Student from Lecturer
    $sqlRemoveStudent = "UPDATE Student SET lecturerID = NULL WHERE studentID = '$studentID';";
    
    try{
        $result = $db->executeQuery($sqlRemoveStudent);
    }catch(Exception $e){
        echo json_encode($e);
        exit(0);
    }

    if($result){
        $mailConfig->singleEmail(
            $studentEmail,
            "Your Internship Supervisor Has Been Removed", 
            createHTMLmail($lectureName, $lectureEmail)
        );

        echo json_encode("Success");

    }else{
        echo json_encode("Failed");
    }

    exit(0);
}

function createHTMLmail($lectureName, $lectureEmail){
    $html = "
    <html>
        <head>
            <title>Your Internship Supervisor Has Been Updated</title>
        </head>
        <body>
            <p>Dear Student,</p>
            <p>Your internship supervisor: <span style='color:#ff4500; font-weight: bold;'>$lectureName</span> has been removed by the ITP Committee.</p>
            <p>Please contact your supervisor at email: <span style='color:#313e85; font-weight: bold;'>$lectureEmail</span> for further information.</p>
        </body>
    </html>
    ";

    return $html;
}

?>