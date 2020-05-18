<?php
/*adding sections for Single post options*/
$wp_customize->add_section( 'online-shop-single-post', array(
    'priority'       => 90,
    'capability'     => 'edit_theme_options',
    'title'          => esc_html__( 'Single Post Options', 'online-shop' )
) );

/*single image size*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-single-img-size]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['online-shop-single-img-size'],
    'sanitize_callback' => 'online_shop_sanitize_select'
) );
$choices = online_shop_get_image_sizes_options(1);
$wp_customize->add_control( 'online_shop_theme_options[online-shop-single-img-size]', array(
    'choices'  	=> $choices,
    'label'		=> esc_html__( 'Image Size', 'online-shop' ),
    'section'   => 'online-shop-single-post',
    'settings'  => 'online_shop_theme_options[online-shop-single-img-size]',
    'type'	  	=> 'select'
) );

/*show related posts*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-show-related]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['online-shop-show-related'],
    'sanitize_callback' => 'online_shop_sanitize_checkbox'
) );
$wp_customize->add_control( 'online_shop_theme_options[online-shop-show-related]', array(
    'label'		=> esc_html__( 'Show Related Posts In Single Post', 'online-shop' ),
    'section'   => 'online-shop-single-post',
    'settings'  => 'online_shop_theme_options[online-shop-show-related]',
    'type'	  	=> 'checkbox'
) );

/*Related title*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-related-title]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-related-title'],
	'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'online_shop_theme_options[online-shop-related-title]', array(
	'label'		=> esc_html__( 'Related Posts title', 'online-shop' ),
	'section'   => 'online-shop-single-post',
	'settings'  => 'online_shop_theme_options[online-shop-related-title]',
	'type'	  	=> 'text'
) );

/*related post by tag or category*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-related-post-display-from]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-related-post-display-from'],
	'sanitize_callback' => 'online_shop_sanitize_select'
) );
$choices = online_shop_related_post_display_from();
$wp_customize->add_control( 'online_shop_theme_options[online-shop-related-post-display-from]', array(
	'choices'  	=> $choices,
	'label'		=> esc_html__( 'Related Post Display From Options', 'online-shop' ),
	'section'   => 'online-shop-single-post',
	'settings'  => 'online_shop_theme_options[online-shop-related-post-display-from]',
	'type'	  	=> 'select'
) );