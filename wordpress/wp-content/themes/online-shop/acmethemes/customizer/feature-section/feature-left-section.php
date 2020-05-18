<?php
/*check if post*/
if ( !function_exists('online_shop_is_feature_content_post') ) :
	function online_shop_is_feature_content_post() {
		$online_shop_customizer_all_values = online_shop_get_theme_options();
		if( 'post' == $online_shop_customizer_all_values['online-shop-feature-content-options'] ){
			return true;
		}
		return false;
	}
endif;

/*check if product*/
if ( !function_exists('online_shop_is_feature_content_product') ) :
	function online_shop_is_feature_content_product() {
		$online_shop_customizer_all_values = online_shop_get_theme_options();
		if( online_shop_is_woocommerce_active() && 'product' == $online_shop_customizer_all_values['online-shop-feature-content-options'] ){
			return true;
		}
		return false;
	}
endif;

/*check if feature not disable*/
if ( !function_exists('online_shop_if_feature_not_disable') ) :
	function online_shop_if_feature_not_disable() {
		$online_shop_customizer_all_values = online_shop_get_theme_options();
		$online_shop_feature_content_options = $online_shop_customizer_all_values['online-shop-feature-content-options'];
		if( ( online_shop_is_woocommerce_active() && 'product' == $online_shop_feature_content_options ) || 'post' == $online_shop_feature_content_options ){
			return true;
		}
		return false;
	}
endif;

/*adding sections for feature main*/
$wp_customize->add_section( 'online-shop-feature-content-options', array(
	'capability'     => 'edit_theme_options',
	'title'          => esc_html__( 'Feature Main Section( Left Section )', 'online-shop' ),
	'description'	 => sprintf( esc_html__( 'Feature section will display on front/home page. Feature Section includes Feature Main Section, Feature Right Section and  Special Menu Feature Left  .%1$s Note : Please go to %2$s Homepage Settings %3$s, Select "A static page" then "Front page" and "Posts page" to enable it', 'online-shop' ), '<br />','<b><a class="at-customizer button button-primary" data-section="static_front_page"> ','</a></b>' ),
	'panel'          => 'online-shop-feature-panel'
) );

/*Feature Content Options*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-feature-content-options]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-feature-content-options'],
	'sanitize_callback' => 'online_shop_sanitize_select'
) );
$choices = online_shop_feature_section_content_options();
$wp_customize->add_control( 'online_shop_theme_options[online-shop-feature-content-options]', array(
	'choices'  	    => $choices,
	'label'		    => esc_html__( 'Show', 'online-shop' ),
	'description'   => esc_html__( 'Show post, page, or product on Feature section', 'online-shop' ),
	'section'       => 'online-shop-feature-content-options',
	'settings'      => 'online_shop_theme_options[online-shop-feature-content-options]',
	'type'	  	    => 'select'
) );

/* feature cat selection */
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-feature-post-cat]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-feature-post-cat'],
	'sanitize_callback' => 'online_shop_sanitize_number'
) );

$wp_customize->add_control(
	new Online_Shop_Customize_Category_Dropdown_Control(
		$wp_customize,
		'online_shop_theme_options[online-shop-feature-post-cat]',
		array(
			'label'		=> esc_html__( 'Select Post Category', 'online-shop' ),
			'section'   => 'online-shop-feature-content-options',
			'settings'  => 'online_shop_theme_options[online-shop-feature-post-cat]',
			'type'	  	=> 'category_dropdown',
			'active_callback'=> 'online_shop_is_feature_content_post'
		)
	)
);

/* feature product cat selection */
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-feature-product-cat]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-feature-product-cat'],
	'sanitize_callback' => 'online_shop_sanitize_number'
) );

$wp_customize->add_control(
	new Online_Shop_Customize_WC_Category_Dropdown_Control(
		$wp_customize,
		'online_shop_theme_options[online-shop-feature-product-cat]',
		array(
			'label'		=> esc_html__( 'Select Product Category', 'online-shop' ),
			'section'   => 'online-shop-feature-content-options',
			'settings'  => 'online_shop_theme_options[online-shop-feature-product-cat]',
			'type'	  	=> 'category_dropdown',
			'active_callback' => 'online_shop_is_feature_content_product'
		)
	)
);

/*Post Number*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-feature-post-number]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-feature-post-number'],
	'sanitize_callback' => 'absint'
) );
$wp_customize->add_control( 'online_shop_theme_options[online-shop-feature-post-number]', array(
	'label'		=> esc_html__( 'Number', 'online-shop' ),
	'section'   => 'online-shop-feature-content-options',
	'settings'  => 'online_shop_theme_options[online-shop-feature-post-number]',
	'type'	  	=> 'number',
	'active_callback'   => 'online_shop_if_feature_not_disable'
) );

/*display-cat*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-feature-slider-display-cat]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-feature-slider-display-cat'],
	'sanitize_callback' => 'online_shop_sanitize_checkbox'
) );
$wp_customize->add_control( 'online_shop_theme_options[online-shop-feature-slider-display-cat]', array(
	'label'		    => esc_html__( 'Display Categories', 'online-shop' ),
	'section'       => 'online-shop-feature-content-options',
	'settings'      => 'online_shop_theme_options[online-shop-feature-slider-display-cat]',
	'type'	  	    => 'checkbox',
	'active_callback'   => 'online_shop_if_feature_not_disable'
) );

/*display-title*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-feature-slider-display-title]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-feature-slider-display-title'],
	'sanitize_callback' => 'online_shop_sanitize_checkbox'
) );
$wp_customize->add_control( 'online_shop_theme_options[online-shop-feature-slider-display-title]', array(
	'label'		    => esc_html__( 'Display Title', 'online-shop' ),
	'section'       => 'online-shop-feature-content-options',
	'settings'      => 'online_shop_theme_options[online-shop-feature-slider-display-title]',
	'type'	  	    => 'checkbox',
	'active_callback'   => 'online_shop_if_feature_not_disable'
) );

/*display-excerpt*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-feature-slider-display-excerpt]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-feature-slider-display-excerpt'],
	'sanitize_callback' => 'online_shop_sanitize_checkbox'
) );
$wp_customize->add_control( 'online_shop_theme_options[online-shop-feature-slider-display-excerpt]', array(
	'label'		    => esc_html__( 'Display Excerpt', 'online-shop' ),
	'section'       => 'online-shop-feature-content-options',
	'settings'      => 'online_shop_theme_options[online-shop-feature-slider-display-excerpt]',
	'type'	  	    => 'checkbox',
	'active_callback'   => 'online_shop_if_feature_not_disable'
) );

/*display-arrow*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-feature-slider-display-arrow]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-feature-slider-display-arrow'],
	'sanitize_callback' => 'online_shop_sanitize_checkbox'
) );
$wp_customize->add_control( 'online_shop_theme_options[online-shop-feature-slider-display-arrow]', array(
	'label'		    => esc_html__( 'Display Arrow', 'online-shop' ),
	'section'       => 'online-shop-feature-content-options',
	'settings'      => 'online_shop_theme_options[online-shop-feature-slider-display-arrow]',
	'type'	  	    => 'checkbox',
	'active_callback'   => 'online_shop_if_feature_not_disable'
) );

/*enable-autoplay*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-feature-slider-enable-autoplay]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-feature-slider-enable-autoplay'],
	'sanitize_callback' => 'online_shop_sanitize_checkbox'
) );
$wp_customize->add_control( 'online_shop_theme_options[online-shop-feature-slider-enable-autoplay]', array(
	'label'		    => esc_html__( 'Enable Autoplay', 'online-shop' ),
	'section'       => 'online-shop-feature-content-options',
	'settings'      => 'online_shop_theme_options[online-shop-feature-slider-enable-autoplay]',
	'type'	  	    => 'checkbox',
	'active_callback'   => 'online_shop_if_feature_not_disable'
) );

/*Image Display Behavior*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-fs-image-display-options]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-fs-image-display-options'],
	'sanitize_callback' => 'online_shop_sanitize_select'
) );
$choices = online_shop_fs_image_display_options();
$wp_customize->add_control( 'online_shop_theme_options[online-shop-fs-image-display-options]', array(
	'choices'  	=> $choices,
	'label'		=> esc_html__( 'Feature Slider Image Display Options', 'online-shop' ),
	'description'=> esc_html__( 'Recommended Image Size 816*520 ', 'online-shop' ),
	'section'   => 'online-shop-feature-content-options',
	'settings'  => 'online_shop_theme_options[online-shop-fs-image-display-options]',
	'type'	  	=> 'radio',
	'active_callback'   => 'online_shop_if_feature_not_disable'
) );

/*Button text*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-feature-button-text]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-feature-button-text'],
	'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'online_shop_theme_options[online-shop-feature-button-text]', array(
	'label'		=> esc_html__( 'Button Text', 'online-shop' ),
	'description'=> esc_html__( 'Left empty to hide', 'online-shop' ),
	'section'   => 'online-shop-feature-content-options',
	'settings'  => 'online_shop_theme_options[online-shop-feature-button-text]',
	'type'	  	=> 'text',
	'active_callback'   => 'online_shop_if_feature_not_disable'
) );