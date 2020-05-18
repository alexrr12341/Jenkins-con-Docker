<?php
/**
 * Function to sanitize number
 *
 * @since 1.0.0
 *
 * @param $online_shop_input
 * @param $online_shop_setting
 * @return int || float || numeric value
 *
 */
if ( ! function_exists( 'online_shop_sanitize_number' ) ) :
	function online_shop_sanitize_number ( $online_shop_input, $online_shop_setting ) {
		$online_shop_sanitize_text = sanitize_text_field( $online_shop_input );

		// If the input is an number, return it; otherwise, return the default
		return ( is_numeric( $online_shop_sanitize_text ) ? $online_shop_sanitize_text : $online_shop_setting->default );
	}
endif;

/**
 * Sanitizing the checkbox
 *
 * @since Online Shop 1.0.0
 *
 * @param $checked
 * @return Boolean
 *
 */
if ( !function_exists('online_shop_sanitize_checkbox') ) :
	function online_shop_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}
endif;

/**
 * Sanitizing the image callback example
 *
 * @see wp_check_filetype() https://developer.wordpress.org/reference/functions/wp_check_filetype/
 *
 * @since Online Shop 1.0.0
 *
 * @param string $image Image filename.
 * @param $setting Setting instance.
 * @return string the image filename if the extension is allowed; otherwise, the setting default.
 *
 */
if ( !function_exists('online_shop_sanitize_image') ) :
	function online_shop_sanitize_image( $image, $setting ) {
		/*
         * Array of valid image file types.
         *
         * The array includes image mime types that are included in wp_get_mime_types()
         */
		$mimes = array(
			'jpg|jpeg|jpe' => 'image/jpeg',
			'gif'          => 'image/gif',
			'png'          => 'image/png',
			'bmp'          => 'image/bmp',
			'tif|tiff'     => 'image/tiff',
			'ico'          => 'image/x-icon'
		);
		// Return an array with file extension and mime_type.
		$file = wp_check_filetype( $image, $mimes );
		// If $image has a valid mime_type, return it; otherwise, return the default.
		return ( $file['ext'] ? $image : $setting->default );
	}
endif;

/**
 * Sanitizing the page/post
 *
 * @since Online Shop 1.0.0
 *
 * @param $input user input value
 * @return sanitized output as $input
 *
 */
if ( !function_exists('online_shop_sanitize_page') ) :
	function online_shop_sanitize_page( $input ) {
		// Ensure $input is an absolute integer.
		$page_id = absint( $input );
		// If $page_id is an ID of a published page, return it; otherwise, return false
		return ( 'publish' == get_post_status( $page_id ) ? $page_id : false );
	}
endif;

/**
 * Sanitizing the select callback example
 *
 * @since Online Shop 1.0.0
 *
 * @see sanitize_key()               https://developer.wordpress.org/reference/functions/sanitize_key/
 * @see $wp_customize->get_control() https://developer.wordpress.org/reference/classes/wp_customize_manager/get_control/
 *
 * @param $input
 * @param $setting
 * @return sanitized output
 *
 */
if ( !function_exists('online_shop_sanitize_select') ) :
	function online_shop_sanitize_select( $input, $setting ) {

		// Ensure input is a slug.
		$input = sanitize_key( $input );

		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}
endif;

/**
 * Sanitizing allowed html using wp_kses
 *
 * @since Online Shop 1.0.0
 *
 * @param $input string user input value
 * @return string sanitized output as $input
 *
 */
if ( !function_exists('online_shop_sanitize_allowed_html') ) :
	function online_shop_sanitize_allowed_html ( $input ) {
		$allowed_html = wp_kses_allowed_html();
		$output = wp_kses($input, $allowed_html );
		return $output;
	}
endif;