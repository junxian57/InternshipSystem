<?php
require '../../includes/db_connection.php';

$db = new DBController();

if (isset($_GET['Visitation_AppMapID'])) {
    //assessmentID
    $Visitation_AppMapID = $_GET['Visitation_AppMapID'];

    $result = false;

    $sql = "UPDATE VisitationApplicationMap SET status = 'terminate' WHERE Visitation_AppMapID = '$Visitation_AppMapID'";
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
        echo json_encode($sql);
        exit(0);
    }
}