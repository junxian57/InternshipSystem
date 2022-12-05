<?php
require '../../includes/db_connection.php';

$tempArray = array();
$db = new DBController();

if (isset($_GET['companyID']) && isset($_GET['internshipBatchID'])) {
    $companyID = $_GET['companyID'];
    $internshipBatchID = $_GET['internshipBatchID'];

    $sql = "SELECT sr.studResultID ,s.studentID,s.studName,p.programmeName, ij.jobDescription ,sr.finalScore FROM Student s JOIN StudentResult sr ON s.studentID=sr.studentID JOIN Programme p on p.programmeID=s.programmeID JOIN InternApplicationMap iam on iam.studentID=s.studentID JOIN InternJob ij on ij.internJobID=iam.internJobID
    Where ij.companyID='$companyID' AND s.internshipBatchID = '$internshipBatchID' AND sr.RoleForMark = 'Company' AND iam.appStatus='Accepted' order by s.studentID ASC";

    $result = $db->runQuery($sql);

    if (!empty($result)) {
        foreach ($result as $row) {
            $tempArray[] = array(
                "studResultID" => $row['studResultID'],
                "studentID" => $row['studentID'],
                "studName" => $row['studName'],
                "programmeName" => $row['programmeName'],
                "jobDescription"=> $row['jobDescription'],
                "finalScore" => $row['finalScore']
            );
        }
        echo json_encode($tempArray);
    } else {
        echo json_encode("No Data Found");
    }

    exit();
}
