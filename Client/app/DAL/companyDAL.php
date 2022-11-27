<?php
require_once '../../includes/db_connection.php';
require_once '../DTO/companyDTO.php';

function getLastCompanyID(){
    $db = new DBController();
    $sql = "SELECT companyID FROM Company ORDER BY companyID DESC LIMIT 1";
    $result = $db->runQuery($sql);

    return $result[0]['companyID'];
}

function cmpApplicationSubmit($companyObj){
    $db = new DBController();

    $companyID = $companyObj->getCompanyID();
    $companyName = $companyObj->getCompanyName();
    $companyAddress = $companyObj->getCompanyAddress();
    $companyEmail = $companyObj->getCompanyEmail();
    $companyContact = $companyObj->getCompanyContact();
    $companyStatus = $companyObj->getCompanyStatus();
    $companyContactPerson = $companyObj->getCompanyContactPerson();
    $companyState = $companyObj->getCompanyState();
    $companyCity = $companyObj->getCompanyCity();
    $companyPostcode = $companyObj->getCompanyPostcode();
    $companySize = $companyObj->getCompanySize();
    $companyFieldsArea = $companyObj->getCompanyFieldsArea();
    $cmpDateJoined = date("Y-m-d");
    $cmpNumberOfInternshipPlacements = $companyObj->getCompanyNumberOfInternshipPlacements();

    $sqlInsertCompany = "INSERT INTO Company (companyID, cmpName, cmpEmail, cmpContactNumber, cmpState, cmpAddress, cmpAccountStatus, cmpCompanySize, cmpFieldsArea,cmpDateJoined, cmpPostcode, cmpCity, cmpContactPerson, cmpNumberOfInternshipPlacements)
                        VALUES ('$companyID', '$companyName', '$companyEmail', '$companyContact', '$companyState', '$companyAddress', '$companyStatus', '$companySize', '$companyFieldsArea', '$cmpDateJoined','$companyPostcode', '$companyCity', '$companyContactPerson', $cmpNumberOfInternshipPlacements);";
    
    $result = $db->executeQuery($sqlInsertCompany);

    if($result){
        return true;
    }else{
        return false;
    }
}

function cmpUpdateInfo($companyObj){
    $db = new DBController();

    $companyID = $companyObj->getCompanyID();
    $companyAddress = $companyObj->getCompanyAddress();
    $companyEmail = $companyObj->getCompanyEmail();
    $companyContact = $companyObj->getCompanyContact();
    $companyContactPerson = $companyObj->getCompanyContactPerson();
    $companyState = $companyObj->getCompanyState();
    $companyCity = $companyObj->getCompanyCity();
    $companyPostcode = $companyObj->getCompanyPostcode();
    $companySize = $companyObj->getCompanySize();
    $companyFieldsArea = $companyObj->getCompanyFieldsArea();
    $cmpNumberOfInternshipPlacements = $companyObj->getCompanyNumberOfInternshipPlacements();

    $sqlUpdateCompany = "UPDATE Company SET cmpEmail = '$companyEmail', cmpContactNumber = '$companyContact', cmpState = '$companyState', cmpAddress = '$companyAddress', cmpCompanySize = '$companySize', cmpFieldsArea = '$companyFieldsArea', cmpPostcode = '$companyPostcode', cmpCity = '$companyCity', cmpContactPerson = '$companyContactPerson', cmpNumberOfInternshipPlacements = $cmpNumberOfInternshipPlacements WHERE companyID = '$companyID';";
    
    $result = $db->executeQuery($sqlUpdateCompany);

    if($result){
        return true;
    }else{
        return false;
    }
}


?>