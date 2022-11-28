<?php
require_once '../../includes/db_connection.php';

$db = new DBController();

if(isset($_GET['internJobID']) && isset($_GET['delete']) && isset($_GET['companyID']) && $_GET['delete'] == 1){
    
    $internJobID = $_GET['internJobID'];
    $companyID = $_GET['companyID'];

    $sqlCheckInternshipMapIsNon = "SELECT * FROM InternApplicationMap WHERE internJobID = '$internJobID'";
    $resultCheckInternshipMapIsNon = $db->runQuery($sqlCheckInternshipMapIsNon);

    if($resultCheckInternshipMapIsNon == null){
        $sqlDeleteInternJob = "UPDATE SET jobStatus = 'Deleted' WHERE internJobID = '$internJobID' AND companyID = '$companyID'";
    
        $result = $db->executeQuery($sqlDeleteInternJob);
    
        if($result){
            echo json_encode("Success");
        }else{
            echo json_encode("Failed");
        }  
    }else{
        echo json_encode("InternshipMapIsNotEmpty");
    }

    exit(0);
}
?>