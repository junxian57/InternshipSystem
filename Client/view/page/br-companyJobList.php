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
    <link rel="stylesheet" href="../../scss/br-companyJobList.css">
</head>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once "../../includes/sidebar.php"; ?>
        <?php include_once "../../includes/header.php"; ?>
        <div id="page-wrapper">
            <div class="main-page">
                <div class="forms">
                <h3 class="page-title">Company Job List</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                        <div class="wrapper">
                            <div class="table-title">
                                <p>Hint: Table Below Is Scrollable</p>
                                <h4>Result Table</h4>
                                <input type="search" id="keyInput-update" onkeyup="searchInTable(document.getElementById('view-job-table'), document.getElementById(this.id))" placeholder="Enter Job Name...">
                            </div>
                            <div class="orange-border">
                                <table id="view-job-table">
                                    <thead>
                                        <th>#</th>
                                        <th>Job ID</th>
                                        <th>Job Title</th>
                                        <th>Post Date</th>
                                        <th>Slot Occupy</th>
                                        <th>Supervisor</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>22InJ00001</td>
                                            <td>Software Engineer Intern</td>
                                            <td>1-11-2022</td>
                                            <td><span>3</span>/4</td>
                                            <td>Leong Cheng Lok</td>
                                            <td class="btn-td">
                                                <a class="edit button" href="edit-job.php?id=<?php echo "ID"; ?>">Edit</a>
                                                <a class="remove button" href="delete-job.php?id=<?php echo "ID"; ?>">Delete</a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>2</td>
                                            <td>22InJ00001</td>
                                            <td>Software Engineer Intern</td>
                                            <td>1-11-2022</td>
                                            <td><span>3</span>/4</td>
                                            <td>Leong Cheng Lok</td>
                                            <td class="btn-td">
                                                <a class="edit button" href="edit-job.php?id=<?php echo "ID"; ?>">Edit</a>
                                                <a class="remove button" href="delete-job.php?id=<?php echo "ID"; ?>">Delete</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>22InJ00001</td>
                                            <td>Software Engineer Intern</td>
                                            <td>1-11-2022</td>
                                            <td><span>3</span>/4</td>
                                            <td>Leong Cheng Lok</td>
                                            <td class="btn-td">
                                                <a class="edit button" href="edit-job.php?id=<?php echo "ID"; ?>">Edit</a>
                                                <a class="remove button" href="delete-job.php?id=<?php echo "ID"; ?>">Delete</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>22InJ00001</td>
                                            <td>Software Engineer Intern</td>
                                            <td>1-11-2022</td>
                                            <td><span>3</span>/4</td>
                                            <td>Leong Cheng Lok</td>
                                            <td class="btn-td">
                                                <a class="edit button" href="edit-job.php?id=<?php echo "ID"; ?>">Edit</a>
                                                <a class="remove button" href="delete-job.php?id=<?php echo "ID"; ?>">Delete</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>22InJ00001</td>
                                            <td>Software Engineer Intern</td>
                                            <td>1-11-2022</td>
                                            <td><span>3</span>/4</td>
                                            <td>Leong Cheng Lok</td>
                                            <td class="btn-td">
                                                <a class="edit button" href="edit-job.php?id=<?php echo "ID"; ?>">Edit</a>
                                                <a class="remove button" href="delete-job.php?id=<?php echo "ID"; ?>">Delete</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>22InJ00001</td>
                                            <td>Software Engineer Intern</td>
                                            <td>1-11-2022</td>
                                            <td><span>3</span>/4</td>
                                            <td>Leong Cheng Lok</td>
                                            <td class="btn-td">
                                                <a class="edit button" href="edit-job.php?id=<?php echo "ID"; ?>">Edit</a>
                                                <a class="remove button" href="delete-job.php?id=<?php echo "ID"; ?>">Delete</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>22InJ00001</td>
                                            <td>Java Developer Intern</td>
                                            <td>1-11-2022</td>
                                            <td><span>3</span>/4</td>
                                            <td>Leong Cheng Lok</td>
                                            <td class="btn-td">
                                                <a class="edit button" href="edit-job.php?id=<?php echo "ID"; ?>">Edit</a>
                                                <a class="remove button" href="delete-job.php?id=<?php echo "ID"; ?>">Delete</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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
            td = tr[i].getElementsByTagName("td")[2];
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