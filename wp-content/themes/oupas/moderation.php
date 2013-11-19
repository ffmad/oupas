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
					
						<div class="quote">
							<a href="<?php the_permalink(); ?>">
								<div class="content-quote">
										<span style="display: block; float: left;">
												<?php if (get_the_post_thumbnail()) : ?><div style="width: 80px; max-height: 80px; border: 1px rgb(152, 163, 195) ridge;" ><?php the_post_thumbnail(array(78, 78)) ?></div>
												<?php else : ?><img src="<?php bloginfo('template_url'); ?>/img/logo_vert.png" style="width: 80px; max-height: 80px; border:1px rgb(201, 163, 163) ridge" alt="Ou Pas"/>
												<?php endif; ?>
												<span class="aparte">
														<p><?php the_field('auteur');?> 
																<img src="<?php bloginfo('template_url')?>/img/<?php the_field('sexe');?>.png" alt="Sexe de l'auteur" />
														</p>
												</span>
										</span>        
										<p style="margin-left: 100px; min-height:80px;">
												<?php the_field('dans_ma_tete');?>
												<br/><br/>
												
										</p>
								</div>
							</a>
							<span class="oupas-slider" onclick="$(this).next().slideToggle('slow');" style="">>>> Ou Pas <<<</span>
							<span class="oupas-pannel" > <?php the_field('en_vrai');?></span>

							<div class="social" style="margin-top: -10px;">
									<?php echo do_shortcode('[moderation-form]'); ?>
							</div>
						</div>
						
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