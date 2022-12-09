<?php
require '../../includes/db_connection.php';

$db = new DBController();

if (isset($_GET['messageID']) && isset($_GET['Message']) == 'Message') {
    //messageID
    $messageID = $_GET['messageID'];

    $result = false;

    $sql = "DELETE FROM Message1 WHERE messageID = '$messageID'";
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
