<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package ThemeGrill
 * @subpackage Masonic
 * @since 1.0
 */
if (!function_exists('masonic_paging_nav')) :

   /**
    * Display navigation to next/previous set of posts when applicable.
    */
   function masonic_paging_nav() {
      // Don't print empty markup if there's only one page.
      if ($GLOBALS['wp_query']->max_num_pages < 2) {
         return;
      }
      ?>
      <div class="page-navigation clear">
         <div class="underline"></div>
         <hr>
         <h3 class="screen-reader-text"><?php _e('Posts navigation', 'masonic'); ?></h3>
         <?php
         if ( function_exists('wp_pagenavi' ) ) :
            wp_pagenavi();
         else :
            if ( !is_search() ) { ?>
               <?php if (get_next_posts_link()) : ?>
                  <div class="nav-previous"><?php next_posts_link(__('<span><i class="fa fa-arrow-circle-o-left"></i></span> Older posts', 'masonic')); ?></div>
               <?php endif; ?>

               <?php if (get_previous_posts_link()) : ?>
                  <div class="nav-next"><?php previous_posts_link(__('Newer posts <span><i class="fa fa-arrow-circle-o-right"></i></span>', 'masonic')); ?></div>
               <?php endif; ?>
            <?php } else { ?>
               <?php if (get_next_posts_link()) : ?>
                  <div class="nav-previous"><?php next_posts_link(__('<span><i class="fa fa-arrow-circle-o-left"></i></span> Previous', 'masonic')); ?></div>
               <?php endif; ?>

               <?php if (get_previous_posts_link()) : ?>
                  <div class="nav-next"><?php previous_posts_link(__('Next <span><i class="fa fa-arrow-circle-o-right"></i></span>', 'masonic')); ?></div>
               <?php endif; ?>
            <?php } ?>
         <?php endif; ?>

      </div><!-- .navigation -->
      <div class="underline"></div>
      <hr>
      <?php
   }

endif;

if (!function_exists('masonic_post_nav')) :

   /**
    * Display navigation to next/previous post when applicable.
    */
   function masonic_post_nav() {
      // Don't print empty markup if there's nowhere to navigate.
      $previous = ( is_attachment() ) ? get_post(get_post()->post_parent) : get_adjacent_post(false, '', true);
      $next = get_adjacent_post(false, '', false);

      if (!$next && !$previous) {
         return;
      }
      ?>
      <div class="post-navigation clear">
         <div class="underline"></div>
         <hr>
         <h3 class="screen-reader-text"><?php _e('Post navigation', 'masonic'); ?></h3>
         <?php
         previous_post_link('<div class="nav-previous">%link</div>', _x('<span><i class="fa fa-arrow-circle-o-left"></i></span>%title', 'Previous post link', 'masonic'));
         next_post_link('<div class="nav-next">%link</div>', _x('%title<span><i class="fa fa-arrow-circle-o-right"></i></span>', 'Next post link', 'masonic'));
         ?>
      </div><!-- .navigation -->
      <div class="underline"></div>
      <hr>
      <?php
   }

endif;

if (!function_exists('masonic_posted_on')) :

   /**
    * Prints HTML with meta information for the current post-date/time and author.
    */
   function masonic_posted_on() {

      if (is_single()) {
         $cat_list = get_the_category_list(__(' ', 'masonic'));
         if ($cat_list && masonic_categorized_blog()) {
            echo '<div class="catagory-type">' . $cat_list . '</div>';
         }
      }

      $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
      if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
         $time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
      }
      $time_string = sprintf( $time_string,
         esc_attr( get_the_date( 'c' ) ),
         esc_html( get_the_date() ),
         esc_attr( get_the_modified_date( 'c' ) ),
         esc_html( get_the_modified_date() )
      );
      printf( __( '<div class="entry-date fa fa-clock-o"><a href="%1$s" title="%2$s" rel="bookmark">%3$s</a></div>', 'masonic' ),
         esc_url( get_permalink() ),
         esc_attr( get_the_time() ),
         $time_string
      );

      echo '<div class="entry-author vcard author fa fa-user"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></div>';

      if (!is_single()) {
         $categories_list = get_the_category_list(__(', ', 'masonic'));
         if ($categories_list && masonic_categorized_blog()) {
            echo '<div class="entry-standard fa fa-folder-open">' . $categories_list . '</div>';
         }
      }

      if (is_single()) {
         if (comments_open()) :
            ?>
            <div class="entry-date fa fa-comments"><?php comments_popup_link(__('No Comment', 'masonic'), __('1 Comment', 'masonic'), __('% Comments', 'masonic')); ?></div>
            <?php
         endif;
      }

      $tags_list = get_the_tag_list('', __(', ', 'masonic'));
      if (is_single()) {
         if ($tags_list) :
            ?>
            <div class="entry-tag fa fa-tags"><?php printf(__(' %1$s', 'masonic'), $tags_list); ?></div>
            <?php
         endif;
      }
   }

endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function masonic_categorized_blog() {
   if (false === ( $all_the_cool_cats = get_transient('masonic_categories') )) {
      // Create an array of all the categories that are attached to posts.
      $all_the_cool_cats = get_categories(array(
          'fields' => 'ids',
          'hide_empty' => 1,
          // We only need to know if there is more than one category.
          'number' => 2,
      ));

      // Count the number of categories that are attached to the posts.
      $all_the_cool_cats = count($all_the_cool_cats);

      set_transient('masonic_categories', $all_the_cool_cats);
   }

   if ($all_the_cool_cats > 1) {
      // This blog has more than 1 category so masonic_categorized_blog should return true.
      return true;
   } else {
      // This blog has only 1 category so masonic_categorized_blog should return false.
      return false;
   }
}

/**
 * Flush out the transients used in masonic_categorized_blog.
 */
function masonic_category_transient_flusher() {
   if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
      return;
   }
   // Like, beat it. Dig?
   delete_transient('masonic_categories');
}

add_action('edit_category', 'masonic_category_transient_flusher');
add_action('save_post', 'masonic_category_transient_flusher');
