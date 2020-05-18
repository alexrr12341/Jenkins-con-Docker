<?php
/**
 * Class for adding Featured Column Section Widget
 *
 * @package Acme Themes
 * @subpackage Online Shop
 * @since 1.0.0
 */
if ( ! class_exists( 'Online_Shop_Featured_Page' ) ) {

    class Online_Shop_Featured_Page extends WP_Widget {
        /*defaults values for fields*/
        private function defaults(){
            /*defaults values for fields*/
            $defaults = array(
	            'online_shop_widget_title' => '',
                'first_page_id'      => '',
                'first_button_text'  => esc_html__( 'Shop Now', 'online-shop' ),
                'first_button_url'   => '',
                'second_page_id'     => '',
                'second_button_text' => esc_html__( 'Shop Now', 'online-shop' ),
                'second_button_url'  => ''
            );
            return $defaults;
        }

        function __construct() {
            parent::__construct(
            /*Base ID of your widget*/
                'online_shop_featured_page',
                /*Widget name will appear in UI*/
                esc_html__('AT Featured Section', 'online-shop'),
                /*Widget description*/
                array( 'description' => esc_html__( 'Select page and Show title, featured image and excerpt', 'online-shop' ), )
            );
        }

        /*Widget Backend*/
        public function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, $this->defaults() );

            /*default values*/
	        $online_shop_widget_title = esc_attr( $instance['online_shop_widget_title'] );
            $first_page_id = absint( $instance[ 'first_page_id' ] );
            $first_button_text = esc_attr( $instance[ 'first_button_text' ] );
            $first_button_url = esc_url( $instance[ 'first_button_url' ] );

	        $second_page_id = absint( $instance[ 'second_page_id' ] );
	        $second_button_text = esc_attr( $instance[ 'second_button_text' ] );
	        $second_button_url = esc_url( $instance[ 'second_button_url' ] );
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'online_shop_widget_title' ) ); ?>"><?php esc_html_e( 'Title', 'online-shop' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'online_shop_widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'online_shop_widget_title' ) ); ?>" type="text" value="<?php echo $online_shop_widget_title; ?>"/>
            </p>
            <div class="feature-first-promo">
                <p>
                    <label for="<?php echo esc_attr( $this->get_field_id( 'first_page_id' ) ); ?>"><?php esc_html_e( 'Select First Feature Page', 'online-shop' ); ?></label>
                    <br />
                    <small><?php esc_html_e( 'Select a Page which have featured image and excerpts.', 'online-shop' ); ?></small>
		            <?php
		            /* see more here https://codex.wordpress.org/Function_Reference/wp_dropdown_pages*/
		            $args = array(
			            'selected'              => $first_page_id,
			            'name'                  => esc_attr( $this->get_field_name( 'first_page_id' ) ),
			            'id'                    => esc_attr( $this->get_field_id( 'first_page_id' ) ),
			            'class'                 => 'widefat',
			            'show_option_none'      => esc_html__('Select Page','online-shop'),
			            'option_none_value'     => 0 // string
		            );
		            wp_dropdown_pages( $args );
		            ?>
                </p>
                <p>
                    <label for="<?php echo esc_attr( $this->get_field_id( 'first_button_text' ) ); ?>"><?php esc_html_e( 'First Button Text', 'online-shop' ); ?></label>
                    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'first_button_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'first_button_text' ) ); ?>" type="text" value="<?php echo $first_button_text; ?>" />
                </p>
                <p>
                    <label for="<?php echo esc_attr( $this->get_field_id( 'first_button_url' ) ); ?>"><?php esc_html_e( 'First Button Url', 'online-shop' ); ?></label>
                    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'first_button_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'first_button_url' ) ); ?>" type="text" value="<?php echo $first_button_url; ?>" />
                </p>
            </div>

            <div class="feature-second-promo">
                <p>
                    <label for="<?php echo esc_attr( $this->get_field_id( 'second_page_id' ) ); ?>"><?php esc_html_e( 'Select Second Feature Page', 'online-shop' ); ?></label>
                    <br />
                    <small><?php esc_html_e( 'Select a Page which have featured image and excerpts.', 'online-shop' ); ?></small>
			        <?php
			        /* see more here https://codex.wordpress.org/Function_Reference/wp_dropdown_pages*/
			        $args = array(
				        'selected'              => $second_page_id,
				        'name'                  => $this->get_field_name( 'second_page_id' ),
				        'id'                    => $this->get_field_id( 'second_page_id' ),
				        'class'                 => 'widefat',
				        'show_option_none'      => esc_html__('Select Page','online-shop'),
				        'option_none_value'     => 0 // string
			        );
			        wp_dropdown_pages( $args );
			        ?>
                </p>
                <p>
                    <label for="<?php echo esc_attr( $this->get_field_id( 'second_button_text' ) ); ?>"><?php esc_html_e( 'Second Button Text', 'online-shop' ); ?></label>
                    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'second_button_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'second_button_text' ) ); ?>" type="text" value="<?php echo $second_button_text; ?>" />
                </p>
                <p>
                    <label for="<?php echo esc_attr( $this->get_field_id( 'second_button_url' ) ); ?>"><?php esc_html_e( 'Second Button Url', 'online-shop' ); ?></label>
                    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'second_button_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'second_button_url' ) ); ?>" type="text" value="<?php echo $second_button_url; ?>" />
                </p>
            </div>
            <?php
        }

        /**
         * Function to Updating widget replacing old instances with new
         *
         * @access public
         * @since 1.0
         *
         * @param array $new_instance new arrays value
         * @param array $old_instance old arrays value
         * @return array
         *
         */
        public function update( $new_instance, $old_instance ) {
            $instance = $old_instance;

	        $instance[ 'online_shop_widget_title' ] = ( isset( $new_instance['online_shop_widget_title'] ) ) ? sanitize_text_field( $new_instance['online_shop_widget_title'] ) : '';

            $instance[ 'first_page_id' ] = absint( $new_instance[ 'first_page_id' ] );
            $instance[ 'first_button_text' ] = sanitize_text_field( $new_instance[ 'first_button_text' ] );
            $instance[ 'first_button_url' ] = esc_url_raw( $new_instance[ 'first_button_url' ] );

	        $instance[ 'second_page_id' ] = absint( $new_instance[ 'second_page_id' ] );
	        $instance[ 'second_button_text' ] = sanitize_text_field( $new_instance[ 'second_button_text' ] );
	        $instance[ 'second_button_url' ] = esc_url_raw( $new_instance[ 'second_button_url' ] );

            return $instance;
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
            $instance = wp_parse_args( (array) $instance, $this->defaults() );

	        $online_shop_widget_title = !empty( $instance['online_shop_widget_title'] ) ? esc_attr( $instance['online_shop_widget_title'] ) : '';
	        $online_shop_widget_title = apply_filters( 'widget_title', $online_shop_widget_title, $instance, $this->id_base );

            $first_page_id = absint( $instance[ 'first_page_id' ] );
            $first_button_text = esc_html( $instance[ 'first_button_text' ] );
            $first_button_url = esc_url( $instance[ 'first_button_url' ] );

	        $second_page_id = absint( $instance[ 'second_page_id' ] );
	        $second_button_text = esc_html( $instance[ 'second_button_text' ] );
	        $second_button_url = esc_url( $instance[ 'second_button_url' ] );

            echo $args['before_widget'];
	        if ( !empty( $online_shop_widget_title ) ){

		        echo $args['before_title'];
		        echo $online_shop_widget_title;
		        echo $args['after_title'];
	        }
	        ?>
            <div class="featured-entries-col featured-entries-page">
		        <?php
		        $post_in = array();
		        if( !empty( $first_page_id ) && 0 != $first_page_id ){
			        $post_in[] = $first_page_id;
                }
                if( !empty( $second_page_id ) && 0 != $second_page_id ){
		            $post_in[] = $second_page_id;
		        }

		        if( !empty( $post_in )) :
			        $query_args = array(
				        'post__in'         => $post_in,
				        'orderby'             => 'post__in',
				        'posts_per_page'      => count( $post_in ),
				        'post_type'           => 'page',
				        'no_found_rows'       => true,
				        'post_status'         => 'publish'
			        );
			        $online_shop_featured_query = new WP_Query( $query_args );
			        $total_post = $online_shop_featured_query->post_count;
			        $online_shop_featured_index = 1;

			        if( 2 == $total_post ){
				        $online_shop_list_classes = " acme-col-2";
			        }
			        else{
				        $online_shop_list_classes = " acme-col-1";
			        }
			        while ( $online_shop_featured_query->have_posts() ) :$online_shop_featured_query->the_post();
				        $online_shop_list_classes .= " index-".absint( $online_shop_featured_index );
				        if (has_post_thumbnail()) {
					        $image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full' );
				        } else {
					        $image_url[0] = get_template_directory_uri() . '/assets/img/default-image.jpg';
				        }
				        $bg_image_style = 'background-image:url(' . esc_url( $image_url[0] ) . ');background-repeat:no-repeat;background-size:cover;background-position:center;';
				        ?>
                        <div class="feature-promo <?php echo esc_attr( $online_shop_list_classes ); ?>">
                            <div class="no-media-query single-unit" style="<?php echo esc_attr( $bg_image_style ); ?>">
                                <div class="page-details">
                                    <h3 class="title">
		                                <?php the_title(); ?>
                                    </h3>
                                    <div class="details">
		                                <?php the_excerpt(); ?>
                                    </div>
	                                <?php
	                                if( 1 == $online_shop_featured_index ){
		                                if( !empty( $first_button_text ) ){
			                                echo '<div class="slider-buttons"><a href="'.$first_button_url.'" class="slider-button primary" '." ".'>'.$first_button_text.'</a></div>';
		                                }
	                                }
	                                if( 2 == $online_shop_featured_index ){
		                                if( !empty( $second_button_text ) ){
			                                echo '<div class="slider-buttons"><a href="'.$second_button_url.'" class="slider-button primary" '." ".'>'.$second_button_text.'</a></div>';
		                                }
	                                }
	                                ?>
                                </div>
                            </div>
                        </div><!--dynamic css-->
				        <?php
				        $online_shop_featured_index++;
			        endwhile;
			        wp_reset_postdata();
		        endif;
		        ?>
            </div>
            <?php
            echo $args['after_widget'];
        }
    } // Class Online_Shop_Featured_Page ends here
}