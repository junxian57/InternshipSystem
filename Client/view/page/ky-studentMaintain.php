<?php
session_start();
error_reporting(0);
include('../../includes/db_connection.php');
?>
<!DOCTYPE HTML>
<html>

<head>
<title>ITP SYSTEM</title>
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <link href="../../css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="../../css/style.css" rel='stylesheet' type='text/css' />
    <link href="../../css/font-awesome.css" rel="stylesheet">
    <script src="../../js/jquery-1.11.1.min.js"></script>
    <script src="../../js/modernizr.custom.js"></script>
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href="../../css/animate.css" rel="stylesheet" type="text/css" media="all">
    <script src="../../js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <script src="../../js/metisMenu.min.js"></script>
    <script src="../../js/custom.js"></script>
    <link href="../../css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="../../scss/ky-cmpStudMaintain.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.co">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    


</head>
<?php
 session_start();
 if(isset($_SESSION['adminloggedin']) && $_SESSION['adminloggedin']==true){
    $adminloggedin= true;
    $id = $_SESSION['studentID'];
 }

 $db = new DBController();
                                        
 $sql = "select * from Student where studentID ='$id'"; 
 $result = $db->runQuery($sql);
    
 if(count($result) > 0){
    foreach ($result as $Student) {
        $Id = $Student['studentID'];
        $programme = $Student['programmeID'];
        $lecturer = $Student['lecturerID'];
        $internBatch = $Student['internshipBatchID'];
        $username = $Student['studName'];
        $gender = $Student['studGender'];
        $email = $Student['studEmail'];
        $phone = $Student['studContactNumber'];
        $address = $Student['studHomeAddress'];
        $dateJoined = $Student['studDateJoined'];
        $applicationQuota = $Student['studApplicationQuota'];
        $currentApplication = $Student['studCurrentNoOfApp'];
        $status = $Student['studAccountStatus'];
    }
}

?>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once('../../includes/sidebar.php'); ?>
        <?php include_once('../../includes/header.php'); ?>
        <div id="page-wrapper">
            <div class="main-page">
                <div class="container">
                    <div class="forms">
                        <h3 class="page-title">Student Details</h3>
                        <div class="form-grids row widget-shadow" data-example-id="basic-forms">

                            <div class="content">
                                <form action="ky-createCV.php" method="post">
                                    <div class="user-details">
                                    <div class="title">
                                        <h2 class="title-1">Student Name & Contact</h2>
                                    </div>

                                    <div class="labal">
                                        <label class="label1">Student Id :</label>
                                        <label class="label2" style="margin-left: 535px;">Name :</label>
                                    </div>

                                    <div class="input-style name-address-group">
                                        <input type="text"  placeholder="Student ID" name="stdID" value="<?php echo $Id ?>" required readonly > 
                                        <input type="text"  placeholder="Student Name" name="stdName" value="<?php echo $username ?>" required >                  
                                    </div>

                                    <div class="labal">
                                        <label class="label1">Contact No :</label>
                                        <label class="label2" style="margin-left: 528px;">Email :</label>
                                    </div>

                                    <div class="input-style name-address-group">
                                        <input type="text" placeholder="Contact No." name="stdContactNo" value="<?php echo $phone ?>" required readonly>   
                                        <input type="email" placeholder="Email" name="stdEmail" value="<?php echo $email ?>" required readonly>             
                                    </div>

                                    <div class="labal" style="margin-bottom: 10px;">
                                        <label class="label1">Gender :</label>
                                    </div>

                                    <div class="gender-group">
                                        
                                        <input type="radio" name="gender" value="Male" id="dot-1" <?php echo $gender =="Male"?
                                        "checked=checked":""?> />Male
                                        <input type="radio" name="gender" value="Female" id="dot-2" <?php echo $gender =="Female"?
                                            "checked=checked":""?> />Female
                                    </div>

                                    <div class="title">
                                        <h2 class="title-4">Password</h2>
                                    </div>

                                    <div class="labal">
                                        <label class="label1">Old Password :</label>
                                        <label class="label2" style="margin-left: 508px;">New Password :</label>
                                    </div>

                                    <div class="input-style name-address-group">
                                        <input type="Password" placeholder="Old Password" name="Pass" required>
                                    
                                        <input type="Password" placeholder="New Password" name="conPass" required> 
                                    </div>
                                     

                                    <div class="title" style="margin-top: 30px;">
                                        <h2 class="title-4" >Address</h2>
                                    </div>
                                    
                                    <div class="input-style name-address-group" style="margin-top: 30px;">
                                        <input type="text" style="width: 100%;" name="stdAddress" placeholder="Address" value="<?php echo $address ?>" required>
                                    </div>

                                    <div class="title" style="margin-top: 30px;">
                                        <h2 class="title-3">Academic Details</h2>
                                    </div>
                                    
                                    <div class="labal">
                                        <label class="label1">Programme ID:</label>
                                        <label class="label2" style="margin-left: 510px;">Lecturer ID:</label>
                                    </div>

                                    <div class="input-style name-address-group">
                                        <input type="text" placeholder="Enter your programme id" name="programmeID" value="<?php echo $programme ?>" required>

                                        <input type="text" placeholder="Enter your lecturer id" name="lecturerID" value="<?php echo $lecturer ?>" required>
                                        
                                    </div>

                                    <div class="labal">
                                        <label class="label1">Internship Batch :</label>
                                    
                                    </div>

                                    <div class="input-style name-address-group">
                                        <input type="text" placeholder="Enter your internship batch" name="internshipBatchID" value="<?php echo $internBatch ?>" required>

                                    </div>

                                    <div class="title" style="margin-top: 30px;">
                                        <h2 class="title-4">CV Details</h2>
                                    </div>

                                    <div class="input-style name-address-group">
                                        <input type="text" style="width: 100%;" placeholder="Career objectives" name="objectives" required>         
                                    </div>

                                    <div class="input-style name-address-group">
                                        <input type="text" style="width: 100%;" placeholder="Work Experience" name="workExperience" required >         
                                    </div>

                                    <div class="input-style name-address-group">
                                        <textarea type="text" name="skill" placeholder="Skills" cols="30" rows="4" required></textarea>
                                    </div>

                                    <div class="input-style name-address-group">
                                        <textarea type="text" name="Language" placeholder="Languages" cols="30" rows="4" required></textarea>
                                    </div>

                                    <div class="input-style name-address-group">
                                        <input type="text" style="width: 100%;" placeholder="Education" name="education" required>         
                                    </div>

                                    <div class="input-style name-address-group">
                                        <input type="text" style="width: 100%;" placeholder="School or University" name="school" required>         
                                    </div>

                                    <div class="input-style name-address-group">
                                        <input type="text" style="width: 100%;" placeholder="CGPA" name="cgpa" required>         
                                    </div>

                                    <div class="input-style name-address-group">
                                        <input type="text" style="width: 100%;" placeholder="EXTRACURRICULAR ACTIVITIES" name="extraActivities" required>         
                                    </div>

                                    <div class="title" style="margin-top: 30px;">
                                        <h2 class="title-4">Upload CV</h2>
                                    </div>

                                    <div class="wrapper">
                                        <form action="ky-CVupload.php" method="post" enctype="multipart/form-data">
                                            <Input type="file" name="fuResume" id="fuResume" hidden>
                                            
                                        </form>
                                    </div>
                                        
                                    <div class="button-group">
                                        <a class="clickable-btn Update" href="">Update</a>
                                        <a class="clickable-btn Export" href="">Cancel</a>
                                        <button type = "submit" name="createCV" class="submit-btn">Create</button>
                                    </div>


                                </form>
                            </div>
                         
                           
                        </div>

                    </div>
                </div>
            </div>
        </div>
        
</body>
    
<script>
    var state= false;
    function toggle(){
        if (state){
            document.getElementById(
                "passsword").
                setAttribute("type",
                "password");
                document.getElementById(
                    "eye").style.color='#7a797e';
                state = false;
        }
        else{
            document.getElementById(
                "password").
                setAttribute("type",
                "text");
                document.getElementById(
                    "eye").style.color='#5887ef';
                    state = true;
        }
    }
</script>
<script src="../../js/classie.js"></script>
<script src="../../js/bootstrap.js"> </script>
<script>
    let menuLeft = document.getElementById('cbp-spmenu-s1'),
        showLeftPush = document.getElementById('showLeftPush'),
        body = document.body;

    showLeftPush.onclick = function() {
        classie.toggle(this, 'active');
        classie.toggle(body, 'cbp-spmenu-push-toright');
        classie.toggle(menuLeft, 'cbp-spmenu-open');
        disableOther('showLeftPush');
    };

    function disableOther(button) {
        if (button !== 'showLeftPush') {
            classie.toggle(showLeftPush, 'disabled');
        }
    }
</script>
<script>
    function searchInTable() {
        let input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("keyInput");
        filter = input.value;
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    //Search Result on Search Bar
    function inputSearchResult() {
        const getSearchResultArr = document.getElementsByClassName('search-result');
        const getSearchBar = document.getElementById('searchBar');
        const getResultBox = document.querySelector('.result-box');

        if (getSearchResultArr.length > 0) {
            for (let i = 0; i < getSearchResultArr.length; i++) {
                getSearchResultArr[i].addEventListener('click', (btn) => {
                    getSearchBar.value = btn.target.innerText;
                    getResultBox.style.display = 'none';
                });
            }
        } else {
            return;
        }
    }

    function removeAllChildNodes(parent) {
        while (parent.firstChild) {
            parent.removeChild(parent.firstChild);
        }
    }

    async function displaySearchResult() {
        const getResultBox = document.querySelector('.result-box');
        const respondResult = await searchBarData();
        let resultArr = [];

        if (respondResult === null || respondResult === undefined || respondResult.length == 0) {
            getResultBox.style.display = 'none';
            return;
        }
        //Clear the existing box
        removeAllChildNodes(getResultBox);

        if (respondResult !== null || respondResult !== undefined || respondResult.length != 0) {
            for (let i = 0; i < Object.keys(respondResult).length; i++) {
                resultArr[i] =
                    `<li class='search-result'>${respondResult[i].employeeID}: ${respondResult[i].fullName}</li>`;
            }
        } else {
            getResultBox.style.display = 'none';
            return;
        }

        getResultBox.style.display = 'block';
        getResultBox.innerHTML = resultArr.join('');
        inputSearchResult();
    }

    async function searchBarData() {
        const getSearchInput = document.getElementById('searchBar').value;
        const getResultBox = document.querySelector('.result-box');
        let url;

        if (getSearchInput == '') {
            getResultBox.style.display = 'none';
            return;
        } else {
            if (Number.isInteger(parseInt(getSearchInput))) {
                url = '../php-inc/ajaxSearchEmployee.php?icNo=' + getSearchInput;
            } else {
                url = '../php-inc/ajaxSearchEmployee.php?fullName=' + getSearchInput;
            }
            const response = await fetch(url);
            const data = await response.json();
            return data;
        }
    }
</script>


</html>