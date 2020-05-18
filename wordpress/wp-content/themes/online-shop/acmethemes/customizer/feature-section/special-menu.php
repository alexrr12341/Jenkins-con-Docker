<?php
/*check if feature enable*/
if ( !function_exists('online_shop_is_feature_section_enable') ) :
	function online_shop_is_feature_section_enable() {
		$online_shop_customizer_all_values = online_shop_get_theme_options();
		$online_shop_enable_special_menu = $online_shop_customizer_all_values['online-shop-enable-special-menu'];
		$online_shop_feature_content_options = $online_shop_customizer_all_values['online-shop-feature-content-options'];
		$online_shop_feature_right_content_options = $online_shop_customizer_all_values['online-shop-feature-right-content-options'];
		if( ('disable' != $online_shop_feature_content_options || 'disable' != $online_shop_feature_right_content_options ) &&
		    1 == $online_shop_enable_special_menu ){
			return true;
		}
		return false;
	}
endif;

/*adding sections for special menu*/
$wp_customize->add_section( 'online-shop-feature-special-menu', array(
	'capability'     => 'edit_theme_options',
	'title'          => esc_html__( 'Special Menu Feature Left', 'online-shop' ),
	'panel'          => 'online-shop-feature-panel',
	'active_callback'=> 'online_shop_is_feature_section_enable'
) );

/*enable-special-menu*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-feature-enable-special-menu]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-feature-enable-special-menu'],
	'sanitize_callback' => 'online_shop_sanitize_checkbox'
) );
$wp_customize->add_control( 'online_shop_theme_options[online-shop-feature-enable-special-menu]', array(
	'label'		    => esc_html__( 'Display Special Menu on Feature Left', 'online-shop' ),
	'section'       => 'online-shop-feature-special-menu',
	'settings'      => 'online_shop_theme_options[online-shop-feature-enable-special-menu]',
	'type'	  	    => 'checkbox'
) );