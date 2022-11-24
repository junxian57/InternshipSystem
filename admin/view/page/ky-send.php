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
    $username = $_POST['username'];
    $query = "UPDATE student SET studAccountStatus ='Invited' WHERE studentID='$id' ";
    $query_run = mysqli_query($conn, $query);

    $mailConfig = new EmailConfig();
    $name = $_POST['username'];
    $a=substr ($name,0,3);
    $m=date('m');
    $y=date('y');
    $d=date('d');
    $pass=$a.$m.$y.$d;
    //link has problem
    $passMessage='<html>
    <p>Dear '.$username.', You have been invited to register in ITP system.</p>
    <p>Your id is '.$id.' and initial password is '.$pass.'</p>
    <p>Please change your password immediately after login.</p>
    <p><a herf = "http://localhost/InternshipSystem/Client/view/page/ky-studLogin.php?">Clic here to login</a></p>
    </html>';
    
    //? This is for single email
    $success = $mailConfig->singleEmail($_POST['email'], "Registration invitation", $passMessage);

    $hash = password_hash($pass, PASSWORD_DEFAULT);

    if($success){
        $query2 = "UPDATE student SET studPassword ='$hash' WHERE studentID='$id' ";
        $query_run = mysqli_query($conn, $query2);

        echo "
        <script>
            alert('Invitation email sent');
            document.location.href = 'ky-intStudRegister.php';
        </script>
        ";
    }
}
?>