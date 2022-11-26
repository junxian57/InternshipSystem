<?php
require '../../includes/db_connection.php';

$db = new DBController();

if (isset($_GET['assessmentID']) && isset($_GET['criterionID'])) {
    //assessmentID
    $assessmentID = $_GET['assessmentID'];
    //criterionID
    $criterionID = $_GET['criterionID'];

    $title = $_GET['title'];
    $score = $_GET['score'];

    $result = false;

    $sql = "INSERT INTO RubricAssessmentCriteria (`assessmentID`,`criterionID`,`Title`,`TotalWeight`)
    VALUES (
      '" . $assessmentID . "',
      '" . $criterionID . "',
      '" . $title . "',
      '" . $score . "'
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
