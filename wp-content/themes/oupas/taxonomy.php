<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>

	<div class="container">
		<div class="row test">
			<section class="span6 offset3">
				<?php $term = get_term_by('slug',get_query_var('term'),get_query_var('taxonomy'));?>
				<h2>Thème : <?php echo $term->name ?> </h2>

				<?php wp_reset_postdata(); ?>
				<?php 
					if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
						elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
							else { $paged = 1; }
					$name = $term->name;
					$args = array( 
						'posts_per_page' => 15,
  						'paged' => $paged,
  						'taxonomy' => 'themes',
  						'themes' => $name,
  						'post_type' => 'quotes'
					);
					query_posts($args);  
				?>
				<?php if (have_posts()) : ?>

					<?php while (have_posts()) : the_post(); ?>
					
						<?php get_template_part('quote');?>

					<?php endwhile; ?>
				<?php else : ?>

					<h2> FAIL FAIL FAIL </h2>

				<?php endif; ?>

        	<?php wp_pagenavi(); ?>

			</section>

			<section class="span3 sidebar">
				<?php $themes = get_terms('themes'); ?>

				<p>Voir par thèmes</p>
				<ul class='menu-sidebar'>
					<?php foreach($themes as $t) : ?>
						<li><a href="<?php echo get_term_link($t->slug,'themes');?>"><?php echo $t->name;?></a></li>
					<?php endforeach; ?>
				</ul>
			</section>
		</div>
	</div>

<?php get_footer(); ?>