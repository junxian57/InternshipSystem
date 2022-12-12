<?php

    $host = "sql444.main-hosting.eu";
    $user = "u928796707_group34";
    $password = "u1VF3KYO1r|";
    $database = "u928796707_internshipWeb";
    
    $conn = mysqli_connect($host, $user, $password, $database);
    if (!$conn){
        die("Error". mysqli_connect_error());
    }

    if(isset($_POST['update'])){

        $id = $_POST['stdID'];
        $name = $_POST['stdName'];
        $phone = $_POST['stdContactNo'];
        $email = $_POST['stdEmail'];
        $gender = $_POST['gender'];
        $oldpass = $_POST['Pass'];
        $newpass = $_POST['conPass'];
        $address = $_POST['stdAddress'];
        $programme = $_POST['programmeID'];
        $lecturer = $_POST['lecturerID'];
        $internBatch = $_POST['internshipBatchID'];
        $tutorial = $_POST['tutorialGroup'];

        if(empty($oldpass)){
            $query = "UPDATE Student SET programmeID='$programme', lecturerID='$lecturer', internshipBatchID='$internBatch',studName='$name',
            studGender='$gender', studEmail='$email', studContactNumber='$phone', studHomeAddress='$address', tutorialGroupNo ='$tutorial' WHERE studentID='$id' ";
            $query_run = mysqli_query($conn, $query);

            if($query_run)
            {
                echo "
                <script>
                    alert('Student details update successfully');
                    document.location.href = 'ky-maintainStud.php';
                </script>
                ";
            }
            else
            {
                echo "
                <script>
                    alert('Student details update failed, please try again.');
                    document.location.href = 'ky-maintainStud.php';
                </script>
                ";
            }
        }

        else{

            $sql="select * from Student where studentID='$id'";
            $result = mysqli_query($conn, $sql);
            
            $row=mysqli_fetch_assoc($result);
                    if (password_verify($oldpass, $row['studPassword'])){ 
                        if(empty($newpass)){
                            echo '<script>alert("New password is empty. Please enter new password");
                            window.history.back(1);
                            </script>';
                        }
                        else{
                            $hash = password_hash($newpass, PASSWORD_DEFAULT);
                            $query2 = "UPDATE Student SET programmeID='$programme', lecturerID='$lecturer', internshipBatchID='$internBatch',studName='$name',
                            studGender='$gender', studEmail='$email', studContactNumber='$phone', studHomeAddress='$address', tutorialGroupNo ='$tutorial', studPassword = '$hash' WHERE studentID='$id' ";
                            $result2 = mysqli_query($conn, $query2);
                            if($result2)
                            {
                                echo "
                                <script>
                                    alert('Student details update successfully');
                                    document.location.href = 'ky-maintainStud.php';
                                </script>
                                ";
                            }
                            else
                            {
                                echo "
                                <script>
                                    alert('Student details update failed, please try again.');
                                    document.location.href = 'ky-maintainStud.php';
                                </script>
                                ";
                            }
                        }
                    } 
                    else{
                        echo '<script>alert("Old password is incorrect. Password update unsuccessful");
                            window.history.back(1);
                        </script>';
                    }
                
        }
    }


    

if(isset($_GET['companyID']) && isset($_GET['cmpContactNo']) && isset($_GET['cmpEmail']) && isset($_GET['cmpContactPerson']) && isset($_GET['cmpAddress']) && isset($_GET['cmpState']) && isset($_GET['cmpPostcode']) && isset($_GET['cmpCity']) && isset($_GET['cmpSize']) && isset($_GET['cmpHiddenFieldsArea']) && isset($_GET['cmpAverageAllowanceGiven']) && isset($_GET['submit'])){

    try{
        $cmpID = $_GET['companyID'];
        $cmpContactNo = trim($_GET['cmpContactNo']);
        $cmpEmail = $_GET['cmpEmail'];
        $cmpContactPerson = trim($_GET['cmpContactPerson']);
        $cmpAddress = trim($_GET['cmpAddress']);
        $cmpState = $_GET['cmpState'];
        $cmpPostCode = $_GET['cmpPostcode'];
        $cmpCity = trim($_GET['cmpCity']);
        $cmpSize = $_GET['cmpSize'];
        $cmpFieldsArea = trim($_GET['cmpHiddenFieldsArea']);
        $allowance = $_GET['cmpAverageAllowanceGiven'];
        //$iniPass = $_GET['iniPass'];
        //$newPass = $_GET['newPass'];

        if($cmpSize == 'Micro'){
            $cmpNumberOfInternshipPlacements = 2;
        }else if($cmpSize == 'Small'){
            $cmpNumberOfInternshipPlacements = 8;
        }else if($cmpSize == 'Medium'){
            $cmpNumberOfInternshipPlacements = 20;
        }else if($cmpSize == 'Large'){
            $cmpNumberOfInternshipPlacements = 50;
        }
        

        $sql1="select * from Company where companyID='$cmpID'";
        $result1 = mysqli_query($conn, $sql1);
        $row=mysqli_fetch_assoc($result1);
        //if (password_verify($iniPass, $row['cmpPassword'])){

           // $hash = password_hash($newPass, PASSWORD_DEFAULT);
            $query2 = "UPDATE Company SET cmpEmail='$cmpEmail', cmpContactNumber='$cmpContactNo', cmpContactPerson='$cmpContactPerson', 
            cmpCompanySize='$cmpSize', cmpAddress='$cmpAddress', cmpFieldsArea='$cmpFieldsArea', cmpNumberOfInternshipPlacements='$cmpNumberOfInternshipPlacements', 
            cmpState='$cmpState', cmpPostCode='$cmpPostCode', cmpCity='$cmpCity', cmpAverageAllowanceGiven='$allowance' WHERE companyID='$cmpID'  ";
            //cmpAverageAllowanceGiven='$allowance'  ;
            $query_run2 = mysqli_query($conn, $query2);

            if($query_run2)
            {
                echo '<script>alert("Company details update and comfirm successful."); 
                        </script>';
                header("Location: ../../view/page/ky-maintainCmp.php?update=1&success=1");
            }
            else
            {
                echo '<script>alert("Company details update and comfirm failed."); 
                        </script>';
                header("Location: ../../view/page/ky-enterCmpDetails.php?update=0&failed=1");
            }
        //}
        //else{
            //echo '<script>alert("Initial password is incorrect.");
            
                  //          window.history.back(1);
                  //     </script>';
                
       // }
        
        exit(0);
    }catch(PDOException $e){
        echo '<script>alert("Company details update and comfirm failed."); 
                        </script>';
        header("Location: ../../view/page/ky-enterCmpDetails.php?failed=1");
    }
}

?>


                       