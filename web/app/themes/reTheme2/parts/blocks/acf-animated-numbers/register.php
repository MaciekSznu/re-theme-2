<?php
/**
 * Register ACF block.
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

/**
 * Register block animated numbers.
 */
function init_block_animated_numbers() {
	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return;
	}

	acf_register_block_type(
		array(
			'name'            => 'animated-numbers',
			'title'           => __( 'Animated numbers', 'reTheme2' ),
			'description'     => __( 'Block animated numbers', 'reTheme2' ),
			'category'        => 'custom_blocks',
			'icon'            => 'calculator',
			'mode'            => 'edit',
			'keywords'        => array( 'animated', 'numbers' ),
			'supports'        => array(
				'align'  => array( 'wide', 'full' ),
				'anchor' => true,
			),
			'render_template' => get_template_directory() . '/parts/blocks/acf-animated-numbers/index.php',
			'enqueue_assets'  => function () {
				$js_file = '/parts/blocks/acf-animated-numbers/index.min.js';

				wp_enqueue_script(
					'reTheme2/acf-animated-numbers',
					get_template_directory_uri() . $js_file . '#asyncload',
					array(),
					filemtime( get_relative_path( $js_file ) ),
					true
				);
			},
		)
	);
}

add_action( 'acf/init', 'init_block_animated_numbers' );
