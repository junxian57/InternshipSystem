<?php
$host = "sql444.main-hosting.eu";
$user = "u928796707_group34";
$password = "u1VF3KYO1r|";
$database = "u928796707_internshipWeb";

$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn){
    die("Error". mysqli_connect_error());
}

    if(isset($_POST['updatedata']))
    {   
        $id = $_POST['update_id'];
        $name = $_POST['cmpName'];
        $email = $_POST['email'];
        $phone = $_POST['ContactNo'];
        $address = $_POST['cmpAddress'];
        $placement = $_POST['cmpPlacement'];
        $username = $_POST['cmpContactPerson'];
        $size = $_POST['cmpSize'];
        $fields = $_POST['cmpFields'];
        $allowance = $_POST['allowance'];
        $dateJoined = $_POST['dateJoined'];
        $status = $_POST['status'];
        $rating = $_POST['rating'];
        $cmpCity = $_POST['cmpCity'];
        $cmpPostCode = $_POST['cmpPostCode'];
        $cmpState = $_POST['cmpState'];
        

        $query = "UPDATE Company SET cmpName='$name', cmpEmail='$email', cmpContactNumber='$phone', cmpContactPerson='$username', cmpCompanySize='$size', cmpAddress='$address', cmpFieldsArea='$fields', cmpNumberOfInternshipPlacements='$placement', cmpAverageAllowanceGiven='$allowance', cmpDateJoined='$dateJoined', cmpAccountStatus='$status', cmpRating='$rating', cmpCity='$cmpCity', cmpPostCode='$cmpPostCode', cmpState='$cmpState' WHERE companyID='$id'  ";
        $query_run = mysqli_query($conn, $query);

        if($query_run)
        {
            echo "<script> 
            alert('Company details Updated'); 
            window.location.href = 'ky-cmpMaintain.php';
           
            </script>";
        }
        else
        {
            echo "<script> 
            alert('Company details Update failed'); 
            window.location.href = 'ky-cmpMaintain.php';
           
            </script>";
        }
    }
?>