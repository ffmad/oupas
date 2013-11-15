<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Oupas
 * @since Ou Pas 1.0
 */

get_header(); ?>

	<div class="container">
		<div class="row test">
			<section class="span6 offset3">
			<h2> Recherche pour : <span style="color:#bf0426"><?php printf('%s',get_search_query()); ?> </span></h2>
			<?php if ( have_posts() ) : ?>

			

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<h4> Quote #<?php the_title(); ?> : <a href="<?php the_permalink();?>"> Allez voir </a></h4>
				
			<?php endwhile; ?>
			<br/><br/>
			<p>Si vous ne trouvez pas, vous pouvez retenter une recherche : </p>
			<?php get_search_form(); ?>
			<p> Ou <a href="<?php bloginfo('url');?>">revenir à l'accueil</a> <br/><br/></p>

		<?php else : ?>
			<h3>Désolé, mais la recherche n'a pu aboutir</h3>
			<p>Vous pouvez retenter une recherche : </p>
			<?php get_search_form(); ?>
			<p> Ou <a href="<?php bloginfo('url');?>">revenir à l'accueil</a> </p>
		<?php endif; ?>

			</section>
		</div>
	</div>



<?php get_footer(); ?>