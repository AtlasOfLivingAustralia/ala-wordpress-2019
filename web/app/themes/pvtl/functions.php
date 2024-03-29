<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


// Allow additional character types in usernames

function ala_sanitize_user($username, $raw_username, $strict) {
    
    $allowed_symbols = "a-z0-9+_.\-@%"; //yes we allow whitespace which will be trimmed further down script
    
    //Strip HTML elements
    $username = wp_strip_all_tags ($raw_username);

    //Remove accents
    $username = remove_accents ($username);

    //Kill octets
    $username = preg_replace ('|%([a-fA-F0-9][a-fA-F0-9])|', '', $username);

    //Kill entities
    $username = preg_replace ('/&.+?;/', '', $username);

    //allow + and % symbols
    $username = preg_replace ('|[^'.$allowed_symbols.']|iu', '', $username);

    //Remove leading/trailing whitespace
    $username = trim ($username);

    // Consolidate contiguous whitespace
    $username = preg_replace ('|\s+|', ' ', $username);

    //Done
    return $username;
    
}

add_filter ('sanitize_user', 'ala_sanitize_user', 10, 3);

// remove unused emoji js/css
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// remove embed js (we don't need embedding remote WP posts into a page!)
function burn_the_embed(){
    wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'burn_the_embed' );

// Register support for Gutenberg wide images in your theme

function theme_setup() {
    add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'theme_setup' );

# JS for the ALA Publish admin page
function enqueue_publish_script($hook) {
    // Only add to the edit.php admin page.
    // See WP docs.
    if ('ala-publish.php' !== $hook) {
        return;
    }
    wp_enqueue_script('ala_publish_script', get_stylesheet_directory_uri()  . '/js/ala-publish.js');
}
add_action('admin_enqueue_scripts', 'enqueue_publish_script');


# hide admin bar for non-editor/admin users
add_action('set_current_user', 'cc_hide_admin_bar');
function cc_hide_admin_bar() {
  if (!current_user_can('edit_posts')) {
    add_filter('show_admin_bar', '__return_false');
  }
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
        'footer-1'  => esc_html__( 'Footer 1 (Single Column)', 'understrap' ),
        'footer-2'  => esc_html__( 'Footer 2 (Single Column)', 'understrap' ),
        'footer-3'  => esc_html__( 'Footer 3 (Single Column)', 'understrap' ),
        'footer-4'  => esc_html__( 'Footer 4 (Single Column)', 'understrap' ),
        'footer-5'  => esc_html__( 'Footer 5 (Horizontal)', 'understrap' ),
        'footer-6'  => esc_html__( 'Footer 6 (Single Column)', 'understrap' ),
        'footer-7'  => esc_html__( 'Footer 7 (Single Column)', 'understrap' ),
        'footer-8'  => esc_html__( 'Footer 8 (Single Column)', 'understrap' ),
        'footer-9'  => esc_html__( 'Footer 9 (Single Column)', 'understrap' ),
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


// Publish to the production static site

add_action( 'admin_menu', 'register_ala_publish_menu_page' );
function register_ala_publish_menu_page() {
  // add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
  add_menu_page( 'ALA publish to static', 'ALA publish', 'publish_pages', 'ala-publish.php', '', 'dashicons-megaphone', 22 );
}




// Returns the user (experience) group name for an index (0, 1 or 2)

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



// Returns the user (experience) group description for an index (0, 1 or 2)

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


// Returns the url to use for logout

function get_ala_logout_url() {
    // return 'https://auth.ala.org.au/cas/logout';
    return wp_logout_url();
}

function get_ala_login_url() {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

    // check if WP-Cassify plugin is active
    if ( is_plugin_active( 'wp-cassify/wp-cassify.php' ) ) {
        global $wp;
        $post_login_url = home_url( $wp->request );
        // append slash to home page
        if ( is_front_page() ) {
            $post_login_url = $post_login_url . '/';
        }
        return do_shortcode( '[wp_cassify_login_with_redirect service_redirect_url="' . $post_login_url . '"]' );
    } else {
        return wp_login_url();
    }

}

function get_ala_auth_server() {
    $auth_server = 'https://auth.ala.org.au';
    if (defined('ALA_AUTH_URL')) {
        $auth_server = ALA_AUTH_URL;
    }
    return $auth_server;
}

// Sets up theme Image sizes and registers support for featured images.

function image_setup()
{
    add_theme_support('post-thumbnails', array('post', 'page'));

     // All these images are set to 1px larger than what is required for the location they are uploaded into.
     // ACF then limits their size to 1420, 768, and 400 width respectively.
     // This is so that Wordpress won't resize them and break the GIF functionality.
     // Technically we could delete all of these sizes now and just return the 'full' image.
     // Will look at this post launch.

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


// Create Admin Pages for ACF fields

if ( function_exists('acf_add_options_page') ) {
    //Site Options
    acf_add_options_page(array(
        'page_title' 	=> 'General Options',
        'menu_title' 	=> 'General Options',
        'menu_slug' 	=> 'general-options',
        'icon_url'      => 'dashicons-menu',
        'position'      => '30'
    ));
}


// Get the current Experience Group cookie.

function get_experience_group( $escape = true ) {
    return isset( $_COOKIE['experience'] )
        ? ( $escape ? esc_html( $_COOKIE['experience'] ) : $_COOKIE['experience'] )
        : null;
}


// Set the 'Customise Your Experience' cookie from the popup on the frontend.

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


// Outputs the Experience Group modal in the footer.

function display_experience_popup() {
    get_template_part( 'template-parts/modal', 'experience' );
}
add_action( 'wp_footer', 'display_experience_popup' );


// Populate the ACF field with the available experience groups.

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


// Escape all groups in an array.

function escape_experience_groups( $groups ) {
    $groups = array_map( function ( $group ) {
        return esc_html( $group );
    }, $groups );

    return $groups;
}
add_filter( 'experience_groups', 'escape_experience_groups' );



// Convert menu items with '---' as link text into menu separators
// Based on https://wordpress.org/plugins/mhm-menu-separator (but without conversion of # URLs into unlinked items)

function menu_separatorisationise( $item_output, $item ) {
        if ( '---' === $item->post_title ) {
                return '<hr class="menu-separator">'; // Horizontal line
        } else {
                return $item_output; // Unmodified output for this link
        }
}
add_filter( 'walker_nav_menu_start_el', 'menu_separatorisationise', 10, 2 );


// Outputs the search modal in the footer.

function display_search_popup() {
	get_template_part( 'template-parts/modal', 'search' );
}
//add_action( 'wp_footer', 'display_search_popup' );


// Add Mobile Logo option to customizer

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


// Returns a custom logo + custom mobile logo, linked to home.

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


     // If the logo alt attribute is empty, get the site title and explicitly
     // pass it to the attributes used by wp_get_attachment_image().

        $image_alt = get_post_meta( $custom_logo_id, '_wp_attachment_image_alt', true );
        if ( empty( $image_alt ) ) {
            $custom_logo_attr['alt'] = get_bloginfo( 'name', 'display' );
        }

     // If the alt attribute is not empty, there's no need to explicitly pass
     // it because wp_get_attachment_image() already adds the alt attribute.

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

    return apply_filters( 'get_custom_logo_pvtl', $html, $blog_id );
}


// Displays a custom logo, linked to home.

function the_custom_logo_pvtl( $blog_id = 0 ) {
    echo get_custom_logo_pvtl( $blog_id );
}


// Right table-of-contents nav - parse headings -
// used if $auto_toc_headings is set to true in
// sidebar-templates/sidebar-right-anchors.php
//
// Pass in $blocks for the page; 
// prints links (should be inside #anchorList)

function ala_heading_anchor_link( $blocks ){
    $dom = new DOMDocument();

    foreach ( $blocks as $block ) {
        @$dom->loadHTML($block['innerHTML']);

        $h3 = $dom->getElementsByTagName('h3');
        $title = 'Title';

        foreach ( $h3 as $node ){
            $title = $node->nodeValue;
            //$title = 'title';
            //$name = str_replace(' ', '-', $title);
            //$anchor = 'anchor';
            //$title = $h2[0]->nodeValue;
            $anchor = 'something';
            $anchor = filter_var ( $anchor, FILTER_SANITIZE_STRING);

            $heading_link_output = sprintf( '<a href="#%1$s" title="%2$s" class="list-group-item list-group-item-action"><span>%2$s</span></a>',
                $anchor,
                $title
            );
            echo $heading_link_output;
        }
    }
}


// Automatically add IDs to headings such as <h2></h2>

function auto_id_headings( $content ) {
    $content = preg_replace_callback( '/(\<h[1-6](.*?))\>(.*)(<\/h[1-6]>)/i', function( $matches ) {
        if ( ! stripos( $matches[0], 'id=' ) ) :
            $matches[0] = $matches[1] . $matches[2] . ' id="' . sanitize_title( $matches[3] ) . '">' . $matches[3] . $matches[4];
        endif;
        return $matches[0];
    }, $content );
    return $content;
}
add_filter( 'the_content', 'auto_id_headings' );


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


// Prints HTML with meta information for the current post-date/time and author.

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

    $my_excerpt = get_the_excerpt();

    // if there is no excerpt, get the post content
    if (strlen($my_excerpt) < 1):
        $excerpt = strip_tags(get_the_content());
    endif;

    // if excerpt/content is longer than limit, trim it and append the ellipsis
    if (strlen($my_excerpt) > $chars):
        $my_excerpt = substr($my_excerpt, 0, $chars);
        $my_excerpt .= '…';
    endif;

	return $my_excerpt;
}


// returns an excerpt div if there is a real excerpt (not just the start of post text)
function display_excerpt_single_post($chars = 60){
    $ala_excerpt = get_the_excerpt();
    $ala_post_content = wp_strip_all_tags( get_the_content() );

    $ala_excerpt_start = substr($ala_excerpt, 0, $chars);
    $ala_post_start = substr($ala_post_content, 0, $chars);
    $ala_excerpt_output = '';

    if ($ala_excerpt_start != $ala_post_start) {
        $ala_excerpt_output .= '<div class="entry-excerpt">';
        $ala_excerpt_output .= $ala_excerpt;
        $ala_excerpt_output .= '</div>';
    }
    return $ala_excerpt_output;
}


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


// remove some understrap filters
function remove_parent_filters(){ //Have to do it after theme setup, because child theme functions are loaded first
    // stop understrap from adding "Read More" stuff after every excerpt
    remove_filter('excerpt_more', 'understrap_custom_excerpt_more');
    remove_filter('wp_trim_excerpt', 'understrap_all_excerpts_get_more_link');
}
add_action( 'init', 'remove_parent_filters' );


// Register each of the blocks
require_once( 'library/register-blocks.php' );

// Adds custom admin styles
require_once( 'library/custom-admin-styles.php' );

