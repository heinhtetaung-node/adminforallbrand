<?php 
$user=$this->session->userdata('login_id');
$brandjson=$user['brand_ids'];
$brandids=json_decode($brandjson);

$host=$_SERVER['HTTP_HOST'];

$hostbrand_name="";
$hostbrand_id="";

$jnbk=strpos($host,'jnbk');
if($jnbk==""){
	foreach($brandids as $b){
		$brand=strpos($host,$b->brand_name);
		if($brand!=""){
			$hostbrand_name=$b->brand_name;
			$hostbrand_id=$b->brand_id;
		}
	}
	
	if($hostbrand_name==""){
		echo "You have no permission here";
		exit;
	}
}
//echo $hostbrand_id; exit;
?>
					
<!DOCTYPE html>
<html lang="en-us" ng-app="listpp">
	<head>
		<meta charset="utf-8">
		
		<title> JNBK Brand Websites </title>
		<meta name="description" content="">
		<meta name="author" content="">
			
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">

		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/smartadmin-production-plugins.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/smartadmin-production.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/smartadmin-skins.min.css">

		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/smartadmin-rtl.min.css">

		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/demo.min.css">

		<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/myimg/JNBK_logo.png" type="image/png">
		<link rel="icon" href="<?php echo base_url(); ?>assets/img/myimg/JNBK_logo.png" type="image/png">

		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

		<link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/img/splash/sptouch-icon-iphone.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>assets/img/splash/touch-icon-ipad.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url(); ?>assets/img/splash/touch-icon-iphone-retina.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url(); ?>assets/img/splash/touch-icon-ipad-retina.png">
		
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		
		<link rel="apple-touch-startup-image" href="<?php echo base_url(); ?>assets/img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
		<link rel="apple-touch-startup-image" href="<?php echo base_url(); ?>assets/img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
		<link rel="apple-touch-startup-image" href="<?php echo base_url(); ?>assets/img/splash/iphone.png" media="screen and (max-device-width: 320px)">
		
		<script src="<?php echo base_url(); ?>assets/jquery.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		
		<script src="<?=base_url('assets/angularjs/angular.js');?>" type="text/javascript"></script>
		<script src="<?=base_url('assets/angular-route.js');?>"></script>
		
		<style>
		.fade{
			-webkit-transition: opacity 2s; /* For Safari 3.1 to 6.0 */
			transition: opacity 2s;
			opacity: 0;
		}
		
		.fadein{
			animation: fadein 1s;
			-moz-animation: fadein 1s; /* Firefox */
			-webkit-animation: fadein 1s; /* Safari and Chrome */
			-o-animation: fadein 1s; /* Opera */
		}
		@keyframes fadein {
			from {
				opacity:0;
			}
			to {
				opacity:1;
			}
		}
		@-moz-keyframes fadein { /* Firefox */
			from {
				opacity:0;
			}
			to {
				opacity:1;
			}
		}
		@-webkit-keyframes fadein { /* Safari and Chrome */
			from {
				opacity:0;
			}
			to {
				opacity:1;
			}
		}
		@-o-keyframes fadein { /* Opera */
			from {
				opacity:0;
			}
			to {
				opacity: 1;
			}
		}
		.select2-hidden-accessible{ display:none !important;} 
		
		.logotext{
			font-weight: 700;
			font-size: 25px;
			text-transform: capitalize;
			font-family: arial;
		}
		</style>
		<script>
		function searchpage(){
			var searchkey=document.getElementById('search-fld').value;
			window.location="<?php echo base_url(); ?>#/"+searchkey;
		}
		</script>
	</head>
	
	<!--

	TABLE OF CONTENTS.
	
	Use search to find needed section.
	
	===================================================================
	
	|  01. #CSS Links                |  all CSS links and file paths  |
	|  02. #FAVICONS                 |  Favicon links and file paths  |
	|  03. #GOOGLE FONT              |  Google font link              |
	|  04. #APP SCREEN / ICONS       |  app icons, screen backdrops   |
	|  05. #BODY                     |  body tag                      |
	|  06. #HEADER                   |  header tag                    |
	|  07. #PROJECTS                 |  project lists                 |
	|  08. #TOGGLE LAYOUT BUTTONS    |  layout buttons and actions    |
	|  09. #MOBILE                   |  mobile view dropdown          |
	|  10. #SEARCH                   |  search field                  |
	|  11. #NAVIGATION               |  left panel & navigation       |
	|  12. #RIGHT PANEL              |  right panel userlist          |
	|  13. #MAIN PANEL               |  main panel                    |
	|  14. #MAIN CONTENT             |  content holder                |
	|  15. #PAGE FOOTER              |  page footer                   |
	|  16. #SHORTCUT AREA            |  dropdown shortcuts area       |
	|  17. #PLUGINS                  |  all scripts and plugins       |
	
	===================================================================
	
	-->
	
	<!-- #BODY -->
	<!-- Possible Classes

		* 'smart-style-{SKIN#}'
		* 'smart-rtl'         - Switch theme mode to RTL
		* 'menu-on-top'       - Switch to top navigation (no DOM change required)
		* 'no-menu'			  - Hides the menu completely
		* 'hidden-menu'       - Hides the main menu but still accessable by hovering over left edge
		* 'fixed-header'      - Fixes the header
		* 'fixed-navigation'  - Fixes the main menu
		* 'fixed-ribbon'      - Fixes breadcrumb
		* 'fixed-page-footer' - Fixes footer
		* 'container'         - boxed layout mode (non-responsive: will not work with fixed-navigation & fixed-ribbon)
	-->
	<body class="" ng-controller="mainController">
		<!-- HEADER -->
		<header id="header">
			<div id="logo-group">

				<!-- PLACE YOUR LOGO HERE -->
				<span id="logo"> <center>
				
				<?php if($hostbrand_name=="sbparts"){ ?>
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
				
				</center> </span>
				<!-- END LOGO PLACEHOLDER -->

				<!-- Note: The activity badge color changes when clicked and resets the number to 0
				Suggestion: You may want to set a flag when this happens to tick off all checked messages / notifications -->
				

				<!-- AJAX-DROPDOWN : control this dropdown height, look and feel from the LESS variable file -->
				<div class="ajax-dropdown">

					<!-- the ID links are fetched via AJAX to the ajax container "ajax-notifications" -->
					<div class="btn-group btn-group-justified" data-toggle="buttons">
						<label class="btn btn-default">
							<input type="radio" name="activity" id="ajax/notify/mail.html">
							Msgs (14) </label>
						<label class="btn btn-default">
							<input type="radio" name="activity" id="ajax/notify/notifications.html">
							notify (3) </label>
						<label class="btn btn-default">
							<input type="radio" name="activity" id="ajax/notify/tasks.html">
							Tasks (4) </label>
					</div>

					<!-- notification content -->
					<div class="ajax-notifications custom-scroll">

						<div class="alert alert-transparent">
							<h4>Click a button to show messages here</h4>
							This blank page message helps protect your privacy, or you can show the first message here automatically.
						</div>

						<i class="fa fa-lock fa-4x fa-border"></i>

					</div>
					<!-- end notification content -->

					<!-- footer: refresh area -->
					<span> Last updated on: 12/12/2013 9:43AM
						<button type="button" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Loading..." class="btn btn-xs btn-default pull-right">
							<i class="fa fa-refresh"></i>
						</button> 
					</span>
					<!-- end footer -->

				</div>
				<!-- END AJAX-DROPDOWN -->
			</div>

			<!-- projects dropdown -->
			
			<!-- end projects dropdown -->

			<!-- pulled right: nav area -->
			<div class="pull-right">
				
				<!-- collapse menu button -->
				<div id="hide-menu" class="btn-header pull-right">
					<span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
				</div>
				<!-- end collapse menu -->
				
				<!-- #MOBILE -->
				<!-- Top menu profile link : this shows only when top menu is active -->
				<ul id="mobile-profile-img" class="header-dropdown-list hidden-xs padding-5">
					<li class="">
						<a href="#" class="dropdown-toggle no-margin userdropdown" data-toggle="dropdown"> 
							<img src="<?php echo base_url(); ?>assets/img/avatars/sunny.png" alt="John Doe" class="online" />  
						</a>
						<ul class="dropdown-menu pull-right">
							<li>
								<a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0"><i class="fa fa-cog"></i> Setting</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="profile.html" class="padding-10 padding-top-0 padding-bottom-0"> <i class="fa fa-user"></i> <u>P</u>rofile</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="toggleShortcut"><i class="fa fa-arrow-down"></i> <u>S</u>hortcut</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="launchFullscreen"><i class="fa fa-arrows-alt"></i> Full <u>S</u>creen</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="login.html" class="padding-10 padding-top-5 padding-bottom-5" data-action="userLogout"><i class="fa fa-sign-out fa-lg"></i> <strong><u>L</u>ogout</strong></a>
							</li>
						</ul>
					</li>
				</ul>

				<!-- logout button -->
				<div id="logout" class="btn-header transparent pull-right">
					<span> <a href="<?php echo base_url().'Login/logout'; ?>" title="Sign Out" data-action="userLogout" data-logout-msg="You can improve your security further after logging out by closing this opened browser"><i class="fa fa-sign-out"></i></a> </span>
				</div>
				<!-- end logout button -->

				<!-- search mobile button (this is hidden till mobile view port) -->
				<div id="search-mobile" class="btn-header transparent pull-right">
					<span> <a href="javascript:void(0)" title="Search"><i class="fa fa-search"></i></a> </span>
				</div>
				<!-- end search mobile button -->

				<!-- input: search field -->
				<form class="header-search pull-right">
					<input id="search-fld" type="text" name="param" placeholder="Find reports and more" data-autocomplete='[
					"brands",
					"users",
					"language",
					"supplier",
					"news",
					"category",
					"post"
					]'>
					<button onclick="searchpage()">
						<i class="fa fa-search" ></i>
					</button>
					<a href="javascript:void(0);" id="cancel-search-js" title="Cancel Search"><i class="fa fa-times"></i></a>
				</form>
				<!-- end input: search field -->

				<!-- fullscreen button -->
				<div id="fullscreen" class="btn-header transparent pull-right">
					<span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
				</div>
				<!-- end fullscreen button -->
				
				<!-- #Voice Command: Start Speech -->
				<div id="speech-btn" class="btn-header transparent pull-right hidden-sm hidden-xs">
					<div> 
						<div class="popover bottom"><div class="arrow"></div>
							<div class="popover-content">
								<h4 class="vc-title">Voice command activated <br><small>Please speak clearly into the mic</small></h4>
								<h4 class="vc-title-error text-center">
									<i class="fa fa-microphone-slash"></i> Voice command failed
									<br><small class="txt-color-red">Must <strong>"Allow"</strong> Microphone</small>
									<br><small class="txt-color-red">Must have <strong>Internet Connection</strong></small>
								</h4>
								<a href="javascript:void(0);" class="btn btn-success" onclick="commands.help()">See Commands</a> 
								<a href="javascript:void(0);" class="btn bg-color-purple txt-color-white" onclick="$('#speech-btn .popover').fadeOut(50);">Close Popup</a> 
							</div>
						</div>
					</div>
				</div>
				<!-- end voice command -->

				<!-- multiple lang dropdown : find all flags in the flags page -->
				<ul class="header-dropdown-list hidden-xs" style="display:none;">
					<li>
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="img/blank.gif" class="flag flag-us" alt="United States"> <span> English (US) </span> <i class="fa fa-angle-down"></i> </a>
						<ul class="dropdown-menu pull-right">
							<li class="active">
								<a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/img/blank.gif" class="flag flag-us" alt="United States"> English (US)</a>
							</li>
							<li>
								<a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/img/blank.gif" class="flag flag-fr" alt="France"> Français</a>
							</li>
							<li>
								<a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/img/blank.gif" class="flag flag-es" alt="Spanish"> Español</a>
							</li>
							<li>
								<a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/img/blank.gif" class="flag flag-de" alt="German"> Deutsch</a>
							</li>
							<li>
								<a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/img/blank.gif" class="flag flag-jp" alt="Japan"> 日本語</a>
							</li>
							<li>
								<a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/img/blank.gif" class="flag flag-cn" alt="China"> 中文</a>
							</li>	
							<li>
								<a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/img/blank.gif" class="flag flag-it" alt="Italy"> Italiano</a>
							</li>	
							<li>
								<a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/img/blank.gif" class="flag flag-pt" alt="Portugal"> Portugal</a>
							</li>
							<li>
								<a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/img/blank.gif" class="flag flag-ru" alt="Russia"> Русский язык</a>
							</li>
							<li>
								<a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/img/blank.gif" class="flag flag-kr" alt="Korea"> 한국어</a>
							</li>						
							
						</ul>
					</li>
				</ul>
				<!-- end multiple lang -->

			</div>
			<!-- end pulled right: nav area -->

		</header>
		<!-- END HEADER -->

		<!-- Left panel : Navigation area -->
		<!-- Note: This width of the aside area can be adjusted through LESS variables -->
		<aside id="left-panel">

			<!-- User info -->
			<div class="login-info">
				<span> <!-- User image size is adjusted inside CSS, it should stay as it --> 
					
					<a href="">
						<img src="<?php echo base_url(); ?>userupload/male.png" alt="me" class="online" /> 
						<span style="">
							<?php echo $userarr['user_name']; ?>
						</span>
					</a> 
					
				</span>
			</div>
			<!-- end user info -->

			<!-- NAVIGATION : This navigation is also responsive-->
			<nav>
				<ul>
					<li class="{{(activetab == 'Dashboard')? 'active' : ''}}">
						<a href="<?php echo base_url().'#/'; ?>" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
					</li>
					<?php 
					if($jnbk!=""){ ?>
					<li class="{{(activetab == 'Brands')? 'active' : ''}}">
						<a href="<?php echo base_url().'#/brands'; ?>" title="Brands"><i class="glyphicon glyphicon-bold"></i> <span class="menu-item-parent">Brands</span></a>
					</li>
					<li class="{{(activetab == 'User')? 'active' : ''}}">
						<a href="<?php echo base_url().'#/user'; ?>" title="User"><i class="fa fa-user"></i> <span class="menu-item-parent">User</span></a>
					</li> 
					<?php } ?>
					<li class="{{(activetab == 'Language')? 'active' : ''}}">
						<a href="<?php echo base_url().'#/language'; ?>" title="Language"><i class="fa fa-language"></i> <span class="menu-item-parent">Language</span></a>
					</li>
					<li class="{{(activetab == 'Supplier')? 'active' : ''}}">
						<a href="<?php echo base_url().'#/supplier'; ?>/{{hostbrand_id}}" title="Supplier"><i class="fa fa-support"></i> <span class="menu-item-parent">Supplier</span></a>
					</li>
					<li class="{{(activetab == 'News')? 'active' : ''}}">
						<a href="<?php echo base_url().'#/news'; ?>/{{hostbrand_id}}" title="News"><i class="fa fa-info-circle"></i> <span class="menu-item-parent">News</span></a>
					</li>
					<li class="{{(activetab == 'Category')? 'active' : ''}}">
						<a href="<?php echo base_url().'#/category'; ?>/{{hostbrand_id}}" title="Category"><i class="fa fa-list-ul"></i> <span class="menu-item-parent">Category</span></a>
					</li>
					<li class="{{(activetab == 'Post')? 'active' : ''}}">
						<a href="<?php echo base_url().'#/post'; ?>/{{hostbrand_id}}" title="Post"><i class="glyphicon glyphicon-pushpin"></i> <span class="menu-item-parent">Post</span></a>
					</li>
				</ul>
			</nav>
			<span class="minifyme" data-action="minifyMenu"> 
				<i class="fa fa-arrow-circle-left hit"></i> 
			</span>

		</aside>
		

		
		<div id="main" role="main">
			<div id="ribbon">
				<span class="ribbon-button-alignment"> 
					<span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
						<i class="fa fa-refresh"></i>
					</span> 
				</span>

				<ol class="breadcrumb" ng-bind-html="ribbontitle | rawHtml">
					<!--<li>Home</li><li>Brand</li>-->
					
				</ol>
			</div>
			
			<div id="content" style="padding: 10px 14px;" ng-show='isViewLoading'>
				<input type="hidden" ng-init="sethost(<?php echo htmlspecialchars(json_encode($hostbrand_name)); ?>, <?php echo htmlspecialchars(json_encode($hostbrand_id)); ?>)">

				<div class="row">
					<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
						<h1 class="ajax-loading-animation"><i class="fa fa-cog fa-spin"></i> Loading..... </h1>
						<!--<i class="fa fa-gear fa-4x fa-spin" ></i> <h1 class="ajax-loading-animation">Loading...</h1>-->
					</div>
				</div>
			</div>
			
			<div ng-class="{fadein: startFade}" ng-view ng-show="babylayout"></div>
			
		</div>

		
		<!-- END MAIN PANEL -->

		<!-- PAGE FOOTER -->
		<div class="page-footer">
			<div class="row">
				<div class="col-xs-12 col-sm-6">
					<span class="txt-color-white">SmartAdmin 1.7.0 <span class="hidden-xs"> - Web Application Template</span> © 2014-2015</span>
				</div>

				<div class="col-xs-6 col-sm-6 text-right hidden-xs">
					<div class="txt-color-white inline-block">
						<i class="txt-color-blueLight hidden-mobile">Developed By Hein <strong>@ JNBK Corporation &nbsp;</strong> </i>
						
					</div>
				</div>
			</div>
		</div>
		<!-- END PAGE FOOTER -->

		<!-- SHORTCUT AREA : With large tiles (activated via clicking user name tag)
		Note: These tiles are completely responsive,
		you can add as many as you like
		-->
		<div id="shortcut">
			<ul>
				<li>
					<a href="inbox.html" class="jarvismetro-tile big-cubes bg-color-blue"> <span class="iconbox"> <i class="fa fa-envelope fa-4x"></i> <span>Mail <span class="label pull-right bg-color-darken">14</span></span> </span> </a>
				</li>
				<li>
					<a href="calendar.html" class="jarvismetro-tile big-cubes bg-color-orangeDark"> <span class="iconbox"> <i class="fa fa-calendar fa-4x"></i> <span>Calendar</span> </span> </a>
				</li>
				<li>
					<a href="gmap-xml.html" class="jarvismetro-tile big-cubes bg-color-purple"> <span class="iconbox"> <i class="fa fa-map-marker fa-4x"></i> <span>Maps</span> </span> </a>
				</li>
				<li>
					<a href="invoice.html" class="jarvismetro-tile big-cubes bg-color-blueDark"> <span class="iconbox"> <i class="fa fa-book fa-4x"></i> <span>Invoice <span class="label pull-right bg-color-darken">99</span></span> </span> </a>
				</li>
				<li>
					<a href="gallery.html" class="jarvismetro-tile big-cubes bg-color-greenLight"> <span class="iconbox"> <i class="fa fa-picture-o fa-4x"></i> <span>Gallery </span> </span> </a>
				</li>
				<li>
					<a href="profile.html" class="jarvismetro-tile big-cubes selected bg-color-pinkDark"> <span class="iconbox"> <i class="fa fa-user fa-4x"></i> <span>My Profile </span> </span> </a>
				</li>
			</ul>
		</div>



		
		<script src="<?php echo base_url(); ?>assets/js/app.config.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/smartwidgets/jarvis.widget.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap/bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/app.min.js"></script>
		
		<script src="<?php echo base_url();?>assets/app/clientapp.js"></script>
		<script src="<?php echo base_url();?>assets/js/ui-bootstrap-tpls-0.10.0.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/notification/SmartNotification.min.js"></script>
		<script src="<?php //echo base_url(); ?>assets/js/plugin/select2/select2.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/plugin/ckeditor/ckeditor.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>assets/js/plugin/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
		<!--
		<script src="<?php //echo base_url(); ?>assets/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> 
		<script src="<?php //echo base_url(); ?>assets/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js"></script>
		<script src="<?php //echo base_url(); ?>assets/js/plugin/sparkline/jquery.sparkline.min.js"></script>
		<script src="<?php //echo base_url(); ?>assets/js/plugin/jquery-validate/jquery.validate.min.js"></script>
		<script src="<?php //echo base_url(); ?>assets/js/plugin/masked-input/jquery.maskedinput.min.js"></script>
		<script src="<?php //echo base_url(); ?>assets/js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script>
		<script src="<?php //echo base_url(); ?>assets/js/plugin/msie-fix/jquery.mb.browser.min.js"></script>
		<script src="<?php //echo base_url(); ?>assets/js/plugin/fastclick/fastclick.min.js"></script>
		<script src="<?php //echo base_url(); ?>assets/js/demo.min.js"></script>

		<script src="<?php //echo base_url(); ?>assets/js/speech/voicecommand.min.js"></script>
		<script src="<?php //echo base_url(); ?>assets/js/smart-chat-ui/smart.chat.ui.min.js"></script>
		<script src="<?php //echo base_url(); ?>assets/js/smart-chat-ui/smart.chat.manager.min.js"></script>-->
		
		
	</body>

</html>