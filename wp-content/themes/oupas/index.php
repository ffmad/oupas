<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>

	<div class="container">
		<div class="row test">
			<section class="span6 offset3">
				
				<!-- Twitter Widget -->
				<span id="intro-widget">
					<span class="title-style">Intro</span>
					<p>Parceque vous avez vivez des histoires extaordinaires ... ou pas
					<br>Pour découvrir l'envers du décors, cliquez sur la barre en dessous de chaque post</p>
				</span>
				
				<!-- Twitter Widget -->
				<span id="twitter-widget">
					<span class="title-style">Twitter ... ou pas</span>
					<a class="twitter-timeline" href="https://twitter.com/search?q=%23oupas" data-widget-id="401344243316170752">Tweets concernant "#oupas"</a>
				</span>
			
				<?php if($form_messages) echo $form_messages;?>
				<?php wp_reset_postdata(); ?>
				<?php 
					if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
						elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
							else { $paged = 1; }
					$args = array( 
						'posts_per_page' => 15,
  						'paged' => $paged,
						'post_type' => 'quotes',
					);
					query_posts($args);
					$counter = 0;
				?>
				<?php if (have_posts()) : ?>

					<?php while (have_posts()) : the_post(); ?>
					<?php $counter = $counter + 1; ?>
					
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

<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<?php get_footer(); ?>