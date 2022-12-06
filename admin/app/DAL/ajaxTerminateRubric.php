<?php
require '../../includes/db_connection.php';

$db = new DBController();

if (isset($_GET['assessmentID']) && isset($_GET['rubricAssessment']) == 'rubricAssessment') {
    //assessmentID
    $assessmentID = $_GET['assessmentID'];

    $result = false;

    $sql = "UPDATE  RubricAssessment SET status = 'terminate' WHERE assessmentID = '$assessmentID'";
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
}else if (isset($_GET['RubricCriteriaID']) && isset($_GET['rubricCriteria']) == 'rubricCriteria') {
    //RubricCriteriaID
    $RubricCriteriaID = $_GET['RubricCriteriaID'];

    $result = false;

    $sql = "UPDATE  RubricComponentCriteria SET status = 'terminate' WHERE criterionID = '$RubricCriteriaID'";
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
