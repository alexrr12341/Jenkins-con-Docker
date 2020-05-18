<?php
/*check if enable header top*/
if ( !function_exists('online_shop_is_enable_header_top') ) :
	function online_shop_is_enable_header_top() {
		$online_shop_customizer_all_values = online_shop_get_theme_options();
		if( 1 == $online_shop_customizer_all_values['online-shop-enable-header-top'] ){
			return true;
		}
		return false;
	}
endif;

/*check for online-shop-top-right-button-options*/
if ( !function_exists('online_shop_top_right_button_if_not_disable') ) :
	function online_shop_top_right_button_if_not_disable() {
		$online_shop_customizer_all_values = online_shop_get_theme_options();
		$online_shop_enable_header_top = $online_shop_customizer_all_values['online-shop-enable-header-top'];
		$online_shop_top_right_button_options = $online_shop_customizer_all_values['online-shop-top-right-button-options'];
		if( 1 == $online_shop_enable_header_top && 'disable' != $online_shop_top_right_button_options ){
			return true;
		}
		return false;
	}
endif;

if ( !function_exists('online_shop_top_right_button_if_widget') ) :
	function online_shop_top_right_button_if_widget() {
		$online_shop_customizer_all_values = online_shop_get_theme_options();
		$online_shop_enable_header_top = $online_shop_customizer_all_values['online-shop-enable-header-top'];
		$online_shop_top_right_button_options = $online_shop_customizer_all_values['online-shop-top-right-button-options'];
		if( 1 == $online_shop_enable_header_top && 'widget' == $online_shop_top_right_button_options ){
			return true;
		}
		return false;
	}
endif;

if ( !function_exists('online_shop_menu_right_button_if_link') ) :
	function online_shop_menu_right_button_if_link() {
		$online_shop_customizer_all_values = online_shop_get_theme_options();
		$online_shop_enable_header_top = $online_shop_customizer_all_values['online-shop-enable-header-top'];
		$online_shop_top_right_button_options = $online_shop_customizer_all_values['online-shop-top-right-button-options'];
		if( 1 == $online_shop_enable_header_top && 'link' == $online_shop_top_right_button_options ){
			return true;
		}
		return false;
	}
endif;

/*adding sections for header options*/
$wp_customize->add_section( 'online-shop-header-top-option', array(
	'priority'       => 10,
	'capability'     => 'edit_theme_options',
	'title'          => esc_html__( 'Header Top', 'online-shop' ),
	'panel'          => 'online-shop-header-top-panel'
) );

/*header top enable*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-enable-header-top]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-enable-header-top'],
	'sanitize_callback' => 'online_shop_sanitize_checkbox',
) );
$wp_customize->add_control( 'online_shop_theme_options[online-shop-enable-header-top]', array(
	'label'		=> esc_html__( 'Enable Header Top Options', 'online-shop' ),
	'section'   => 'online-shop-header-top-option',
	'settings'  => 'online_shop_theme_options[online-shop-enable-header-top]',
	'type'	  	=> 'checkbox'
) );

/*header top message*/
$wp_customize->add_setting('online_shop_theme_options[online-shop-header-top-message]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> '',
	'sanitize_callback' => 'esc_attr'
));

$wp_customize->add_control(
	new Online_Shop_Customize_Message_Control(
		$wp_customize,
		'online_shop_theme_options[online-shop-header-top-message]',
		array(
			'section'   => 'online-shop-header-top-option',
			'description'    => "<hr /><h2>".esc_html__('Display Different Element on Top Right or Left','online-shop')."</h2>",
			'settings'  => 'online_shop_theme_options[online-shop-header-top-message]',
			'type'	  	=> 'message',
			'active_callback'   => 'online_shop_is_enable_header_top'
		)
	)
);

/*Basic Info display*/
$choices = online_shop_header_top_display_selection();
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-header-top-basic-info-display-selection]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-header-top-basic-info-display-selection'],
	'sanitize_callback' => 'online_shop_sanitize_select'
) );
$description = sprintf( esc_html__( 'Add/Edit Basic Info from %1$s here%2$s', 'online-shop' ), '<a class="at-customizer button button-primary" data-section="online-shop-header-info" style="cursor: pointer">','</a>' );
$wp_customize->add_control( 'online_shop_theme_options[online-shop-header-top-basic-info-display-selection]', array(
	'choices'  	=> $choices,
	'label'		=> esc_html__( 'Basic Info Display', 'online-shop' ),
	'description'=> $description,
	'section'   => 'online-shop-header-top-option',
	'settings'  => 'online_shop_theme_options[online-shop-header-top-basic-info-display-selection]',
	'type'	  	=> 'select',
	'active_callback'   => 'online_shop_is_enable_header_top'
) );

/*Top Menu Display*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-header-top-menu-display-selection]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-header-top-menu-display-selection'],
	'sanitize_callback' => 'online_shop_sanitize_select'
) );
$description = sprintf( esc_html__( 'Add/Edit Menu Items from %1$s here%2$s and select Menu Location : Top Menu ( Support First Level Only ) ', 'online-shop' ), '<a class="at-customizer button button-primary" data-panel="nav_menus" style="cursor: pointer">','</a>' );
$wp_customize->add_control( 'online_shop_theme_options[online-shop-header-top-menu-display-selection]', array(
	'choices'  	=> $choices,
	'label'		=> esc_html__( 'Top Menu Display', 'online-shop' ),
	'description'=> $description,
	'section'   => 'online-shop-header-top-option',
	'settings'  => 'online_shop_theme_options[online-shop-header-top-menu-display-selection]',
	'type'	  	=> 'select',
	'active_callback'=> 'online_shop_is_enable_header_top'
) );

/*Social Display*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-header-top-social-display-selection]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-header-top-social-display-selection'],
	'sanitize_callback' => 'online_shop_sanitize_select'
) );
$description = sprintf( esc_html__( 'Add/Edit Social Items from %1$s here%2$s ', 'online-shop' ), '<a class="at-customizer button button-primary" data-section="online-shop-social-options" style="cursor: pointer">','</a>' );
$wp_customize->add_control( 'online_shop_theme_options[online-shop-header-top-social-display-selection]', array(
	'choices'  	=> $choices,
	'label'		=> esc_html__( 'Social Display', 'online-shop' ),
	'description'=> $description,
	'section'   => 'online-shop-header-top-option',
	'settings'  => 'online_shop_theme_options[online-shop-header-top-social-display-selection]',
	'type'	  	=> 'select',
	'active_callback'   => 'online_shop_is_enable_header_top'
) );

/*Button Right Message*/
$wp_customize->add_setting('online_shop_theme_options[online-shop-top-right-button-message]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> '',
	'sanitize_callback' => 'esc_attr'
));
$wp_customize->add_control(
	new Online_Shop_Customize_Message_Control(
		$wp_customize,
		'online_shop_theme_options[online-shop-top-right-button-message]',
		array(
			'section'   => 'online-shop-header-top-option',
			'description'    => "<hr /><h2>".esc_html__('Special Button On Top Right','online-shop')."</h2>",
			'settings'  => 'online_shop_theme_options[online-shop-top-right-button-message]',
			'type'	  	=> 'message',
			'active_callback'   => 'online_shop_is_enable_header_top'
		)
	)
);

/*Button Link Options*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-top-right-button-options]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-top-right-button-options'],
	'sanitize_callback' => 'online_shop_sanitize_select'
) );
$choices = online_shop_menu_right_button_link_options();
$wp_customize->add_control( 'online_shop_theme_options[online-shop-top-right-button-options]', array(
	'choices'  	    => $choices,
	'label'		    => esc_html__( 'Top Right Button Options', 'online-shop' ),
	'section'       => 'online-shop-header-top-option',
	'settings'      => 'online_shop_theme_options[online-shop-top-right-button-options]',
	'type'	  	    => 'select',
	'active_callback'   => 'online_shop_is_enable_header_top'
) );

/*Button title*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-top-right-button-title]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-top-right-button-title'],
	'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'online_shop_theme_options[online-shop-top-right-button-title]', array(
	'label'		=> esc_html__( 'Button Title', 'online-shop' ),
	'section'   => 'online-shop-header-top-option',
	'settings'  => 'online_shop_theme_options[online-shop-top-right-button-title]',
	'type'	  	=> 'text',
	'active_callback'   => 'online_shop_top_right_button_if_not_disable'
) );

/*Popup widget title*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-popup-widget-title]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-popup-widget-title'],
	'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'online_shop_theme_options[online-shop-popup-widget-title]', array(
	'label'		=> esc_html__( 'Popup Widget Title', 'online-shop' ),
	'section'   => 'online-shop-header-top-option',
	'settings'  => 'online_shop_theme_options[online-shop-popup-widget-title]',
	'type'	  	=> 'text',
	'active_callback'   => 'online_shop_top_right_button_if_not_disable'
) );

/*Button Right appointment Message*/
$wp_customize->add_setting('online_shop_theme_options[online-shop-top-right-button-widget-message]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> '',
	'sanitize_callback' => 'esc_attr'
));
$description = sprintf( esc_html__( 'Add Widgets from %1$s here%2$s ', 'online-shop' ), '<a class="at-customizer button button-primary" data-section="sidebar-widgets-popup-widget-area" style="cursor: pointer">','</a>' );
$wp_customize->add_control(
	new Online_Shop_Customize_Message_Control(
		$wp_customize,
		'online_shop_theme_options[online-shop-top-right-button-widget-message]',
		array(
			'section'   => 'online-shop-header-top-option',
			'description'    => $description,
			'settings'  => 'online_shop_theme_options[online-shop-top-right-button-widget-message]',
			'type'	  	=> 'message',
			'active_callback'   => 'online_shop_top_right_button_if_widget'
		)
	)
);

/*Button link*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-top-right-button-link]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['online-shop-top-right-button-link'],
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( 'online_shop_theme_options[online-shop-top-right-button-link]', array(
	'label'		=> esc_html__( 'Button Link', 'online-shop' ),
	'section'   => 'online-shop-header-top-option',
	'settings'  => 'online_shop_theme_options[online-shop-top-right-button-link]',
	'type'	  	=> 'url',
	'active_callback'   => 'online_shop_menu_right_button_if_link'
) );