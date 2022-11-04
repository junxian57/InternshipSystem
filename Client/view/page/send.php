<?php
require '../../../config/email.php';

if(isset($_POST['submit'])){
    $mailConfig = new EmailConfig();

    //? This is for multiple email
    $mailConfig->bulkEmail(Array($_POST['email'], 'brysontai10@gmail.com'), $_POST['subject'], $_POST['content']);

    //? This is for single email
    $success = $mailConfig->singleEmail($_POST['email'], $_POST['subject'], $_POST['content']);

    if($success){
        echo "
        <script>
            alert('Email sent');
            document.location.href = 'form.php';
        </script>
        ";
    }
}
?>