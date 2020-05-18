<?php
/*adding theme options panel*/
$wp_customize->add_panel( 'online-shop-options', array(
    'priority'       => 210,
    'capability'     => 'edit_theme_options',
    'title'          => esc_html__( 'Theme Options', 'online-shop' ),
    'description'    => esc_html__( 'Customize your awesome site with theme options ', 'online-shop' )
) );

/*
* file for social options
*/
require_once online_shop_file_directory('acmethemes/customizer/options/social-options.php');

/*
* file for header breadcrumb options
*/
require_once online_shop_file_directory('acmethemes/customizer/options/breadcrumb.php');

/*
* file for header search options
*/
require_once online_shop_file_directory('acmethemes/customizer/options/search.php');