<?php
/**
 * Get filtered content.
 *
 * @package WordPress
 * @subpackage reTheme2
 * @since reTheme2 1.0
 */

/**
 * Get filtered content.
 *
 * @param WP_Post $p Post object.
 */
function get_filtered_content( $p ) {
	global $blocks_loaded;
	global $blocks_loaded_thirdy;
	global $blocks_loaded_components;
	$cont                     = $p->post_content;
	$val                      = apply_filters( 'the_content', $cont );
	$blocks_loaded            = array();
	$blocks_loaded_thirdy     = array();
	$blocks_loaded_components = array();
	return $val;
}
