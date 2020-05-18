<?php
/**
 * Online Shop WooCommerce Class
 *
 * @package  Online Shop
 * @author   Acme Themes
 * @since    1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Online_Shop_WooCommerce' ) ) :

	/**
	 * The Online Shop WooCommerce Integration class
	 */
	class Online_Shop_WooCommerce {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			add_filter( 'body_class', 								array( $this, 'woocommerce_body_class' ) );
			add_filter( 'loop_shop_per_page', 						array( $this, 'products_per_page' ) );
			add_filter( 'woocommerce_breadcrumb_defaults',          array( $this,'change_breadcrumb_delimiter' ) );

			/*templates*/
			remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
			remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
			add_action( 'woocommerce_before_main_content', array( $this, 'before_main_content' ), 10 );
			add_action( 'woocommerce_after_main_content', array( $this, 'after_main_content' ), 10 );

			/**
			 * Remove WooCommerce Default Sidebar
			 */
			remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
			add_action( 'woocommerce_sidebar', array( $this, 'woocommerce_get_sidebar' ), 10 );
		}

		/**
		 * Add 'woocommerce-active' class to the body tag
		 *
		 * @param  array $classes css classes applied to the body tag.
		 * @return array $classes modified to include 'woocommerce-active' class
		 */
		public function woocommerce_body_class( $classes ) {
			if ( online_shop_is_woocommerce_active() ) {
				$classes[] = 'woocommerce-active';
			}

			return $classes;
		}

		/**
		 * Products per page
		 *
		 * @return integer number of products
		 * @since  1.0.0
		 */
		public function products_per_page() {
			return intval( apply_filters( 'online_shop_filter_products_per_page', 12 ) );
		}

		/**
		 * Remove the breadcrumb delimiter
		 * @param  array $defaults thre breadcrumb defaults
		 * @return array           thre breadcrumb defaults
		 * @since 2.2.0
		 */
		public function change_breadcrumb_delimiter( $defaults ) {
			$defaults['delimiter'] = '<span class="breadcrumb-separator"> / </span>';
			return $defaults;
		}

		/**
		 * Woocommerce wrapper start.
		 *
		 * @since 1.0.0
		 */
		function before_main_content() {
			echo '<div id="primary" class="content-area">';
			echo '<main id="main" class="site-main">';
		}

		/**
		 * Woocommerce wrapper end.
		 *
		 * @since 1.0.0
		 */
		function after_main_content() {
			echo '</main><!-- #main -->';
			echo '</div><!-- #primary -->';
		}

		/**
		 * Add 'woocommerce sideabar
		 */
		public function woocommerce_get_sidebar( ) {
			get_sidebar( 'left' );
			get_sidebar();
		}
	}
endif;
return new Online_Shop_WooCommerce();