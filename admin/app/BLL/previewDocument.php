<?php
    if(isset($_GET['path'])){
    //Read the currFileName
    $currFileName = $_GET['path'];
    
    //Generate New File Path
    $localPath = $_SERVER['DOCUMENT_ROOT'].'/InternshipSystem/admin/view/document/documentManagement/';
    $baseCurrFileName = basename($currFileName);
    $newFilePath = $localPath.$baseCurrFileName;

    //Check the file exists or not
    if(file_exists($newFilePath)) {
        //Define header information
        header('Content-type: application/pdf');
  
        header('Content-Disposition: inline; filename="' . $newFilePath . '"');
        
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