<?php
require '../../../config/email.php';

$server = "localhost";
$username = "root";
$password = "";
$database = "westorn";

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn){
    die("Error". mysqli_connect_error());
}

if(isset($_POST['submit'])){

    $id = $_POST['id'];
    $query = "UPDATE student SET studAccountStatus ='Invited' WHERE studentID='$id' ";
    $query_run = mysqli_query($conn, $query);

    $mailConfig = new EmailConfig();
    $content="Your initial pass is ";
    $name = $_POST['username'];
    $a=substr ($name,0,3);
    $m=date('m');
    $y=date('y');
    $d=date('d');
    $pass=$content.$a.$m.$y.$d;
    //? This is for single email
    $success = $mailConfig->singleEmail($_POST['email'], "Registration invitation", $pass);

    if($success){
        echo "
        <script>
            alert('Email sent');
            document.location.href = 'ky-intStudRegister.php';
        </script>
        ";
    }
}
?>