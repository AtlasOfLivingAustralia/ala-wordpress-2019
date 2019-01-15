<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

$container = get_theme_mod( 'understrap_container_type' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="site" id="page">

    <!-- ******************* The Navbar Area ******************* -->
    <div id="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite">

        <a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'understrap' ); ?></a>

        <nav class="navbar navbar-expand-md navbar-dark">

            <?php if ( 'container' == $container ) : ?>
            <div class="container">
                <?php endif; ?>

                <!-- Your site title as branding in the menu -->
                <?php if ( ! has_custom_logo() ) { ?>

            <?php if ( is_front_page() && is_home() ) : ?>

                <h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>

            <?php else : ?>

                <a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>

            <?php endif; ?>


                <?php } else {
                    the_custom_logo();
                } ?><!-- end custom logo -->
                <div class="outer-nav-wrapper">
                    <div class="top-bar">
                        <?php if ( $xp = get_experience_group() ) { ?>
                            <button type="button" class="experience-group-change"><?php echo $xp === 'null' ? 'Customise Your Experience' : 'Viewing as ' . $xp; ?></button>
                        <?php } ?>
                        <a href="/contact" class="btn btn-link btn-sm">Contact Us</a>
                        <div class="account">
                            <a href="#" class="btn btn-outline-white btn-sm">Sign Up</a>
                            <a href="#" class="btn btn-primary btn-sm">Login</a>
                        </div>
                    </div>

                    <div class="main-nav-wrapper">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap' ); ?>">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <?php
                        $menu_location = strtolower( preg_replace( "/(\W)+/", '-', get_experience_group( false ) ) );

                        if ( ! $menu_location || $menu_location === 'null' ) {
                            $menu_location = 'primary';
                        }
                        ?>

                        <!-- The WordPress Menu goes here -->
                        <?php wp_nav_menu(
                            array(
                                'theme_location'  => $menu_location,
                                'container_class' => 'collapse navbar-collapse',
                                'container_id'    => 'navbarNavDropdown',
                                'menu_class'      => 'navbar-nav ml-auto',
                                'fallback_cb'     => '',
                                'menu_id'         => 'main-menu',
                                'depth'           => 2,
                                'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
                            )
                        ); ?>
                        <a href="#" class="search-trigger" title="search"><img src="<?= get_stylesheet_directory_uri(); ?>/images/icons/search-light.svg" alt="Search" width="25px" />Search</a>
                    </div>

                </div>
                <?php if ( 'container' == $container ) : ?>
            </div><!-- .container -->
        <?php endif; ?>

        </nav><!-- .site-navigation -->

    </div><!-- #wrapper-navbar end -->
