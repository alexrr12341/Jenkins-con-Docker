<?php
/*adding sections for header news options*/
$online_shop_header_image = $wp_customize->get_section( 'header_image' );
$online_shop_header_image->panel = 'online-shop-header-panel';
$online_shop_header_image->priority = 60;

/*header media position options*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-header-media-position]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-header-media-position'],
	'sanitize_callback' => 'online_shop_sanitize_select'
) );
$choices = online_shop_header_media_position();
$wp_customize->add_control( 'online_shop_theme_options[online-shop-header-media-position]', array(
	'choices'  	=> $choices,
	'label'		=> esc_html__( 'Header Media Position', 'online-shop' ),
	'section'   => 'header_image',
	'settings'  => 'online_shop_theme_options[online-shop-header-media-position]',
	'type'	  	=> 'radio'
) );

/*header ad img link*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-header-image-link]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-header-image-link'],
	'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( 'online_shop_theme_options[online-shop-header-image-link]', array(
	'label'		=> esc_html__( 'Header Image Link', 'online-shop' ),
	'description'=> esc_html__( 'Left empty for no link', 'online-shop' ),
	'section'   => 'header_image',
	'settings'  => 'online_shop_theme_options[online-shop-header-image-link]',
	'type'	  	=> 'url'
) );

/*header image in new tab*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-header-image-link-new-tab]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-header-image-link-new-tab'],
	'sanitize_callback' => 'online_shop_sanitize_checkbox',
) );
$wp_customize->add_control( 'online_shop_theme_options[online-shop-header-image-link-new-tab]', array(
	'label'		=> esc_html__( 'Check to Open New Tab Header Image Link', 'online-shop' ),
	'section'   => 'header_image',
	'settings'  => 'online_shop_theme_options[online-shop-header-image-link-new-tab]',
	'type'	  	=> 'checkbox'
) );