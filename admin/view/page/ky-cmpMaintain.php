<?php
session_start();
error_reporting(0);

if(session_status() != PHP_SESSION_ACTIVE) session_start();

if (!isset($_SESSION['adminID'])) {
    if (!isset($_SESSION['committeeID'])) {
      echo "<script>
          window.location.href = 'adminLogin.php';
      </script>";
    }
  }

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
    <link href="../../css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="../../css/style.css" rel='stylesheet' type='text/css' />
    <link href="../../css/font-awesome.css" rel="stylesheet">
    <link href="../../scss/navtab.css" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href="../../css/animate.css" rel="stylesheet" type="text/css" media="all">
    <link href="../../css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../../js/jquery-1.11.1.min.js"></script>
    <script src="../../js/modernizr.custom.js"></script>>
    <script src="../../js/wow.min.js"></script>
    <script src="../../js/metisMenu.min.js"></script>
    <script src="../../js/custom.js"></script>
    <link href="../../css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.co">
    <link rel="stylesheet" type="text/css" href="../../css/dataTables.bootstrap.css" />

    <script>
        new WOW().init();
    </script>
    
    <link 
        href="../../scss/ky-Maintain.css"
        rel="stylesheet"  
        type='text/css' 
    />
    
    
    

</head>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once('../../includes/sidebar.php'); ?>
        <?php include_once('../../includes/header.php'); ?>
        <div id="page-wrapper">
            <div class="main-page">
                <div class="forms">
                    <h3 class="page-title">Company Maintenance</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                        <!-- Tab Content 1-->
                        <div id="StudentToSupervisor" class="tabcontent">
                            <!-- <div class="table-title">
                                <input type="search" id="keyInput" onkeyup="searchInTable()" placeholder="Enter Keyword of Company Name...">
                                <p>Hint: Table Below Is Scrollable</p>
                            </div> -->
                            <div class="table-responsive black-border">
                                <div class="table_section">
                                    <table class="table-view" id="myTable">
                                        <thead>
                                            <tr>
                                            <th>Company Id</th>
                                            <th>Company Name</th>
                                            <th>Email</th>
                                            <th>Contact No</th>
                                            <th>Account Status</th>
                                            <th>Date Added</th>
                                            <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $db = new DBController();
                                                $sql = "select * from Company"; 
                                                $result = $db->runQuery($sql);
                                                
                                                if(count($result) > 0){
                                                    foreach ($result as $company) { 
                                                    $Id = $company['companyID'];
                                                    $name = $company['cmpName'];
                                                    $dateJoined = $company['cmpDateJoined'];
                                                
                                                    $email = $company['cmpEmail'];
                                                    $phone = $company['cmpContactNumber'];
                                                    $cmpUsername = $company['cmpUsername'];
                                                    $cmpContactPerson = $company['cmpContactPerson'];
                                                    $size = $company['cmpCompanySize'];
                                                    $address = $company['cmpAddress'];
                                                    $cmpState = $company['cmpState'];
                                                    $cmpCity = $company['cmpCity'];
                                                    $cmpPostCode = $company['cmpPostCode'];
                                                    $fieldArea = $company['cmpFieldsArea'];
                                                    $cmpInternshipPlacement = $company['cmpNumberOfInternshipPlacements'];
                                                    //$allowance = $company['cmpAverageAllowanceGiven'];
                                                    $status = $company['cmpAccountStatus'];
                                                    $rating= $company['cmpRating'];
                                            ?>                          
                                                    <tr>                                   
                                                        <td><?php echo $Id ?></td>
                                                        <td><?php echo $name ?></td>
                                                        <td><a href="mailto:<?php echo $email ?>">Email</td>
                                                        <td><?php echo $phone ?></td>
                                                        <td><?php echo $status ?></td> 
                                                        <td><?php echo $dateJoined ?></td> 
                                            
                                                        <td>
                                                            <div class="button-group">
                                                            
                                                                <button onclick="viewModal('<?php echo $Id ?>', '<?php echo $name ?>', '<?php echo $email ?>', '<?php echo $phone ?>', '<?php echo $cmpContactPerson ?>', '<?php echo $size ?>',  '<?php echo $address ?>', '<?php echo $fieldArea ?>', '<?php echo $cmpInternshipPlacement ?>', '<?php echo $dateJoined ?>', '<?php echo $status ?>' ,'<?php echo $rating ?>','<?php echo $cmpCity ?>','<?php echo $cmpPostCode ?>','<?php echo $cmpState ?>')"><i class="fa fa-eye" style ="color:red"></i></button>
                                                                <button onclick="toModal('<?php echo $Id ?>', '<?php echo $name ?>', '<?php echo $email ?>', '<?php echo $phone ?>', '<?php echo $cmpContactPerson ?>', '<?php echo $size ?>',  '<?php echo $address ?>', '<?php echo $fieldArea ?>', '<?php echo $cmpInternshipPlacement ?>',  '<?php echo $dateJoined ?>', '<?php echo $status ?>' ,'<?php echo $rating ?>','<?php echo $cmpCity ?>','<?php echo $cmpPostCode ?>','<?php echo $cmpState ?>')"><i class="uil uil-pen" style="color:#0298cf"></i></button>
                                                        
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php                                                                           
                                                    }
                                                }
                                                
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                    <form action="ky-exportCmpDetails.php" method="POST">
                                        <button class="clickable-btn Export" type = "submit" name="ExportAllcmp">Export All Company Details</button>
                                    </form>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer><?php include_once('../../includes/footer.php'); ?></footer>
</body>


    <!-- EDIT MODAL -->
    <div id="login-modal">
        <div class="model">
            <div class="top-form">
                <h2>Edit Company Details</h2>
                <div class="close-modal">
                    &#10006;
                </div>  
            </div>
            <div class="login-form">
                <div class="content">
                    <form action="ky-updateCompany.php" method="POST">
                        <div class="scroll-bg">
                            <div class="user-details">
                            
                            <input type="hidden" placeholder="Enter your id" name="update_id" id="input_id" required readonly>
                            
                            <div class="title">
                                <h2>Company Name & Contact</h2>
                            </div>
                            <div class="input-box">
                                <label>Company Name :</label>
                                <input type="text" placeholder="Enter your name" name="cmpName" id="input_name" required readonly>
                                <i class="uil uil-user-circle icon"></i>
                            </div>
                            
                            <div class="pass-box">
                                <label>Email :</label>
                                <input type="email" placeholder="Enter programme" name="email" id="input_email" required>
                                <i class="uil uil-envelope icon"></i>
                            </div>

                            <div class="pass-box">
                                <label>Contact No :</label>
                                <input type="text"  pattern="[0-9]{10,11}" placeholder="Enter contact No" name="ContactNo" id="input_phone" required>
                                <i class="uil uil-phone icon"></i>
                            </div>

                            <div class="pass-box">
                                <label>Company Contact Person :</label>
                                <input type="text" placeholder="Enter contact person" name="cmpContactPerson" id="input_username" pattern="[a-zA-Z ]{1,}" required>
                                <i class="uil uil-chat-bubble-user icon"></i>
                            </div>

                            <div class="pass-box">
                                <label>Date Added :</label>
                                <input type="text" placeholder="Date Joined" name ="dateJoined" id="input_dateJoined" readonly>
                                <i class='fa fa-calendar icon'></i>
                            </div>

                            <label style="color:silver; margin-top: 10px;">____________________________________________________________________________________________</label>

                            <div class="title">
                                <h2>Company Address</h2>
                            </div>

                            <div class="input-box">
                                <label>Address :</label>
                                <input type="text" placeholder="Enter Address" name="cmpAddress" id="input_address" required>
                                <i class="uil uil-estate icon"></i>
                            </div>

                            <div class="pass-box">
                                <label>City :</label>
                                <input type="text" placeholder="Enter City" name="cmpCity" id="input_city" pattern="[a-zA-Z ]{1,}" required>
                                <i class="uil uil-estate icon"></i>
                            </div>

                            <div class="pass-box">
                                <label>Post Code :</label>
                                <input type="text" placeholder="Enter Post Code" name="cmpPostCode" id="input_postCode" pattern="[0-9]{5}" required>
                                <i class="uil uil-estate icon"></i>
                            </div>
                            
                            <div class="pass-box">
                                <label>State :</label>
                                <select type="text" name="cmpState" id="input_state">
                                    <option value="0">Select a State</option>
                                    <option value="Johor" <?php echo ($cmpState == 'Johor') ? 'selected' : '' ?> >Johor</option>
                                    <option value="Kuala Lumpur" <?php echo ($cmpState == 'Kuala Lumpur') ? 'selected' : '' ?> >Kuala Lumpur</option>
                                    <option value="Kedah" <?php echo ($cmpState == 'Kedah') ? 'selected' : '' ?> >Kedah</option>
                                    <option value="Kelantan" <?php echo ($cmpState == 'Kelantan') ? 'selected' : '' ?>>Kelantan</option>
                                    <option value="Melaka" <?php echo ($cmpState == 'Melaka') ? 'selected' : '' ?>>Melaka</option>
                                    <option value="Negeri Sembilan" <?php echo ($cmpState == 'Negeri Sembilan') ? 'selected' : '' ?> >Negeri Sembilan</option>
                                    <option value="Pahang" <?php echo ($cmpState == 'Pahang') ? 'selected' : '' ?>>Pahang</option>
                                    <option value="Penang" <?php echo ($cmpState == 'Penang') ? 'selected' : '' ?>>Penang</option>
                                    <option value="Perak" <?php echo ($cmpState == 'Perak') ? 'selected' : '' ?>>Perak</option>
                                    <option value="Perlis" <?php echo ($cmpState == 'Perlis') ? 'selected' : '' ?>>Perlis</option>
                                    <option value="Sabah" <?php echo ($cmpState == 'Sabah') ? 'selected' : '' ?>>Sabah</option>
                                    <option value="Sarawak" <?php echo ($cmpState == 'Sarawak') ? 'selected' : '' ?>>Sarawak</option>
                                    <option value="Selangor" <?php echo ($cmpState == 'Selangor') ? 'selected' : '' ?>>Selangor</option>
                                    <option value="Terengganu" <?php echo ($cmpState == 'Terengganu') ? 'selected' : '' ?>>Terengganu</option>
                                </select>
                                <i class="uil uil-estate icon"></i>
                            </div>

                            <label style="color:silver; margin-top: 10px;">____________________________________________________________________________________________</label>

                            <div class="title">
                                <h2>Company Details</h2>
                            </div>

                            <div class="pass-box">
                                <label>Company Internship Placement :</label>
                                <input type="text" placeholder="Enter internship placement" name="cmpPlacement" id="input_placement" pattern="[0-9]{1,}" required >
                                <i class="uil uil-book-open icon"></i>
                            </div>

                            <div class="pass-box">
                                <label>Company Fields Area:</label>
                                <input type="text" placeholder="Enter fields area" name="cmpFields" id="input_field" required>
                                <i class='fa fa-briefcase icon'></i>
                            </div>

                            <div class="pass-box">
                                <label>Company Size :</label>
                                <select type="text" name="cmpSize" onchange=" checkCmpSizeDownGrade()" id="input_size">
                                    <option value="0">Company Size</option>
                                    <option value="Micro" <?php echo ($size == 'Micro') ? 'selected' : '' ?> >Micro: 1 - 4</option>
                                    <option value="Small" <?php echo ($size == 'Small') ? 'selected' : '' ?> >Small: 5 - 74</option>
                                    <option value="Medium" <?php echo ($size == 'Medium') ? 'selected' : '' ?>>Medium: 75 - 200</option>
                                    <option value="Large" <?php echo ($size == 'Large') ? 'selected' : '' ?>>Large: > 200</option>
                                </select>
                                <i class='fa fa-building icon'></i>
                            </div>
                            

                            <!--<div class="pass-box">
                                <label>Company Average Allowance :</label>
                                <input type="text" placeholder="Enter average allowance" name="allowance" id="input_allowance" pattern="^[0-9]+\.?[0-9]{0,2}$" required>
                                <i class="uil uil-usd-circle icon"></i>
                            </div>-->

                            <div class="pass-box">
                                <label> Company Rating :</label>
                                <input type="text" placeholder="Enter company rating" name="rating" id="input_rating" pattern="^[0-9]+\.?[0-9]{0,1}$" required >
                                <i class="uil uil-star icon"></i>
                            </div>
                            
                            <div class="pass-box">
                                <label>Account Status :</label>
                                <select type="text" name="status" id="input_status">
                                    <option value="0">Select Status</option>
                                    <option value="Pending" <?php echo ($status == 'Pending') ? 'selected' : '' ?> >Pending</option>
                                    <option value="InitialPass" <?php echo ($status == 'InitialPass') ? 'selected' : '' ?> >InitialPass</option>  
                                    <option value="Rejected" <?php echo ($status == 'Rejected') ? 'selected' : '' ?> >Rejected</option>   
                                    <option value="Approved" <?php echo ($status == 'Approved') ? 'selected' : '' ?> >Approved</option>   
                                    <option value="Successful" <?php echo ($status == 'Successful') ? 'selected' : '' ?> >Successful</option>   
                                </select>
                                <i class='fa fa-lightbulb-o icon'></i>
                            </div>
                            

                            <label style="color:silver; margin-top: 10px;">____________________________________________________________________________________________</label>

                            </div>
                        </div> 
                        <button type = "submit" name="updatedata" style="margin-left:200px;">Update</button>
                    </form>
                
           
                </div>
            </div>
        </div>  
    </div>

<!-- VIEW MODAL -->
    <div id="view-modal">
        <div class="model">
            <div class="top-form">
                <h2>Company Details</h2>
                <div class="close-modal">
                    &#10006;
                </div>  
            </div>
            <div class="login-form">
                <div class="content">
                    <form action="ky-exportCmpDetails.php" method="POST">
                    <div class="scroll-bg">
                        <div class="user-details">
                            
                            <input type="hidden" placeholder="Enter your id" name="update_id" id="input_id2" required readonly>
                            
                            <div class="title">
                                <h2>Company Name & Contact</h2>
                            </div>
                            <div class="input-box">
                                <label>Company Name :</label>
                                <input type="text" placeholder="Enter your name" name="cmpName" id="input_name2" required readonly>
                                <i class="uil uil-user-circle icon"></i>
                            </div>
                            
                            <div class="pass-box">
                                <label>Email :</label>
                                <input type="text" placeholder="Enter programme" name="email" id="input_email2" required readonly>
                                <i class="uil uil-envelope icon"></i>
                            </div>

                            <div class="pass-box">
                                <label>Contact No :</label>
                                <input type="text"  pattern="[0-9]{10,11}" placeholder="Enter contact No" name="ContactNo" id="input_phone2" required readonly>
                                <i class="uil uil-phone icon"></i>
                            </div>

                            <div class="pass-box">
                                <label>Company Contact Person :</label>
                                <input type="text" placeholder="Enter contact person" name="cmpContactPerson" id="input_username2" readonly>
                                <i class="uil uil-chat-bubble-user icon"></i>
                            </div>

                            <div class="pass-box">
                                <label>Date Added :</label>
                                <input type="text" placeholder="Date Joined" name ="dateJoined" id="input_dateJoined2" required readonly>
                                <i class='fa fa-calendar icon'></i>
                            </div>

                            <label style="color:silver; margin-top: 10px;">____________________________________________________________________________________________</label>

                            <div class="title">
                                <h2>Company Address</h2>
                            </div>

                            <div class="input-box">
                                <label>Address :</label>
                                <input type="text" placeholder="Enter Address" name="cmpAddress" id="input_address2" required readonly>
                                <i class="uil uil-estate icon"></i>
                            </div>

                            <div class="pass-box">
                                <label>City :</label>
                                <input type="text" placeholder="Enter City" name="cmpCity" id="input_city2" required readonly>
                                <i class="uil uil-estate icon"></i>
                            </div>

                            <div class="pass-box">
                                <label>Post Code :</label>
                                <input type="text" placeholder="Enter Post Code" name="cmpPostCode" id="input_postCode2" required readonly>
                                <i class="uil uil-estate icon"></i>
                            </div>
                            
                            <div class="pass-box">
                                <label>State :</label>
                                <input type="text" placeholder="Enter City" name="cmpState" id="input_state2" required readonly>
                                <i class="uil uil-estate icon"></i>
                            </div>

                            <label style="color:silver; margin-top: 10px;">____________________________________________________________________________________________</label>

                            <div class="title">
                                <h2>Company Details</h2>
                            </div>

                            <div class="pass-box">
                                <label>Company Internship Placement :</label>
                                <input type="text" placeholder="Enter internship placement" name="cmpPlacement" id="input_placement2" required readonly>
                                <i class="uil uil-book-open icon"></i>
                            </div>

                            <div class="pass-box">
                                <label>Company Fields Area:</label>
                                <input type="text" placeholder="Enter fields area" name="cmpFields" id="input_field2" required readonly>
                                <i class='fa fa-briefcase icon'></i>
                            </div>

                            <div class="pass-box">
                                <label>Company Size :</label>
                                <input type="text" placeholder="Enter company size" name="cmpSize" id="input_size2" readonly>
                                <i class='fa fa-building icon'></i>
                            </div>

                            <!--<div class="pass-box">
                                <label>Company Average Allowance :</label>
                                <input type="text" placeholder="Enter average allowance" name="allowance" id="input_allowance2" required readonly>
                                <i class="uil uil-usd-circle icon"></i>
                            </div>-->

                            <div class="pass-box">
                                <label> Company Rating :</label>
                                <input type="text" placeholder="Enter company rating" name="rating" id="input_rating2" required readonly>
                                <i class="uil uil-star icon"></i>
                            </div>
                            
                            <div class="pass-box">
                                <label>Account Status :</label>
                                <input type="text" placeholder="Enter status" name="status" id="input_status2" required readonly>
                                <i class='fa fa-lightbulb-o icon'></i>
                            </div>
                            <label style="color:silver; margin-top: 10px;">____________________________________________________________________________________________</label>
  
                        </div> 
                        </div>
                            <button type = "submit" name="Exportpdf"  style=" margin-left: 70px; margin-right: 40px;">Export</button>
                            <button id="close-modal" type="button" class="submit-btn">Cancel</button>
                           
                    </form>
                </div>
            </div>
        </div>  
    </div>

    <script type="text/javascript">
        function toModal(Id, name, email , phone , cmpContactPerson , size , address , fieldArea , cmpInternshipPlacement , dateJoined, status, rating, cmpCity, cmpPostCode, cmpState){
           
        $('#login-modal').fadeIn().css("display", "flex");
            document.getElementById('input_id').value = Id;
            document.getElementById('input_name').value = name;
            document.getElementById('input_email').value = email;
            document.getElementById('input_phone').value = phone;
            document.getElementById('input_username').value = cmpContactPerson;
            document.getElementById('input_size').value = size;
            document.getElementById('input_size').setAttribute('onchange',`checkCmpSizeDownGrade('${Id}', '${size}', this)`);
            document.getElementById('input_address').value = address;
            document.getElementById('input_field').value = fieldArea;
            document.getElementById('input_placement').value = cmpInternshipPlacement;
            //document.getElementById('input_allowance').value = allowance;
            document.getElementById('input_dateJoined').value = dateJoined;
            document.getElementById('input_status').value = status;
            document.getElementById('input_rating').value = rating;
            document.getElementById('input_city').value = cmpCity;
            document.getElementById('input_postCode').value = cmpPostCode;
            document.getElementById('input_state').value = cmpState;
           // $cmpSize1=size;
           // $cmpState1=cmpState;
           // $status1=status;

          
            //console.log(input_name, email)
            

            $('.close-modal').click(function(){
                $('#login-modal').fadeOut();
            });

            $('.close-modal').click(function(){
                $('#view-modal').fadeOut();
            });
        }
  
    </script>

    <script type="text/javascript">
        function viewModal(Id, name, email , phone , cmpContactPerson , size , address , fieldArea , cmpInternshipPlacement , dateJoined, status, rating, cmpCity, cmpPostCode, cmpState){
           
        $('#view-modal').fadeIn().css("display", "flex");
            document.getElementById('input_id2').value = Id;
            document.getElementById('input_name2').value = name;
            document.getElementById('input_email2').value = email;
            document.getElementById('input_phone2').value = phone;
            document.getElementById('input_username2').value = cmpContactPerson;
            document.getElementById('input_size2').value = size;
            document.getElementById('input_address2').value = address;
            document.getElementById('input_field2').value = fieldArea;
            document.getElementById('input_placement2').value = cmpInternshipPlacement;
            //document.getElementById('input_allowance2').value = allowance;
            document.getElementById('input_dateJoined2').value = dateJoined;
            document.getElementById('input_status2').value = status;
            document.getElementById('input_rating2').value = rating;
            document.getElementById('input_city2').value = cmpCity;
            document.getElementById('input_postCode2').value = cmpPostCode;
            document.getElementById('input_state2').value = cmpState;

            $('.close-modal').click(function(){
                $('#view-modal').fadeOut();
            });

            $('.close-modal').click(function(){
                $('#login-modal').fadeOut();
            });
        }
           
    </script>


    <script type="text/javascript">
        $(function(){

            $('.close-modal').click(function(){
                $('#view-modal').fadeOut();
            });

            $('#close-modal').click(function(){
                $('#view-modal').fadeOut();
            });

            $('.close-modal').click(function(){
                $('#login-modal').fadeOut();
            });

            $('#close-modal').click(function(){
                $('#login-modal').fadeOut();
            });
        });
    </script>



<script>
        $(document).ready(function(){
            $('.viewbtn').on('click', function () {
                $('#view-modal').fadeIn().css("display", "flex");
                $tr=$(this).closest('tr');
                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();

                console.log(data);
               
            });

            $('.close-modal').click(function(){
                $('#view-modal').fadeOut();
            });
        
        });
    </script>


<script src="../../js/classie.js"></script>
<script src="../../js/bootstrap.js"> </script>
<script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../../js/dataTables.bootstrap.min.js"></script>
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

    $(document).ready(function() {
        $('.table-view').DataTable({
        "bLengthChange": false,
        "info": false
        });         
    });

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

    async function checkCmpSizeDownGrade(companyID, currSize, inputObject){
        let response = await fetch(`../../app/DAL/ajaxCheckCmpSizeDownGrade.php?companyID=${companyID}`).then(response => response.json());

        let cmpSize = inputObject.value;
        let cmpConvertToPlacementNo = 0;

        let defaultValue = `${currSize}`;
        let defaultOption = 1;

        if(defaultValue == 'Small'){
            defaultOption = 2;
        }else if(defaultValue == 'Medium'){
            defaultOption = 3;
        }else if(defaultValue == 'Large'){
            defaultOption = 4;
        }

        if(cmpSize == 'Micro'){
            cmpConvertToPlacementNo = 2;          
        }else if(cmpSize == 'Small'){
            cmpConvertToPlacementNo = 8;         
        }else if(cmpSize == 'Medium'){
            cmpConvertToPlacementNo = 20;           
        }else if(cmpSize == 'Large'){
            cmpConvertToPlacementNo = 50;           
        }

        if(response == 'Failed'){
            alert('Unable To Proceed Current Operation');
            inputObject.value = `${currSize}`;
        }else{
            if(cmpConvertToPlacementNo < response[0]['totalMaxQuota']){
                alert('You Are Not Allowed To Downgrade Company Size\nReason: Current Company Size Has More Than '+response[0]['totalMaxQuota']+' Internship Placement\n\nNumber Of Placement\nMicro = 2\nSmall = 8\nMedium = 20\nLarge = 50');

                inputObject.getElementsByTagName('option')[defaultOption].selected = 'selected';
            }
        }

    }
</script>


</html>