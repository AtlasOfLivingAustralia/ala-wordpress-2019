<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register support for Gutenberg wide images in your theme
 */
function theme_setup() {
    add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'theme_setup' );


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
    wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:700|Roboto:400,400i,500' );
    wp_enqueue_script( 'jquery');
	wp_enqueue_script( 'popper-scripts', get_stylesheet_directory_uri() . '/js/popper.min.js', array(), false);
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );

    // Inject WP variables into our custom script
    wp_localize_script( 'child-understrap-scripts', 'wp_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

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
        'footer-1'  => esc_html__( 'Footer 1 (Double Width)', 'understrap' ),
        'footer-2'  => esc_html__( 'Footer 2 (Single Column)', 'understrap' ),
        'footer-3'  => esc_html__( 'Footer 3 (Single Column)', 'understrap' ),
        'footer-4'  => esc_html__( 'Footer 4 (Horizontal)', 'understrap' ),
        'footer-5'  => esc_html__( 'Footer 5 (Double Width)', 'understrap' ),
        'footer-6'  => esc_html__( 'Footer 6 (Single Column)', 'understrap' ),
        'footer-7'  => esc_html__( 'Footer 7 (Single Column)', 'understrap' ),
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
 * Returns the user (experience) group name for an index (0, 1 or 2)
 *
 */

function get_experience_group_name( $groupIndex )
{
    $groups = get_field_object( 'experience_groups', 'option' );
    if (is_int ( $groupIndex ))
    {
        if (count( $groups['value'] ) > $groupIndex )
        {
            return $groups['value'][$groupIndex]['name'];
        }
    }
}


/**
 * Returns the user (experience) group description for an index (0, 1 or 2)
 *
 */

function get_experience_group_description( $groupIndex )
{
    $groups = get_field_object( 'experience_groups', 'option' );
    if (is_int ( $groupIndex ))
    {
        if (count( $groups['value'] ) > $groupIndex )
        {
            return $groups['value'][$groupIndex]['description'];
        }
    }
}


/**
 * Sets up theme Image sizes and registers support for featured images.
 *
 * @since 1.0
 */
function image_setup()
{
    add_theme_support('post-thumbnails', array('post', 'page'));

    /**
     * All these images are set to 1px larger than what is required for the location they are uploaded into.
     * ACF then limits their size to 1420, 768, and 400 width respectively.
     * This is so that Wordpress won't resize them and break the GIF functionality.
     * Technically we could delete all of these sizes now and just return the 'full' image.
     * Will look at this post launch.
     */

    //Full Width Image - max-width is 1420px and height is automatic depending on the image ratio
    add_image_size('full-width-auto-height', 1920 );

    //Half Width Image
    add_image_size('half-width-auto-height', 768 );

    //Featured Image
    add_image_size('featured', 640, 480, true );

    // Team Member
    add_image_size('team', 768, 870, true );

    //Post Image
    add_image_size('post', 790, 670, true );

}

add_action('after_setup_theme', 'image_setup');


//Custom menu walker to add title attributes by default.
//This is used for the footer menus.
class pvtl_title_attr_walker extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth = 0, $args = Array(), $id = 0)
    {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class="'. esc_attr( $class_names ) . '"';

        $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : ' title="'  . esc_attr( $item->title ) .'"';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
        $item_output .= $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

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
 * Outputs the search modal in the footer.
 */
function display_search_popup() {
	get_template_part( 'template-parts/modal', 'search' );
}
add_action( 'wp_footer', 'display_search_popup' );


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


function remove_unused_widgets(){

	// Unregister some of the TwentyTen sidebars
	unregister_sidebar( 'left-sidebar' );
	unregister_sidebar( 'hero' );
	unregister_sidebar( 'herocanvas' );
	unregister_sidebar( 'statichero' );
	unregister_sidebar( 'footerfull' );
}
add_action( 'widgets_init', 'remove_unused_widgets', 11 );


function pvtl_remove_page_templates( $templates ) {
	unset( $templates['page-templates/both-sidebarspage.php'] );
	unset( $templates['page-templates/left-sidebarpage.php'] );
	unset( $templates['page-templates/empty.php'] );
	unset( $templates['page-templates/blank.php'] );
	return $templates;
}
add_filter( 'theme_page_templates', 'pvtl_remove_page_templates' );

/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
if ( ! function_exists( 'pvtl_posted_on' ) ) {
	function pvtl_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date( 'jS F Y' ) ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date( 'jS F Y' ) )
		);
		$posted_on   = apply_filters(
			'understrap_posted_on', sprintf(
				'<span class="posted-on"><span class="sr-only">%1$s </span>%2$s</span>',
				esc_html_x( 'Posted on', 'post date', 'understrap' ),
				apply_filters( 'understrap_posted_on_time', $time_string )
			)
		);

		echo $posted_on; // WPCS: XSS OK.
	}
}

function pvtl_get_excerpt($chars = 150){

	$excerpt = strip_tags(get_the_content());

	$excerpt = substr($excerpt, 0, $chars);

	$excerpt .= '…';

	return $excerpt;
};


// Specify allowed gutenberg blocks
add_filter( 'allowed_block_types', 'pvtl_allowed_block_types' );

function pvtl_allowed_block_types( $allowed_blocks ) {

	return array(
		'core/image',
		'core/paragraph',
		'core/heading',
		'core/list',
		'core/quote',
		'core/audio',
		'core/cover',
		'core/file',
		'core/video',
		'core/table',
		'core/code',
		'core/freeform',
		'core/html',
		'core/pullquote',
		'core/button',
		'core/columns',
		'core/separator',
		'core/spacer',
		'core/shortcode',
		'core/embed',
		'core-embed/youtube',
		'core-embed/vimeo',
		'acf/content-anchor',
		'acf/feature-box',
		'acf/hero-banner-slider',
		'acf/icon-with-text',
		'acf/latest-posts',
		'acf/link-box',
		'acf/link-list',
		'acf/tab-box',
		'acf/team-member',
	);

}

function myguten_enqueue() {
	wp_enqueue_script( 'myguten-script',
		get_stylesheet_directory_uri() . '/js/gutenberg-scripts.js',
		array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' )
	);
}
add_action( 'enqueue_block_editor_assets', 'myguten_enqueue' );



/** Register each of the blocks */
require_once( 'library/register-blocks.php' );

/** Adds custom admin styles */
require_once( 'library/custom-admin-styles.php' );
