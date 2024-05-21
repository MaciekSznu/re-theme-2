<?php
/**
 * ACF block preview.
 *
 * @package WordPress
 * @subpackage defaultTheme
 * @since defaultTheme 1.0
 */

/**
 * This function loads an image from blocks folder named 'preview'
 * and displays it as a block preview in an Inserter Help Panel
 *
 * To work requires 'example' attrubutess to be present when
 * registering the block:
 *
 * 'example' => [
 *      'attributes' => [
 *          'mode' => 'auto',
 *      ]
 * ],
 *
 * and 'mode' to be set to 'auto.
 *
 * Example usage (must be placed in index.php of a block before block's code):
 * load_acf_block_preview_image(__DIR__, $is_preview);
 *
 * @param string $path path to this block.
 * @param bool   $is_preview if true preview will be visible.
 */
function load_acf_block_preview_image( $path, $is_preview = true ) {

	if ( is_admin() && $is_preview ) :

		// look for preview.* file in current directory.
		$file_name      = 'preview.{jpg,png,svg,gif,webp}';
		$file_paths_arr = glob( $path . '/' . $file_name, GLOB_BRACE );

		if ( isset( $file_paths_arr[0] ) ) {
			// we need only the firest item from matched files array.
			$file_path = $file_paths_arr[0];

			$html = '<div class="acf-block-insterter-panel-preview">';

			// create file uri from paths.
			$file_uri = get_template_directory_uri() . '/parts/blocks/' . basename( $path ) . '/' . basename( $file_path );

			if ( file_exists( $file_path ) ) {
				$html .= '<img src="' . $file_uri . '" />';
			} else {
				$html .= '<span class="acf-block-insterter-panel-preview__missing">' . __( 'No Preview Available.' ) . '<span>';
			}

			$html .= '</div>';
			//phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo $html;
		}

	endif;
}
