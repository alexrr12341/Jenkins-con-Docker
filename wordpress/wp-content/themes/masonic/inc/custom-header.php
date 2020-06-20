<?php
/**
 * Implements a custom header for Masonic.
 * See http://codex.wordpress.org/Custom_Headers
 *
 * @package ThemeGrill
 * @subpackage Masonic
 * @since 1.0
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses masonic_header_style()
 * @uses masonic_admin_header_style()
 * @uses masonic_admin_header_image()
 */
function masonic_custom_header_setup() {
   add_theme_support('custom-header', apply_filters('masonic_custom_header_args', array(
       'default-image' => '%s/img/header.jpg',
       'default-text-color' => 'FFFFFF',
       'width' => 1350,
       'height' => 500,
       'flex-height' => true,
       'video' => true,
       'wp-head-callback' => 'masonic_header_style',
       'admin-head-callback' => 'masonic_admin_header_style',
       'admin-preview-callback' => 'masonic_admin_header_image',
   )));

   // passing the default header image
   register_default_headers(array(
       'header-image' => array(
           'url' => '%s/img/header.jpg',
           'thumbnail_url' => '%s/img/header.jpg',
           'description' => __('Header Image', 'masonic')
       )
   ));
}

add_action('after_setup_theme', 'masonic_custom_header_setup');

if (!function_exists('masonic_header_style')) :

   /**
    * Styles the header image and text displayed on the blog
    *
    * @see masonic_custom_header_setup().
    */
   function masonic_header_style() {
      $header_text_color = get_header_textcolor();

      // If no custom options for text are set, let's bail
      // get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
      if (HEADER_TEXTCOLOR == $header_text_color) {
         return;
      }

      // If we get this far, we have custom styles. Let's do this.
      ?>
      <style type="text/css">
      <?php
// Has the text been hidden?
      if ('blank' == $header_text_color) :
         ?>
            .site-title,
            .site-description {
               position: absolute;
               clip: rect(1px, 1px, 1px, 1px);
            }
         <?php
// If the user has set a custom color for the text use that
      else :
         ?>
            .site-title a,
            .site-description {
               color: #<?php echo esc_attr($header_text_color); ?>;
            }
      <?php endif; ?>
      </style>
      <?php
   }

endif; // masonic_header_style

if (!function_exists('masonic_admin_header_style')) :

   /**
    * Styles the header image displayed on the Appearance > Header admin panel.
    *
    * @see masonic_custom_header_setup().
    */
   function masonic_admin_header_style() {
      ?>
      <style type="text/css">
         .appearance_page_custom-header #headimg {
            border: none;
         }
         #headimg h1,
         #desc {
         }
         #headimg h1 {
         }
         #headimg h1 a {
         }
         #desc {
         }
         #headimg img {
         }
      </style>
      <?php
   }

endif; // masonic_admin_header_style

if (!function_exists('masonic_admin_header_image')) :

   /**
    * Custom header image markup displayed on the Appearance > Header admin panel.
    *
    * @see masonic_custom_header_setup().
    */
	function masonic_admin_header_image() {
	$style = sprintf(' style="color:#%s;"', get_header_textcolor());
	?>
		<div id="headimg">
		<?php if ( function_exists('the_custom_header_markup') ) {
			the_custom_header_markup();
		} else { ?>
			<h1 class="displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
			<div class="displaying-header-text" id="desc"<?php echo $style; ?>><?php bloginfo('description'); ?></div>
			<?php if (get_header_image()) : ?>
				<img src="<?php header_image(); ?>" alt="">
			<?php endif; ?>
		<?php } ?>
		</div>
	<?php
	}

endif; // masonic_admin_header_image
