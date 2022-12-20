<?php
require '../../includes/db_connection.php';

$db = new DBController();

if (isset($_GET['Visitation_CompanyID']) && isset($_GET['cmpID'])) {
    //assessmentID
    $Visitation_CompanyID = $_GET['Visitation_CompanyID'];
    //criterionID
    $cmpID = $_GET['cmpID'];


    $result = false;

    $sql = "DELETE FROM VisitationCompanyList WHERE Visitation_CompanyID = '$Visitation_CompanyID' AND CompanyID  = '$cmpID'";
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
