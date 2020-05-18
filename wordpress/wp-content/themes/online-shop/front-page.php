<?php
/**
 * The front-page template file.
 *
 * @package Acme Themes
 * @subpackage Online Shop
 * @since Online Shop 1.0.0
 */
get_header();
/**
 * online_shop_action_front_page hook
 * @since Online Shop 1.0.0
 *
 * @hooked online_shop_front_page -  10
 */
do_action( 'online_shop_action_front_page' );

get_footer();