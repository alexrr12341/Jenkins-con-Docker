<?php
/**
 * Functions for configuring demo importer.
 *
 * @package Importer/Functions
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Setup demo importer config.
 *
 * @deprecated 1.5.0
 *
 * @param  array $demo_config Demo config.
 * @return array
 */
function masonic_demo_importer_packages( $packages ) {
	$new_packages = array(
		'masonic-free' => array(
			'name'    => esc_html__( 'Masonic', 'masonic' ),
			'preview' => 'http://demo.themegrill.com/masonic/',
		),
	);

	return array_merge( $new_packages, $packages );
}

add_filter( 'themegrill_demo_importer_packages', 'masonic_demo_importer_packages' );
