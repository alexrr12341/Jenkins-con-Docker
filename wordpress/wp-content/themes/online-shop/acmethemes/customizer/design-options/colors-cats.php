<?php
// Category Color Options
$wp_customize->add_section('online_shop_category_color_setting', array(
    'priority'      => 40,
    'title'         => esc_html__('Category Color Options', 'online-shop'),
    'description'   => esc_html__('Change the highlighted color of each category items as you want.', 'online-shop'),
    'panel'         => 'online-shop-design-panel'
));

$i = 1;
$args = array(
    'orderby' => 'id',
    'hide_empty' => 0
);
$categories = get_categories( $args );
$wp_category_list = array();
foreach ($categories as $category_list ) {
    $wp_category_list[$category_list->cat_ID] = esc_attr( $category_list->cat_name );
    $cat_id = esc_attr( get_cat_id($wp_category_list[$category_list->cat_ID]) );
    $cat_name = esc_attr( get_cat_id($wp_category_list[$category_list->cat_ID]) );

    $wp_customize->add_setting('online_shop_theme_options[cat-'.$cat_id.']', array(
        'default'           => $defaults['online-shop-primary-color'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control(
    	new WP_Customize_Color_Control(
    		$wp_customize,
		    'online_shop_theme_options[cat-'.$cat_id.']',
		    array(
		    	'label'     => sprintf( esc_html__('"%s" Color', 'online-shop'), $wp_category_list[$category_list->cat_ID] ),
			    'section'   => 'online_shop_category_color_setting',
			    'settings'  => 'online_shop_theme_options[cat-'.$cat_id.']',
			    'priority'  => $i
		    )
	    )
    );
	$wp_customize->add_setting('online_shop_theme_options[cat-hover-'.$cat_id.']', array(
		'default'           => $defaults['online-shop-cat-hover-color'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color'
	));

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'online_shop_theme_options[cat-hover-'.$cat_id.']',
			array(
				'label'     => sprintf(esc_html__('"%s" Hover Color', 'online-shop'), $wp_category_list[$category_list->cat_ID] ),
				'section'   => 'online_shop_category_color_setting',
				'settings'  => 'online_shop_theme_options[cat-hover-'.$cat_id.']',
				'priority'  => $i
			)
		)
	);

	/*adding hr between cats*/
	$wp_customize->add_setting('online_shop_theme_options[cat-hr-'.$cat_id.']', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> '',
		'sanitize_callback' => 'esc_attr'
	));

	$wp_customize->add_control(
		new Online_Shop_Customize_Message_Control(
			$wp_customize,
			'online_shop_theme_options[cat-hr-'.$cat_id.']',
			array(
				'section'   => 'online_shop_category_color_setting',
				'description' => "<hr>",
				'settings'  => 'online_shop_theme_options[cat-hr-'.$cat_id.']',
				'type'	  	=> 'message',
				'priority'  => $i
			)
		)
	);
    $i++;
}