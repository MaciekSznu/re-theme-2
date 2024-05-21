<?php
/**
 * This class collects Block functionalities.
 *
 * @package WordPress
 * @subpackage reTheme2
 * @since reTheme2 1.0
 */

/**
 * Block Class
 */
class Block {

	// phpcs:disable
	/**
	 * The block data.
	 *
	 * @var array
	 */
	private $_block = null;

	// phpcs:enable
	/**
	 * Constructor.
	 *
	 * Sets up the block.
	 *
	 * @param array $block The block data.
	 */
	public function __construct( $block ) {
		$this->_block = $block;
	}

	/**
	 * Generate Block class
	 *
	 * @param string $custom Custom block class.
	 * @return string        Block class.
	 */
	public function block_class( $custom = '' ) {
		$class  = 'acf-block';
		$class .= ' block-' . str_replace( 'acf/', '', $this->_block['name'] );

		if ( ! empty( $custom ) ) {
			$class .= ' ' . $custom;
		}

		if ( isset( $this->_block['align'] ) ) {
			$class .= ' align' . $this->_block['align'];
		}

		if ( isset( $this->_block['className'] ) ) {
			$class .= ' ' . $this->_block['className'];
		}

		return $class;
	}

	/**
	 * Generate Block Container class
	 *
	 * @param string $custom Custom container class.
	 * @return string        Container class.
	 */
	public function container_class( $custom = '' ) {
		$class = 'container';
		if ( ! empty( $custom ) ) {
			$class .= ' ' . $custom;
		}

		if ( isset( $this->_block['align'] ) ) {
			$class .= ' container--' . $this->_block['align'];
		}

		return $class;
	}

	/**
	 * Check if block exists on current page
	 *
	 * @param string $block Block name.
	 * @param bool   $check_class Check class.
	 * @return bool
	 */
	public static function if_block_exists( $block, $check_class = true ) {
		if ( ! $block ) {
			return false;
		}
		$post_id = get_the_ID();

		if ( is_home() ) {
			$post_id = get_option( 'page_for_posts' ) ? get_the_ID() : 0;
		}

		$p = get_post( $post_id );

		if ( empty( $p ) ) {
			return;
		}

		if ( $check_class ) {
			preg_match( "/$block/", get_filtered_content( $p ), $matches );
			$cond = ! empty( $matches ) ? true : false;
			return $cond;
		} else {
			return has_block( $block, $p );
		}
	}

	/**
	 * It adds an ID, data-id and data-title to the block's HTML element.
	 */
	public function the_block_attributes() {
		$block_id     = $this->_block['id'];
		$result       = ' data-id="' . $block_id . '"';
		$anchor       = ! empty( $this->_block['anchor'] ) ? $this->_block['anchor'] : '';
		$anchor_label = ! empty( $this->_block['anchorLabel'] ) ? $this->_block['anchorLabel'] : '';

		if ( ! empty( $anchor ) ) {
			$result .= " id='$anchor'";

			if ( ! empty( $anchor_label ) ) {
				$result .= " data-title='$anchor_label'";
			} else {
				$result .= " data-title='$anchor'";
			}
		}
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $result;
	}

	/**
	 * Return block name.
	 */
	public function block_name() {
		return $this->_block['name'];
	}


	/**
	 * Pick block padding and margin.
	 */
	public function pick_block_padding_margin() {
		$block_id        = $this->_block['id'];
		$padding_mobile  = $this->_block['paddingMobile'] ?? null;
		$padding_tablet  = $this->_block['paddingTablet'] ?? null;
		$padding_desktop = $this->_block['paddingDesktop'] ?? null;
		$spacing_mobile  = $this->_block['spacingMobile'] ?? null;
		$spacing_tablet  = $this->_block['spacingTablet'] ?? null;
		$spacing_desktop = $this->_block['spacingDesktop'] ?? null;

		$style_content = add_block_spacing_styles( $block_id, $padding_mobile, $padding_tablet, $padding_desktop, $spacing_mobile, $spacing_tablet, $spacing_desktop );

		$html = ' <style> ' . $style_content . ' </style> ';
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $html;
	}
}
