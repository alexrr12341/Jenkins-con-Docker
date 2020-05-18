<?php
/**
 * Before main content
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'online_shop_featured_slider' ) ) :

	function online_shop_featured_slider() {
		if( is_front_page() && !is_home() ) {

			/*Slider Feature Section*/
			/**
			 * online_shop_action_feature_slider
			 * @since Online Shop 1.0.0
			 *
			 * @hooked online_shop_feature_slider -  0
			 */
			do_action('online_shop_action_feature_slider');

		}
	}
endif;
add_action( 'online_shop_action_front_page', 'online_shop_featured_slider', 10 );

/**
 * Front page hook for all WordPress Conditions
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'online_shop_front_page' ) ) :

    function online_shop_front_page() {
	    $online_shop_customizer_all_values = online_shop_get_theme_options();
	    $online_shop_hide_front_page_content = $online_shop_customizer_all_values['online-shop-hide-front-page-content'];

	    /*show widget in front page, now user are not force to use front page*/
	    if( is_active_sidebar( 'online-shop-home' ) && !is_home() ){
		    dynamic_sidebar( 'online-shop-home' );
	    }
	    $sidebar_layout = online_shop_sidebar_selection( get_the_ID() );
	    if( 'both-sidebar' == $sidebar_layout && is_front_page() && !is_home() ) {
		    echo '<div id="primary-wrap" class="clearfix">';
	    }
	    if ( 'posts' == get_option( 'show_on_front' ) ) {
		    include( get_home_template() );
	    }
	    else {
		    if( 1 != $online_shop_hide_front_page_content ){
			    include( get_page_template() );
		    }
	    }
    }
endif;
add_action( 'online_shop_action_front_page', 'online_shop_front_page', 20 );