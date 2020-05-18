<?php
/*adding feature options panel*/
$wp_customize->add_panel( 'online-shop-feature-panel', array(
    'priority'      => 70,
    'capability'    => 'edit_theme_options',
    'title'         => esc_html__( 'Featured Section Options', 'online-shop' ),
    'description'	=> sprintf( esc_html__( 'Feature section will display on front/home page. Feature Section includes Feature Main Section, Feature Right Section and  Special Menu Feature Left  .%1$s Note : Please go to %2$s Homepage Settings %3$s, Select "A static page" then "Front page" and "Posts page" to enable it', 'online-shop' ), '<br />','<b><a class="at-customizer button button-primary" data-section="static_front_page"> ','</a></b>' ),
) );

/*
* file for feature left section
*/
require_once online_shop_file_directory('acmethemes/customizer/feature-section/feature-left-section.php');

/*
* file for feature right section
*/
require_once online_shop_file_directory('acmethemes/customizer/feature-section/feature-right-section.php');

/*
* file for special menu
*/
require_once online_shop_file_directory('acmethemes/customizer/feature-section/special-menu.php');