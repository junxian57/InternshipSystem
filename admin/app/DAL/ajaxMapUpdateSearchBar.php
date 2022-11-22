<?php

require '../../includes/db_connection.php';

$tempArray = array();
$db = new DBController();

if(isset($_GET['faculty']) && isset($_GET['supervisor']) && isset($_GET['tab1'])){
    //Tab 1 Search Supervisor Result Box
    $supervisor = $_GET['supervisor'];
    $faculty = $_GET['faculty'];

    $sql = "SELECT L.lecName, F.facultyID, L.lecturerID, L.maxNoOfStudents, L.currNoOfStudents
            FROM Lecturer L, Faculty F, Department D
            WHERE
            L.departmentID = D.departmentID AND
            D.facultyID = F.facultyID AND
            (L.lecName LIKE '%$supervisor%' OR L.lecturerID LIKE '%$supervisor%') AND 
            F.facultyID = '$faculty' AND
            L.currNoOfStudents > 0 AND    
            L.supervisorQualification = 1;";

    $result = $db->runQuery($sql);

    if(!empty($result)){
        for($i=0; $i < count($result); $i++){
            $tempArray[] = array( 
                "facultyID" => $result[$i]['facultyID'],
                "lecName" => $result[$i]['lecName'],
                "lecturerID" => $result[$i]['lecturerID'],
                "maxNoOfStudents" => $result[$i]['maxNoOfStudents'],
                "currNoOfStudents" => $result[$i]['currNoOfStudents']
            );
        }
        echo json_encode($tempArray);
    }else{
        echo json_encode("No Data Found");
    }
 
    exit();
    
}elseif(isset($_GET['facultyID']) && isset($_GET['lecturerID']) && isset($_GET['selection'])){
    //Tab 1 New Supervisor Selection
    $facultyID = $_GET['facultyID'];
    $lecturerID = $_GET['lecturerID'];

    $sql = "SELECT L.lecName, L.lecturerID, L.currNoOfStudents, L.maxNoOfStudents
            FROM Lecturer L, Faculty F, Department D
            WHERE L.departmentID = D.departmentID AND
            D.facultyID = F.facultyID AND
            L.supervisorQualification = 1 AND
            F.facultyID LIKE '$facultyID' AND
            L.currNoOfStudents < L.maxNoOfStudents AND
            L.lecturerID NOT LIKE '$lecturerID'
            ORDER BY L.lecName ASC;";

    $result = $db->runQuery($sql);

    if(!empty($result)){
        for($i=0; $i < count($result); $i++){
            $tempArray[] = array( 
                "lecName" => $result[$i]['lecName'],
                "lecturerID" => $result[$i]['lecturerID'],
                "currNoOfStudents" => $result[$i]['currNoOfStudents'],
                "maxNoOfStudents" => $result[$i]['maxNoOfStudents']
            );
        }
        echo json_encode($tempArray);
    }else{
        echo json_encode("No Data Found");
    }
    
    exit();
    
}elseif(isset($_GET['faculty']) && isset($_GET['supervisor']) && isset($_GET['tab2'])){
    //Tab 2 Search Supervisor Result Box
    $facultyID = $_GET['faculty'];
    $supervisor = $_GET['supervisor'];

    $sql = "SELECT L.lecName, F.facultyID, L.lecturerID
            FROM Lecturer L, Faculty F, Department D
            WHERE L.departmentID = D.departmentID AND
            D.facultyID = F.facultyID AND
            (L.lecName LIKE '%$supervisor%' OR L.lecturerID LIKE '%$supervisor%') AND 
            F.facultyID LIKE '$facultyID' AND
            L.supervisorQualification = 1 AND
            L.currNoOfStudents > 0
            ORDER BY L.lecName ASC;";

    $result = $db->runQuery($sql);

    if(!empty($result)){
        for($i=0; $i < count($result); $i++){
            $tempArray[] = array( 
                "facultyID" => $result[$i]['facultyID'],
                "lecName" => $result[$i]['lecName'],
                "lecturerID" => $result[$i]['lecturerID']
            );
        }
        echo json_encode($tempArray);
    }else{
        echo json_encode("No Data Found");
    }
 
    exit();

}
?>