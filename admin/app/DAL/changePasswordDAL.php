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
    
    if(isset($_SESSION['committeeID'])){
        $committeeID = $_SESSION['committeeID'];  
        $sql = "SELECT commPassword FROM ITPCommittee WHERE committeeID = '$committeeID';";
        $result = $db->runQuery($sql);

        $commHashedPass = $result[0]['commPassword'];

        if(password_verify($currPass, $commHashedPass)){
            $hashedNewPass = password_hash($newPass, PASSWORD_DEFAULT);

            $sql = "UPDATE ITPCommittee SET commPassword = '$hashedNewPass' WHERE committeeID = '$committeeID';";

            $runChangePass = $db->executeQuery($sql);

            if($runChangePass){
                header("Location: ../../view/page/adminChangePassword.php?passwordChanged");
                session_destroy();
                exit();  
            }

        }else{
            header("Location: ../../view/page/adminChangePassword.php?wrongPassword");
            exit();
        }

    }elseif(isset($_SESSION['adminID'])){
        $adminID = $_SESSION['adminID'];
        $sql = "SELECT adminPassword FROM Admin WHERE adminID = '$adminID';";
        $result = $db->runQuery($sql);

        $adminHashedPass = $result[0]['adminPassword'];

        if(password_verify($currPass, $adminHashedPass)){
            $hashedNewPass = password_hash($newPass, PASSWORD_DEFAULT);

            $sql = "UPDATE Admin SET adminPassword = '$hashedNewPass' WHERE adminID = '$adminID';";
            
            $runChangePass = $db->executeQuery($sql);

            if($runChangePass){
                header("Location: ../../view/page/adminChangePassword.php?passwordChanged");
                session_destroy();
                exit();  
            }
        }else{
            header("Location: ../../view/page/adminChangePassword.php?wrongPassword");
            exit();
        }

    }
}
?>