<?php
/*Menu Panel*/
$wp_customize->add_panel( 'online-shop-header-menu', array(
	'priority'       => 50,
	'capability'     => 'edit_theme_options',
	'title'          => esc_html__( 'Menu Options', 'online-shop' )
) );
/*
* Special Menu
*/
require_once online_shop_file_directory('acmethemes/customizer/menu-options/special-menu.php');

/*
* Sticky Menu
*/
require_once online_shop_file_directory('acmethemes/customizer/menu-options/sticky-menu.php');

/*
* Menu Right
*/
require_once online_shop_file_directory('acmethemes/customizer/menu-options/menu-right.php');