<?php
/**
 * Primary widget area
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

?>
<aside class="widget-area" role="complementary">
<?php
if ( is_active_sidebar( 'primary_widget_area' ) ) {
	dynamic_sidebar( 'primary_widget_area' );
}
?>
</aside>
