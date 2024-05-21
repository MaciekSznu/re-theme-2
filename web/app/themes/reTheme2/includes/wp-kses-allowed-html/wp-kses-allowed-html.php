<?php
/**
 * Change wp_kses()
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

/**
 * Set the allowed HTML for wp_kses() by context type.
 *
 * @param array|string $context Context to judge allowed tags by.
 * @param string       $context_type Context name.
 */
function allowed_html( $context, $context_type ) {

	if ( 'post' === $context_type ) {
		$context['svg']    = array(
			'class'           => true,
			'aria-hidden'     => true,
			'aria-labelledby' => true,
			'role'            => true,
			'xmlns'           => true,
			'width'           => true,
			'height'          => true,
			'viewbox'         => true,
		);
		$context['g']      = array(
			'fill' => true,
		);
		$context['title']  = array(
			'title' => true,
		);
		$context['path']   = array(
			'd'    => true,
			'fill' => true,
		);
		$context['iframe'] = array(
			'title'       => true,
			'class'       => true,
			'width'       => true,
			'height'      => true,
			'lading'      => true,
			'data-src'    => true,
			'allow'       => true,
			'frameborder' => true,
			'src'         => true,
		);
	}

	if ( isset( $context['img'] ) && ! isset( $context['img']['srcset'] ) ) {
		$context['img'] = array_merge( $context['img'], array( 'srcset' => true ) );
	}

	return $context;
}
add_filter( 'wp_kses_allowed_html', 'allowed_html', 10, 2 );
