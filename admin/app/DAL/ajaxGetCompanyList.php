<?php
include_once("../../includes/db_connection.php");
if (isset($_GET['getCompany']) == "Yes") {
    $db_handle1 = new DBController();
    //add faculty ID
    $query = "SELECT DISTINCT(cmp.companyID), cmp.cmpName, cmp.cmpContactPerson,cmp.cmpCompanySize ,cmp.cmpAddress
    FROM Company cmp, InternJob ij,InternApplicationMap iam
    WHERE cmp.companyID=ij.companyID AND ij.internjobID=iam.internjobID AND iam.appStatus='Accepted'
    order BY cmp.companyID";
    $results = $db_handle1->runQuery($query);
    $array = array();

    if (!empty($results)) {
        for ($i = 0; $i < count($results); $i++) {
            $companyID = $results[$i]['companyID'];
            $cmpName = $results[$i]['cmpName'];
            $cmpContactPerson = $results[$i]['cmpContactPerson'];
            $cmpCompanySize = $results[$i]['cmpCompanySize'];
            $cmpAddress = $results[$i]['cmpAddress'];
            $array[] = array(
                'companyID' => $companyID,
                'cmpName' => $cmpName,
                'cmpContactPerson' => $cmpContactPerson,
                'cmpCompanySize' => $cmpCompanySize,
                'cmpAddress' => $cmpAddress
            );
        }
        echo json_encode($array);
    } else {
        echo json_encode("No Data Found");
    }

    exit(0);
} else if (isset($_GET['Visitation_CompanyID'])) {
    $Visitation_CompanyID = $_GET['Visitation_CompanyID'];
    $db_handle1 = new DBController();

    $query = "SELECT c.cmpName,c.cmpState,c.cmpAddress,c.cmpContactNumber,c.cmpContactPerson FROM VisitationCompany vc JOIN VisitationCompanyList vcl on vc.Visitation_CompanyID=vcl.Visitation_CompanyID JOIN Company c ON vcl.CompanyID=c.companyID
    WHERE vc.Visitation_CompanyID='$Visitation_CompanyID'
    ORDER BY vcl.CompanyID";
    $results = $db_handle1->runQuery($query);
    $array = array();

    if (!empty($results)) {
        for ($i = 0; $i < count($results); $i++) {
            $cmpName = $results[$i]['cmpName'];
            $cmpState = $results[$i]['cmpState'];
            $cmpAddress = $results[$i]['cmpAddress'];
            $cmpContactNumber = $results[$i]['cmpContactNumber'];
            $cmpContactPerson = $results[$i]['cmpContactPerson'];
            $array[] = array(
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
