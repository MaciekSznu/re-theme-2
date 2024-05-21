<?php
/**
 * The document head pulled in by the themes header file.
 *
 * @package WordPress
 * @subpackage reTheme2
 * @since reTheme2 1.0
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<?php wp_head(); ?>
	<?php get_supported_colors( 'styles' ); ?>
</head>
