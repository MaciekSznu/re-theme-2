<?php
/**
 * Webp support.
 *
 * @package WordPress
 * @subpackage reTheme2
 * @since reTheme2 1.0
 */

/**
 * Enable upload for webp image files
 *
 * @param string[] $existing_mimes Mime types keyed by the file extension regex corresponding to those types.
 */
function webp_upload_mimes( $existing_mimes ) {
	$existing_mimes['webp'] = 'image/webp';
	return $existing_mimes;
}
add_filter( 'mime_types', 'webp_upload_mimes' );

/**
 * Enable preview / thumbnail for webp image files.
 *
 * @param bool   $result Whether the image can be displayed. Default true.
 * @param string $path Path to the image.
 */
function webp_is_displayable( $result, $path ) {
	if ( false === $result ) {
		$displayable_image_types = array( IMAGETYPE_WEBP );
		// phpcs:disable WordPress.PHP.NoSilencedErrors.Discouraged
		$info = @getimagesize( $path );

		if ( empty( $info ) ) {
			$result = false;
			// phpcs:disable WordPress.PHP.StrictInArray.MissingTrueStrict
		} elseif ( ! in_array( $info[2], $displayable_image_types ) ) {
			$result = false;
		} else {
			$result = true;
		}
	}

	return $result;
}
add_filter( 'file_is_displayable_image', 'webp_is_displayable', 10, 2 );
