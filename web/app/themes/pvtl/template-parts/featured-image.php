<?php
// If a featured image is set, insert into layout and use Interchange
// to select the optimal image size per named media query.

global $wp_query;

$page_banner = '';

if ( ! empty( $post ) && has_post_thumbnail( $post->ID ) && get_post_type( $post ) == 'page' ) {
	// Use the page image
	$page_banner = get_the_post_thumbnail_url( $post, 'full-width-auto-height' );

} elseif (get_field( 'banner_image', get_queried_object() )) {
	// No image available, use the default
	$default_page_banner         = get_field( 'banner_image', get_queried_object() );
	$page_banner = $default_page_banner['sizes']['full-width-auto-height'];
} else {
	// No image available, use the default
	$default_page_banner         = get_field( 'default_page_banner', 'option' );
	$page_banner = $default_page_banner['sizes']['full-width-auto-height'];
}


?>
<div class="featured-hero" role="banner" style="background-image: url(<?= $page_banner; ?>)">
    <div class="bg-overlay"></div>
    <div class="container">
			<?php
			if ( is_single() || is_page() ) {
				$banner_title = get_the_title();
			} elseif ( is_search() ) {
				$banner_title = __( 'Search Results for', 'pvtl' ) . ' "' . get_search_query() . '"';
			} elseif ( is_404() ) {
				$banner_title = __( '404', 'pvtl' );
			} elseif ( is_tax() ) {
				$banner_title = single_term_title( '', false );
			} elseif ( is_category() ) {
				$banner_title = single_cat_title( '', false );
			} elseif ( is_home() ) {
				$banner_title = get_the_title(get_option( 'page_for_posts' ));
			} else {
				$postType = get_post_type();
				if ( ! $postType ) {
					$postType = $wp_query->query['post_type'];
				}

				$postTypeObj = get_post_type_object( $postType );

				$banner_title = $postTypeObj->labels->name;

			}

			?>
			<?php if ( $banner_title && !is_singular('product') ) { ?>
                <h1 class="banner-title"><?= $banner_title ?></h1>
			<?php } ?>

    </div>
</div>
<?php if ( function_exists( 'yoast_breadcrumb' ) && ! is_front_page() ) { ?>
	<div class="breadcrumbs-wrap">
		<div class="container">
			<?php yoast_breadcrumb( '<nav role="navigation" class="breadcrumbs">', '</nav>' ); ?>
		</div>
	</div>
<?php } ?>
