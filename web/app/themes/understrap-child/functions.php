<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();
    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'jquery');
	wp_enqueue_script( 'popper-scripts', get_stylesheet_directory_uri() . '/js/popper.min.js', array(), false);
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

function add_child_theme_textdomain() {
    load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );






function setup_nav_menus() {

    unregister_nav_menu('primary');

    $menus = array(
        'mobile-nav' => esc_html__( 'Mobile', 'understrap' ),
        'primary'  => esc_html__( 'User Group - All', 'understrap' ),
    );

    $groups = get_field_object( 'experience_groups', 'option' );

    if ( count( $groups['value'] ) ) {
        foreach ( $groups['value'] as $group ) {
            $slug = strtolower( preg_replace( "/(\W)+/", '-', $group['name'] ) );
            $menus[ $slug ] = 'User Group - ' . esc_html( $group['name'] );
        }
    }

    register_nav_menus( $menus );
}
add_action( 'init', 'setup_nav_menus' );

/**
 * Create Admin Pages for ACF fields
 *
 * @since 1.0
 */
if ( function_exists('acf_add_options_page') ) {
    /**
     * Site Options
     */
    acf_add_options_page(array(
        'page_title' 	=> 'General Options',
        'menu_title' 	=> 'General Options',
        'menu_slug' 	=> 'general-options',
        'icon_url'      => 'dashicons-menu',
        'position'      => '30'
    ));
}

/**
 * Get the current Experience Group cookie.
 *
 * @param bool $escape
 *
 * @return string
 */
function get_experience_group( $escape = true ) {
    return isset( $_COOKIE['experience'] )
        ? ( $escape ? esc_html( $_COOKIE['experience'] ) : $_COOKIE['experience'] )
        : null;
}

/**
 * Set the 'Customise Your Experience' cookie from the popup on the frontend.
 */
function set_experience_cookie() {
    $experience = isset( $_REQUEST['group'] ) ? sanitize_text_field( $_REQUEST['group'] ) : 'null';

    $groups = get_field_object( 'experience_groups', 'option' );
    $groups = array_map( function ( $group ) {
        return $group['name'];
    }, $groups['value'] );

    if ( $experience !== 'null' && ! in_array( $experience, $groups ) ) {
        $experience = 'null';
    }

    $plus_one_year = time() + 365 * 24 * 60 * 60;

    setCookie( 'experience', $experience, $plus_one_year, '/' );

    die( 'experience: ' . $experience );
}
add_action( 'wp_ajax_set_experience_cookie', 'set_experience_cookie' );
add_action( 'wp_ajax_nopriv_set_experience_cookie', 'set_experience_cookie' );

/**
 * Outputs the Experience Group modal in the footer.
 */
function display_experience_popup() {
    get_template_part( 'template-parts/modal', 'experience' );
}
add_action( 'wp_footer', 'display_experience_popup' );

/**
 * Populate the ACF field with the available experience groups.
 */
add_filter( 'acf/load_field/name=show_to_user_group', function ( $field ) {
    $groups = get_field_object( 'experience_groups', 'option' );
    $choices = [];

    if ( isset( $groups['value'] ) && count( $groups['value'] ) ) {
        foreach ( $groups['value'] as $group ) {
            $choices[ $group['name'] ] = $group['name'];
        }
    }

    $field['choices'] = $choices;

    return $field;
}, 10, 3 );

/**
 * Escape all groups in an array.
 *
 * @param array $groups
 *
 * @return array
 */
function escape_experience_groups( $groups ) {
    $groups = array_map( function ( $group ) {
        return esc_html( $group );
    }, $groups );

    return $groups;
}
add_filter( 'experience_groups', 'escape_experience_groups' );



/**
 * Add Mobile Logo option to customizer
 */
function mobile_logo_customizer_settings($wp_customize) {
// add a setting for the site logo
    $wp_customize->add_setting('mobile_logo');
// Add a control to upload the logo
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mobile_logo',
        array(
            'label' => 'Mobile Logo',
            'description' => 'This logo will be shown in the mobile header',
            'section' => 'title_tagline',
            'settings' => 'mobile_logo',
            'priority'   => 9,
        ) ) );
}
add_action('customize_register', 'mobile_logo_customizer_settings');

/**
 * Returns a custom logo + custom mobile logo, linked to home.
 *
 */
function get_custom_logo_pvtl( $blog_id = 0 ) {
    $html = '';
    $switched_blog = false;

    if ( is_multisite() && ! empty( $blog_id ) && (int) $blog_id !== get_current_blog_id() ) {
        switch_to_blog( $blog_id );
        $switched_blog = true;
    }

    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $mobile_logo_path = get_theme_mod( 'mobile_logo' );

    if ($mobile_logo_path) {
        $mobile_logo_id = attachment_url_to_postid($mobile_logo_path);
    } else {
        $mobile_logo_id = $custom_logo_id;
    }


    // We have a logo. Logo is go.
    if ( $custom_logo_id ) {
        $custom_logo_attr = array(
            'class'    => 'custom-logo',
            'itemprop' => 'logo',
        );
        $mobile_logo_attr = array(
            'class'    => 'mobile-logo',
            'itemprop' => 'logo',
        );

        /*
     * If the logo alt attribute is empty, get the site title and explicitly
     * pass it to the attributes used by wp_get_attachment_image().
     */
        $image_alt = get_post_meta( $custom_logo_id, '_wp_attachment_image_alt', true );
        if ( empty( $image_alt ) ) {
            $custom_logo_attr['alt'] = get_bloginfo( 'name', 'display' );
        }

        /*
     * If the alt attribute is not empty, there's no need to explicitly pass
     * it because wp_get_attachment_image() already adds the alt attribute.
     */
        $html = sprintf( '<a href="%1$s" class="custom-logo-link navbar-brand" rel="home" itemprop="url">%2$s %3$s</a>',
            esc_url( home_url( '/' ) ),
            wp_get_attachment_image( $custom_logo_id, 'full', false, $custom_logo_attr ),
            wp_get_attachment_image( $mobile_logo_id, 'full', false, $mobile_logo_attr )
        );
    }

    // If no logo is set but we're in the Customizer, leave a placeholder (needed for the live preview).
    elseif ( is_customize_preview() ) {
        $html = sprintf( '<a href="%1$s" class="custom-logo-link navbar-brand" style="display:none;"><img class="custom-logo"/></a>',
            esc_url( home_url( '/' ) )
        );
    }

    if ( $switched_blog ) {
        restore_current_blog();
    }

    /**
     * Filters the custom logo output.
     *
     * @since 4.5.0
     * @since 4.6.0 Added the `$blog_id` parameter.
     *
     * @param string $html    Custom logo HTML output.
     * @param int    $blog_id ID of the blog to get the custom logo for.
     */
    return apply_filters( 'get_custom_logo_pvtl', $html, $blog_id );
}

/**
 * Displays a custom logo, linked to home.
 *
 * @since 4.5.0
 *
 * @param int $blog_id Optional. ID of the blog in question. Default is the ID of the current blog.
 */
function the_custom_logo_pvtl( $blog_id = 0 ) {
    echo get_custom_logo_pvtl( $blog_id );
}
