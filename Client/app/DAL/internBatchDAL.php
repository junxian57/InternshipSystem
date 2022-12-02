<?php
include_once("../../includes/db_connection.php");
if (isset($_GET['internshipBatchID'])) {
    $internshipBatchID = $_GET['internshipBatchID'];
    $db_handle1 = new DBController();
    $query = "SELECT * FROM InternshipBatch WHERE internshipBatchID = '$internshipBatchID'";
    $results = $db_handle1->runQuery($query);
    $array = array();

    if (!empty($results)) {
        for ($i = 0; $i < count($results); $i++) {
            $officialEndDate = $results[$i]['officialEndDate'];
            $earliestStartDate = $results[$i]['earliestStartDate'];
            $latestEndDate = $results[$i]['latestEndDate'];
            $array[] = array(
                'officialEndDate' => $officialEndDate,
                'earliestStartDate' => $earliestStartDate,
                'latestEndDate' => $latestEndDate
            );
        }
    }
    echo json_encode($array);
    exit();
}
?>