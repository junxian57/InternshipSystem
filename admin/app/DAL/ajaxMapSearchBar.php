<?php
require '../../includes/db_connection.php';

$tempArray = array();
$db = new DBController();

if(isset($_GET['supervisor'])){
    $supervisor = $_GET['supervisor'];

    $sql = "SELECT L.lecName, L.lecturerID, L.departmentID, F.facultyID
            FROM Lecturer L, Faculty F, Department D
            WHERE L.lecName LIKE '%$supervisor%' AND L.supervisorQualification = 1 AND
            L.currNoOfStudents < L.maxNoOfStudents AND
            L.departmentID = D.departmentID AND
            D.facultyID = F.facultyID
            ORDER BY L.departmentID ASC;";

    $result = $db->runQuery($sql);

    if(!empty($result)){
        for($i=0; $i < count($result); $i++){
            $tempArray[] = array(
                "lecName" => $result[$i]['lecName'], 
                "lecturerID" => $result[$i]['lecturerID'],
                "departmentID" => $result[$i]['departmentID'],
                "facultyID" => $result[$i]['facultyID']
            );
        }
    }

    echo json_encode($tempArray);
    exit();

}elseif(isset($_GET['student']) && isset($_GET['internBatch'])){

    $student = $_GET['student'];
    $intern = $_GET['internBatch'];

    $sql = "SELECT S.studentID, S.studName, F.facultyID
            FROM Student S, Faculty F, Programme P, Department D
            WHERE S.studName LIKE '%$student%' AND 
            S.internshipBatchID = $intern AND
            S.lecturerID IS NULL AND
            S.programmeID = P.programmeID AND
            P.departmentID = D.departmentID AND
            D.facultyID = F.facultyID;";

    $result = $db->runQuery($sql);

    if(!empty($result)){
        for($i=0; $i < count($result); $i++){
            $tempArray[] = array(
                "studentID" => $result[$i]['studentID'], 
                "studName" => $result[$i]['studName'],
                "facultyID" => $result[$i]['facultyID']
            );
        }
    }

    echo json_encode($tempArray);
    exit();

}elseif(isset($_GET['programme'])){
    $programme = $_GET['programme'];

    $sql = "SELECT P.programmeID, P.programmeName
            FROM Programme P
            WHERE P.programmeName LIKE '%$programme%';";

    $result = $db->runQuery($sql);

    if(!empty($result)){
        for($i=0; $i < count($result); $i++){
            $tempArray[] = array(
                "programmeID" => $result[$i]['programmeID'], 
                "programmeName" => $result[$i]['programmeName']
            );
        }
    }

    echo json_encode($tempArray);
    exit();
}
?>