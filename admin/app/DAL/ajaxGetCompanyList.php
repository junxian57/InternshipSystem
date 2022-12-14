<?php
include_once("../../includes/db_connection.php");
if (isset($_GET['getCompany']) == "Yes") {
    $db_handle1 = new DBController();
    //add faculty ID
    $query = "SELECT DISTINCT(cmp.companyID), cmp.cmpName, cmp.cmpContactPerson,cmp.cmpCompanySize ,cmp.cmpAddress
    FROM Company cmp, InternJob ij
    WHERE cmp.companyID=ij.companyID
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

    $query = "SELECT * FROM RubricAssessmentCriteria rac INNER JOIN RubricComponent rc ON rac.criterionID=rc.criterionID INNER JOIN RubricAssessment ra on rac.assessmentID=ra.assessmentID 
    INNER JOIN RubricComponentCriteria rcc on rcc.criterionID=rc.criterionID WHERE rac.assessmentID ='$assessmentID' AND rc.valueName='Excellent' ORDER BY rac.criterionID ASC;";
    $results = $db_handle1->runQuery($query);
    $array = array();

    if (!empty($results)) {
        for ($i = 0; $i < count($results); $i++) {
            $criterionID = $results[$i]['criterionID'];
            $Title = $results[$i]['Title'];
            $CriteriaSession = $results[$i]['CriteriaSession'];
            $score = $results[$i]['score'];
            $array[] = array(
                'criterionID' => $criterionID,
                'Title' => $Title,
                'CriteriaSession' => $CriteriaSession,
                'score' => $score
            );
        }
        echo json_encode($array);
    } else {
        echo json_encode("No Data Found");
    }

    exit(0);
}
