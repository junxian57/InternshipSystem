<?php
require '../../includes/db_connection.php';

$db = new DBController();

if (isset($_GET['Visitation_CompanyID'])) {
    //Visitation_CompanyID
    $Visitation_CompanyID = $_GET['Visitation_CompanyID'];
    //cmpID
    $cmpID = $_GET['cmpID'];

    $cmpName = $_GET['cmpName'];

    $result = false;

    $sql = "INSERT INTO VisitationCompanyList (`Visitation_CompanyID`,`CompanyID`,`cmpName`)
    VALUES (
      '" . $Visitation_CompanyID . "',
      '" . $cmpID . "',
      '" . $cmpName . "'
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
