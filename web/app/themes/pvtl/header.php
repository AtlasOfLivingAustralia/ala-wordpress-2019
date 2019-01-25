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

		<nav class="navbar navbar-expand-lg navbar-dark">
			<?php if ( 'container' === $container ) : ?>
			<div class="container">
				<?php endif; ?>

				<!-- Your site title as branding in the menu -->
				<?php if ( ! has_custom_logo() ) : ?>
					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>
					<?php endif; ?>
					<?php
				else :
					the_custom_logo_pvtl();
				endif;
				?>
				<!-- end custom logo -->

				<div class="outer-nav-wrapper">
					<div class="top-bar d-flex">
						<?php
						$xp = get_experience_group();
						if ( $xp ) :
							?>
							<button type="button" data-toggle="modal" data-target="#experience-modal" class="btn btn-link btn-sm xp-btn">
								<?php echo 'null' === $xp ? 'Customise Your Experience' : esc_html( 'Viewing as ' . $xp ); ?> <i class="far fa-angle-down ml-1"></i>
							</button>
						<?php endif; ?>
						<a href="/contact-us" class="btn btn-link btn-sm d-none d-lg-inline-block">Contact Us</a>
						<div class="account d-none d-lg-block">
							<a href="#" class="btn btn-outline-white btn-sm">Sign Up</a>
							<a href="#" class="btn btn-primary btn-sm">Login</a>
						</div>
					</div>

					<div class="main-nav-wrapper">
						<button data-toggle="modal" data-target="#search-modal" class="search-trigger order-1 order-lg-3" title="search">
							<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 22 22">
								<defs>
									<style>
										.search-icon {
											fill: #fff;
											fill-rule: evenodd;
										}
									</style>
								</defs>
								<path class="search-icon" d="M1524.33,60v1.151a7.183,7.183,0,1,1-2.69.523,7.213,7.213,0,0,1,2.69-.523V60m0,0a8.333,8.333,0,1,0,7.72,5.217A8.323,8.323,0,0,0,1524.33,60h0Zm6.25,13.772-0.82.813,7.25,7.254a0.583,0.583,0,0,0,.82,0,0.583,0.583,0,0,0,0-.812l-7.25-7.254h0Zm-0.69-7.684,0.01,0c0-.006-0.01-0.012-0.01-0.018s-0.01-.015-0.01-0.024a6,6,0,0,0-7.75-3.3l-0.03.009-0.02.006v0a0.6,0.6,0,0,0-.29.293,0.585,0.585,0,0,0,.31.756,0.566,0.566,0,0,0,.41.01V63.83a4.858,4.858,0,0,1,6.32,2.688l0.01,0a0.559,0.559,0,0,0,.29.29,0.57,0.57,0,0,0,.75-0.305A0.534,0.534,0,0,0,1529.89,66.089Z" transform="translate(-1516 -60)"/>
							</svg>
							Search</button>
						<a href="#" class="account-mobile order-2 d-lg-none" title="My Account">
							<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 37 41">
								<defs>
									<style>
										.account-icon {
											fill: #212121;
											fill-rule: evenodd;
										}
									</style>
								</defs>
								<path id="Account" class="account-icon" d="M614.5,107.1a11.549,11.549,0,1,0-11.459-11.549A11.516,11.516,0,0,0,614.5,107.1Zm0-21.288a9.739,9.739,0,1,1-9.664,9.739A9.711,9.711,0,0,1,614.5,85.81Zm9.621,23.452H604.874a8.927,8.927,0,0,0-8.881,8.949V125h37v-6.785A8.925,8.925,0,0,0,624.118,109.262Zm7.084,13.924H597.789v-4.975a7.12,7.12,0,0,1,7.085-7.139h19.244a7.119,7.119,0,0,1,7.084,7.139v4.975Z" transform="translate(-596 -84)"/>
							</svg>
							Account</a>
						<a href="javascript:" class="navbar-toggler order-3 order-lg-2" type="button" data-toggle="offcanvas" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap' ); ?>">
							<span class="navbar-toggler-icon"></span>
						</a>

						<?php
						$menu_location = strtolower( preg_replace( '/(\W)+/', '-', get_experience_group( false ) ) );

						if ( ! $menu_location || 'null' === $menu_location ) {
							$menu_location = 'primary';
						}
						?>

						<!-- The WordPress Menu goes here -->
						<?php
						wp_nav_menu(
							array(
								'theme_location'  => $menu_location,
								'container_class' => 'collapse navbar-collapse offcanvas-collapse',
								'container_id'    => 'navbarNavDropdown',
								'menu_class'      => 'navbar-nav ml-auto',
								'fallback_cb'     => '',
								'menu_id'         => 'main-menu',
								'depth'           => 2,
								'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
							)
						);
						?>

					</div>

				</div>
				<?php if ( 'container' === $container ) : ?>
			</div><!-- .container -->
		<?php endif; ?>

		</nav><!-- .site-navigation -->

	</div><!-- #wrapper-navbar end -->
