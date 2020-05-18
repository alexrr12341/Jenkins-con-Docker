<?php
/*check if post*/
if ( !function_exists('online_shop_is_special_menu_feature_left') ) :
	function online_shop_is_special_menu_feature_left() {
		$online_shop_customizer_all_values = online_shop_get_theme_options();
		if( 1 == $online_shop_customizer_all_values['online-shop-feature-enable-special-menu'] ){
			return true;
		}
		return false;
	}
endif;

/*Sticky  Menu Section*/
$wp_customize->add_section( 'online-shop-sticky-menu', array(
	'priority'       => 50,
	'capability'     => 'edit_theme_options',
	'title'          => esc_html__( 'Sticky Menu Options', 'online-shop' ),
	'panel'          => 'online-shop-header-menu',
) );

/*sticky menu*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-enable-sticky-menu]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-enable-sticky-menu'],
	'sanitize_callback' => 'online_shop_sanitize_checkbox'
) );
$wp_customize->add_control( 'online_shop_theme_options[online-shop-enable-sticky-menu]', array(
	'label'		=> esc_html__( 'Enable Sticky Menu', 'online-shop' ),
	'section'   => 'online-shop-sticky-menu',
	'settings'  => 'online_shop_theme_options[online-shop-enable-sticky-menu]',
	'type'	  	=> 'checkbox'
) );

$wp_customize->add_setting('online_shop_theme_options[online-shop-sticky-menu-message]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> '',
	'sanitize_callback' => 'esc_attr'
));

$wp_customize->add_control(
	new Online_Shop_Customize_Message_Control(
		$wp_customize,
		'online_shop_theme_options[online-shop-sticky-menu-message]',
		array(
			'section'   => 'online-shop-sticky-menu',
			'description'=> sprintf( esc_html__( 'Stick Menu wont work, if you Display Special Menu on Feature Left.%1$s Note : Please go to %2$s "Special Menu Feature Left"%3$s and uncheck( disable ) it', 'online-shop' ), '<br />','<b><a class="at-customizer" data-section="online-shop-feature-special-menu"> ','</a></b>' ),
			'settings'  => 'online_shop_theme_options[online-shop-sticky-menu-message]',
			'type'	  	=> 'message',
			'active_callback'   => 'online_shop_is_special_menu_feature_left'
		)
	)
);