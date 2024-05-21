<?php
/**
 * Single post.
 *
 * @package WordPress
 * @subpackage reTheme2
 * @since reTheme2 1.0
 */

?>

<article class="single-post">
	<header class="single-post__heading">
		<h2 class="single-post__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	</header>
	<div class="single-post__content">
		<?php the_excerpt(); ?>
	</div>
</article>
