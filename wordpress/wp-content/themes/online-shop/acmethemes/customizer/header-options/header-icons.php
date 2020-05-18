<?php
/*adding sections for header options*/
$wp_customize->add_section( 'online-shop-header-icons', array(
	'priority'       => 40,
	'capability'     => 'edit_theme_options',
	'title'          => esc_html__( 'Header Icons', 'online-shop' ),
	'panel'          => 'online-shop-header-panel'
) );

/*header icons*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-enable-cart-icon]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-enable-cart-icon'],
	'sanitize_callback' => 'online_shop_sanitize_checkbox',
) );
$wp_customize->add_control( 'online_shop_theme_options[online-shop-enable-cart-icon]', array(
	'label'		=> esc_html__( 'Enable Cart', 'online-shop' ),
	'section'   => 'online-shop-header-icons',
	'settings'  => 'online_shop_theme_options[online-shop-enable-cart-icon]',
	'type'	  	=> 'checkbox'
) );

if ( class_exists( 'YITH_WCWL' ) ){
	$wp_customize->add_setting( 'online_shop_theme_options[online-shop-enable-wishlist-icon]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['online-shop-enable-wishlist-icon'],
		'sanitize_callback' => 'online_shop_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'online_shop_theme_options[online-shop-enable-wishlist-icon]', array(
		'label'		=> esc_html__( 'Enable Wishlist', 'online-shop' ),
		'section'   => 'online-shop-header-icons',
		'settings'  => 'online_shop_theme_options[online-shop-enable-wishlist-icon]',
		'type'	  	=> 'checkbox'
	) );
}