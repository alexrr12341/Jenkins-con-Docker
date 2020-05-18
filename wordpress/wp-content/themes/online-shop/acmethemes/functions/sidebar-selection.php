<?php
/**
 * Select sidebar according to the options saved
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return string
 *
 */
if ( !function_exists('online_shop_sidebar_selection') ) :
	function online_shop_sidebar_selection( ) {
		wp_reset_postdata();
		$online_shop_customizer_all_values = online_shop_get_theme_options();
		global $post;
		if(
			isset( $online_shop_customizer_all_values['online-shop-single-sidebar-layout'] ) &&
			(
				'left-sidebar' == $online_shop_customizer_all_values['online-shop-single-sidebar-layout'] ||
				'both-sidebar' == $online_shop_customizer_all_values['online-shop-single-sidebar-layout'] ||
				'middle-col' == $online_shop_customizer_all_values['online-shop-single-sidebar-layout'] ||
				'no-sidebar' == $online_shop_customizer_all_values['online-shop-single-sidebar-layout']
			)
		){
			$online_shop_body_global_class = $online_shop_customizer_all_values['online-shop-single-sidebar-layout'];
		}
		else{
			$online_shop_body_global_class= 'right-sidebar';
		}

		if ( online_shop_is_woocommerce_active() && ( is_product() || is_shop() || is_product_taxonomy() )) {
			if( is_product() ){
				$post_class = get_post_meta( $post->ID, 'online_shop_sidebar_layout', true );
				$online_shop_wc_single_product_sidebar_layout = $online_shop_customizer_all_values['online-shop-wc-single-product-sidebar-layout'];

				if ( 'default-sidebar' != $post_class ){
					if ( $post_class ) {
						$online_shop_body_classes = $post_class;
					} else {
						$online_shop_body_classes = $online_shop_wc_single_product_sidebar_layout;
					}
				}
				else{
					$online_shop_body_classes = $online_shop_wc_single_product_sidebar_layout;

				}
			}
			else{
				if( isset( $online_shop_customizer_all_values['online-shop-wc-shop-archive-sidebar-layout'] ) ){
					$online_shop_archive_sidebar_layout = $online_shop_customizer_all_values['online-shop-wc-shop-archive-sidebar-layout'];
					if(
						'right-sidebar' == $online_shop_archive_sidebar_layout ||
						'left-sidebar' == $online_shop_archive_sidebar_layout ||
						'both-sidebar' == $online_shop_archive_sidebar_layout ||
						'middle-col' == $online_shop_archive_sidebar_layout ||
						'no-sidebar' == $online_shop_archive_sidebar_layout
					){
						$online_shop_body_classes = $online_shop_archive_sidebar_layout;
					}
					else{
						$online_shop_body_classes = $online_shop_body_global_class;
					}
				}
				else{
					$online_shop_body_classes= $online_shop_body_global_class;
				}
			}
		}
		elseif( is_front_page() ){
			if( isset( $online_shop_customizer_all_values['online-shop-front-page-sidebar-layout'] ) ){
				if(
					'right-sidebar' == $online_shop_customizer_all_values['online-shop-front-page-sidebar-layout'] ||
					'left-sidebar' == $online_shop_customizer_all_values['online-shop-front-page-sidebar-layout'] ||
					'both-sidebar' == $online_shop_customizer_all_values['online-shop-front-page-sidebar-layout'] ||
					'middle-col' == $online_shop_customizer_all_values['online-shop-front-page-sidebar-layout'] ||
					'no-sidebar' == $online_shop_customizer_all_values['online-shop-front-page-sidebar-layout']
				){
					$online_shop_body_classes = $online_shop_customizer_all_values['online-shop-front-page-sidebar-layout'];
				}
				else{
					$online_shop_body_classes = $online_shop_body_global_class;
				}
			}
			else{
				$online_shop_body_classes= $online_shop_body_global_class;
			}
		}

		elseif ( is_singular() && isset( $post->ID ) ) {
			$post_class = get_post_meta( $post->ID, 'online_shop_sidebar_layout', true );
			if ( 'default-sidebar' != $post_class ){
				if ( $post_class ) {
					$online_shop_body_classes = $post_class;
				} else {
					$online_shop_body_classes = $online_shop_body_global_class;
				}
			}
			else{
				$online_shop_body_classes = $online_shop_body_global_class;
			}

		}
		elseif ( is_archive() ) {
			if( isset( $online_shop_customizer_all_values['online-shop-archive-sidebar-layout'] ) ){
				$online_shop_archive_sidebar_layout = $online_shop_customizer_all_values['online-shop-archive-sidebar-layout'];
				if(
					'right-sidebar' == $online_shop_archive_sidebar_layout ||
					'left-sidebar' == $online_shop_archive_sidebar_layout ||
					'both-sidebar' == $online_shop_archive_sidebar_layout ||
					'middle-col' == $online_shop_archive_sidebar_layout ||
					'no-sidebar' == $online_shop_archive_sidebar_layout
				){
					$online_shop_body_classes = $online_shop_archive_sidebar_layout;
				}
				else{
					$online_shop_body_classes = $online_shop_body_global_class;
				}
			}
			else{
				$online_shop_body_classes= $online_shop_body_global_class;
			}
		}
		else {
			$online_shop_body_classes = $online_shop_body_global_class;
		}
		return $online_shop_body_classes;
	}
endif;