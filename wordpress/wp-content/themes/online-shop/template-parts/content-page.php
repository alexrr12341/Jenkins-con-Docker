<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Acme Themes
 * @subpackage Online Shop
 */
global $online_shop_customizer_all_values;
$online_shop_blog_no_image = '';
$online_shop_single_image_layout = $online_shop_customizer_all_values['online-shop-single-img-size'];
if( !has_post_thumbnail() || 'disable' == $online_shop_single_image_layout) {
	$online_shop_blog_no_image = 'blog-no-image';
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $online_shop_blog_no_image ); ?>>
    <!--post thumbnal options-->
	<?php if( has_post_thumbnail( ) && 'disable' != $online_shop_single_image_layout ) {
		?>
        <div class="post-thumb">
			<?php
			the_post_thumbnail( $online_shop_single_image_layout );
			?>
        </div><!-- .post-thumb-->
		<?php
	}
	?>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
	<div class="entry-content clearfix">
		<?php
        the_content();
        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'online-shop' ),
            'after'  => '</div>',
        ) );
		?>
	</div><!-- .entry-content -->

    <?php
    if( get_edit_post_link( ) ){
        ?>
        <footer class="entry-footer">
            <?php
            edit_post_link(
                    sprintf(
                            /* translators: %s: Name of current post */
                            esc_html__( 'Edit %s', 'online-shop' ),
                            the_title( '<span class="screen-reader-text">"', '"</span>', false )
                    ),
                    '<span class="edit-link">',
                    '</span>'
            );
            ?>
        </footer><!-- .entry-footer -->
        <?php
    }
    ?>
</article><!-- #post-## -->