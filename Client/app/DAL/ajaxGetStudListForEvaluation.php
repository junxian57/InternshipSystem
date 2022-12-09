<?php
require '../../includes/db_connection.php';

$tempArray = array();
$db = new DBController();

if (isset($_GET['companyID']) && isset($_GET['internshipBatchID'])) {
    $companyID = $_GET['companyID'];
    $internshipBatchID = $_GET['internshipBatchID'];

    $sql = "SELECT sr.studResultID ,s.studentID,s.studName,p.programmeName,d.facultyID,ij.internJobID,ij.jobTitle, ij.jobDescription ,sr.finalScore , ra.TotalWeight
    FROM Student s JOIN StudentResult sr ON s.studentID=sr.studentID JOIN Programme p on p.programmeID=s.programmeID JOIN Department d on p.departmentID=d.departmentID
    JOIN InternApplicationMap iam on iam.studentID=s.studentID JOIN InternJob ij on ij.internJobID=iam.internJobID JOIN RubricAssessment ra on sr.assessmentID = ra.assessmentID 
    Where ij.companyID='$companyID' AND s.internshipBatchID = '$internshipBatchID' AND sr.RoleForMark = 'Company' AND iam.appStatus='Accepted' order by s.studentID ASC";
    $result = $db->runQuery($sql);

    if (!empty($result)) {
        foreach ($result as $row) {
            $tempArray[] = array(
                "studResultID" => $row['studResultID'],
                "studentID" => $row['studentID'],
                "studName" => $row['studName'],
                "facultyID" => $row['facultyID'],
                "programmeName" => $row['programmeName'],
                "internJobID" => $row['internJobID'],
                "jobTitle" => $row['jobTitle'],
                "jobDescription" => $row['jobDescription'],
                "finalScore" => $row['finalScore'],
                "TotalWeight" => $row['TotalWeight']
            );
        }
        echo json_encode($tempArray);
    } else {
        echo json_encode("No Data Found");
    }

    exit();
}else if (isset($_GET['lectureID']) && isset($_GET['internshipBatchID'])) {
    $lectureID = $_GET['lectureID'];
    $internshipBatchID = $_GET['internshipBatchID'];

    $sql = "SELECT sr.studResultID ,s.studentID,s.studName,p.programmeName,d.facultyID,c.cmpName, ij.jobTitle,sr.finalScore , ra.TotalWeight
    FROM Student s JOIN StudentResult sr ON s.studentID=sr.studentID JOIN Programme p on p.programmeID=s.programmeID JOIN Department d on p.departmentID=d.departmentID
    JOIN InternApplicationMap iam on iam.studentID=s.studentID JOIN InternJob ij on ij.internJobID = iam.internJobID JOIN Company c on c.companyID=ij.companyID JOIN RubricAssessment ra on ra.assessmentID = sr.assessmentID
    Where s.lecturerID='$lectureID' AND s.internshipBatchID = '$internshipBatchID' AND sr.RoleForMark = 'Supervisor' AND iam.appStatus='Accepted' order by s.studentID ASC;";

    $result = $db->runQuery($sql);

    if (!empty($result)) {
        foreach ($result as $row) {
            $tempArray[] = array(
                "studResultID" => $row['studResultID'],
                "studentID" => $row['studentID'],
                "studName" => $row['studName'],
                "facultyID" => $row['facultyID'],
                "programmeName" => $row['programmeName'],
                "cmpName" => $row['cmpName'],
                "jobTitle" => $row['jobTitle'],
                "finalScore" => $row['finalScore'],
                "TotalWeight" => $row['TotalWeight']
            );
        }
        echo json_encode($tempArray);
    } else {
        echo json_encode("No Data Found");
    }

    exit();
}
