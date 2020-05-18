<?php
/*adding sections for footer options*/
$wp_customize->add_section( 'online-shop-footer-option', array(
    'priority'       => 80,
    'capability'     => 'edit_theme_options',
    'title'          => esc_html__( 'Footer Options', 'online-shop' )
) );

/*copyright*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-footer-copyright]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['online-shop-footer-copyright'],
    'sanitize_callback' => 'wp_kses_post'
) );
$wp_customize->add_control( 'online_shop_theme_options[online-shop-footer-copyright]', array(
    'label'		=> esc_html__( 'Copyright Text', 'online-shop' ),
    'section'   => 'online-shop-footer-option',
    'settings'  => 'online_shop_theme_options[online-shop-footer-copyright]',
    'type'	  	=> 'text'
) );

/*footer power by text enable-disable */
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-enable-footer-power-text]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-enable-footer-power-text'],
	'sanitize_callback' => 'online_shop_sanitize_checkbox'
) );
$wp_customize->add_control( 'online_shop_theme_options[online-shop-enable-footer-power-text]', array(
	'label'		=> esc_html__( ' Enable Theme Name And Powered By Text ', 'online-shop' ),
	'section'   => 'online-shop-footer-option',
	'settings'  => 'online_shop_theme_options[online-shop-enable-footer-power-text]',
	'type'	  	=> 'checkbox'
) );

/*footer info*/
$wp_customize->add_setting('online_shop_theme_options[online-shop-footer-info]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> '',
	'sanitize_callback' => 'esc_attr'
));
$description = sprintf( esc_html__( 'Add Footer Widgets from %1$s here%2$s', 'online-shop' ), '<a class="at-customizer button button-primary" data-panel="widgets" style="cursor: pointer">','</a>' );
$wp_customize->add_control(
	new Online_Shop_Customize_Message_Control(
		$wp_customize,
		'online_shop_theme_options[online-shop-footer-info]',
		array(
			'section'   => 'online-shop-footer-option',
			'description'    => $description,
			'settings'  => 'online_shop_theme_options[online-shop-footer-info]',
			'type'	  	=> 'message'
		)
	)
);