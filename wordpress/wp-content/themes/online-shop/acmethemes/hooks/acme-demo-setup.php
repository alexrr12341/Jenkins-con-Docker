<?php
if( !function_exists( 'online_shop_demo_nav_data') ){
    function online_shop_demo_nav_data(){
        $demo_navs = array(
            'primary'  => 'Primary Menu',
            'top-menu'  => 'Top Menu',
            'special-menu'  => 'Special Menu'
        );
        return $demo_navs;
    }
}
add_filter('acme_demo_setup_nav_data','online_shop_demo_nav_data');

if( !function_exists( 'online_shop_demo_wp_options_data') ){
	function online_shop_demo_wp_options_data(){
		$wp_options = array(
			'blogname'       => 'Online Shop',
			'site_description'=> 'WordPress eCommerce Theme',
			'page_on_front'  => 'Front Page',
			'page_for_posts' => 'Blog',
		);
		return $wp_options;
	}
}
add_filter('acme_demo_setup_wp_options_data','online_shop_demo_wp_options_data');

if( !function_exists( 'online_shop_update_image_size') ){
	function online_shop_update_image_size(){
		/*Thumbnail Size*/
		update_option( 'thumbnail_size_w', 500 );
		update_option( 'thumbnail_size_h', 280 );
		update_option( 'thumbnail_crop', 1 );

		/*Medium Image Size*/
		update_option( 'medium_size_w', 660 );
		update_option( 'medium_size_h', 365 );

		/*Large Image Size*/
		update_option( 'large_size_w', 840 );
		update_option( 'large_size_h', 840 );
	}
}
add_action( 'acme_demo_setup_before_import', 'online_shop_update_image_size' );
add_action( 'wp_ajax_acme_demo_setup_before_import', 'online_shop_update_image_size' );