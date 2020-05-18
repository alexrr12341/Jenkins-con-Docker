<?php
/*adding sections for social options */
$wp_customize->add_section( 'online-shop-social-options', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'title'          => esc_html__( 'Social Options', 'online-shop' ),
    'panel'          => 'online-shop-options'
) );

/*repeater social data*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-social-data]', array(
	'sanitize_callback' => 'online_shop_sanitize_social_data',
	'default' => $defaults['online-shop-social-data']
) );
$wp_customize->add_control(
	new Online_Shop_Repeater_Control(
		$wp_customize,
		'online_shop_theme_options[online-shop-social-data]',
		array(
			'label'   => esc_html__('Social Options Selection','online-shop'),
			'description'=> esc_html__('Select Social Icons and enter link','online-shop'),
			'section' => 'online-shop-social-options',
			'settings' => 'online_shop_theme_options[online-shop-social-data]',
			'repeater_main_label' => esc_html__('Social Icon','online-shop'),
			'repeater_add_control_field' => esc_html__('Add New Icon','online-shop')
		),
		array(
			'icon' => array(
				'type'        => 'icons',
				'label'       => esc_html__( 'Select Icon', 'online-shop' ),
			),
			'link' => array(
				'type'        => 'url',
				'label'       => esc_html__( 'Enter Link', 'online-shop' ),
			),
			'checkbox' => array(
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Open in New Window', 'online-shop' ),
			)
		)
	)
);