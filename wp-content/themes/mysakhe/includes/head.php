<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>	   <html class="no-js"> <!<![endif]-->
<!-- for lte IE8 issues -->

	<head>	
		<!-- Le Meta Config -->
		<meta charset="utf-8">
        <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>My Sakhe</title>

		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/bootstrap.css">
		<link rel="icon" href="<?php bloginfo('template_url'); ?>/images/fav-icon.png">
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/normalize.css">
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/skitter.styles.css">
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css">
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/helper.css">
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/media.css">
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/jquery-ui.css">
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/jquery-ui.structure.css">
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/jquery-ui-timepicker.css">
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/jquery-ui.theme.css">
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/font-awesome.min.css">	
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/rslides.css">
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/custom-bootstrap.css">
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/dataTables.bootstrap.css">
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/pnotify.css">
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/pnotify.brighttheme.css">
		<link href='https://fonts.googleapis.com/css?family=Poppins:400,300,500,600,700' rel='stylesheet' type='text/css'> 
		<?php if(!is_front_page()){?>
		<style>
			#banner, #mid, #bottom, .sidebar{ display:none; }
			.content{ float:none; width:100%; }
			#main .container { padding-top: 20px; }
			#header .container { height: 100px; }
		</style>
		<?php }?>
		
		<!--[if IE]>
		 <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		 <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
		<![endif]-->
		
		<!--[if IE 8]>
			 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"
				type="text/javascript"></script>
			 <script src="js/ie8_fix_maxwidth.js"
				type="text/javascript"></script>
		<![endif]-->
		
		<?php wp_head(); ?>
		
		<script>
			document.createElement('header');
			document.createElement('nav');
			document.createElement('article');
			document.createElement('section');
			document.createElement('aside');
			document.createElement('footer');
		</script><!-- end of IE issues -->
	</head>
	<body>
	<script src="<?php bloginfo('template_url'); ?>/js/jquery-2.1.1.min.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/jquery.dataTables.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/dataTables.bootstrap.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/pnotify.js"></script>
	<div class="protect-me">