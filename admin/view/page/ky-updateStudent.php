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
        $tutorial = $_POST['tutorial'];

        $query = "UPDATE Student SET programmeID='$programme', lecturerID='$lecturer', internshipBatchID='$internBatch',studName='$name',
        studGender='$gender', studEmail='$email', studContactNumber='$phone', studHomeAddress='$address', studDateJoined='$dateJoined', studApplicationQuota='$appQuota', studCurrentNoOfApp='$currentApp', studAccountStatus='$status', tutorialGroupNo='$tutorial' WHERE studentID='$id' ";
        $query_run = mysqli_query($conn, $query);

        if($query_run)
        {
            echo "<script> 
            alert('Student details Updated'); 
            window.location.href = 'ky-studentMaintain.php';
           
            </script>";
        }
        else
        {
            echo "<script> 
            alert('Student details Update failed'); 
            window.location.href = 'ky-studentMaintain.php';
           
            </script>";
        }
    }
?>