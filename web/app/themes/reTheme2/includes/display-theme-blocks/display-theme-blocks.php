<?php
/**
 * Display theme blocks from flexible content (acf)
 *
 * @package WordPress
 * @subpackage reTheme2
 * @since reTheme2 1.0
 */

// phpcs:ignoreFile
// class ContentBlock {

// 	private static $theme_blocks_locations = array(
// 		'block_content' => 'page/content',
// 	);

// 	private function __construct(){}

// 	public static function display_theme_blocks( $field_name = 'page_blocks', $sec_param = null, $nav = false ) {
// 		if ( $sec_param == null ) {
// 			$sec_param = get_the_ID();
// 		}

// 		$counters = array();
// 		while ( have_rows( $field_name, $sec_param ) ) {
// 			the_row();
// 			$block_layout = get_row_layout();

// 			if ( ! isset( $counters[ $block_layout ] ) ) {
// 				$counters[ $block_layout ] = 1;
// 			} else {
// 				$counters[ $block_layout ]++;
// 			}

// 			if ( isset( self::$theme_blocks_locations[ $block_layout ] ) ) {
// 				get_theme_part( self::$theme_blocks_locations[ $block_layout ], array( 'layout_counter' => $counters[ $block_layout ] ) );
// 			}
// 		}
// 	}
// 	public static function the_block_title() {
// 		$block_title = get_sub_field( 'section_title' );
// 		if ( ! empty( $block_title ) ) :
// 			echo $block_title;
// 		endif;
// 	}
// }
