<?php
/**
 * Allow only certain core blocks.
 *
 * @package WordPress
 * @subpackage defaultTheme
 * @since defaultTheme 1.0
 */

/**
 * Allow only certain core blocks.
 *
 * @param  array $allowed_blocks The current allowed blocks.
 * @return array The modified list of allowed blocks.
 */
function cc_allowed_block_types( $allowed_blocks ) {
	$acf_blocks = acf_get_block_types();
	$acf_blocks = array_keys( $acf_blocks );

	$allowed_core_blocks = array(
		'core/paragraph',
		'core/image',
		'core/heading',
		'core/list',
		'core/list-item',
		'core/quote',
		'core/table',
		'core/buttons',
		'core/button',
		'core/code',
		'core/cover',
		'core/separator',
		'core/spacer',
		'core/media-text',
		'core/shortcode',
		'core/embed',
		'core/block',
		'core/column',
		'core/columns',
		'gravityforms/form',
		'custom/container',
		'custom/column',
		'custom/columns',
		'custom/accordion',
		'custom/accordion-single',
	);

	$allowed_blocks = array_merge( $acf_blocks, $allowed_core_blocks );

	return $allowed_blocks;
}

add_filter( 'allowed_block_types_all', 'cc_allowed_block_types' );
