<?php
require '../../includes/db_connection.php';

$db = new DBController();

if (isset($_GET['documentID']) && isset($_GET['Document']) == 'Document') {
    //documentID
    $documentID = $_GET['documentID'];

    $result = false;

    $sql = "DELETE FROM Document WHERE documentID = '$documentID'";
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
