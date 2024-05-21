<?php
/**
 * Template Name: Template Page
 * The static page template.
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

get_header();
the_post();

?>
	<main id="main-content" class="page-content" role="main">
		<?php load_styles_components( 'page' ); ?>
		<h1><?php the_title(); ?></h1>
		<div class="page-entry">
			<?php the_content(); ?>
		</div>
	<?php
		$query_args = array(
			'post_type'      => 'post_type',
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
			'posts_per_page' => - 1,
			// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
			'tax_query'      => array(
				array(
					'taxonomy' => 'people',
					'field'    => 'slug',
					'terms'    => 'bob',
				),
			),
			// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
			'meta_query'     => array(
				array(
					'key'     => 'color',
					'value'   => 'blue',
					'compare' => 'NOT LIKE',
				),
			),
		);

		get_posts( $query_args );

		while ( have_posts() ) :
			the_post();
			get_theme_part( 'single/post/index' );
		endwhile;
		wp_reset_postdata();
		?>
	</main>
<?php

get_footer();
