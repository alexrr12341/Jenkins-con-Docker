<?php
/*sorting core and widget for ease of theme use*/
$online_shop_header_sidebar_section = $wp_customize->get_section( 'sidebar-widgets-online-shop-header' );
if ( ! empty( $online_shop_header_sidebar_section ) ) {
	$online_shop_header_sidebar_section->panel = 'online-shop-header-panel';
	$online_shop_header_sidebar_section->title = esc_html__( 'Header Search or Ads', 'online-shop' );
	$online_shop_header_sidebar_section->priority = 30;
}

$online_shop_header_title_tagline = $wp_customize->get_section( 'title_tagline' );
$online_shop_header_title_tagline->panel = 'online-shop-header-panel';
$online_shop_header_title_tagline->title = esc_html__( 'Site Identity( Logo, Title & Tagline )', 'online-shop' );
$online_shop_header_title_tagline->priority = 20;