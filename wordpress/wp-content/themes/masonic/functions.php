<?php
/**
 * Masonic functions and definitions
 *
 * @package ThemeGrill
 * @subpackage Masonic
 * @since 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if (!isset($content_width)) {
   $content_width = 755; /* pixels */
}

if (!function_exists('masonic_setup')) :

   /**
    * Sets up theme defaults and registers support for various WordPress features.
    *
    * Note that this function is hooked into the after_setup_theme hook, which
    * runs before the init hook. The init hook is too late for some features, such
    * as indicating support for post thumbnails.
    */
   function masonic_setup() {

      /*
       * Make theme available for translation.
       * Translations can be filed in the /languages/ directory.
       * If you're building a theme based on masonic, use a find and replace
       * to change 'masonic' to the name of your theme in all the template files
       */
      load_theme_textdomain('masonic', get_template_directory() . '/languages');

      // Add default posts and comments RSS feed links to head.
      add_theme_support('automatic-feed-links');

      /*
       * Let WordPress manage the document title.
       * By adding theme support, we declare that this theme does not use a
       * hard-coded <title> tag in the document head, and expect WordPress to
       * provide it for us.
       */
      add_theme_support('title-tag');

      // Adds the support for the Custom Logo introduced in WordPress 4.5
      add_theme_support( 'custom-logo', array(
          'flex-width' => true,
          'flex-height' => true,
      ));

	  // Added WooCommerce support.
	  add_theme_support( 'woocommerce' );
	  add_theme_support( 'wc-product-gallery-zoom' );
	  add_theme_support( 'wc-product-gallery-lightbox' );
	  add_theme_support( 'wc-product-gallery-slider' );

      /*
       * Enable support for Post Thumbnails on posts and pages.
       *
       * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
       */
      add_theme_support('post-thumbnails');
      if ( get_theme_mod( 'masonic_featured_image_cropping', 1 ) == 0 ) {
         add_image_size('small-thumb', 350, 9999, true);
      } else {
         add_image_size('small-thumb', 350, 205, true);
      }
      add_image_size('large-thumb', 570, 255, true);

      // This theme uses wp_nav_menu() in one location.
      register_nav_menus(array(
          'primary' => __('Primary Menu', 'masonic'),
      ));

      /*
       * Switch default core markup for search form, comment form, and comments
       * to output valid HTML5.
       */
      add_theme_support('html5', array(
          'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
      ));

      /*
       * Enable support for Post Formats.
       * See http://codex.wordpress.org/Post_Formats
       */
      add_theme_support( 'post-formats', array(
         'video', 'gallery',
      ) );

      // Set up the WordPress core custom background feature.
      add_theme_support('custom-background', apply_filters('masonic_custom_background_args', array(
          'default-color' => 'ffffff',
          'default-image' => '',
      )));
   }

endif; // masonic_setup
add_action('after_setup_theme', 'masonic_setup');

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function masonic_widgets_init() {
   register_sidebar(array(
       'name' => __('Right Sidebar', 'masonic'),
       'id' => 'right-sidebar',
       'description' => '',
       'before_widget' => '<aside id="%1$s" class="blog-post widget %2$s">',
       'after_widget' => '</aside>',
       'before_title' => '<div class="widget-title"><h3>',
       'after_title' => '</h3></div>',
   ));
   register_sidebar(array(
       'name' => __('Footer Sidebar One', 'masonic'),
       'id' => 'footer-sidebar-one',
       'description' => '',
       'before_widget' => '<aside id="%1$s" class="widget %2$s">',
       'after_widget' => '</aside>',
       'before_title' => '<div class="widget-title"><h3>',
       'after_title' => '</h3></div>',
   ));
   register_sidebar(array(
       'name' => __('Footer Sidebar Two', 'masonic'),
       'id' => 'footer-sidebar-two',
       'description' => '',
       'before_widget' => '<aside id="%1$s" class="widget %2$s">',
       'after_widget' => '</aside>',
       'before_title' => '<div class="widget-title"><h3>',
       'after_title' => '</h3></div>',
   ));
   register_sidebar(array(
       'name' => __('Footer Sidebar Three', 'masonic'),
       'id' => 'footer-sidebar-three',
       'description' => '',
       'before_widget' => '<aside id="%1$s" class="widget %2$s">',
       'after_widget' => '</aside>',
       'before_title' => '<div class="widget-title"><h3>',
       'after_title' => '</h3></div>',
   ));
}

add_action('widgets_init', 'masonic_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function masonic_scripts() {
   wp_enqueue_style('masonic-style', get_stylesheet_uri());

   wp_enqueue_style('masonic-google-fonts', '//fonts.googleapis.com/css?family=Open+Sans:400,300italic,700');

   wp_enqueue_style('masonic-font-awesome', get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css');

   if (is_front_page() || is_archive() || is_home() || is_search()) {
      wp_enqueue_script('masonic-setting', get_template_directory_uri() . '/js/masonry-setting.js', array('jquery-masonry', 'jquery'), '20150106', true);
   }

   wp_enqueue_script('masonic-search-toggle', get_template_directory_uri() . '/js/search-toggle.js', array('jquery'), '20150106', true);

   wp_enqueue_script('masonic-fitvids', get_template_directory_uri() . '/js/fitvids/jquery.fitvids.js', array('jquery'), '20150331', true);

   wp_enqueue_script('masonic-fitvids-setting', get_template_directory_uri() . '/js/fitvids/fitvids-setting.js', array('masonic-fitvids'), '20150331', true);

   wp_enqueue_script('masonic-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true);

   wp_enqueue_script('masonic-bxslider', get_template_directory_uri() . '/js/jquery.bxslider/jquery.bxslider.min.js', array('jquery'), '20130115', true);

	wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/js/html5shiv.js', array(), '3.7.3', false );
	wp_script_add_data( 'html5shiv', 'conditional', 'lte IE 8' );

	wp_enqueue_script('masonic-custom', get_template_directory_uri() . '/js/masonic-custom.js', array('jquery'), false, true);

   if (is_singular() && comments_open() && get_option('thread_comments')) {
      wp_enqueue_script('comment-reply');
   }
}

add_action('wp_enqueue_scripts', 'masonic_scripts');

/**
 * Removing the default style of wordpress gallery
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Filtering the size to be full from thumbnail to be used in WordPress gallery as a default size
 */
function masonic_gallery_atts( $out, $pairs, $atts ) {
   $atts = shortcode_atts( array(
   'size' => 'small-thumb',
   ), $atts );

   $out['size'] = $atts['size'];

   return $out;
}
function masonic_gallery_output( $output ) {
   add_filter( 'shortcode_atts_gallery', 'masonic_gallery_atts', 10, 3 );
}
add_action('masonic_gallery_images','masonic_gallery_output');

/**
 * Sets the post excerpt length to 40 words.
 *
 * function tied to the excerpt_length filter hook.
 *
 * @uses filter excerpt_length
 */
function masonic_excerpt_length($length) {
   return 40;
}

add_filter('excerpt_length', 'masonic_excerpt_length');

/**
 * Returns a "Continue Reading" link for excerpts
 */
function masonic_read_more($more) {
   return '';
}

add_filter('excerpt_more', 'masonic_read_more');

/**
 * function to show the footer info, copyright information
 */
if (!function_exists('masonic_footer_copyright')) :

   function masonic_footer_copyright() {
      $wp_link = '<a href="' . 'http://wordpress.org' . '" target="_blank" title="' . esc_attr__('WordPress', 'masonic') . '"><span>' . __('WordPress', 'masonic') . '</span></a>';

      $tg_link = '<a href="' . 'https://themegrill.com/themes/masonic' . '" target="_blank" title="' . esc_attr__('ThemeGrill', 'masonic') . '" rel="author"><span>' . __('ThemeGrill', 'masonic') . '</span></a>';

      $default_footer_value = sprintf(__('Powered by %s', 'masonic'), $wp_link) . ' <br> ' . sprintf(__('Theme: %2$s by %1$s', 'masonic'), $tg_link, 'Masonic');

      $masonic_footer_copyright = $default_footer_value;
      echo $masonic_footer_copyright;
   }

endif;
add_action('masonic_footer_copyright', 'masonic_footer_copyright', 10);

// Adding the ID and CLASS attributes to the first <ul> occurence in wp_page_menu for supporting the default menu
function masonic_add_menuclass($ul) {
   return preg_replace('/<ul>/', '<ul id="menu" class="menu wrapper">', $ul);
}

add_filter('wp_page_menu', 'masonic_add_menuclass');

// Adding the support for the entry-title tag for Google Rich Snippets
function masonic_add_mod_hatom_data($content) {
   $title = get_the_title();
   if (is_single()) {
      $content .= '<div class="extra-hatom-entry-title"><span class="entry-title">' . $title . '</span></div>';
   }
   return $content;
}

add_filter('the_content', 'masonic_add_mod_hatom_data');

/*
 * Creating responsive video for posts/pages
 */
if ( !function_exists('masonic_responsive_video') ) :
   function masonic_responsive_video( $html, $url, $attr, $post_ID ) {
       return '<div class="responsive-video">'.$html.'</div>';
   }
   add_filter( 'embed_oembed_html', 'masonic_responsive_video', 10, 4 ) ;
endif;

/*
 * Adding the custom meta box for supporting the post formats
 */
function masonic_post_format_meta_box() {
   add_meta_box( 'post-video-url', __('Video URL', 'masonic'), 'masonic_post_format_video_url', 'post', 'side', 'high' );
}
add_action( 'add_meta_boxes', 'masonic_post_format_meta_box' );

function masonic_post_format_video_url( $post ) {
   $video_post_id = get_post_custom( $post->ID );
   $video_post_url = isset( $video_post_id['video_url'] ) ? esc_attr( $video_post_id['video_url'][0] ) : '';
   wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
   ?>
      <p>
         <input type="text" class="widefat" name="video_url" id="video_url" value="<?php echo $video_post_url; ?>" />
      </p>
   <?php
}

function masonic_post_meta_save( $post_id ) {
   if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

   // checking if the nonce isn't there, or we can't verify it, then we should return
   if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;

   // checking if the current user can't edit this post, then we should return
   if( !current_user_can( 'edit_posts' ) ) return;

   // saving the data in meta box
   // saving the video url in the meta box
   if( isset( $_POST['video_url'] ) ) {
      update_post_meta( $post_id, 'video_url', esc_url_raw( $_POST['video_url'] ) );
   }
}

add_action( 'save_post', 'masonic_post_meta_save' );

function masonic_meta_box_display_toggle() {
   $custom_script = '
   <script type="text/javascript">
      jQuery(document).ready(function() {
         // hide the div by default
         jQuery( "#post-video-url" ).hide();

         // if post format is selected, then, display the respective div
         if(jQuery( "#post-format-video" ).is( ":checked" ))
            jQuery( "#post-video-url" ).show();

         // hiding the default post format type input box by default
         jQuery( "input[name=\"post_format\"]" ).change(function() {
            jQuery( "#post-video-url" ).hide();
         });

         // if post format is selected, then, display the respective input div
         jQuery( "input#post-format-video" ).change( function() {
            jQuery( "#post-video-url" ).show();
         });
      });
   </script>
   ';

   return print $custom_script;
}

add_action( 'admin_footer', 'masonic_meta_box_display_toggle' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Post Formats additions.
 */
require get_template_directory() . '/inc/post-formats.php';

/**
 * Load Demo Importer Configs.
 */
if ( class_exists( 'TG_Demo_Importer' ) ) {
  require get_template_directory() . '/inc/demo-config.php';
}

/**
 * Assign the Masonic version to a variable.
 */
$theme            = wp_get_theme( 'masonic' );
$masonic_version = $theme['Version'];

/* Calling in the admin area for the Welcome Page */
if ( is_admin() ) {
	require get_template_directory() . '/inc/admin/class-masonic-admin.php';
  require get_template_directory() . '/inc/admin/class-masonic-tdi-notice.php';

/**
 * Load TGMPA Configs.
 */
require get_template_directory() . '/inc/tgm-plugin-activation/class-tgm-plugin-activation.php';
require get_template_directory() . '/inc/tgm-plugin-activation/tgmpa-masonic.php';
}

