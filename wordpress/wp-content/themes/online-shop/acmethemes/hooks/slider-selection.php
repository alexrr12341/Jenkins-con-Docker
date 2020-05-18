<?php
/**
 * Display default slider
 *
 * @since Online Shop 1.0.0
 *
 * @param int $post_id
 * @return void
 *
 */
if ( !function_exists('online_shop_default_featured') ) :
    function online_shop_default_featured(){
        ?>
        <div class="acme-col-2" style="background-image: url('<?php echo esc_url( get_template_directory_uri()."/assets/img/default-image.jpg" ); ?>')">

        </div>
        <div class="acme-col-2" style="background-image: url('<?php echo esc_url( get_template_directory_uri()."/assets/img/default-image.jpg" ); ?>')">

        </div>
        <div class="clearfix"></div>
        <div class="acme-col-3" style="background-image: url('<?php echo esc_url( get_template_directory_uri()."/assets/img/default-image.jpg" ); ?>')">

        </div>
        <div class="acme-col-3" style="background-image: url('<?php echo esc_url( get_template_directory_uri()."/assets/img/default-image.jpg" ); ?>')">

        </div>
        <div class="acme-col-3" style="background-image: url('<?php echo esc_url( get_template_directory_uri()."/assets/img/default-image.jpg" ); ?>')">

        </div>
        <?php
    }
endif;

/**
 * Display related posts from same category
 *
 * @since Online Shop 1.0.0
 *
 * @param int $post_id
 * @return void
 *
 */
if ( !function_exists('online_shop_feature_slider') ) :
    function online_shop_feature_slider() {
	    global $online_shop_customizer_all_values;
	    $online_shop_feature_content_options = $online_shop_customizer_all_values['online-shop-feature-content-options'];
	    $online_shop_feature_right_content_options = $online_shop_customizer_all_values['online-shop-feature-right-content-options'];
	    $online_shop_fs_image_display_options = $online_shop_customizer_all_values['online-shop-fs-image-display-options'];
	    $slider_full = '';
	    if( 'disable' == $online_shop_feature_right_content_options ){
	        $slider_full = 'full-width';
        }
	    if( 'disable' == $online_shop_feature_content_options ){
		    $slider_full = 'full-width-right';
        }
	    ?>
        <div class="clearfix"></div>
        <div class="wrapper">
            <div class="slider-feature-wrap <?php echo esc_attr( $slider_full ); ?> clearfix <?php echo esc_attr( $online_shop_fs_image_display_options );?>">
	            <?php
	            if( is_active_sidebar( 'online-shop-before-feature' ) ) :
		            ?>
                    <div class="online-shop-before-feature">
			            <?php
			            dynamic_sidebar( 'online-shop-before-feature' );
			            ?>
                    </div>
		            <?php
	            endif;
		        if( 'disable' != $online_shop_feature_content_options ){
			        ?>
                    <div class="slider-section">
				        <?php
				        $online_shop_feature_slider_display_arrow = $online_shop_customizer_all_values['online-shop-feature-slider-display-arrow'];
				        $online_shop_feature_slider_enable_autoplay = $online_shop_customizer_all_values['online-shop-feature-slider-enable-autoplay'];
				        if( 1 ==$online_shop_feature_slider_display_arrow ){
					        echo "<span class='at-action-wrapper'>";
					        echo '<i class="prev fa fa-angle-left"></i><i class="next fa fa-angle-right"></i>';
					        echo "</span>";/*.at-action-wrapper*/
				        }
				        ?>
                        <div class="featured-slider at-feature-section"
                             data-autoplay="<?php echo esc_attr( $online_shop_feature_slider_enable_autoplay );?>"
                             data-arrows="<?php echo esc_attr( $online_shop_feature_slider_display_arrow );?>"
                        >
					        <?php
					        $online_shop_feature_post_number = $online_shop_customizer_all_values['online-shop-feature-post-number'];
					        $online_shop_feature_slider_display_cat = $online_shop_customizer_all_values['online-shop-feature-slider-display-cat'];
					        $online_shop_feature_slider_display_title = $online_shop_customizer_all_values['online-shop-feature-slider-display-title'];
					        $online_shop_feature_slider_display_excerpt = $online_shop_customizer_all_values['online-shop-feature-slider-display-excerpt'];

					        $sticky = get_option( 'sticky_posts' );

					        if( 'product' == $online_shop_feature_content_options && online_shop_is_woocommerce_active() ){
						        $online_shop_feature_product_cat = $online_shop_customizer_all_values['online-shop-feature-product-cat'];
						        $query_args = array(
							        'posts_per_page' => $online_shop_feature_post_number,
							        'post_status'    => 'publish',
							        'post_type'      => 'product',
							        'no_found_rows'  => 1,
							        'meta_query'     => array(),
							        'tax_query'      => array(
								        'relation' => 'AND',
							        )
						        );
						        if( 0 != $online_shop_feature_product_cat ){
							        $query_args['tax_query'][] = array(
								        'taxonomy' => 'product_cat',
								        'field'    => 'term_id',
								        'terms'    => $online_shop_feature_product_cat,
							        );
						        }
					        }
					        else{
						        $online_shop_feature_post_cat = $online_shop_customizer_all_values['online-shop-feature-post-cat'];
						        $query_args = array(
							        'posts_per_page'      => $online_shop_feature_post_number,
							        'no_found_rows'       => true,
							        'post_status'         => 'publish',
							        'ignore_sticky_posts' => true,
							        'post__not_in' => $sticky
						        );
						        if( 0 != $online_shop_feature_post_cat ){
							        $query_args['cat'] = $online_shop_feature_post_cat;
						        }
					        }

					        $slider_query = new WP_Query( $query_args );

					        if ( $slider_query->have_posts() ):
						        while ($slider_query->have_posts()): $slider_query->the_post();
							        if (has_post_thumbnail()) {
								        $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
							        }
							        else {
								        $image_url[0] = get_template_directory_uri() . '/assets/img/default-image.jpg';
							        }
							        $bg_image_style = '';
							        if( 'full-screen-bg' == $online_shop_fs_image_display_options ){
								        $bg_image_style = 'background-image:url(' . esc_url( $image_url[0] ) . ');background-repeat:no-repeat;background-size:cover;background-position:center;';
							        }
							        ?>
                                    <div class="no-media-query at-slide-unit acme-col-1" style="<?php echo esc_attr( $bg_image_style ); ?>">
								        <?php
								        if( 'responsive-img' == $online_shop_fs_image_display_options ){
									        echo '<img src="'.esc_url( $image_url[0] ).'"/>';
								        }
								        ?>
                                        <a class="at-overlay" href="<?php the_permalink()?>"></a>
                                        <div class="slider-desc">
									        <?php
									        if( 1 == $online_shop_feature_slider_display_cat ){
										        ?>
                                                <div class="above-slider-details">
											        <?php
											        if( 'product' == $online_shop_feature_content_options && online_shop_is_woocommerce_active() ){
												        online_shop_list_product_category();
											        }
											        else{
												        online_shop_list_post_category();
											        }
											        ?>
                                                </div>
										        <?php
									        }
									        if( 1 == $online_shop_feature_slider_display_title || 1 == $online_shop_feature_slider_display_excerpt ){
										        ?>
                                                <div class="slider-details">
											        <?php
											        if( 1 == $online_shop_feature_slider_display_title ){
												        ?>
                                                        <div class="slide-title">
                                                            <a href="<?php the_permalink()?>">
														        <?php the_title(); ?>
                                                            </a>
                                                        </div>
												        <?php
											        }
											        if( 1 == $online_shop_feature_slider_display_excerpt ){
												        ?>
                                                        <div class="slide-desc">
													        <?php the_excerpt();?>
                                                        </div>
												        <?php
											        }
											        ?>
                                                </div>
										        <?php
									        }
									        $online_shop_feature_button_text = $online_shop_customizer_all_values['online-shop-feature-button-text'];
									        if( !empty( $online_shop_feature_button_text )){
										        ?>
                                                <div class="slider-buttons">
                                                    <a href="<?php the_permalink()?>" class="slider-button primary">
												        <?php
												        if( ( online_shop_is_woocommerce_active() && 'product' == $online_shop_feature_content_options ) || 'post' == $online_shop_feature_content_options ){
													        echo esc_html( $online_shop_feature_button_text );
												        }
												        ?>
                                                    </a>
                                                </div>
										        <?php
									        }
									        ?>
                                        </div>
                                    </div>
							        <?php
						        endwhile;
					        else:
						        online_shop_default_featured();
					        endif;
					        wp_reset_postdata();
					        ?>
                        </div>
                    </div>
			        <?php
		        }
		        if( 'disable' != $online_shop_feature_right_content_options ){
			        $online_shop_fs_right_image_display_options = $online_shop_customizer_all_values['online-shop-feature-right-image-display-options'];
			        ?>
                    <div class="beside-slider <?php echo esc_attr( $online_shop_fs_right_image_display_options ); ?>">
				        <?php
				        $online_shop_feature_slider_right_display_arrow = $online_shop_customizer_all_values['online-shop-feature-right-display-arrow'];
				        $online_shop_feature_slider_right_enable_autoplay = $online_shop_customizer_all_values['online-shop-feature-right-enable-autoplay'];

				        if( 1 == $online_shop_feature_slider_right_display_arrow ){
					        echo "<span class='at-action-wrapper'>";
					        echo '<i class="prev fa fa-angle-left"></i><i class="next fa fa-angle-right"></i>';
					        echo "</span>";/*.at-action-wrapper*/
				        }
				        ?>
                        <div class="fs-right-slider"
                             data-autoplay="<?php echo esc_attr( $online_shop_feature_slider_right_enable_autoplay);?>"
                             data-arrows="<?php echo esc_attr( $online_shop_feature_slider_right_display_arrow );?>"
                        >
					        <?php
					        $online_shop_feature_right_post_cat = $online_shop_customizer_all_values['online-shop-feature-right-post-cat'];
					        $online_shop_feature_right_product_cat = $online_shop_customizer_all_values['online-shop-feature-right-product-cat'];
					        $online_shop_feature_right_post_number = $online_shop_customizer_all_values['online-shop-feature-right-post-number'];
					        $online_shop_feature_right_display_title = $online_shop_customizer_all_values['online-shop-feature-right-display-title'];
					        $online_shop_feature_right_button_text = $online_shop_customizer_all_values['online-shop-feature-right-button-text'];

					        $sticky = get_option( 'sticky_posts' );

					        if( 'product' == $online_shop_feature_right_content_options && online_shop_is_woocommerce_active() ){
						        $query_args = array(
							        'posts_per_page' => $online_shop_feature_right_post_number,
							        'post_status'    => 'publish',
							        'post_type'      => 'product',
							        'no_found_rows'  => 1,
							        'meta_query'     => array(),
							        'tax_query'      => array(
								        'relation' => 'AND',
							        )
						        );
						        if( 0 != $online_shop_feature_right_product_cat ){
							        $query_args['tax_query'][] = array(
								        'taxonomy' => 'product_cat',
								        'field'    => 'term_id',
								        'terms'    => $online_shop_feature_right_product_cat,
							        );
						        }
					        }
					        else{
						        $query_args = array(
							        'posts_per_page'      => $online_shop_feature_right_post_number,
							        'no_found_rows'       => true,
							        'post_status'         => 'publish',
							        'ignore_sticky_posts' => true,
							        'post__not_in' => $sticky
						        );
						        if( 0 != $online_shop_feature_right_post_cat ){
							        $query_args['cat'] = $online_shop_feature_right_post_cat;
						        }
					        }

					        $slider_query = new WP_Query( $query_args );
					        while ( $slider_query->have_posts() ): $slider_query->the_post();
						        if (has_post_thumbnail()) {
							        $image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
						        } else {
							        $image_url[0] = get_template_directory_uri() . '/assets/img/default-image.jpg';
						        }
						        $bg_image_style = '';
						        if( 'full-screen-bg' == $online_shop_fs_right_image_display_options ){
							        $bg_image_style = 'background-image:url(' . esc_url( $image_url[0] ) . ');background-repeat:no-repeat;background-size:cover;background-position:center;';
						        }
						        ?>
                                <div class="no-media-query at-beside-slider-unit" style="<?php echo esc_attr( $bg_image_style ); ?>">
							        <?php
							        if( 'responsive-img' == $online_shop_fs_right_image_display_options ){
								        echo '<img src="'.esc_url( $image_url[0] ).'"/>';
							        }
							        ?>
                                    <a class="at-overlay" href="<?php the_permalink()?>"></a>
                                    <div class="beside-slider-desc">
                                        <div class="beside-slider-content-wrapper">
									        <?php
									        if( 1 == $online_shop_feature_right_display_title ){
										        ?>
                                                <div class="slider-details">
                                                    <div class="slide-title">
                                                        <a href="<?php the_permalink()?>">
													        <?php the_title(); ?>
                                                        </a>
                                                    </div>
                                                </div>
										        <?php
									        }
									        if( !empty( $online_shop_feature_right_button_text ) && ( ( online_shop_is_woocommerce_active() && 'product' == $online_shop_feature_right_content_options ) || 'post' == $online_shop_feature_right_content_options )){
										        ?>
                                                <div class="slider-buttons">
                                                    <a href="<?php the_permalink()?>" class="slider-button primary">
												        <?php
												        echo esc_html( $online_shop_feature_right_button_text );
												        ?>
                                                    </a>
                                                </div>
										        <?php
									        }
									        ?>
                                        </div>
                                    </div>
                                </div>
						        <?php
					        endwhile;
					        wp_reset_postdata();
					        ?>
                        </div><!--.fs-right-slider-->
                    </div><!--beside-slider-->
			        <?php
		        }
		        ?>
            </div><!--slider-feature-wrap-->
        </div>
        <div class="clearfix"></div>
        <?php
    }
endif;
add_action( 'online_shop_action_feature_slider', 'online_shop_feature_slider', 0 );