<?php
$systemPathPrefix = $_SERVER['DOCUMENT_ROOT'].'/InternshipSystem/Client/';
require_once $systemPathPrefix."app/DAL/companyDAL.php";

//TODO:  Change the location to index.php

if(isset($_GET['success']) && isset($_GET['status']) && $_GET['status'] == "AmendedInfo"){
    echo "<script>
      alert('Your company has been updated successfully.\\nPlease wait for the approval from the ITP Committee.');
      window.location.href = 'br-cmpSelfRegister.php';
      </script>";
}else if(isset($_GET['failed'])){
    echo "<script>
    alert('Your company has NOT been updated successfully.\\nPlease try again.');
    window.location.href = 'br-cmpSelfAppModification.php'
    </script>";
}

if(isset($_GET['companyID']) && isset($_GET['amend']) && isset($_GET['rejected']) && $_GET['amend'] == 1 && $_GET['rejected'] == 1){
    $result = getCompanyDetails($_GET['companyID']);

    if(count($result) > 0){        
        $companyID = trim($result[0]['companyID']);
        $companyName = trim($result[0]['cmpName']);
        $companyFields = trim($result[0]['cmpFieldsArea']);
        $companyAddress = trim($result[0]['cmpAddress']);
        $companyEmail = trim($result[0]['cmpEmail']);
        $companyPhone = trim($result[0]['cmpContactNumber']);
        $companyState = trim($result[0]['cmpState']);
        $companyCity = trim($result[0]['cmpCity']);
        $companyPostcode = trim($result[0]['cmpPostCode']);
        $companyContactPerson = trim($result[0]['cmpContactPerson']);
        $companySize = trim($result[0]['cmpCompanySize']);
        $companyStatus = trim($result[0]['cmpAccountStatus']);

        if($companyStatus != 'Rejected'){
            echo "<script>
            alert('Your company has been registered / waiting for approval from the ITP Committee.');
            window.location.href = 'clientLogin.php';
            </script>";
        }

    }else{
        echo "<script>
          alert('SQL Connect Error.\\nPlease contact TARUMT ITP Committee for assistance.');
          window.location.href = 'clientLogin.php'; 
        </script>";
        
    }
}else{
    echo "<script>
    alert('You have no privilege to access this page.\\nKindly register your company.');
    window.location.href = 'br-cmpSelfRegister.php';
    </script>";
    
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Company Registration</title>
    <link href="../../css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="../../css/style.css" rel="stylesheet" type="text/css" />
    <link href="../../css/font-awesome.css" rel="stylesheet" />
    <script src="../../js/jquery-1.11.1.min.js"></script>
    <script src="../../js/modernizr.custom.js"></script>
    <link
      href="//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="../../css/animate.css"
      rel="stylesheet"
      type="text/css"
      media="all"
    />
    <script src="../../js/wow.min.js"></script>
    <script>
      new WOW().init();
    </script>
    <script src="../../js/metisMenu.min.js"></script>
    <script src="../../js/custom.js"></script>
    <link href="../../css/custom.css" rel="stylesheet" />
    <script src="../../js/toastr.min.js"></script>
    <link href="../../css/toastr.min.css" rel="stylesheet">
    <script src="../../js/customToastr.js"></script>
    <link rel="stylesheet" href="../../scss/br-cmpySelfRegister.css" />
  </head>
  <body>
    <header>
      <div class="page-title">
        <h4>Tunku Abdul Rahman University College</h4>
        <h3>Internship System</h3>
      </div>
    </header>

    <div class="content">
      <div class="wrapper">
        <form action="../../app/BLL/cmpSelfAppModifyBLL.php" method="POST" onsubmit="return formTaskArray()" enctype="multipart/form-data">
        <input type="hidden" name="companyID" value="<?php echo $companyID;?>">
          <h3 class="form-title">Company Registration Amendment</h3>
          <div class="title">
            <h2 class="title-1">Company Name & Contact</h2>
          </div>
          <div class="input-style name-address-group vertical-wrap">
            <input
              type="text"
              style="width: 100%; background-color:lightgrey;"
              placeholder="Company Name"
              name="cmpName"
              value="<?php echo $companyName; ?>"
              readonly
            />
            <p><span>** </span>Not Subject To Change Once Registered</p>
          </div>
          

          <div class="input-style name-address-group">
            <input
              type="text"
              class="width-45"
              placeholder="Contact No."
              name="cmpContactNo"
              pattern="[0-9]{10,11}"
              placeholder="E.g. 0123456789 - Without Dash"
              value="<?php echo $companyPhone; ?>"
              required
            />

            <div class="width-45-100">
              <input 
              type="email" 
              placeholder="Email" 
              style='width:100%;' 
              name="cmpEmail" 
              value="<?php echo $companyEmail; ?>"
              required 
              />
            </div>
          </div>

          <div class="input-style name-address-group">
            <input
              type="text"
              placeholder="Contact Person"
              class="width-45"
              name="cmpContactPerson"
              pattern="[a-zA-Z ]{1,}"
              value="<?php echo $companyContactPerson; ?>"
              required
            />
          </div>        

          <div class="title">
            <h2 class="title-2">Company Address</h2>
          </div>
          <div class="input-style name-address-group">
            <textarea
              type="text"
              name="cmpAddress"
              placeholder="Address"
              cols="30"
              rows="5"
              required
            ><?php echo $companyAddress; ?>
          </textarea>
          </div>

          <div class="input-style name-address-group">
            <select name="cmpState" id="state" class="width-45">
              <option value="0" disabled selected>Select a State</option>
              <option value="Johor" <?php echo ($companyState == 'Johor') ? 'selected' : '' ?> >Johor</option>
              <option value="Kuala Lumpur" <?php echo ($companyState == 'Kuala Lumpur') ? 'selected' : '' ?> >Kuala Lumpur</option>
              <option value="Kedah" <?php echo ($companyState == 'Kedah') ? 'selected' : '' ?> >Kedah</option>
              <option value="Kelantan" <?php echo ($companyState == 'Kelantan') ? 'selected' : '' ?>>Kelantan</option>
              <option value="Melaka" <?php echo ($companyState == 'Melaka') ? 'selected' : '' ?>>Melaka</option>
              <option value="Negeri Sembilan" <?php echo ($companyState == 'Negeri Sembilan') ? 'selected' : '' ?> >Negeri Sembilan</option>
              <option value="Pahang" <?php echo ($companyState == 'Pahang') ? 'selected' : '' ?>>Pahang</option>
              <option value="Penang" <?php echo ($companyState == 'Penang') ? 'selected' : '' ?>>Penang</option>
              <option value="Perak" <?php echo ($companyState == 'Perak') ? 'selected' : '' ?>>Perak</option>
              <option value="Perlis" <?php echo ($companyState == 'Perlis') ? 'selected' : '' ?>>Perlis</option>
              <option value="Sabah" <?php echo ($companyState == 'Sabah') ? 'selected' : '' ?>>Sabah</option>
              <option value="Sarawak" <?php echo ($companyState == 'Sarawak') ? 'selected' : '' ?>>Sarawak</option>
              <option value="Selangor" <?php echo ($companyState == 'Selangor') ? 'selected' : '' ?>>Selangor</option>
              <option value="Terengganu" <?php echo ($companyState == 'Terengganu') ? 'selected' : '' ?>>Terengganu</option>
            </select>

            <div class="width-45-100">
              <input
              type="text"
              placeholder="Postcode"
              name="cmpPostCode"
              style='width:100%;'
              pattern="[0-9]{5}"
              value="<?php echo $companyPostcode; ?>"
              required
            />
            </div>
          </div>

          <div class="input-style name-address-group">
            <input 
            type="text" 
            class="width-45" 
            placeholder="City" 
            pattern="[a-zA-Z ]{1,}" 
            name="cmpCity" 
            value="<?php echo $companyCity; ?>"
            required />
          </div>

          <div class="title">
            <h2 class="title-3">Company Details</h2>
          </div>

          <div class="company-details-group input-style">
            <select name="cmpSize" id="cmpSize" style="width: 100%">
              <option value="0" disabled selected>Company Size</option>
              <option value="Micro" <?php echo ($companySize == 'Micro') ? 'selected' : '' ?> >Micro: 1 - 4</option>
              <option value="Small" <?php echo ($companySize == 'Small') ? 'selected' : '' ?> >Small: 5 - 74</option>
              <option value="Medium" <?php echo ($companySize == 'Medium') ? 'selected' : '' ?>>Medium: 75 - 200</option>
              <option value="Large" <?php echo ($companySize == 'Large') ? 'selected' : '' ?>>Large: > 200</option>
            </select>
            <p><span>*</span> Selection Based On Number of Employee</p>
          </div>

          <div class="company-details-group input-style fieldArea">
            <div id="fields-row" class="task-row">
              <?php
              $companyFields = explode('-', $companyFields);
                foreach($companyFields as $field){
                  if($field == "") continue;
                  echo "<div class='row'>
                          <p>$field</p><span class='deleteRow' onclick='deleteTaskRow(this)'>✖</span>
                        </div>";
                }
              ?>
            </div>

            <input type="hidden" name="cmpHiddenFieldsArea" id="cmpHiddenFieldsArea">

            <input
              type="text"
              style="width: 100%"
              placeholder="Company Field Area"
              id="cmpFieldArea"
            />
            <p class="charCountHint">
                <span>* </span>Maximum 250 Characters (<span id="maxJobChar">0</span>/250)
            </p>
            <input type="button" id="addNewField" value="Add New">
          </div>

          <div class="company-details-group input-style certBox">
            <label for="cmpCertification" onchange="changeFileName()">
              Upload Company Certification (e.g. SSM, etc.) <br/>
              <i class="fa fa-2x fa-file"></i>
              <input id="cmpCertification" name="cmpCertification" type="file" accept=".jpg, .jpeg, .png, .pdf"/>
              <br/>
              <span id="fileName"></span>
            </label>
            <p>Accept .jpg, .jpeg, .png and .pdf Format Only</p>
          </div>

          <div class="button-group">
            <button type="submit" name="amend" class="clickable-btn">Amend</button>
          </div>
        </form>
      </div>
    </div>
  </body>

  <script>
    document.getElementById('addNewField').addEventListener('click',() => {
        addNewRow('fields-row', document.getElementById('cmpFieldArea'))
    });

    function changeFileName(){
      let inputImage = document.querySelector("#cmpCertification").files[0];
      let fileName = document.getElementById('fileName');

      fileName.innerText = inputImage.name;
    }

    function addNewRow(taskGroup, newTaskValue){
      //Entering Alphabet Only
      if(!checkIsAlphabet(newTaskValue.value)){
        info('Please Enter Alphabet and Space Only');
        newTaskValue.value = '';
        return;
      }

      let value = newTaskValue.value;
        
      if (value === ""){
            info("Please Enter a Task");
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
      let regex = /^[0-9a-zA-Z ,]+$/;
      return regex.test(value);
    }

    function deleteTaskRow(taskGroup){
        taskGroup.parentElement.remove();
    };

    let maxJobChar = 0;

    function addNewRow(taskGroup, newTaskValue){
        let inputValue = newTaskValue.value;
        let taskRow = document.getElementById(taskGroup);

        if (inputValue === ""){
            info("Please Enter A Task");
            return;
        }

        //Check whether total task row has exceed 1500 characters
        let checkExceed250 = (inputValue.length + maxJobChar) > 250;

        if(checkExceed250){
            info('Maximum 250 Characters');
            document.getElementById('cmpFieldArea').value = '';
            return;
        }

        //To count the total number of task
        let countTaskRow = taskRow.childElementCount + 1;
        if(countTaskRow > 10){
            info('Maximum 10 Task Can Be Added');
            document.getElementById('cmpFieldArea').value = '';
            return;
        }

        //Entering Alphabet Only
        if(!checkIsAlphabet(newTaskValue.value)){
            info('Please Enter Alphabet, Number, Space, and ',' Only');
            newTaskValue.value = '';
            return;
        }
        
        let newTask = document.createElement("div");
        newTask.className = "row";
        newTask.innerHTML = `<p>${inputValue}</p><span class="deleteRow" onclick="deleteTaskRow(this)">✖</span>`;
        taskRow.appendChild(newTask);

        //To count the total number of characters
        let getTaskRowPElement = document.querySelectorAll(`#${taskGroup} .row p`);
        //Dynamic for display max character box
        let countDisplay = document.getElementById('maxJobChar');
        let tempCount = 0;

        tempCount = getTaskRowPElement[getTaskRowPElement.length - 1].innerHTML.length;
        
        maxJobChar += tempCount;

        countDisplay.innerHTML = maxJobChar;

        newTaskValue.value = "";
        newTaskValue.focus();
    }

    function deleteTaskRow(taskGroup){
        let taskCharCount = taskGroup.parentElement.children[0].innerHTML.length;
        let taskGroupID = taskGroup.parentElement.parentElement.id;

        let countDisplay = document.getElementById('maxJobChar');
        
        maxJobChar -= taskCharCount;
        
        countDisplay.innerHTML = maxJobChar;

        taskGroup.parentElement.remove();
    };

    function formTaskArray(){
      let taskValue = "";
      let fieldsRow = document.querySelectorAll('#fields-row .row p');
      let inputFile = document.getElementById("cmpCertification");
      
      if(fieldsRow.length == 0){
        info('Please enter a field area');
        return false;
      }
      
      if (inputFile.files.length === 0){
        info('Please upload a file');
        return false;
      }

      fieldsRow.forEach((task) => {
        taskValue += task.innerHTML + "-";
      });

      document.getElementById('cmpHiddenFieldsArea').value = taskValue;

      if(document.getElementById('cmpSize').value == 0){
        info('Please select a company size');
        return false;
      }else if(document.getElementById('state').value == 0){
        info('Please select a state');
        return false;
      }else if(fieldsRow.length == 0){
        info('Please enter a field area');
        return false;
      }

      return true;
    }
  </script>
</html>
