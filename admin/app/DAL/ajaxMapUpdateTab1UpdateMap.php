<?php
require '../../includes/db_connection.php';
require '../../../config/email.php';

$tempArray = array();
$db = new DBController();

if(isset($_GET['newLectureID']) && isset($_GET['oldLectureID']) && isset($_GET['oldLectureName']) && isset($_GET['studentIDArr']) && isset($_GET['tab1'])){
    //New Lecturer
    $newLectureID = $_GET['newLectureID'];
    //Old Lecturer
    $oldLectureID = $_GET['oldLectureID'];
    $oldLectureName = $_GET['oldLectureName'];
    //Student ID Array
    $studentIDArr = $_GET['studentIDArr'];
    $mailConfig = new EmailConfig();

    //remove [] in $studentIDArr
    $studentIDArr = str_replace("[", "", $studentIDArr);
    $studentIDArr = str_replace("]", "", $studentIDArr);

    $result = false;

    //Update Student Lecturer Mapping
    $sqlUpdateStudLecMap = "UPDATE Student SET lecturerID = '$newLectureID' WHERE studentID IN ($studentIDArr);";
    
    try{
        $result = $db->executeQuery($sqlUpdateStudLecMap);
    }catch(Exception $e){
        echo json_encode($e);
        exit(0);
    }

    if($result){
        $studentCount = count(explode(",", $studentIDArr));
    
        $sqlUpdateLecturerStudCount = "UPDATE Lecturer 
                                        SET currNoOfStudents = 
                                                        (CASE  
                                                            WHEN lecturerID = '$oldLectureID' THEN currNoOfStudents - $studentCount
                                                            WHEN lecturerID = '$newLectureID' THEN currNoOfStudents + $studentCount
                                                        END)
                                        WHERE lecturerID IN ('$newLectureID', '$oldLectureID');";
        $result = $db->executeQuery($sqlUpdateLecturerStudCount);
    }else{
        echo json_encode("Failed");
        exit(0);
    }

    if($result){
        $getEmailSql = "SELECT S.studEmail, L.lecName, L.lecEmail FROM Student S, Lecturer L  WHERE S.studentID IN ($studentIDArr) AND S.lecturerID = L.lecturerID;";

        $studentEmail = $db->runQuery($getEmailSql);

        foreach($studentEmail as $studentInfo){
            $newLectureName = $studentInfo['lecName'];
            $lectureEmail = $studentInfo['lecEmail'];
            $mailConfig->singleEmail(
                $studentInfo['studEmail'],
                "Your Internship Supervisor Has Been Updated", 
                createHTMLmailForStudent($oldLectureName, $newLectureName, $lectureEmail)
            );
        }

        $mailConfig2 = new EmailConfig();

        $mailConfig2->singleEmail(
            $lectureEmail, 
            "Internship Student Has Been Transferred", 
            createHTMLmailForLecturer($oldLectureName, $newLectureName)
        );

        echo json_encode("Success");

    }else{
        echo json_encode("Failed");
    }

    exit(0);
}

function createHTMLmailForStudent($oldLectureName, $newLectureName, $lectureEmail){
    $html = "
    <html>
        <head>
            <title>Your Internship Supervisor Has Been Updated</title>
        </head>
        <body>
            <p>Dear Student,</p>
            <p>Your internship supervisor has been updated from <span style='color:#535ea6; font-weight: bold;'> $oldLectureName </span> to <span style='color:#ff4500; font-weight: bold;'>$newLectureName</span>.</p>
            <p>Please contact your new supervisor at email: <span style='color:#313e85; font-weight: bold;'>$lectureEmail</span> for further information.</p>
        </body>
    </html>
    ";

    return $html;
}

function createHTMLmailForLecturer($oldLectureName, $newLectureName){
    $link = 'http://localhost/InternshipSystem/Client/view/page/br-StudentSupervisor-Manage.php';

    $html = "
    <html>
        <head>
            <title>Your Internship Supervisor Has Been Updated</title>
        </head>
        <body>
            <p>Dear $newLectureName,</p>
            <p>You have been assigned as new internship supervisor for students who previously supervised by <span style='color:#535ea6; font-weight: bold;'> $oldLectureName </span></p>
            <p>Please click <a href='$link'>here</a> to view the list of students.</p>
        </body>
    </html>
    ";

    return $html;
}

?>