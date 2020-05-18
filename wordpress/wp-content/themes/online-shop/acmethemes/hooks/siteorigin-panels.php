<?php
/**
 * Adds Online Shop Theme Widgets in SiteOrigin Pagebuilder Tabs
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return null
 *
 */
function online_shop_widgets($widgets) {
    $theme_widgets = array(
        'online_shop_about',
        'online_shop_posts_col',
        'online_shop_featured_page',
        'online_shop_advanced_image_logo',
        'online_shop_social',
        'online_shop_wc_feature_cats',
        'online_shop_wc_cats_tabs',
        'online_shop_wc_products',
        'online_shop_advanced_search'
    );
    foreach($theme_widgets as $theme_widget) {
        if( isset( $widgets[$theme_widget] ) ) {
            $widgets[$theme_widget]['groups'] = array('online-shop');
            $widgets[$theme_widget]['icon']   = 'dashicons dashicons-screenoptions';
        }
    }
    return $widgets;
}
add_filter('siteorigin_panels_widgets', 'online_shop_widgets' );

/**
 * Add a tab for the theme widgets in the page builder
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return null
 *
 */
function online_shop_widgets_tab($tabs){
    $tabs[] = array(
        'title'  => esc_html__('AT Online Shop Widgets', 'online-shop'),
        'filter' => array(
            'groups' => array('online-shop')
        )
    );
    return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'online_shop_widgets_tab', 20 );