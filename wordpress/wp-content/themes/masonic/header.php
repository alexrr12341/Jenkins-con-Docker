<?php
/**
 * Theme Header Section for our theme.
 *
 * Displays all of the <head> section and everything up till </header>
 *
 * @package    ThemeGrill
 * @subpackage Masonic
 * @since      1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
}
?>

<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#container"><?php _e( 'Skip to content', 'masonic' ); ?></a>

	<header id="masthead" class="site-header clear">

		<div class="header-image">
			<?php if ( function_exists( 'the_custom_header_markup' ) ) {
				do_action( 'masonic_header_image_markup_render' );
				the_custom_header_markup();
			} else {
				if ( get_header_image() ) : ?>
					<figure>
						<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
						<div class="angled-background"></div>
					</figure>
				<?php endif; // End header image check.
			} ?>
		</div> <!-- .header-image -->

		<div class="site-branding clear">
			<div class="wrapper site-header-text clear">

				<div class="logo-img-holder ">

					<?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo( $blog_id = 0 ) ) {
						masonic_the_custom_logo();
					} ?>
				</div>

				<div class="main-header">
					<?php if ( is_front_page() || is_home() ) : ?>
						<h1 class="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
						</h1>
					<?php else : ?>
						<h3 class="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
						</h3>
					<?php endif; ?>
					<?php
					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $description; ?></p>
					<?php endif; ?>
				</div>
			</div>
		</div><!-- .site-branding -->

		<nav class="navigation clear" id="site-navigation">
			<input type="checkbox" id="masonic-toggle" name="masonic-toggle" />
			<label for="masonic-toggle" id="masonic-toggle-label" class="fa fa-navicon fa-2x"></label>
			<div class="wrapper clear" id="masonic">
				<?php
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'items_wrap'     => '<ul id="%1$s" class="%2$s nav-menu wrapper clear">%3$s</ul>',
						'container'      => '',
					) );
				} else {
					wp_page_menu( array(
						'show_home'  => true,
						'menu_class' => '',
					) );
				}
				?>
				<?php if ( get_theme_mod( 'masonic_search_icon_display', 1 ) != 0 ) { ?>
					<div id="sb-search" class="sb-search">
						<span class="sb-icon-search"><i class="fa fa-search"></i></span>
					</div>
				<?php } ?>
			</div>
			<?php if ( get_theme_mod( 'masonic_search_icon_display', 1 ) != 0 ) { ?>
				<div id="sb-search-res" class="sb-search-res">
					<span class="sb-icon-search"><i class="fa fa-search"></i></span>
				</div>
			<?php } ?>
		</nav><!-- #site-navigation -->

		<div class="inner-wrap masonic-search-toggle">
			<?php get_search_form(); ?>
		</div>

		<?php if ( ! is_front_page() ) { ?>
			<div class="blog-header clear">
				<article class="wrapper">
					<div class="blog-site-title">
						<?php
						if ( '' != masonic_header_title() ) {
							?>
							<?php if ( is_home() ) : ?>
								<h2><?php echo masonic_header_title(); ?></h2>
							<?php else : ?>
								<h1><?php echo masonic_header_title(); ?></h1>
							<?php endif; ?>
						<?php } ?>
					</div>

					<?php if ( function_exists( 'bcn_display' ) ) { ?>
						<div class="breadcrums" xmlns:v="http://rdf.data-vocabulary.org/#">
							<?php bcn_display(); ?>
						</div>
					<?php } ?>

				</article>
			</div>
		<?php } ?>
	</header><!-- #masthead -->
