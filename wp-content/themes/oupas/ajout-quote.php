<?php
/*
Template Name: Ajout Quote
*/
?>
<?php get_header(); ?>
	<div class="container">
		<div class="row test">
			<section class="span6 offset3" style="width: auto; float: none;">
				<h2>Venez raconter votre histoire !</h2>
				<?php echo do_shortcode('[quote-form]'); ?>
			</section>
		</div>
	</div>

<?php get_footer(); ?>