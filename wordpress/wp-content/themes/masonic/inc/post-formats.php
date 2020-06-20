<?php if ( has_post_format( 'gallery' ) ) : ?>
   <?php do_action( 'masonic_gallery_images' ); ?>
   <script type="text/javascript">
      jQuery(document).ready(function(){
         jQuery('.gallery-images').bxSlider({
            mode: 'fade',
            speed: 1500,
            auto: true,
            pause: 3000,
            adaptiveHeight: true,
            nextText: '',
            prevText: '',
            nextSelector: '.slide-next',
            prevSelector: '.slide-prev',
            pager: false
         });
      });
   </script>
   <div class="gallery-post-format">
      <?php
      $galleries = get_post_gallery_images( $post );

      $output = '<ul class="gallery-images">';
      foreach ($galleries as $gallery) {
         $output .= '<li>' . '<img src="'. $gallery . '">' . '</li>';
      }
      $output .= '</ul>';

      echo $output;
      ?>
   </div>
<?php endif; ?>
<?php if ( has_post_format( 'video' ) ) : ?>
   <?php $video_post_url = get_post_meta($post->ID, 'video_url', true); ?>
   <?php if ( !empty($video_post_url) ) : ?>
      <div class="responsive-video">
         <?php
            $embed_code = wp_oembed_get( $video_post_url );
            echo $embed_code;
         ?>
      </div>
   <?php endif; ?>
<?php endif; ?>