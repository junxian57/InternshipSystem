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
        $name = $_POST['studName'];
        $programme = $_POST['programme'];
        $lecturer = $_POST['lecturer'];
        $phone = $_POST['phone'];
        $internBatch = $_POST['internBatch'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $dateJoined = $_POST['dateJoined'];
        $appQuota = $_POST['appQuota'];
        $currentApp = $_POST['currentApp'];
        $status = $_POST['status'];

        $query = "UPDATE student SET programmeID='$programme', lecturerID='$lecturer', internshipBatchID='$internBatch',studName='$name',
        studGender='$gender', studEmail='$email', studContactNumber='$phone', studHomeAddress='$address', studDateJoined='$dateJoined', studApplicationQuota='$appQuota', studCurrentNoOfApp='$currentApp', studAccountStatus='$status' WHERE studentID='$id' ";
        $query_run = mysqli_query($conn, $query);

        if($query_run)
        {
            echo '<script> alert("Data Updated"); </script>';
            header("Location:ky-studentMaintain.php");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
    }
?>