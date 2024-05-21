<?php
/**
 * Check if is firefox
 *
 * @package WordPress
 * @subpackage reTheme2
 * @since reTheme2 1.0
 */

/**
 * Is firefox.
 */
function is_firefox() {
	if ( isset( $_SERVER['HTTP_USER_AGENT'] ) ) {
		$agent = sanitize_text_field( wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) );
	}

	return strlen( strstr( $agent, 'Firefox' ) ) > 0;
}
