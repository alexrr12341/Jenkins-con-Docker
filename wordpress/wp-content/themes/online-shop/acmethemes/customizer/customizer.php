<?php
/**
 * Online Shop Theme Customizer.
 *
 * @since Online Shop 1.0.0
 * @package Acme Themes
 * @subpackage Online Shop
 */

/*
* file for upgrade to pro
*/
require_once online_shop_file_directory('acmethemes/customizer/customizer-pro/class-customize.php');

/*
* file for customizer core functions
*/
require_once online_shop_file_directory('acmethemes/customizer/customizer-core.php');

/*
* file for customizer sanitization functions
*/
require_once online_shop_file_directory('acmethemes/customizer/sanitize-functions.php');

/**
 * Adding different options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function online_shop_customize_register( $wp_customize ) {

    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

    /*saved options*/
    $options  = online_shop_get_theme_options();

    /*defaults options*/
    $defaults = online_shop_get_default_theme_options();

    /*
    * file for customizer custom controls classes
    */
    require_once online_shop_file_directory('acmethemes/customizer/custom-controls.php');
	require_once online_shop_file_directory('acmethemes/customizer/customizer-repeater/customizer-control-repeater.php');

    /*
     * file for feature panel of home page
     */
	require_once online_shop_file_directory('acmethemes/customizer/feature-section/feature-panel.php');

	/*
	* file for header top options
	*/
	require_once online_shop_file_directory('acmethemes/customizer/header-top/header-top-panel.php');

    /*
    * file for header panel
    */
	require_once online_shop_file_directory('acmethemes/customizer/header-options/header-panel.php');

	/*
    * file for menu panel
    */
	require_once online_shop_file_directory('acmethemes/customizer/menu-options/menu-panel.php');

    /*
    * file for customizer footer section
    */
	require_once online_shop_file_directory('acmethemes/customizer/footer-section/footer-section.php');

    /*
    * file for design/layout panel
    */
	require_once online_shop_file_directory('acmethemes/customizer/design-options/design-panel.php');

    /*
    * file for single post sections
    */
	require_once online_shop_file_directory('acmethemes/customizer/single-posts/single-post-section.php');

    /*
     * file for options panel
     */
	require_once online_shop_file_directory('acmethemes/customizer/options/options-panel.php');

    /*
  * file for options reset
  */
	require_once online_shop_file_directory('acmethemes/customizer/options/options-reset.php');

	/*woocommerce options*/
	if ( online_shop_is_woocommerce_active() ) :
		require_once online_shop_file_directory('acmethemes/customizer/wc-options/wc-panel.php');
	endif;

	/*sorting core and widget for ease of theme use*/
	$wp_customize->get_section( 'static_front_page' )->priority = 10;

	$online_shop_home_section = $wp_customize->get_section( 'sidebar-widgets-online-shop-home' );
	if ( ! empty( $online_shop_home_section ) ) {
		$online_shop_home_section->panel = '';
		$online_shop_home_section->title = esc_html__( 'Home Main Content Area ', 'online-shop' );
		$online_shop_home_section->priority = 80;
	}
	$online_shop_before_feature = $wp_customize->get_section( 'sidebar-widgets-online-shop-before-feature' );
	if ( ! empty( $online_shop_before_feature ) ) {
		$online_shop_before_feature->panel = 'online-shop-feature-panel';
		$online_shop_before_feature->title = esc_html__( 'Before Feature ', 'online-shop' );
		$online_shop_before_feature->priority = 80;
	}
	$online_shop_before_feature = $wp_customize->get_section( 'sidebar-widgets-popup-widget-area' );
	if ( ! empty( $online_shop_before_feature ) ) {
		$online_shop_before_feature->panel = 'online-shop-header-top-panel';
		$online_shop_before_feature->title = esc_html__( 'Popup Widget Area ', 'online-shop' );
		$online_shop_before_feature->priority = 80;
	}
	/*sidebar-widgets-online-shop-header done in respected file*/
}
add_action( 'customize_register', 'online_shop_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function online_shop_customize_preview_js() {
    wp_enqueue_script( 'online-shop-customizer', get_template_directory_uri() . '/acmethemes/core/js/customizer.js', array( 'customize-preview' ), '1.0.0', true );
}
add_action( 'customize_preview_init', 'online_shop_customize_preview_js' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function online_shop_customize_controls_scripts() {
	/*Font-Awesome-master*/
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/library/Font-Awesome/css/font-awesome.min.css', array(), '4.7.0' );

	wp_enqueue_script( 'online-shop-customizer-controls', get_template_directory_uri() . '/acmethemes/core/js/customizer-controls.js', array( 'customize-preview' ), '1.1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'online_shop_customize_controls_scripts' );