<?php
/*adding sections for breadcrumb */
$wp_customize->add_section( 'online-shop-breadcrumb-options', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'title'          => esc_html__( 'Breadcrumb Options', 'online-shop' ),
    'panel'          => 'online-shop-options'
) );

/*Breadcrumb Options*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-breadcrumb-options]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-breadcrumb-options'],
	'sanitize_callback' => 'online_shop_sanitize_select'
) );

$choices = online_shop_breadcrumbs_options();
$wp_customize->add_control( 'online_shop_theme_options[online-shop-breadcrumb-options]', array(
	'choices'  	=> $choices,
	'label'		=> esc_html__( 'Breadcrumb Options', 'online-shop' ),
	'section'   => 'online-shop-breadcrumb-options',
	'settings'  => 'online_shop_theme_options[online-shop-breadcrumb-options]',
	'type'	  	=> 'select'
) );