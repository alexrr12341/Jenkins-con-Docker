<?php
/**
 * Displays the searchform of the theme.
 *
 * @package ThemeGrill
 * @subpackage Masonic
 * @since 1.0
 */
?>

<form role="search" method="get" class="searchform clear" action="<?php echo esc_url(home_url('/')); ?>">
   <div class="masonic-search">
      <label class="screen-reader-text"><?php _e('Search for:', 'masonic'); ?></label>
      <input type="text" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php _e('Type and hit enter...', 'masonic'); ?>" />
   </div>
</form>