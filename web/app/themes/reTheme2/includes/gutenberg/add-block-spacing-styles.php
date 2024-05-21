<?php
/**
 * The block spacings.
 *
 * @package WordPress
 * @subpackage reTheme2
 * @since reTheme2 1.0
 */

/**
 * It takes the block ID and the values array, and returns a string of CSS
 *
 * @param array  $values The values of the block.
 * @param string $type The type of css.
 */
function get_values( $values, $type = 'padding' ) {
	if ( ! empty( $values ) ) {
		$style_content = '';
		foreach ( $values as $name => $value ) {

			if ( ! empty( $value ) ) {
				$style_content .= $type . '-' . $name . ': ' . $value . '!important;';
			}
		}
		return $style_content;
	}
}


/**
 * The function `add_block_spacing_styles` generates and outputs CSS styles for a given block ID and
 * padding/margin values for different screen sizes.
 *
 * @param string $block_id The block ID.
 * @param array  $padding_mobile The padding value for mobile devices.
 * @param array  $padding_tablet The padding value for tablet devices.
 * @param array  $padding_desktop The padding value for desktop devices.
 * @param array  $spacing_mobile The margin value for mobile devices.
 * @param array  $spacing_tablet The margnin value for tablet devices.
 * @param array  $spacing_desktop The margnin value for desktop devices.
 */
function add_block_spacing_styles( $block_id, $padding_mobile, $padding_tablet, $padding_desktop, $spacing_mobile, $spacing_tablet, $spacing_desktop ) {

	$block_id        = $block_id ?? null;
	$padding_mobile  = $padding_mobile ?? null;
	$padding_tablet  = $padding_tablet ?? null;
	$padding_desktop = $padding_desktop ?? null;
	$spacing_mobile  = $spacing_mobile ?? null;
	$spacing_tablet  = $spacing_tablet ?? null;
	$spacing_desktop = $spacing_desktop ?? null;

	if ( ! empty( $padding_mobile ) || ! empty( $padding_tablet ) || ! empty( $padding_desktop ) || ! empty( $spacing_mobile ) || ! empty( $spacing_tablet ) || ! empty( $spacing_desktop ) ) {
		$style_content = null;

		if ( ! empty( $padding_mobile ) || ! empty( $spacing_mobile ) ) {
			$style_content .= '[data-id="' . $block_id . '"] { ' . get_values( $padding_mobile ) . get_values( $spacing_mobile, 'margin' ) . '}';
		}

		if ( ! empty( $padding_tablet ) || ! empty( $spacing_tablet ) ) {
			$style_content .= '@media (min-width: 768px) { [data-id="' . $block_id . '"] { ' . get_values( $padding_tablet ) . get_values( $spacing_tablet, 'margin' ) . '} }';
		}

		if ( ! empty( $padding_desktop ) || ! empty( $spacing_desktop ) ) {
			$style_content .= '@media (min-width: 992px) { [data-id="' . $block_id . '"] { ' . get_values( $padding_desktop ) . get_values( $spacing_desktop, 'margin' ) . '} }';
		}

		return $style_content;
	}
}
