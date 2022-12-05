<?php
$systemPathPrefix = $_SERVER['DOCUMENT_ROOT'].'/InternshipSystem/Client/';
require_once $systemPathPrefix."app/DAL/internJobDAL.php";

if(session_status() != PHP_SESSION_ACTIVE) session_start();

if(!isset($_SESSION['companyID'])){
    echo "<script>
        alert('You are not permitted to enter this page.\\nPlease login as a company.');
        //window.location.href = 'br-login.php';
    </script>";
}else{
    //TODO: Check if user is logged in, get company ID from session
    //Get Company ID from Session
    //$companyID = $_SESSION['companyID'];
    $companyID = 'CMP00008';
}

try{  
    $internJobList = getInternJobList($companyID);
}catch(Exception $e){
    echo '<script>alert("Database Connection Error")</script>';
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
                                <h4>Result Table</h4>
                            </div>
                            <div>
                                <table id="view-job-table">
                                    <thead>
                                        <th>#</th>
                                        <th>Job ID</th>
                                        <th>Job Title</th>
                                        <th>Slot Occupy</th>
                                        <th>Supervisor</th>
                                        <th>Supervisor Email</th>
                                        <th>Job Status</th>
                                        <th>Post Date</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody id="view-job-tbody">
                                        <?php
                                            $i = 1;
                                            foreach($internJobList as $row){
                                                $internJobID = $row['internJobID'];
                                                $buttonGroup = '';
                                                if($row['jobCurrOccNumber'] > 0 || $row['jobStatus'] == "Deleted" || $row['jobStatus'] == "Full" || $row['jobStatus'] == "Done"){

                                                    $buttonGroup = "<a target='_blank' class='edit button' href='br-companyViewJob.php?view=1&internJobID=".$internJobID."'>View</a>";

                                                }elseif($row['jobCurrOccNumber'] == 0){

                                                    $buttonGroup = "
                                                    <a target='_blank' class='edit button' href='br-companyViewJob.php?edit=1&internJobID=".$internJobID."'>View</a>
                                                    <button class='remove button' onclick='deleteInternJob('".$internJobID."')'> Delete </button>";

                                                }
                                                echo '<tr>';
                                                echo '<td>'.$i.'</td>';
                                                echo '<td>'.$row['internJobID'].'</td>';
                                                echo '<td>'.$row['jobTitle'].'</td>';
                                                echo '<td>'.$row['jobCurrOccNumber'].' / '.$row['jobMaxNumberQuota'].'</td>';
                                                echo '<td>'.$row['jobCmpSupervisor'].'</td>';
                                                echo '<td>'.$row['jobSupervisorEmail'].'</td>';
                                                echo '<td>'.$row['jobStatus'].'</td>';
                                                echo '<td>'.$row['jobPostDate'].'</td>';
                                                echo '<td class="btn-td">
                                                    <div class="button-group">
                                                        '.$buttonGroup.'
                                                    </div>  
                                                </td>';
                                                echo '</tr>';
                                                $i++;
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
    <footer><?php include_once "../../includes/footer.php"; ?></footer>
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
        let table = $('#view-job-table').DataTable({
            "bLengthChange": false,
            "info": false,
            responsive : true
        });

        $.fn.dataTable.FixedHeader(table);
    });

    async function deleteInternJob(job){
        let confirmation = confirm("Are you sure you want to delete this job?");

        if(confirmation){
            let url = `../../app/DAL/ajaxDeleteInternJob.php?internJobID=${job}&companyID=<?php echo $companyID; ?>&delete=1`;
            let response = await fetch(url).then(response => response.json());
    
            if(response == "Success"){
                alert("Delete Success");
                location.reload();
            }else if(response == 'Failed'){
                alert("Delete Failed, Please Try Again");
            }else if(response == 'InternshipMapIsNotEmpty'){
                alert("Delete Failed, There are students applied for the job");
            }
        }
    }

</script>
<script>
 
</script>


</html>