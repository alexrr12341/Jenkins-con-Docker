<?php
/**
 * Header top display options of elements
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return array $online_shop_header_top_display_selection
 *
 */
if ( !function_exists('online_shop_header_top_display_selection') ) :
	function online_shop_header_top_display_selection() {
		$online_shop_header_top_display_selection =  array(
			'hide' => esc_html__( 'Hide', 'online-shop' ),
			'left' => esc_html__( 'on Top Left', 'online-shop' ),
			'right' => esc_html__( 'on Top Right', 'online-shop' )
		);
		return apply_filters( 'online_shop_header_top_display_selection', $online_shop_header_top_display_selection );
	}
endif;

/**
 * online_shop_menu_right_button_link_options
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return array $online_shop_menu_right_button_link_options
 *
 */
if ( !function_exists('online_shop_menu_right_button_link_options') ) :
	function online_shop_menu_right_button_link_options() {
		$online_shop_menu_right_button_link_options =  array(
			'disable' => esc_html__( 'Disable', 'online-shop' ),
			'widget' => esc_html__( 'Widget on Popup', 'online-shop' ),
			'link' => esc_html__( 'Normal Link', 'online-shop' )
		);
		return apply_filters( 'online_shop_menu_right_button_link_options', $online_shop_menu_right_button_link_options );
	}
endif;

/**
 * Header Basic Info number
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return array $online_shop_header_bi_number
 *
 */
if ( !function_exists('online_shop_header_bi_number') ) :
	function online_shop_header_bi_number() {
		$online_shop_header_bi_number =  array(
			1 => esc_html__( '1', 'online-shop' ),
			2 => esc_html__( '2', 'online-shop' ),
			3 => esc_html__( '3', 'online-shop' ),
			4 => esc_html__( '4', 'online-shop' )
		);
		return apply_filters( 'online_shop_header_bi_number', $online_shop_header_bi_number );
	}
endif;

/**
 * Header Media Position options
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return array $online_shop_header_media_position
 *
 */
if ( !function_exists('online_shop_header_media_position') ) :
	function online_shop_header_media_position() {
		$online_shop_header_media_position =  array(
			'very-top' => esc_html__( 'Very Top', 'online-shop' ),
			'above-logo' => esc_html__( 'Above Site Identity', 'online-shop' ),
			'above-menu' => esc_html__( 'Below Site Identity and Above Menu', 'online-shop' ),
			'below-menu' => esc_html__( 'Below Menu', 'online-shop' )
		);
		return apply_filters( 'online_shop_header_media_position', $online_shop_header_media_position );
	}
endif;

/**
 * Header Site identity and ads display options
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return array $online_shop_header_logo_menu_display_position
 *
 */
if ( !function_exists('online_shop_header_logo_menu_display_position') ) :
	function online_shop_header_logo_menu_display_position() {
		$online_shop_header_logo_menu_display_position =  array(
			'left-logo-right-ads' => esc_html__( 'Left Logo and Right Ads', 'online-shop' ),
			'right-logo-left-ads' => esc_html__( 'Right Logo and Left Ads', 'online-shop' ),
			'center-logo-below-ads' => esc_html__( 'Center Logo and Below Ads', 'online-shop' )
		);
		return apply_filters( 'online_shop_header_logo_menu_display_position', $online_shop_header_logo_menu_display_position );
	}
endif;

/**
 * Feature Section Options
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return array $online_shop_feature_section_content_options
 *
 */
if ( !function_exists('online_shop_feature_section_content_options') ) :
	function online_shop_feature_section_content_options() {
		$online_shop_feature_section_content_options =  array(
			'disable' => esc_html__( 'Disable', 'online-shop' ),
			'post' => esc_html__( 'Post', 'online-shop' ),
		);
		if( online_shop_is_woocommerce_active() ){
			$online_shop_feature_section_content_options['product'] = esc_html__( 'Product', 'online-shop' );
		}
		return apply_filters( 'online_shop_feature_section_content_options', $online_shop_feature_section_content_options );
	}
endif;

/**
 * Featured Slider Image Options
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return array $online_shop_fs_image_display_options
 *
 */
if ( !function_exists('online_shop_fs_image_display_options') ) :
	function online_shop_fs_image_display_options() {
		$online_shop_fs_image_display_options =  array(
			'full-screen-bg' => esc_html__( 'Full Screen Background', 'online-shop' ),
			'responsive-img' => esc_html__( 'Responsive Image', 'online-shop' )
		);
		return apply_filters( 'online_shop_fs_image_display_options', $online_shop_fs_image_display_options );
	}
endif;

/**
 * Sidebar layout options
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return array $online_shop_sidebar_layout
 *
 */
if ( !function_exists('online_shop_sidebar_layout') ) :
    function online_shop_sidebar_layout() {
        $online_shop_sidebar_layout =  array(
	        'right-sidebar' => esc_html__( 'Right Sidebar', 'online-shop' ),
	        'left-sidebar'  => esc_html__( 'Left Sidebar' , 'online-shop' ),
	        'both-sidebar'  => esc_html__( 'Both Sidebar' , 'online-shop' ),
	        'middle-col'  => esc_html__( 'Middle Column' , 'online-shop' ),
	        'no-sidebar'    => esc_html__( 'No Sidebar', 'online-shop' )
        );
        return apply_filters( 'online_shop_sidebar_layout', $online_shop_sidebar_layout );
    }
endif;

/**
 * Blog layout options
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return array $online_shop_blog_layout
 *
 */
if ( !function_exists('online_shop_blog_layout') ) :
    function online_shop_blog_layout() {
        $online_shop_blog_layout =  array(
            'show-image' => esc_html__( 'Show Image', 'online-shop' ),
            'no-image'   => esc_html__( 'Hide Image', 'online-shop' )
        );
        return apply_filters( 'online_shop_blog_layout', $online_shop_blog_layout );
    }
endif;

/**
 * Reset Options
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return array
 *
 */
if ( !function_exists('online_shop_reset_options') ) :
    function online_shop_reset_options() {
        $online_shop_reset_options =  array(
            '0'  => esc_html__( 'Do Not Reset', 'online-shop' ),
            'reset-color-options'  => esc_html__( 'Reset Colors Options', 'online-shop' ),
            'reset-all' => esc_html__( 'Reset All', 'online-shop' )
        );
        return apply_filters( 'online_shop_reset_options', $online_shop_reset_options );
    }
endif;

/**
 * Breadcrumbs options
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return array
 *
 */
if ( !function_exists('online_shop_breadcrumbs_options') ) :
	function online_shop_breadcrumbs_options() {
		$online_shop_breadcrumbs_options =  array(
			'disable'  => esc_html__( 'Disable', 'online-shop' ),
			'default'  => esc_html__( 'Default', 'online-shop' )
		);
		if( online_shop_is_woocommerce_active() ){
			$online_shop_breadcrumbs_options['wc-breadcrumb'] = esc_html__( 'WC Breadcrumb', 'online-shop' );
		}
		return apply_filters( 'online_shop_breadcrumbs_options', $online_shop_breadcrumbs_options );
	}
endif;

/**
 * Blog Archive Display Options
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return array
 *
 */
if ( !function_exists('online_shop_blog_archive_category_display_options') ) :
	function online_shop_blog_archive_category_display_options() {
		$online_shop_blog_archive_category_display_options =  array(
			'default'  => esc_html__( 'Default', 'online-shop' ),
			'cat-color'  => esc_html__( 'Categories with Color', 'online-shop' )
		);
		return apply_filters( 'online_shop_blog_archive_category_display_options', $online_shop_blog_archive_category_display_options );
	}
endif;

/**
 * Related Post Display From Options
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return array
 *
 */
if ( !function_exists('online_shop_related_post_display_from') ) :
	function online_shop_related_post_display_from() {
		$online_shop_related_post_display_from =  array(
			'cat'  => esc_html__( 'Related Posts From Categories', 'online-shop' ),
			'tag'  => esc_html__( 'Related Posts From Tags', 'online-shop' )
		);
		return apply_filters( 'online_shop_related_post_display_from', $online_shop_related_post_display_from );
	}
endif;

/**
 * Image Size
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return array $online_shop_get_image_sizes_options
 *
 */
if ( !function_exists('online_shop_get_image_sizes_options') ) :
	function online_shop_get_image_sizes_options( $add_disable = false ) {
		global $_wp_additional_image_sizes;
		$choices = array();
		if ( true == $add_disable ) {
			$choices['disable'] = esc_html__( 'No Image', 'online-shop' );
		}
		foreach ( array( 'thumbnail', 'medium', 'large' ) as $key => $_size ) {
			$choices[ $_size ] = $_size . ' ('. get_option( $_size . '_size_w' ) . 'x' . get_option( $_size . '_size_h' ) . ')';
		}
		$choices['full'] = esc_html__( 'full (original)', 'online-shop' );
		if ( ! empty( $_wp_additional_image_sizes ) && is_array( $_wp_additional_image_sizes ) ) {

			foreach ($_wp_additional_image_sizes as $key => $size ) {
				$choices[ $key ] = $key . ' ('. $size['width'] . 'x' . $size['height'] . ')';
			}
		}
		return apply_filters( 'online_shop_get_image_sizes_options', $choices );
	}
endif;

/**
 *  Default Theme layout options
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return array $online_shop_theme_layout
 *
 */
if ( !function_exists('online_shop_get_default_theme_options') ) :
    function online_shop_get_default_theme_options() {

        $default_theme_options = array(

	        /*basic info*/
	        'online-shop-header-bi-number'  => 4,
	        'online-shop-first-info-icon'  => 'fa-volume-control-phone',
	        'online-shop-first-info-title'  => esc_html__('+00 123 456 789', 'online-shop'),
	        'online-shop-first-info-link'  => '',
	        'online-shop-second-info-icon'  => 'fa-envelope-o',
	        'online-shop-second-info-title'  => esc_html__('example@youremail.com', 'online-shop'),
	        'online-shop-second-info-link'  => '',
	        'online-shop-third-info-icon'  => 'fa-map-marker',
	        'online-shop-third-info-title'  => esc_html__('Our Location', 'online-shop'),
	        'online-shop-third-info-link'  => '',
	        'online-shop-forth-info-icon'  => 'fa-clock-o',
	        'online-shop-forth-info-title'  => esc_html__('Working Hours', 'online-shop'),
	        'online-shop-forth-info-link'  => '',
            
            /*feature section options*/
            'online-shop-feature-post-cat'  => 0,
            'online-shop-feature-product-cat'  => 0,
            'online-shop-feature-content-options'  => 'disable',
            'online-shop-feature-post-number'  => 3,
            'online-shop-feature-slider-display-cat'  => '',
            'online-shop-feature-slider-display-title'  => 1,
            'online-shop-feature-slider-display-excerpt'  => '',
            'online-shop-feature-slider-display-arrow'  => 1,
            'online-shop-feature-slider-enable-autoplay'  => 1,
            'online-shop-fs-image-display-options'  => 'full-screen-bg',
            'online-shop-feature-button-text'  => esc_html__('Shop Now', 'online-shop'),

            /*feature-right*/
	        'online-shop-feature-right-content-options'  => 'disable',
	        'online-shop-feature-right-post-cat'  => 0,
	        'online-shop-feature-right-product-cat'  => 0,
	        'online-shop-feature-right-post-number'  => 2,
	        'online-shop-feature-right-display-title'  => 1,
	        'online-shop-feature-right-display-arrow'  => '',
	        'online-shop-feature-right-enable-autoplay'  => 1,
	        'online-shop-feature-right-image-display-options'  => 'full-screen-bg',
	        'online-shop-feature-right-button-text'  => esc_html__('Shop Now', 'online-shop'),

	        /*feature special menu*/
	        'online-shop-feature-enable-special-menu'  => '',

	        /*header options*/
            'online-shop-enable-header-top'  => '',
            'online-shop-header-top-basic-info-display-selection'  => 'left',
            'online-shop-header-top-menu-display-selection'  => 'hide',
            'online-shop-header-top-social-display-selection'  => 'right',
            'online-shop-top-right-button-options'  => 'link',
            'online-shop-top-right-button-title'  => esc_html__('My Account', 'online-shop'),
            'online-shop-popup-widget-title'  => esc_html__('Popup Content', 'online-shop'),
            'online-shop-top-right-button-link'  => '',

	        /*header icons*/
	        'online-shop-enable-cart-icon'  => '',
	        'online-shop-enable-wishlist-icon'  => '',

            /*site identity*/
            'online-shop-display-site-logo'  => 1,
            'online-shop-display-site-title'  => 1,
            'online-shop-display-site-tagline'  => 1,

            /*Menu Options*/
	        'online-shop-enable-special-menu'  => '',
	        'online-shop-special-menu-text'  => esc_html__('Special Menu', 'online-shop'),

            'online-shop-menu-right-text'  => '',
            'online-shop-menu-right-highlight-text'  => '',
            'online-shop-menu-right-text-link'  => '',
            'online-shop-menu-right-link-new-tab'  => '',

	        'online-shop-enable-sticky-menu'  => '',

            /*social options*/
            'online-shop-social-data'  => '',

            /*media options*/
            'online-shop-header-media-position'  => 'above-menu',
            'online-shop-header-image-link'  => esc_url( home_url() ),
            'online-shop-header-image-link-new-tab'  => '',

            /*logo and menu*/
            'online-shop-header-logo-ads-display-position'  => 'left-logo-right-ads',

            /*footer options*/
            'online-shop-footer-copyright'  => esc_html__( 'Copyright &copy; All Right Reserved', 'online-shop' ),
	        'online-shop-enable-footer-power-text'  => 1,

            /*blog layout*/
            'online-shop-blog-archive-img-size' => 'full',
            'online-shop-blog-archive-more-text'  => esc_html__( 'Read More', 'online-shop' ),

	        /*layout/design options*/
            'online-shop-single-sidebar-layout'  => 'right-sidebar',
            'online-shop-front-page-sidebar-layout'  => 'right-sidebar',
            'online-shop-archive-sidebar-layout'  => 'right-sidebar',

            'online-shop-enable-sticky-sidebar'  => 1,
            'online-shop-blog-archive-layout'  => 'show-image',

            'online-shop-primary-color'  => '#f73838',
            'online-shop-cat-hover-color'  => '#2d2d2d',

	        /*single post options*/
            'online-shop-show-related'  => 1,
            'online-shop-related-title'  => esc_html__( 'Related posts', 'online-shop' ),
            'online-shop-related-post-display-from'  => 'cat',
            'online-shop-single-img-size'  => 'full',

            /*woocommerce*/
	        'online-shop-wc-shop-archive-sidebar-layout'  => 'no-sidebar',
	        'online-shop-wc-product-column-number'  => 4,
	        'online-shop-wc-shop-archive-total-product'  => 16,
	        'online-shop-wc-single-product-sidebar-layout'  => 'no-sidebar',

	        /*theme options*/
            'online-shop-search-placeholder'  => esc_html__( 'Search', 'online-shop' ),
            'online-shop-breadcrumb-options'  => 'default',

            'online-shop-hide-front-page-content'  => '',

            /*Reset*/
            'online-shop-reset-options'  => '0'
        );

        return apply_filters( 'online_shop_default_theme_options', $default_theme_options );
    }
endif;

/**
 * Get theme options
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return array online_shop_theme_options
 *
 */
if ( !function_exists('online_shop_get_theme_options') ) :
    function online_shop_get_theme_options() {

        $online_shop_default_theme_options = online_shop_get_default_theme_options();
        $online_shop_get_theme_options = get_theme_mod( 'online_shop_theme_options');
        if( is_array( $online_shop_get_theme_options )){
            return array_merge( $online_shop_default_theme_options, $online_shop_get_theme_options );
        }
        else{
            return $online_shop_default_theme_options;
        }
    }
endif;