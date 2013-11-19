<?php
/**
 * The Template for displaying all single posts.
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>

	<div class="container">
		<div class="row test">

			<section class="span6 offset3">
				<div class="navigation">
					<div class="alignleft"><?php previous_post_link('%link', '<i class="icon-caret-left"></i> Quote précédente  '); ?></div>
					<div class="alignright"><?php next_post_link('%link', ' Quote suivante <i class="icon-caret-right"></i>'); ?> </div>
					
				</div>
				<h4>Quote #<?php the_title(); ?></h4>
				
						<?php get_template_part('quote');?>

						<div id="comments">
							<?php comments_template(); ?>
						</div>
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