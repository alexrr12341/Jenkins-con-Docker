<div class="advance-product-search">
	<form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php
		global $online_shop_search_placeholder;
        $terms = get_terms( array(
            'taxonomy'   => 'product_cat',
            'hide_empty' => true,
            'parent'     => 0,
        ) );
		if (  ! empty( $terms ) && ! is_wp_error( $terms ) ) : ?>
			<?php $current = ( isset( $_GET['product_category'] ) ) ? esc_attr( $_GET['product_category'] ) : '' ; ?>
            <select class="select_products" name="product_category">
                <option value=""><?php esc_html_e( 'All Categories', 'online-shop' ); ?></option>
				<?php foreach ( $terms as $cat ) : ?>
                    <option value="<?php echo esc_attr( $cat->name ); ?>" <?php selected( $current, $cat->name ); ?> ><?php echo esc_attr( $cat->name ); ?></option>
				<?php endforeach; ?>
            </select>
		<?php endif; ?>
        <input type="search" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="search-field" placeholder="<?php echo esc_attr( $online_shop_search_placeholder ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
        <button class="fa fa-search searchsubmit" type="submit"></button>
        <input type="hidden" name="post_type" value="product" />
    </form><!-- .woocommerce-product-search -->
</div><!-- .advance-product-search -->