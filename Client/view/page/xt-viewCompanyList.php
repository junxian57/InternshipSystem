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
	<link href="../../css/xt-viewCompanyDetails.css" rel="stylesheet">
	<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
	<link href="../../css/animate.css" rel="stylesheet" type="text/css" media="all">
	<link href="../../css/custom.css" rel="stylesheet">

	<script src="../../js/jquery-1.11.1.min.js"></script>
	<script src="../../js/modernizr.custom.js"></script>>
	<script src="../../js/wow.min.js"></script>
	<script src="../../js/metisMenu.min.js"></script>
	<script src="../../js/custom.js"></script>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700&display=swap');

    .cmpList{
      padding:3rem 3%;
    }
    
    .cmpList .cmpList-container{
      font-family: 'Nunito', sans-serif;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(30rem, 1fr));
      gap: 3.5rem;
      padding-bottom:30px;
    }

    .cmpList .cmpList-container .cmpL{
      font-family: 'Nunito', sans-serif;
      border:.1rem solid #919191;
      border-radius: .5rem;
      box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.1);
    }

    .cmpList .cmpList-container .cmpL .cmpLimage{
      height: 10rem;
      width: 100%;
      padding:1.5rem;
      overflow: hidden;
      position: relative;
    }

    .cmpList .cmpList-container .cmpL .cmpLimage img{
      height: 100%;
      width: 100%;
      border-radius: .5rem;
      object-fit: contain;
    }

    .cmpList .cmpList-container .cmpL .cmpLimage img:hover{
      transform:scale(1.2);
    }

    .cmpList .cmpList-container .cmpL .cmpLcontent{
      font-family: 'Nunito', sans-serif;
      text-align:center;
      padding:2rem;
      padding-top: 0;
    }

    .cmpList .cmpList-container .cmpL .cmpLcontent h3{
      font-family: 'Nunito', sans-serif;
      color: #f2891f;
      font-weight:700;
      font-size: 2.0rem;
    }

    .cmpList .cmpList-container .cmpL .cmpLcontent p{
      font-family: 'Nunito', sans-serif;
      color:#D3AD7F;
      font-size: 1.6rem;
      padding:.5rem 0;
      line-height: 1.5;
    }

    .cmpL-btn{
      margin-top: 1rem;
      display: inline-block;
      font-size: 12px;
      color: #fff3a6c9;
      background: #000;
      border-radius: .5rem;
      cursor: pointer;
      padding:.8rem 2rem;
    }

    .cmpL-btn:hover{
      background: #000;
      color:#fd9a7e;
      text-decoration: none;
      font-size: 12px;
    }

    .table{
      width: 100%;
      max-width: 100%;
      margin-bottom: 1rem;
      background-color: transparent
    }

    .table td{
      text-align: left;
    }

    .table th{
      text-align: right;
      font-weight: 700;
    }

    p{
      font-size: 14px;
      margin: 0 0 10px;
    }

    .cmpLFooter{
      display: flex;
      align-items: center;
      background-color: transparent;
      padding-top: 0;
      border: 0;
      border-radius: 6px;
      justify-content: space-between;
    }

  </style>
		
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
				<div class="tablesr">
					<h3 class="title1">Companies List</h3>
          <section class="cmpList" id="cmpList">
            <div class="cmpList-container">
              <div class='cmpL'>
                <div class='cmpLimage'>
                  <img src='../images/taruc-logo.jpg'>
                </div>
                <div class='cmpLcontent'>
                  <h3>Tunku Abdul Rahman University College</h3>
                  <p class="description"></p>
                  <table class="table">
                    <tbody>
                      <tr>
                        <th>Job Title</th>
                        <td>Software Developer Intern (6 months)-Kuala Lumpur</td>
                      </tr>
                      <tr>
                        <th>Address</th>
                        <td>Suite 29-2, Level 29, Vertical Corporate Tower B, Avenue 10, Bangsar South City, No.8 Jalan Kerinchi Kuala Lumpur, Malaysia., 59200, Kuala Lumpur</td>
                      </tr>
                      <tr>
                        <th>Fields Area</th>
                        <td>Finance & Accounting</td>
                      </tr>
                      <tr>
                        <th>Allowance</th>
                        <td>RM 1,500.00 - RM 1,500.00</td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="cmpLFooter">
                    <p></p>
                    <a href='' class='cmpL-btn'>View</a>
                  </div>
                </div>
              </div>

              <div class='cmpL'>
                <div class='cmpLimage'>
                  <img src='../images/taruc-logo.jpg'>
                </div>
                <div class='cmpLcontent'>
                  <h3>Guidewire Software Sdn. Bhd.</h3>
                  <p class="description"></p>
                  <table class="table">
                    <tbody>
                      <tr>
                        <th>Job Title</th>
                        <td>Software Developer Intern (6 months)-Kuala Lumpur</td>
                      </tr>
                      <tr>
                        <th>Address</th>
                        <td>Suite 29-2, Level 29, Vertical Corporate Tower B, Avenue 10, Bangsar South City, No.8 Jalan Kerinchi Kuala Lumpur, Malaysia., 59200, Kuala Lumpur</td>
                      </tr>
                      <tr>
                        <th>Fields Area</th>
                        <td>Finance & Accounting</td>
                      </tr>
                      <tr>
                        <th>Allowance</th>
                        <td>RM 1,500.00 - RM 1,500.00</td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="cmpLFooter">
                    <p></p>
                    <a href='' class='cmpL-btn'>View</a>
                  </div>
                </div>
              </div>

              <div class='cmpL'>
                <div class='cmpLimage'>
                  <img src='../images/taruc-logo.jpg'>
                </div>
                <div class='cmpLcontent'>
                  <h3>Safeguards CS Sdn Bhd</h3>
                  <p class="description"></p>
                  <table class="table">
                    <tbody>
                      <tr>
                        <th>Job Title</th>
                        <td>Software Developer Intern (6 months)-Kuala Lumpur</td>
                      </tr>
                      <tr>
                        <th>Address</th>
                        <td>Suite 29-2, Level 29, Vertical Corporate Tower B, Avenue 10, Bangsar South City, No.8 Jalan Kerinchi Kuala Lumpur, Malaysia., 59200, Kuala Lumpur</td>
                      </tr>
                      <tr>
                        <th>Fields Area</th>
                        <td>Finance & Accounting</td>
                      </tr>
                      <tr>
                        <th>Allowance</th>
                        <td>RM 1,500.00 - RM 1,500.00</td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="cmpLFooter">
                    <p></p>
                    <a href='' class='cmpL-btn'>View</a>
                  </div>
                </div>
              </div>

              <div class='cmpL'>
                <div class='cmpLimage'>
                  <img src='../images/taruc-logo.jpg'>
                </div>
                <div class='cmpLcontent'>
                  <h3>Safeguards CS Sdn Bhd</h3>
                  <p class="description"></p>
                  <table class="table">
                    <tbody>
                      <tr>
                        <th>Job Title</th>
                        <td>Software Developer Intern (6 months)-Kuala Lumpur</td>
                      </tr>
                      <tr>
                        <th>Address</th>
                        <td>Suite 29-2, Level 29, Vertical Corporate Tower B, Avenue 10, Bangsar South City, No.8 Jalan Kerinchi Kuala Lumpur, Malaysia., 59200, Kuala Lumpur</td>
                      </tr>
                      <tr>
                        <th>Fields Area</th>
                        <td>Finance & Accounting</td>
                      </tr>
                      <tr>
                        <th>Allowance</th>
                        <td>RM 1,500.00 - RM 1,500.00</td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="cmpLFooter">
                    <p></p>
                    <a href='' class='cmpL-btn'>View</a>
                  </div>
                </div>
              </div>

              <div class='cmpL'>
                <div class='cmpLimage'>
                  <img src='../images/taruc-logo.jpg'>
                </div>
                <div class='cmpLcontent'>
                  <h3>Safeguards CS Sdn Bhd</h3>
                  <p class="description"></p>
                  <table class="table">
                    <tbody>
                      <tr>
                        <th>Job Title</th>
                        <td>Software Developer Intern (6 months)-Kuala Lumpur</td>
                      </tr>
                      <tr>
                        <th>Address</th>
                        <td>Suite 29-2, Level 29, Vertical Corporate Tower B, Avenue 10, Bangsar South City, No.8 Jalan Kerinchi Kuala Lumpur, Malaysia., 59200, Kuala Lumpur</td>
                      </tr>
                      <tr>
                        <th>Fields Area</th>
                        <td>Finance & Accounting</td>
                      </tr>
                      <tr>
                        <th>Allowance</th>
                        <td>RM 1,500.00 - RM 1,500.00</td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="cmpLFooter">
                    <p></p>
                    <a href='' class='cmpL-btn'>View</a>
                  </div>
                </div>
              </div>
            
          </section>
        </div>
		</div>
	</div>
	
	<script src="../../js/classie.js"></script>
	<script src="../../js/jquery.nicescroll.js"></script>
	<script src="../../js/scripts.js"></script>
	<script src="../../js/bootstrap.js"> </script>
</body>
</html>