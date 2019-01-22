<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

$container = get_theme_mod('understrap_container_type');
?>

<?php get_template_part('template-parts/featured-image'); ?>

<div class="wrapper" id="archive-wrapper">

	<div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

		<?php get_template_part('template-parts/category-bar'); ?>

		<main class="site-main post-list" id="main">
			<div class="row">
				<?php if (have_posts()) : ?>

					<?php /* Start the Loop */
					$counter = 0;
					?>

					<?php while (have_posts()) : the_post();
						// Wrap first post in a larger 8 col div
						if ($counter == 0) {
							echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">';
							//Wrap second post in opening 4 col div
						} else if ($counter == 1) {
							echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">';
							//Wrap all posts from 4th onwards in the standard 4 col div
						} else if ($counter > 2) {
							echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">';
						}

						?>

						<?php

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part('loop-templates/content', get_post_format());
						?>

						<?php
						//Close first large 8 col div
						if ($counter == 0) {
							echo '</div>';
							// close all cols from 3rd post onwards
						} else if ($counter >= 2) {
							echo '</div>';
						}
						$counter++;
					endwhile; ?>

				<?php else : ?>

					<?php get_template_part('loop-templates/content', 'none'); ?>

				<?php endif; ?>
			</div><!-- .row -->
		</main><!-- #main -->

		<!-- The pagination component -->
		<?php understrap_pagination(); ?>


	</div><!-- #content -->

</div><!-- #archive-wrapper -->

<?php get_footer(); ?>
