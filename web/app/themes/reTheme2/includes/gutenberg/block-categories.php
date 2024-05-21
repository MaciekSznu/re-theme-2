<?php
/**
 * Custom blocks category.
 *
 * @package WordPress
 * @subpackage defaultTheme
 * @since defaultTheme 1.0
 */

/**
 * Register custom blocks category
 *
 * @param string $categories default categories.
 */
function register_custom_block_categories( $categories ) {
	return array_merge(
		array(
			array(
				'slug'  => 'custom_blocks',
				'title' => __( 'Custom Blocks', 'reTheme2' ),
				'icon'  => 'wordpress',
			),
		),
		$categories
	);
}
add_filter( 'block_categories_all', 'register_custom_block_categories', 10, 2 );
