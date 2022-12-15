<?php
    if(isset($_GET['path'])){
    //Read the currFileName
    $currFileName = $_GET['path'];
    
    //Generate New File Path
    $localPath = $_SERVER['DOCUMENT_ROOT'].'/InternshipSystem/Client/view/document/CompanyCert/';
    $baseCurrFileName = basename($currFileName);
    $newFilePath = $localPath.$baseCurrFileName;

    $fileType = pathinfo($newFilePath, PATHINFO_EXTENSION);

    //Check the file exists or not
    if(file_exists($newFilePath)) {

        //Define header information
        if($fileType == "pdf"){
            header('Content-type: application/pdf');
        }else if($fileType == "jpg" || $fileType == "jpeg" || $fileType == "png"){
            header('Content-type: image/*');
        }

        header('Content-Disposition: inline; filename="' . $baseCurrFileName . '"');
        
        header('Content-Transfer-Encoding: binary');
        
        header('Accept-Ranges: bytes');

        //Clear system output buffer
        flush();

        //Read the size of the file
        readfile($newFilePath);

        //Terminate from the script
        die();
    }else{
        echo "File does not exist.";
    }
}else {
    echo "currFileName is not defined.";
}
?>