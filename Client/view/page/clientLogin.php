<?php
if (session_status() != PHP_SESSION_ACTIVE) session_start();

if (isset($_GET['passwordChangeSuccess'])) {
    echo "<script>
        alert('Password Changed Successfully!')
        window.location.href = 'clientLogin.php';
        </script>";
}

if (isset($_SESSION['studentID'])) {
    header("Location: ../../view/page/ky-enterStudDetails.php");
} elseif (isset($_SESSION['lecturerID'])) {
    header("Location: ../../view/page/br-StudentSupervisor-Manage.php");
} elseif (isset($_SESSION['companyID'])) {
    header("Location: ../../view/page/ky-enterCmpDetails.php");
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
    <title>Client Login</title>
    <link rel="stylesheet" href="../../scss/clientLogin.css">
</head>

<body>
    <div class="outerBox">
        <div class="tab">
            <div class="button-group">
                <button id="defaultOpen" class="tablinks" onclick="changeTab(event, 'Student', this)">Student</button>
                <div class="coverSpan">
                    <span class="span-1">></span>
                    <span class="span-2">></span>
                    <span class="span-3">></span>
                    <span class="span-4">></span>
                </div>
            </div>

            <div class="button-group second">
                <button class="tablinks" onclick="changeTab(event, 'Lecturer', this)">Lecturer</button>
                <div class="coverSpan">
                    <span class="span-1">></span>
                    <span class="span-2">></span>
                    <span class="span-3">></span>
                    <span class="span-4">></span>
                </div>
            </div>

            <div class="button-group">
                <button class="tablinks" onclick="changeTab(event, 'Company', this)">Company</button>
                <div class="coverSpan">
                    <span class="span-1">></span>
                    <span class="span-2">></span>
                    <span class="span-3">></span>
                    <span class="span-4">></span>
                </div>
            </div>
        </div>

        <div id="vertical-line"></div>

        <div id="Student" class="tabcontent">
            <form action="#" method="post">
                <div class="labelInput">
                    <label for="studentEmail">Student Email</label>
                    <input type="email" name="studentEmail" id="studentEmail" required>
                </div>
                <div class="labelInput">
                    <label for="studentPass">Password</label>
                    <input type="password" name="studentPass" id="studentPass" required>
                </div>
                <div class="button-group-inner">
                    <input type="button" id="submitStud" name="submitStud" value="Login" onclick="login('Student')">
                </div>
            </form>
        </div>

        <div id="Lecturer" class="tabcontent">
            <form action="#" method="post">
                <div class="labelInput">
                    <label for="lecturerEmail">Lecturer Email</label>
                    <input type="email" name="lecturerEmail" id="lecturerEmail" required>
                </div>
                <div class="labelInput">
                    <label for="lecturerPass">Password</label>
                    <input type="password" name="lecturerPass" id="lecturerPass" required>
                </div>
                <div class="button-group-inner">
                    <input type="button" name="submitLecturer" value="Login" id="specialButton" onclick="login('Lecturer')">
                </div>
            </form>
        </div>

        <div id="Company" class="tabcontent">
            <form action="#" method="post">
                <div class="labelInput">
                    <label for="companyAcc">Company Account</label>
                    <input type="text" name="companyAcc" id="companyAcc" required>
                </div>
                <div class="labelInput">
                    <label for="companyPass">Password</label>
                    <input type="password" name="companyPass" id="companyPass" required>
                </div>
                <div class="button-group-inner" id="special">
                    <input type="button" name="submitCompany" value="Login" onclick="login('Company')">
                    <a id="cmpRegistration" href="br-cmpSelfRegister.php">Company Registration</a>
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

            for (let i = 0; i < getSpan.length; i++) {
                getSpan[i].style.display = "none";
            }
        });

        // Show the current tab, and add an "active" class to the button that opened the tab
        document.getElementById(tabName).style.display = "flex";

        let getSpan = buttonObj.nextElementSibling.querySelectorAll('span');

        for (let i = 0; i < getSpan.length; i++) {
            getSpan[i].style.display = "unset";
        }

        evt.currentTarget.className += " active";

        //Set Active Button Background Color
        evt.currentTarget.style.backgroundColor = 'white';

        //Set Active Button Font Color
        if (evt.currentTarget.parentElement.classList.contains('second')) {
            evt.currentTarget.style.color = '#313e85';
        } else {
            evt.currentTarget.style.color = '#f2891f';
        }

        emptyInputValue('Student');
        emptyInputValue('Lecturer');
        emptyInputValue('Company');
    }

    //Login Function
    async function login(tabName) {
        if (tabName == 'Student') {
            let studentEmail = document.getElementById('studentEmail').value;
            let studentPass = document.getElementById('studentPass').value;

            if (studentEmail == '' || studentPass == '') {
                info('Please fill in all fields');
            } else {
                if (!validateEmailFormat(studentEmail)) {
                    emptyInputValue(tabName);
                    warning('Please enter a valid email address');
                    return;
                }

                await validateLogin(tabName, studentEmail, studentPass)
            }

        } else if (tabName == 'Lecturer') {
            let lecturerEmail = document.getElementById('lecturerEmail').value;
            let lecturerPass = document.getElementById('lecturerPass').value;

            if (lecturerEmail == '' || lecturerPass == '') {
                info('Please fill in all fields');
            } else {
                if (!validateEmailFormat(lecturerEmail)) {
                    emptyInputValue(tabName);
                    return;
                }

                await validateLogin(tabName, lecturerEmail, lecturerPass)
            }

        } else if (tabName == 'Company') {
            let companyAcc = document.getElementById('companyAcc').value;
            let companyPass = document.getElementById('companyPass').value;

            if (companyAcc == '' || companyPass == '') {
                info('Please fill in all fields');
            } else {

                await validateLogin(tabName, companyAcc, companyPass)
            }

        }
    }

    async function validateLogin(tabName, email, password) {
        let url = "../../app/DAL/ajaxClientLogin.php";

        //Change URL based on tabName
        if (tabName == 'Student') {
            url += "?student&studentEmail=" + email + "&studentPass=" + password;
        } else if (tabName == 'Lecturer') {
            url += "?lecturer&lecturerEmail=" + email + "&lecturerPass=" + password;
        } else if (tabName == 'Company') {
            url += "?company&companyAcc=" + email + "&companyPass=" + password;
        }

        let response = await fetch(url).then(response => response.json());

        if (response.studentID != null && response.changePassword == true && tabName == 'Student') {
            window.location.href = '../page/clientChangePassword.php?requireChangePass';
        } else if (response.companyID != null && response.changePassword == true && tabName == 'Company') {
            window.location.href = '../page/clientChangePassword.php?requireChangePass';
        }

        if (response == 'Login Successful') {
            if (tabName == 'Student') {
                window.location.href = '../../view/page/ky-enterStudDetails.php';
            } else if (tabName == 'Lecturer') {
                window.location.href = '../../view/page/br-StudentSupervisor-Manage.php';
            } else if (tabName == 'Company') {
                window.location.href = '../../view/page/ky-enterCmpDetails.php';
            }
        } else if (response == 'Wrong Email Format') {
            warning('Please enter a valid email address');

        } else if (response == 'Wrong Password' || response == 'Email Not Found') {
            warning('Wrong Email or Password');

        }

        emptyInputValue(tabName);
    }

    function validateEmailFormat(email) {
        let emailFormat = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        return emailFormat.test(email);
    }

    function emptyInputValue(tabName) {
        if (tabName == 'Student') {
            document.getElementById('studentEmail').value = '';
            document.getElementById('studentPass').value = '';
        } else if (tabName == 'Lecturer') {
            document.getElementById('lecturerEmail').value = '';
            document.getElementById('lecturerPass').value = '';
        } else if (tabName == 'Company') {
            document.getElementById('companyAcc').value = '';
            document.getElementById('companyPass').value = '';
        }
    }
</script>

</html>