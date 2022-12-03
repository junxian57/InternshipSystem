<?php
$systemPathPrefix = $_SERVER['DOCUMENT_ROOT'].'/internshipSystem/client/';

require_once $systemPathPrefix.'app/DTO/internJobDTO.php';
require_once $systemPathPrefix.'includes/db_connection.php';

function getLastInternJobID(){
    $db = new DBController();
    $sql = "SELECT internJobID FROM InternJob ORDER BY internJobID DESC LIMIT 1";
    $result = $db->runQuery($sql);

    return $result[0]['internJobID'];
}

function getInternJobList($companyID){
    $db = new DBController();

    $sql = "SELECT * FROM InternJob WHERE companyID = '$companyID' 
            ORDER BY CASE
            WHEN jobStatus = 'Accept Student' then 1
            WHEN jobStatus = 'Full' then 2 
            WHEN jobStatus = 'Done' then 3
            WHEN jobStatus = 'Deleted' then 4
            END ASC;";
    $result = $db->runQuery($sql);

    return $result;
}

function insertNewInternJob($internJobObject){
    $db = new DBController();

    $internJobID = $internJobObject->getInternJobID();
    $companyID = $internJobObject->getCompanyID();
    $jobTitle = $internJobObject->getJobTitle();
    $jobDescription = $internJobObject->getJobDescription();
    $jobAllowance = $internJobObject->getJobAllowance();
    $jobResponsibilities = $internJobObject->getJobResponsibilities();
    $jobLocationOfWork = $internJobObject->getJobLocationOfWork();
    $jobWorkingDay = $internJobObject->getJobWorkingDay();
    $jobWorkingHour = $internJobObject->getJobWorkingHour();
    $jobSkillsRequired = $internJobObject->getJobSkillsRequired();
    $jobMaxNumberQuota = $internJobObject->getJobMaxNumberQuota();
    $jobQualificationRequired = $internJobObject->getJobQualificationRequired();
    $jobFieldsArea = $internJobObject->getJobFieldsArea();
    $jobTrainingPeriod = $internJobObject->getJobTrainingPeriod();
    $jobSupervisorContactNo = $internJobObject->getJobSupervisorContactNo();
    $jobSupervisorEmail = $internJobObject->getJobSupervisorEmail();
    $jobCmpSupervisor = $internJobObject->getJobCmpSupervisor();

    $sqlInsertInternJob = "INSERT INTO InternJob (internJobID, companyID, jobTitle, jobDescription, jobAllowance, jobResponsibilities, jobLocationOfWork, jobWorkingDay, jobWorkingHour, jobSkillsRequired, jobMaxNumberQuota, jobQualificationRequired, jobFieldsArea, jobTrainingPeriod, jobSupervisorContactNo, jobSupervisorEmail, jobCmpSupervisor) VALUES ('$internJobID', '$companyID', '$jobTitle', '$jobDescription', '$jobAllowance', '$jobResponsibilities', '$jobLocationOfWork', '$jobWorkingDay', '$jobWorkingHour', '$jobSkillsRequired', '$jobMaxNumberQuota', '$jobQualificationRequired', '$jobFieldsArea', '$jobTrainingPeriod', '$jobSupervisorContactNo', '$jobSupervisorEmail', '$jobCmpSupervisor')";
    
    $result = $db->executeQuery($sqlInsertInternJob);

    if($result){
        return true;
    }else{
        return false;
    }
}

function getInternJobDetails($internJobID, $companyID){
    $db = new DBController();

    $sql = "SELECT * FROM InternJob WHERE internJobID = '$internJobID' AND companyID = '$companyID'";

    $result = $db->runQuery($sql);

    return $result;
}

function updateInternJobDetails($internJobObject){
    $db = new DBController();

    $internJobID = $internJobObject->getInternJobID();
    $jobMaxNumberQuota = $internJobObject->getJobMaxNumberQuota();
    $jobDescription = $internJobObject->getJobDescription();
    $jobAllowance = $internJobObject->getJobAllowance();
    $jobResponsibilities = $internJobObject->getJobResponsibilities();
    $jobLocationOfWork = $internJobObject->getJobLocationOfWork();
    $jobWorkingDay = $internJobObject->getJobWorkingDay();
    $jobWorkingHour = $internJobObject->getJobWorkingHour();
    $jobSkillsRequired = $internJobObject->getJobSkillsRequired();
    $jobQualificationRequired = $internJobObject->getJobQualificationRequired();
    $jobFieldsArea = $internJobObject->getJobFieldsArea();
    $jobTrainingPeriod = $internJobObject->getJobTrainingPeriod();
    $jobSupervisorContactNo = $internJobObject->getJobSupervisorContactNo();
    $jobSupervisorEmail = $internJobObject->getJobSupervisorEmail();
    $jobCmpSupervisor = $internJobObject->getJobCmpSupervisor();

    $sqlUpdateInternJob = "UPDATE InternJob SET jobMaxNumberQuota = '$jobMaxNumberQuota', jobDescription = '$jobDescription', jobAllowance = '$jobAllowance', jobResponsibilities = '$jobResponsibilities', jobLocationOfWork = '$jobLocationOfWork', jobWorkingDay = '$jobWorkingDay', jobWorkingHour = '$jobWorkingHour', jobSkillsRequired = '$jobSkillsRequired', jobQualificationRequired = '$jobQualificationRequired', jobFieldsArea = '$jobFieldsArea', jobTrainingPeriod = '$jobTrainingPeriod', jobSupervisorContactNo = '$jobSupervisorContactNo', jobSupervisorEmail = '$jobSupervisorEmail', jobCmpSupervisor = '$jobCmpSupervisor' WHERE internJobID = '$internJobID'";

    $result = $db->executeQuery($sqlUpdateInternJob);

    if($result){
        return true;
    }else{
        return false;
    }
}

?>