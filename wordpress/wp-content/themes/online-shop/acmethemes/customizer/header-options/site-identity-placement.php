<?php
/*adding sections for site identity */
$wp_customize->add_section( 'online-shop-site-identity-placement', array(
    'priority'       => 45,
    'capability'     => 'edit_theme_options',
    'title'          => esc_html__( 'Header Placement', 'online-shop' ),
    'panel'          => 'online-shop-header-panel'
) );

/*header site identity position*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-header-logo-ads-display-position]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['online-shop-header-logo-ads-display-position'],
    'sanitize_callback' => 'online_shop_sanitize_select'
) );
$choices = online_shop_header_logo_menu_display_position();
$wp_customize->add_control( 'online_shop_theme_options[online-shop-header-logo-ads-display-position]', array(
    'choices'  	=> $choices,
    'label'		=> esc_html__( 'Logo and Advertisement Position', 'online-shop' ),
    'section'   => 'online-shop-site-identity-placement',
    'settings'  => 'online_shop_theme_options[online-shop-header-logo-ads-display-position]',
    'type'	  	=> 'select'
) );