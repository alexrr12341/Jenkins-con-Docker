<?php
/*adding sections for Search Placeholder*/
$wp_customize->add_section( 'online-shop-search', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'title'          => esc_html__( 'Search', 'online-shop' ),
    'panel'          => 'online-shop-options'
) );

/*Search Placeholder*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-search-placeholder]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['online-shop-search-placeholder'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'online_shop_theme_options[online-shop-search-placeholder]', array(
    'label'		=> esc_html__( 'Search Placeholder', 'online-shop' ),
    'section'   => 'online-shop-search',
    'settings'  => 'online_shop_theme_options[online-shop-search-placeholder]',
    'type'	  	=> 'text'
) );