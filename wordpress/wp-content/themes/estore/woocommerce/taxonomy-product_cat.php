<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' );

$estore_layout = function_exists( 'estore_woocommerce_layout_class' ) ? estore_woocommerce_layout_class() : '';

$categoryobj = get_queried_object();
$cat_ID      = $categoryobj->term_id;
?>

<div id="content" class="site-content estore-cat-color_<?php echo $cat_ID; ?>">

    <div class="page-header clearfix">
        <div class="tg-container">
			<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

                <h1 class="entry-title"><?php woocommerce_page_title(); ?></h1>

			<?php endif;

			/**
			 * woocommerce_archive_description hook
			 *
			 * @hooked woocommerce_taxonomy_archive_description - 10
			 * @hooked woocommerce_product_archive_description - 10
			 */
			do_action( 'woocommerce_archive_description' );
			?>
            <h3 class="entry-sub-title"><?php woocommerce_breadcrumb(); ?></h3>
        </div>
    </div>

    <main id="main" class="clearfix <?php echo esc_attr( $estore_layout ); ?>">
        <div class="tg-container">
			<?php
			/**
			 * woocommerce_before_main_content hook
			 *
			 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
			 * @hooked woocommerce_breadcrumb - 20
			 * Removed woocommerce_breadcrumb. See inc/woocommerce.php
			 *
			 */
			do_action( 'woocommerce_before_main_content' );

			if ( have_posts() ) :

				/**
				 * Hook: woocommerce_before_shop_loop.
				 *
				 * @hooked wc_print_notices - 10
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );

				woocommerce_product_loop_start();

				if ( ! estore_woo_version_check( '3.3.0' ) ) :
					woocommerce_product_subcategories();
				endif;

				if ( ! function_exists( 'wc_get_loop_prop' ) || wc_get_loop_prop( 'total' ) ) :
					while ( have_posts() ) : the_post();

						/**
						 * Hook: woocommerce_shop_loop.
						 *
						 * @hooked WC_Structured_Data::generate_product_data() - 10
						 */
						do_action( 'woocommerce_shop_loop' );

						wc_get_template_part( 'content', 'product' );
					endwhile; // end of the loop.
				endif;

				woocommerce_product_loop_end();

				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );

            elseif ( ! woocommerce_product_subcategories( array(
				'before' => woocommerce_product_loop_start( false ),
				'after'  => woocommerce_product_loop_end( false )
			) ) ) :
				wc_get_template( 'loop/no-products-found.php' );
			endif;

			/**
			 * woocommerce_after_main_content hook
			 *
			 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
			 */
			do_action( 'woocommerce_after_main_content' );

			/**
			 * woocommerce_sidebar hook
			 *
			 * @hooked woocommerce_get_sidebar - 10
			 */
			do_action( 'woocommerce_sidebar' );
			?>
        </div>
    </main>

</div>

<?php get_footer( 'shop' ); ?>
