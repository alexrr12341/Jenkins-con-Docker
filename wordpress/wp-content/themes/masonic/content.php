<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package ThemeGrill
 * @subpackage Masonic
 * @since 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-container'); ?>>
   <?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>

   <?php
   if( get_post_format() ) {
      get_template_part( 'inc/post-formats' );
   } elseif( has_post_thumbnail() ) {
      ?>
      <div class="wider-web-top">
         <i class="fa fa-2x fa-caret-down"></i>
      </div>
      <figure>
         <a href="<?php the_permalink(); ?>">
            <?php
            the_post_thumbnail('small-thumb');
            ?>
         </a>
      </figure>
   <?php } ?>

   <?php if ('post' == get_post_type()) : ?>
      <div class="entry-info">
         <?php masonic_posted_on(); ?>
      </div><!-- .entry-meta -->
   <?php endif; ?>

   <div class="entry-content">
      <?php
      the_excerpt();
      ?>

      <?php
      wp_link_pages(array(
          'before' => '<div class="page-links">' . __('Pages:', 'masonic'),
          'after' => '</div>',
      ));
      ?>
      <a class="button" href="<?php the_permalink(); ?>"><?php _e('Read more', 'masonic'); ?></a>
   </div><!-- .entry-content -->

</article><!-- #post-## -->