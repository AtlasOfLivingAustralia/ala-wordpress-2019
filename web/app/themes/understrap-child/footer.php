<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$container = get_theme_mod( 'understrap_container_type' );
$custom_logo_id = get_theme_mod( 'custom_logo' );
$custom_logo_attr = array(
    'class'    => 'custom-logo',
    'itemprop' => 'logo',
);
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<footer class="site-footer" id="colophon">

	<div class="footer-top">
        <div class="<?php echo esc_attr( $container ); ?>">
            <div class="row">
                <div class="col-md-4">
                    <?= wp_get_attachment_image( $custom_logo_id, 'full', false, $custom_logo_attr ); ?>
                    <div class="account">
                        <a href="#" class="btn btn-outline-white btn-sm">Sign Up</a>
                        <a href="#" class="btn btn-primary btn-sm">Login</a>
                        <?php get_template_part('template-parts/social-icons'); ?>
                    </div>
                </div><!--col end -->
                <div class="col-md-4">

                </div><!--col end -->
                <div class="col-md-4">

                </div><!--col end -->
            </div><!-- row end -->
        </div><!-- container end -->
    </div>

    <div class="footer-middle">
        <div class="<?php echo esc_attr( $container ); ?>">
            <div class="row">
                <div class="col-md-12">
                    <div class="site-info">
                        <?php understrap_site_info(); ?>
                    </div><!-- .site-info -->
                </div><!--col end -->
            </div><!-- row end -->
        </div><!-- container end -->
    </div>

    <div class="footer-bottom">
        <div class="<?php echo esc_attr( $container ); ?>">
            <div class="row">
                <div class="col-md-12">
                    <div class="site-info">
                        <?php understrap_site_info(); ?>
                    </div><!-- .site-info -->
                </div><!--col end -->
            </div><!-- row end -->
        </div><!-- container end -->
    </div>

    <div class="footer-copyright">
        <div class="<?php echo esc_attr( $container ); ?>">
            <div class="row">
                <div class="col-md-12">
                    <div class="site-info">
                        <?php understrap_site_info(); ?>
                    </div><!-- .site-info -->
                </div><!--col end -->
            </div><!-- row end -->
        </div><!-- container end -->
    </div>

</footer><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

