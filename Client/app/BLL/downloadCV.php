<?php
    if(isset($_GET['path'])){
    //Read the currFileName
    $currFileName = $_GET['path'];
    
    //Generate New File Path
    $localPath = $_SERVER['DOCUMENT_ROOT'].'/InternshipSystem/Client/view/document/StudentCV/';
    $baseCurrFileName = basename($currFileName);
    $newFilePath = $localPath.$baseCurrFileName;

    //Check the file exists or not
    if(file_exists($newFilePath)) {
        //Define header information
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: 0");
        header('Content-Disposition: attachment; filename="'.$baseCurrFileName.'"');
        header('Content-Length: ' . filesize($newFilePath));
        header('Pragma: public');

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