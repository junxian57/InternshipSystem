<?php
require '../../includes/db_connection.php';

$db = new DBController();

if (isset($_GET['Visitation_AppMapID'])) {
    //Visitation_AppMapID
    $Visitation_AppMapID = $_GET['Visitation_AppMapID'];
    //lecturerID
    $lecturerID = $_GET['lecturerID'];

    $lecName = trim($_GET['lecName']);

    $lecEmail = trim($_GET['lecEmail']);

    $result = false;

    $sql = "INSERT INTO VisitationApplicationMapList (`Visitation_AppMapID`,`lecturerID`,`lecName`,`lecEmail`)
    VALUES (
      '" . $Visitation_AppMapID . "',
      '" . $lecturerID . "',
      '" . $lecName . "',
      '" . $lecEmail . "'
    )";
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
