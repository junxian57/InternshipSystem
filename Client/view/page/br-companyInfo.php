<?php
session_start();
error_reporting(0);
include "includes/db_connection.php";

//prettier client\view\page\br-StudentSupervisor-Manage.php --write
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
    <link rel="stylesheet" href="../../scss/br-companyInfo.css">
</head>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once "../../includes/sidebar.php"; ?>
        <?php include_once "../../includes/header.php"; ?>
        <div id="page-wrapper">
            <div class="main-page">
                <div class="forms">
                    <h3 class="page-title">Company Information</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                        <div class="wrapper">
                        <form action="#">
                            <div class="title">
                                <h2>Company Name & Contact</h2>
                            </div>

                            <div class="horizon-wrap">
                                <div class="input-style name-address-group width-100">
                                <label for="cmpName">Name</label>
                                <input
                                    class="grey-bg"
                                    type="text"
                                    name="cmpName"
                                    readonly
                                    value="sssssssssssssssssssssss"
                                />
                                </div>
                            </div>

                            <div class="horizon-wrap">
                                <div class="input-style width-45 name-address-group">
                                <label for="cmpContactNo">Contact No.</label>
                                <input class="grey-bg" type="text" name="cmpContactNo" readonly/>
                                </div>

                                <div class="input-style width-45 name-address-group">
                                <label for="cmpEmail">Email Address</label>
                                <input class="grey-bg" type="email" name="cmpEmail" readonly/>
                                </div>
                            </div>

                            <div class="horizon-wrap">
                                <div class="input-style width-45 name-address-group">
                                <label for="cmpContactPerson">Contact Person</label>
                                <input class="grey-bg" type="text" name="cmpContactPerson" readonly/>
                                </div>

                                <div class="input-style width-45 name-address-group">
                                <label for="cmpDateJoin">Date Join</label>
                                <input type="text" class="grey-bg" name="cmpDateJoin" readonly />
                                </div>
                            </div>

                            <hr />
                            <div class="title">
                                <h2 class="margin-top-20">Company Address</h2>
                            </div>

                            <div class="horizon-wrap">
                                <div class="input-style name-address-group width-100">
                                <label for="cmpAddress">Company Address</label>
                                <input class="grey-bg" type="text" name="cmpAddress" style="word-wrap: break-word" readonly/>
                                </div>
                            </div>

                            <div class="horizon-wrap">
                                <div class="input-style width-45 name-address-group">
                                <label for="cmpState">State</label>
                                <select type="text" name="cmpState" disabled>
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
                                </div>

                                <div class="input-style width-45 name-address-group">
                                <label for="cmpPostcode">Postcode</label>
                                <input class="grey-bg" type="email" name="cmpPostcode" readonly/>
                                </div>
                            </div>

                            <div class="horizon-wrap">
                                <div class="input-style width-45 name-address-group">
                                <label for="cmpCity">City</label>
                                <input class="grey-bg" type="text" name="cmpCity" readonly/>
                                </div>
                            </div>

                            <hr />
                            <div class="title margin-btm-20">
                                <h2 class="margin-top-20">Company Details</h2>
                            </div>

                            <div class="name-address-group margin-top-20 select-style">
                                <label for="cmpFieldArea">Company Field Area</label>
                                <input
                                type="text"
                                class="grey-bg"
                                style="text-indent: 5px; border: none;"
                                name="cmpFieldArea"
                                readonly
                                />
                                <select name="fieldAreaSelection" id="fieldAreaSelection" disabled>
                                <option value="IT">IT</option>
                                <option value="Marketing">Marketing</option>
                                <option value="Finance">Finance</option>
                                <option value="Accounting">Accounting</option>
                                <option value="Banking">Banking</option>
                                </select>
                                <button id="addNewField">Add New</button>
                            </div>

                            <div class="name-address-group margin-top-20 select-style width-45">
                                <label for="cmpSize">Company Size</label>
                                <select name="cmpSize" id="cmpSize" disabled>
                                <option value="Micro">Mirco: 1 - 4</option>
                                <option value="Small">Small: 5 - 74</option>
                                <option value="Medium">Medium: 75 - 200</option>
                                <option value="Large">Large: > 200</option>
                                </select>
                            </div>
                            <hr>
                            <div class="button-group">
                                <!-- 
                                TODO:Remove all disabled and readonly, don't remove name, and date join field 
                                TODO:Remove grey-bg class
                                -->
                                <input type="button" class="clickable-btn" value="Edit"/>

                                <!-- 
                                TODO: Use js, if yes, then move to next page, ask does the company details all correct? 
                                -->
                                <a href="#" class="clickable-btn">Next</a>
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

    function searchInTable(tableID, inputID) {
        let input, filter, table, tr, td, i, txtValue;
        input = inputID;
        filter = input.value;
        table = tableID;
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[3];
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

</script>
<script>
 
</script>


</html>