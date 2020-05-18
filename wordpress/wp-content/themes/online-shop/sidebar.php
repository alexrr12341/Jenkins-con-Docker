<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Acme Themes
 * @subpackage Online Shop
 */

if ( ! is_active_sidebar( 'online-shop-sidebar' ) ) {
	return;
}
$sidebar_layout = online_shop_sidebar_selection();
if( $sidebar_layout == 'both-sidebar' ) {
	echo '</div>';
}
if( $sidebar_layout == "right-sidebar" || $sidebar_layout == "both-sidebar" || empty( $sidebar_layout ) ) : ?>
    <div id="secondary-right" class="widget-area sidebar secondary-sidebar float-right" role="complementary">
        <div id="sidebar-section-top" class="widget-area sidebar clearfix">
			<?php dynamic_sidebar( 'online-shop-sidebar' ); ?>
        </div>
    </div>
<?php endif;