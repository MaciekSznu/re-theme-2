<?php
/**
 * Change core block
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

/**
 * Change core image block
 *
 * @param string $block_content The block content about to be appended.
 * @param array  $block The full block, including name and attributes.
 */
function insert_image_styles( $block_content, $block ) {
	if ( 'core/image' === $block['blockName'] ) {
		$block_content = '<div data-styles-id="core-image"></div>' . $block_content;
	}
	return $block_content;
}
add_filter( 'render_block', 'insert_image_styles', 10, 2 );
