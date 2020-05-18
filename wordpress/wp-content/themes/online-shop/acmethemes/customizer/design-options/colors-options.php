<?php
/*customizing default colors section and adding new controls-setting too*/
$wp_customize->add_section( 'colors', array(
    'priority'       => 40,
    'capability'     => 'edit_theme_options',
    'title'          => esc_html__( 'Colors', 'online-shop' ),
    'panel'          => 'online-shop-design-panel'
) );

/*Primary color*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-primary-color]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['online-shop-primary-color'],
    'sanitize_callback' => 'sanitize_hex_color'
) );

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'online_shop_theme_options[online-shop-primary-color]',
		array(
			'label'		=> esc_html__( 'Primary Color', 'online-shop' ),
			'section'   => 'colors',
			'settings'  => 'online_shop_theme_options[online-shop-primary-color]',
			'type'	  	=> 'color'
		)
	)
);