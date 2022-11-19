<?php
require '../../includes/db_connection.php';

$tempArray = array();
$db = new DBController();

if(isset($_GET['facultyID']) && isset($_GET['internNo'])){
    //Tab 1 - Tutorial Group
    $facultyID = $_GET['facultyID'];
    $internNo = $_GET['internNo'];

    $sql = "SELECT COUNT(S.studentID) AS noSelectStudent, S.tutorialGroupNo, IB.studentYear, IB.studentSemester, A.studentCount, P.programmeAcronym, P.programmeID
            FROM InternshipBatch IB 
            LEFT JOIN Student S ON S.internshipBatchID = IB.internshipBatchID
            LEFT JOIN Programme P ON S.programmeID = P.programmeID
            LEFT JOIN Department D ON P.departmentID = D.departmentID
            LEFT JOIN Faculty F ON D.facultyID = F.facultyID
            LEFT JOIN (SELECT COUNT(S.studentID) AS studentCount, S.internshipBatchID, S.tutorialGroupNo, S.programmeID, P.programmeAcronym
            FROM InternshipBatch IB, Student S, Department D, Programme P, Faculty F
            WHERE S.internshipBatchID = IB.internshipBatchID AND
            S.programmeID = P.programmeID AND
            P.departmentID = D.departmentID AND
            D.facultyID = F.facultyID AND
            S.internshipBatchID LIKE '$internNo' AND
            F.facultyID LIKE '$facultyID'
            GROUP BY P.programmeAcronym, S.tutorialGroupNo) AS A ON IB.internshipBatchID = A.internshipBatchID AND A.tutorialGroupNo = S.tutorialGroupNo AND P.programmeAcronym = A.programmeAcronym
            WHERE S.internshipBatchID LIKE '$internNo' AND 
            S.lecturerID IS NULL AND
            F.facultyID LIKE '$facultyID'
            GROUP BY P.programmeAcronym, S.tutorialGroupNo
            HAVING noSelectStudent > 0";

    $result = $db->runQuery($sql);

    if(!empty($result)){
        for($i=0; $i < count($result); $i++){
            $tempArray[] = array(
                "programmeAcronym" => $result[$i]['programmeAcronym'], 
                "tutorialGroupNo" => $result[$i]['tutorialGroupNo'],
                "studentYear" => $result[$i]['studentYear'],
                "studentSemester" => $result[$i]['studentSemester'],
                "studentCount" => $result[$i]['studentCount'],
                "noSelectStudent" => $result[$i]['noSelectStudent'],
                "programmeID" => $result[$i]['programmeID']
            );
        }
        echo json_encode($tempArray);
    }else{
        echo json_encode("No Data Found");
    }

    exit(0);

}elseif(isset($_GET['facultyID']) && isset($_GET['tab2'])){
    //Tab 2 - Supervisor
    $facultyID = $_GET['facultyID'];

    $sql = "SELECT F.facAcronym, L.lecName, L.lecturerID, L.currNoOfStudents, L.maxNoOfStudents
            FROM Department D, Lecturer L, Faculty F
            WHERE L.departmentID = D.departmentID AND
            D.facultyID = F.facultyID AND
            F.facultyID = '$facultyID' AND
            L.currNoOfStudents < L.maxNoOfStudents AND
            L.supervisorQualification = 1";

    $result = $db->runQuery($sql);

    if(!empty($result)){
        for($i=0; $i < count($result); $i++){
            $tempArray[] = array(
                "facAcronym" => $result[$i]['facAcronym'], 
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

    exit(0);

}elseif(isset($_GET['facultyID']) && isset($_GET['tab3-supervisor'])){
    //Tab 3 - Supervisor
    $facultyID = $_GET['facultyID'];

    $sql = "SELECT F.facAcronym, L.lecName, L.lecturerID, L.currNoOfStudents, L.maxNoOfStudents
            FROM Department D, Lecturer L, Faculty F
            WHERE L.departmentID = D.departmentID AND
            D.facultyID = F.facultyID AND
            F.facultyID = '$facultyID' AND
            L.currNoOfStudents < L.maxNoOfStudents AND
            L.supervisorQualification = 1";

    $result = $db->runQuery($sql);

    if(!empty($result)){
        for($i=0; $i < count($result); $i++){
            $tempArray[] = array(
                "facAcronym" => $result[$i]['facAcronym'], 
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

    exit(0);

}elseif(isset($_GET['programmeID']) && isset($_GET['batchID']) && isset($_GET['tab3-student'])){
    //Tab 3 - Student
    $programmeID = $_GET['programmeID'];
    $batchID = $_GET['batchID'];

    $sql = "SELECT COUNT(S.studentID) AS noSelectStudent, S.tutorialGroupNo, IB.studentYear, A.studentCount, P.programmeAcronym, P.programmeID
            FROM InternshipBatch IB 
            LEFT JOIN Student S ON S.internshipBatchID = IB.internshipBatchID
            LEFT JOIN Programme P ON S.programmeID = P.programmeID
            LEFT JOIN (SELECT COUNT(S.studentID) AS studentCount, S.internshipBatchID, S.tutorialGroupNo
            FROM InternshipBatch IB, Student S
            WHERE S.internshipBatchID = IB.internshipBatchID AND
            S.programmeID LIKE '$programmeID' AND
            S.internshipBatchID LIKE '$batchID'
            GROUP BY S.tutorialGroupNo) AS A ON IB.internshipBatchID = A.internshipBatchID AND A.tutorialGroupNo = S.tutorialGroupNo
            WHERE S.programmeID LIKE '$programmeID' AND 
            S.lecturerID IS NULL AND
            S.internshipBatchID LIKE '$batchID'
            GROUP BY S.tutorialGroupNo
            HAVING noSelectStudent > 0;";

    $result = $db->runQuery($sql);

    if(!empty($result)){
        for($i=0; $i < count($result); $i++){
            $tempArray[] = array(
                "noSelectStudent" => $result[$i]['noSelectStudent'], 
                "tutorialGroupNo" => $result[$i]['tutorialGroupNo'],
                "studentYear" => $result[$i]['studentYear'],
                "studentCount" => $result[$i]['studentCount'],
                "programmeAcronym" => $result[$i]['programmeAcronym'],
                "programmeID" => $result[$i]['programmeID']
            );
        }
        echo json_encode($tempArray);
    }else{
        echo json_encode("No Data Found");
    }

    exit(0);
}
?>