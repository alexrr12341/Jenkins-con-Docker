<?php
/*Special Menu Section*/
$wp_customize->add_section( 'online-shop-special-menu', array(
	'priority'       => 50,
	'capability'     => 'edit_theme_options',
	'title'          => esc_html__( 'Special Menu Options', 'online-shop' ),
	'panel'          => 'online-shop-header-menu',
) );

/*special menu*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-enable-special-menu]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-enable-special-menu'],
	'sanitize_callback' => 'online_shop_sanitize_checkbox'
) );
$description = sprintf( esc_html__( 'This menu display vertically at the left side of Primary Menu. Add Special Menu from %1$s here%2$s ', 'online-shop' ), '<a class="at-customizer button button-primary" data-panel="nav_menus" style="cursor: pointer">','</a>' );
$wp_customize->add_control( 'online_shop_theme_options[online-shop-enable-special-menu]', array(
	'label'		=> esc_html__( 'Enable Special Menu', 'online-shop' ),
	'description'=> $description,
	'section'   => 'online-shop-special-menu',
	'settings'  => 'online_shop_theme_options[online-shop-enable-special-menu]',
	'type'	  	=> 'checkbox',
) );

/*Special Menu Text*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-special-menu-text]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-special-menu-text'],
	'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'online_shop_theme_options[online-shop-special-menu-text]', array(
	'label'		=> esc_html__( 'Special Menu Text', 'online-shop' ),
	'section'   => 'online-shop-special-menu',
	'settings'  => 'online_shop_theme_options[online-shop-special-menu-text]',
	'type'	  	=> 'text'
) );