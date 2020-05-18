<?php
/*adding sections for sidebar options */
$wp_customize->add_section( 'online-shop-wc-single-product-options', array(
	'priority'       => 20,
	'capability'     => 'edit_theme_options',
	'title'          => esc_html__( 'Single Product', 'online-shop' ),
	'panel'          => 'online-shop-wc-panel'
) );

/*Sidebar Layout*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-wc-single-product-sidebar-layout]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-wc-single-product-sidebar-layout'],
	'sanitize_callback' => 'online_shop_sanitize_select'
) );
$choices = online_shop_sidebar_layout();
$wp_customize->add_control( 'online_shop_theme_options[online-shop-wc-single-product-sidebar-layout]', array(
	'choices'  	=> $choices,
	'label'		=> esc_html__( 'Single Product Sidebar Layout', 'online-shop' ),
	'section'   => 'online-shop-wc-single-product-options',
	'settings'  => 'online_shop_theme_options[online-shop-wc-single-product-sidebar-layout]',
	'type'	  	=> 'select'
) );