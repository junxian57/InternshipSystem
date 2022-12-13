<?php
require '../../../config/email.php';

$host = "sql444.main-hosting.eu";
$user = "u928796707_group34";
$password = "u1VF3KYO1r|";
$database = "u928796707_internshipWeb";

$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn){
    die("Error". mysqli_connect_error());
}

if(isset($_POST['submit'])){

    $id = $_POST['id'];
    $username = $_POST['username'];

    $sql = "select * from Student WHERE studentID='$id'";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $email = $row['studEmail'];
    }

    $query = "UPDATE Student SET studAccountStatus ='InitialPass' WHERE studentID='$id' ";
    $query_run = mysqli_query($conn, $query);

    $mailConfig = new EmailConfig();
    $name = $_POST['username'];
    $a=substr ($name,0,3);
    $m=date('m');
    $y=date('y');
    $d=date('d');
    $pass=$a.$m.$y.$d;
    
    $passMessage='<html>
    <p>Dear '.$username.', You have been invited to register in ITP system.</p>
    <p>Your email is <b style="color:green;">'.$email.'</b> and initial password is <b style="color:green;">'.$pass.'</b></p>
    <p>Please login with your email and initial password, change your password immediately after login.</p>
    <p><a href = "http://localhost/InternshipSystem/Client/view/page/clientLogin.php?">Clic here to login</a></p>
    </html>';
    
    //? This is for single email
    $success = $mailConfig->singleEmail($_POST['email'], "Registration invitation", $passMessage);

    $hash = password_hash($pass, PASSWORD_DEFAULT);

    if($success){
        $query2 = "UPDATE Student SET studPassword ='$hash' WHERE studentID='$id' ";
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