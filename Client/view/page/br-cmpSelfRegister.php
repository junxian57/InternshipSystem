<?php

if(isset($_GET['success']) && isset($_GET['status']) && $_GET['status'] == "pending"){
    echo "<script>
    alert('Your company has been registered successfully.\\nPlease wait for the approval from the ITP Committee.');

    window.location.href = 'br-cmpSelfRegister.php';
    </script>";
}else if(isset($_GET['failed'])){
    echo "<script>
    alert('Your company has NOT been registered successfully.\\nPlease try again.');

    window.location.href = 'br-cmpSelfRegister.php'
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
        <form action="../../app/BLL/cmpSelfRegisterBLL.php" method="GET" onsubmit="formTaskArray()" id="registerForm">
          <h3 class="form-title">Company Registration Form</h3>
          <div class="title">
            <h2 class="title-1">Company Name & Contact</h2>
          </div>
          <div class="input-style name-address-group vertical-wrap">
            <input
              type="text"
              style="width: 100%"
              placeholder="Company Name"
              name="cmpName"
              required
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
              required
            />

            <div class="width-45-100">
              <input type="email" placeholder="Email" style='width:100%;' name="cmpEmail" required />
            </div>
          </div>

          <div class="input-style name-address-group">
            <input
              type="text"
              placeholder="Contact Person"
              class="width-45"
              name="cmpContactPerson"
              pattern="[a-zA-Z ]{1,}"
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
            ></textarea>
          </div>

          <div class="input-style name-address-group">
            <select name="cmpState" id="state" class="width-45">
              <option value="0" disabled selected>Select a State</option>
              <option value="Johor">Johor</option>
              <option value="Kuala Lumpur">Kuala Lumpur</option>
              <option value="Kedah">Kedah</option>
              <option value="Kelantan">Kelantan</option>
              <option value="Melaka">Melaka</option>
              <option value="Negeri Sembilan">Negeri Sembilan</option>
              <option value="Pahang">Pahang</option>
              <option value="Penang">Penang</option>
              <option value="Perak">Perak</option>
              <option value="Perlis">Perlis</option>
              <option value="Sabah">Sabah</option>
              <option value="Sarawak">Sarawak</option>
              <option value="Selangor">Selangor</option>
              <option value="Terengganu">Terengganu</option>
            </select>

            <div class="width-45-100">
              <input
              type="text"
              placeholder="Postcode"
              name="cmpPostCode"
              style='width:100%;'
              pattern="[0-9]{5}"
              required
            />
            </div>
          </div>

          <div class="input-style name-address-group">
            <input type="text" class="width-45" placeholder="City" pattern="[a-zA-Z ]{1,}" name="cmpCity" required />
          </div>

          <div class="title">
            <h2 class="title-3">Company Details</h2>
          </div>

          <div class="company-details-group input-style">
            <select name="cmpSize" id="cmpSize" style="width: 100%">
              <option value="0" disabled selected>Company Size</option>
              <option value="Micro">Mirco: 1 - 4</option>
              <option value="Small">Small: 5 - 74</option>
              <option value="Medium">Medium: 75 - 200</option>
              <option value="Large">Large: > 200</option>
            </select>
            <p><span>*</span> Selection Based On Number of Employee</p>
          </div>

          <div class="company-details-group input-style fieldArea">
            <div id="fields-row" class="task-row">
            </div>

            <input type="hidden" name="cmpHiddenFieldsArea" id="cmpHiddenFieldsArea">

            <input
              type="text"
              style="width: 100%"
              placeholder="Company Field Area"
              id="cmpFieldArea"
            />
            <input type="button" id="addNewField" value="Add New">
          </div>

          <div class="button-group">
            <button type="submit" name="submit" class="clickable-btn">Submit</button>
            <button type="button" class="clickable-btn" onclick="resetAll()">Reset All</button>
          </div>
        </form>
      </div>
    </div>
  </body>

  <script>
  document.getElementById('addNewField').addEventListener('click',() => {
        addNewRow('fields-row', document.getElementById('cmpFieldArea'))
    });

    function resetAll(){
      document.getElementById('registerForm').reset();

      let taskRow = document.getElementById('fields-row');
      taskRow.innerHTML = '';
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
      let regex = /^[a-zA-Z ]+$/;
      return regex.test(value);
    }

    function deleteTaskRow(taskGroup){
        taskGroup.parentElement.remove();
    };

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
