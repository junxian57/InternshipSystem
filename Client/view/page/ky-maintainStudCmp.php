<?php
    $host = "sql444.main-hosting.eu";
    $user = "u928796707_group34";
    $password = "u1VF3KYO1r|";
    $database = "u928796707_internshipWeb";
    
    $conn = mysqli_connect($host, $user, $password, $database);
    if (!$conn){
        die("Error". mysqli_connect_error());
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
            $oldPass = $_GET['iniPass'];
            $newPass = $_GET['newPass'];
    
            if($cmpSize == 'Micro'){
                $cmpNumberOfInternshipPlacements = 2;
            }else if($cmpSize == 'Small'){
                $cmpNumberOfInternshipPlacements = 8;
            }else if($cmpSize == 'Medium'){
                $cmpNumberOfInternshipPlacements = 20;
            }else if($cmpSize == 'Large'){
                $cmpNumberOfInternshipPlacements = 50;
            }
            
            if(empty($oldPass)){
                $query = "UPDATE Company SET cmpEmail='$cmpEmail', cmpContactNumber='$cmpContactNo', cmpContactPerson='$cmpContactPerson', 
                cmpCompanySize='$cmpSize', cmpAddress='$cmpAddress', cmpFieldsArea='$cmpFieldsArea', cmpNumberOfInternshipPlacements='$cmpNumberOfInternshipPlacements', 
                cmpState='$cmpState', cmpPostCode='$cmpPostCode', cmpCity='$cmpCity', cmpAverageAllowanceGiven='$allowance' WHERE companyID='$cmpID'  ";
                $query_run = mysqli_query($conn, $query);
    
                if($query_run)
                {
                    echo "
                    <script>
                        alert('Student details update successfully');
                        document.location.href = 'ky-maintainCmp.php';
                    </script>
                    ";
                }
                else
                {
                    echo "
                    <script>
                        alert('Student details update failed, please try again.');
                        document.location.href = 'ky-maintainCmp.php';
                    </script>
                    ";
                }
            }
            else{
                $sql="select * from Company where companyID='$cmpID'";
                $result = mysqli_query($conn, $sql);
                $row=mysqli_fetch_assoc($result);
                if (password_verify($oldPass, $row['cmpPassword'])){
                    if(empty($newPass)){
                        echo '<script>alert("New password is empty. Please enter new password");
                        window.history.back(1);
                        </script>';
                    }
                    else{
                        $hash = password_hash($newPass, PASSWORD_DEFAULT);
                        $query1 = "UPDATE Company SET cmpEmail='$cmpEmail', cmpContactNumber='$cmpContactNo', cmpContactPerson='$cmpContactPerson', 
                        cmpCompanySize='$cmpSize', cmpAddress='$cmpAddress', cmpFieldsArea='$cmpFieldsArea', cmpNumberOfInternshipPlacements='$cmpNumberOfInternshipPlacements', 
                        cmpState='$cmpState', cmpPostCode='$cmpPostCode', cmpCity='$cmpCity', cmpAverageAllowanceGiven='$allowance', cmpPassword='$hash' WHERE companyID='$cmpID'  ";
                        //cmpAverageAllowanceGiven='$allowance'  ;
                        $query_run1 = mysqli_query($conn, $query1);
    
                        if($query_run1)
                        {
                            echo '<script>alert("Company details update and comfirm successful."); 
                                    </script>';
                            header("Location: ../../view/page/ky-maintainCmp.php?update=1&success=1");
                        }
                        else
                        {
                            echo '<script>alert("Company details update and comfirm failed."); 
                                    </script>';
                            header("Location: ../../view/page/ky-maintainCmp.php?update=0&failed=1");
                        }
                    }
                }
                else{
                    echo '<script>alert("Old password is incorrect. Password update unsuccessful");
                                    window.history.back(1);
                                </script>';
                }
            
            }
            
            exit(0);
        }catch(PDOException $e){
            echo '<script>alert("Company details update and comfirm failed."); 
                            </script>';
            header("Location: ../../view/page/ky-maintainCmp.php?failed=1");
        }
    } 
?>
