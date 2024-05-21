<?php
/**
 * Embed responsive wrapper.
 *
 * @package WordPress
 * @subpackage defaultTheme
 * @since defaultTheme 1.0
 */

/**
 * Adds an embed responsive wrapper.
 *
 * @param string $cached_html Cached HTML for the responsive embed.
 * @param string $url         Url for the external embedded asset.
 */
function oembed_video_wrapper( $cached_html, $url ) {
	$class = 'iframe-wrapper';
	$id    = substr( $url, strrpos( $url, '/' ) + 1 );

	if ( strpos( $url, 'wistia' ) !== false ) {
		$class  .= ' wistia';
		$data    = json_decode( wp_remote_get( "https://fast.wistia.com/oembed?url=$url" )['body'] );
		$img_src = $data->thumbnail_url;
	} elseif ( strpos( $url, 'vimeo' ) !== false ) {
		$class  .= ' vimeo';
		$data    = json_decode( wp_remote_get( "https://vimeo.com/api/oembed.json?url=$url" )['body'] );
		$img_src = preg_replace( '/_[\s\S]+?\./', '.', $data->thumbnail_url );
	} else {
		$class  .= ' youtube';
		$img_src = "https://img.youtube.com/vi/$id/0.jpg";
	}

	// Move iframe src to data-src attribute to avoid loading iframe when page is loading.
	$cached_html = preg_replace( '/src=\"/', 'loading="lazy" data-src="', $cached_html );

	return "<div class='$class' data-video-id='$id'>
                <div class='iframe-wrapper__overlay' style='background-image: url($img_src);'>
                    <button aria-label='" . __( 'play video', 'reTheme2' ) . "' class='iframe-wrapper__play'><span class='icon-video-play'></span></button>
                </div>
                $cached_html
            </div>";
}

add_filter( 'embed_oembed_html', 'oembed_video_wrapper', 99, 4 );
