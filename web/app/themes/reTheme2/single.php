<?php
/**
 * The single post page template.
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

get_header();
the_post();
?>
	<main id="main-content" class="page-content page-content--single" role="main">
		<?php load_styles_components( 'page' ); ?>
		<div class="container">
			<h1><?php the_title(); ?></h1>
		</div>
		<div class="page-entry">
			<?php the_content(); ?>
		</div>
		<div class="post-comments-wrapper">
			<?php load_styles_components( 'forms' ); ?>			
			<div class="container">
				<?php comments_template(); ?>
			</div>
		</div>
	</main>
<?php
	get_template_part( 'sidebar' );
get_footer();
