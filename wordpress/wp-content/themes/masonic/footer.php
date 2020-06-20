<?php
/**
 * Theme Footer Section for our theme.
 * 
 * Displays all of the footer section and closing of the #page div.
 *
 * @package ThemeGrill
 * @subpackage Masonic
 * @since 1.0
 */
?>

</div><!-- #page -->
<footer class="footer-background">
   <div class="footer-content wrapper clear">
      <div class="clear">
         <?php if (is_active_sidebar('footer-sidebar-one')) { ?>
            <div class="tg-one-third">
               <?php
               dynamic_sidebar('footer-sidebar-one');
               ?>
            </div>
         <?php } ?>
         <?php if (is_active_sidebar('footer-sidebar-two')) { ?>
            <div class="tg-one-third">
               <?php
               dynamic_sidebar('footer-sidebar-two');
               ?>
            </div>
         <?php } ?>
         <?php if (is_active_sidebar('footer-sidebar-three')) { ?>
            <div class="tg-one-third last">
               <?php
               dynamic_sidebar('footer-sidebar-three');
               ?>
            </div>
         <?php } ?>
      </div>
      <div class="copyright clear">
         <div class="copyright-header"><?php echo bloginfo('name'); ?></div>
         <div class="copyright-year"><?php
            _e('&copy; ', 'masonic');
            echo date('Y');
            ?></div>
         <?php masonic_footer_copyright(); ?>
      </div>
   </div>
   <div class="angled-background"></div>
</footer>

<?php wp_footer(); ?>

</body>
</html>