<?php
require '../../includes/db_connection.php';

$db = new DBController();
$studentArr = array();

if(isset($_GET['batchNumber']) && isset($_GET['lecturerID'])){
    try{
        $batchNumber = $_GET['batchNumber'];
        $lecturerID = $_GET['lecturerID'];

        $sqlGetStudent = "SELECT S.studentID, S.tutorialGroupNo, S.studName, S.studEmail, I.studentYear, P.programmeAcronym, S.studAccountStatus
                        FROM Student S, Programme P, InternshipBatch I 
                        WHERE S.internshipBatchID = I.internshipBatchID AND
                        S.programmeID = P.programmeID AND
                        S.internshipBatchID = '$batchNumber' AND 
                        S.lecturerID = '$lecturerID' AND
                        (S.studAccountStatus = 'Active' OR S.studAccountStatus = 'Intern');";

        $result = $db->runQuery($sqlGetStudent);

        if(count($result) > 0 ){
            foreach($result as $student){
                $studentArr[] = array(
                    "studentID" => $student['studentID'],
                    "studName" => $student['studName'],
                    "tutorialGroupNo" => $student['tutorialGroupNo'],
                    "programmeAcronym" => $student['programmeAcronym'],
                    "studentYear" => $student['studentYear'],
                    "studEmail" => $student['studEmail'],
                    "studAccountStatus" => $student['studAccountStatus']
                );
            }

            echo json_encode($studentArr);
        }else{
            echo "No Data Found";
        }

        exit(0);

    }catch(PDOException $e){
        echo $e->getMessage();
    }
}
?>