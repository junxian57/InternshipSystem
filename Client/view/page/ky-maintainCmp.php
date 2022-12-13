<?php
session_start();
error_reporting(0);
include('../../includes/db_connection.php');

if(isset($_SESSION['companyChangePass'])){
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
    <link rel="stylesheet" href="../../scss/ky-cmpStudDetails.css">
    
</head>

<?php
if(isset($_SESSION['companyID'])){
    $companyID = $_SESSION['companyID'];
 }


$db = new DBController();

//Get Company Info
try{
    $companyInfo = $db->runQuery("SELECT * FROM Company WHERE companyID = '$companyID';");
    $companyName = $companyInfo[0]['cmpName'];
}catch(Exception $e){
    echo "<script> 
    alert('$e');
    window.location.href = 'ky-maintainCmp.php';
    </script>";    
}

if(isset($_GET['success']) && isset($_GET['update']) && $_GET['update'] == "1" && $_GET['success'] == "1"){
    echo "<script>
    alert(`Company Profile Has Been Updated Successfully.`);
    
    window.location.href = 'ky-maintainCmp.php';
    </script>";
    
}else if(isset($_GET['failed']) && isset($_GET['update']) && $_GET['update'] == "0" && $_GET['failed'] == "1"){
    echo "<script>
    alert(`Company Profile Updated Failed.\\n\\nContact Admin For Further Assistance.`);
    
    window.location.href = 'ky-maintainCmp.php'
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
                        <form action="ky-maintainStudCmp.php" onsubmit="return formTaskArray()" method="GET">                  
                        <input type="hidden" value="<?php echo $companyInfo[0]['companyID']; ?>" name="companyID">
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
                                <label for="cmpContactPerson">Old Password</label>
                                <input 
                                class="grey-bg" 
                                type="Password"
                                placeholder="Please enter initial password" 
                                name="iniPass" 
                                readonly
                                />
                                </div>

                                <div class="input-style width-45 name-address-group">
                                <label for="cmpDateJoin">New Password</label>
                                <input class="grey-bg" 
                                type="Password"
                                placeholder="Please enter new password"  
                                name="newPass" 
                                readonly
                               />
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

                            </div>
                            <hr>
                            <div class="button-group">
                                <input type="button" class="clickable-btn" value="Edit" onclick="removeDisable()" id="edit-form-btn"/>
                                <button class="clickable-btn Export" name ="Export">Export</button>                    
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer><?php include_once "../../includes/footer.php"; ?></footer>
</body>
    
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
    document.getElementById('addNewField').addEventListener('click',() => {
        addNewRow('fields-row', document.getElementById('cmpFieldArea'))
    });

    function addNewRow(taskGroup, newTaskValue){
        let value = newTaskValue.value;

        if (value === ""){
            alert("Please Enter a Task");
            return;
        }

        //Entering Alphabet Only
        if(!checkIsAlphabet(newTaskValue.value)){
        alert('Please Enter Alphabet and Space Only');
        newTaskValue.value = '';
        return;
        }

        let taskRow = document.getElementById(taskGroup);
        let newTask = document.createElement("div");
        newTask.className = "row";
        newTask.innerHTML = `<p>${value}</p><span class="deleteRow" onclick="deleteTaskRow(this)">✖</span>`;
        taskRow.appendChild(newTask);
        newTaskValue.value = "";
    }

    function checkIsAlphabet(value){
      let regex = /^[a-zA-Z ]+$/;
      return regex.test(value);
    }
    
    function deleteTaskRow(taskGroup){
        taskGroup.parentElement.remove();
    };
    
    function removeDisable(){
        let input = document.querySelectorAll("input");
        let select = document.querySelectorAll("select");
        let allTaskRowSpanButton = document.querySelectorAll(".deleteRow");

        input.forEach((item) => {
            if(item.id == 'cmpName' || item.id == 'cmpDateJoin') return;
            if(item.id=='addNewField') item.removeAttribute('style');

            item.removeAttribute("readonly");
            item.removeAttribute("disabled");
            item.classList.remove("grey-bg");
        });
    
        select.forEach((item) => {
            item.removeAttribute("disabled");
            item.classList.remove("grey-bg");
        });

        allTaskRowSpanButton.forEach((item) => {
            item.setAttribute('onclick', 'deleteTaskRow(this)');
        });

        let buttonGroup = document.getElementsByClassName("button-group");

        //Create Update Button For Update Company Details
        let updateButton = document.createElement("input");
        updateButton.setAttribute("type", "submit");
        updateButton.setAttribute("value", "Update");
        updateButton.setAttribute("name", "submit");
        updateButton.id = "update-form-btn";
        updateButton.className = "clickable-btn";

        buttonGroup[0].replaceChild(updateButton, buttonGroup[0].children[0]);

    }

    function formTaskArray(){
      let taskValue = "";
      let fieldsRow = document.querySelectorAll('#fields-row .row p');

      if(fieldsRow.length == 0){
        info('Please enter a field area');
        return false;
      }

      fieldsRow.forEach((task) => {
        taskValue += task.innerHTML + "-";
      });

      document.getElementById('cmpHiddenFieldsArea').value = taskValue;

      if(document.getElementById('cmpSize').value == 0){
        alert('Please select a company size');
        return false;
      }else if(document.getElementById('cmpState').value == 0){
        alert('Please select a state');
        return false;
      }else if(fieldsRow.length == 0){
        alert('Please enter a field area');
        return false;
      }

      return true;
    }
</script>


</html>