<?php
require_once '../../includes/db_connection.php';

$db = new DBController();

if(isset($_GET['companyID'])){
    $companyID = $_GET['companyID'];

    $sqlCheckCmpDownSize = "SELECT SUM(ij.jobMaxNumberQuota) AS totalMaxQuota
                                    FROM InternJob ij, Company c
                                    WHERE ij.companyID = c.companyID AND
                                    ij.jobStatus <> 'Deleted' AND
                                    c.companyID = '$companyID';";

    $resultCheckCmpDownSize = $db->runQuery($sqlCheckCmpDownSize);

    if(count($resultCheckCmpDownSize) > 0){
        echo json_encode($resultCheckCmpDownSize);
    }else{
        echo json_encode("Failed");
    }

    exit(0);
}
?>