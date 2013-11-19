<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

	
	<footer>
		<p><?php echo ot_get_option ('credits'); ?></p>
	</footer>
	</div><!-- #page -->

	<?php wp_footer(); ?>

	<!-- UserVoice JavaScript SDK (only needed once on a page) -->
	<script>(function(){var uv=document.createElement('script');uv.type='text/javascript';uv.async=true;uv.src='//widget.uservoice.com/MVXa6NDwacIT4AkxW6zpAQ.js';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(uv,s)})()</script>

	<!-- A tab to launch the Classic Widget -->
	<script>
	UserVoice = window.UserVoice || [];
	UserVoice.push(['showTab', 'classic_widget', {
		mode: 'full',
		primary_color: '#187048',
		link_color: '#184768',
		default_mode: 'feedback',
		forum_id: 230752,
		tab_label: 'Suggestions d\'amelioration',
		tab_color: '#187048',
		tab_position: 'middle-right',
		tab_inverted: false
	}]);
	</script>
</body>
</html>