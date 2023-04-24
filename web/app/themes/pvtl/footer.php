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

$container        = get_theme_mod( 'understrap_container_type' );
$custom_logo_id   = get_theme_mod( 'custom_logo' );
$custom_logo_attr = array(
	'class'    => 'custom-logo',
	'itemprop' => 'logo',
);
$auth_buttons_display = 'visible';
if ( get_field( 'auth_buttons_display', 'option' ) ) {
	if ( get_field( 'auth_buttons_display', 'option' ) == 'hidden' ) $auth_buttons_display = 'hidden';
	if ( get_field( 'auth_buttons_display', 'option' ) == 'profile' ) $auth_buttons_display = 'profile';
}
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<footer class="site-footer" id="colophon">
	<?php
	/** Adds the call to action bar if it is set to yes in the page options. */
	$cta = get_field('add_call_to_action');
	if ($cta) : ?>
	<div class="footer-top-bar">
		<div class="<?php echo esc_attr( $container ); ?>">
			<div class="d-flex align-items-center justify-content-center flex-column flex-md-row">
				<h3><?= get_field( 'cta_title', 'option' ); ?></h3>
				<a href="<?= get_field( 'cta_button_link', 'option' ); ?>" class="btn btn-outline-white btn-lg"><?= get_field( 'cta_button_text', 'option' ); ?></a>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<?php
	/** Adds the subscribe bar if we are on the blog list or single page. */
	if (is_home() || is_single()) : ?>
		<div class="footer-top-bar footer-subscribe">
			<div class="<?php echo esc_attr( $container ); ?>">
				<div class="d-flex align-items-center justify-content-center flex-column flex-md-row">
					<h3>Want the latest ALA news & updates?</h3>
					<a href="https://alerts.ala.org.au/notification/myAlerts" class="btn btn-outline-white btn-lg">Get email alerts</a>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<div class="footer-top">
		<div class="<?php echo esc_attr( $container ); ?>">
			<div class="row align-items-center">
				<div class="col-md-12 col-lg-4 align-center logo-column">
					<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php echo wp_get_attachment_image( $custom_logo_id, 'full', false, $custom_logo_attr ); ?></a>
					<div class="account">
						<?php if ( $auth_buttons_display != 'hidden' ) { ?>
							<?php if ( $auth_buttons_display == 'visible' ) { ?>

						<div class="ala-auth-buttons-logged-in d-none">
							<a href="<?php echo get_ala_auth_server(); ?>/userdetails/myprofile/" class="btn btn-outline-white btn-sm">Profile</a>
							<a href="<?php echo get_ala_auth_server(); ?>/cas/logout" class="btn btn-primary btn-sm">Logout</a>
						</div>
						<div class="ala-auth-buttons-logged-out">
							<a href="<?php echo get_ala_auth_server(); ?>/userdetails/registration/createAccount" class="btn btn-outline-white btn-sm">Sign Up</a>
							<a href="<?php echo get_ala_auth_server(); ?>/cas/login?service=<?php echo get_home_url(); ?>/" class="btn btn-primary btn-sm">Login</a>
						</div>


						<?php } else { ?>
							<a href="https://auth.ala.org.au/userdetails/myprofile/" class="btn btn-outline-white btn-sm">Profile</a>
						<?php } ?>
						<?php } ?>
						<?php get_template_part( 'template-parts/social-icons' ); ?>
					</div>
				</div><!--col end -->
				<div class="col-md-6 col-lg-4 content-column">
					<?php
						$image_col_1   = get_field( 'col_1_image', 'option' );
						$content_col_1 = get_field( 'col_1_content', 'option' );
					?>
					<div class="d-flex">
						<div class="image">
							<img src="<?php echo esc_html( $image_col_1['sizes']['medium'] ); ?>" alt="<?php echo esc_html( $image_col_1['alt'] ); ?>" id="inat-logo" />
						</div>
						<div class="content">
							<?php echo wp_kses_post( $content_col_1 ); ?>
						</div>
					</div>
				</div><!--col end -->
				<div class="col-md-6 col-lg-4 content-column">
					<?php
						$image_col_2   = get_field( 'col_2_image', 'option' );
						$content_col_2 = get_field( 'col_2_content', 'option' );
					?>
					<div class="d-flex">
						<div class="image">
							<img src="<?php echo esc_html( $image_col_2['sizes']['medium'] ); ?>" alt="<?php echo esc_html( $image_col_2['alt'] ); ?>" />
						</div>
						<div class="content">
							<?php echo wp_kses_post( $content_col_2 ); ?>
						</div>
					</div>
				</div><!--col end -->
			</div><!-- row end -->
		</div><!-- container end -->
	</div>

	<div class="footer-middle">
		<div class="<?php echo esc_attr( $container ); ?>">
			<div class="row">
				<div class="col-md-6 col-lg-3">
					<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'footer-1',
							'container_class' => 'footer-menu',
							'menu_class'      => 'menu',
							'fallback_cb'     => '',
							'depth'           => 2,
							'walker'          => new pvtl_title_attr_walker(),
						)
					);
					?>
				</div><!--col end -->
				<div class="col-md-6 col-lg-3">
					<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'footer-2',
							'container_class' => 'footer-menu',
							'menu_class'      => 'menu',
							'fallback_cb'     => '',
							'depth'           => 2,
							'walker'          => new pvtl_title_attr_walker(),
						)
					);
					?>
				</div>
				<div class="col-md-6 col-lg-3">
					<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'footer-3',
							'container_class' => 'footer-menu',
							'menu_class'      => 'menu',
							'fallback_cb'     => '',
							'depth'           => 2,
							'walker'          => new pvtl_title_attr_walker(),
						)
					);
					?>
				</div>
				<div class="col-md-6 col-lg-3">
					<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'footer-4',
							'container_class' => 'footer-menu',
							'menu_class'      => 'menu',
							'fallback_cb'     => '',
							'depth'           => 2,
							'walker'          => new pvtl_title_attr_walker(),
						)
					);
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-lg-3">
					<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'footer-6',
							'container_class' => 'footer-menu',
							'menu_class'      => 'menu',
							'fallback_cb'     => '',
							'depth'           => 2,
							'walker'          => new pvtl_title_attr_walker(),
						)
					);
					?>
				</div>
				<div class="col-md-6 col-lg-3">
					<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'footer-7',
							'container_class' => 'footer-menu',
							'menu_class'      => 'menu',
							'fallback_cb'     => '',
							'depth'           => 2,
							'walker'          => new pvtl_title_attr_walker(),
						)
					);
					?>
				</div>
				<div class="col-md-6 col-lg-3">
					<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'footer-8',
							'container_class' => 'footer-menu',
							'menu_class'      => 'menu',
							'fallback_cb'     => '',
							'depth'           => 2,
							'walker'          => new pvtl_title_attr_walker(),
						)
					);
					?>
				</div>
				<div class="col-md-6 col-lg-3">
					<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'footer-9',
							'container_class' => 'footer-menu',
							'menu_class'      => 'menu',
							'fallback_cb'     => '',
							'depth'           => 2,
							'walker'          => new pvtl_title_attr_walker(),
						)
					);
					?>
				</div>
				<div class="col-md-12">
					<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'footer-5',
							'container_class' => 'footer-menu-horizontal',
							'menu_class'      => 'menu horizontal',
							'fallback_cb'     => '',
							'depth'           => 2,
							'walker'          => new pvtl_title_attr_walker(),
						)
					);
					?>
				</div>
			</div><!-- row end -->
		</div><!-- container end -->
	</div>

	<div class="footer-bottom">
		<div class="<?php echo esc_attr( $container ); ?>">
			<div class="row">
				<div class="col-md-6 content-column">
					<?php echo wp_kses_post( get_field( 'content_left', 'option' ) ); ?>
				</div><!--col end -->
				<div class="col-md-6 content-column">
					<?php echo wp_kses_post( get_field( 'content_right', 'option' ) ); ?>
				</div><!--col end -->
			</div><!-- row end -->
		</div><!-- container end -->
	</div>

	<div class="footer-copyright">
		<div class="<?php echo esc_attr( $container ); ?>">
			<div class="row">
				<div class="col-md-12 col-lg-7">
					<p class="alert-text text-creativecommons">
						This work is licensed under a <a href="https://creativecommons.org/licenses/by/3.0/au/">Creative Commons Attribution 3.0 Australia License</a> <a rel="license" href="http://creativecommons.org/licenses/by/3.0/au/"><img alt="Creative Commons License" style="border-width:0" src="/app/themes/pvtl/images/cc-by.png"></a>
					</p>
				</div><!--col end -->
				<div class="col-md-12 col-lg-5 text-lg-right">
					<ul class="menu horizontal">
						<li><a href="/terms-of-use#cy">Copyright</a></li>
						<li><a href="/terms-of-use">Terms of Use</a></li>
						<li><a href="https://status.ala.org.au/">System Status</a></li>
					</ul>
				</div><!--col end -->
			</div><!-- row end -->
		</div><!-- container end -->
	</div>

</footer><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>
<!-- Fathom analytics -->
<script src="https://cdn.usefathom.com/script.js" data-site="TZHQTOVF" defer></script>
<!-- End Fathom analytics -->
<!-- Clicky analytics -->
<a title="Privacy-friendly Web Analytics" href="https://clicky.com/101405752"><img alt="Clicky" src="//static.getclicky.com/media/links/badge.gif" border="0" /></a>
<script async data-id="101405752" src="//static.getclicky.com/js"></script>
<!-- End Clicky analytics -->
<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-STM6SLZYD7"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-STM6SLZYD7');
</script>
<script>
    window.ga = window.ga || function () {
        (ga.q = ga.q || []).push(arguments)
    };
    ga.l = +new Date;
    ga('create', 'UA-4355440-1', 'auto');
    ga('send', 'pageview');
</script>
<script async src='https://www.google-analytics.com/analytics.js'></script>
<!-- End Google Analytics -->

<script type="text/javascript" src="https://s3.amazonaws.com/assets.freshdesk.com/widget/freshwidget.js"></script>
<script type="text/javascript">
FreshWidget.init("", {"queryString": "&widgetType=popup&helpdesk_ticket[group_id]=6000207804&helpdesk_ticket[product_id]=6000005589&formTitle=Report+an+issue+or+ask+for+help", "utf8": "✓", "widgetType": "popup", "buttonType": "text", "buttonText": "Need help?", "buttonColor": "white", "buttonBg": "#d5502a", "alignment": "2", "offset": "220px", "formHeight": "500px", "url": "https://support.ala.org.au"} );
</script>

</body>

</html>

