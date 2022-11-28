<?php
require '../../includes/db_connection.php';

$db = new DBController();

if (isset($_GET['assessmentID']) && isset($_GET['criterionID'])) {
    //assessmentID
    $assessmentID = $_GET['assessmentID'];
    //criterionID
    $criterionID = $_GET['criterionID'];


    $result = false;

    $sql = "DELETE FROM RubricAssessmentCriteria WHERE assessmentID = '$assessmentID' AND criterionID  = '$criterionID'";
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
} else if (isset($_GET['assessmentID']) && isset($_GET['reset'])) {
    $assessmentID = $_GET['assessmentID'];
    $result = false;

    $sql = "DELETE FROM RubricAssessmentCriteria WHERE assessmentID = '$assessmentID'";
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
