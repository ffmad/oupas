<?php
/*
Template Name: Moderation
*/

get_header(); ?>

<?php get_header(); ?>

	<div class="container">
		<div class="row test">
			<section class="span6 offset3" style="width: auto; float: none;">
			<h2> Bien ... ou pas ? </h2>
			
				
				<?php
					$args = array( 
						'post_type' => 'quotes',
						'orderby' => 'rand',
						'post_status' => 'pending',
						'show_posts' => 1,
					);
					query_posts($args); 
				?>

				
				<?php if (have_posts()) : ?>

					<?php while (have_posts()) : the_post(); ?>
					<?php if ($counter==0) : ?>
					<?php $counter = $counter + 1; ?>
					
						<?php get_template_part('quote');?>
						
					<?php endif; ?>
					<?php endwhile; ?>
				<?php else : ?>

					<h2> Pas d'histoires &agrave; Mod&eacute;rer ! </h2>

				<?php endif; ?>

			
				<?php wp_pagenavi(); ?>
				
			
			</section>
		</div>
	</div>

<?php get_footer(); ?>