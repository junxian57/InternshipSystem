<?php
require '../../../config/email.php';

if(isset($_POST['submit'])){
    $mailConfig = new EmailConfig();
    $content="Your initial pass is ";
    $name = $_POST['username'];
    $a=substr ($name,0,3);
    $m=date('m');
    $y=date('y');
    $d=date('d');
    $pass=$content.$a.$m.$y.$d;
    //? This is for single email
    $success = $mailConfig->singleEmail($_POST['email'], "Registration invitation", $pass);
     
    if($success){
        echo "
        <script>
            alert('Email sent');
            document.location.href = 'ky-intStudRegister.php';
        </script>
        ";
    }
}
?>