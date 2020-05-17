<?php
/**
 * The template for displaying 404 pages (Page Not Found).
 *
 * @package ThemeGrill
 * @subpackage Masonic
 * @since 1.0
 */

get_header(); ?>

<div class="site-content">
   <div id="container" class="wrapper clear">

      <div class="primary">
         <h2><?php _e('Oops! That page can&rsquo;t be found.', 'masonic'); ?></h2>

         <p><?php _e('It looks like nothing was found at this location. Perhaps a search may help you.', 'masonic'); ?></p>

         <?php get_search_form(); ?>
      </div>
      <?php get_sidebar(); ?>

   </div><!-- #container -->
</div><!-- .site-content -->

<?php get_footer(); ?>