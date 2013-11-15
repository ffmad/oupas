<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

<div class="container">
		<div class="row test">
			<section class="span6 offset3">
				<h2 class="style404">404</h2>
				<p>Cette page n'existe pas, vous pouvez <a href="<?php bloginfo('url');?>">revenir à l'accueil</a> ou faire une recherche</p>


					<?php get_search_form(); ?>

			</section>
		</div>
	</div>

<?php get_footer(); ?>