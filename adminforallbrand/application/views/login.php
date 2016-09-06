<?php 
	$host=$_SERVER['HTTP_HOST'];

	$hostbrand_name="";
	$hostbrand_id="";

	$jnbk=strpos($host,'jnbk');
	if($jnbk==""){
		
		$brand=strpos($host,"sbpart");
		if($brand!=""){
			$hostbrand_name="sbpart";
		}
		$brand=strpos($host,"jikiu");
		if($brand!=""){
			$hostbrand_name="jikiu";
		}
		$brand=strpos($host,"nibk");
		if($brand!=""){
			$hostbrand_name="nibk";
		}
		$brand=strpos($host,"jsfilter");
		if($brand!=""){
			$hostbrand_name="jsfilter";
		}
		if($hostbrand_name==""){
			echo "404 Page not found";
			exit;
		}
		
	}
	//echo $hostbrand_id; exit;
?>
<!DOCTYPE html>
<html lang="en-us" id="extr-page">
	<head>
		<meta charset="utf-8">
		<title> JNBK Brand Websites</title>
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		
		<!-- #CSS Links -->
		<!-- Basic Styles -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">

		<!-- SmartAdmin Styles : Caution! DO NOT change the order -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/smartadmin-production-plugins.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/smartadmin-production.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/smartadmin-skins.min.css">

		<!-- We recommend you use "your_style.css" to override SmartAdmin
		     specific styles this will also ensure you retrain your customization with each SmartAdmin update.
		<link rel="stylesheet" type="text/css" media="screen" href="css/your_style.css"> -->

		<!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/demo.min.css">

		<!-- #FAVICONS -->
		<link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon">
		<link rel="icon" href="img/favicon/favicon.ico" type="image/x-icon">

		<!-- #GOOGLE FONT -->
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

		<!-- #APP SCREEN / ICONS -->
		<!-- Specifying a Webpage Icon for Web Clip 
			 Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
		<link rel="apple-touch-icon" href="img/splash/sptouch-icon-iphone.png">
		<link rel="apple-touch-icon" sizes="76x76" href="img/splash/touch-icon-ipad.png">
		<link rel="apple-touch-icon" sizes="120x120" href="img/splash/touch-icon-iphone-retina.png">
		<link rel="apple-touch-icon" sizes="152x152" href="img/splash/touch-icon-ipad-retina.png">
		
		<!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		
		<!-- Startup image for web apps -->
		<link rel="apple-touch-startup-image" href="<?php echo base_url(); ?>assets/img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
		<link rel="apple-touch-startup-image" href="<?php echo base_url(); ?>assets/img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
		<link rel="apple-touch-startup-image" href="<?php echo base_url(); ?>assets/img/splash/iphone.png" media="screen and (max-device-width: 320px)">
		<style>
		.logotext{
			font-weight: 700;
			font-size: 25px;
			text-transform: capitalize;
			font-family: arial;
		}
		</style>
	</head>
	
	<body class="animated fadeInDown">

		
		<div id="main" role="main">

			<!-- MAIN CONTENT -->
			<div id="content" class="container">

				<div class="row">
					
					<div class="col-md-4">
					</div>
					<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
						<div class="well no-padding">
							<form action="" id="login-form" method="post" class="smart-form client-form">
								
								<header>
									<span id="logo">
										<!--<img src="<?php //echo base_url(); ?>assets/img/myimg/JNBK_logo.png" alt="SmartAdmin">-->
										
<?php if($hostbrand_name=="sbpart"){ ?>
		<img src="<?php echo base_url(); ?>assets/img/myimg/img-logo.png" style="width: 60px; margin-top: -10px;">
<?php }else if($hostbrand_name=="jikiu"){ ?>
		<img src="<?php echo base_url(); ?>assets/img/myimg/logobest.jpg" style="width: 110px; margin-top: -12px">
<?php }else if($hostbrand_name=="nibk"){ ?>
		<img src="<?php echo base_url(); ?>assets/img/myimg/Logo.png" style="width: 85px;margin-top: -11px;">
<?php }else if($jnbk!=""){ ?>
		<img src="<?php echo base_url(); ?>assets/img/myimg/JNBK_logo.png">
<?php }else{
		echo "<b class='logotext'>".$hostbrand_name."</b>"; 
	  } ?>
									</span>
									
								</header>

								<fieldset>
									
									<section>
										<label class="label">Login ID</label>
										<label class="input"> <i class="icon-append fa fa-user"></i>
											<input type="text" name="login_id">
											<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter your Login ID</b></label>
									</section>

									<section>
										<label class="label">Password</label>
										<label class="input"> <i class="icon-append fa fa-lock"></i>
											<input type="password" name="password">
											<b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> </label>
										<div class="note">
											<?php if($error==1){ echo "<span style='color:red'>Invalid Login</span>"; }?>
										</div>
									</section>

									<section>
										<label class="checkbox">
											
										</label>
									</section>
								</fieldset>
								<footer>
									<button id="submitlogin" type="submit" class="btn btn-primary">
										Sign in
									</button>
								</footer>
							</form>

						</div>
						
					</div>
					
					<div class="col-md-4">
					</div>
					
					
				</div>
			</div>

		</div>

		<!--================================================== -->	

		<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
		<script src="<?php echo base_url(); ?>assets/js/plugin/pace/pace.min.js"></script>

	    <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
	    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script> if (!window.jQuery) { document.write('<script src="js/libs/jquery-2.1.1.min.js"><\/script>');} </script>

	    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script> if (!window.jQuery.ui) { document.write('<script src="assets/js/libs/jquery-ui-1.10.3.min.js"><\/script>');} </script>

		<!-- IMPORTANT: APP CONFIG -->
		<script src="<?php echo base_url(); ?>assets/js/app.config.js"></script>

		<!-- JS TOUCH : include this plugin for mobile drag / drop touch events 		
		<script src="js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> -->

		<!-- BOOTSTRAP JS -->		
		<script src="<?php echo base_url(); ?>assets/js/bootstrap/bootstrap.min.js"></script>

		<!-- JQUERY VALIDATE -->
		<script src="<?php echo base_url(); ?>assets/js/plugin/jquery-validate/jquery.validate.min.js"></script>
		
		<!-- JQUERY MASKED INPUT -->
		<script src="<?php echo base_url(); ?>assets/js/plugin/masked-input/jquery.maskedinput.min.js"></script>
		
		<!--[if IE 8]>
			
			<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
			
		<![endif]-->

		<!-- MAIN APP JS FILE -->
		<script src="<?php echo base_url(); ?>assets/js/app.min.js"></script>

		<script type="text/javascript">
			runAllForms();

			$(function() {
				// Validation
				$("#login-form").validate({
					// Rules for form validation
					rules : {
						login_id : {
							required : true,
							minlength : 3,
							maxlength : 20
						},
						password : {
							required : true,
							minlength : 3,
							maxlength : 20
						}
					},

					// Messages for form validation
					messages : {
						login_id : {
							required : 'Please enter your Login ID'
						},
						password : {
							required : 'Please enter your password'
						}
					},

					// Do not change code below
					errorPlacement : function(error, element) {
						error.insertAfter(element.parent());
					}
				});
			
			});
		</script>

	</body>
</html>