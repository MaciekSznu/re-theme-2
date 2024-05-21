<?php
/**
 * Modify the path to the icons directory
 *
 * @package WordPress
 * @subpackage reTheme2
 * @since reTheme2 1.0
 */

/**
 * Modify the path to the icons directory
 */

add_filter( 'acf_icon_path_suffix', 'acf_icon_path_suffix' );

function acf_icon_path_suffix( $path_suffix ) {
	return 'images/svg/';
}
