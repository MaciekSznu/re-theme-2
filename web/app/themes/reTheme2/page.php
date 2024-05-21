<?php
/**
 * The static page template.
 *
 * @package WordPress
 * @subpackage reTheme2
 * @since reTheme2 1.0
 */

get_header();
the_post();
?>
<main id="main-content" class="page-content" role="main">
	<?php load_styles_components( 'page' ); ?>
	<?php get_theme_part( 'components/hero/index' ); ?>
	<div class="page-entry">
		<?php the_content(); ?>
	</div>
</main>
<?php
get_footer();
