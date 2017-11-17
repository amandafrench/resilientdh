<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "body-content-wrapper" div and all content after.
 *
 * @subpackage fBlogging
 * @author tishonator
 * @since fBlogging 1.0.0
 *
 */
?>
			<a href="#" class="scrollup"></a>

			<footer id="footer-main">

				<div id="footer-content-wrapper">

					<?php get_sidebar('footer'); ?>

					<div class="clear">
					</div>

					<nav id="footer-menu">
						<?php wp_nav_menu( array( 'theme_location' => 'footer', ) ); ?>
					</nav>

					<div class="clear">
					</div>

					<div id="copyright">

						<p>
						 <?php fblogging_show_copyright_text(); ?> <a href="<?php echo esc_url( 'https://tishonator.com/product/fblogging' ); ?>" title="<?php esc_attr_e( 'fblogging Theme', 'fblogging' ); ?>">
							<?php esc_html_e('fBlogging Theme', 'fblogging'); ?></a> <?php esc_attr_e( 'powered by', 'fblogging' ); ?> <a href="<?php echo esc_url( 'http://wordpress.org/' ); ?>" title="<?php esc_attr_e( 'WordPress', 'fblogging' ); ?>">
							<?php esc_html_e('WordPress', 'fblogging'); ?></a>
						</p>
						
					</div><!-- #copyright -->

				</div><!-- #footer-content-wrapper -->

			</footer><!-- #footer-main -->

		</div><!-- #body-content-wrapper -->
		<?php wp_footer(); ?>
	</body>
</html>