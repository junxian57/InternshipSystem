<?php
require '../../includes/db_connection.php';
require '../../../config/email.php';

$tempArray = array();
$db = new DBController();

if(isset($_GET['lectureID']) && isset($_GET['studentIDArr'])){
    $lectureID = $_GET['lectureID'];
    $studentIDArr = $_GET['studentIDArr'];
    $mailConfig = new EmailConfig();

    //remove [] in $studentIDArr
    $studentIDArr = str_replace("[", "", $studentIDArr);
    $studentIDArr = str_replace("]", "", $studentIDArr);

    //Update Student Lecturer Mapping
    $sql = "UPDATE Student SET lecturerID = '$lectureID' WHERE studentID IN ($studentIDArr);";

    $result = $db->executeQuery($sql);

    if($result){
        $studentCount = count(explode(",", $studentIDArr));
    
        $sqlUpdateCurrStud = "UPDATE Lecturer SET currNoOfStudents = currNoOfStudents + $studentCount WHERE lecturerID = '$lectureID';";
    
        $result = $db->executeQuery($sqlUpdateCurrStud);
    }

    if($result){
        $getEmailSql = "SELECT S.studEmail, L.lecName, L.lecEmail FROM Student S, Lecturer L  WHERE S.studentID IN ($studentIDArr) AND S.lecturerID = L.lecturerID;";

        $studentEmail = $db->runQuery($getEmailSql);

        foreach($studentEmail as $studentInfo){
            $lectureName = $studentInfo['lecName'];
            $lectureEmail = $studentInfo['lecEmail'];
            $mailConfig->singleEmail(
                $studentInfo['studEmail'], 
                "Internship Supervisor Has Been Assigned", 
                createHTMLmail($lectureName, $lectureEmail)
            );
        }

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
