<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="shortcut icon" href="<?php bloginfo('template_url') ?>/img/favicon.png" /> 
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/bootstrap.min.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/fontAwesome/css/font-awesome.min.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/bootstrap-responsive.min.css" type="text/css" media="screen" />

	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/oupas.js"></script>
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class();?> >
	<header>
		<div class="container">
			<div class="row">
				<div class="logo">
					<a href="<?php bloginfo('url');?>"><img src="<?php bloginfo('template_url'); ?>/img/logo-beta_vert.png" alt="Ou Pas"/></a>
				</div>

				<nav id="menu" class="span6 offset3">
					<?php wp_nav_menu(); ?>
				</nav>

				<div id="follow" class="span2">
					<?php
					$facebook = ot_get_option ('facebook');
					$twitter = ot_get_option ('twitter');
					if(!empty($facebook)) : ?>
						<a href="<?php echo esc_url( $facebook ); ?>" class="fb"><i class="icon-facebook icon-2x"></i></a>
					<?php else: ?>
						<a></a>
					<?php endif; ?>
					<?php if(!empty($twitter)) : ?>
						<a href="<?php echo esc_url( $twitter ); ?>" class="twt"><i class="icon-twitter icon-2x"></i></a>
					<?php else: ?>
						<a></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</header>

		
