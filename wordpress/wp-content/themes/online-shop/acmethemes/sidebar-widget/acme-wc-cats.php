<?php
/**
 * Feature Section Types
 * Two different types
 * @package Acme Themes
 * @subpackage Online Shop
 * @since 1.0.0
 */
if ( ! function_exists( 'online_shop_wc_feature_type_default' ) ) :
	function online_shop_wc_feature_type_default( $online_shop_featured_cats, $term_per_slide, $online_shop_img_size, $number_of_product_text ){
		$i = 1;
		$j = 1;
		$total_items = count( $online_shop_featured_cats );
		$remaining_items = $total_items;

		$current_slide_number = 1;
		$online_shop_slider_display_options = $term_per_slide;

		$total_posts = $online_shop_slider_display_options;
		if( $online_shop_slider_display_options > $remaining_items ){
			$total_posts = $remaining_items;
		}

		$fixed ='';
		if( $remaining_items < $online_shop_slider_display_options || $online_shop_slider_display_options < 3 ){
			$fixed = 'fix remain-'.$remaining_items;
		}

		echo "<div class='at-unique-slide ".esc_attr( $fixed )."'>";
		foreach ( $online_shop_featured_cats as $term_id => $value ) {
			$taxonomy = 'product_cat';
			$term = get_term_by( 'id', $term_id, $taxonomy );
			if ( $term && ! is_wp_error( $term ) ) {
				$term_link = get_term_link( $term_id, $taxonomy );
				$term_name = $term->name;
				$total_product = $term->count;
				$thumbnail_id = get_term_meta( $term_id, 'thumbnail_id', true );
				$image_url = wp_get_attachment_image_src( $thumbnail_id, $online_shop_img_size );
				if ( !$image_url ) {
					$image_url[0] =  get_template_directory_uri() . '/assets/img/default-image.jpg';
				}
				if( $j > $online_shop_slider_display_options ){
					if( $online_shop_slider_display_options == 1 || $j % $online_shop_slider_display_options == 1 ){
						$current_slide_number = $current_slide_number + 1;
						$remaining_items = $remaining_items - $online_shop_slider_display_options;
						if( $online_shop_slider_display_options > $remaining_items ){
							$total_posts = $remaining_items;
						}
						$fixed ='';
						if( $remaining_items < $online_shop_slider_display_options || $online_shop_slider_display_options < 3 )
							if( $remaining_items < $online_shop_slider_display_options ){
								$fixed = 'fix remain-'.$remaining_items;
							}
						$i = 1;
						echo "</div><div class='at-unique-slide ".esc_attr( $fixed )."'>";
					}
				}
				$col = 'acme-col-1';
				if( 1 == $total_posts ){
					$col = 'at-extra-height acme-col-1';
				}
                elseif( 2 == $total_posts ){
					$col = 'at-extra-height acme-col-2';
				}
                elseif( 3 == $total_posts ){
					$col = 'acme-col-2';
					if( $i == 3 ){
						echo "<div class='clearfix'></div>";
						$col = 'acme-col-1';
					}
				}
                elseif( 4 == $total_posts ){
					$col = 'acme-col-2';
				}
                elseif( 5 == $total_posts ){
					$col = 'acme-col-2';
					if( $i > 2 ){
						$col = 'acme-col-3';
					}
				}
                elseif( 6 == $total_posts ){
					$col = 'acme-col-3';
				}
				?>
                <div class="single-list <?php echo esc_attr( $col ).' atsi-'.absint( $i ); ?>">
                    <div class="no-media-query single-unit" style="background-image:url(<?php echo esc_url( $image_url[0] ); ?>);">
                        <a class="at-overlay" href="<?php echo esc_url( $term_link ); ?>"></a>
                        <div class="cat-details">
                            <a href="<?php echo esc_url( $term_link ); ?>">
                                <div class="cat-title">
                                    <h3><?php echo esc_html( $term_name ); ?></h3>
                                    <span><?php echo esc_html( $total_product ).' '.esc_html( $number_of_product_text ); ?> </span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
				<?php
				$i++;
				$j++;
			}
		}
		echo "</div>";/*at-unique-slide at-custom-slide*/
	}
endif;

if ( ! function_exists( 'online_shop_wc_feature_type_two' ) ) :
	function online_shop_wc_feature_type_two( $online_shop_featured_cats, $term_per_slide, $online_shop_img_size, $number_of_product_text ){
		$i = 1;
		$j = 1;
		$total_items = count( $online_shop_featured_cats );
		$remaining_items = $total_items;

		$current_slide_number = 1;
		$online_shop_slider_display_options = $term_per_slide;

		$total_posts = $online_shop_slider_display_options;
		if( $online_shop_slider_display_options > $remaining_items ){
			$total_posts = $remaining_items;
		}

		$fixed ='';
		$closed = 1;
		if( $remaining_items < $online_shop_slider_display_options || $online_shop_slider_display_options < 3 ){
			$fixed = 'fix remain-'.$remaining_items;
		}

		echo "<div class='at-unique-slide ".esc_attr( $fixed )."'>";
		foreach ( $online_shop_featured_cats as $term_id => $value ) {
			$taxonomy = 'product_cat';
			$term = get_term_by( 'id', $term_id, $taxonomy );
			if ( $term && ! is_wp_error( $term ) ) {
				$term_link = get_term_link( $term_id, $taxonomy );
				$term_name = $term->name;
				$total_product = $term->count;
				$thumbnail_id = get_term_meta( $term_id, 'thumbnail_id', true );
				$image_url = wp_get_attachment_image_src( $thumbnail_id, $online_shop_img_size );
				if ( !$image_url ) {
					$image_url[0] =  get_template_directory_uri() . '/assets/img/default-image.jpg';
				}
				if( $j > $online_shop_slider_display_options ){
					if( $online_shop_slider_display_options == 1 || $j % $online_shop_slider_display_options == 1 ){
						$current_slide_number = $current_slide_number + 1;
						$remaining_items = $remaining_items - $online_shop_slider_display_options;
						if( $online_shop_slider_display_options > $remaining_items ){
							$total_posts = $remaining_items;
						}
						$fixed ='';
						if( $remaining_items < $online_shop_slider_display_options || $online_shop_slider_display_options < 3 )
							if( $remaining_items < $online_shop_slider_display_options ){
								$fixed = 'fix remain-'.$remaining_items;
							}
						$i = 1;
						echo "</div><div class='at-unique-slide ".esc_attr( $fixed )."'>";
					}
				}
				$col = 'acme-col-1';

				/*first post slide*/
				if( $i == 1 ){
					/*open left wrapper div*/
					echo "<div class='left'>";
					if( 1 == $total_posts ){
						$col = 'at-extra-height at-extra-width acme-col-1';
					}
					else{
						$col = 'at-extra-height acme-col-1';
					}
				}
				else{
					/*close left wrapper and open right wrapper*/
					if( $i == 2 ){
						echo "</div>";
						echo "<div class='right'>";
					}

					if( 2 == $total_posts ){
						$col = 'at-extra-height acme-col-1';
					}
                    elseif( 3 == $total_posts ){
						$col = 'acme-col-1';
					}
                    elseif( 4 == $total_posts ){
						if( $i == 2 ){
							$col = 'acme-col-1';
						}
						else{
							$col = 'acme-col-2';
						}
					}
                    elseif( 5 == $total_posts ){
						$col = 'acme-col-2';
					}
				}
				?>
                <div class="single-list no-media <?php echo esc_attr( $col ).' atsi-'.absint( $i ); ?>">
                    <div class="no-media-query single-unit" style="background-image:url(<?php echo esc_url( $image_url[0] ); ?>);">
                        <a class="at-overlay" href="<?php echo esc_url( $term_link ); ?>"></a>
                        <div class="cat-details">
                            <a href="<?php echo esc_url( $term_link ); ?>">
                                <div class="cat-title">
                                    <h3><?php echo esc_html( $term_name ); ?></h3>
                                    <span><?php echo esc_html( $total_product ).' '.esc_html( $number_of_product_text ); ?> </span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
				<?php
				/*close div after last item of slide*/
				$closed = 0;
				if( $i >=$total_posts  ){
					$closed =1;
					echo "</div>";
				}

				$i++;
				$j++;
			}
		}
		if( 1 != $closed ){
			echo "</div>";
		}
		echo "</div>";/*at-unique-slide at-custom-slide*/
	}
endif;

/**
 * Feature Section
 * Two different types
 *
 * @package Acme Themes
 * @subpackage Online Shop
 * @since 1.0.0
 */
if ( ! class_exists( 'Online_Shop_Wc_Feature_Cats' ) ) {
    /**
     * Class for adding widget
     *
     * @package Acme Themes
     * @subpackage Online_Shop_Wc_Feature_Cats
     * @since 1.0.0
     */
    class Online_Shop_Wc_Feature_Cats extends WP_Widget {

        /*defaults values for fields*/
        private $defaults = array(
	        'online_shop_widget_title'  => '',
	        'online_shop_featured_cats' => array(),
	        'layout_type' => 2,
	        'enable_slider_mode' => 0,
	        'term_per_slide' => 4,
	        'view_all_option' => 'disable',
	        'all_link_text' => '',
	        'all_link_url' => '',
	        'number_of_product_text' => '',
	        'enable_prev_next' => 1,
            'online_shop_img_size' => 'full',
        );

        function __construct() {
            parent::__construct(
            /*Base ID of your widget*/
                'online_shop_wc_feature_cats',
                /*Widget name will appear in UI*/
                esc_html__('AT WooCommerce Categories', 'online-shop'),
                /*Widget description*/
                array( 'description' => esc_html__( 'Show WooCommerce Categories Beautifully', 'online-shop' ), )
            );
        }

        /*Widget Backend*/
        public function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, $this->defaults);

	        $online_shop_widget_title = esc_attr( $instance['online_shop_widget_title'] );

	        $online_shop_featured_cats = array_map( 'esc_attr', $instance['online_shop_featured_cats'] );
	        $layout_type = esc_attr( $instance[ 'layout_type' ] );
	        $enable_slider_mode = esc_attr( $instance[ 'enable_slider_mode' ] );
	        $term_per_slide = absint( $instance[ 'term_per_slide' ] );
	        $view_all_option = esc_attr( $instance[ 'view_all_option' ] );
	        $all_link_text = esc_attr( $instance['all_link_text'] );
	        $all_link_url = esc_url( $instance['all_link_url'] );
	        $number_of_product_text = esc_attr( $instance['number_of_product_text'] );
	        $enable_prev_next = esc_attr( $instance['enable_prev_next'] );
	        $online_shop_img_size = $instance['online_shop_img_size'];

	        $choices = online_shop_get_image_sizes_options();
	        ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'online_shop_widget_title' ) ); ?>">
                    <?php esc_html_e( 'Title', 'online-shop' ); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'online_shop_widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'online_shop_widget_title' ) ); ?>" type="text" value="<?php echo $online_shop_widget_title; ?>" />
            </p>

            <p>
                <label>
                    <?php esc_html_e('Select Feature Categories', 'online-shop'); ?>
                </label>
            </p>
            <div class="at-multiple-checkbox">
	        <?php
	        $args = array(
		        'taxonomy'     => 'product_cat',
		        'hide_empty'   => false,
		        'number'      => 999
	        );

	        $woocommerce_categories_obj = get_categories( $args );
	        if( !empty( $woocommerce_categories_obj ) ){
		        foreach( $woocommerce_categories_obj as $category ) {
			        $at_option_name = $category->term_id;
			        $at_option_title = $category->name;
			        if( isset( $online_shop_featured_cats[$at_option_name] ) ) {
				        $online_shop_featured_cats[$at_option_name] = 1;
			        }else{
				        $online_shop_featured_cats[$at_option_name] = 0;
			        }
			        ?>
                    <p>
                        <input id="<?php echo esc_attr( $this->get_field_id($at_option_name) ); ?>" name="<?php echo esc_attr( $this->get_field_name('online_shop_featured_cats').'['.$at_option_name.']' ); ?>" type="checkbox" value="1" <?php checked('1', $online_shop_featured_cats[$at_option_name]); ?>/>
                        <label for="<?php echo esc_attr( $this->get_field_id($at_option_name) ); ?>"><?php echo esc_html( $at_option_title ); ?></label>
                    </p>
			        <?php
		        }
            }
            else{
	            esc_html_e('No Categories found', 'online-shop');
            }
	        ?>
            </div>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'layout_type' ) ); ?>">
			        <?php esc_html_e( 'Select Layout', 'online-shop' ); ?>
                </label>
                <select class="widefat at-display-select" id="<?php echo esc_attr( $this->get_field_id( 'layout_type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'layout_type' ) ); ?>" >
			        <?php
			        $online_shop_wc_cat_layout_types = online_shop_wc_cat_layout_type();
			        foreach ( $online_shop_wc_cat_layout_types as $key => $value ){
				        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $layout_type ); ?>><?php echo esc_attr( $value );?></option>
				        <?php
			        }
			        ?>
                </select>
            </p>
            <p>
                <input id="<?php echo esc_attr( $this->get_field_id( 'enable_slider_mode' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'enable_slider_mode' ) ); ?>" type="checkbox" <?php checked( 1 == $enable_slider_mode ? $enable_slider_mode : 0); ?> />
                <label for="<?php echo esc_attr( $this->get_field_id( 'enable_slider_mode' ) ); ?>"><?php esc_html_e( 'Enable Slider Mode', 'online-shop' ); ?></label>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'term_per_slide' ) ); ?>"><?php esc_html_e( 'Cat Per Slide', 'online-shop' ); ?></label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'term_per_slide' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'term_per_slide' ) ); ?>" >
			        <?php
			        $online_shop_widget_term_per_slides = online_shop_widget_term_per_slide();
			        foreach ( $online_shop_widget_term_per_slides as $key => $value ){
				        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $term_per_slide ); ?>><?php echo esc_attr( $value );?></option>
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
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'number_of_product_text' ) ); ?>">
			        <?php esc_html_e( 'Number of product text', 'online-shop' ); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number_of_product_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number_of_product_text' ) ); ?>" type="text" value="<?php echo $number_of_product_text; ?>" />
            </p>
            <p class="at-enable-prev-next">
                <input id="<?php echo esc_attr( $this->get_field_id( 'enable_prev_next' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'enable_prev_next' ) ); ?>" type="checkbox" <?php checked( 1 == $enable_prev_next ? $instance['enable_prev_next'] : 0); ?> />
                <label for="<?php echo esc_attr( $this->get_field_id( 'enable_prev_next' ) ); ?>"><?php esc_html_e( 'Enable Prev - Next on Carousel Column', 'online-shop' ); ?></label>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'online_shop_img_size' ) ); ?>">
			        <?php esc_html_e( 'Image Size', 'online-shop' ); ?>
                </label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'online_shop_img_size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'online_shop_img_size' ) ); ?>">
			        <?php
			        foreach( $choices as $key => $online_shop_column_array ){
				        echo ' <option value="'.esc_attr( $key ).'" '.selected( $online_shop_img_size, $key, 0).'>'.esc_attr( $online_shop_column_array ).'</option>';
			        }
			        ?>
                </select>
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
	        $instance['online_shop_widget_title'] = ( isset( $new_instance['online_shop_widget_title'] ) ) ? sanitize_text_field( $new_instance['online_shop_widget_title'] ) : '';
	        $instance['online_shop_featured_cats'] = ( isset( $new_instance['online_shop_featured_cats'] ) && is_array( $new_instance['online_shop_featured_cats'] ) ) ? array_map( 'absint', $new_instance['online_shop_featured_cats'] ) : array();

	        $online_shop_wc_cat_layout_types = online_shop_wc_cat_layout_type();
	        $instance[ 'layout_type' ] = online_shop_sanitize_choice_options( $new_instance[ 'layout_type' ], $online_shop_wc_cat_layout_types, 2 );

	        $instance[ 'enable_slider_mode' ] = isset($new_instance['enable_slider_mode'])? 1 : 0;
	        $instance[ 'term_per_slide' ] = absint( $new_instance[ 'term_per_slide' ] );

	        $online_shop_link_options = online_shop_adv_link_options();
	        $instance[ 'view_all_option' ] = online_shop_sanitize_choice_options( $new_instance[ 'view_all_option' ], $online_shop_link_options, 'disable' );

	        $instance[ 'all_link_text' ] = sanitize_text_field( $new_instance[ 'all_link_text' ] );
	        $instance[ 'all_link_url' ] = esc_url_raw( $new_instance[ 'all_link_url' ] );
	        $instance[ 'number_of_product_text' ] = sanitize_text_field( $new_instance[ 'number_of_product_text' ] );
	        $instance[ 'enable_prev_next' ] = isset($new_instance['enable_prev_next'])? 1 : 0;

	        $online_shop_img_size = online_shop_get_image_sizes_options();
	        $instance[ 'online_shop_img_size' ] = online_shop_sanitize_choice_options( $new_instance[ 'online_shop_img_size' ], $online_shop_img_size, 'large' );

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
            $instance = wp_parse_args( (array) $instance, $this->defaults );
	        $online_shop_widget_title = !empty( $instance['online_shop_widget_title'] ) ? esc_attr( $instance['online_shop_widget_title'] ) : '';
	        $online_shop_widget_title = apply_filters( 'widget_title', $online_shop_widget_title, $instance, $this->id_base );

	        $online_shop_featured_cats = array_map( 'esc_attr', $instance['online_shop_featured_cats'] );
	        $layout_type = esc_attr( $instance[ 'layout_type' ] );
	        $enable_slider_mode = esc_attr( $instance['enable_slider_mode'] );

	        $term_per_slide = absint( $instance[ 'term_per_slide' ] );
	        $view_all_option = esc_attr( $instance[ 'view_all_option' ] );
	        $all_link_text = esc_html( $instance[ 'all_link_text' ] );
	        $number_of_product_text = esc_html( $instance[ 'number_of_product_text' ] );
	        $all_link_url = esc_url( $instance[ 'all_link_url' ] );
	        $enable_prev_next = esc_attr( $instance['enable_prev_next'] );
	        $online_shop_img_size = esc_attr( $instance['online_shop_img_size'] );

	        echo $args['before_widget'];
	        if ( !empty( $online_shop_widget_title ) ||
	             'disable' != $view_all_option ||
	             ( 1 == $enable_prev_next && 1 == $enable_slider_mode )
	        ){

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

		        if( 1 == $enable_prev_next && 1 == $enable_slider_mode ){
			        echo '<i class="prev fa fa-angle-left"></i><i class="next fa fa-angle-right"></i>';
		        }
		        echo "</span>";/*.at-action-wrapper*/

		        echo $args['after_title'];
	        }

	        if(!empty( $online_shop_featured_cats ) ){
		        if( 1 == $enable_slider_mode ){
			        $class = 'at-cat-feature-slider acme-slick-carausel';
		        }
		        else{
			        $class = 'at-cat-feature-section column';
		        }
		        ?>
                <div class="wc-cat-feature <?php echo esc_attr( $class ); ?> layout-<?php echo esc_attr( $layout_type );?>" data-column="1">
                    <?php
                    if( 2 == $layout_type ){
	                    online_shop_wc_feature_type_two( $online_shop_featured_cats, $term_per_slide, $online_shop_img_size, $number_of_product_text );
                    }
                    else{
	                    online_shop_wc_feature_type_default( $online_shop_featured_cats, $term_per_slide, $online_shop_img_size, $number_of_product_text );
                    }
                    ?>
                </div><!--wc-cat-feature-->
		        <?php
	        }
	        echo $args['after_widget'];
        }
    } // Class Online_Shop_Wc_Feature_Cats ends here
}