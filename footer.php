<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TRM_Portfolio
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="main-footer">
			<?php if ( is_active_sidebar( 'footer-sidebar-1' ) ) { ?>
				<ul id="sidebar">
					<?php dynamic_sidebar('footer-sidebar-1'); ?>
				</ul>
			<?php } ?>
		</div>
		
		<div class="site-info yllw-bg">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'trm_portfolio' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'trm_portfolio' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'trm_portfolio' ), 'trm_portfolio', '<a href="http://underscores.me/">Underscores.me</a>' );
				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<script>
	jQuery(document).ready(function($) {
		if($("body").hasClass("post-type-archive-project")){
			$("li#menu-item-303").addClass("current-proj-menu-item");
		}
	});
</script>

<?php wp_footer(); ?>

</body>
</html>
