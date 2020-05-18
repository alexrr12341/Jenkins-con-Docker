<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Acme Themes
 * @subpackage Online Shop
 */

/**
 * online_shop_action_after_content hook
 * @since Online Shop 1.0.0
 *
 * @hooked online_shop_after_content - 10
 */
do_action( 'online_shop_action_after_content' );

/**
 * online_shop_action_before_footer hook
 * @since Online Shop 1.0.0
 *
 * @hooked null
 */
do_action( 'online_shop_action_before_footer' );

/**
 * online_shop_action_footer hook
 * @since Online Shop 1.0.0
 *
 * @hooked online_shop_footer - 10
 */
do_action( 'online_shop_action_footer' );

/**
 * online_shop_action_after_footer hook
 * @since Online Shop 1.0.0
 *
 * @hooked null
 */
do_action( 'online_shop_action_after_footer' );

/**
 * online_shop_action_after hook
 * @since Online Shop 1.0.0
 *
 * @hooked online_shop_page_end - 10
 */
do_action( 'online_shop_action_after' );
wp_footer(); ?>
</body>
</html>