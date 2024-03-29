<?php
session_start();
error_reporting(0);
//include_once("../../includes/db_connection.php");

require_once('../../app/BLL/ItpCommitteeBLL.php');
require_once('../../app/DTO/ItpCommitteeDTO.php');
require_once('../../app/DAL/ItpCommitteeDAL.php');

/*if (strlen($_SESSION['bpmsaid'] == 0)) {
	//header('location:logout.php');
} else {*/

$ItpCommitteeBLLObj = new ItpCommitteeBLL();
$all_itpCommittee = $ItpCommitteeBLLObj->GenerateHtmlForAllItpCommittee();

?>
<!DOCTYPE HTML>
<html>

<head>
    <title>ITP System | View Itp Committee</title>
    <link href="../../css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="../../css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="../../css/style.css" rel='stylesheet' type='text/css' />
    <link href="../../css/font-awesome.css" rel="stylesheet">
    <link href="../../scss/navtab.css" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href="../../css/animate.css" rel="stylesheet" type="text/css" media="all">
    <link href="../../css/custom.css" rel="stylesheet">

    <script src="../../js/jquery-1.11.1.min.js"></script>
    <script src="../../js/modernizr.custom.js"></script>>
    <script src="../../js/wow.min.js"></script>
    <script src="../../js/metisMenu.min.js"></script>
    <script src="../../js/custom.js"></script>

    <script>
        new WOW().init();
    </script>

    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
</head>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once('../../includes/sidebar.php'); ?>
        <?php include_once('../../includes/header.php'); ?>
        <div id="page-wrapper">
            <div class="main-page">
                <div class="tables">
                    <h3 class="page-title">Itp Committee</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">

                        <div id="itpCommittee" class="tabcontent" style="display:block">
                            <div class="row">
                                <div class="table-title">
                                    <h4>Itp Committee Table</h4>
                                </div>
                            </div>
                            <?php
                            echo $all_itpCommittee;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
            async function deleteDocument(documentID) {
                let text = "Do you want to delete the document?\nChoose OK or Cancel.";

                if (confirm(text)) {
                    let url = `../../app/DAL/ajaxDeleteDocument.php?documentID=${documentID}&Document=Document`;
                    let response = await fetch(url);
                    let data = await response.json();

                    if (data == "Success") {
                        location.reload();
                        alert("Update Successfully");
                    } else {
                        alert("Update Failed");
                    }
                }
            }
        </script>

        <!--Table JS sorting,searchinh,pagination-->
        <script>
            $(document).ready(function() {
                $('#itpCommitteeTbl').DataTable({
                    //custom search bar 
                    "language": {
                        searchPlaceholder: "Search Document"
                    },
                    "searchBox": {
                        "addClass": 'form-control input-lg col-xs-12'
                    },

                    "fnDrawCallback": function() {
                        $("input[type='search']").attr("id", "searchBox");
                        $('#dialPlanListTable').css('cssText', "margin-top: 0px !important;");
                        $("select[name='dialPlanListTable_length'], #searchBox").removeClass("input-sm");
                        $("select[name='dialPlanListTable_length'], #searchBox").addClass("input-md");
                        //$('#searchBox').css("width", "250px");
                        $('#dialPlanListTable_filter').removeClass('dataTables_filter');

                        $('.sorting').css("width", "");
                        //$('#test1').style.remove('width');
                    },
                });
            });
        </script>
        <script src="../../js/classie.js"></script>
        <script src="../../js/bootstrap.js"> </script>

        <script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="../../js/dataTables.bootstrap.min.js"></script>
</body>
<footer><?php include_once('includes/footer.php'); ?></footer>

</html>