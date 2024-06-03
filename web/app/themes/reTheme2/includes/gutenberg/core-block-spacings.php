<?php
/**
 * The core block spacings.
 *
 * @package WordPress
 * @subpackage reTheme2
 * @since reTheme2 1.0
 */

/**
 * The function recursively extracts block data from an array of inner blocks.
 *
 * @param  array $inner_blocks The inner blocks.
 * @return array The array with block data.
 */
function extract_bloc_data( $inner_blocks ) {
	$inner_block_results = array();
	foreach ( $inner_blocks as $inner_item ) {
		if ( isset( $inner_item['blockName'] ) && isset( $inner_item['attrs'] ) ) {
			$inner_block_results[] = array(
				'blockName' => $inner_item['blockName'],
				'attrs'     => $inner_item['attrs'],
			);

			// Recursively process innerBlocks.
			if ( isset( $inner_item['innerBlocks'] ) && is_array( $inner_item['innerBlocks'] ) ) {
				$inner_block_results = array_merge( $inner_block_results, extract_bloc_data( $inner_item['innerBlocks'] ) );
			}
		}
	}
	return $inner_block_results;
}

/**
 * The function generates and outputs CSS styles based on the block attributes
 * of certain blocks in the content.
 */
function core_block_spacings() {
	$blocks = parse_blocks( get_the_content() );

	$filtered_blocks = array_filter(
		$blocks,
		function ( $block ) {
			if ( isset( $block['blockName'] ) ) {
				return str_starts_with( $block['blockName'], 'core/' ) === true || str_starts_with( $block['blockName'], 'custom/' ) === true;
			}
		}
	);

	$result_array = array();

	foreach ( $filtered_blocks as $item ) {
		if ( isset( $item['blockName'] ) && isset( $item['attrs'] ) ) {
			$result_array[] = array(
				'blockName' => $item['blockName'],
				'attrs'     => $item['attrs'],
			);

			// Check if there are innerBlocks and process them recursively.
			if ( isset( $item['innerBlocks'] ) && is_array( $item['innerBlocks'] ) ) {
				$inner_block_results = extract_bloc_data( $item['innerBlocks'] );
				$result_array        = array_merge( $result_array, $inner_block_results );
			}
		}
	}

	$style_content = '';

	foreach ( $result_array as $block ) {
		$block_id        = $block['attrs']['dataId'] ?? null;
		$padding_mobile  = $block['attrs']['paddingMobile'] ?? null;
		$padding_tablet  = $block['attrs']['paddingTablet'] ?? null;
		$padding_desktop = $block['attrs']['paddingDesktop'] ?? null;
		$spacing_mobile  = $block['attrs']['spacingMobile'] ?? null;
		$spacing_tablet  = $block['attrs']['spacingTablet'] ?? null;
		$spacing_desktop = $block['attrs']['spacingDesktop'] ?? null;

		$style_content .= add_block_spacing_styles( $block_id, $padding_mobile, $padding_tablet, $padding_desktop, $spacing_mobile, $spacing_tablet, $spacing_desktop );

	};

	$html = ' <style> ' . $style_content . ' </style> ';
	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	echo $html;
}

add_action( 'wp_head', 'core_block_spacings', 100 );
