<?php
/**
 * The main template file.
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

get_header();
$heading_text = get_blog_heading();
?>
	<main id="main-content" class="page-content page-content--archive" role="main">
		<?php load_styles_components( 'page' ); ?>

		<div class="container">
			<?php
			if ( have_posts() ) :
				if ( $heading_text ) :
					?>
						<h1><?php echo esc_html( $heading_text ); ?></h1>
					<?php
					endif;

					get_theme_part( 'archive/loop-post' );
				else :
					?>
					<h2><?php esc_html_e( 'Sorry, nothing found.', 'reTheme2' ); ?></h2>
					<?php
			endif;

				get_template_part( 'sidebar' );

				$args = array(
					'mid_size'           => 3,
					'prev_text'          => __( 'Prev' ),
					'next_text'          => __( 'Next' ),
					'screen_reader_text' => __( 'Posts navigation' ),
				);

				the_posts_pagination( $args );
				?>
		</div>
	</main>
<?php
get_footer();
