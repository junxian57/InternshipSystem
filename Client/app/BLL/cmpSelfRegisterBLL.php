<?php
require_once '../DTO/companyDTO.php';

if(isset($_POST['cmpName']) && isset($_POST['cmpContactNo']) && isset($_POST['cmpEmail']) && isset($_POST['cmpContactPerson']) && isset($_POST['cmpAddress']) && isset($_POST['cmpState']) && isset($_POST['cmpPostCode']) && isset($_POST['cmpCity']) && isset($_POST['cmpSize']) && isset($_POST['cmpHiddenFieldsArea']) && isset($_POST['submit'])){

    try{
        $cmpDTO = new Company();
        $cmpID = $cmpDTO->generateCompanyID();
        $cmpName = trim($_POST['cmpName']);
        $cmpContactNo = trim($_POST['cmpContactNo']);
        $cmpEmail = $_POST['cmpEmail'];
        $cmpContactPerson = trim($_POST['cmpContactPerson']);
        $cmpAddress = trim($_POST['cmpAddress']);
        $cmpState = $_POST['cmpState'];
        $cmpPostCode = $_POST['cmpPostCode'];
        $cmpCity = trim($_POST['cmpCity']);
        $cmpSize = $_POST['cmpSize'];
        $cmpFieldsArea = trim($_POST['cmpHiddenFieldsArea']);
        $cmpCertification = $_FILES['cmpCertification'];

        if($cmpSize == 'Micro'){
            $cmpNumberOfInternshipPlacements = 2;
        }else if($cmpSize == 'Small'){
            $cmpNumberOfInternshipPlacements = 8;
        }else if($cmpSize == 'Medium'){
            $cmpNumberOfInternshipPlacements = 20;
        }else if($cmpSize == 'Large'){
            $cmpNumberOfInternshipPlacements = 50;
        }
        
        $cmpDTO->setCompanyID($cmpID)
        ->setCompanyName($cmpName)
        ->setCompanyContact($cmpContactNo)
        ->setCompanyEmail($cmpEmail)
        ->setCompanyContactPerson($cmpContactPerson)
        ->setCompanyAddress($cmpAddress)
        ->setCompanyState($cmpState)
        ->setCompanyPostcode($cmpPostCode)
        ->setCompanyCity($cmpCity)
        ->setCompanySize($cmpSize)
        ->setCompanyFieldsArea($cmpFieldsArea)
        ->setCompanyStatus("Pending")
        ->setCompanyNumberOfInternshipPlacements($cmpNumberOfInternshipPlacements)
        ->setCompanyCert($cmpCertification);

        $cmpDTO->replaceCertLocation();

        $success = $cmpDTO->insertCompany();

        if($success){
            header("Location: ../../view/page/br-cmpSelfRegister.php?success=1&status=pending");
        }else{
            header("Location: ../../view/page/br-cmpSelfRegister.php?failed=1");
        }

        exit(0);
    }catch(PDOException $e){
        header("Location: ../../view/page/br-cmpSelfRegister.php?failed=1");
    }
}

?>