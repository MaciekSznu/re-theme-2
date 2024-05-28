<?php
/**
 * Sanitize table data function.
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

/**
 * Function that converts comma separate data to the dot separated and remove empty spaces
 *
 * @param string  $data String to truncate.
 *
 * @return string Sanitized string.
 */
function sanitize_table_data( $data ) {
	$data = str_replace( ',', '.', $data );
	$data = preg_replace( '/\s+/', '', $data );
	return $data;
}
