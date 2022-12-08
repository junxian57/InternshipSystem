<?php
$systemPathPrefix = $_SERVER['DOCUMENT_ROOT'].'/InternshipSystem/Client/';
require_once $systemPathPrefix.'includes/db_connection.php';

function getInternshipBatch(){
    $db = new DBController();
    $result = $db->runQuery("SELECT * FROM InternshipBatch");

    return $result;
}

function getStudentInfoOnly($studentID){
    $db = new DBController();

     $sql = "SELECT S.studentID, S.studName, S.studContactNumber,S.studEmail, S.internshipBatchID, P.programmeAcronym, S.tutorialGroupNo, I.studentYear, I.studentSemester, S.studentCVdocument
          FROM Student S, Programme P, InternshipBatch I
          WHERE S.internshipBatchID = I.internshipBatchID AND
          S.programmeID = P.programmeID AND
          S.studentID = '$studentID' AND
          (S.studAccountStatus LIKE 'Active' OR S.studAccountStatus LIKE 'Intern' OR S.studAccountStatus LIKE 'Graduated');";

    $result = $db->runQuery($sql);

    return $result;
}

function getStudentAndInternCompany($studentID){
    $db = new DBController();

    $sql = "SELECT S.studentID, S.studName, S.studContactNumber,S.studEmail, S.internshipBatchID, P.programmeAcronym, S.tutorialGroupNo, I.studentYear, I.studentSemester, S.studentCVdocument, C.cmpName, IAM.appInternStartDate, IAM.appInternEndDate, IJ.jobCmpSupervisor, IJ.jobSupervisorContactNo, IJ.jobSupervisorEmail 
          FROM Student S, Programme P, InternshipBatch I, Company C, InternJob IJ, InternApplicationMap IAM
          WHERE S.internshipBatchID = I.internshipBatchID AND
          S.programmeID = P.programmeID AND
          IAM.studentID = S.studentID AND
          IAM.internJobID = IJ.internJobID AND
          IJ.companyID = C.companyID AND
          S.studentID = '$studentID' AND
          (S.studAccountStatus LIKE 'Active' OR S.studAccountStatus LIKE 'Intern' OR S.studAccountStatus LIKE 'Graduated');";
    
    $result = $db->runQuery($sql);

    return $result;
}

?>