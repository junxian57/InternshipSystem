<?php
include_once("../../includes/db_connection.php");
if (isset($_GET['RoleForMark'])) {
    $RoleForMark = $_GET['RoleForMark'];
    $db_handle1 = new DBController();
    //$query = "SELECT * FROM RubricComponentCriteria WHERE RoleForMark = '$RoleForMark'";
    $query = "SELECT * from RubricComponentCriteria rcc left JOIN RubricComponent rc on rcc.criterionID=rc.criterionID WHERE 
    rc.valueName='Excellent' AND rcc.RoleForMark= '$RoleForMark' ORDER BY rcc.Title ASC";
    $results = $db_handle1->runQuery($query);
    $array = array();

    if (!empty($results)) {
        for ($i = 0; $i < count($results); $i++) {
            $componentID = $results[$i]['componentID'];
            $Title = $results[$i]['Title'];
            $CriteriaSession = $results[$i]['CriteriaSession'];
            $description = $results[$i]['description'];
            $score = $results[$i]['score'];
            $array[] = array(
                'componentID' => $componentID,
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
} else if (isset($_GET['assessmentID'])) {
    $assessmentID = $_GET['assessmentID'];
    $db_handle1 = new DBController();

    $query = "SELECT * FROM RubricAssessmentCriteria rac INNER JOIN RubricComponent rc ON rac.criterionID=rc.componentID INNER JOIN RubricAssessment ra on rac.assessmentID=ra.assessmentID 
    INNER JOIN RubricComponentCriteria rcc on rcc.criterionID=rc.criterionID WHERE rac.assessmentID ='$assessmentID' ORDER BY rac.Title ASC;";
    $results = $db_handle1->runQuery($query);
    $array = array();

    if (!empty($results)) {
        for ($i = 0; $i < count($results); $i++) {
            $componentID = $results[$i]['componentID'];
            $Title = $results[$i]['Title'];
            $CriteriaSession = $results[$i]['CriteriaSession'];
            $score = $results[$i]['score'];
            $array[] = array(
                'componentID' => $componentID,
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
