<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "westorn";

$conn = mysqli_connect($server, $username, $password, $database);
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
        $username = $_POST['cmpUserName'];
        $size = $_POST['cmpSize'];
        $fields = $_POST['cmpFields'];
        $allowance = $_POST['allowance'];
        $dateJoined = $_POST['dateJoined'];
        $status = $_POST['status'];

        $query = "UPDATE company SET cmpName='$name', cmpEmail='$email', cmpContactNumber='$phone', cmpUsername=' $username', cmpCompanySize=' $size', cmpAddress=' $address', cmpFieldsArea=' $fields', cmpNumberOfInternshipPlacements='$placement', cmpAverageAllowanceGiven='$allowance', cmpDateJoined='$dateJoined', cmpAccountStatus='$status' WHERE companyID='$id'  ";
        $query_run = mysqli_query($conn, $query);

        if($query_run)
        {
            echo '<script> alert("Data Updated"); </script>';
            header("Location:ky-cmpMaintain.php");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
    }
?>