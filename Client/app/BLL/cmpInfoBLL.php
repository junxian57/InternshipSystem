<?php
require_once '../DTO/companyDTO.php';

if(isset($_GET['companyID']) && isset($_GET['cmpContactNo']) && isset($_GET['cmpEmail']) && isset($_GET['cmpContactPerson']) && isset($_GET['cmpAddress']) && isset($_GET['cmpState']) && isset($_GET['cmpPostcode']) && isset($_GET['cmpCity']) && isset($_GET['cmpSize']) && isset($_GET['cmpHiddenFieldsArea']) && isset($_GET['submit'])){

    try{
        $cmpDTO = new Company();
        $cmpID = $_GET['companyID'];
        $cmpContactNo = trim($_GET['cmpContactNo']);
        $cmpEmail = $_GET['cmpEmail'];
        $cmpContactPerson = trim($_GET['cmpContactPerson']);
        $cmpAddress = trim($_GET['cmpAddress']);
        $cmpState = $_GET['cmpState'];
        $cmpPostCode = $_GET['cmpPostcode'];
        $cmpCity = trim($_GET['cmpCity']);
        $cmpSize = $_GET['cmpSize'];
        $cmpFieldsArea = trim($_GET['cmpHiddenFieldsArea']);

        if($cmpSize == 'Micro'){
            $cmpNumberOfInternshipPlacements = 2;
        }else if($cmpSize == 'Small'){
            $cmpNumberOfInternshipPlacements = 8;
        }else if($cmpSize == 'Medium'){
            $cmpNumberOfInternshipPlacements = 20;
        }else if($cmpSize == 'Large'){
            $cmpNumberOfInternshipPlacements = 50;
        }
        
        $cmpDTO
        ->setCompanyID($cmpID)
        ->setCompanyContact($cmpContactNo)
        ->setCompanyEmail($cmpEmail)
        ->setCompanyContactPerson($cmpContactPerson)
        ->setCompanyAddress($cmpAddress)
        ->setCompanyState($cmpState)
        ->setCompanyPostcode($cmpPostCode)
        ->setCompanyCity($cmpCity)
        ->setCompanySize($cmpSize)
        ->setCompanyFieldsArea($cmpFieldsArea)
        ->setCompanyNumberOfInternshipPlacements($cmpNumberOfInternshipPlacements);

        $success = $cmpDTO->updateCompany();

        if($success){
            header("Location: ../../view/page/br-companyInfo.php?update=1&success=1");
        }else{
            header("Location: ../../view/page/br-companyInfo.php?update=0&failed=1");
        }

        exit(0);
    }catch(PDOException $e){
        header("Location: ../../view/page/br-companyInfo.php?failed=1");
    }
}

?>