<?php
/*adding header options panel*/
$wp_customize->add_panel( 'online-shop-header-panel', array(
    'priority'       => 30,
    'capability'     => 'edit_theme_options',
    'title'          => esc_html__( 'Header Main', 'online-shop' ),
    'description'    => esc_html__( 'Customize your awesome site header', 'online-shop' )
) );

/*
* file for header logo options
*/
require_once online_shop_file_directory('acmethemes/customizer/header-options/header-logo.php');

/*
* file for site identity options
*/
require_once online_shop_file_directory('acmethemes/customizer/header-options/site-identity-placement.php');

/*
* file for header media display option
*/
require_once online_shop_file_directory('acmethemes/customizer/header-options/header-media.php');

/*
* file for header main
*/
require_once online_shop_file_directory('acmethemes/customizer/header-options/header-main.php');

/*
* file for header icons
*/
if( online_shop_is_woocommerce_active() ){
	require_once online_shop_file_directory('acmethemes/customizer/header-options/header-icons.php');
}