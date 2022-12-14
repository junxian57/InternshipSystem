<?php
include_once("../../includes/db_connection.php");
if (isset($_GET['internshipBatchID']) && isset($_GET['internAppID'])) {
    $internshipBatchID = $_GET['internshipBatchID'];
    $internAppID = $_GET['internAppID'];
    $db_handle1 = new DBController();
    //add faculty ID
    $query = "SELECT * from RubricComponentCriteria rcc 
    left JOIN RubricComponent rc on rcc.criterionID=rc.criterionID 
    WHERE rc.valueName='Excellent' AND rcc.RoleForMark= '$RoleForMark' AND rcc.facultyID='$facultyID' AND rcc.status = 'activate'ORDER BY rcc.criterionID ASC";
    $results = $db_handle1->runQuery($query);
    $array = array();

    if (!empty($results)) {
        for ($i = 0; $i < count($results); $i++) {
            $criterionID = $results[$i]['criterionID'];
            $Title = $results[$i]['Title'];
            $CriteriaSession = $results[$i]['CriteriaSession'];
            $description = $results[$i]['description'];
            $score = $results[$i]['score'];
            $array[] = array(
                'criterionID' => $criterionID,
                'Title' => $Title,
                'CriteriaSession' => $CriteriaSession,
                'description' => $description,
                'score' => $score
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
