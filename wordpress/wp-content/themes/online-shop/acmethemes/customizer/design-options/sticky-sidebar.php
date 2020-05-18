<?php
/*adding sections for sidebar options */
$wp_customize->add_section( 'online-shop-design-sidebar-sticky-option', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'title'          => esc_html__( 'Sticky Sidebar Option', 'online-shop' ),
    'panel'          => 'online-shop-design-panel'
) );

/*sticky sidebar enable disable*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-enable-sticky-sidebar]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['online-shop-enable-sticky-sidebar'],
    'sanitize_callback' => 'online_shop_sanitize_checkbox'
) );
$wp_customize->add_control( 'online_shop_theme_options[online-shop-enable-sticky-sidebar]', array(
    'label'		=> esc_html__( 'Enable Sticky Sidebar', 'online-shop' ),
    'section'   => 'online-shop-design-sidebar-sticky-option',
    'settings'  => 'online_shop_theme_options[online-shop-enable-sticky-sidebar]',
    'type'	  	=> 'checkbox'
) );