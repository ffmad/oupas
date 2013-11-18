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
						<div class="quote">
							<a href="<?php the_permalink(); ?>">
							<div class="content-quote">
								<span style="display: block; float: left;">
									<?php if (get_the_post_thumbnail()) : ?><div style="width: 80px; max-height: 80px; border:1px rgb(201, 163, 163) ridge" ><?php the_post_thumbnail(array(100, 100)) ?></div>
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

							<div class="social">
								<div class="s-right">
									
									<a class="btn-social" target="_blank" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>"><i class="icon-facebook "></i></a>
									<a class="btn-social" target="_blank" href="http://twitter.com/share?text=@OuPas_WP Quote n <?php the_title(); ?>&amp;url=<?php the_permalink(); ?>" title="Click to share this post on Twitter"><i class="icon-twitter"></i></a>

									<?php if(function_exists('like_counter_p')) { like_counter_p('Bien !'); } ?>
									<?php if(function_exists('dislike_counter_p')) { dislike_counter_p('Ou pas...'); } ?>
								</div>
								<div class="s-left">
									<span class="categ"><?php echo get_the_term_list($post->ID,'themes','',', ','');?></span>
									<a href="<?php the_permalink(); ?>#comments" class="btn-comment"><i class="icon-comment"></i> <?php comments_number( "0", "1", "%" ); ?></a>
								</div>

							
							</div>
						</div>

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