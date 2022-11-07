<?php
    $fileName=$_FILES['fuResume']['name'];
    $tmpName=$_FILES['fuResume']['tmp_name'];

    move_uploaded_file($tmpName,$fileName);
    echo("File Upload Successfuly");
?>