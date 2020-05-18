<?php
/*adding sections for sidebar options */
$wp_customize->add_section( 'online-shop-design-sidebar-layout-option', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'title'          => esc_html__( 'Default Sidebar Layout', 'online-shop' ),
    'panel'          => 'online-shop-design-panel'
) );

/*Sidebar Layout*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-single-sidebar-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['online-shop-single-sidebar-layout'],
    'sanitize_callback' => 'online_shop_sanitize_select'
) );
$choices = online_shop_sidebar_layout();
$wp_customize->add_control( 'online_shop_theme_options[online-shop-single-sidebar-layout]', array(
    'choices'  	=> $choices,
    'label'		=> esc_html__( 'Default Sidebar Layout', 'online-shop' ),
    'section'   => 'online-shop-design-sidebar-layout-option',
    'settings'  => 'online_shop_theme_options[online-shop-single-sidebar-layout]',
    'type'	  	=> 'select'
) );