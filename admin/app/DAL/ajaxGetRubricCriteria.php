<?php
include_once("../../includes/db_connection.php");
if (isset($_GET['RoleForMark'])) {
    $RoleForMark = $_GET['RoleForMark'];
    $db_handle1 = new DBController();
    //$query = "SELECT * FROM RubricComponentCriteria WHERE RoleForMark = '$RoleForMark'";
    $query = "SELECT rcc.CriteriaSession,rc.criterionID,rcc.Title,rc.score,rcc.description from RubricComponentCriteria rcc left JOIN RubricComponent rc on rcc.criterionID=rc.criterionID WHERE 
    rc.valueName='Excellent' AND rcc.RoleForMark= '$RoleForMark'";
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
}
