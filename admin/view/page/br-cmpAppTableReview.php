<?php
session_start();
$systemPathPrefix = $_SERVER['DOCUMENT_ROOT'].'/internshipSystem/admin/';

require_once $systemPathPrefix."app/DAL/companyDAL.php";

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
    <link rel="stylesheet" type="text/css" href="../../css/dataTables.bootstrap.css" />
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css">
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
    <link rel="stylesheet" href="../../scss/br-cmpAppReview.css">
</head>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once('../../includes/sidebar.php'); ?>
        <?php include_once('../../includes/header.php'); ?>
        <div id="page-wrapper">
            <div class="main-page">
                <div class="forms">
                    <h3 class="page-title">Company Application Review</h3>
                    <div class="form-grids row widget-shadow custom-padding" data-example-id="basic-forms">
                        <div id="StudentToSupervisor" class="tab-content">
                            <div>
                                <table id="review-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Company ID</th>
                                            <th>Company Name</th>
                                            <th>Application Date</th>
                                            <th>Fields Area</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $statusArr = ["Pending", "Amended Info"];
                                       // echo $statusArr;
                                            $result = getCompanyWithStatus($statusArr);

                                            if(count($result) > 0){
                                                $i = 1;
                                                foreach($result as $row){
                                                    echo "<tr>";
                                                    echo "<td>".$i."</td>";
                                                    echo "<td>".$row['companyID']."</td>";
                                                    echo "<td>".$row['cmpName']."</td>";
                                                    echo "<td>".$row['cmpDateJoined']."</td>";
                                                    echo "<td>".$row['cmpFieldsArea']."</td>";
                                                    echo "<td>".$row['cmpAccountStatus']."</td>";
                                                    echo "<td><a target='_blank' href='br-cmpDetailsPreview.php?companyID=".$row['companyID']."&status=1&action=1'>View</a></td>";
                                                    echo "</tr>";
                                                    $i++;
                                                }
                                            }
                                        ?>                           
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer><?php include_once('../../includes/footer.php'); ?></footer>
</body>

<script src="../../js/classie.js"></script>
<script src="../../js/bootstrap.js"> </script>
<script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../../js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.3.1/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
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
      let table = $('#review-table').DataTable({
            "bLengthChange": false,
            "info": false,
            "dom": 'lrtp',
            responsive : true
        });
        $.fn.dataTable.FixedHeader(table);
    });
</script>
<?php
if(isset($_GET['companyID']) && isset($_GET['reject']) && isset($_GET['companyName'])){
    $decodeName = urldecode($_GET['companyName']);
    $companyID = $_GET['companyID'];

    echo "<script> 
    alert(`Company ID: $companyID\nCompany Name: $decodeName\nStatus: Rejected Successfully\n`)
    window.location.href = 'br-cmpAppTableReview.php';
    </script>";

}elseif(isset($_GET['companyID']) && isset($_GET['approve']) && isset($_GET['companyName'])){
    $decodeName = urldecode($_GET['companyName']);
    $companyID = $_GET['companyID'];

    echo "<script> 
    alert(`Company ID: $companyID\nCompany Name: $decodeName\nStatus: Approved Successfully`)
    window.location.href = 'br-cmpAppTableReview.php';
    </script>";

}elseif(isset($_GET['companyID']) && isset($_GET['failed']) && isset($_GET['companyName'])){
    $decodeName = urldecode($_GET['companyName']);
    $companyID = $_GET['companyID'];

    echo "<script> 
    alert('Company ID: $companyID\nCompany Name: $decodeName\nStatus: Update Failed\n')
    window.location.href = 'br-cmpAppTableReview.php';
    </script>";
}
?>


</html>