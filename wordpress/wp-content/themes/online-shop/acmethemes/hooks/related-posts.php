<?php
/**
 * Display related posts from same category
 *
 * @since Online Shop 1.0.0
 *
 * @param int $post_id
 * @return void
 *
 */
if ( !function_exists('online_shop_related_post_below') ) :

    function online_shop_related_post_below( $post_id ) {

        global $online_shop_customizer_all_values;
	    if( 0 == $online_shop_customizer_all_values['online-shop-show-related'] ){
		    return;
	    }
	    $online_shop_cat_post_args = array(
		    'post__not_in' => array($post_id),
		    'post_type' => 'post',
		    'posts_per_page'      => 3,
		    'post_status'         => 'publish',
		    'ignore_sticky_posts' => true
	    );
	    $online_shop_related_post_display_from = $online_shop_customizer_all_values['online-shop-related-post-display-from'];

	    if( 'tag' == $online_shop_related_post_display_from ){

		    $tags = get_post_meta( $post_id, 'related-posts', true );
		    if ( !$tags ) {
			    $tags = wp_get_post_tags( $post_id, array('fields'=>'ids' ) );
			    $online_shop_cat_post_args['tag__in'] = $tags;
		    }
		    else {
			    $online_shop_cat_post_args['tag_slug__in'] = explode(',', $tags);
		    }
	    }
	    else{

		    $cats = get_post_meta( $post_id, 'related-posts', true );
		    if ( !$cats ) {
			    $cats = wp_get_post_categories( $post_id, array('fields'=>'ids' ) );
			    $online_shop_cat_post_args['category__in'] = $cats;
		    }
		    else {
			    $online_shop_cat_post_args['cat'] = $cats;
		    }

	    }
	    $online_shop_featured_query = new WP_Query( $online_shop_cat_post_args );
	    if( $online_shop_featured_query->have_posts() ){
		    $online_shop_related_title = $online_shop_customizer_all_values['online-shop-related-title'];
		    if( !empty( $online_shop_related_title ) ){
			    ?>
                <div class="at-title-action-wrapper">
                    <h2 class="widget-title"><?php echo esc_html( $online_shop_related_title ); ?></h2>
                </div>
			    <?php
		    }
		    ?>
            <div class="featured-entries-col column">
			    <?php
			    $online_shop_featured_index = 1;
			    while ( $online_shop_featured_query->have_posts() ) :$online_shop_featured_query->the_post();
				    $thumb = 'large';
				    $online_shop_list_classes = 'single-list acme-col-3';
				    $online_shop_words = 21;
				    ?>
                    <div class="<?php echo esc_attr( $online_shop_list_classes ); ?>">
                        <div class="post-container">
                            <div class="post-thumb">
                                <a href="<?php the_permalink(); ?>">
								    <?php
								    if( has_post_thumbnail() ):
									    the_post_thumbnail( $thumb );
								    else:
									    ?>
                                        <div class="no-image-widgets">
										    <?php
										    the_title( sprintf( '<h2 class="caption-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
										    if( !get_the_title() ){
											    the_date( '', sprintf( '<h2 class="caption-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
										    }
										    ?>
                                        </div>
									    <?php
								    endif;
								    ?>
                                </a>
                            </div><!-- .post-thumb-->
                            <div class="post-content">
                                <div class="entry-header">
								    <?php
								    online_shop_list_post_category();
								    the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
                                </div><!-- .entry-header -->
                                <div class="entry-content clearfix">
								    <?php
								    $excerpt = online_shop_excerpt_words_count( absint( $online_shop_words ) );
								    echo '<div class="details">'.wp_kses_post( wpautop( $excerpt ) ).'</div>';
								    ?>
                                </div><!-- .entry-content -->
                            </div><!--.post-content-->
                        </div><!--.post-container-->
                    </div><!--dynamic css-->
				    <?php
				    $online_shop_featured_index++;
			    endwhile;
			    ?>
            </div><!--featured entries-col-->
            <?php
        }
	    wp_reset_postdata();
    }
endif;
add_action( 'online_shop_related_posts', 'online_shop_related_post_below', 10, 1 );