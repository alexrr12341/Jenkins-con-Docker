<?php
/**
 * Reset options
 * Its outside options panel
 *
 * @param  array $reset_options
 * @return void
 *
 * @since Online Shop 1.0.0
 */
if ( ! function_exists( 'online_shop_reset_db_options' ) ) :
    function online_shop_reset_db_options( $reset_options ) {
        set_theme_mod( 'online_shop_theme_options', $reset_options );
    }
endif;

function online_shop_reset_db_setting( ){
	$online_shop_customizer_all_values = online_shop_get_theme_options();
	$input = $online_shop_customizer_all_values['online-shop-reset-options'];
	if( '0' == $input ){
		return;
	}
    $online_shop_default_theme_options = online_shop_get_default_theme_options();
    $online_shop_get_theme_options = get_theme_mod( 'online_shop_theme_options');

    switch ( $input ) {
        case "reset-color-options":
            $online_shop_get_theme_options['online-shop-primary-color'] = $online_shop_default_theme_options['online-shop-primary-color'];
            online_shop_reset_db_options($online_shop_get_theme_options);
            break;

        case "reset-all":
            online_shop_reset_db_options($online_shop_default_theme_options);
            break;

        default:
            break;
    }
}
add_action( 'customize_save_after','online_shop_reset_db_setting' );

/*adding sections for Reset Options*/
$wp_customize->add_section( 'online-shop-reset-options', array(
    'priority'       => 220,
    'capability'     => 'edit_theme_options',
    'title'          => esc_html__( 'Reset Options', 'online-shop' )
) );

/*Reset Options*/
$wp_customize->add_setting( 'online_shop_theme_options[online-shop-reset-options]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['online-shop-reset-options'],
    'sanitize_callback' => 'online_shop_sanitize_select',
    'transport'			=> 'postMessage'
) );

$choices = online_shop_reset_options();
$wp_customize->add_control( 'online_shop_theme_options[online-shop-reset-options]', array(
    'choices'  	=> $choices,
    'label'		=> esc_html__( 'Reset Options', 'online-shop' ),
    'description'=> esc_html__( 'Caution: Reset theme settings according to the given options. Refresh the page after saving to view the effects. ', 'online-shop' ),
    'section'   => 'online-shop-reset-options',
    'settings'  => 'online_shop_theme_options[online-shop-reset-options]',
    'type'	  	=> 'select'
) );