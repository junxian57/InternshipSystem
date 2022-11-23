<?php

require '../../includes/db_connection.php';

$tempArray = array();
$db = new DBController();

if(isset($_GET['lecturerID']) && isset($_GET['insertTable']) && isset($_GET['tab1'])){
    //Tab 1 Search Supervisor Result Box
    $lecturerID = $_GET['lecturerID'];

    $sql = "SELECT S.studentID, S.tutorialGroupNo, S.internshipBatchID, S.studName, I.studentYear, I.studentSemester, P.programmeAcronym
            FROM Student S, Programme P, InternshipBatch I
            WHERE S.programmeID = P.programmeID AND
            S.internshipBatchID = I.internshipBatchID AND
            S.lecturerID = '$lecturerID' AND
            S.studAccountStatus = 'Active'
            ORDER BY S.studentID ASC;";

    $result = $db->runQuery($sql);

    if(!empty($result)){
        for($i=0; $i < count($result); $i++){
            $tempArray[] = array( 
                "studentID" => $result[$i]['studentID'],
                "tutorialGroupNo" => $result[$i]['tutorialGroupNo'],
                "internshipBatchID" => $result[$i]['internshipBatchID'],
                "studName" => $result[$i]['studName'],
                "studentYear" => $result[$i]['studentYear'],
                "studentSemester" => $result[$i]['studentSemester'],
                "programmeAcronym" => $result[$i]['programmeAcronym']
            );
        }
        echo json_encode($tempArray);
    }else{
        echo json_encode("No Data Found");
    }
 
    exit();
}

?>