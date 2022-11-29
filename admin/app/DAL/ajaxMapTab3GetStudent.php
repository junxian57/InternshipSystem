<?php
require '../../includes/db_connection.php';

$tempArray = array();
$db = new DBController();

if(isset($_GET['programmeID']) && isset($_GET['internshipID']) && isset($_GET['tutorialGroup'])){
    $programmeID = $_GET['programmeID'];
    $internshipID = $_GET['internshipID'];

    $tutorialGroupArr = $_GET['tutorialGroup'];
    //remove [] in $studentIDArr
    $tutorialGroupArr = str_replace("[", "", $tutorialGroupArr);
    $tutorialGroupArr = str_replace("]", "", $tutorialGroupArr);

    $sql = "SELECT S.studentID, S.studName, F.facAcronym, P.programmeAcronym, S.tutorialGroupNo
            FROM Student S, Programme P, Faculty F, Department D
            WHERE S.programmeID = P.programmeID AND
            P.departmentID = D.departmentID AND
            D.facultyID = F.facultyID AND
            S.tutorialGroupNo IN ($tutorialGroupArr) AND
            S.lecturerID IS NULL AND
            S.studAccountStatus LIKE 'Pending Map' AND
            S.programmeID LIKE '$programmeID' AND
            S.internshipBatchID LIKE '$internshipID';";

    $result = $db->runQuery($sql);

    if(!empty($result)){
        foreach($result as $row){
            $tempArray[] = array(
                "studentID" => $row['studentID'], 
                "studName" => $row['studName'],
                "facAcronym" => $row['facAcronym'],
                "programmeAcronym" => $row['programmeAcronym'],
                "tutorialGroupNo" => $row['tutorialGroupNo']
            );          
        }
        echo json_encode($tempArray);
    }else{
        echo json_encode("No Data Found");
    }
    
    exit();
}


?>