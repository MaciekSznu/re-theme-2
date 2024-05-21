<?php
/**
 * The header component.
 *
 * @package WordPress
 * @subpackage reTheme2
 * @since reTheme2 1.0
 */

load_script( 'header', 'reTheme2/header' );
?>
<header class="main-header" role="banner">
	<?php load_styles( __DIR__, 'header' ); ?>
	<div class="container">
		<nav class="main-nav" role="navigation" aria-label="<?php esc_html_e( 'Main Navigation', 'reTheme2' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
				)
			);
			?>
		</nav>
	</div>
</header>
