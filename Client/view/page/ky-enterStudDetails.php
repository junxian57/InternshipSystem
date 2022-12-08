<?php
session_start();
error_reporting(0);
include('../../includes/db_connection.php');

if(isset($_SESSION['studentChangePass'])){
    header('Location: clientChangePassword.php?requireChangePass&notAllowed');
}
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
    <link rel="stylesheet" href="../../scss/ky-enterCmpStudDetails.css">
   
</head>

<?php
 session_start();
 if(isset($_SESSION['studentloggedin']) && $_SESSION['studentloggedin']==true){
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
        $tutorialGroup = $Student['tutorialGroupNo'];
        $studAppQuota = $Student['studApplicationQuota'];
        $studCurrentApp = $Student['studCurrentNoOfApp'];
    }
}

?>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once('../../includes/sidebar.php'); ?>
        <?php include_once('../../includes/header.php'); ?>
        <div id="page-wrapper">
            <div class="main-page">
                <form action="ky-createCV.php" method="post">
                    <div class="forms">
                        <h3 class="page-title">Change initial password</h3>
                        <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                            <div class="wrapper">
                                <div class="title">
                                    <h2>Password</h2>
                                </div>

                                <div class="horizon-wrap">
                                    <div class="input-style width-45 name-address-group">
                                        <label>Initial Password :</label>
                                        <input type="Password" placeholder="Initial Password" name="Pass" required>  
                                    </div>
                                    <div class="input-style width-45 name-address-group">
                                        <label>New Password :</label>
                                        <input type="Password" placeholder="New Password" name="conPass" required>
                                    </div>
                                </div>
                          
                            </div>
                        </div>
                    </div>

                    <div class="forms" style="margin-top:40px;">
                        <h3 class="page-title">Student Information</h3>
                        <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                            <div class="wrapper">                
                                <div class="title">
                                    <h2>Student Name & Contact</h2>
                                </div>

                                <div class="horizon-wrap">
                                    <div class="input-style width-45 name-address-group">
                                        <label>Student Id :</label>
                                        <input type="text"  placeholder="Student ID" name="stdID" value="<?php echo $Id ?>" required readonly > 
                                    </div>
                                    <div class="input-style width-45 name-address-group">
                                        <label>Name :</label>
                                        <input type="text"  placeholder="Student Name" name="stdName" value="<?php echo $username ?>" required >
                                    </div>     
                                </div>

                                <div class="horizon-wrap">
                                    <div class="input-style width-45 name-address-group">
                                        <label>Contact No :</label>
                                        <input type="text" placeholder="Contact No." name="stdContactNo" value="<?php echo $phone ?>" required>  
                                    </div>
                                    <div class="input-style width-45 name-address-group">
                                        <label>Email :</label>
                                        <input type="email" placeholder="Email" name="stdEmail" value="<?php echo $email ?>" required> 
                                    </div>
                                    
                                </div>

                                <div class="horizon-wrap">
                                    <div class="input-style width-45 name-address-group">
                                        <label>Gender :</label>    
                                        <select type="text" name="gender" id="gender">
                                            <option value="0" disabled>Select a Gender</option>
                                            <option value="Male" <?php echo ($gender =="Male") ? 'selected' : '' ?> >Male</option>
                                            <option value="Female" <?php echo ($gender =="Female") ? 'selected' : '' ?> >Female</option>
                                        </select>
                                    </div>
                                </div>

                                <hr />
                                
                                <div class="title" style="margin-top:20px;">
                                    <h2>Address</h2>
                                </div>
                                
                                <div class="horizon-wrap">
                                    <div class="input-style name-address-group width-100">
                                    <label for="cmpAddress">Student Address</label>
                                    <input type="text" style="width: 100%;" name="stdAddress" placeholder="Address" value="<?php echo $address ?>" required>
                                    </div>
                                </div>

                                <hr />
                                <div class="title" style="margin-top:20px;">
                                    <h2>Academic Details</h2>
                                </div>
                                
                                <div class="horizon-wrap">
                                    <div class="input-style width-45 name-address-group">
                                        <label>Programme ID :</label>
                                        <input type="text" placeholder="Enter your programme id" name="programmeID" value="<?php echo $programme ?>" required>  
                                    </div>
                                    <div class="input-style width-45 name-address-group">
                                        <label>Lecturer ID :</label>
                                        <input type="text" placeholder="Enter your lecturer id" name="lecturerID" value="<?php echo $lecturer ?>" required>
                                    </div>
                                </div>

                                <div class="horizon-wrap">
                                    <div class="input-style width-45 name-address-group">
                                        <label>Internship Batch :</label>
                                        <input type="text" placeholder="Enter your internship batch" name="internshipBatchID" value="<?php echo $internBatch ?>" required>  
                                    </div>
                                    <div class="input-style width-45 name-address-group">
                                        <label>Tutorial Group No :</label>
                                        <input type="text" placeholder="Enter your tutorial group no" name="tutorialGroup" value="<?php echo $tutorialGroup ?>" required>
                                    </div>
                                </div>

                                <div class="horizon-wrap">
                                    <div class="input-style width-45 name-address-group">
                                        <label>Student Application Quota :</label>
                                        <input type="text" name="studAppQuota" value="<?php echo $studAppQuota ?>" required readonly>
                                    </div>
                                    <div class="input-style width-45 name-address-group">
                                        <label>Student Current No of Application :</label>
                                        <input type="text" name="studCurrentApp" value="<?php echo $studCurrentApp ?>" required readonly>
                                    </div>
                                </div>

                                <hr />
                                <div class="title" style="margin-top:20px;">
                                    <h2 class="title-4">CV Details</h2>
                                </div>

                                <div class="horizon-wrap">
                                    <div class="input-style name-address-group width-100">
                                    <label for="cmpAddress">Career objectives :</label>
                                    <input type="text" style="width: 100%;" placeholder="Career objectives" name="objectives" required>
                                    </div>
                                </div>

                                <div class="horizon-wrap">
                                    <div class="input-style name-address-group width-100">
                                    <label for="cmpAddress">Work Experience :</label>
                                    <input type="text" style="width: 100%;" placeholder="Work Experience" name="workExperience" required >
                                    </div>
                                </div>

                                <div class="horizon-wrap">
                                    <div class="input-style name-address-group width-100">
                                    <label for="cmpAddress">Skills :</label>
                                    <input type="text" style="width: 100%;" name="skill" placeholder="Skills" required></input>
                                    </div>
                                </div>

                                <div class="horizon-wrap">
                                    <div class="input-style name-address-group width-100">
                                    <label for="cmpAddress">Languages known :</label>
                                    <input type="text" style="width: 100%;" name="Language" placeholder="Languages" required></input>
                                    </div>
                                </div>

                                <div class="horizon-wrap">
                                    <div class="input-style name-address-group width-100">
                                    <label for="cmpAddress">Education :</label>
                                    <input type="text" style="width: 100%;" placeholder="Education" name="education" required>
                                    </div>
                                </div>

                                <div class="horizon-wrap">
                                    <div class="input-style name-address-group width-100">
                                    <label for="cmpAddress">School or University :</label>
                                    <input type="text" style="width: 100%;" placeholder="School or University" name="school" required> 
                                    </div>
                                </div>

                                <div class="horizon-wrap">
                                    <div class="input-style name-address-group width-100">
                                    <label for="cmpAddress">CGPA :</label>
                                    <input type="text" style="width: 100%;" placeholder="CGPA" name="cgpa" required>
                                    </div>
                                </div>

                                <div class="horizon-wrap">
                                    <div class="input-style name-address-group width-100">
                                    <label for="cmpAddress">Extracurricular activities :</label>
                                    <input type="text" style="width: 100%;" placeholder="Extracurricular activities" name="extraActivities" required>
                                    </div>
                                </div>
                                <hr />
                                <div class="button-group">
                                    <button type = "submit" name="update" class="clickable-btn Update">Update</button>
                                    <a href="#" class="clickable-btn Export">Cancel</a>
                                    <!--<button type = "submit" name="createCV" class="submit-btn">Create</button>-->
                                </div>

                                </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer><?php include_once "../../includes/footer.php"; ?></footer>
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