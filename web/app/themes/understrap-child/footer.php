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
            <div class="row align-items-center">
                <div class="col-md-12 col-lg-4 align-center logo-column">
                    <?= wp_get_attachment_image( $custom_logo_id, 'full', false, $custom_logo_attr ); ?>
                    <div class="account">
                        <a href="#" class="btn btn-outline-white btn-sm">Sign Up</a>
                        <a href="#" class="btn btn-primary btn-sm">Login</a>
                        <?php get_template_part('template-parts/social-icons'); ?>
                    </div>
                </div><!--col end -->
                <div class="col-md-6 col-lg-4 content-column">
                    <?php   $imageCol1 = get_field('col_1_image', 'option');
                            $contentCol1 = get_field('col_1_content', 'option');
                    ?>
                    <div class="d-flex">
                        <div class="image">
                            <img src="<?= $imageCol1['sizes']['medium']; ?>" alt="<?= $imageCol1['alt']; ?>" />
                        </div>
                        <div class="content">
                            <?= $contentCol1; ?>
                        </div>
                    </div>
                </div><!--col end -->
                <div class="col-md-6 col-lg-4 content-column">
                    <?php   $imageCol2 = get_field('col_2_image', 'option');
                            $contentCol2 = get_field('col_2_content', 'option');
                    ?>
                    <div class="d-flex">
                        <div class="image">
                            <img src="<?= $imageCol2['sizes']['medium']; ?>" alt="<?= $imageCol2['alt']; ?>" />
                        </div>
                        <div class="content">
                            <?= $contentCol2; ?>
                        </div>
                    </div>
                </div><!--col end -->
            </div><!-- row end -->
        </div><!-- container end -->
    </div>

    <div class="footer-middle">
        <div class="<?php echo esc_attr( $container ); ?>">
            <div class="row">
                <div class="col-md-12">

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

