<?php
include_once("../../includes/db_connection.php");
if (isset($_GET['lecturerID'])) {
    $Visitation_CompanyID = $_GET['lecturerID'];
    $db_handle1 = new DBController();

    $query = "SELECT c.companyID,c.cmpName,c.cmpState,c.cmpAddress,c.cmpContactNumber,c.cmpContactPerson FROM VisitationCompany vc JOIN VisitationCompanyList vcl on vc.Visitation_CompanyID=vcl.Visitation_CompanyID JOIN Company c ON vcl.CompanyID=c.companyID
    WHERE vc.Visitation_CompanyID='$Visitation_CompanyID'
    ORDER BY c.CompanyID";
    $results = $db_handle1->runQuery($query);
    $array = array();

    if (!empty($results)) {
        for ($i = 0; $i < count($results); $i++) {
            $companyID = $results[$i]['companyID'];
            $cmpName = $results[$i]['cmpName'];
            $cmpState = $results[$i]['cmpState'];
            $cmpAddress = $results[$i]['cmpAddress'];
            $cmpContactNumber = $results[$i]['cmpContactNumber'];
            $cmpContactPerson = $results[$i]['cmpContactPerson'];
            $array[] = array(
                'companyID' => $companyID,
                'cmpName' => $cmpName,
                'cmpState' => $cmpState,
                'cmpAddress' => $cmpAddress,
                'cmpContactNumber' => $cmpContactNumber,
                'cmpContactPerson' => $cmpContactPerson
            );
        }
        echo json_encode($array);
    } else {
        echo json_encode("No Data Found");
    }

    exit(0);
}
