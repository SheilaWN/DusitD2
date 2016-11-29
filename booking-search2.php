<?php
session_start();
include("includes/db.conn.php");
include("includes/conf.class.php");
include("includes/search.class.php");
include("language.php");
$bsisearch = new bsiSearch();
$bsiCore->clearExpiredBookings();
$pos2 = strpos($_SERVER['HTTP_REFERER'],$_SERVER['SERVER_NAME']);
if($bsisearch->nightCount==0 and !$pos2){
	header('Location: booking-failure.php?error_code=9');
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>DusitD2</title>
<link href="template/css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="template/css/style.css" rel="stylesheet" type="text/css" media="all" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Riviera Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Playfair+Display+SC:400,700,900' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="template/css/flexslider.css" type="text/css" media="screen" />
<script src="template/js/jquery.min.js"></script>
<script src="template/js/modernizr.custom.js"></script>


</head>
<body>
<!-- header -->
	<!-- <div class="banner">
		<div class="container">
				<div class="head-nav">
						<span class="menu"> </span>
							<ul class="cl-effect-7">
								<li><a href="#ourresort" class="scroll">our resort</a></li>
								<li><a href="#suites" class="scroll">suites</a></li>
								<li><a href="#services" class="scroll">services</a></li>
								<li><a href="#reservations" class="scroll">reservations</a></li>
								<li><a href="#contact" class="scroll">contact</a></li>
									<div class="clearfix"> </div>
							</ul>
				</div> -->
					<!-- script-for-nav -->
					<!-- <script>
						$( "span.menu" ).click(function() {
						  $( ".head-nav ul" ).slideToggle(300, function() {
							// Animation complete.
						  });
						});
					</script>-->
				<!-- script-for-nav -->
				<!-- <div class="logo">
					<a href="index.php"><img src="template/images/logo.png" class="img-responsive" alt="" /></a>
				</div>
				<div class="banner-info">
					<p>Enjoy the stupendous calm and peace of this tree-shaded location cradled by mountains where time stands still.choose ease, harmony and wellbeing over the hectic pace of today's lifestyle!</p>
				</div>  -->
		<!-- </div>
	</div> -->
<!-- header -->
<!-- contact -->
	<div class="contact" id="reservations">
		<div class="col-md-4 contact-left">
			<div class="contact-left1">
				<img src="template/images/logo5.png" class="img-responsive" alt="">
				<h3>RESERVATION</h3>
			</div>
		</div>

		<div class="col-md-8 contact-right" id="contact">
			<!-- <div class="contact-details">
				<h3>CONTACT DETAILS</h3>
				<div class="text-field-name-1">
						<form>
							<input type="text" class="text" value=" Name*" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = ' Name*';}">
							<input type="text" class="text" value="Surname*" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Surname*';}">
							<input type="text" class="text" value=" Country" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = ' Country';}">
							<input type="text" class="text" value="Email*" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email*';}">
							<input type="text" class="text" value=" Phone" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = ' Phone';}">
						</form>
				</div>
			</div> -->
			<div class="reservation-details">
			<h3><?=$bsiCore->config['conf_hotel_name']?></h3>
				<div class="text-field-name-1">
						<form id="formElem" name="formElem" action="booking-search.php" method="post">
							<!-- <input type="text" class="text" value=" Arrival Date*" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = ' Arrival Date*';}"> -->
							<span style="padding-left:3px;"><a id="datepickerImage" href="javascript:;"><img src="images/month.png" height="16px" width="16px" style=" /*margin-bottom:-4px;" border="0" /></a></span>
							<strong><?=CHECK_IN_DATE_TEXT?>:
							</strong><input id="txtFromDate" name="check_in" style="/*width:68px" type="text" readonly="readonly" AUTOCOMPLETE=OFF placeholder="Start Date" />
							
							<!-- <input type="text" class="text" value="Departure Date*" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Departure Date';}"> -->
							<span style="padding-left:3px;"><a id="datepickerImage1" href="javascript:;"><img src="images/month.png" height="18px" width="18px" style=" /*margin-bottom:-4px;" border="0" /></a></span>
							<strong><?=CHECK_OUT_DATE_TEXT?>:
							<input id="txtToDate" name="check_out" style="/*width:68px" type="text" readonly="readonly" AUTOCOMPLETE=OFF  placeholder="Departure Date" />
							<!-- <input type="text" class="text" value=" Rooms*" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = ' Rooms*';}"> -->
							<strong><?=ADULT_OR_ROOM_TEXT?>:</strong>
							<?=$bsiCore->capacitycombo();?>
							<!-- <div class="clearfix"> </div> -->
							<div class="button" style="padding-top: 2em;">
								<input type="submit" value="Search">
							</div>
						</form>
				</div>
			</div>
				
		</div>
			<div class="clearfix"> </div>
	</div>
<!-- contact -->

<!-- footer -->
	<div class="footer">
		<div class="col-md-6 footer-left">
		<img src="template/images/4.jpg" class="img-responsive" alt="">
			<div class="col-md-6 footer-left1">
				<img src="template/images/logo5.png" class="img-responsive" alt="">
			</div>
			<div class="col-md-6 footer-left2">
				<ul>
					<li>Rooms Resort</li>
					<li>Kenya</li>
					<li>PO Box 68789</li>
					<li>Nairobi</p></li>
				</ul>
				<p>0707997652</p>
				<h6><a href="#">info@rooms.com</h6></a>
			</div>
				<div class="clearfix"> </div>
					<div class="footer-left3">
						<ul>
							<li><a href="#"><i class="fb"></i></a></li>
							<li><a href="#"><i class="twt"></i></a></li>
							<li><a href="#"><i class="goop"></i></a></li>
							<li><a href="#"><i class="in"></i></a></li>
							<li><a href="#"><i class="do"></i></a></li>
							<li><a href="#"><i class="drib"></i></a></li>
							<li><a href="#"><i class="tet"></i></a></li>
								<div class="clearfix"> </div>
						</ul>
					</div>
		</div>
		<div class="col-md-6 footer-right">
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec et varius turpis. Donec enim sapien, sollicitudin quis volutpat nec, sagittis eget ex. Pellentesque in accumsan orci.-<span>Ian Solo-</span></p>
			<div class="col-md-6 footer-right1">
				<img src="template/images/fo.png" class="img-responsive" alt="">
			</div>
			<div class="col-md-6 footer-right2">
				<img src="template/images/un.png" class="img-responsive" alt="">
			</div>
				<div class="clearfix"> </div>
			
		</div>
			<div class="clearfix"> </div>
	</div>
	<a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 0;"></span> <span id="toTopHover" style="opacity: 0;"> </span></a>
<!-- footer -->
</body>
</html>