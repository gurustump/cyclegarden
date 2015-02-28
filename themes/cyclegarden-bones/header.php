<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="cyclegarden no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<?php // Google Chrome Frame for IE ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title><?php wp_title(''); ?></title>

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-touch.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

		<?php // drop Google Analytics Here ?>
		<?php // end analytics ?>

	</head>

	<body <?php body_class(); ?>>
		<a href="#" class="trigger-nav-ov TRIGGER_NAV_OV">
			<span class="ic">
				<span class="bar-1"></span>
				<span class="bar-2"></span>
				<span class="bar-3"></span>
			</span>
			<span class="title">Menu</span>
		</a>
		<div class="nav-ov NAV_OV">
			<nav role="navigation">
				<?php wp_nav_menu(array(
				'container' => false,                           // remove nav container
				'container_class' => 'menu cf',                 // class of container (should you choose to use it)
				'menu' => __( 'The Main Menu', 'bonestheme' ),  // nav name
				'menu_class' => 'nav top-nav cf',               // adding custom nav class
				'theme_location' => 'main-nav',                 // where it's located in the theme
				'before' => '',                                 // before the menu
			'after' => '',                                  // after the menu
			'link_before' => '<span>',                            // before each link
			'link_after' => '</span>',                             // after each link
			'depth' => 0,                                   // limit the depth of the nav
				'fallback_cb' => ''                             // fallback function (if there is one)
				)); ?>

			</nav>
		</div>
		<header class="header" role="banner">
			<?php if (is_front_page()) { ?>
			<p id="logo" class="h1"><a href="<?php echo home_url(); ?>" rel="nofollow"><?php bloginfo('name'); ?></a></p>
			<video id="bgvid" poster="video/video.jpg" loop="" autoplay="">
				<source type="video/mp4" src="<?php echo get_template_directory_uri(); ?>/library/video/Home_Original.mp4"></source>
				<source type="video/webm" src="<?php echo get_template_directory_uri(); ?>/library/video/Home_Original.webm"></source>
				<source type="video/webm" src="<?php echo get_template_directory_uri(); ?>/library/video/Home_Original.webm"></source>
				<source type="video/ogg" src="<?php echo get_template_directory_uri(); ?>/library/video/Home_Original.ogv"></source>
			</video>
			<div class="inner-header">
				<div class="logo-home">
					<h1 class="logo h1"><img id="homeLogo" src="<?php echo get_template_directory_uri(); ?>/library/images/logo-home.png" alt="Cycle Garden Moto Guzzi Shop" /><span><?php bloginfo('name'); ?> <?php bloginfo('description'); ?></span></h1>
					
				</div>
				<table class="hours">
					<tr>
						<th>Sun</th>
						<th>Mon</th>
						<th>Tue</th>
						<th>Wed</th>
						<th>Thu</th>
						<th>Fri</th>
						<th>Sat</th>
					</tr>
					<tr>
						<td rowspan="2">Closed</td>
						<td>9am<hr /></td>
						<td>9am<hr /></td>
						<td>9am<hr /></td>
						<td>9am<hr /></td>
						<td>9am<hr /></td>
						<td rowspan="2">Apt.<br />Only</td>
					</tr>
					<tr>
						<td>5pm</td>
						<td>5pm</td>
						<td>5pm</td>
						<td>5pm</td>
						<td>5pm</td>
					</tr>
				</table>
			</div>
			<?php } else { ?>
				<div id="inner-header">
					<p id="logo" class="h1"><a href="<?php echo home_url(); ?>" rel="nofollow"><?php bloginfo('name'); ?></a></p>
				</div>
			<?php } ?>
			<div class="scroller"></div>
		</header>
