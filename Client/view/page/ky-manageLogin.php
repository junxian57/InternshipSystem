<?php
$host = "sql444.main-hosting.eu";
$user = "u928796707_group34";
$password = "u1VF3KYO1r|";
$database = "u928796707_internshipWeb";

$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn){
    die("Error". mysqli_connect_error());
}

    if(isset($_POST['LOGIN']))
    {   
        $id = $_POST['userId'];
        $password = $_POST['password'];
        
        $sql="select * from Student where studentID='$id'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if ($num == 1){
            $row=mysqli_fetch_assoc($result);
            
                if (password_verify($password, $row['studPassword'])){ 

                    session_start();
                    $_SESSION['adminloggedin'] = true;
                    //$_SESSION['adminusername'] = $username;
                    $_SESSION['studentID'] = $id;

                    echo "
                    <script>
                        alert('You Have Successfully Logged in');
                        document.location.href = 'ky-enterStudDetails.php';
                    </script>
                    ";

                    //$sql1="UPDATE Student SET studAccountStatus='Active' where studentID='$id'";
                    //$result1 = mysqli_query($conn, $sql1);
                } 
                else{
                    echo "
                    <script>
                        alert('Wrong id or password');
                        document.location.href = 'ky-studLogin.php';
                    </script>
                    ";
                }
        }

        else
        {
            echo "
            <script>
                alert('Login unsuccessful');
                document.location.href = 'ky-studLogin.php';
            </script>
            ";
        }
    }
?>