<?php
/**
 * Excerpt length 90 return
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( !function_exists('online_shop_alter_excerpt') ) :
    function online_shop_alter_excerpt( $length ){
		if( is_admin() ){
			return $length;
		}
        return 90;
    }
endif;

add_filter('excerpt_length', 'online_shop_alter_excerpt');

/**
 * Add ... for more view
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return null
 *
 */

if ( !function_exists('online_shop_excerpt_more') ) :
    function online_shop_excerpt_more( $more ) {
		if( is_admin() ){
			return $more;
		}
        return '&hellip;';
    }
endif;
add_filter('excerpt_more', 'online_shop_excerpt_more');