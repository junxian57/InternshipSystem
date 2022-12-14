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
        $sql = "UPDATE Student SET lecturerID = '$lectureID', studAccountStatus = 'Active' WHERE studentID = '$studentID';";
        $result = $db->executeQuery($sql);

        if($result){
            $sqlUpdateCurrStud = "UPDATE Lecturer SET currNoOfStudents = currNoOfStudents + 1 WHERE lecturerID = '$lectureID';";
        
            $result = $db->executeQuery($sqlUpdateCurrStud);
        }
       
       if($result){
            //Send Email to student
            $getEmailSql = "SELECT S.studEmail, L.lecName, L.lecEmail FROM Student S, Lecturer L  WHERE S.studentID = '$studentID' AND S.lecturerID = L.lecturerID;";

            $studentEmail = $db->runQuery($getEmailSql);

            $lectureName = $studentEmail[0]['lecName'];
            $lectureEmail = $studentEmail[0]['lecEmail'];

            //Store into an array for unique lecturer ID
            $tempArray[$lectureID] = array(
                'lectureName' => $lectureName,
                'lectureEmail' => $lectureEmail
            );

            $sent = $mailConfig->singleEmail(
                $studentEmail[0]['studEmail'], 
                "Internship Supervisor Has Been Assigned", 
                createHTMLmailForStudent($lectureName, $lectureEmail)
            );            
        }else{
            echo json_encode($studentID);
            break;
        }
    }

    $mailConfig2 = new EmailConfig();

    //Send Email to lecturer
    foreach($tempArray as $lectureID => $lectureInfo){
        $sent = $mailConfig2->singleEmail(
            $lectureInfo['lectureEmail'], 
            "Internship Student Has Been Assigned", 
            createHTMLmailForLecturer($lectureInfo['lectureName'])
        );
    }

    if($result){
        echo json_encode("Success");
    }

    exit(0);
}

function createHTMLmailForStudent($lectureName, $lectureEmail){
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

function createHTMLmailForLecturer($lectureName){
    $link = 'http://localhost/InternshipSystem/Client/view/page/br-StudentSupervisor-Manage.php';

    $html = "";

    $html .= "
    <html>
        <head>
            <title>Internship Supervisor Has Been Assigned</title>
        </head>
        <body>
            <p>Dear $lectureName,</p>
            <p>Your internship students have been assigned to you.</p>
            <p>Please click this <a href='$link' style='color:#313e85; font-weight: bold;'>link</a> below to review your students.</p>
            <p>
        </body>
    </html>
    ";

    return $html;
}


?>