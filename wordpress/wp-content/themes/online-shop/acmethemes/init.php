<?php
/**
 * Main include functions ( to support child theme )
 *
 * @since Online Shop 1.0.0
 *
 * @param string $file_path, path from the theme
 * @return string full path of file inside theme
 *
 */
if( !function_exists('online_shop_file_directory') ){

    function online_shop_file_directory( $file_path ){
        if( file_exists( trailingslashit( get_stylesheet_directory() ) . $file_path) ) {
            return trailingslashit( get_stylesheet_directory() ) . $file_path;
        }
        else{
            return trailingslashit( get_template_directory() ) . $file_path;
        }
    }
}

/**
 * Check empty or null
 *
 * @since Online Shop 1.0.0
 *
 * @param string $str, string
 * @return boolean
 *
 */
if( !function_exists('online_shop_is_null_or_empty') ){
	function online_shop_is_null_or_empty( $str ){
		return ( !isset($str) || trim($str)==='' );
	}
}

/*file for library*/
if ( ! class_exists( 'TGM_Plugin_Activation' ) ) {
	require_once online_shop_file_directory('acmethemes/library/tgm/class-tgm-plugin-activation.php');
}

/*
* file for customizer theme options
*/
require_once online_shop_file_directory('acmethemes/customizer/customizer.php');

/*
* file for additional functions files
*/
require_once online_shop_file_directory('acmethemes/functions.php');

require_once online_shop_file_directory('acmethemes/functions/header.php');

require_once online_shop_file_directory('acmethemes/functions/sidebar-selection.php');

/*woocommerce*/
require_once online_shop_file_directory('acmethemes/woocommerce/functions-woocommerce.php');

require_once online_shop_file_directory('acmethemes/woocommerce/class-woocommerce.php');

/*
* files for hooks
*/
require_once online_shop_file_directory('acmethemes/hooks/tgm.php');

require_once online_shop_file_directory('acmethemes/hooks/front-page.php');

require_once online_shop_file_directory('acmethemes/hooks/slider-selection.php');

require_once online_shop_file_directory('acmethemes/hooks/header.php');

require_once online_shop_file_directory('acmethemes/hooks/dynamic-css.php');

require_once online_shop_file_directory('acmethemes/hooks/footer.php');

require_once online_shop_file_directory('acmethemes/hooks/comment-forms.php');

require_once online_shop_file_directory('acmethemes/hooks/excerpts.php');

require_once online_shop_file_directory('acmethemes/hooks/related-posts.php');

require_once online_shop_file_directory('acmethemes/hooks/siteorigin-panels.php');

require_once online_shop_file_directory('acmethemes/hooks/acme-demo-setup.php');

require_once online_shop_file_directory('acmethemes/hooks/header-helper.php');

/*
* file for sidebar and widgets
*/
require_once online_shop_file_directory('acmethemes/sidebar-widget/acme-col-posts.php');

require_once online_shop_file_directory('acmethemes/sidebar-widget/acme-about.php');

require_once online_shop_file_directory('acmethemes/sidebar-widget/acme-logo.php');

require_once online_shop_file_directory('acmethemes/sidebar-widget/acme-featured-page.php');

require_once online_shop_file_directory('acmethemes/sidebar-widget/acme-social.php');

if ( online_shop_is_woocommerce_active() ) :
	require_once online_shop_file_directory('acmethemes/sidebar-widget/acme-wc-products.php');
	require_once online_shop_file_directory('acmethemes/sidebar-widget/acme-wc-cats.php');
	require_once online_shop_file_directory('acmethemes/sidebar-widget/acme-wc-cats-tabs.php');
	require_once online_shop_file_directory('acmethemes/sidebar-widget/acme-wc-search.php');
endif;

require_once online_shop_file_directory('acmethemes/sidebar-widget/sidebar.php');

/*
* file for core functions imported from functions.php while downloading Underscores
*/
require_once online_shop_file_directory('acmethemes/core.php');
require_once online_shop_file_directory('acmethemes/gutenberg/gutenberg-init.php');

/**
 * Implement Custom Metaboxes
 */
require_once online_shop_file_directory('acmethemes/metabox/meta-icons.php');
require_once online_shop_file_directory('acmethemes/metabox/metabox.php');

/*themes info*/
require_once online_shop_file_directory('acmethemes/at-theme-info/class-at-theme-info.php');