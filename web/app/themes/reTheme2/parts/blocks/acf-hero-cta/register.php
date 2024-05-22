<?php
/**
 * Register ACF block.
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

/**
 * Register block hero with cta.
 */
function init_block_hero_cta() {
	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return;
	}

	acf_register_block_type(
		array(
			'name'            => 'hero-cta',
			'title'           => __( 'Hero with call to action ', 'reTheme2' ),
			'description'     => __( 'Block hero with call to action', 'reTheme2' ),
			'category'        => 'custom_blocks',
			'icon'            => 'welcome-widgets-menus',
			'mode'            => 'edit',
			'keywords'        => array( 'content', 'image' ),
			'align'           => 'wide',
			'supports'        => array(
				'align'  => array( 'wide', 'full' ),
				'anchor' => true,
			),
			'render_template' => get_template_directory() . '/parts/blocks/acf-hero-cta/index.php',
		)
	);
}

add_action( 'acf/init', 'init_block_hero_cta' );
