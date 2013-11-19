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
	<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/oupas.js"></script>
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class();?> >
	<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
		<div class="container">
			<div class="navbar-header">
				<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<div class="logo">
					<a href="<?php bloginfo('url');?>"><img src="<?php bloginfo('template_url'); ?>/img/logo-beta_vert.png" alt="Ou Pas"/></a>
				</div>
			  <a class="navbar-brand" href="<?php bloginfo('url')?>"><?php bloginfo('name')?></a>
			</div>
			<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
				<?php /* Primary navigation */
					wp_nav_menu( array(
					  'menu' => 'principal',
					  'depth' => 2,
					  'container' => false,
					  'menu_class' => 'nav',
					  //Process nav menu using our custom nav walker
					  'walker' => new wp_bootstrap_navwalker())
					);
				?>
				<ul class="nav navbar-nav navbar-right">
					<li>
						<?php
							$facebook = ot_get_option ('facebook');
							$twitter = ot_get_option ('twitter');
						?>
						<?php if(!empty($facebook)) : ?>
							<a href="<?php echo esc_url( $facebook ); ?>" class="fb"><i class="icon-facebook icon-2x"></i></a>
							<?php else: ?>
							<a></a>
						<?php endif; ?>
						<?php if(!empty($twitter)) : ?>
							<a href="<?php echo esc_url( $twitter ); ?>" class="twt"><i class="icon-twitter icon-2x"></i></a>
							<?php else: ?>
							<a></a>
						<?php endif; ?>
					</li>
				</ul>
			</nav>
		</div>
	</header>