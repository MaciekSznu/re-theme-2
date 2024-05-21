<?php
/**
 * Theme functions
 * ---------------------------------------------------------------------------------------
 *
 * This file prepares all functionality except theme templates. It automatically
 * includes php files used by theme, therefore no code should be added here.
 * Each piece of functionality should be added as a separate file in the `includes`
 * folder, and it will be automatically included and available in the theme.
 *
 * @package WordPress
 */

/*
* Initialize the theme core
*/
require_once 'core/init.php';

/*
* Register Gutenberg blocks
*/
foreach ( glob( __DIR__ . '/parts/blocks/*/register.php' ) as $filename ) {
	require_once $filename;
}
