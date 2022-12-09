<?php
if(session_status() != PHP_SESSION_ACTIVE) session_start();
include_once('../../includes/db_connection.php');


$db = new DBController();

if(isset($_POST['currentPass']) && isset($_POST['newPass']) && isset($_POST['confirmNewPass'])){
    $currPass = $_POST['currentPass'];
    $newPass = $_POST['newPass'];
    $confirmNewPass = $_POST['confirmNewPass'];
    
    if($newPass != $confirmNewPass){
        header("Location: ../../view/page/adminChangePassword.php?passwordNotMatch");
        exit();
    }
    
    if(isset($_SESSION['studentID'])){
        $studentID = $_SESSION['studentID'];  
        $sql = "SELECT studPassword FROM Student WHERE studentID = '$studentID';";
        $result = $db->runQuery($sql);

        $stdHashedPass = $result[0]['studPassword'];

        if(password_verify($currPass, $stdHashedPass)){
            $hashedNewPass = password_hash($newPass, PASSWORD_DEFAULT);

            $sql = "UPDATE Student SET studPassword = '$hashedNewPass', studAccountStatus = 'Pending Map' WHERE studentID = '$studentID';";

            $runChangePass = $db->executeQuery($sql);

            if($runChangePass){
                if(isset($_SESSION['studentChangePass'])){
                    unset($_SESSION['studentChangePass']);
                }

                header("Location: ../../view/page/clientChangePassword.php?passwordChanged");
                session_destroy();
                exit();
            }

        }else{
            header("Location: ../../view/page/clientChangePassword.php?wrongPassword");
            exit();
        }

    }elseif(isset($_SESSION['companyID'])){
        $companyID = $_SESSION['companyID'];  
        $sql = "SELECT cmpPassword FROM Company WHERE companyID = '$companyID';";
        $result = $db->runQuery($sql);

        $cmpHashedPass = $result[0]['cmpPassword'];

        if(password_verify($currPass, $cmpHashedPass)){
            $hashedNewPass = password_hash($newPass, PASSWORD_DEFAULT);

            $sql = "UPDATE Company SET cmpPassword = '$hashedNewPass', cmpAccountStatus = 'Successful' WHERE companyID = '$companyID';";

            $runChangePass = $db->executeQuery($sql);

            if($runChangePass){
                if(isset($_SESSION['companyChangePass'])){
                    unset($_SESSION['companyChangePass']);
                }

                header("Location: ../../view/page/clientChangePassword.php?passwordChanged");
                session_destroy();
                exit();
            }

        }else{
            header("Location: ../../view/page/clientChangePassword.php?wrongPassword");
            exit();
        }

    }elseif(isset($_SESSION['lecturerID'])){
        $lecturerID = $_SESSION['lecturerID'];  
        $sql = "SELECT lecPassword FROM Lecturer WHERE lecturerID = '$lecturerID';";
        $result = $db->runQuery($sql);

        $lecHashedPass = $result[0]['lecPassword'];

        if(password_verify($currPass, $lecHashedPass)){
            $hashedNewPass = password_hash($newPass, PASSWORD_DEFAULT);

            $sql = "UPDATE Lecturer SET lecPassword = '$hashedNewPass' WHERE lecturerID = '$lecturerID';";

            $runChangePass = $db->executeQuery($sql);

            if($runChangePass){
                header("Location: ../../view/page/clientChangePassword.php?passwordChanged");
                session_destroy();
                exit();
            }

        }else{
            header("Location: ../../view/page/clientChangePassword.php?wrongPassword");
            exit();
        }

    }
}
?>