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
    <link rel="stylesheet" href="../../scss/ky-cmpStudDetails.css">
    
</head>

<?php
//get id from login page
 //session_start();
 //if(isset($_SESSION['adminloggedin']) && $_SESSION['adminloggedin']==true){
   // $adminloggedin= true;
   // $id = $_SESSION['companyID'];
 //}

 //testing purpose
 $companyID = 'CMP00007';
$db = new DBController();

//Get Company Info
try{
    $companyInfo = $db->runQuery("SELECT * FROM Company WHERE companyID = '$companyID';");
    $companyName = $companyInfo[0]['cmpName'];
}catch(Exception $e){
    echo "<script> 
    alert('$e');
    window.location.href = 'ky-enterCmpDetails.php';
    </script>";    
}

if(isset($_GET['success']) && isset($_GET['update']) && $_GET['update'] == "1" && $_GET['success'] == "1"){
    echo "<script>
    alert(`Company Profile Has Been Updated Successfully.`);
    
    window.location.href = 'ky-enterCmpDetails.php';
    </script>";
    
}else if(isset($_GET['failed']) && isset($_GET['update']) && $_GET['update'] == "0" && $_GET['failed'] == "1"){
    echo "<script>
    alert(`Company Profile Updated Failed.\\n\\nContact Admin For Further Assistance.`);
    
    window.location.href = 'ky-enterCmpDetails.php'
    </script>";
}

?>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once('../../includes/sidebar.php'); ?>
        <?php include_once('../../includes/header.php'); ?>
        <div id="page-wrapper">
            <div class="main-page">
                <div class="forms">
                        
                <h3 class="page-title">Company Information</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                        <div class="wrapper">
                        <form action="ky-updateStudCmp.php" onsubmit="formTaskArray()" method="GET">                  
                        <input type="hidden" value="<?php echo $companyID; ?>" name="companyID">
                            <div class="title">
                                <h2>Company Name & Contact</h2>
                            </div>

                            <div class="horizon-wrap">
                                <div class="input-style name-address-group width-100">
                                <label for="cmpName">Name</label>
                                <input
                                    class="grey-bg"
                                    type="text"
                                    id="cmpName"
                                    value="<?php echo $companyName; ?>"
                                    readonly                   
                                />
                                </div>
                            </div>

                            <div class="horizon-wrap">
                                <div class="input-style width-45 name-address-group">
                                <label for="cmpContactNo">Contact No.</label>
                                <input 
                                class="grey-bg" 
                                type="text" 
                                name="cmpContactNo" 
                                value="<?php echo $companyInfo[0]['cmpContactNumber']; ?>"
                                pattern="[0-9]{10,11}"
                                placeholder="E.g. 0123456789 - Without Dash"
                                readonly
                                required/>
                                </div>

                                <div class="input-style width-45 name-address-group">
                                <label for="cmpEmail">Email Address</label>
                                <input class="grey-bg" type="email" name="cmpEmail" value="<?php echo $companyInfo[0]['cmpEmail']; ?>" readonly required/>
                                </div>
                            </div>

                            <div class="horizon-wrap">
                                <div class="input-style width-45 name-address-group">
                                <label for="cmpContactPerson">Contact Person</label>
                                <input 
                                class="grey-bg" 
                                type="text" 
                                name="cmpContactPerson" 
                                value="<?php echo $companyInfo[0]['cmpContactPerson']; ?>" 
                                pattern="[a-zA-Z ]{1,}"
                                readonly
                                required/>
                                </div>

                                <div class="input-style width-45 name-address-group">
                                <label for="cmpDateJoin">Date Joined</label>
                                <input type="text" class="grey-bg" id="cmpDateJoin" value="<?php echo $companyInfo[0]['cmpDateJoined']; ?>" readonly />
                                </div>
                            </div>

                            <hr />
                            <div class="title">
                                <h2>Password</h2>
                            </div>
                            <div class="horizon-wrap">
                                <div class="input-style width-45 name-address-group">
                                <label for="cmpContactPerson">Initial Password</label>
                                <input 
                                class="grey-bg" 
                                type="text"
                                placeholder="Please enter initial password" 
                                name="iniPass" 
                                readonly
                                required/>
                                </div>

                                <div class="input-style width-45 name-address-group">
                                <label for="cmpDateJoin">New Password</label>
                                <input class="grey-bg" 
                                type="text"
                                placeholder="Please enter new password"  
                                name="newPass" 
                                readonly
                                required/>
                                </div>
                            </div>

                            <hr />
                            <div class="title">
                                <h2 class="margin-top-20">Company Address</h2>
                            </div>

                            <div class="horizon-wrap">
                                <div class="input-style name-address-group width-100">
                                <label for="cmpAddress">Company Address</label>
                                <input class="grey-bg" type="text" name="cmpAddress" style="word-wrap: break-word" value="<?php echo $companyInfo[0]['cmpAddress']; ?>" readonly required/>
                                </div>
                            </div>

                            <div class="horizon-wrap">
                                <div class="input-style width-45 name-address-group">
                                <label for="cmpState">State</label>
                                <select type="text" name="cmpState" id="cmpState" disabled>
                                    <option value="0" disabled>Select a State</option>
                                    <option value="Johor" <?php echo ($companyInfo[0]['cmpState'] == 'Johor') ? 'selected' : '' ?> >Johor</option>
                                    <option value="Kuala Lumpur" <?php echo ($companyInfo[0]['cmpState'] == 'Kuala Lumpur') ? 'selected' : '' ?> >Kuala Lumpur</option>
                                    <option value="Kedah" <?php echo ($companyInfo[0]['cmpState'] == 'Kedah') ? 'selected' : '' ?> >Kedah</option>
                                    <option value="Kelantan" <?php echo ($companyInfo[0]['cmpState'] == 'Kelantan') ? 'selected' : '' ?>>Kelantan</option>
                                    <option value="Melaka" <?php echo ($companyInfo[0]['cmpState'] == 'Melaka') ? 'selected' : '' ?>>Melaka</option>
                                    <option value="Negeri Sembilan" <?php echo ($companyInfo[0]['cmpState'] == 'Negeri Sembilan') ? 'selected' : '' ?> >Negeri Sembilan</option>
                                    <option value="Pahang" <?php echo ($companyInfo[0]['cmpState'] == 'Pahang') ? 'selected' : '' ?>>Pahang</option>
                                    <option value="Penang" <?php echo ($companyInfo[0]['cmpState'] == 'Penang') ? 'selected' : '' ?>>Penang</option>
                                    <option value="Perak" <?php echo ($companyInfo[0]['cmpState'] == 'Perak') ? 'selected' : '' ?>>Perak</option>
                                    <option value="Perlis" <?php echo ($companyInfo[0]['cmpState'] == 'Perlis') ? 'selected' : '' ?>>Perlis</option>
                                    <option value="Sabah" <?php echo ($companyInfo[0]['cmpState'] == 'Sabah') ? 'selected' : '' ?>>Sabah</option>
                                    <option value="Sarawak" <?php echo ($companyInfo[0]['cmpState'] == 'Sarawak') ? 'selected' : '' ?>>Sarawak</option>
                                    <option value="Selangor" <?php echo ($companyInfo[0]['cmpState'] == 'Selangor') ? 'selected' : '' ?>>Selangor</option>
                                    <option value="Terengganu" <?php echo ($companyInfo[0]['cmpState'] == 'Terengganu') ? 'selected' : '' ?>>Terengganu</option>
                                </select>
                                </div>

                                <div class="input-style width-45 name-address-group">
                                <label for="cmpPostcode">Postcode</label>
                                <input class="grey-bg" type="text" name="cmpPostcode" value="<?php echo $companyInfo[0]['cmpPostCode']; ?>" pattern="[0-9]{5}" readonly required/>
                                </div>
                            </div>

                            <div class="horizon-wrap">
                                <div class="input-style width-45 name-address-group">
                                <label for="cmpCity">City</label>
                                <input class="grey-bg" type="text" name="cmpCity" value="<?php echo $companyInfo[0]['cmpCity']; ?>" pattern="[a-zA-Z ]{1,}" readonly required/>
                                </div>
                            </div>

                            <hr />
                            <div class="title margin-btm-20">
                                <h2 class="margin-top-20">Company Details</h2>
                            </div>

                            <div class="name-address-group margin-top-20 select-style">
                                <label for="cmpFieldArea">Company Field Area</label>
                                <div id="fields-row" class="task-row">
                                    <?php
                                        $fieldsArea = explode("-", $companyInfo[0]['cmpFieldsArea']);

                                        foreach($fieldsArea as $field) {
                                            if($field == "") continue;

                                            echo "<div class='row'><p>$field</p><span class='deleteRow'>✖</span></div>";
                                        }
                                    ?>
                                </div>

                                <input type="hidden" name="cmpHiddenFieldsArea" id="cmpHiddenFieldsArea">

                                <input
                                type="text"
                                class="grey-bg"
                                placeholder="Enter Company Field Area..."
                                style="text-indent: 5px;"
                                id="cmpFieldArea"                          
                                />

                                <input type="button" class="grey-bg" id="addNewField" style="border-color: black;" value="Add New" disabled>
                            </div>

                            <div class="horizon-wrap">
                                <div class="input-style width-45 name-address-group">
                                    <label for="cmpSize">Company Size</label>
                                    <select name="cmpSize" id="cmpSize" disabled>
                                    <option value="0" disabled>Company Size</option>
                                        <option value="Micro" <?php echo ($companyInfo[0]['cmpCompanySize'] == 'Micro') ? 'selected' : '' ?> >Micro: 1 - 4</option>

                                        <option value="Small" <?php echo ($companyInfo[0]['cmpCompanySize'] == 'Small') ? 'selected' : '' ?> >Small: 5 - 74</option>

                                        <option value="Medium" <?php echo ($companyInfo[0]['cmpCompanySize'] == 'Medium') ? 'selected' : '' ?>>Medium: 75 - 200</option>

                                        <option value="Large" <?php echo ($companyInfo[0]['cmpCompanySize'] == 'Large') ? 'selected' : '' ?>>Large: > 200</option>
                                    </select>
                                </div>

                                <div class="input-style width-45 name-address-group">
                                    <label for="cmpSize">Average Allowance Given</label>
                                    <input class="grey-bg" type="text" name="cmpAverageAllowanceGiven" style="word-wrap: break-word" value="<?php echo $companyInfo[0]['cmpAverageAllowanceGiven']; ?>" readonly required/>
                                </div>
                            </div>
                            <hr>
                            <div class="button-group">
                                    <button type = "submit" name="update" class="clickable-btn Update">Update</button>
                                    <a href="#" class="clickable-btn Export">Cancel</a>
                                <!--
                                //TODO: Use js, if yes, then move to next page, ask does the company details all correct? 
                                -->

                                <!-- <?php
                                   // if($_SESSION['jobCreation'] == 1 && isset($_SESSION['jobCreation'])){
                                ?> -->
                                  <!--  <a href="#" class="clickable-btn">Next</a>
                                 <?php
                                  //  }
                                ?> -->
                            </div>
                        </form>
                    </div>
                </div>
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