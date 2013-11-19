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