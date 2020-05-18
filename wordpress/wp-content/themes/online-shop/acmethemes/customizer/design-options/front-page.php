<?php
/*adding sections for front page */
$wp_customize->add_section( 'online-shop-front-page-options', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'title'          => esc_html__( 'Front Page Options', 'online-shop' ),
    'panel'          => 'online-shop-design-panel'
) );

/*Show Hide Front Page Content*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-hide-front-page-content]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['online-shop-hide-front-page-content'],
    'sanitize_callback' => 'online_shop_sanitize_checkbox'
) );

$wp_customize->add_control( 'online_shop_theme_options[online-shop-hide-front-page-content]', array(
    'label'		=> esc_html__( 'Hide Blog Posts or Static Page on Front Page', 'online-shop' ),
    'section'   => 'online-shop-front-page-options',
    'settings'  => 'online_shop_theme_options[online-shop-hide-front-page-content]',
    'type'	  	=> 'checkbox'
) );