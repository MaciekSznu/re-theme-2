<?php
/**
 * Remove core block patterns
 *
 * @package WordPress
 * @subpackage defaultTheme
 * @since defaultTheme 1.0
 */

/**
 * Remove core block patterns
 *
 * @param  array $allowed_blocks The current allowed blocks.
 * @return array The modified list of allowed blocks.
 */

add_action(
	'init',
	function() {
		remove_theme_support( 'core-block-patterns' );
	}
);
