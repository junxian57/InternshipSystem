<?php
$systemPathPrefix = $_SERVER['DOCUMENT_ROOT'].'/internshipSystem/admin/';
require_once $systemPathPrefix.'includes/db_connection.php';

function getCompany($companyID){
    $db = new DBController();
    $sql = "SELECT * FROM Company WHERE companyID = '$companyID'";

    $result = $db->runQuery($sql);
    return $result;
}

function getCompanyWithStatus($status){
    $db = new DBController();
    $arrayDestruct = "";
    
    for($i = 0; $i < count($status); $i++){
        $statusWord = $status[$i];
        if($i == count($status) - 1){
            $arrayDestruct .= "'$statusWord'";
        }else{
            $arrayDestruct .= "'$statusWord',";
        }
    }
    
    $sql = "SELECT * FROM Company WHERE cmpAccountStatus in ($arrayDestruct)";

    $result = $db->runQuery($sql);
    return $result;
}
?>