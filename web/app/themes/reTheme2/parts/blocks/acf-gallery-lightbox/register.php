<?php
/**
 * Register ACF block.
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

/**
 * Register block gallery lightbox.
 */
function init_block_gallery_lightbox() {
	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return;
	}

	acf_register_block_type(
		array(
			'name'            => 'gallery-lightbox',
			'title'           => __( 'Gallery Lightbox', 'reTheme2' ),
			'description'     => __( 'Gallery Lightbox', 'reTheme2' ),
			'category'        => 'custom_blocks',
			'icon'            => 'slides',
			'mode'            => 'edit',
			'keywords'        => array( 'gallery', 'slider', 'images', 'lightbox' ),
			'align'           => 'wide',
			'supports'        => array(
				'align' => array( 'wide', 'full' ),
				'anchor' => true,
			),
			'render_template' => get_template_directory() . '/parts/blocks/acf-gallery-lightbox/index.php',
			'enqueue_assets'  => function () {
				$js_file = '/parts/blocks/acf-gallery-lightbox/index.min.js';

				wp_enqueue_script(
					'reTheme2/acf-gallery-lightbox',
					get_template_directory_uri() . $js_file . '#asyncload',
					array( 'slick_script' ),
					filemtime( get_relative_path( $js_file ) ),
					true
				);
			},
		)
	);
}

add_action( 'acf/init', 'init_block_gallery_lightbox' );
