<?php
/**
 * content and content wrapper end
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'online_shop_after_content' ) ) :

    function online_shop_after_content() {
      ?>
        </div><!-- #content -->
        </div><!-- content-wrapper-->
    <?php
    }
endif;
add_action( 'online_shop_action_after_content', 'online_shop_after_content', 10 );

/**
 * Footer content
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'online_shop_footer' ) ) :

    function online_shop_footer() {

        global $online_shop_customizer_all_values;

        ?>
        <div class="clearfix"></div>
        <footer id="colophon" class="site-footer">
            <div class="footer-wrapper">
                <?php
                if( is_active_sidebar( 'full-width-top-footer' ) ) :
                    echo "<div class='wrapper full-width-top-footer'>";
	                dynamic_sidebar( 'full-width-top-footer' );
	                echo "</div>";
                endif;
                ?>
                <div class="top-bottom wrapper">
                    <?php
                    if(
                        is_active_sidebar('footer-top-col-one') ||
                        is_active_sidebar('footer-top-col-two') ||
                        is_active_sidebar('footer-top-col-three') ||
                        is_active_sidebar('footer-top-col-four')
                    )
                    {
                        ?>
                        <div id="footer-top">
                            <div class="footer-columns clearfix">
			                    <?php
			                    $footer_top_col = 'footer-sidebar acme-col-4';
			                    if (is_active_sidebar('footer-top-col-one')) : ?>
                                    <div class="footer-sidebar <?php echo esc_attr($footer_top_col); ?>">
					                    <?php dynamic_sidebar('footer-top-col-one'); ?>
                                    </div>
			                    <?php endif;
			                    if (is_active_sidebar('footer-top-col-two')) : ?>
                                    <div class="footer-sidebar <?php echo esc_attr($footer_top_col); ?>">
					                    <?php dynamic_sidebar('footer-top-col-two'); ?>
                                    </div>
			                    <?php endif;
			                    if (is_active_sidebar('footer-top-col-three')) : ?>
                                    <div class="footer-sidebar <?php echo esc_attr($footer_top_col); ?>">
					                    <?php dynamic_sidebar('footer-top-col-three'); ?>
                                    </div>
			                    <?php endif;
			                    if (is_active_sidebar('footer-top-col-four')) : ?>
                                    <div class="footer-sidebar <?php echo esc_attr($footer_top_col); ?>">
					                    <?php dynamic_sidebar('footer-top-col-four'); ?>
                                    </div>
			                    <?php endif; ?>
                            </div>
                        </div><!-- #foter-top -->
                        <?php
                    }
                    if(
                        is_active_sidebar('footer-bottom-col-one') ||
                        is_active_sidebar('footer-bottom-col-two')
                    )
                    {
                        ?>
                        <div id="footer-bottom">
                            <div class="footer-columns clearfix">
                                <?php
			                    $footer_bottom_col = 'footer-sidebar acme-col-2';
			                    if (is_active_sidebar('footer-bottom-col-one')) : ?>
                                    <div class="footer-sidebar <?php echo esc_attr($footer_bottom_col); ?>">
					                    <?php dynamic_sidebar('footer-bottom-col-one'); ?>
                                    </div>
			                    <?php endif;
			                    if (is_active_sidebar('footer-bottom-col-two')) : ?>
                                    <div class="footer-sidebar float-right <?php echo esc_attr($footer_bottom_col); ?>">
					                    <?php dynamic_sidebar('footer-bottom-col-two'); ?>
                                    </div>
			                    <?php
                                endif;
                                ?>
                            </div>
                        </div>
                        <?php
                    }
	                if( is_active_sidebar( 'full-width-bottom-footer' ) ) :
		                echo "<div class='wrapper full-width-bottom-footer'>";
		                dynamic_sidebar( 'full-width-bottom-footer' );
		                echo "</div>";
	                endif;
	                ?>
                    <div class="clearfix"></div>
                </div><!-- top-bottom-->
                <div class="footer-copyright">
                    <div class="wrapper">
	                    <?php
	                    if( is_active_sidebar( 'footer-bottom-left-area' ) ) :
                            ?>
                            <div class="site-info-left">
                                <?php
                                dynamic_sidebar( 'footer-bottom-left-area' );
                                ?>
                            </div>
                        <?php
	                    endif;
	                    ?>
                        <div class="site-info">
                            <span>
		                        <?php if( isset( $online_shop_customizer_all_values['online-shop-footer-copyright'] ) ): ?>
			                        <?php echo wp_kses_post( $online_shop_customizer_all_values['online-shop-footer-copyright'] ); ?>
		                        <?php endif; ?>
                            </span>
                            <?php
                            if( 1 == $online_shop_customizer_all_values['online-shop-enable-footer-power-text'] ){
	                            echo '<span>';
	                            printf( esc_html__( '%1$s by %2$s', 'online-shop' ), 'Online Shop', '<a href="http://www.acmethemes.com/" rel="designer">Acme Themes</a>' );
	                            echo '</span><!-- .site-info -->';
                            }
                            ?>
                        </div><!-- .site-info -->
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div><!-- footer-wrapper-->
        </footer><!-- #colophon -->
    <?php
    }
endif;
add_action( 'online_shop_action_footer', 'online_shop_footer', 10 );

/**
 * Page end
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'online_shop_page_end' ) ) :

    function online_shop_page_end() {
	    global $online_shop_customizer_all_values;
	    $online_shop_top_right_button_options = $online_shop_customizer_all_values['online-shop-top-right-button-options'];
	    $online_shop_popup_widget_title = $online_shop_customizer_all_values['online-shop-popup-widget-title'];

	    if( 'widget' == $online_shop_top_right_button_options ){
		    ?>
            <!-- Modal -->
            <div id="at-widget-modal" class="modal fade">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content" id="at-widget-modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
						    <?php
						    if( !empty( $online_shop_popup_widget_title ) ){
							    ?>
                                <h4 class="modal-title"><?php echo esc_html( $online_shop_popup_widget_title ); ?></h4>
							    <?php
						    }
						    ?>
                        </div>
                        <?php
                        if( is_active_sidebar( 'popup-widget-area' ) ) :
                            echo "<div class='modal-body'>";
	                        dynamic_sidebar( 'popup-widget-area' );
	                        echo "</div>";
                        endif;
                        ?>
                    </div><!--.modal-content-->
                </div>
            </div><!--#at-shortcode-bootstrap-modal-->
		    <?php
	    }
        ?>
        </div><!-- #page -->
    <?php
    }
endif;
add_action( 'online_shop_action_after', 'online_shop_page_end', 10 );