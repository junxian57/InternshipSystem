<?php
require '../../includes/db_connection.php';

$tempArray = array();
$db = new DBController();

if(isset($_GET['lectureID']) && isset($_GET['studentIDArr'])){
    $lectureID = $_GET['lectureID'];
    $studentIDArr = $_GET['studentIDArr'];

    //remove [] in $studentIDArr
    $studentIDArr = str_replace("[", "", $studentIDArr);
    $studentIDArr = str_replace("]", "", $studentIDArr);

    $sql = "UPDATE Student SET lecturerID = '$lectureID' WHERE studentID IN ($studentIDArr);";

    $result = $db->executeQuery($sql);

    if($result){
        echo json_encode("Success");
    }else{
        echo json_encode("Failed");
    }

    exit();
}
