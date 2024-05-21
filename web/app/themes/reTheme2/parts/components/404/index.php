<?php
/**
 * The 404 component.
 *
 * @package WordPress
 * @subpackage reTheme2
 * @since reTheme2 1.0
 */

load_styles( __DIR__, '404' );
?>
<div class="container">
	<h1><?php esc_html_e( '404 - Not found.', 'reTheme2' ); ?></h1>
	<h2>
		<?php esc_html_e( 'We\'re sorry, but the page you are looking for cannot be found. What should you do at this point? Here are some options:', 'reTheme2' ); ?>
	</h2>
	<ul>
		<li><?php esc_html_e( 'If you typed in a URL, check that it is typed in correctly.', 'reTheme2' ); ?></li>
		<li><?php esc_html_e( 'Perhaps it was just a fluke, and if you try again by clicking refresh, it\'ll pop right up!', 'reTheme2' ); ?></li>
		<li><?php esc_html_e( 'Or head back to our home page', 'reTheme2' ); ?> <a
				href="<?php echo esc_url( home_url() ); ?>"><?php echo esc_url( home_url() ); ?></a> <?php esc_html_e( 'and navigate from there.', 'reTheme2' ); ?>
		</li>
	</ul>			
</div>
