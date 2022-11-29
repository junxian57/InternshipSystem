<?php
require_once '../DTO/internJobDTO.php';

if(isset($_GET['internJobID']) && isset($_GET['jobNumberPlacement']) && isset($_GET['jobDesc']) && isset($_GET['jobQualification']) && isset($_GET['jobWorkLocation']) && isset($_GET['jobAllowance']) && isset($_GET['jobWorkingDay']) && isset($_GET['jobWorkingHour']) && isset($_GET['fieldAreaSelection']) && isset($_GET['jobTrainingPeriod']) && isset($_GET['jobSupervisor']) && isset($_GET['jobSupervisorEmail']) && isset($_GET['jobSupervisorContact']) && isset($_GET['jobResponStr']) && isset($_GET['jobSkillsStr']) && isset($_GET['amend'])){

    $internJob = new InternJob();

    $internJobID = trim($_GET['internJobID']);
    $jobNumberPlacement = trim($_GET['jobNumberPlacement']);
    $jobDesc = trim($_GET['jobDesc']);
    $jobQualification = trim($_GET['jobQualification']);
    $jobWorkLocation = trim($_GET['jobWorkLocation']);
    $jobAllowance = trim($_GET['jobAllowance']);
    $jobWorkingDay = trim($_GET['jobWorkingDay']);
    $jobWorkingHour = trim($_GET['jobWorkingHour']);
    $fieldAreaSelection = trim($_GET['fieldAreaSelection']);
    $jobTrainingPeriod = trim($_GET['jobTrainingPeriod']);
    $jobSupervisor = trim($_GET['jobSupervisor']);
    $jobSupervisorEmail = trim($_GET['jobSupervisorEmail']);
    $jobSupervisorContact = trim($_GET['jobSupervisorContact']);
    $jobResponStr = trim($_GET['jobResponStr']);
    $jobSkillsStr = trim($_GET['jobSkillsStr']);
    
    $internJob
    ->setInternJobID($internJobID)
    ->setJobMaxNumberQuota($jobNumberPlacement)
    ->setJobDescription($jobDesc)
    ->setJobQualificationRequired($jobQualification)
    ->setJobLocationOfWork($jobWorkLocation)
    ->setJobAllowance($jobAllowance)
    ->setJobWorkingDay($jobWorkingDay)
    ->setJobWorkingHour($jobWorkingHour)
    ->setJobFieldsArea($fieldAreaSelection)
    ->setJobTrainingPeriod($jobTrainingPeriod)
    ->setJobCmpSupervisor($jobSupervisor)
    ->setJobSupervisorEmail($jobSupervisorEmail)
    ->setJobSupervisorContactNo($jobSupervisorContact)
    ->setJobResponsibilities($jobResponStr)
    ->setJobSkillsRequired($jobSkillsStr);

    $result = $internJob->updateInternJob();

    if($result){
        header("Location: ../../view/page/br-companyJobList.php?edited=1&success=1");
    }else{
        header("Location: ../../view/page/br-companyJobList.php?edited=0&failed=1");
    }
}else{
    header("Location: ../../view/page/br-companyJobList.php?error=1");
}

?>