<?php
$systemPathPrefix = $_SERVER['DOCUMENT_ROOT'].'/internshipSystem/client/';
require_once $systemPathPrefix.'app/DAL/internJobDAL.php';

class InternJob{
    private $internJobID, $companyID, $jobTitle, $jobDescription, $jobAllowance, $jobResponsibilities, $jobLocationOfWork, $jobWorkingDay, $jobWorkingHour, $jobSkillsRequired, $jobMaxNumberQuota, $jobQualificationRequired, $jobFieldsArea, $jobTrainingPeriod, $jobSupervisorContactNo, $jobSupervisorEmail, $jobCmpSupervisor;

    function generateInternJobID(){
        $internJobID = getLastInternJobID();
        $year = substr(date("Y"), 2);

        $internJobID = substr($internJobID, 5);
        $internJobID = (int)$internJobID;
        $internJobID = $internJobID + 1;
        $internJobID = $year . "InJ" . str_pad($internJobID, 5, "0", STR_PAD_LEFT);

        return $internJobID;
    }

    function insertNewInternJob(){
        $insertNewInternJob = insertNewInternJob($this);

        return $insertNewInternJob;
    }

    function getCompanyDetails($companyID){
        $companyDetails = getCompanyDetails($companyID);

        return $companyDetails;
    }

    function getInternJob($internJobID, $companyID){
        $internJob = getInternJobDetails($internJobID, $companyID);

        return $internJob;
    }

    function updateInternJob(){
        $updateInternJob = updateInternJobDetails($this);

        return $updateInternJob;
    }

    //Getter
    public function getInternJobID(){
        return $this->internJobID;
    }

    public function getCompanyID(){
        return $this->companyID;
    }
    
    public function getJobTitle(){
        return $this->jobTitle;
    }

    public function getJobDescription(){
        return $this->jobDescription;
    }

    public function getJobAllowance(){
        return $this->jobAllowance;
    }

    public function getJobResponsibilities(){
        return $this->jobResponsibilities;
    }

    public function getJobLocationOfWork(){
        return $this->jobLocationOfWork;
    }

    public function getJobWorkingDay(){
        return $this->jobWorkingDay;
    }

    public function getJobWorkingHour(){
        return $this->jobWorkingHour;
    }

    public function getJobSkillsRequired(){
        return $this->jobSkillsRequired;
    }

    public function getJobMaxNumberQuota(){
        return $this->jobMaxNumberQuota;
    }

    public function getJobQualificationRequired(){
        return $this->jobQualificationRequired;
    }

    public function getJobFieldsArea(){
        return $this->jobFieldsArea;
    }

    public function getJobTrainingPeriod(){
        return $this->jobTrainingPeriod;
    }

    public function getJobSupervisorContactNo(){
        return $this->jobSupervisorContactNo;
    }

    public function getJobSupervisorEmail(){
        return $this->jobSupervisorEmail;
    }

    public function getJobCmpSupervisor(){
        return $this->jobCmpSupervisor;
    }

    //Setter
    public function setInternJobID($internJobID){
        $this->internJobID = $internJobID;
        return $this;
    }

    public function setCompanyID($companyID){
        $this->companyID = $companyID;
        return $this;
    }

    public function setJobTitle($jobTitle){
        $this->jobTitle = $jobTitle;
        return $this;
    }

    public function setJobDescription($jobDescription){
        $this->jobDescription = $jobDescription;
        return $this;
    }

    public function setJobAllowance($jobAllowance){
        $this->jobAllowance = $jobAllowance;
        return $this;
    }

    public function setJobResponsibilities($jobResponsibilities){
        $this->jobResponsibilities = $jobResponsibilities;
        return $this;
    }

    public function setJobLocationOfWork($jobLocationOfWork){
        $this->jobLocationOfWork = $jobLocationOfWork;
        return $this;
    }

    public function setJobWorkingDay($jobWorkingDay){
        $this->jobWorkingDay = $jobWorkingDay;
        return $this;
    }

    public function setJobWorkingHour($jobWorkingHour){
        $this->jobWorkingHour = $jobWorkingHour;
        return $this;
    }

    public function setJobSkillsRequired($jobSkillsRequired){
        $this->jobSkillsRequired = $jobSkillsRequired;
        return $this;
    }

    public function setJobMaxNumberQuota($jobMaxNumberQuota){
        $this->jobMaxNumberQuota = $jobMaxNumberQuota;
        return $this;
    }

    public function setJobQualificationRequired($jobQualificationRequired){
        $this->jobQualificationRequired = $jobQualificationRequired;
        return $this;
    }

    public function setJobFieldsArea($jobFieldsArea){
        $this->jobFieldsArea = $jobFieldsArea;
        return $this;
    }

    public function setJobTrainingPeriod($jobTrainingPeriod){
        $this->jobTrainingPeriod = $jobTrainingPeriod;
        return $this;
    }

    public function setJobSupervisorContactNo($jobSupervisorContactNo){
        $this->jobSupervisorContactNo = $jobSupervisorContactNo;
        return $this;
    }

    public function setJobSupervisorEmail($jobSupervisorEmail){
        $this->jobSupervisorEmail = $jobSupervisorEmail;
        return $this;
    }

    public function setJobCmpSupervisor($jobCmpSupervisor){
        $this->jobCmpSupervisor = $jobCmpSupervisor;
        return $this;
    }


    

}

?>