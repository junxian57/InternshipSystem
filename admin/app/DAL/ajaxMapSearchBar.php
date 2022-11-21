<?php
require '../../includes/db_connection.php';

$tempArray = array();
$db = new DBController();

if(isset($_GET['supervisor'])){
    $supervisor = $_GET['supervisor'];

    $sql = "SELECT L.lecName, L.lecturerID, L.departmentID, F.facultyID, F.facAcronym, L.currNoOfStudents, L.maxNoOfStudents
            FROM Lecturer L, Faculty F, Department D
            WHERE (L.lecName LIKE '%$supervisor%' OR L.lecturerID LIKE '%$supervisor%') AND L.supervisorQualification = 1 AND
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
                "facultyID" => $result[$i]['facultyID'],
                "facAcronym" => $result[$i]['facAcronym'],
                "currNoOfStudents" => $result[$i]['currNoOfStudents'],
                "maxNoOfStudents" => $result[$i]['maxNoOfStudents']
            );
        }
        echo json_encode($tempArray);
    }else{
        echo json_encode("No Data Found");
    }
    exit(0);

}elseif(isset($_GET['student']) && isset($_GET['internBatch'])){

    $student = $_GET['student'];
    $intern = $_GET['internBatch'];

    $sql = "SELECT S.studentID, S.studName, F.facultyID, P.programmeID, F.facAcronym, P.programmeAcronym
            FROM Student S, Faculty F, Programme P, Department D
            WHERE (S.studName LIKE '%$student%' OR L.studentID LIKE '%$student%') AND 
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
                "facultyID" => $result[$i]['facultyID'],
                "programmeID" => $result[$i]['programmeID'],
                "facAcronym" => $result[$i]['facAcronym'],
                "programmeAcronym" => $result[$i]['programmeAcronym']
            );
        }
        echo json_encode($tempArray);
    }else{
        echo json_encode("No Data Found");
    }

    exit(0);

}elseif(isset($_GET['programme'])){
    $programme = $_GET['programme'];

    $sql = "SELECT P.programmeID, P.programmeName, F.facAcronym, F.facultyID
            FROM Programme P, Faculty F, Department D
            WHERE P.departmentID = D.departmentID AND
            F.facultyID = D.facultyID AND
            P.programmeName LIKE '%$programme%';";

    $result = $db->runQuery($sql);

    if(!empty($result)){
        for($i=0; $i < count($result); $i++){
            $tempArray[] = array(
                "programmeID" => $result[$i]['programmeID'], 
                "programmeName" => $result[$i]['programmeName'],
                "facAcronym" => $result[$i]['facAcronym'],
                "facultyID" => $result[$i]['facultyID']
            );
        }
        echo json_encode($tempArray);
    }else{
        echo json_encode("No Data Found");
    }
    
    exit(0);
}
?>