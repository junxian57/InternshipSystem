<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
/*if (strlen($_SESSION['bpmsaid'] == 0)) {
	//header('location:logout.php');
} else {*/
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>ITP System | Companies List</title>
	<link href="../../css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="../../css/style.css" rel='stylesheet' type='text/css' />
	<link href="../../css/font-awesome.css" rel="stylesheet">
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
  <style>
    .cmp-btn{
      margin-top: auto;
      display: inline-block;
      padding:.9rem 3rem;
      font-size: 1.7rem;
      color:#000;
      background: var(--main-color);
      cursor: pointer;
      align-items: center;
    }

    .cmp-btn:hover{
      color: var(--main-color);;
      background: #000;
    }
      
    .cmp-pagination>li{
      display:inline;
      font-size:18px;
    }

    .cmp-pagination>li>a,.cmp-pagination>li>span{
      position:relative;
      padding:6px 12px;
      margin-left:-1px;
      line-height:1.42857143;
      color:#D3AD7F !important;
      text-decoration:none;
    }

    .cmp-pagination>li:first-child>a,.cmp-pagination>li:first-child>span{
      margin-left:0;
      border-top-left-radius:4px;
      border-bottom-left-radius:4px;
    }

    .cmp-pagination>li:last-child>a,.cmp-pagination>li:last-child>span{
      border-top-right-radius:4px;
      border-bottom-right-radius:4px;
    }

    .cmp-pagination>li>a:focus,.cmp-pagination>li>a:hover,.cmp-pagination>li>span:focus,.cmp-pagination>li>span:hover{
      z-index:2;
      color:#FFF !important;
      background-color:#D3AD7F !important;
      border-color:#D3AD7F !important;
    }

    .cmpdetails .cmpdetails-row{
      display:flex;
      align-items: center;
      background:var(--black);
      flex-wrap: wrap;
      justify-content: space-around;
      margin:30px auto;
      max-width: 95%;
      width:1200px;
    }

    .cmpdetails .cmpdetails-row .cmpdetails-image{
      flex:1 1 30rem;
    }

    .cmpdetails .cmpdetails-row .cmpdetails-image img{
      height:auto;
      width:320px;
    }

    .cmpdetails .cmpdetails-row .cmpdetails-content{
      flex:1 1 45rem;
      padding:2rem;
    }

    .cmpdetails .cmpdetails-row .cmpdetails-content h3{
      font-family: Calibri;
      font-size:2em;
      color:#d3ad7f;
    }

    .cmpdetails .cmpdetails-row .cmpdetails-content p{
      font-family: Calibri;
      font-size:1.6rem;
      color:#d3ad7f;
      padding:1rem 0;
      line-height:1.0;
    }
  </style>
</head>

<body class="cbp-spmenu-push">
	<div class="main-content">
		<?php include_once('../../includes/sidebar.php'); ?>
		<?php include_once('../../includes/header.php'); ?>
		<div id="page-wrapper">
			<div class="main-page">
				<div class="tables">
					<h3 class="title1">Companies Selection</h3>
          <section class="cmpList" id="cmpList">
            <div class="cmpbox-container">
              <?php 
              $per_page=9; 
              if(isset($_GET['page'])){
                $page = $_GET['page'];
              }else{
                $page=1;
              }
              $start_from = ($page-1) * $per_page;
              $get_cmp = "SELECT * FROM companyList WHERE cmpStatus = 'Available' LIMIT $start_from,$per_page";
              $run_cmp = mysqli_query($conn, $get_cmp);
              while($row_cmp = mysqli_fetch_array($run_cmp)){
                $cmpID = $row_cmp['cmpID'];
                $cmpName = $row_cmp['cmpName'];
                ?>
                <div class='cmpbox'>
                  <div class='cmpimage'>
                    <img src='images/$restImg'>
                  </div>
                  <div class='cmpcontent'>
                    <div class='stars'>
                      <i class='fas fa-star'></i>
                      <i class='fas fa-star'></i>
                      <i class='fas fa-star'></i>
                      <i class='fas fa-star'></i>
                      <i class='fas fa-star-half-alt'></i>
                    </div>
                    <h3>Unilifesity Sdn Bhd</h3>
                    <p><span class='fa-solid fa-location-dot'>&nbsp</span>Location</p>
                    <?php echo "<a href='company-details.php?cmpID=$cmpID' class='cmp-btn'>View Details</a>";?>
                  </div>
                </div>
                <?php
                }
                ?>
              </div>
              <center>
              <ul class="cmp-pagination">
                <?php
                $query = "select * from companyList";
                $result = mysqli_query($conn,$query);
                $total_records = mysqli_num_rows($result);
                $total_pages = ceil($total_records / $per_page);
                echo "
                      <li>
                      <a href='filteredCompanyList.php?page=1' class='fa-solid fa-arrow-left'></a></li>";
                      for($i=1; $i<=$total_pages; $i++){
                        echo "
                        <li>
                        <a href='filteredCompanyList.php?page=".$i."'> ".$i." </a></li>";    
                      };
                      echo "
                        <li>
                        <a href='filteredCompanyList.php?page=$total_pages' class='fa-solid fa-arrow-right'></a></li>"; 
                ?> 
              </ul>
              </center>
          </section>
        </div>
			</div>
		</div>
	</div>
	<script src="../../js/classie.js"></script>
	<script>
		var menuLeft = document.getElementById('cbp-spmenu-s1'),
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

	<script src="../../js/jquery.nicescroll.js"></script>
	<script src="../../js/scripts.js"></script>
	<script src="../../js/bootstrap.js"> </script>
</body>
</html>