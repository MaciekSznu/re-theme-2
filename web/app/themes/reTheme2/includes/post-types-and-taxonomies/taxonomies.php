<?php
/**
 * Register theme taxonomies
 *
 * Please follow the same format for registering new taxonomies.
 *
 * Reference: https://developer.wordpress.org/reference/functions/register_taxonomy/
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

namespace reTheme2\Taxonomies;

/**
 * Get taxonomy labels
 *
 * @param  string $singular  Singular name for the taxonomy.
 * @param  string $plural    Plural name for the taxonomy.
 * @param  string $menu_name Name the taxonomy will appear as in the admin sidebar.
 * @return array             Lables for registering a taxonomy.
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
		'name'                       => _x( $plural, 'Taxonomy General Name', 'reTheme2' ),
		'singular_name'              => _x( $singular, 'Taxonomy Singular Name', 'reTheme2' ),
		'menu_name'                  => __( $menu_name, 'reTheme2' ),
		'all_items'                  => __( 'All ' . $plural, 'reTheme2' ),
		'parent_item'                => __( 'Parent ' . $singular, 'reTheme2' ),
		'parent_item_colon'          => __( 'Parent ' . $singular . ':', 'reTheme2' ),
		'new_item_name'              => __( 'New ' . $singular . ' Name', 'reTheme2' ),
		'add_new_item'               => __( 'Add New ' . $singular, 'reTheme2' ),
		'edit_item'                  => __( 'Edit ' . $singular, 'reTheme2' ),
		'update_item'                => __( 'Update ' . $singular, 'reTheme2' ),
		'view_item'                  => __( 'View ' . $singular, 'reTheme2' ),
		'separate_items_with_commas' => __( 'Separate ' . strtolower( $plural ) . ' with commas', 'reTheme2' ),
		'add_or_remove_items'        => __( 'Add or remove ' . strtolower( $plural ), 'reTheme2' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'reTheme2' ),
		'popular_items'              => __( 'Popular ' . $plural, 'reTheme2' ),
		'search_items'               => __( 'Search ' . $plural, 'reTheme2' ),
		'not_found'                  => __( 'Not Found', 'reTheme2' ),
		'no_terms'                   => __( 'No ' . strtolower( $plural ), 'reTheme2' ),
		'items_list'                 => __( $plural . ' list', 'reTheme2' ),
		'items_list_navigation'      => __( $plural . ' list navigation', 'reTheme2' ),
	);
}

/**
 * Type
 */
// function type() {
// 	$args = array(
// 		'labels'            => get_labels( 'Type' ),
// 		'hierarchical'      => false,
// 		'public'            => true,
// 		'show_ui'           => true,
// 		'show_admin_column' => true,
// 	);

// 	register_taxonomy( 'type', array( 'gallery' ), $args );
// }
// add_action( 'init', 'reTheme2\Taxonomies\type' );
