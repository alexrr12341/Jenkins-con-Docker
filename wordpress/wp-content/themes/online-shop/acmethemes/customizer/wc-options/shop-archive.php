<?php
/*adding sections for sidebar options */
$wp_customize->add_section( 'online-shop-wc-shop-archive-option', array(
	'priority'       => 20,
	'capability'     => 'edit_theme_options',
	'title'          => esc_html__( 'Shop Archive Sidebar Layout', 'online-shop' ),
	'panel'          => 'online-shop-wc-panel'
) );

/*Sidebar Layout*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-wc-shop-archive-sidebar-layout]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-wc-shop-archive-sidebar-layout'],
	'sanitize_callback' => 'online_shop_sanitize_select'
) );
$choices = online_shop_sidebar_layout();
$wp_customize->add_control( 'online_shop_theme_options[online-shop-wc-shop-archive-sidebar-layout]', array(
	'choices'  	=> $choices,
	'label'		=> esc_html__( 'Shop Archive Sidebar Layout', 'online-shop' ),
	'section'   => 'online-shop-wc-shop-archive-option',
	'settings'  => 'online_shop_theme_options[online-shop-wc-shop-archive-sidebar-layout]',
	'type'	  	=> 'select'
) );

/*wc-product-column-number*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-wc-product-column-number]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-wc-product-column-number'],
	'sanitize_callback' => 'absint'
) );
$wp_customize->add_control( 'online_shop_theme_options[online-shop-wc-product-column-number]', array(
	'label'		=> esc_html__( 'Products Per Row', 'online-shop' ),
	'section'   => 'online-shop-wc-shop-archive-option',
	'settings'  => 'online_shop_theme_options[online-shop-wc-product-column-number]',
	'type'	  	=> 'number'
) );

/*wc-shop-archive-total-product*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-wc-shop-archive-total-product]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-wc-shop-archive-total-product'],
	'sanitize_callback' => 'absint'
) );
$wp_customize->add_control( 'online_shop_theme_options[online-shop-wc-shop-archive-total-product]', array(
	'label'		=> esc_html__( 'Total Products Per Page', 'online-shop' ),
	'section'   => 'online-shop-wc-shop-archive-option',
	'settings'  => 'online_shop_theme_options[online-shop-wc-shop-archive-total-product]',
	'type'	  	=> 'number'
) );