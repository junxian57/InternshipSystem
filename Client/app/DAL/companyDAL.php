<?php
$systemPathPrefix = $_SERVER['DOCUMENT_ROOT'].'/internshipSystem/client/';

require_once $systemPathPrefix.'app/DTO/companyDTO.php';
require_once $systemPathPrefix.'includes/db_connection.php';

function getLastCompanyID(){
    $db = new DBController();
    $sql = "SELECT companyID FROM Company ORDER BY companyID DESC LIMIT 1";
    $result = $db->runQuery($sql);

    return $result[0]['companyID'];
}

function getCompanyDetails($companyID){
    $db = new DBController();
    $result = $db->runQuery("SELECT * FROM Company WHERE companyID = '$companyID';");

    return $result;
}

function getRemainQuota($companyID){
    $db = new DBController();

    $sql = "SELECT SUM(IJ.jobMaxNumberQuota) AS TotalQuota, C.cmpNumberOfInternshipPlacements 
            FROM InternJob IJ, Company C 
            WHERE IJ.companyID = C.companyID AND
            IJ.companyID = '$companyID'
            GROUP BY IJ.companyID
            HAVING SUM(IJ.jobMaxNumberQuota) < C.cmpNumberOfInternshipPlacements;";

    $result = $db->runQuery($sql);

    return $result;
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

function cmpUpdateAmendInfo($companyObj){
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
    $companyStatus = $companyObj->getCompanyStatus();
    $cmpNumberOfInternshipPlacements = $companyObj->getCompanyNumberOfInternshipPlacements();

    $sqlUpdateAmendedCmpInfo = "UPDATE Company SET cmpEmail = '$companyEmail', cmpContactNumber = '$companyContact', cmpState = '$companyState', cmpAddress = '$companyAddress', cmpCompanySize = '$companySize', cmpFieldsArea = '$companyFieldsArea', cmpPostcode = '$companyPostcode', cmpCity = '$companyCity', cmpContactPerson = '$companyContactPerson', cmpAccountStatus = '$companyStatus', cmpNumberOfInternshipPlacements = $cmpNumberOfInternshipPlacements WHERE companyID = '$companyID';";

    $result = $db->executeQuery($sqlUpdateAmendedCmpInfo);

    if($result){
        return true;
    }else{
        return false;
    }
}


?>