<?php
/**
 * Theme Support
 * ---------------------------------------------------------------------------------------
 *
 * This component registers theme support for WP features.
 *
 * @package WordPress
 * @subpackage reTheme2
 * @since reTheme2 1.0
 */

defined( 'ABSPATH' ) || die();

/**
 * Class used to define this themes support of WP functionality.
 */
class Theme_Core_Theme_Support extends Theme_Core_Component {

	/**
	 * Kicks off this class' functionality.
	 */
	protected function init() {
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
		add_theme_support( 'title-tag' );

		// Fallback for older versions of WP that don't have "title-tag" support.
		if ( ! function_exists( '_wp_render_title_tag' ) ) {
			add_action(
				'wp_head',
				function () {
					?>

				<title><?php wp_title( '|', true, 'right' ); ?></title>

					<?php
				}
			);
		}
	}
}
