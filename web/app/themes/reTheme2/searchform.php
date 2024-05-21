<?php
/**
 * The search form template.
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

?>

<form class="search-form" method="get" action="<?php bloginfo( 'url' ); ?>" role="search">
	<?php load_styles_components( 'forms' ); ?>
	<div class="search-form-content">
		<input type="text" name="s" id="s"/>
		<input type="submit" value="search"/>
	</div>
</form>
