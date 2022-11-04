<?php
require '../../../config/email.php';

if(isset($_POST['submit'])){
    $mailConfig = new EmailConfig();

    //? This is for multiple email
    /**
     * @param $emailList = array of email
     * @param $subject = subject of email
     * @param $content = content of email
     */
    $mailConfig->bulkEmail(Array($_POST['email'], 'brysontai10@gmail.com'), $_POST['subject'], $_POST['content']);

    //? This is for single email
    /**
     * setSenderEmail($senderEmail)
     */
    //$mailConfig->setSenderEmail($_POST['email']);
    // $mailConfig->setSubject($_POST['subject']);
    // $mailConfig->setContent($_POST['content']);

    $success = $mailConfig->singleEmail($_POST['email'], $_POST['subject'], $_POST['content']);

    // if($success){
    //     echo "
    //     <script>
    //         alert('Email sent');
    //         document.location.href = 'form.php';
    //     </script>
    //     ";
    // }
}
?>