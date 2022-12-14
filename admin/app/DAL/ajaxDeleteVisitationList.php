<?php
require '../../includes/db_connection.php';

$db = new DBController();

if (isset($_GET['Visitation_ID'])) {
    //assessmentID
    $Visitation_ID = $_GET['Visitation_ID'];

    $result = false;

    $sql = "UPDATE VisitationCompany SET status = 'terminate' WHERE Visitation_CompanyID = '$Visitation_ID'";
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
