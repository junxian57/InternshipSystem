<?php
require '../../includes/db_connection.php';

$db = new DBController();

if (isset($_GET['Visitation_AppMapID']) && isset($_GET['lecturerID'])) {
    //assessmentID
    $Visitation_AppMapID = $_GET['Visitation_AppMapID'];
    //criterionID
    $lecturerID = $_GET['lecturerID'];


    $result = false;

    $sql = "DELETE FROM VisitationApplicationMapList WHERE Visitation_AppMapID = '$Visitation_AppMapID' AND lecturerID  = '$lecturerID'";
    try {
        $result = $db->executeQuery($sql);
    } catch (Exception $e) {
        echo json_encode($e);
        exit(0);
    }

    if ($result) {
        echo json_encode("Success");
        exit(0);
    } else {
        echo json_encode("Failed");
        exit(0);
    }
}
