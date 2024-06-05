<?php
/**
 * Register theme post types
 *
 * Post types should always support revisions.
 * Please follow the same format for registering new post types.
 *
 * Reference: https://developer.wordpress.org/reference/functions/register_post_type/
 * Dashicons for menu_icon: https://developer.wordpress.org/resource/dashicons/
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

namespace reTheme2\PostTypes;

/**
 * Get post type labels
 *
 * @param  string $singular  Singular name for the post type.
 * @param  string $plural    Plural name for the post type.
 * @param  string $menu_name Name the post type will appear as in the admin sidebar.
 * @return array             Lables for registering a post type.
 */
// phpcs:ignoreFile
function get_labels( string $singular, string $plural = '', string $menu_name = '' ) : array {
	if ( empty( $plural ) ) {
		$plural = $singular . 's';
	}

	if ( empty( $menu_name ) ) {
		$menu_name = $plural;
	}

	return array(
		'name'                  => _x( $plural, 'Post Type General Name', 'reTheme2' ),
		'singular_name'         => _x( $singular, 'Post Type Singular Name', 'reTheme2' ),
		'menu_name'             => __( $menu_name, 'reTheme2' ),
		'name_admin_bar'        => __( $singular, 'reTheme2' ),
		'archives'              => __( $singular . ' Archives', 'reTheme2' ),
		'attributes'            => __( $singular . ' Attributes', 'reTheme2' ),
		'parent_item_colon'     => __( 'Parent ' . $singular, 'reTheme2' ),
		'all_items'             => __( 'All ' . $plural, 'reTheme2' ),
		'add_new_item'          => __( 'Add New ' . $singular, 'reTheme2' ),
		'add_new'               => __( 'Add New', 'reTheme2' ),
		'new_item'              => __( 'New ' . $singular, 'reTheme2' ),
		'edit_item'             => __( 'Edit ' . $singular, 'reTheme2' ),
		'update_item'           => __( 'Update ' . $singular, 'reTheme2' ),
		'view_item'             => __( 'View ' . $singular, 'reTheme2' ),
		'view_items'            => __( 'View ' . $plural, 'reTheme2' ),
		'search_items'          => __( 'Search ' . $singular, 'reTheme2' ),
		'not_found'             => __( 'Not found', 'reTheme2' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'reTheme2' ),
		'featured_image'        => __( 'Featured Image', 'reTheme2' ),
		'set_featured_image'    => __( 'Set featured image', 'reTheme2' ),
		'remove_featured_image' => __( 'Remove featured image', 'reTheme2' ),
		'use_featured_image'    => __( 'Use as featured image', 'reTheme2' ),
		'insert_into_item'      => __( 'Insert into ' . strtolower( $singular ), 'reTheme2' ),
		'uploaded_to_this_item' => __( 'Uploaded to this ' . strtolower( $singular ), 'reTheme2' ),
		'items_list'            => __( $plural . ' list', 'reTheme2' ),
		'items_list_navigation' => __( $plural . ' list navigation', 'reTheme2' ),
		'filter_items_list'     => __( 'Filter ' . strtolower( $plural ) . ' list', 'reTheme2' ),
	);
}

/**
 * Register Apartment post type.
 */
function apartment() {
	register_post_type(
		'apartment',
		array(
			'label'       	=> __( 'Apartment', 'reTheme2' ),
			'labels'      	=> get_labels( 'Apartment', 'Apartments' ),
			'supports'    	=> array( 'title', 'revisions', 'editor', 'thumbnail',  ),
			'taxonomies'  	=> array(),
			'public'      	=> true,
			'menu_icon'   	=> 'dashicons-insert',
			'has_archive' 	=> false,
			'show_in_rest' 	=> true,
		)
	);
}

add_action( 'init', 'reTheme2\PostTypes\apartment' );

/**
 * Register Gallery post type.
 */
// function gallery() {
// 	register_post_type(
// 		'gallery',
// 		array(
// 			'label'       => __( 'Gallery', 'reTheme2' ),
// 			'labels'      => get_labels( 'Gallery', 'Galleries' ),
// 			'supports'    => array( 'title', 'revisions' ),
// 			'taxonomies'  => array(),
// 			'public'      => true,
// 			'menu_icon'   => 'dashicons-format-gallery',
// 			'has_archive' => false,
// 		)
// 	);
// }

// add_action( 'init', 'reTheme2\PostTypes\gallery' );
