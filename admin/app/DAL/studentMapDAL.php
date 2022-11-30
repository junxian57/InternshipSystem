<?php
$systemPathPrefix = $_SERVER['DOCUMENT_ROOT'].'/internshipSystem/admin/';
require_once $systemPathPrefix.'includes/db_connection.php';

function getInternshipBatch(){
    $db = new DBController();
    $result = $db->runQuery("SELECT * FROM InternshipBatch");

    return $result;
}

function getFaculty(){
    $db = new DBController();
    $result = $db->runQuery("SELECT * FROM Faculty");

    return $result;
}

?>