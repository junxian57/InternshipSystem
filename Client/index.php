<?php
/*include('includes/db_connection.php');
session_start();
error_reporting(0);
include('includes/db_connection.php');
if(isset($_POST['submit']))
  {

    $name=$_POST['name'];
    $email=$_POST['email'];
    $services=$_POST['services'];
    $adate=$_POST['adate'];
    $atime=$_POST['atime'];
    $phone=$_POST['phone'];
    $aptnumber = mt_rand(100000000, 999999999);
  
    $query=mysqli_query($con,"insert into tblappointment(AptNumber,Name,Email,PhoneNumber,AptDate,AptTime,Services) value('$aptnumber','$name','$email','$phone','$adate','$atime','$services')");
    if ($query) {
$ret=mysqli_query($con,"select AptNumber from tblappointment where Email='$email' and  PhoneNumber='$phone'");
$result=mysqli_fetch_array($ret);
$_SESSION['aptno']=$result['AptNumber'];
 echo "<script>window.location.href='thank-you.php'</script>";	
  }
  else
    {
      $msg="Something Went Wrong. Please try again";
    }

  
}*/

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>BPMS||Home Page</title>

	<link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900,900i" rel="stylesheet">

	<link rel="stylesheet" href="../Client/css/open-iconic-bootstrap.min.css">
	<link rel="stylesheet" href="../Client/css/animation.css">

	<link rel="stylesheet" href="../Client/css/owl.carousel.min.css">
	<link rel="stylesheet" href="../Client/css/owl.theme.default.min.css">
	<link rel="stylesheet" href="../Client/css/magnific-popup.css">

	<link rel="stylesheet" href="../Client/css/aos.css">

	<link rel="stylesheet" href="../Client/css/ionicons.min.css">

	<link rel="stylesheet" href="../Client/css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="../Client/css/jquery.timepicker.css">


	<link rel="stylesheet" href="../Client/css/flaticon.css">
	<link rel="stylesheet" href="../Client/css/icomoon.css">
	<link rel="stylesheet" href="../Client/css/style.css">
</head>

<body>
	<?php include_once('../Client/includes/header.php'); ?>
	<!-- END nav -->

	<section id="home-section" class="hero" style="background-image: url(images/bg.jpg);" data-stellar-background-ratio="0.5">
		<div class="home-slider owl-carousel">
			<div class="slider-item js-fullheight">
				<div class="overlay"></div>
				<div class="container-fluid p-0">
					<div class="row d-md-flex no-gutters slider-text align-items-end justify-content-end" data-scrollax-parent="true">
						<img class="one-third align-self-end order-md-last img-fluid" src="images/bg_1.png" alt="">
						<div class="one-forth d-flex align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
							<div class="text mt-5">
								<span class="subheading">Beauty Parlour</span>
								<h1 class="mb-4">Get Pretty Look</h1>
								<p class="mb-4">We pride ourselves on our high quality work and attention to detail. The products we use are of top quality branded products.</p>


							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="slider-item js-fullheight">
				<div class="overlay"></div>
				<div class="container-fluid p-0">
					<div class="row d-flex no-gutters slider-text align-items-center justify-content-end" data-scrollax-parent="true">
						<img class="one-third align-self-end order-md-last img-fluid" src="images/bg_2.png" alt="">
						<div class="one-forth d-flex align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
							<div class="text mt-5">
								<span class="subheading">Natural Beauty</span>
								<h1 class="mb-4">Beauty Salon</h1>
								<p class="mb-4">This parlour provides huge facilities with advanced technology equipments and best quality service. Here we offer best treatment that you might have never experienced before.</p>


							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<br>
	<section class="ftco-section ftco-no-pt ftco-booking">
		<div class="container-fluid px-0">
			<div class="row no-gutters d-md-flex justify-content-end">
				<div class="one-forth d-flex align-items-end">
					<div class="text">
						<div class="overlay"></div>
						<div class="appointment-wrap">
							<span class="subheading">Reservation</span>
							<h3 class="mb-2">Make an Appointment</h3>
							<form action="#" method="post" class="appointment-form">
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<input type="text" class="form-control" id="name" placeholder="Name" name="name" required="true">
										</div>
									</div>
									<div class="col-sm-12">
										<div class="form-group">
											<input type="email" class="form-control" id="appointment_email" placeholder="Email" name="email" required="true">
										</div>
									</div>
									<div class="col-sm-12">
										<div class="form-group">
											<div class="select-wrap">
												<div class="icon"><span class="ion-ios-arrow-down"></span></div>
												<select name="services" id="services" required="true" class="form-control">
													<option value="">Select Services</option>
													<?php $query = mysqli_query($con, "select * from tblservices");
													while ($row = mysqli_fetch_array($query)) {
														?>
														<option value="<?php echo $row['ServiceName']; ?>"><?php echo $row['ServiceName']; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
									<div class="col-sm-12">
										<div class="form-group">
											<input type="text" class="form-control appointment_date" placeholder="Date" name="adate" id='adate' required="true">
										</div>
									</div>
									<div class="col-sm-12">
										<div class="form-group">
											<input type="text" class="form-control appointment_time" placeholder="Time" name="atime" id='atime' required="true">
										</div>
									</div>
									<div class="col-sm-12">
										<div class="form-group">
											<input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" required="true" maxlength="10" pattern="[0-9]+">
										</div>
									</div>
								</div>
								<div class="form-group">
									<input type="submit" name="submit" value="Make an Appointment" class="btn btn-primary">
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="one-third">
					<div class="img" style="background-image: url(images/bg-1.jpg);">
					</div>
				</div>
			</div>
		</div>
	</section>


	<br>


	<?php include_once('../Client/includes/footer.php'); ?>



	<!-- loader -->
	<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
			<circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
			<circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" /></svg></div>


	<script src="../Client/js/jquery.min.js"></script>
	<script src="../Client/js/jquery-migrate-3.0.1.min.js"></script>
	<script src="../Client/js/popper.min.js"></script>
	<script src="../Client/js/bootstrap.min.js"></script>
	<script src="../Client/js/jquery.easing.1.3.js"></script>
	<script src="../Client/js/jquery.waypoints.min.js"></script>
	<script src="../Client/js/jquery.stellar.min.js"></script>
	<script src="../Client/js/owl.carousel.min.js"></script>
	<script src="../Client/js/jquery.magnific-popup.min.js"></script>
	<script src="../Client/js/aos.js"></script>
	<script src="../Client/js/jquery.animateNumber.min.js"></script>
	<script src="../Client/js/bootstrap-datepicker.js"></script>
	<script src="../Client/js/jquery.timepicker.min.js"></script>
	<script src="../Client/js/scrollax.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
	<script src="../Client/js/google-map.js"></script>
	<script src="../Client/js/main.js"></script>

</body>

</html>