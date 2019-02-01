<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php
/** Output the featured image banner on all pages except for the homepage */
if (!is_front_page()) {
	get_template_part('template-parts/featured-image');
} ?>

<div class="wrapper" id="error-404-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main">

					<section class="error-404 not-found">

						<header class="page-header text-center">

							<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'understrap' ); ?></h1>

						</header><!-- .page-header -->

						<div class="page-content text-center">

							<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try searching via the form below?', 'understrap' ); ?></p>

							<div class="col-xs-12 col-sm-12 col-md-8 col-lg-6 offset-0 offset-md-2 offset-lg-3 mt-5 mb-5">
								<?php get_search_form(); ?>
							</div>


						</div><!-- .page-content -->

					</section><!-- .error-404 -->

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #error-404-wrapper -->

<?php get_footer(); ?>
