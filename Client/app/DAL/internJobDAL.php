<?php
require_once '../../includes/db_connection.php';
require_once '../DTO/internJobDTO.php';

function getLastInternJobID(){
    $db = new DBController();
    $sql = "SELECT internJobID FROM InternJob ORDER BY internJobID DESC LIMIT 1";
    $result = $db->runQuery($sql);

    return $result[0]['internJobID'];
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

?>