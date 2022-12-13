<?php
require_once('../../includes/db_connection.php');
if(session_status() != PHP_SESSION_ACTIVE) session_start();

$db = new DBController();

if(isset($_GET['studentEmail']) && isset($_GET['studentPass']) && isset($_GET['student'])){
    $studentEmail = $_GET['studentEmail'];
    $studentPass = $_GET['studentPass'];

    if(!validateEmail($studentEmail)){
        echo json_encode("Wrong Email Format");
        exit();
    }

    $query = "SELECT s.* , f.facultyID 
    FROM Student s , Programme p , Faculty f , Department d 
    WHERE s.studEmail = '$studentEmail' AND s.studAccountStatus NOT IN ('Pending Invite', 'Withdrawal') AND s.programmeID=p.programmeID AND p.departmentID=d.departmentID AND d.facultyID=f.facultyID";
    
    $result = $db->runQuery($query);

    //Check if result is null
    if($result == null){
        echo json_encode("Email Not Found");
    }else{
        //Verify Password
        $studentHashedPass = $result[0]['studPassword'];    

        if(password_verify($studentPass, $studentHashedPass)){
            $accStatus = $result[0]['studAccountStatus'];

            //Check status is initialPass
            if($accStatus == 'InitialPass'){
                $changePassArr = array(
                    'studentID' => $result[0]['studentID'],
                    'changePassword' => true
                );

                $_SESSION['studentChangePass'] = true;
                echo json_encode($changePassArr);
            }elseif($result[0]['studentCV'] == null){
                echo json_encode('CVRequired');
            }
            else{
                echo json_encode("Login Successful");
            }

            $_SESSION['studentID'] = $result[0]['studentID'];
            $_SESSION['internshipBatchID'] = $result[0]['internshipBatchID'];
            $_SESSION['facultyID'] = $result[0]['facultyID'];
        }else{
            echo json_encode("Wrong Password");
        } 
    }
    exit();

}elseif(isset($_GET['lecturerEmail']) && isset($_GET['lecturerPass']) && isset($_GET['lecturer'])){
    $lecturerEmail = $_GET['lecturerEmail'];
    $lecturerPass = $_GET['lecturerPass'];

    if(!validateEmail($lecturerEmail)){
        echo json_encode("Wrong Email Format");
        exit();
    }

    $query = "SELECT * FROM Lecturer WHERE lecEmail = '$lecturerEmail' AND supervisorQualification = 1";
    $result = $db->runQuery($query);

    //Check if result is null
    if($result == null){
        echo json_encode("Email Not Found");
    }else{
        //Verify Password
        $lecturerHashedPass = $result[0]['lecPassword'];    

        if(password_verify($lecturerPass, $lecturerHashedPass)){
            $_SESSION['lecturerID'] = $result[0]['lecturerID'];
            
            echo json_encode("Login Successful");
        }else{
            echo json_encode("Wrong Password");
        }
    }
    exit();

}elseif(isset($_GET['companyAcc']) && isset($_GET['companyPass']) && isset($_GET['company'])){
    $companyAcc = $_GET['companyAcc'];
    $companyPass = $_GET['companyPass'];

    $query = "SELECT * FROM Company WHERE cmpUsername = '$companyAcc' AND cmpAccountStatus NOT IN ('Rejected', 'Amended Info', 'Pending')";
    
    $result = $db->runQuery($query);

    //Check if result is null
    if($result == null){
        echo json_encode("Email Not Found");
    }else{
        //Verify Password
        $cmpHashedPass = $result[0]['cmpPassword'];    

        if(password_verify($companyPass, $cmpHashedPass)){
            $accStatus = $result[0]['cmpAccountStatus'];

            //Check status is initialPass
            if($accStatus == 'InitialPass'){
                $changePassArr = array(
                    'companyID' => $result[0]['companyID'],
                    'changePassword' => true
                );

                $_SESSION['companyChangePass'] = true;
                echo json_encode($changePassArr);
            }else{             
                echo json_encode("Login Successful");
            }
            $_SESSION['companyID'] = $result[0]['companyID'];
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