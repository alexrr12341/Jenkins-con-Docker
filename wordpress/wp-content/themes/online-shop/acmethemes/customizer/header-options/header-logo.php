<?php
/*Site Logo*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-display-site-logo]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-display-site-logo'],
	'sanitize_callback' => 'online_shop_sanitize_checkbox'
) );
$wp_customize->add_control( 'online_shop_theme_options[online-shop-display-site-logo]', array(
	'label'		=> esc_html__( 'Display Logo', 'online-shop' ),
	'section'   => 'title_tagline',
	'settings'  => 'online_shop_theme_options[online-shop-display-site-logo]',
	'type'	  	=> 'checkbox'
) );

/*Site Title*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-display-site-title]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-display-site-title'],
	'sanitize_callback' => 'online_shop_sanitize_checkbox'
) );
$wp_customize->add_control( 'online_shop_theme_options[online-shop-display-site-title]', array(
	'label'		=> esc_html__( 'Display Site Title', 'online-shop' ),
	'section'   => 'title_tagline',
	'settings'  => 'online_shop_theme_options[online-shop-display-site-title]',
	'type'	  	=> 'checkbox'
) );

/*Site Tagline*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-display-site-tagline]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-display-site-tagline'],
	'sanitize_callback' => 'online_shop_sanitize_checkbox'
) );
$wp_customize->add_control( 'online_shop_theme_options[online-shop-display-site-tagline]', array(
	'label'		=> esc_html__( 'Display Site Tagline', 'online-shop' ),
	'section'   => 'title_tagline',
	'settings'  => 'online_shop_theme_options[online-shop-display-site-tagline]',
	'type'	  	=> 'checkbox'
) );