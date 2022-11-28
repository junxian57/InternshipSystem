<?php
$systemPathPrefix = $_SERVER['DOCUMENT_ROOT'].'/internshipSystem/client/';

require_once $systemPathPrefix.'app/DAL/companyDAL.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/internshipSystem/config/email.php';

class Company{
    private $companyID, $companyName, $companyAddress, $companyEmail, $companyContact, $companyStatus, $companyContactPerson, $companyState, $companyCity, $companyPostcode, $companySize, $companyFieldsArea, $cmpNumberOfInternshipPlacements;

    function generateCompanyID(){
        $company = getLastCompanyID();

        $companyID = $company;
        $companyID = substr($companyID, 3);
        $companyID = (int)$companyID;
        $companyID = $companyID + 1;
        $companyID = "CMP" . str_pad($companyID, 5, "0", STR_PAD_LEFT);
        return $companyID;
    }

    //Insert New Company
    function insertCompany(){
        $registrationDAL = cmpApplicationSubmit($this);

        if($registrationDAL){
            $emailCompany = $this->sendCompanyAppEmail($registrationDAL);
        }else{
            $emailCompany = false;
        }

        return $emailCompany;
    }

    function updateCompany(){
        $updateCompany = cmpUpdateInfo($this);

        return $updateCompany;
    }

    //Create Company Application Notification Email
    function sendCompanyAppEmail($updateSuccess){
        $email = new EmailConfig();
        $companyName = $this->getCompanyName();
        
        if($updateSuccess){
            $htmlContent = "<html>
                        <head>
                            <title>Company Registration</title>
                        </head>
                        <body>
                            <p>Dear $companyName,</p>
                            <p>Your company has been registered successfully.</p>
                            <p>Thank you for registering with us. We will review your application in short.</p>
                            <br>
                            <p>Best Regards,</p>
                            <p>Internship Management System</p>
                        </body>
                    </html>";

                return $email->singleEmail($this->companyEmail, "Company Registration", $htmlContent);

        }else if(!$updateSuccess){
            return false;
        }    
    }

    function getCompanyID(){
        return $this->companyID;
    }

    function getCompanyName(){
        return $this->companyName;
    }
    
    function getCompanyAddress(){
        return $this->companyAddress;
    }

    function getCompanyContact(){
        return $this->companyContact;
    }

    function getCompanyEmail(){
        return $this->companyEmail;
    }

    function getCompanyStatus(){
        return $this->companyStatus;
    }

    function getCompanyContactPerson(){
        return $this->companyContactPerson;
    }

    function getCompanyState(){
        return $this->companyState;
    }

    function getCompanyCity(){
        return $this->companyCity;
    }

    function getCompanyPostcode(){
        return $this->companyPostcode;
    }

    function getCompanySize(){
        return $this->companySize;
    }

    function getCompanyFieldsArea(){
        return $this->companyFieldsArea;
    }

    function getCompanyNumberOfInternshipPlacements(){
        return $this->cmpNumberOfInternshipPlacements;
    }

    function setCompanyID($companyID){
        $this->companyID = $companyID;
        return $this;
    }

    function setCompanyName($companyName){
        $this->companyName = $companyName;
        return $this;
    }

    function setCompanyAddress($companyAddress){
        $this->companyAddress = $companyAddress;
        return $this;
    }

    function setCompanyContact($companyContact){
        $this->companyContact = $companyContact;
        return $this;
    }

    function setCompanyEmail($companyEmail){
        $this->companyEmail = $companyEmail;
        return $this;
    }

    function setCompanyStatus($companyStatus){
        $this->companyStatus = $companyStatus;
        return $this;
    }

    function setCompanyContactPerson($companyContactPerson){
        $this->companyContactPerson = $companyContactPerson;
        return $this;
    }

    function setCompanyState($companyState){
        $this->companyState = $companyState;
        return $this;
    }

    function setCompanyCity($companyCity){
        $this->companyCity = $companyCity;
        return $this;
    }

    function setCompanyPostcode($companyPostcode){
        $this->companyPostcode = $companyPostcode;
        return $this;
    }

    function setCompanySize($companySize){
        $this->companySize = $companySize;
        return $this;
    }

    function setCompanyFieldsArea($companyFieldsArea){
        $this->companyFieldsArea = $companyFieldsArea;
        return $this;
    }

    function setCompanyNumberOfInternshipPlacements($cmpNumberOfInternshipPlacements){
        $this->cmpNumberOfInternshipPlacements = $cmpNumberOfInternshipPlacements;
        return $this;
    }
}
?>