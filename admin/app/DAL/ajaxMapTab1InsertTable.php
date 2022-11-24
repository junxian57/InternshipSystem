<?php

require '../../includes/db_connection.php';

$tempArray = array();
$db = new DBController();

if(isset($_GET['lectureID']) && isset($_GET['internshipBatch']) && isset($_GET['tutorialGroupNo']) && isset($_GET['programmeID']) && isset($_GET['tab1-map'])){

    $lectureID = $_GET['lectureID'];
    $internshipBatch = $_GET['internshipBatch'];
    $tutorialGroupNo = $_GET['tutorialGroupNo'];
    $programmeID = $_GET['programmeID'];

    $sql = "SELECT S.studentID, S.studName, L.lecName
            FROM Student S, Lecturer L
            WHERE S.internshipBatchID LIKE '$internshipBatch' AND
            S.tutorialGroupNo = $tutorialGroupNo AND
            S.programmeID LIKE '$programmeID' AND
            S.lecturerID IS NULL AND
            L.lecturerID LIKE '$lectureID' AND
            S.studAccountStatus LIKE 'Pending Map';";

    $result = $db->runQuery($sql);

    if(!empty($result)){
        for($i=0; $i < count($result); $i++){
            $tempArray[] = array(
                "studentID" => $result[$i]['studentID'], 
                "studName" => $result[$i]['studName'],
                "lecName" => $result[$i]['lecName']
            );
        }
        echo json_encode($tempArray);
    }else{
        echo json_encode("No Data Found");
    }
 
    exit();
}
?>