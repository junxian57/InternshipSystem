<?php
    if(isset($_GET['passwordNotMatch'])){
        echo "<script>alert('New Password Not Match')</script>";
    }elseif(isset($_GET['wrongPassword'])){
        echo "<script>alert('Wrong Current Password')</script>";
    }elseif(isset($_GET['passwordChanged'])){
        header("Location: clientLogin.php?passwordChangeSuccess");
    }elseif(isset($_GET['notAllowed'])){
        echo "<script>
            alert('Please Change The Initial Password Before Using The System')
        </script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <script src="../../js/jquery-1.11.1.min.js"></script>
    <script src="../../js/toastr.min.js"></script>
    <link href="../../css/toastr.min.css" rel="stylesheet">
    <script src="../../js/customToastr.js"></script>
    <title>Change Password</title>
    <link rel="stylesheet" href="../../scss/changePassword.css">
</head>
<body>
    <div class="outerBox">
        <div id="Student" class="tabcontent">
            <h3>Change <?php echo isset($_GET['requireChangePass']) ? '<span style="text-decoration:underline; text-decoration-color:#f2891f;">Initial</span>' : ''?> Password</h3>
        <form action="../../app/DAL/changePasswordDAL.php" method="post" onsubmit="return validatePassword()">
                <div class="labelInput">
                    <label for="currentPass">Current Password</label>
                    <input type="password" name="currentPass" id="currentPass" required>
                </div>
                <div class="labelInput">
                    <label for="newPass">New Password</label>
                    <input type="password" name="newPass" id="newPass" required>
                </div>
                <div class="labelInput">
                    <label for="confirmNewPass">Confirm Password</label>
                    <input type="password" name="confirmNewPass" id="confirmNewPass" required>
                </div>
                <div class="button-group-inner">
                    <input type="submit" id="changePass" name="changePass" value="Change Password">
                </div>
            </form>
        </div>
    </div>
</body>
<script>
     function validatePassword(){
        let newPass = document.getElementById('newPass').value;
        let confirmNewPass = document.getElementById('confirmNewPass').value;

        if(newPass !== confirmNewPass){
            warning('New Password Does Not Match');
            document.getElementById('newPass').value = '';
            document.getElementById('confirmNewPass').value = '';
            return false;
        }else{
            return true;
        }
    }
</script>
</html>