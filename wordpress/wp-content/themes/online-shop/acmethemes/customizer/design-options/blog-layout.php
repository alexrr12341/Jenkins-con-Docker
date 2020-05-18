<?php
/*adding sections for blog layout options*/
$wp_customize->add_section( 'online-shop-design-blog-layout-option', array(
    'priority'       => 30,
    'capability'     => 'edit_theme_options',
    'title'          => esc_html__( 'Default Blog/Archive Layout', 'online-shop' ),
    'panel'          => 'online-shop-design-panel'
) );

/*blog layout*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-blog-archive-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['online-shop-blog-archive-layout'],
    'sanitize_callback' => 'online_shop_sanitize_select'
) );
$choices = online_shop_blog_layout();
$wp_customize->add_control( 'online_shop_theme_options[online-shop-blog-archive-layout]', array(
    'choices'  	=> $choices,
    'label'		=> esc_html__( 'Default Blog/Archive Layout', 'online-shop' ),
    'description'=> esc_html__( 'Image display options', 'online-shop' ),
    'section'   => 'online-shop-design-blog-layout-option',
    'settings'  => 'online_shop_theme_options[online-shop-blog-archive-layout]',
    'type'	  	=> 'select'
) );

/*blog image size*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-blog-archive-img-size]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-blog-archive-img-size'],
	'sanitize_callback' => 'online_shop_sanitize_select'
) );
$choices = online_shop_get_image_sizes_options();
$wp_customize->add_control( 'online_shop_theme_options[online-shop-blog-archive-img-size]', array(
	'choices'  	=> $choices,
	'label'		=> esc_html__( 'Image Layout Options', 'online-shop' ),
	'section'   => 'online-shop-design-blog-layout-option',
	'settings'  => 'online_shop_theme_options[online-shop-blog-archive-img-size]',
	'type'	  	=> 'select',
) );

/*Read More Text*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-blog-archive-more-text]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-blog-archive-more-text'],
	'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'online_shop_theme_options[online-shop-blog-archive-more-text]', array(
	'label'		=> esc_html__( 'Read More Text', 'online-shop' ),
	'section'   => 'online-shop-design-blog-layout-option',
	'settings'  => 'online_shop_theme_options[online-shop-blog-archive-more-text]',
	'type'	  	=> 'text'
) );