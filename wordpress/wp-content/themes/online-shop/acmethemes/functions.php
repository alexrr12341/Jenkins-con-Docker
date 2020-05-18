<?php
/**
 * List down the product category
 *
 * @since Online Shop 1.0.0
 *
 * @param int $post_id
 * @return string list of category
 *
 */
if ( !function_exists('online_shop_list_product_category') ) :
	function online_shop_list_product_category( $post_id = 0 ) {

		if( 0 == $post_id ){
			global $post;
			$post_id = $post->ID;
		}
		$terms = get_the_terms( $post_id, 'product_cat' );
		$separator = '&nbsp;';
		$output = '';
		if ( $terms && ! is_wp_error( $terms ) ) :
			echo '<span class="cat-links">';
			foreach($terms as $term) {
				$output .= '<a class="at-cat-item-'.esc_attr($term->term_id).'" href="'.esc_url( get_term_link( $term->term_id, 'product_cat' ) ).'"  rel="category tag">'.esc_html( $term->name ).'</a>'.$separator;
			}
			echo trim($output, $separator);
			echo '</span>';
		endif;
	}
endif;

/**
 * List down the post category
 *
 * @since Online Shop 1.0.0
 *
 * @param int $post_id
 * @return string list of category
 *
 */
if ( !function_exists('online_shop_list_post_category') ) :
    function online_shop_list_post_category( $post_id = 0 ) {

        if( 0 == $post_id ){
            global $post;
            $post_id = $post->ID;
        }
        $categories = get_the_category($post_id);
        $separator = '&nbsp;';
        $output = '';
        if($categories) {
            echo '<span class="cat-links">';
            foreach($categories as $category) {
	            $output .= '<a class="at-cat-item-'.esc_attr($category->term_id).'" href="'.esc_url( get_category_link( $category->term_id ) ).'"  rel="category tag">'.esc_html( $category->cat_name ).'</a>'.$separator;
            }
            echo '</span>';
            echo trim($output, $separator);
        }
    }
endif;

/**
 * Callback functions for comments
 *
 * @since Online Shop 1.0.0
 *
 * @param $comment
 * @param $args
 * @param $depth
 * @return void
 *
 */
if ( !function_exists('online_shop_commment_list') ) :

    function online_shop_commment_list($comment, $args, $depth) {
        if ('div' == $args['style']) {
            $tag = 'div';
            $add_below = 'comment';
        }
        else {
            $tag = 'li';
            $add_below = 'div-comment';
        }
        ?>
        <<?php echo $tag ?>
        <?php comment_class(empty($args['has_children']) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
        <?php if ('div' != $args['style']) : ?>
            <div id="div-comment-<?php comment_ID() ?>" class="comment-body clearfix">
        <?php endif; ?>
        <div class="comment-author vcard">
            <?php
            if ($args['avatar_size'] != 0) echo get_avatar($comment, '64');
            printf('%s', '<cite class="fn">'.get_comment_author_link().'</cite>' );
            ?>
        </div>
        <?php if ($comment->comment_approved == '0') : ?>
            <em class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'online-shop'); ?></em>
            <br/>
        <?php endif; ?>
        <div class="comment-meta commentmetadata">
            <a href="<?php echo esc_url( get_comment_link($comment->comment_ID) ); ?>">
                <i class="fa fa-clock-o"></i>
                <?php
                /* translators: 1: date, 2: time */
                printf(esc_html__('%1$s at %2$s', 'online-shop'), get_comment_date(), get_comment_time()); ?>
            </a>
            <?php edit_comment_link(esc_html__('(Edit)', 'online-shop'), '  ', ''); ?>
        </div>
        <?php comment_text(); ?>
        <div class="reply">
            <?php comment_reply_link( array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        </div>
        <?php if ('div' != $args['style']) : ?>
            </div>
        <?php endif;
    }
endif;

/**
 * Excerpt with length
 *
 * @since 1.0.0
 *
 * @param int     $length Excerpt length in words.
 * @param WP_Post $post_obj WP_Post instance (Optional).
 * @return string Excerpt.
 */
if ( ! function_exists( 'online_shop_excerpt_words_count' ) ) :
    
	function online_shop_excerpt_words_count( $length = 40, $post_obj = null ) {

		global $post;
		if ( is_null( $post_obj ) ) {
			$post_obj = $post;
		}
		$length = absint( $length );
		if ( $length < 1 ) {
			$length = 40;
		}
		$source_content = $post_obj->post_content;
		if ( ! empty( $post_obj->post_excerpt ) ) {
			$source_content = $post_obj->post_excerpt;
		}
		$source_content = preg_replace( '`\[[^\]]*\]`', '', $source_content );
		$trimmed_content = wp_trim_words( $source_content, $length, '...' );
		return $trimmed_content;
	}
endif;

/**
 * BreadCrumb Settings
 */
if( ! function_exists( 'online_shop_breadcrumbs' ) ):
	function online_shop_breadcrumbs() {
		$online_shop_customizer_all_values = online_shop_get_theme_options();
		$online_shop_breadcrumb_options = $online_shop_customizer_all_values['online-shop-breadcrumb-options'];
		if( 'disable' != $online_shop_breadcrumb_options ){
            $breadcrumb_args = array(
				'container'   => 'div',
				'delimiter'   => '&nbsp;&#47;&nbsp;',
				'show_browse' => false
			);

			echo "<div class='breadcrumbs clearfix'><div id='online-shop-breadcrumbs'>";
			if( 'wc-breadcrumb' == $online_shop_breadcrumb_options && online_shop_is_woocommerce_active() ){
				woocommerce_breadcrumb(  $breadcrumb_args );
            }
            else{
	            if ( ! function_exists( 'breadcrumb_trail' ) ) {
		            require_once online_shop_file_directory('acmethemes/library/breadcrumbs/breadcrumbs.php');
	            }
	            breadcrumb_trail( $breadcrumb_args );
            }
			echo "</div></div><div class='clear'></div>";
        }
	}
endif;

/**
 *  Get all Font Awesome Icons
 * https://gist.github.com/codersantosh/b4f423fec60fe598b315594fac0a5812
 */
if (!function_exists('online_shop_icons_array')) {
	function online_shop_icons_array(){
		$fa_icon_list = ' fa-glass, fa-music, fa-search, fa-envelope-o, fa-heart, fa-star, fa-star-o, fa-user, fa-film, fa-th-large, fa-th, fa-th-list, fa-check, fa-times, fa-search-plus, fa-search-minus, fa-power-off, fa-signal, fa-cog, fa-trash-o, fa-home, fa-file-o, fa-clock-o, fa-road, fa-download, fa-arrow-circle-o-down, fa-arrow-circle-o-up, fa-inbox, fa-play-circle-o, fa-repeat, fa-refresh, fa-list-alt, fa-lock, fa-flag, fa-headphones, fa-volume-off, fa-volume-down, fa-volume-up, fa-qrcode, fa-barcode, fa-tag, fa-tags, fa-book, fa-bookmark, fa-print, fa-camera, fa-font, fa-bold, fa-italic, fa-text-height, fa-text-width, fa-align-left, fa-align-center, fa-align-right, fa-align-justify, fa-list, fa-outdent, fa-indent, fa-video-camera, fa-picture-o, fa-pencil, fa-map-marker, fa-adjust, fa-tint, fa-pencil-square-o, fa-share-square-o, fa-check-square-o, fa-arrows, fa-step-backward, fa-fast-backward, fa-backward, fa-play, fa-pause, fa-stop, fa-forward, fa-fast-forward, fa-step-forward, fa-eject, fa-chevron-left, fa-chevron-right, fa-plus-circle, fa-minus-circle, fa-times-circle, fa-check-circle, fa-question-circle, fa-info-circle, fa-crosshairs, fa-times-circle-o, fa-check-circle-o, fa-ban, fa-arrow-left, fa-arrow-right, fa-arrow-up, fa-arrow-down, fa-share, fa-expand, fa-compress, fa-plus, fa-minus, fa-asterisk, fa-exclamation-circle, fa-gift, fa-leaf, fa-fire, fa-eye, fa-eye-slash, fa-exclamation-triangle, fa-plane, fa-calendar, fa-random, fa-comment, fa-magnet, fa-chevron-up, fa-chevron-down, fa-retweet, fa-shopping-cart, fa-folder, fa-folder-open, fa-arrows-v, fa-arrows-h, fa-bar-chart, fa-twitter-square, fa-facebook-square, fa-camera-retro, fa-key, fa-cogs, fa-comments, fa-thumbs-o-up, fa-thumbs-o-down, fa-star-half, fa-heart-o, fa-sign-out, fa-linkedin-square, fa-thumb-tack, fa-external-link, fa-sign-in, fa-trophy, fa-github-square, fa-upload, fa-lemon-o, fa-phone, fa-square-o, fa-bookmark-o, fa-phone-square, fa-twitter, fa-facebook, fa-github, fa-unlock, fa-credit-card, fa-rss, fa-hdd-o, fa-bullhorn, fa-bell, fa-certificate, fa-hand-o-right, fa-hand-o-left, fa-hand-o-up, fa-hand-o-down, fa-arrow-circle-left, fa-arrow-circle-right, fa-arrow-circle-up, fa-arrow-circle-down, fa-globe, fa-wrench, fa-tasks, fa-filter, fa-briefcase, fa-arrows-alt, fa-users, fa-link, fa-cloud, fa-flask, fa-scissors, fa-files-o, fa-paperclip, fa-floppy-o, fa-square, fa-bars, fa-list-ul, fa-list-ol, fa-strikethrough, fa-underline, fa-table, fa-magic, fa-truck, fa-pinterest, fa-pinterest-square, fa-google-plus-square, fa-google-plus, fa-money, fa-caret-down, fa-caret-up, fa-caret-left, fa-caret-right, fa-columns, fa-sort, fa-sort-desc, fa-sort-asc, fa-envelope, fa-linkedin, fa-undo, fa-gavel, fa-tachometer, fa-comment-o, fa-comments-o, fa-bolt, fa-sitemap, fa-umbrella, fa-clipboard, fa-lightbulb-o, fa-exchange, fa-cloud-download, fa-cloud-upload, fa-user-md, fa-stethoscope, fa-suitcase, fa-bell-o, fa-coffee, fa-cutlery, fa-file-text-o, fa-building-o, fa-hospital-o, fa-ambulance, fa-medkit, fa-fighter-jet, fa-beer, fa-h-square, fa-plus-square, fa-angle-double-left, fa-angle-double-right, fa-angle-double-up, fa-angle-double-down, fa-angle-left, fa-angle-right, fa-angle-up, fa-angle-down, fa-desktop, fa-laptop, fa-tablet, fa-mobile, fa-circle-o, fa-quote-left, fa-quote-right, fa-spinner, fa-circle, fa-reply, fa-github-alt, fa-folder-o, fa-folder-open-o, fa-smile-o, fa-frown-o, fa-meh-o, fa-gamepad, fa-keyboard-o, fa-flag-o, fa-flag-checkered, fa-terminal, fa-code, fa-reply-all, fa-star-half-o, fa-location-arrow, fa-crop, fa-code-fork, fa-chain-broken, fa-question, fa-info, fa-exclamation, fa-superscript, fa-subscript, fa-eraser, fa-puzzle-piece, fa-microphone, fa-microphone-slash, fa-shield, fa-calendar-o, fa-fire-extinguisher, fa-rocket, fa-maxcdn, fa-chevron-circle-left, fa-chevron-circle-right, fa-chevron-circle-up, fa-chevron-circle-down, fa-html5, fa-css3, fa-anchor, fa-unlock-alt, fa-bullseye, fa-ellipsis-h, fa-ellipsis-v, fa-rss-square, fa-play-circle, fa-ticket, fa-minus-square, fa-minus-square-o, fa-level-up, fa-level-down, fa-check-square, fa-pencil-square, fa-external-link-square, fa-share-square, fa-compass, fa-caret-square-o-down, fa-caret-square-o-up, fa-caret-square-o-right, fa-eur, fa-gbp, fa-usd, fa-inr, fa-jpy, fa-rub, fa-krw, fa-btc, fa-file, fa-file-text, fa-sort-alpha-asc, fa-sort-alpha-desc, fa-sort-amount-asc, fa-sort-amount-desc, fa-sort-numeric-asc, fa-sort-numeric-desc, fa-thumbs-up, fa-thumbs-down, fa-youtube-square, fa-youtube, fa-xing, fa-xing-square, fa-youtube-play, fa-dropbox, fa-stack-overflow, fa-instagram, fa-flickr, fa-adn, fa-bitbucket, fa-bitbucket-square, fa-tumblr, fa-tumblr-square, fa-long-arrow-down, fa-long-arrow-up, fa-long-arrow-left, fa-long-arrow-right, fa-apple, fa-windows, fa-android, fa-linux, fa-dribbble, fa-skype, fa-foursquare, fa-trello, fa-female, fa-male, fa-gratipay, fa-sun-o, fa-moon-o, fa-archive, fa-bug, fa-vk, fa-weibo, fa-renren, fa-pagelines, fa-stack-exchange, fa-arrow-circle-o-right, fa-arrow-circle-o-left, fa-caret-square-o-left, fa-dot-circle-o, fa-wheelchair, fa-vimeo-square, fa-try, fa-plus-square-o, fa-space-shuttle, fa-slack, fa-envelope-square, fa-wordpress, fa-openid, fa-university, fa-graduation-cap, fa-yahoo, fa-google, fa-reddit, fa-reddit-square, fa-stumbleupon-circle, fa-stumbleupon, fa-delicious, fa-digg, fa-pied-piper-pp, fa-pied-piper-alt, fa-drupal, fa-joomla, fa-language, fa-fax, fa-building, fa-child, fa-paw, fa-spoon, fa-cube, fa-cubes, fa-behance, fa-behance-square, fa-steam, fa-steam-square, fa-recycle, fa-car, fa-taxi, fa-tree, fa-spotify, fa-deviantart, fa-soundcloud, fa-database, fa-file-pdf-o, fa-file-word-o, fa-file-excel-o, fa-file-powerpoint-o, fa-file-image-o, fa-file-archive-o, fa-file-audio-o, fa-file-video-o, fa-file-code-o, fa-vine, fa-codepen, fa-jsfiddle, fa-life-ring, fa-circle-o-notch, fa-rebel, fa-empire, fa-git-square, fa-git, fa-hacker-news, fa-tencent-weibo, fa-qq, fa-weixin, fa-paper-plane, fa-paper-plane-o, fa-history, fa-circle-thin, fa-header, fa-paragraph, fa-sliders, fa-share-alt, fa-share-alt-square, fa-bomb, fa-futbol-o, fa-tty, fa-binoculars, fa-plug, fa-slideshare, fa-twitch, fa-yelp, fa-newspaper-o, fa-wifi, fa-calculator, fa-paypal, fa-google-wallet, fa-cc-visa, fa-cc-mastercard, fa-cc-discover, fa-cc-amex, fa-cc-paypal, fa-cc-stripe, fa-bell-slash, fa-bell-slash-o, fa-trash, fa-copyright, fa-at, fa-eyedropper, fa-paint-brush, fa-birthday-cake, fa-area-chart, fa-pie-chart, fa-line-chart, fa-lastfm, fa-lastfm-square, fa-toggle-off, fa-toggle-on, fa-bicycle, fa-bus, fa-ioxhost, fa-angellist, fa-cc, fa-ils, fa-meanpath, fa-buysellads, fa-connectdevelop, fa-dashcube, fa-forumbee, fa-leanpub, fa-sellsy, fa-shirtsinbulk, fa-simplybuilt, fa-skyatlas, fa-cart-plus, fa-cart-arrow-down, fa-diamond, fa-ship, fa-user-secret, fa-motorcycle, fa-street-view, fa-heartbeat, fa-venus, fa-mars, fa-mercury, fa-transgender, fa-transgender-alt, fa-venus-double, fa-mars-double, fa-venus-mars, fa-mars-stroke, fa-mars-stroke-v, fa-mars-stroke-h, fa-neuter, fa-genderless, fa-facebook-official, fa-pinterest-p, fa-whatsapp, fa-server, fa-user-plus, fa-user-times, fa-bed, fa-viacoin, fa-train, fa-subway, fa-medium, fa-y-combinator, fa-optin-monster, fa-opencart, fa-expeditedssl, fa-battery-full, fa-battery-three-quarters, fa-battery-half, fa-battery-quarter, fa-battery-empty, fa-mouse-pointer, fa-i-cursor, fa-object-group, fa-object-ungroup, fa-sticky-note, fa-sticky-note-o, fa-cc-jcb, fa-cc-diners-club, fa-clone, fa-balance-scale, fa-hourglass-o, fa-hourglass-start, fa-hourglass-half, fa-hourglass-end, fa-hourglass, fa-hand-rock-o, fa-hand-paper-o, fa-hand-scissors-o, fa-hand-lizard-o, fa-hand-spock-o, fa-hand-pointer-o, fa-hand-peace-o, fa-trademark, fa-registered, fa-creative-commons, fa-gg, fa-gg-circle, fa-tripadvisor, fa-odnoklassniki, fa-odnoklassniki-square, fa-get-pocket, fa-wikipedia-w, fa-safari, fa-chrome, fa-firefox, fa-opera, fa-internet-explorer, fa-television, fa-contao, fa-500px, fa-amazon, fa-calendar-plus-o, fa-calendar-minus-o, fa-calendar-times-o, fa-calendar-check-o, fa-industry, fa-map-pin, fa-map-signs, fa-map-o, fa-map, fa-commenting, fa-commenting-o, fa-houzz, fa-vimeo, fa-black-tie, fa-fonticons, fa-reddit-alien, fa-edge, fa-credit-card-alt, fa-codiepie, fa-modx, fa-fort-awesome, fa-usb, fa-product-hunt, fa-mixcloud, fa-scribd, fa-pause-circle, fa-pause-circle-o, fa-stop-circle, fa-stop-circle-o, fa-shopping-bag, fa-shopping-basket, fa-hashtag, fa-bluetooth, fa-bluetooth-b, fa-percent, fa-gitlab, fa-wpbeginner, fa-wpforms, fa-envira, fa-universal-access, fa-wheelchair-alt, fa-question-circle-o, fa-blind, fa-audio-description, fa-volume-control-phone, fa-braille, fa-assistive-listening-systems, fa-american-sign-language-interpreting, fa-deaf, fa-glide, fa-glide-g, fa-sign-language, fa-low-vision, fa-viadeo, fa-viadeo-square, fa-snapchat, fa-snapchat-ghost, fa-snapchat-square, fa-pied-piper, fa-first-order, fa-yoast, fa-themeisle, fa-google-plus-official, fa-font-awesome, fa-handshake-o, fa-envelope-open, fa-envelope-open-o, fa-linode, fa-address-book, fa-address-book-o, fa-address-card, fa-address-card-o, fa-user-circle, fa-user-circle-o, fa-user-o, fa-id-badge, fa-id-card, fa-id-card-o, fa-quora, fa-free-code-camp, fa-telegram, fa-thermometer-full, fa-thermometer-three-quarters, fa-thermometer-half, fa-thermometer-quarter, fa-thermometer-empty, fa-shower, fa-bath, fa-podcast, fa-window-maximize, fa-window-minimize, fa-window-restore, fa-window-close, fa-window-close-o, fa-bandcamp, fa-grav, fa-etsy, fa-imdb, fa-ravelry, fa-eercast, fa-microchip, fa-snowflake-o, fa-superpowers, fa-wpexplorer, fa-meetup' ;
		$fa_icon_list_array = explode( ", " , $fa_icon_list);
		return $fa_icon_list_array;
	}
}

/**
 * Column Selection
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return array $online_shop_widget_column_number
 *
 */
if ( !function_exists('online_shop_widget_column_number') ) :
	function online_shop_widget_column_number() {
		$online_shop_widget_column_number =  array(
			1 => esc_html__( '1', 'online-shop' ),
			2 => esc_html__( '2', 'online-shop' ),
			3 => esc_html__( '3', 'online-shop' ),
			4 =>  esc_html__( '4', 'online-shop' )
		);
		return apply_filters( 'online_shop_widget_column_number', $online_shop_widget_column_number );
	}
endif;

/**
 * Display Type
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return array $online_shop_widget_display_type
 *
 */
if ( !function_exists('online_shop_widget_display_type') ) :
	function online_shop_widget_display_type() {
		$online_shop_widget_display_type =  array(
			'column' => esc_html__( 'Normal Column', 'online-shop' ),
			'carousel' => esc_html__( 'Carousel Column', 'online-shop' )
        );
		return apply_filters( 'online_shop_widget_display_type', $online_shop_widget_display_type );
	}
endif;

/**
 * Post advanced options
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return array $online_shop_post_advanced_options
 *
 */
if ( !function_exists('online_shop_post_advanced_options') ) :
	function online_shop_post_advanced_options() {
		$online_shop_post_advanced_options =  array(
			'recent' => esc_html__( 'All posts', 'online-shop' ),
			'cat' => esc_html__( 'Categories', 'online-shop' ),
			'tag' => esc_html__( 'Tags', 'online-shop' )
		);
		return apply_filters( 'online_shop_post_advanced_options', $online_shop_post_advanced_options );
	}
endif;

/**
 * Default Post Order By
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return array $online_shop_post_orderby
 *
 */
if ( !function_exists('online_shop_post_orderby') ) :
	function online_shop_post_orderby() {
		$online_shop_post_orderby =  array(
			'none' => esc_html__( 'None', 'online-shop' ),
			'ID' => esc_html__( 'ID', 'online-shop' ),
			'author' => esc_html__( 'Author', 'online-shop' ),
			'title' => esc_html__( 'Title', 'online-shop' ),
			'date' => esc_html__( 'Date', 'online-shop' ),
			'modified' => esc_html__( 'Modified Date', 'online-shop' ),
			'rand' => esc_html__( 'Random', 'online-shop' ),
			'comment_count' => esc_html__( 'Comment Count', 'online-shop' ),
			'menu_order' => esc_html__( 'Menu Order', 'online-shop' )
		);
		return apply_filters( 'online_shop_post_orderby', $online_shop_post_orderby );
	}
endif;

/**
 * Order ASC DESC
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return array $online_shop_post_order
 *
 */
if ( !function_exists('online_shop_post_order') ) :
	function online_shop_post_order() {
		$online_shop_post_order =  array(
			'ASC' => esc_html__( 'ASC', 'online-shop' ),
			'DESC' => esc_html__( 'DESC', 'online-shop' )
        );
		return apply_filters( 'online_shop_post_order', $online_shop_post_order );
	}
endif;

/**
 * WooCommerce Advanced Options
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return array $online_shop_wc_advanced_options
 *
 */
if ( !function_exists('online_shop_wc_advanced_options') ) :
	function online_shop_wc_advanced_options() {
		$online_shop_wc_advanced_options =  array(
			'recent' => esc_html__( 'All products', 'online-shop' ),
			'cat' => esc_html__( 'Categories', 'online-shop' ),
			'tag' => esc_html__( 'Tags', 'online-shop' ),
			'featured' => esc_html__( 'Featured products', 'online-shop' ),
			'onsale' => esc_html__( 'On-sale products', 'online-shop' ),
		);
		return apply_filters( 'online_shop_wc_advanced_options', $online_shop_wc_advanced_options );
	}
endif;

/**
 * Order by
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return array $online_shop_wc_product_orderby
 *
 */
if ( !function_exists('online_shop_wc_product_orderby') ) :
	function online_shop_wc_product_orderby() {
		$online_shop_wc_product_orderby =  array(
			'none' => esc_html__( 'None', 'online-shop' ),
			'ID' => esc_html__( 'ID', 'online-shop' ),
			'author' => esc_html__( 'Author', 'online-shop' ),
			'title' => esc_html__( 'Title', 'online-shop' ),
			'date' => esc_html__( 'Date', 'online-shop' ),
			'modified' => esc_html__( 'Modified Date', 'online-shop' ),
			'rand' => esc_html__( 'Random', 'online-shop' ),
			'comment_count' => esc_html__( 'Comment Count', 'online-shop' ),
			'menu_order' => esc_html__( 'Menu Order', 'online-shop' ),
			'sales' => esc_html__( 'Sales', 'online-shop' ),
			'price' => esc_html__( 'Price', 'online-shop' ),
		);
		return apply_filters( 'online_shop_wc_product_orderby', $online_shop_wc_product_orderby );
	}
endif;

/**
 * Show selected category image and details
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return array $online_shop_wc_cat_display_options
 *
 */
if ( !function_exists('online_shop_wc_cat_display_options') ) :
	function online_shop_wc_cat_display_options() {
		$online_shop_wc_cat_display_options =  array(
			'disable' => esc_html__( 'Disable', 'online-shop' ),
			'left' => esc_html__( 'Left', 'online-shop' ),
			'right' => esc_html__( 'Right', 'online-shop' )
        );
		return apply_filters( 'online_shop_wc_cat_display_options', $online_shop_wc_cat_display_options );
	}
endif;

/**
 * View all options
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return array $online_shop_adv_link_options
 *
 */
if ( !function_exists('online_shop_adv_link_options') ) :
	function online_shop_adv_link_options() {
		$online_shop_adv_link_options =  array(
			'disable' => esc_html__( 'Disable', 'online-shop' ),
			'normal-link' => esc_html__( 'Normal Link', 'online-shop' ),
			'new-tab-link' => esc_html__( 'Open in New Tab', 'online-shop' )
		);
		return apply_filters( 'online_shop_adv_link_options', $online_shop_adv_link_options );
	}
endif;

/**
 * WC Cat Layout Type
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return array $online_shop_wc_cat_layout_type
 *
 */
if ( !function_exists('online_shop_wc_cat_layout_type') ) :
	function online_shop_wc_cat_layout_type() {
		$online_shop_wc_cat_layout_type =  array(
			'1' => esc_html__( 'First Layout', 'online-shop' ),
			'2' => esc_html__( 'Second Layout', 'online-shop' )
		);
		return apply_filters( 'online_shop_wc_cat_layout_type', $online_shop_wc_cat_layout_type );
	}
endif;

/**
 * Term per slide/section
 *
 * @since Online Shop 1.0.0
 *
 * @param null
 * @return array $online_shop_widget_term_per_slide
 *
 */
if ( !function_exists('online_shop_widget_term_per_slide') ) :
	function online_shop_widget_term_per_slide() {
		$online_shop_widget_term_per_slide =  array(
			1 => esc_html__( '1', 'online-shop' ),
			2 => esc_html__( '2', 'online-shop' ),
			3 => esc_html__( '3', 'online-shop' ),
			4 => esc_html__( '4', 'online-shop' ),
			5 => esc_html__( '5', 'online-shop' )
		);
		return apply_filters( 'online_shop_widget_term_per_slide', $online_shop_widget_term_per_slide );
	}
endif;