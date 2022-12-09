<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

class EmailConfig{
    private $mail;

    function __construct(){
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'taiwk-am19@student.tarc.edu.my';
        $this->mail->Password = 'ozkanjvpwsxqahsf';
        $this->mail->SMTPSecure = 'ssl';
        $this->mail->Port = 465;
        $this->mail->isHTML(true);
        $this->mail->setFrom('taiwk-am19@student.tarc.edu.my');
    }

    private function setAndCheckEmpty($subject, $content){
        if(empty($subject) || empty($content)){
            return false;
        }else{
            $this->mail->Subject = $subject;
            $this->mail->Body = $content;
            return true;
        }
    }

    private function checkEmailFormat($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this->mail->addAddress($email);
            return true;
        }else{
            return false;
        }
    }

    private function setAttachment($attachment){
        if(empty($attachment)){
            return false;
        }else{
            $this->mail->addAttachment($attachment);
            return true;
        }
    }

    /**
     * Send Email to Single User
     * @param $senderEmail = email of sender
     * @param $subject = subject of email
     * @param $content = content of email
     * @param $attachment = attachment of email
     * @return boolean
     */
    function singleEmailWithAttachment($senderEmail, $subject, $content, $attachment){
      $checkEmail = $this->checkEmailFormat($senderEmail);
      $checkEmpty = $this->setAndCheckEmpty($subject, $content);
      $checkAttachment = $this->setAttachment($attachment);

      if ($checkEmail && $checkEmpty && $checkAttachment){
        $success = $this->mail->send();
      }else{
        return false;
      }

        return $success;
    }

    /**
     * Send Email to Single User
     * @param $senderEmail = email of sender
     * @param $subject = subject of email
     * @param $content = content of email
     * @return boolean
     */
    function singleEmail($senderEmail, $subject, $content){
        $checkEmail = $this->checkEmailFormat($senderEmail);
        $checkEmpty = $this->setAndCheckEmpty($subject, $content);
  
        if($checkEmail && $checkEmpty){
          $success = $this->mail->send();
        }else{
          return false;
        }
  
        return $success;
    }

    /**
     * @param $emailList = multiple email
     * @param $subject = subject of email
     * @param $content = content of email
     * @return boolean
     */

    function bulkEmail($emailList, $subject, $content){
        foreach($emailList as $senderEmail){
          $checkEmail = $this->checkEmailFormat($senderEmail);           
            
          if (!$checkEmail){
            return false;
          }   
        }

        $checkEmpty = $this->setAndCheckEmpty($subject, $content);

        if ($checkEmail && $checkEmpty){
            $success = $this->mail->send();
        }
         
        return $success;
    }
}
?>