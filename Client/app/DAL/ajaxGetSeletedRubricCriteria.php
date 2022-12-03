<?php
include_once("../../includes/db_connection.php");
if (isset($_GET['assessmentID'])) {
    $assessmentID = $_GET['assessmentID'];
    $db_handle1 = new DBController();

    $query = "SELECT rcc.criterionID,rcc.Title ,rcc.CriteriaSession,rac.TotalWeight ,GROUP_CONCAT(rc.componentID ORDER BY rc.componentID)as componentID,
    GROUP_CONCAT(rc.valueName ORDER BY rc.componentID)as valueName,GROUP_CONCAT(rc.score ORDER BY rc.componentID) as score,
    GROUP_CONCAT(rc.description ORDER BY rc.componentID) as description 
    FROM RubricAssessmentCriteria rac JOIN RubricComponentCriteria rcc on rac.criterionID=rcc.criterionID JOIN RubricComponent rc on rac.criterionID = rc.criterionID 
    where rac.assessmentID = '$assessmentID' group by rc.criterionID ASC;";
    $results = $db_handle1->runQuery($query);
    $array = array();
    if (!empty($results)) {
        for ($i = 0; $i < count($results); $i++) {
            $criterionID = $results[$i]['criterionID'];
            $Title = $results[$i]['Title'];
            $CriteriaSession = $results[$i]['CriteriaSession'];
            $TotalWeight = $results[$i]['TotalWeight'];
            $componentID = $results[$i]['componentID'];
            $valueName = $results[$i]['valueName'];
            $score = $results[$i]['score'];
            $description = $results[$i]['description'];
            $array[] = array(
                'criterionID' => $criterionID,
                'Title' => $Title,
                'CriteriaSession' => $CriteriaSession,
                'TotalWeight' => $TotalWeight,
                'componentID' => $componentID,
                'valueName' => $valueName,
                'score' => $score,
                'description' => $description
            );
        }
        echo json_encode($array);
    } else {
        echo json_encode("No Data Found");
    }

    exit(0);
}
?>