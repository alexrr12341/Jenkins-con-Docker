<?php
/**
 * The left sidebar containing the main widget area.
 */
if ( ! is_active_sidebar( 'online-shop-sidebar-left' ) ) {
	return;
}
$sidebar_layout = online_shop_sidebar_selection();
if( $sidebar_layout == "left-sidebar" || $sidebar_layout == "both-sidebar"  ) : ?>
    <div id="secondary-left" class="widget-area sidebar secondary-sidebar float-right" role="complementary">
        <div id="sidebar-section-top" class="widget-area sidebar clearfix">
			<?php dynamic_sidebar( 'online-shop-sidebar-left' ); ?>
        </div>
    </div>
<?php endif;