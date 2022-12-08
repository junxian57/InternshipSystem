<?php
require_once('../../includes/db_connection.php');
if(session_status() != PHP_SESSION_ACTIVE) session_start();

$db = new DBController();

if(isset($_GET['itpEmail']) && isset($_GET['itpPass']) && isset($_GET['itpCommittee'])){
    $itpEmail = $_GET['itpEmail'];
    $itpPass = $_GET['itpPass'];

    if(!validateEmail($itpEmail)){
        echo json_encode("Wrong Email Format");
        exit();
    }

    $query = "SELECT * FROM ITPCommittee WHERE commEmail = '$itpEmail';";
    $result = $db->runQuery($query);

    //Check if result is null
    if($result == null){
        echo json_encode("Email Not Found");
    }else{
        //Verify Password
        $commHashedPass = $result[0]['commPassword'];    

        if(password_verify($itpPass, $commHashedPass)){

            $_SESSION['committeeID'] = $result[0]['committeeID'];
            
            echo json_encode("Login Successful");
        }else{
            echo json_encode("Wrong Password");
        }
        
    }

    exit();
}elseif(isset($_GET['adminEmail']) && isset($_GET['adminPass']) && isset($_GET['admin'])){
    $adminEmail = $_GET['adminEmail'];
    $adminPass = $_GET['adminPass'];

    $query = "SELECT * FROM Admin WHERE adminUserName = '$adminEmail' OR adminEmail = '$adminEmail';";

    $result = $db->runQuery($query);

    //Check if result is null
    if($result == null){
        echo json_encode("Email Not Found");
    }else{
        //Verify Password
        $adminHashedPass = $result[0]['adminPassword'];    

        if(password_verify($adminPass, $adminHashedPass)){

            $_SESSION['adminID'] = $result[0]['adminID'];
            
            echo json_encode("Login Successful");
        }else{
            echo json_encode("Wrong Password");
        }
        
    }

    exit();
}

function validateEmail($email){
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    }else{
        return false;
    }
}
?>