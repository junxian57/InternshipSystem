<?php
include_once("../../includes/db_connection.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $db_handle1 = new DBController();

    $query = "SELECT DISTINCT(L.lecturerID),L.lecName,L.lecGender,L.lecEmail,L.lecJobPosition 
    FROM Lecturer L JOIN Student S on S.lecturerID=L.lecturerID 
    JOIN VisitationCompany VC on VC.internshipBatchID=S.internshipBatchID 
    JOIN VisitationApplicationMapList VAM on L.lecturerID=VAM.lecturerID
    WHERE S.internshipBatchID= VC.internshipBatchID AND
    VAM.Visitation_AppMapID='$id'
    ORDER BY L.lecturerID";
    $results = $db_handle1->runQuery($query);
    $array = array();

    if (!empty($results)) {
        for ($i = 0; $i < count($results); $i++) {
            $lecturerID = $results[$i]['lecturerID'];
            $lecName = $results[$i]['lecName'];
            $lecGender = $results[$i]['lecGender'];
            $lecEmail = $results[$i]['lecEmail'];
            $lecJobPosition = $results[$i]['lecJobPosition'];
            $array[] = array(
                'lecturerID' => $lecturerID,
                'lecName' => $lecName,
                'lecGender' => $lecGender,
                'lecEmail' => $lecEmail,
                'lecJobPosition' => $lecJobPosition,
            );
        }
        echo json_encode($array);
    } else {
        echo json_encode("No Data Found");
    }

    exit(0);
}