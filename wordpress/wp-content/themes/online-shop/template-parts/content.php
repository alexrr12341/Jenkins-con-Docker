<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Acme Themes
 * @subpackage Online Shop
 */
$online_shop_customizer_all_values = online_shop_get_theme_options();
$online_shop_blog_no_image = '';
if( !has_post_thumbnail() || 'no-image' == $online_shop_customizer_all_values['online-shop-blog-archive-layout'] ) {
	$online_shop_blog_no_image = 'blog-no-image';
}

$online_shop_get_image_sizes_options = $online_shop_customizer_all_values['online-shop-blog-archive-img-size'];
$online_shop_blog_archive_read_more = $online_shop_customizer_all_values['online-shop-blog-archive-more-text'];
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $online_shop_blog_no_image ); ?>>
	<?php
	if( has_post_thumbnail() && 'show-image' == $online_shop_customizer_all_values['online-shop-blog-archive-layout'] ) {
		?>
		<!--post thumbnal options-->
		<div class="post-thumb">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( $online_shop_get_image_sizes_options );?>
			</a>
		</div><!-- .post-thumb-->
	<?php
	}
	?>
	<div class="post-content">
		<header class="entry-header">
			<?php
			online_shop_list_post_category();
			the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			<div class="entry-meta">
				<?php
                if ( 'post' === get_post_type() ) :
                    online_shop_posted_on();
				endif;
				online_shop_entry_footer();
				?>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->
		<div class="entry-content">
			<?php
			the_excerpt();
			if( !empty( $online_shop_blog_archive_read_more ) ){
				?>
                <a class="read-more" href="<?php the_permalink(); ?> ">
					<?php echo esc_html( $online_shop_blog_archive_read_more ); ?>
                </a>
				<?php
			}
			?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->