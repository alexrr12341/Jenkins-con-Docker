<?php
/*adding sections for default layout options panel*/
$wp_customize->add_section( 'online-shop-archive-sidebar-layout', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'title'          => esc_html__( 'Category/Archive Sidebar Layout', 'online-shop' ),
    'panel'          => 'online-shop-design-panel'
) );

/*Sidebar Layout*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-archive-sidebar-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['online-shop-archive-sidebar-layout'],
    'sanitize_callback' => 'online_shop_sanitize_select'
) );
$choices = online_shop_sidebar_layout();
$wp_customize->add_control( 'online_shop_theme_options[online-shop-archive-sidebar-layout]', array(
    'choices'  	    => $choices,
    'label'		    => esc_html__( 'Category/Archive Sidebar Layout', 'online-shop' ),
    'description'   => esc_html__( 'Sidebar Layout for listing pages like category, author etc', 'online-shop' ),
    'section'       => 'online-shop-archive-sidebar-layout',
    'settings'      => 'online_shop_theme_options[online-shop-archive-sidebar-layout]',
    'type'	  	    => 'select'
) );