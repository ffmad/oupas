<?php
/*
Template Name: Top Quotes
*/
?>
<?php get_header(); ?>

	<div class="container">
		<div class="row test">
			<section class="span6 offset3">
			<h2> Le Top ! </h2>
			<?php
				function my_posts_join( $sql ) {
					global $wpdb;
					return $sql . "JOIN ".$wpdb->prefix."like_dislike_counters ON (".$wpdb->prefix."posts.ID = ".$wpdb->prefix."like_dislike_counters.post_id)";
				}

				function my_posts_where( $sql ) {
					global $wpdb;
					return $sql . " AND ".$wpdb->prefix."like_dislike_counters.ul_key = 'like'";
				}

				function my_posts_orderby( $sql ) {
					global $wpdb;
					return $wpdb->prefix."like_dislike_counters.ul_value DESC";
				}

				add_filter( 'posts_join', 'my_posts_join' );
				add_filter( 'posts_where', 'my_posts_where' );
				add_filter( 'posts_orderby', 'my_posts_orderby' );

				// Display the query
				/*add_filter( 'posts_request', 'dump_request' );
				function dump_request( $input ) {
				    var_dump($input);
				    return $input;
				}*/
				?>
				
				
				<?php
				if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
						elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
							else { $paged = 1; }
					$args = array( 
						'post_type' => 'quotes',
						'posts_per_page' => '15',
						'paged' => $paged,
					);
					query_posts($args); 
				?>


				<?php if (have_posts()) : ?>

					<?php while (have_posts()) : the_post(); ?>
					<?php $counter = $counter + 1; ?>
					
						<?php get_template_part('quote');?>

					<?php endwhile; ?>
				<?php else : ?>

					<h2> FAIL FAIL FAIL </h2>

				<?php endif; ?>
      			<?php
      			 wp_pagenavi();

				// Make sure these filters don't affect any other queries
				remove_filter( 'posts_join', 'my_posts_join' );
				remove_filter( 'posts_where', 'my_posts_where' );
				remove_filter( 'posts_orderby', 'my_posts_orderby' );

				wp_reset_postdata();	// Restore original Post Data
			?>
			
			
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

<!--
SELECT wp_posts.* 
FROM wp_posts 
JOIN wp_like_dislike_counters ON (wp_posts.ID = wp_like_dislike_counters.post_id) 
WHERE 1=1 
AND wp_posts.post_type = 'quotes' 
AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'private') 
AND wp_like_dislike_counters.ul_key like '%like%' 
ORDER BY wp_like_dislike_counters.ul_value DESC
-->
