<?php
/**
 * Dynamic css
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'online_shop_dynamic_css' ) ) :

    function online_shop_dynamic_css() {

        global $online_shop_customizer_all_values;
        /*Color options */
        $online_shop_primary_color = esc_attr( $online_shop_customizer_all_values['online-shop-primary-color'] );

        $custom_css = '';
        /*background*/
        $custom_css .= "
            .slider-section .at-action-wrapper .slick-arrow,
            .beside-slider .at-action-wrapper .slick-arrow,
            mark,
            .comment-form .form-submit input,
            .read-more,
            .slider-section .cat-links a,
            .featured-desc .above-entry-meta .cat-links a,
            #calendar_wrap #wp-calendar #today,
            #calendar_wrap #wp-calendar #today a,
            .wpcf7-form input.wpcf7-submit:hover,
            .breadcrumb,
            .slicknav_btn,
            .special-menu:hover,
            .slider-buttons a,
            .yith-wcwl-wrapper,
			.wc-cart-wrapper,
			.woocommerce span.onsale,
			.new-label,
			.woocommerce a.button.add_to_cart_button,
			.woocommerce a.added_to_cart,
			.woocommerce a.button.product_type_grouped,
			.woocommerce a.button.product_type_external,
			.woocommerce .single-product #respond input#submit.alt,
			.woocommerce .single-product a.button.alt,
			.woocommerce .single-product button.button.alt,
			.woocommerce .single-product input.button.alt,
			.woocommerce #respond input#submit.alt,
			.woocommerce a.button.alt,
			.woocommerce button.button.alt,
			.woocommerce input.button.alt,
			.woocommerce .widget_shopping_cart_content .buttons a.button,
			.woocommerce div.product .woocommerce-tabs ul.tabs li:hover,
			.woocommerce div.product .woocommerce-tabs ul.tabs li.active,
			.woocommerce .cart .button,
			.woocommerce .cart input.button,
			.woocommerce input.button:disabled, 
			.woocommerce input.button:disabled[disabled],
			.woocommerce input.button:disabled:hover, 
			.woocommerce input.button:disabled[disabled]:hover,
			 .wc-cat-feature .cat-title,
			 .single-item .icon,
			 .menu-right-highlight-text,
			 .woocommerce nav.woocommerce-pagination ul li a:focus, 
			 .woocommerce nav.woocommerce-pagination ul li a:hover, 
			 .woocommerce nav.woocommerce-pagination ul li span.current,
			 .woocommerce a.button.wc-forward,
			 a.my-account,
			 .woocommerce .widget_price_filter .ui-slider .ui-slider-range,
			 .woocommerce .widget_price_filter .ui-slider .ui-slider-handle {
                background: {$online_shop_primary_color};
                color:#fff;
            }";

        /*color*/
        $custom_css .= "
             a:hover,
            .screen-reader-text:focus,
            .socials a:hover,
            .site-title a,
            .widget_search input#s,
            .search-block #searchsubmit,
            .widget_search #searchsubmit,
            .footer-sidebar .featured-desc .below-entry-meta a:hover,
            .slider-section .slide-title:hover,
            .slider-feature-wrap a:hover,
            .featured-desc .below-entry-meta span:hover,
            .posted-on a:hover,
            .cat-links a:hover,
            .comments-link a:hover,
            .edit-link a:hover,
            .tags-links a:hover,
            .byline a:hover,
            .nav-links a:hover,
            .comment-form .form-submit input:hover, .read-more:hover,
            #online-shop-breadcrumbs a:hover,
            .wpcf7-form input.wpcf7-submit,
            .header-wrapper .menu li:hover > a,
            .header-wrapper .menu > li.current-menu-item > a,
            .header-wrapper .menu > li.current-menu-parent > a,
            .header-wrapper .menu > li.current_page_parent > a,
            .header-wrapper .menu > li.current_page_ancestor > a,
            .header-wrapper .main-navigation ul ul.sub-menu li:hover > a ,
            .woocommerce .star-rating, 
            .woocommerce ul.products li.product .star-rating,
            .woocommerce p.stars a,
            .woocommerce ul.products li.product .price,
            .woocommerce ul.products li.product .price ins .amount,
            .woocommerce a.button.add_to_cart_button:hover,
            .woocommerce a.added_to_cart:hover,
            .woocommerce a.button.product_type_grouped:hover,
            .woocommerce a.button.product_type_external:hover,
            .woocommerce .cart .button:hover,
            .woocommerce .cart input.button:hover,
            .woocommerce #respond input#submit.alt:hover,
			.woocommerce a.button.alt:hover,
			.woocommerce button.button.alt:hover,
			.woocommerce input.button.alt:hover,
			.woocommerce .woocommerce-info .button:hover,
			.woocommerce .widget_shopping_cart_content .buttons a.button:hover,
			.woocommerce div.product .woocommerce-tabs ul.tabs li a,
			.at-cat-product-wrap .product-details h3 a:hover,
			.at-tabs >span.active,
			.feature-promo .single-unit .page-details .title,
			.woocommerce-message::before,
			a.my-account:hover{
                color: {$online_shop_primary_color};
            }";
        /*border*/
        $custom_css .= "
        .comment-form .form-submit input, 
        .read-more,
            .widget_search input#s,
            .tagcloud a,
            .woocommerce .cart .button, 
            .woocommerce .cart input.button,
            .woocommerce a.button.add_to_cart_button,
            .woocommerce a.added_to_cart,
            .woocommerce a.button.product_type_grouped,
            .woocommerce a.button.product_type_external,
            .woocommerce .cart .button,
            .woocommerce .cart input.button
            .woocommerce .single-product #respond input#submit.alt,
			.woocommerce .single-product a.button.alt,
			.woocommerce .single-product button.button.alt,
			.woocommerce .single-product input.button.alt,
			.woocommerce #respond input#submit.alt,
			.woocommerce a.button.alt,
			.woocommerce button.button.alt,
			.woocommerce input.button.alt,
			.woocommerce .widget_shopping_cart_content .buttons a.button,
			.woocommerce div.product .woocommerce-tabs ul.tabs:before,
			a.my-account,
            .slick-arrow:hover{
                border: 1px solid {$online_shop_primary_color};
            }
            .nav-links .nav-previous a:hover,
            .nav-links .nav-next a:hover{
                border-top: 1px solid {$online_shop_primary_color};
            }
            .at-title-action-wrapper,
            .page-header .page-title,
            .blog-no-image article.post.sticky,
             article.post.sticky,
             .related.products > h2,
             .cross-sells > h2,
             .cart_totals  > h2,
             .woocommerce-order-details > h2,
             .woocommerce-customer-details > h2,
             .comments-title{
                border-bottom: 1px solid {$online_shop_primary_color};
            }
            .wpcf7-form input.wpcf7-submit{
                border: 2px solid {$online_shop_primary_color};
            }
            .breadcrumb::after {
                border-left: 5px solid {$online_shop_primary_color};
            }
            /*header cart*/
            .site-header .widget_shopping_cart{
                border-bottom: 3px solid {$online_shop_primary_color};
                border-top: 3px solid {$online_shop_primary_color};
            }
            .site-header .widget_shopping_cart:before {
                border-bottom: 10px solid {$online_shop_primary_color};
            }
            .woocommerce-message {
                border-top-color: {$online_shop_primary_color};
            }"
        ;

        /*media width*/
        $custom_css .= "
        @media screen and (max-width:992px){
                .slicknav_btn{
                    border: 1px solid {$online_shop_primary_color};
                }
                .slicknav_btn.slicknav_open{
                    border: 1px solid #ffffff;
                }
                .slicknav_nav li.current-menu-ancestor > a,
                .slicknav_nav li.current-menu-item  > a,
                .slicknav_nav li.current_page_item > a,
                .slicknav_nav li.current_page_item .slicknav_item > span{
                    color: {$online_shop_primary_color};
                }
            }";

        /*Custom added*/
        $custom_css .= "
          .menu-right-highlight-text:after{
            border-top-color:{$online_shop_primary_color};
          }
          .woocommerce .woocommerce-MyAccount-navigation ul li.is-active a:after{
            border-left-color:{$online_shop_primary_color};
          }
          .woocommerce .woocommerce-MyAccount-navigation ul li.is-active a,
          .woocommerce .woocommerce-MyAccount-navigation ul li.is-active a:hover{
              background:{$online_shop_primary_color};

          }
        }";
        
	    /*category color*/
	    /*category color options*/
	    $args = array(
		    'orderby' => 'id',
		    'hide_empty' => 0
	    );
	    $categories = get_categories( $args );
	    $wp_category_list = array();
	    $i = 1;
	    foreach ($categories as $category_list ) {
	    	$cat_id = esc_attr($category_list->cat_ID);
		    $wp_category_list[$category_list->cat_ID] = $category_list->cat_name;

		    $cat_color = 'cat-'.esc_attr( get_cat_id($wp_category_list[$category_list->cat_ID]) );
		    $cat_hover_color = 'cat-hover-'.esc_attr( get_cat_id($wp_category_list[$category_list->cat_ID]) );

		    if( isset( $online_shop_customizer_all_values[$cat_color] )){
			    $cat_color = esc_attr( $online_shop_customizer_all_values[$cat_color] );
			    if( !empty( $cat_color )){
				    $custom_css .= "
                    .cat-links .at-cat-item-{$cat_id}{
                        color: {$cat_color};
                    }
                    ";

				    /*widget tittle*/
				    $custom_css .= "
                    .at-cat-color-wrap-{$cat_id} .at-title-action-wrapper::before,
                    body.category-{$cat_id} .page-header .page-title::before
                    {
                     border-bottom: 1.5px solid {$cat_color};
                    }
                    ";
			    }
		    }
		    else{
			    $custom_css .= "
                    .cat-links .at-cat-item-{$cat_id}{
                    color: {$online_shop_primary_color};
                    }
                    ";
		    }
		    if( isset( $online_shop_customizer_all_values[$cat_hover_color] )){
			    $cat_hover_color = esc_attr( $online_shop_customizer_all_values[$cat_hover_color] );
			    if( !empty( $cat_hover_color )){
				    $custom_css .= "
                    .cat-links .at-cat-item-{$cat_id}:hover{
                    color: {$cat_hover_color};
                    }
                    ";
			    }
		    }
		    else{
			    $custom_css .= "
                    .cat-links .at-cat-item-{$cat_id}:hover{
                    color: #2d2d2d;
                    }
                    ";
		    }
		    $i++;
	    }
	    /*category color end*/
        wp_add_inline_style( 'online-shop-style', $custom_css );
    }
endif;
add_action( 'wp_enqueue_scripts', 'online_shop_dynamic_css', 99 );