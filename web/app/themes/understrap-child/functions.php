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
