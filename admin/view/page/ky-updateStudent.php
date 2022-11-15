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
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $programme = $_POST['programme'];
        $address = $_POST['address'];

        $query = "UPDATE student SET studName='$name', studGender='$gender', studEmail='$email', studContactNumber=' $phone', programmeID=' $programme', studHomeAddress=' $address' WHERE studentID='$id'  ";
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