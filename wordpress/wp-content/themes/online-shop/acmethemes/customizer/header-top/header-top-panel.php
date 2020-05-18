<?php
/*adding header top options panel*/
$wp_customize->add_panel( 'online-shop-header-top-panel', array(
	'priority'       => 11,
	'capability'     => 'edit_theme_options',
	'title'          => esc_html__( 'Header Top', 'online-shop' ),
) );
/*
* file for header top options
*/
require_once online_shop_file_directory('acmethemes/customizer/header-top/header-top.php');

/*
* file for basic info
*/
require_once online_shop_file_directory('acmethemes/customizer/header-top/basic-info.php');