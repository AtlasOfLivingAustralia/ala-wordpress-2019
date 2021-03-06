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
$header_search_toggled = true;
if ( get_field( 'search_bar_in_header', 'option' ) && get_field( 'search_bar_in_header', 'option' ) == 'visible') $header_search_toggled = false;
$auth_buttons_display = 'visible';
if ( get_field( 'auth_buttons_display', 'option' ) ) {
	if ( get_field( 'auth_buttons_display', 'option' ) == 'hidden' ) $auth_buttons_display = 'hidden';
	if ( get_field( 'auth_buttons_display', 'option' ) == 'profile' ) $auth_buttons_display = 'profile';
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="id" content="<?php the_ID(); ?>">
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
					<?php if ( $auth_buttons_display != 'hidden' || !$header_search_toggled ) { ?>
			<?php if (!$header_search_toggled ) { ?>
						<div class="top-bar d-flex header-search-visible auth-buttons-<?php echo $auth_buttons_display ?>">
			<?php } else { ?>
						<div class="top-bar d-flex header-search-toggled auth-buttons-<?php echo $auth_buttons_display ?>">
			<?php } ?>
						<?php if (false) {
							// commenting out user groups for now
						?>
						<?php if ( $xp = get_experience_group() ) { ?>
							<button type="button" data-toggle="modal" data-target="#experience-modal" class="btn btn-link btn-sm xp-btn">
								<?php echo 'null' === $xp ? 'Customise Your Experience' : esc_html( 'Viewing as ' . $xp ); ?> <i class="far fa-angle-down ml-1"></i>
							</button>
						<?php } else { ?>
							<button style="display: none;" type="button" data-toggle="modal" data-target="#experience-modal" class="btn btn-link btn-sm xp-btn">
								Which group do you associate with? <i class="far fa-angle-down ml-1"></i>
							</button>
						<?php } ?>
					<?php } // end commenting out user groups ?>

	    <?php if (!$header_search_toggled ) { ?>
		<div id="autocompleteSearchALA" class="d-none d-lg-block">
			<div class="container">
		        <form class="form-inline" method="get" action="https://bie.ala.org.au/search" >
                    <div class="form-group flex-grow-1">
                        <label for="search" class="sr-only">Search species and more</label>
                        <input type="search" name="q" class="form-control flex-grow-1 autocompleteHome" id="search" placeholder="Search species and more..." autocomplete="off">
                    </div>
                    <button type="submit" class="btn btn-primary-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22">
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
                        Search
                    </button>
                </form>
		    </div>
	    </div>
	    <?php } else { ?>

						<a href="/contact-us" class="btn btn-link btn-sm d-none d-lg-inline-block">Contact us</a>

		<?php } ?>
		<?php if ( $auth_buttons_display != 'hidden' ) { ?>
						<div class="account d-lg-block">
							<div class="ala-auth-buttons-logged-in d-none">
								<a href="<?php echo get_ala_auth_server(); ?>/userdetails/myprofile/" class="btn btn-outline-white btn-sm">Profile</a>
								<a href="<?php echo get_ala_auth_server(); ?>/cas/logout" class="btn btn-outline-white btn-sm">Logout</a>
							</div>
							<div class="ala-auth-buttons-logged-out">
								<a href="<?php echo get_ala_auth_server(); ?>/userdetails/registration/createAccount" class="btn btn-outline-white btn-sm">Sign up</a>
								<a href="<?php echo get_ala_auth_server(); ?>/cas/login?service=<?php echo get_home_url(); ?>/" class="btn btn-primary btn-sm">Login</a>
							</div>
						</div>
		<?php } ?>

					</div>
					<?php } // end if ( $auth_buttons_display != 'hidden' ) || !$header_search_toggled ?>

					<div class="main-nav-wrapper">
						<?php if ( $header_search_toggled ) { ?>
						<button data-toggle="collapse" data-target="#autocompleteSearchALA" id="headerSearchToggleButton" class="search-trigger hidden-xs hidden-sm collapsed collapse-trigger-button order-1 order-lg-3" title="search">
						<?php } else { ?>
						<button data-toggle="collapse" data-target="#autocompleteSearchALA" id="headerSearchToggleButton" class="search-trigger d-lg-none hidden-xs hidden-sm collapsed collapse-trigger-button order-1 order-lg-3" title="search">
						<?php } ?>
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
							<span class="collapse visible-on-show" aria-hidden="true">×</span>
							Search</button>
					<?php if ( $auth_buttons_display != 'hidden' ) { ?>
					<?php if ( $auth_buttons_display == 'visible' ) { ?>
					<div class="ala-auth-buttons-logged-in d-none">
						<a href="<?php echo get_ala_auth_server(); ?>/userdetails/myprofile/" class="account-mobile order-2 d-lg-none" title="My Account">
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
						<a href="<?php echo get_ala_auth_server(); ?>/cas/logout" class="account-mobile account-mobile-fa order-3 d-lg-none" title="Logout"><i class="fa fa-sign-out"></i></a>
					</div>
					<div class="ala-auth-buttons-logged-out">
						<a href="<?php echo get_ala_auth_server(); ?>/cas/login?service=<?php echo get_home_url(); ?>/" class="account-mobile account-mobile-fa order-3 d-lg-none" title="Login"><i class="fa fa-sign-in"></i></a>
					</div>
					<?php } else { ?>
						<a href="<?php echo get_ala_auth_server(); ?>/userdetails/myprofile/" class="account-mobile order-2 d-lg-none" title="My Account">
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
						<a href="<?php echo get_ala_auth_server(); ?>/cas/logout" class="account-mobile account-mobile-fa order-3 d-lg-none" title="Logout"><i class="fa fa-sign-out"></i></a>
					<?php } ?>
				<?php } ?>
						<a href="javascript:" class="navbar-toggler order-4 order-lg-2" type="button" data-toggle="offcanvas" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap' ); ?>">
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
	        </div>
		    <?php endif; ?>
		</nav><!-- .site-navigation -->
		<?php //if ( $header_search_toggled ) { ?>
	    <div id="autocompleteSearchALA" class="collapse">
	    	<div class="container">
		        <form method="get" action="https://bie.ala.org.au/search" class="search-form">
		            <div class="d-flex justify-content-between">
		                <input id="autocompleteHeader" type="text" name="q" placeholder="Search species, datasets, and more..." class="search-input autocompleteBIE" autocomplete="off"/>
		                <button class="search-submit" title="submit">
		                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 22 22">
		                        <defs>
		                            <style>
		                                .search-icon {
		                                    fill: #fff;
		                                    fill-rule: evenodd;
		                                }
		                            </style>
		                        </defs>
		                        <path class="search-icon"
		                              d="M1524.33,60v1.151a7.183,7.183,0,1,1-2.69.523,7.213,7.213,0,0,1,2.69-.523V60m0,0a8.333,8.333,0,1,0,7.72,5.217A8.323,8.323,0,0,0,1524.33,60h0Zm6.25,13.772-0.82.813,7.25,7.254a0.583,0.583,0,0,0,.82,0,0.583,0.583,0,0,0,0-.812l-7.25-7.254h0Zm-0.69-7.684,0.01,0c0-.006-0.01-0.012-0.01-0.018s-0.01-.015-0.01-0.024a6,6,0,0,0-7.75-3.3l-0.03.009-0.02.006v0a0.6,0.6,0,0,0-.29.293,0.585,0.585,0,0,0,.31.756,0.566,0.566,0,0,0,.41.01V63.83a4.858,4.858,0,0,1,6.32,2.688l0.01,0a0.559,0.559,0,0,0,.29.29,0.57,0.57,0,0,0,.75-0.305A0.534,0.534,0,0,0,1529.89,66.089Z"
		                              transform="translate(-1516 -60)"></path>
		                    </svg>
		                </button>
		            </div>
		        </form>
		    </div>
	    </div>
	    <?php //} ?>
	    	
        <?php if ( get_field( 'alert_display', 'option' ) ) : ?>
	    <div class="alert alert-ala fade show" role="alert">
    	    <div class="container">
    	    	<div class="row">
    	    		<div class="alert-ala-content">
                    <?php echo wp_kses_post( get_field( 'alert_text', 'option' ) ); ?>
	                </div>
        		</div>
    		</div>
		</div>
        <?php endif; ?>
	</div><!-- #wrapper-navbar end -->

