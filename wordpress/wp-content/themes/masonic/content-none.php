<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * @package ThemeGrill
 * @subpackage Masonic
 * @since 1.0
 */
?>

<div class="no-results not-found post-container">
   <div class="page-header">
      <h2 class="page-title"><?php _e('Nothing Found', 'masonic'); ?></h2>
   </div> <!-- .page-header -->

   <div class="page-content">
      <?php if (is_home() && current_user_can('publish_posts')) : ?>

         <p><?php printf(__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'masonic'), esc_url(admin_url('post-new.php'))); ?></p>

      <?php elseif (is_search()) : ?>

         <p><?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'masonic'); ?></p>
         <?php get_search_form(); ?>

      <?php else : ?>

         <p><?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'masonic'); ?></p>
         <?php get_search_form(); ?>

      <?php endif; ?>
   </div> <!-- .page-content -->
</div> <!-- .no-results -->