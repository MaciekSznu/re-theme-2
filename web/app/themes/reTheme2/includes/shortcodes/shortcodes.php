<?php
/**
 * Theme shortcodes
 *
 * Please follow the same format for registering new shortcodes.
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

namespace reTheme2\Shortcodes;

/**
 * Get Current Year
 *
 * @param array $atts The shortcodes attributes.
 */
function current_year( $atts ) {
	return gmdate( 'Y' );
}
add_shortcode( 'current_year', 'reTheme2\Shortcodes\current_year' );

/**
 * Button shortcode.
 *
 * @param array  $atts    The shortcodes attributes.
 * @param string $content The content between the opening and closing shortcode tag.
 */
function button( $atts, $content ) {
	$atts = shortcode_atts(
		array(
			'href'      => '#',
			'style'     => 'primary',
			'color'     => 'normal',
			'target'    => '_self',
			'icon'      => '',
			'iconalign' => 'right',
			'title'     => '',
		),
		$atts
	);

	$href       = $atts['href'];
	$style      = $atts['style'];
	$color      = $atts['color'];
	$target     = $atts['target'];
	$icon       = $atts['icon'];
	$icon_align = $atts['iconalign'];
	$title      = $atts['title'];

	$icon_class   = ! empty( $icon ) ? 'c-btn--icon' : '';
	$icon_class  .= ! empty( $icon ) && ! empty( $icon_align ) ? ' c-btn--icon-align-' . $icon_align : '';
	$button_title = ! empty( $title ) ? "title=${title}" : '';
	$class        = "c-btn c-btn--${style} c-btn--color-${color} ${icon_class}";
	$rel          = '_blank' === $target ? ' rel="noopener"' : '';
	$icon         = $icon ? "<span class='icon $icon'></span>" : '';

	return "<a href='$href' class='$class' target='${target}' $button_title ${rel}><span>$content</span>${icon}</a>";
}
add_shortcode( 'button', 'reTheme2\Shortcodes\button' );


/**
 * Blockquote shortcode.
 *
 * @param array  $atts    The shortcodes attributes.
 * @param string $content The content between the opening and closing shortcode tag.
 */
function blockquote( $atts, $content ) {
	shortcode_atts(
		array(
			'author' => __( 'Name', 'reTheme2' ),
		),
		$atts
	);

	$author = $atts['author'];

	return "<blockquote class='blockquote--alt'><cite>$content</cite> <span class='author'>-$author</span></blockquote>";
}
add_shortcode( 'blockquote', 'reTheme2\Shortcodes\blockquote' );

/**
 * Hook (Anchor) shortcode.
 *
 * @param array  $atts    The shortcodes attributes.
 * @param string $content The content between the opening and closing shortcode tag.
 */
function hook( $atts, $content = null ) {
	shortcode_atts(
		array(
			'id' => '#id',
		),
		$atts
	);

	$id = is_array( $atts ) ? $atts['id'] : '';

	return '<div id="' . $id . '"></div>';
}
add_shortcode( 'hook', 'reTheme2\Shortcodes\hook' );

/**
 * Group buttons shortcode.
 *
 * @param array  $atts    The shortcodes attributes.
 * @param string $content The content between the opening and closing shortcode tag.
 */
function group_buttons( $atts, $content ) {
	shortcode_atts(
		array(
			'align' => 'left',
		),
		$atts
	);

	$content = do_shortcode( $content );
	$align   = $atts['align'];

	return "<div class='buttons-wrapper align--$align'>$content</div>";
}
add_shortcode( 'group_buttons', 'reTheme2\Shortcodes\group_buttons' );
