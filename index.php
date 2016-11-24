<?php
session_start();
include("includes/db.conn.php");
include("includes/conf.class.php");
include("language.php");
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
<script type="text/javascript" src="js/move-top.js"></script>
       <script type="text/javascript" src="template/js/easing.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
				});
			});
		</script>
		<script type="text/javascript">
		$(document).ready(function() {
				/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
				*/
		$().UItoTop({ easingType: 'easeOutQuart' });
});
</script>

<link rel="stylesheet" type="text/css" href="template/css/datepicker.css" />
<script type="text/javascript" src="template/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="template/js/dtpicker/jquery.ui.datepicker-<?=$langauge_selcted?>.js"></script>
<script type="text/javascript">
$(document).ready(function(){
 $.datepicker.setDefaults( $.datepicker.regional[ "<?=$langauge_selcted?>" ] );
 $.datepicker.setDefaults({ dateFormat: '<?=$bsiCore->config['conf_dateformat']?>'});
    $("#txtFromDate").datepicker({
        minDate: 0,
        maxDate: "+365D",
        numberOfMonths: 2,
        onSelect: function(selected) {
    	var date = $(this).datepicker('getDate');
         if(date){
            date.setDate(date.getDate() + <?=$bsiCore->config['conf_min_night_booking']?>);
          }
          $("#txtToDate").datepicker("option","minDate", date)
        }
    });
 
    $("#txtToDate").datepicker({ 
        minDate: 0,
        maxDate:"+365D",
        numberOfMonths: 2,
        onSelect: function(selected) {
           $("#txtFromDate").datepicker("option","maxDate", selected)
        }
    });  
 $("#datepickerImage").click(function() { 
    $("#txtFromDate").datepicker("show");
  });
 $("#datepickerImage1").click(function() { 
    $("#txtToDate").datepicker("show");
  });
  
  $('#btn_room_search').click(function() { 		
	  	if($('#txtFromDate').val()==""){
	  		alert('<?=mysql_real_escape_string(ENTER_CHECK_IN_DATE_ALERT)?>');
	  		return false;
	 	}else if($('#txtToDate').val()==""){
	  		alert('<?=mysql_real_escape_string(ENTER_CHECK_OUT_DATE_ALERT)?>');
	  		return false;
	  	} else {
	  		return true;
	 	}	  
	});	
});
</script>
<script>
function langchange(lng)
{
	window.location.href = '<?=$_SERVER['PHP_SELF']?>?lang=' + lng;
}		
</script>

</head>
<body>
<!-- header -->
	<div class="banner">
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
				</div>
					<!-- script-for-nav -->
					<script>
						$( "span.menu" ).click(function() {
						  $( ".head-nav ul" ).slideToggle(300, function() {
							// Animation complete.
						  });
						});
					</script>
				<!-- script-for-nav -->
				<div class="logo">
					<a href="index.php"><img src="template/images/logo.png" class="img-responsive" alt="" /></a>
				</div>
				<div class="banner-info">
					<p>Enjoy the stupendous calm and peace of this tree-shaded location cradled by mountains where time stands still.choose ease, harmony and wellbeing over the hectic pace of today's lifestyle!</p>
				</div>
		</div>
	</div>
<!-- header -->
<!-- ENCHANTMENT  -->
	<div class="ENCHANTMENT" id="ourresort">
			<div class="col-md-6 ENCHANTMENT-left">
				<img src="template/images/5.jpg" class="img-responsive" alt="">
			</div>
			<div class="col-md-6 ENCHANTMENT-right">
					<section class="slider">
						<div class="flexslider">
							<ul class="slides">
								<li>
									<div class="slider-info">
										<img src="template/images/logo1.png" class="img-responsive" alt="">
										<h3>ENCHANTMENT AND SPLENDOUR</h3>
										<p> Escape into a world of DusitD2 magic where  where style, entertainment and art converge. Cocooned away from the hustle and bustle in a secure and peaceful haven off the leafy suburb of Riverside Drive, it’s just minutes from the the central business district and merely a stone’s throw away from the heart of the city’s pulsing social scene. </p>
									</div>
								</li>
								<li>
									<div class="slider-info">
										<img src="template/images/logo1.png" class="img-responsive" alt="">
										<h3>ENCHANTMENT AND SPLENDOUR</h3>
										<p>With intriguing spaces that balance a modern yet timeless aesthetic in an intimate boutique setting, dusitD2 Nairobi is the very definition of contemporary chic.</p>
									</div>
								</li>
								<li>	
									<div class="slider-info">
										<img src="template/images/logo1.png" class="img-responsive" alt="">
										<h3>ENCHANTMENT AND SPLENDOUR</h3>
										<p>Offering world class cuisine from its array of bars and restaurants, stylish and spacious guestrooms, unique event spaces, the award winning Devarana Spa and a striking red swimming pool, dusitD2 Nairobi is the perfect urban retreat for both work and play.</p>
									</div>
								</li>
							</ul>
						</div>
					</section>
						<!-- FlexSlider -->
							  <script defer src="template/js/jquery.flexslider.js"></script>
							  <script type="text/javascript">
								$(function(){
								  SyntaxHighlighter.all();
								});
								$(window).load(function(){
								  $('.flexslider').flexslider({
									animation: "slide",
									start: function(slider){
									  $('body').removeClass('loading');
									}
								  });
								});
							  </script>
						<!-- FlexSlider -->
	<!-- slider -->
			</div>
			<div class="clearfix"> </div>
	</div>
<!-- ENCHANTMENT  -->
<!-- wonder -->		
	<div class="wonder" id="">
		<div class="col-md-2 wonder-left">
			<img src="template/images/2.jpg" class="img-responsive" alt="">
		</div>	
		<div class="col-md-4 wonder-mid">
			<img src="template/images/logo1.png" class="img-responsive" alt="">
			<h5>ACCOMMODATION</h5>
			<h3>EMOTIONS AND WONDER</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas pellentesque justo ac velit facilisis </p>
		</div>	
		<div class="col-md-6 wonder-right">
			<img src="template/images/bed2.jpg" class="img-responsive" alt="">
		</div>	
			<div class="clearfix"> </div>
	</div>		
<!-- wonder -->
<!-- rooms -->
	<div class="rooms" id="suites">
		<div class="col-md-4 rooms-1">
			<div class="room-info">
				<img src="template/images/logo2.png" class="img-responsive" alt="">
			</div>
			<div class="room-info1">
					<ul>
						<li><a href="#"><i class="search"></i>explore</a></li>
						<li><a href="#"><i class="boo"></i>brochure</a></li>
						<li><a href="#reservations" class="scroll"><i class="bro"></i>booking</a></li>
					</ul>
			</div>
		</div>
		<div class="col-md-4 rooms-2">
			<div class="room-info">
				<img src="template/images/logo3.png" class="img-responsive" alt="">
			</div>
			<div class="room-info1">
					<ul>
						<li><a href="#"><i class="search"></i>explore</a></li>
						<li><a href="#"><i class="boo"></i>brochure</a></li>
						<li><a href="#reservations" class="scroll"><i class="bro"></i>booking</a></li>
					</ul>
			</div>
		</div>
		<div class="col-md-4 rooms-3">
			<div class="room-info">
				<img src="template/images/logo4.png" class="img-responsive" alt="">
			</div>
			<div class="room-info1">
					<ul>
						<li><a href="#"><i class="search"></i>explore</a></li>
						<li><a href="#"><i class="boo"></i>brochure</a></li>
						<li><a href="#reservations" class="scroll"><i class="bro"></i>booking</a></li>
					</ul>
			</div>
		</div>
			<div class="clearfix"> </div>
	</div>
<!-- rooms -->
<!-- services -->
	<div class="services" id="services">
		<div class="col-md-6 services-left">
			<img src="template/images/logo1.png" class="img-responsive" alt="">
			<h2>SERVICES</h2>
			<div class="col-md-3 services-left1">
				<h5>FAMILIES</h5>
					<ul>
						<li><a href="#">Facilities available for children</a></li>
						<li><a href="#">Children's bathrobes</a></li>
						<li><a href="#">Children's slippers</a></li>
						<li><a href="#">Sweets</a></li>
						<li><a href="#">Cartoon DVD</a></li>
						<li><a href="#">Babysitting</a></li>
						<li><a href="#">Highchairs </a></li>
					</ul>
			</div>
			<div class="col-md-3 services-left1">
				<h5>Disabled Access</h5>
				<p>Thanks to its refurbishment, completed in 2000, Resort offers the necessary facilities and equipment to welcome disabled clients in the best conditions. An adapted entrance, lifts and six rooms were especially designed for them.</p>
			</div>
			<div class="col-md-3 services-left1">
				<h5>Pet friendly hotel</h5>
				<p>Complimentary pet basket (for cats and dogs) available, Custom-designed bowl with the name of the pet can be easily arranged in advance,  
Specific menus and food </p>
			</div>
			<div class="col-md-3 services-left1">
				<h5>Concierge</h5>
				<p>From a simple restaurant booking to the complete organisation of a personalised stay, our Concierge are available 24 hours a day to meet your requirements. Their secret address book makes the least of your desires </p>
			</div>
		</div>
		<div class="col-md-6 services-right">
			<img src="template/images/3.jpg" class="img-responsive" alt="">
		</div>
			<div class="clearfix"> </div>
	</div>
<!-- services -->
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
			<h3>RESERVATION DETAILS</h3>
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
<!-- guests -->
	<div class="guests" >
		<div class="container">
			<img src="template/images/logo5.png" class="img-responsive" alt="">
			<h3>BE OUR GUESTS</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas pellentesque justo ac velit facilisis convallis vel id </p>
		</div>
	</div>
<!-- guests -->
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