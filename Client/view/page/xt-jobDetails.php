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
	<title>ITP System | Job Details</title>
	<link href="../../css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="../../css/style.css" rel='stylesheet' type='text/css' />
	<link href="../../css/font-awesome.css" rel="stylesheet">
	<link href="../../css/xt-companiesList.css" rel="stylesheet">
	<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
	<link href="../../css/animate.css" rel="stylesheet" type="text/css" media="all">
	<link href="../../css/custom.css" rel="stylesheet">
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
	
	<script src="../../js/jquery-1.11.1.min.js"></script>
	<script src="../../js/modernizr.custom.js"></script>
	<script src="../../js/wow.min.js"></script>
	<script src="../../js/metisMenu.min.js"></script>
	<script src="../../js/custom.js"></script>

	<style>
		@import url("https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700&display=swap");

		.body{
			background: black;
		}
		
		.details .details-row{
    	display: flex;
    	background: transparent;
    	flex-wrap: wrap;
    	justify-content: space-around;
    	margin: 30px auto;
    	max-width: 95%;
    	width: 1200px;
		}

		.details .details-row .detailsimage{
    	flex:1 1 30rem;
		}

		.details .details-row .details-content p{
    	font-family: "Palatino-Linotype", serif !important;
    	color: #AB9368;
    	font-weight: 700;
    	font-size: 2.5rem;
		}

		.details .details-row .detailsimage img{
    	height:200px;
    	width:100%;
    	object-fit: contain;
		}

		.cmpdetails .cmpdetails-row{
    	display:flex;
    	align-items: center;
    	flex-wrap: wrap;
    	justify-content: space-around;
    	margin:30px auto;
    	max-width: 95%;
    	width:1200px;
			background: #f2f2f2;
			box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.1);
		}

		.jobdetails .jobdetails-row{
    	display:flex;
    	align-items: center;
    	flex-wrap: wrap;
    	justify-content: space-around;
    	margin:30px auto;
    	max-width: 95%;
    	width:1200px;
			background: #f2f2f2;
			box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.1);
		}

		.jobdetails .jobdetails-row .jobdetails-content{
    	flex: 1 1 30rem;
    	padding: 2rem;
		}

		.button-group{
			width: 100%;
			text-align: center;
			margin-bottom: 25px;
			font-family: Calibri;
		}

		.applyBtn {
  		font-weight: 600;
  		color: white;
  		background: #39d441;
  		width: 85px;
			height: 35px;
		}

		.backBtn {
  		font-weight: 600;
  		color: white;
  		background: #999;
  		width: 85px;
			height: 35px;
		}

		.jobdetails .jobdetails-row .jobdetails-content h3{
    	font-family: Calibri;
    	font-size: 20px;
    	color: #000;
			font-weight: 600;
		}

		.jobdetails .jobdetails-row .jobdetails-content p{
    	font-family: Calibri;
    	font-size: 18px;
    	color: #000;
    	padding: 1rem 0;
    	line-height: 1.0;
		}

		.cmpdetails .cmpdetails-row .cmpdetails-image{
    	flex: 1 1 30rem;
		}

		.cmpdetails .cmpdetails-row .cmpdetails-image img{
    	height: auto;
    	width: 320px;
		}

		.cmpdetails .cmpdetails-row .cmpdetails-content{
    	flex: 1 1 30rem;
    	padding: 2rem;
		}

		.cmpdetails .cmpdetails-row .cmpdetails-content h3{
    	font-family: Calibri;
    	font-size: 20px;
    	color: #000;
			font-weight: 600;
		}

		.cmpdetails .cmpdetails-row .cmpdetails-content p{
    	font-family: Calibri;
    	font-size: 18px;
    	color: #000;
    	padding: 1rem 0;
    	line-height: 1.0;
		}

		h1.heading{
      color: #000;
      text-transform: uppercase;
			padding-top: 20px;
      text-align:center;
		}

    .heading span{
      color: #f2891f;
      text-transform: uppercase;
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
				<div class="tables">
					<section class="details" id="details">
						<div class="details-row">
							<div class="detailsimage">
								<img src='../images/taruc-logo.jpg'>
							</div> 
						</div>
						
						<div class="details-row">
							<div class="details-content">
                <h1 class="heading" >Guidewire Software Sdn. Bhd.</h1>
            	</div>
        		</div>
					</section>
					
					<section class="jobdetails" id="jobdetails">
						<h1 class="heading"> <span>Job</span> Description </h1>
						<div class="jobdetails-row">
							<div class="jobdetails-content" style="border-right: 1px solid #CCCCCC;">
							<h3>Job Details</h3>
								<p>• Support the IT team in maintaining hardware, software, and IT resources<br>
								• Assist with troubleshooting issues and provide technical support<br>
								• Assist in any duties assigned by the immediate superior.<br>
								• Assist in create and update documentations.<br>
								• Working closely with an IT team and immediate superior.<br>
								• Get hands-on experience in building a website from scratch (wordpress or non wordpress)<br>
								• Learn to communicate with clients and help to solve their issue.</p><br>
            		<h3>Responsibilities</h3>
            		<p>• Candidate must be currently pursuing Bachelor's Degree in Information Technology or equivalent.<br>
								• Good hands-on skills, excellent analytical and problem-solving capabilities.<br>
								• Able to work collaboratively with others.<br>
								• Good personality, positive mindset and independent.<br>
								• Experiences in Wordpress or PHP Laravel framework is a plus.</p><br>
							</div>
							<div class="jobdetails-content">
								<h3>Job Title</h3>
								<p>Software Developer Intern (6 months)-Kuala Lumpur</p><br>
            		<h3>Working Day</h3>
            		<p>Monday - Friday</p><br>
            		<h3>Working Hour</h3>
            		<p>8:00 AM - 6:00 PM</p><br>
								<h3>Allowance</h3>
            		<p>RM 1,500 - RM 1,500</p><br>
								<h3>Training Period</h3>
            		<p>February 2023 - July 2023</p><br>
        			</div>   
							<div class="button-group">
								<button type="submit" class="backBtn">Back</button>
              	<button type="submit" class="applyBtn">Apply</button>
            	</div>
						</div>
					</section>

					<section class="cmpdetails" id="cmpdetails">
						<h1 class="heading"> <span>Company</span> Info </h1>
						<div class="cmpdetails-row">
							<div class="cmpdetails-image">
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.53663221214!2d101.72591861475746!3d3.2155572976588167!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc3843bfb6a031%3A0x2dc5e067aae3ab84!2sTunku%20Abdul%20Rahman%20University%20College%20(TAR%20UC)!5e0!3m2!1sen!2smy!4v1667794201482!5m2!1sen!2smy" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
							</div>
							
							<div class="cmpdetails-content">
								<h3><i class="fa-regular fa-envelope"></i>&nbsp Email</h3>
								<p>hr@guidewire.com.my</p><br>
            		<h3><i class="fa-regular fa-address-book"></i>&nbsp Contact Number</h3>
            		<p>011-27322988</p><br>
            		<h3><i class="fa-regular fa-building"></i>&nbsp Company Size</h3>
            		<p>50 - 100</p><br>
            		<h3><i class="fa-solid fa-signs-post"></i>&nbsp Location</h3>
            		<p>1, Jalan Sin Chew Kee, Bukit Bintang, 50150 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur</p><br>
								<h3><i class="fa-solid fa-calendar-days"></i>&nbsp Date Joined</h3>
            		<p>30/07/2009</p>
        			</div>   
						</div>
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