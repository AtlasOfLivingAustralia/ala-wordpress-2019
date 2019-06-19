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
					<h3>Subscribe to receive the latest news & updates</h3>
					<?php echo do_shortcode('[gravityform id=2 title=false description=false ajax=true]'); ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<div class="footer-top">
		<div class="<?php echo esc_attr( $container ); ?>">
			<div class="row align-items-center">
				<div class="col-md-12 col-lg-4 align-center logo-column">
					<?php echo wp_get_attachment_image( $custom_logo_id, 'full', false, $custom_logo_attr ); ?>
					<div class="account">
						<?php if (is_user_logged_in() ) { ?>
							<a href="https://auth.ala.org.au/userdetails/myprofile/" class="btn btn-outline-white btn-sm">Profile</a>
							<a href="<?php echo wp_logout_url(); ?>" class="btn btn-primary btn-sm">Logout</a>
						<?php } else { ?>
							<a href="https://auth.ala.org.au/userdetails/registration/createAccount" class="btn btn-outline-white btn-sm">Sign Up</a>
							<a href="<?php echo wp_login_url(); ?>" class="btn btn-primary btn-sm">Login</a>
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
							<img src="<?php echo esc_html( $image_col_1['sizes']['medium'] ); ?>" alt="<?php echo esc_html( $image_col_1['alt'] ); ?>" />
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
				<div class="col-md-4 col-lg-6">
					<!-- The WordPress Menu goes here -->
					<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'footer-1',
							'container_class' => 'footer-menu',
							'menu_class'      => 'menu menu-2-col',
							'fallback_cb'     => '',
							'depth'           => 2,
							'walker'          => new pvtl_title_attr_walker(),
						)
					);
					?>
				</div><!--col end -->
				<div class="col-md-4 col-lg-3">
					<!-- The WordPress Menu goes here -->
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
				</div><!--col end -->
				<div class="col-md-4 col-lg-3">
					<!-- The WordPress Menu goes here -->
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
				</div><!--col end -->
				<div class="col-md-4 col-lg-6">
					<!-- The WordPress Menu goes here -->
					<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'footer-5',
							'container_class' => 'footer-menu',
							'menu_class'      => 'menu menu-2-col',
							'fallback_cb'     => '',
							'depth'           => 2,
							'walker'          => new pvtl_title_attr_walker(),
						)
					);
					?>
				</div><!--col end -->
				<div class="col-md-4 col-lg-3">
					<!-- The WordPress Menu goes here -->
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
				</div><!--col end -->
				<div class="col-md-12">
					<!-- The WordPress Menu goes here -->
					<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'footer-4',
							'container_class' => 'footer-menu-horizontal',
							'menu_class'      => 'menu horizontal',
							'fallback_cb'     => '',
							'depth'           => 2,
							'walker'          => new pvtl_title_attr_walker(),
						)
					);
					?>
				</div><!--col end -->
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
						This work is licensed under a <a href="https://creativecommons.org/licenses/by/3.0/au/">Creative Commons Attribution 3.0 Australia License</a> <a rel="license" href="http://creativecommons.org/licenses/by/3.0/au/"><img alt="Creative Commons License" style="border-width:0" src="https://www.ala.org.au/wp-content/themes/ala-wordpress-theme/img/cc-by.png"></a>
					</p>
				</div><!--col end -->
				<div class="col-md-12 col-lg-5 text-lg-right">
					<ul class="menu horizontal">
						<li><a title="copyright" href="/copyright">Copyright</a></li>
						<li><a title="Terms of Use" href="/terms">Terms of Use</a></li>
						<li><a title="System Status" href="/status">System Status</a></li>
					</ul>
				</div><!--col end -->
			</div><!-- row end -->
		</div><!-- container end -->
	</div>

</footer><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

<script type="text/javascript" src="https://s3.amazonaws.com/assets.freshdesk.com/widget/freshwidget.js"></script>
<script type="text/javascript">
FreshWidget.init("", {"queryString": "&widgetType=popup&helpdesk_ticket[group_id]=6000207804&helpdesk_ticket[product_id]=6000005589&formTitle=Report+an+issue+or+ask+for+help", "utf8": "✓", "widgetType": "popup", "buttonType": "text", "buttonText": "Get in touch", "buttonColor": "white", "buttonBg": "#d5502a", "alignment": "2", "offset": "197px", "formHeight": "500px", "url": "https://support.ala.org.au"} );
</script>

</body>

</html>

