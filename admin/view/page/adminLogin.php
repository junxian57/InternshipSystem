<?php
if(session_status() != PHP_SESSION_ACTIVE) session_start();
    
    if(isset($_GET['passwordChangeSuccess'])){
        echo "<script>
        alert('Password Changed Successfully!')
        window.location.href = 'adminLogin.php';
        </script>";
    }

    if(isset($_SESSION['adminID']) || isset($_SESSION['committeeID'])){
        header("Location: ../../view/page/br-cmpAppTableReview.php");
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
    <title>Admin Login</title>
    <link rel="stylesheet" href="../../scss/adminLogin.css">
</head>
<body>
    <div class="outerBox">
        <div class="tab">
            <div class="button-group">
                <button id="defaultOpen" class="tablinks" onclick="changeTab(event, 'itp-committee', this)">ITP Committee</button>
                <div class="coverSpan">
                    <span class="span-1">></span>
                    <span class="span-2">></span>
                    <span class="span-3">></span>      
                    <span class="span-4">></span>          
                </div>
            </div>

            <div class="button-group second">
                <button class="tablinks" onclick="changeTab(event, 'admin', this)">Administrator</button>
                <div class="coverSpan">
                    <span class="span-1">></span>
                    <span class="span-2">></span>
                    <span class="span-3">></span>
                    <span class="span-4">></span> 
                </div>
            </div>
        </div>

        <div id="vertical-line"></div>
          
        <div id="itp-committee" class="tabcontent">
            <form action="#" method="post">
                <div class="labelInput">
                    <label for="itpEmail">ITP Committee Email</label>
                    <input type="email" name="itpEmail" id="itpEmail" required>
                </div>
                <div class="labelInput">
                    <label for="itpPass">Password</label>
                    <input type="password" name="itpPass" id="itpPass" required>
                </div>
                <div class="button-group-inner">
                    <input type="button" name="submitITP" value="Login" onclick="login('itp-committee')">
                </div>
            </form>
        </div>
        
        <div id="admin" class="tabcontent">
            <form action="#" method="post">
                <div class="labelInput">
                    <label for="adminEmail">Administrator Email or Username</label>
                    <input type="text" name="adminEmail" id="adminEmail" required>
                </div>
                <div class="labelInput">
                    <label for="adminPass">Password</label>
                    <input type="password" name="adminPass" id="adminPass" required>
                </div>
                <div class="button-group-inner">
                    <input type="button" name="submitAdmin" value="Login" id="specialButton" onclick="login('admin')">
                </div>
            </form>
        </div>
            </form>
        </div>
    </div>
</body>
<script>
    document.getElementById('defaultOpen').click();

    function changeTab(evt, tabName, buttonObj) {
        let i, tabcontent, tablinks;

        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.querySelectorAll(".tabcontent");
        tabcontent.forEach(i => {
            i.style.display = "none";
        });

        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.querySelectorAll(".tablinks");
        tablinks.forEach(i => {
            i.classList.remove("active");
            i.removeAttribute('style');

           let getSpan = i.nextElementSibling.querySelectorAll('span');

            for(let i = 0; i < getSpan.length; i++) {
                getSpan[i].style.display = "none";
            }
        });

        // Show the current tab, and add an "active" class to the button that opened the tab
        document.getElementById(tabName).style.display = "flex";

        let getSpan = buttonObj.nextElementSibling.querySelectorAll('span');

       for(let i = 0; i < getSpan.length; i++) {
            getSpan[i].style.display = "unset";
       }
        
        evt.currentTarget.className += " active";
        evt.currentTarget.style.backgroundColor = 'white';

        if(evt.currentTarget.parentElement.classList.contains('second')) {
            evt.currentTarget.style.color = '#313e85';
        } else {
            evt.currentTarget.style.color = '#f2891f';
        }
    }

     //Login Function
     async function login(tabName) {
        if(tabName == 'itp-committee'){
            let itpEmail = document.getElementById('itpEmail').value;
            let itpPass = document.getElementById('itpPass').value;
            
            if(itpEmail == '' || itpPass == '') {
                info('Please fill in all fields');
            } else {
                if(!validateEmailFormat(itpEmail)){
                    emptyInputValue(tabName);
                    warning('Please enter a valid email address');
                    return;
                }

                await validateLogin(tabName, itpEmail, itpPass)
            }

        }else if(tabName == 'admin'){
            let adminEmail = document.getElementById('adminEmail').value;
            let adminPass = document.getElementById('adminPass').value;

            if(adminEmail == '' || adminPass == '') {
                info('Please fill in all fields');
            } else {

                await validateLogin(tabName, adminEmail, adminPass)
            }
        }
    }

    async function validateLogin(tabName, email, password) {
        let url = "../../app/DAL/ajaxAdminLogin.php";

        //Change URL based on tabName
        if(tabName == 'itp-committee'){
            url += "?itpCommittee&itpEmail=" + email + "&itpPass=" + password;
        }else if(tabName == 'admin'){
            url += "?admin&adminEmail=" + email + "&adminPass=" + password;
        }

        let response = await fetch(url).then(response => response.json());

        if(response == 'Wrong Email Format'){
            warning('Please enter a valid email address');

        }else if(response == 'Wrong Password' || response == 'Email Not Found'){
            warning('Wrong Email or Password');

        }

       emptyInputValue(tabName);
    }

    function validateEmailFormat(email){
        let emailFormat = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        return emailFormat.test(email);
    }

    function emptyInputValue(tabName){
        if(tabName == 'itp-committee'){
            document.getElementById('itpEmail').value = '';
            document.getElementById('itpPass').value = '';
        }else if(tabName == 'admin'){
            document.getElementById('adminEmail').value = '';
            document.getElementById('adminPass').value = '';
        }
    }
</script>
</html>