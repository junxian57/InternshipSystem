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
    <link rel="stylesheet" href="../../scss/br-StudentSupervisor-Manage.css">
</head>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once "../../includes/sidebar.php"; ?>
        <?php include_once "../../includes/header.php"; ?>
        <div id="page-wrapper">
            <div class="main-page">
                <div class="forms">
                    <h3 class="page-title">Student Management</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">

                        <div id="ViewSupervisorMap" class="tabcontent">
                            <div class="search-group">

                                <!--                                    
                                //TODO: Require AJAX method to display searched supervisor         
                                -->
                                <div class="form-group">
                                    <label for="batch-number">Internship Batch Number <span class="required-star">*</span></label>
                                    <select name="batch-number" id="batch-number" class="form-control" required="true">
                                        <option value="0">Select a Batch Number</option>
                                        <option value="BATCH001">BATCH001</option>
                                        <option value="BATCH001">BATCH001</option>
                                        <option value="BATCH001">BATCH001</option>
                                        <option value="BATCH001">BATCH001</option>
                                    </select>
                                </div>

                            </div>

                            <div class="button-group">
                                <!--                                    
                                //TODO: onclick -> start retrieve student list and proceed mapping
                                -->
                                <button class="clickable-btn" onclick="">Search</button>
                            </div>
                            <hr>
                            <div class="table-title">
                                <p>Hint: Table Below Is Scrollable</p>
                                <h4>Result Table</h4>
                                <input type="search" id="keyInput-remove" onkeyup="searchInTable(document.getElementById('remove-table'), document.getElementById(this.id))" placeholder="Enter Student Name...">
                            </div>
                            <div class="table-responsive orange-border">
                                <table id="remove-table">
                                    <thead>
                                        <th>#</th>
                                        <th>Student ID</th>
                                        <th>Faculty</th>
                                        <th>Student Name</th>
                                        <th>Batch Number</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Poi Han</td>
                                            <td>BATCH001</td>
                                            <td class="btn-td">
                                                <div>
                                                    <a class="edit button" href="edit-services.php?editid=<?php echo "ID"; ?>">View</a>
                                                    <!-- <a class="remove button" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a> -->
                                                </div>                            
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Yan Ning</td>
                                            <td>BATCH001</td>
                                            <td class="btn-td">
                                                <div>
                                                    <a class="edit button" href="edit-services.php?editid=<?php echo "ID"; ?>">View</a>
                                                    <!-- <a class="remove button" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a> -->
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>BATCH001</td>
                                            <td class="btn-td">
                                                <div>
                                                    <a class="edit button" href="edit-services.php?editid=<?php echo "ID"; ?>">View</a>
                                                    <!-- <a class="remove button" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a> -->
                                                </div>                            
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Hui Xuan</td>
                                            <td>BATCH001</td>
                                            <td class="btn-td">
                                                <div>
                                                    <a class="edit button" href="edit-services.php?editid=<?php echo "ID"; ?>">View</a>
                                                    <!-- <a class="remove button" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a> -->
                                                </div>                            
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>21WMR08523</td>
                                            <td>FOCS</td>
                                            <td>Bryson</td>
                                            <td>BATCH001</td>
                                            <td class="btn-td">
                                                <div>
                                                    <a class="edit button" href="edit-services.php?editid=<?php echo "ID"; ?>">View</a>
                                                    <!-- <a class="remove button" href="edit-services.php?editid=<?php echo "ID"; ?>">Remove</a> -->
                                                </div>                            
                                            </td>
                                        </tr>                                     
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                        </div>

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
        filter = input.value.toUpperCase();
        table = tableID;
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[3];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
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