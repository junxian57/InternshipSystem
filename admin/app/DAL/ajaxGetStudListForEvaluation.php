<?php
require '../../includes/db_connection.php';

$tempArray = array();
$db = new DBController();

if (isset($_GET['lectureID']) && isset($_GET['internshipBatchID'])) {
    $lectureID = $_GET['lectureID'];
    $internshipBatchID = $_GET['internshipBatchID'];

    $sql = "SELECT sr.studResultID ,s.studentID,s.studName,p.programmeName,sr.finalScore FROM Student s JOIN StudentResult sr ON s.studentID=sr.studentID JOIN Programme p on p.programmeID=s.programmeID
    Where s.lecturerID='$lectureID' AND s.internshipBatchID = '$internshipBatchID' AND sr.RoleForMark = 'Supervisor' order by s.studentID ASC;";

    $result = $db->runQuery($sql);

    if (!empty($result)) {
        foreach ($result as $row) {
            $tempArray[] = array(
                "studResultID" => $row['studResultID'],
                "studentID" => $row['studentID'],
                "studName" => $row['studName'],
                "programmeName" => $row['programmeName'],
                "finalScore" => $row['finalScore']
            );
        }
        echo json_encode($tempArray);
    } else {
        echo json_encode("No Data Found");
    }

    exit();
}
