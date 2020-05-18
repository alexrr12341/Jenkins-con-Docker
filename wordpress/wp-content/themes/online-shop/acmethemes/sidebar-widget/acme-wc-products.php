<?php
/**
 * Custom columns of category with various options
 *
 * @package Acme Themes
 * @subpackage Online Shop
 * @since 1.0.0
 */
if ( ! class_exists( 'Online_Shop_Wc_Products' ) ) {
    /**
     * Class for adding widget
     *
     * @package Acme Themes
     * @subpackage Online_Shop_Wc_Products
     * @since 1.0.0
     */
    class Online_Shop_Wc_Products extends WP_Widget {

        /*defaults values for fields*/
        private $thumb;

        private $defaults = array(
	        'online_shop_widget_title' => '',
	        'wc_advanced_option' => 'recent',
            'online_shop_wc_product_cat' => -1,
            'online_shop_wc_product_tag' => -1,
            'post_number' => 4,
            'column_number' => 4,
            'display_type' => 'column',
	        'wc_cat_display_option' => 'disable',
	        'orderby' => 'date',
            'order' => 'DESC',
	        'view_all_option' => 'disable',
	        'all_link_text' => '',
	        'all_link_url' => '',
	        'enable_prev_next' => 1,
	        'online_shop_img_size' => 'shop_catalog'
        );

        function __construct() {
            parent::__construct(
            /*Base ID of your widget*/
                'online_shop_wc_products',
                /*Widget name will appear in UI*/
                esc_html__('AT WooCommerce Products', 'online-shop'),
                /*Widget description*/
                array( 'description' => esc_html__( 'Show WooCommerce Products with advanced options', 'online-shop' ), )
            );
        }
        /*Widget Backend*/
        public function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, $this->defaults);
	        $online_shop_widget_title = esc_attr( $instance['online_shop_widget_title'] );
	        $wc_advanced_option = esc_attr( $instance[ 'wc_advanced_option' ] );
	        $online_shop_wc_product_cat = esc_attr( $instance['online_shop_wc_product_cat'] );
	        $online_shop_wc_product_tag = esc_attr( $instance['online_shop_wc_product_tag'] );
	        $post_number = absint( $instance[ 'post_number' ] );
	        $column_number = absint( $instance[ 'column_number' ] );
	        $display_type = esc_attr( $instance[ 'display_type' ] );
	        $wc_cat_display_option = esc_attr( $instance[ 'wc_cat_display_option' ] );
	        $orderby = esc_attr( $instance[ 'orderby' ] );
	        $order = esc_attr( $instance[ 'order' ] );
	        $view_all_option = esc_attr( $instance[ 'view_all_option' ] );
	        $all_link_text = esc_attr( $instance['all_link_text'] );
	        $all_link_url = esc_url( $instance['all_link_url'] );
	        $enable_prev_next = esc_attr( $instance['enable_prev_next'] );
	        $online_shop_img_size = esc_attr( $instance['online_shop_img_size'] );

	        $choices = online_shop_get_image_sizes_options();
	        ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'online_shop_widget_title' ) ); ?>">
                    <?php esc_html_e( 'Title', 'online-shop' ); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'online_shop_widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'online_shop_widget_title' ) ); ?>" type="text" value="<?php echo $online_shop_widget_title; ?>" />
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'wc_advanced_option' ) ); ?>"><?php esc_html_e( 'Show', 'online-shop' ); ?></label>
                <select class="widefat at-wc-advanced-option" id="<?php echo esc_attr( $this->get_field_id( 'wc_advanced_option' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'wc_advanced_option' ) ); ?>" >
			        <?php
			        $wc_advanced_options = online_shop_wc_advanced_options();
			        foreach ( $wc_advanced_options as $key => $value ){
				        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $wc_advanced_option ); ?>><?php echo esc_attr( $value );?></option>
				        <?php
			        }
			        ?>
                </select>
            </p>
            <p class="wc-product-cat wc-select">
                <label for="<?php echo esc_attr( $this->get_field_id('online_shop_wc_product_cat') ); ?>">
                    <?php esc_html_e('Select Category', 'online-shop'); ?>
                </label>
                <?php
                $online_shop_dropown_cat = array(
                    'show_option_none'   => false,
                    'orderby'            => 'name',
                    'order'              => 'asc',
                    'show_count'         => 1,
                    'hide_empty'         => 1,
                    'echo'               => 1,
                    'selected'           => $online_shop_wc_product_cat,
                    'hierarchical'       => 1,
                    'name'               => $this->get_field_name('online_shop_wc_product_cat'),
                    'id'                 => $this->get_field_name('online_shop_wc_product_cat'),
                    'class'              => 'widefat',
                    'taxonomy'           => 'product_cat',
                    'hide_if_empty'      => false
                );
                wp_dropdown_categories( $online_shop_dropown_cat );
                ?>
            </p>
            <p class="wc-product-tag wc-select">
                <label for="<?php echo esc_attr( $this->get_field_id('online_shop_wc_product_tag') ); ?>">
			        <?php esc_html_e('Select Tag', 'online-shop'); ?>
                </label>
		        <?php
		        $online_shop_dropown_cat = array(
			        'show_option_none'   => false,
			        'orderby'            => 'name',
			        'order'              => 'asc',
			        'show_count'         => 1,
			        'hide_empty'         => 1,
			        'echo'               => 1,
			        'selected'           => $online_shop_wc_product_tag,
			        'hierarchical'       => 1,
			        'name'               => $this->get_field_name('online_shop_wc_product_tag'),
			        'id'                 => $this->get_field_name('online_shop_wc_product_tag'),
			        'class'              => 'widefat',
			        'taxonomy'           => 'product_tag',
			        'hide_if_empty'      => false
		        );
		        wp_dropdown_categories( $online_shop_dropown_cat );
		        ?>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'post_number' ) ); ?>">
			        <?php esc_html_e( 'Number of posts to show', 'online-shop' ); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_number' ) ); ?>" type="number" value="<?php echo $post_number; ?>" />
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'column_number' ) ); ?>"><?php esc_html_e( 'Column Number', 'online-shop' ); ?>:</label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'column_number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'column_number' ) ); ?>" >
			        <?php
			        $online_shop_widget_column_numbers = online_shop_widget_column_number();
			        foreach ( $online_shop_widget_column_numbers as $key => $value ){
				        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $column_number ); ?>><?php echo esc_attr( $value );?></option>
				        <?php
			        }
			        ?>
                </select>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'display_type' ) ); ?>">
                    <?php esc_html_e( 'Display Type', 'online-shop' ); ?>
                </label>
                <select class="widefat at-display-select" id="<?php echo esc_attr( $this->get_field_id( 'display_type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'display_type' ) ); ?>" >
			        <?php
			        $online_shop_widget_display_types = online_shop_widget_display_type();
			        foreach ( $online_shop_widget_display_types as $key => $value ){
				        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $display_type ); ?>><?php echo esc_attr( $value );?></option>
				        <?php
			        }
			        ?>
                </select>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'wc_cat_display_option' ) ); ?>">
			        <?php esc_html_e( 'Selected Category Options', 'online-shop' ); ?>
                </label>
                <select class="widefat at-display-select" id="<?php echo esc_attr( $this->get_field_id( 'wc_cat_display_option' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'wc_cat_display_option' ) ); ?>" >
			        <?php
			        $wc_cat_display_options = online_shop_wc_cat_display_options();
			        foreach ( $wc_cat_display_options as $key => $value ){
				        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $wc_cat_display_option ); ?>><?php echo esc_attr( $value );?></option>
				        <?php
			        }
			        ?>
                </select>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>">
			        <?php esc_html_e( 'Order by', 'online-shop' ); ?>
                </label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>" >
			        <?php
			        $online_shop_wc_product_orderby = online_shop_wc_product_orderby();
			        foreach ( $online_shop_wc_product_orderby as $key => $value ){
				        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $orderby ); ?>><?php echo esc_attr( $value );?></option>
				        <?php
			        }
			        ?>
                </select>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>">
			        <?php esc_html_e( 'Order by', 'online-shop' ); ?>
                </label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>" >
			        <?php
			        $online_shop_post_order = online_shop_post_order();
			        foreach ( $online_shop_post_order as $key => $value ){
				        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $order ); ?>><?php echo esc_attr( $value );?></option>
				        <?php
			        }
			        ?>
                </select>
            </p>
            <hr /><!--view all link separate-->
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'view_all_option' ) ); ?>">
			        <?php esc_html_e( 'View all options', 'online-shop' ); ?>
                </label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'view_all_option' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'view_all_option' ) ); ?>" >
			        <?php
			        $online_shop_adv_link_options = online_shop_adv_link_options();
			        foreach ( $online_shop_adv_link_options as $key => $value ){
				        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $view_all_option ); ?>><?php echo esc_attr( $value );?></option>
				        <?php
			        }
			        ?>
                </select>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'all_link_text' ) ); ?>">
			        <?php esc_html_e( 'All Link Text', 'online-shop' ); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'all_link_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'all_link_text' ) ); ?>" type="text" value="<?php echo $all_link_text; ?>" />
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'all_link_url' ) ); ?>">
			        <?php esc_html_e( 'All Link Url', 'online-shop' ); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'all_link_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'all_link_url' ) ); ?>" type="text" value="<?php echo $all_link_url; ?>" />
            </p>
            <hr />

            <p class="at-enable-prev-next">
                <input id="<?php echo esc_attr( $this->get_field_id( 'enable_prev_next' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'enable_prev_next' ) ); ?>" type="checkbox" <?php checked( 1 == $enable_prev_next ? $instance['enable_prev_next'] : 0); ?> />
                <label for="<?php echo esc_attr( $this->get_field_id( 'enable_prev_next' ) ); ?>"><?php esc_html_e( 'Enable Prev - Next on Carousel Column', 'online-shop' ); ?></label>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'online_shop_img_size' ) ); ?>">
			        <?php esc_html_e( 'Normal Featured Post Image', 'online-shop' ); ?>
                </label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'online_shop_img_size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'online_shop_img_size' ) ); ?>">
			        <?php
			        foreach( $choices as $key => $online_shop_column_array ){
				        echo ' <option value="'.esc_attr( $key ).'" '.selected( $online_shop_img_size, $key, 0). '>'.esc_attr( $online_shop_column_array ) .'</option>';
			        }
			        ?>
                </select>
            </p>
            <p>
                <small><?php esc_html_e( 'Note: Some of the features only work in "Home main content area" due to minimum width in other areas.' ,'online-shop'); ?></small>
            </p>
            <?php
        }

        /**
         * Function to Updating widget replacing old instances with new
         *
         * @access public
         * @since 1.0.0
         *
         * @param array $new_instance new arrays value
         * @param array $old_instance old arrays value
         * @return array
         *
         */
        public function update( $new_instance, $old_instance ) {
            $instance = array();
	        $instance[ 'online_shop_widget_title' ] = ( isset( $new_instance['online_shop_widget_title'] ) ) ? sanitize_text_field( $new_instance['online_shop_widget_title'] ) : '';

	        $wc_advanced_options = online_shop_wc_advanced_options();
	        $instance[ 'wc_advanced_option' ] = online_shop_sanitize_choice_options( $new_instance[ 'wc_advanced_option' ], $wc_advanced_options, 'recent' );


	        $instance[ 'online_shop_wc_product_cat' ] = ( isset( $new_instance['online_shop_wc_product_cat'] ) ) ? absint( $new_instance['online_shop_wc_product_cat'] ) : '';
	        $instance[ 'online_shop_wc_product_tag' ] = ( isset( $new_instance['online_shop_wc_product_tag'] ) ) ? absint( $new_instance['online_shop_wc_product_tag'] ) : '';
	        $instance[ 'post_number' ] = absint( $new_instance[ 'post_number' ] );
	        $instance[ 'column_number' ] = absint( $new_instance[ 'column_number' ] );

	        $online_shop_widget_display_types = online_shop_widget_display_type();
	        $instance[ 'display_type' ] = online_shop_sanitize_choice_options( $new_instance[ 'display_type' ], $online_shop_widget_display_types, 'column' );

	        $wc_cat_display_options = online_shop_wc_cat_display_options();
	        $instance[ 'wc_cat_display_option' ] = online_shop_sanitize_choice_options( $new_instance[ 'wc_cat_display_option' ], $wc_cat_display_options, 'disable' );

	        $online_shop_wc_product_orderby = online_shop_wc_product_orderby();
	        $instance[ 'orderby' ] = online_shop_sanitize_choice_options( $new_instance[ 'orderby' ], $online_shop_wc_product_orderby, 'date' );

	        $online_shop_post_order = online_shop_post_order();
	        $instance[ 'order' ] = online_shop_sanitize_choice_options( $new_instance[ 'order' ], $online_shop_post_order, 'DESC' );

	        $online_shop_link_options = online_shop_adv_link_options();
	        $instance[ 'view_all_option' ] = online_shop_sanitize_choice_options( $new_instance[ 'view_all_option' ], $online_shop_link_options, 'disable' );

	        $instance[ 'all_link_text' ] = sanitize_text_field( $new_instance[ 'all_link_text' ] );
	        $instance[ 'all_link_url' ] = esc_url_raw( $new_instance[ 'all_link_url' ] );
	        $instance[ 'enable_prev_next' ] = isset($new_instance['enable_prev_next'])? 1 : 0;

	        $online_shop_img_size = online_shop_get_image_sizes_options();
	        $instance[ 'online_shop_img_size' ] = online_shop_sanitize_choice_options( $new_instance[ 'online_shop_img_size' ], $online_shop_img_size, 'large' );

            return $instance;
        }

        function single_product_archive_thumbnail_size(){
            return $this->thumb;
        }

        /**
         * Function to Creating widget front-end. This is where the action happens
         *
         * @access public
         * @since 1.0.0
         *
         * @param array $args widget setting
         * @param array $instance saved values
         * @return void
         *
         */
        public function widget($args, $instance) {
            $instance = wp_parse_args( (array) $instance, $this->defaults);
	        $wc_advanced_option = esc_attr( $instance[ 'wc_advanced_option' ] );
	        $online_shop_wc_product_cat = esc_attr( $instance['online_shop_wc_product_cat'] );
	        $online_shop_wc_product_tag = esc_attr( $instance['online_shop_wc_product_tag'] );
	        $online_shop_widget_title = !empty( $instance['online_shop_widget_title'] ) ? esc_attr( $instance['online_shop_widget_title'] ) : '';
	        $online_shop_widget_title = apply_filters( 'widget_title', $online_shop_widget_title, $instance, $this->id_base );
	        $post_number = absint( $instance[ 'post_number' ] );
	        $column_number = absint( $instance[ 'column_number' ] );
	        $display_type = esc_attr( $instance[ 'display_type' ] );
	        $wc_cat_display_option = esc_attr( $instance[ 'wc_cat_display_option' ] );
	        $orderby = esc_attr( $instance[ 'orderby' ] );
	        $order = esc_attr( $instance[ 'order' ] );
	        $view_all_option = esc_attr( $instance[ 'view_all_option' ] );
	        $all_link_text = esc_html( $instance[ 'all_link_text' ] );
	        $all_link_url = esc_url( $instance[ 'all_link_url' ] );
	        $enable_prev_next = esc_attr( $instance['enable_prev_next'] );
	        $this->thumb = $online_shop_img_size = esc_attr( $instance['online_shop_img_size'] );

	        $product_visibility_term_ids = wc_get_product_visibility_term_ids();

	        /**
             * Filter the arguments for the Recent Posts widget.
             *
             * @since 1.0.0
             *
             * @see WP_Query
             *
             */
	        $query_args = array(
		        'posts_per_page' => $post_number,
		        'post_status'    => 'publish',
		        'post_type'      => 'product',
		        'no_found_rows'  => 1,
		        'order'          => $order,
		        'meta_query'     => array(),
		        'tax_query'      => array(
			        'relation' => 'AND',
		        ),
	        );

	        switch ( $wc_advanced_option ) {

		        case 'featured' :
		            if( !empty( $product_visibility_term_ids['featured'] )){
			            $query_args['tax_query'][] = array(
				            'taxonomy' => 'product_visibility',
				            'field'    => 'term_taxonomy_id',
				            'terms'    => $product_visibility_term_ids['featured'],
			            );
                    }

			        break;

		        case 'onsale' :
			        $product_ids_on_sale    = wc_get_product_ids_on_sale();
			        if( !empty( $product_ids_on_sale ) ){
			            $query_args['post__in'] = $product_ids_on_sale;
                    }
			        break;

		        case 'cat' :
		            if( !empty( $online_shop_wc_product_cat )){
			            $query_args['tax_query'][] = array(
				            'taxonomy' => 'product_cat',
				            'field'    => 'term_id',
				            'terms'    => $online_shop_wc_product_cat,
			            );
                    }

			        break;

		        case 'tag' :
		            if( !empty( $online_shop_wc_product_tag )){
			            $query_args['tax_query'][] = array(
				            'taxonomy' => 'product_tag',
				            'field'    => 'term_id',
				            'terms'    => $online_shop_wc_product_tag,
			            );
                    }

			        break;
	        }

	        switch ( $orderby ) {

		        case 'price' :
			        $query_args['meta_key'] = '_price';
			        $query_args['orderby']  = 'meta_value_num';
			        break;

		        case 'sales' :
			        $query_args['meta_key'] = 'total_sales';
			        $query_args['orderby']  = 'meta_value_num';
			        break;

		        case 'ID' :
		        case 'author' :
		        case 'title' :
		        case 'date' :
		        case 'modified' :
		        case 'rand' :
		        case 'comment_count' :
		        case 'menu_order' :
		            $query_args['orderby']  = $orderby;
			        break;

		        default :
			        $query_args['orderby']  = 'date';
	        }

            $online_shop_featured_query = new WP_Query( $query_args );

            if ($online_shop_featured_query->have_posts()) :
                echo $args['before_widget'];
	            if ( !empty( $online_shop_widget_title ) ||
                     'disable' != $view_all_option ||
                     ( 1 == $enable_prev_next && 'carousel' == $display_type )
                ){
		            if( -1 != $online_shop_wc_product_cat ){
			            echo "<div class='at-cat-color-wrap-".esc_attr( $online_shop_wc_product_cat )."'>";
		            }
	                echo $args['before_title'];
		            echo $online_shop_widget_title;
		            echo "<span class='at-action-wrapper'>";
		            if( 'disable' != $view_all_option && !empty( $all_link_text ) && !empty( $all_link_url )){
			            $target ='';
		                if( 'new-tab-link' == $view_all_option ){
		                    $target = 'target="_blank"';
                        }
		                echo '<a href="'.$all_link_url.'" class="all-link" '.$target.'>'.$all_link_text.'</a>';
                    }

		            if( 1 == $enable_prev_next && 'carousel' == $display_type){
		                echo '<i class="prev fa fa-angle-left"></i><i class="next fa fa-angle-right"></i>';
                    }
		            echo "</span>";/*.at-action-wrapper*/

		            echo $args['after_title'];
		            if( -1 != $online_shop_wc_product_cat ){
			            echo "</div>";
		            }
	            }
	            $div_attr = 'class="featured-entries-col woocommerce '.$display_type.'"';
	            if( 'carousel' == $display_type ){
		            $div_attr = 'class="featured-entries-col woocommerce acme-slick-carausel" data-column="'.absint( $column_number ).'"';
	            }
	            if( 'disable' != $wc_cat_display_option && 'cat' == $wc_advanced_option ){
		            $taxonomy = 'product_cat';
		            $term_id = absint($online_shop_wc_product_cat);
		            $term_link = get_term_link( $term_id, $taxonomy );
		            $term = get_term( $term_id, $taxonomy );
		            $thumbnail_id = get_term_meta( $term_id, 'thumbnail_id', true);
		            if ( !empty( $thumbnail_id ) ) {
			            $image_url = wp_get_attachment_image_src($thumbnail_id, 'full');
		            }
		            else{
			            $image_url[0] =  get_template_directory_uri() . '/assets/img/default-image.jpg';
		            }
		            ?>
                    <div class="at-cat-product-wrap clearfix <?php echo esc_attr( $wc_cat_display_option ); ?>">
                    <div class="at-cat-block">
                        <div class="at-cat-bg" style="background-image:url(<?php echo esc_url( $image_url[0] );?>);">
                            <a href="<?php echo esc_url($term_link); ?>" class="at-overlay"></a>
                            <div class="product-details">
		                        <?php if( !empty( $term->name ) ) {
		                            ?>
                                    <h3>
                                        <a href="<?php echo esc_url( $term_link ); ?>">
					                        <?php echo esc_html( $term->name ); ?>
                                        </a>
                                    </h3>
		                        <?php
		                        }
		                        ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div <?php echo $div_attr;?>>
	                <?php
	                $online_shop_featured_index = 1;
	                while ( $online_shop_featured_query->have_posts() ) :$online_shop_featured_query->the_post();
                        global $product;
                        // Ensure visibility.
                        if ( empty( $product ) || ! $product->is_visible() ) {
                            continue;
                        }
		                $online_shop_list_classes = 'single-list';
		                if( 'carousel' != $display_type ){
			                if( 1 != $online_shop_featured_index && $online_shop_featured_index % $column_number == 1 ){
				                echo "<div class='clearfix'></div>";
			                }
			                if( 1 == $column_number ){
				                $online_shop_list_classes .= " acme-col-1";
			                }
                            elseif( 2 == $column_number ){
				                $online_shop_list_classes .= " acme-col-2";
			                }
                            elseif( 3 == $column_number ){
				                $online_shop_list_classes .= " acme-col-3";
			                }
			                else{
				                $online_shop_list_classes .= " acme-col-4";
			                }
		                }
		                ?>
                        <div class="<?php echo esc_attr( $online_shop_list_classes ); ?>">
                            <ul class="post-container products">
                                <?php
                                /*single_product_archive_thumbnail_size*/
                                add_filter( 'single_product_archive_thumbnail_size', array( $this, 'single_product_archive_thumbnail_size' ) );

                                wc_get_template_part( 'content', 'product' );

                                remove_filter( 'single_product_archive_thumbnail_size', array( $this, 'single_product_archive_thumbnail_size' ) );
                                ?>
                            </ul><!--.post-container-->
                        </div><!--dynamic css-->
		                <?php
		                $online_shop_featured_index++;
	                endwhile;
	                ?>
                </div><!--featured entries-col-->
                <?php
	            if( 'disable' != $wc_cat_display_option && 'cat' == $wc_advanced_option ){
		            ?>
                    </div><!--cat product wrap-->
		            <?php
	            }
                echo $args['after_widget'];
                echo "<div class='clearfix'></div>";
                // Reset the global $the_post as this query will have stomped on it
            endif;
	        wp_reset_postdata();
        }
    } // Class Online_Shop_Wc_Products ends here
}