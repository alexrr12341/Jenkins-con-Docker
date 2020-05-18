<?php
if ( ! function_exists( 'online_shop_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function online_shop_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Online Shop, use a find and replace
         * to change 'online-shop' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'online-shop', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
        * Enable support for custom logo.
        *
        *  @since Online Shop 1.0.0
         */
        add_theme_support( 'custom-logo', array(
            'height'      => 70,
            'width'       => 290,
            'flex-height' => true,
        ) );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 240, 172, true );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'primary' => esc_html__( 'Primary Menu', 'online-shop' ),
            'top-menu' => esc_html__( 'Top Menu ( Support First Level Only )', 'online-shop' ),
            'special-menu' => esc_html__( 'Special Menu ( Display Beside Primary Menu)', 'online-shop' ),
        ) );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'gallery',
            'caption',
        ) );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'online_shop_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );

        // This theme styles the visual editor with editor-style.css to match the theme style.
	    add_editor_style();

        // Adding excerpt for page
	    add_post_type_support( 'page', 'excerpt' );

	    /*woocommerce support*/
	    add_theme_support( 'woocommerce' );

	    /*Set up the woocommerce Gallery Lightbox*/
	    add_theme_support( 'wc-product-gallery-zoom' );
	    add_theme_support( 'wc-product-gallery-lightbox' );
	    add_theme_support( 'wc-product-gallery-slider' );
    }
endif; // online_shop_setup
add_action( 'after_setup_theme', 'online_shop_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function online_shop_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'online_shop_content_width', 640 );
}
add_action( 'after_setup_theme', 'online_shop_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function online_shop_scripts() {
	global $online_shop_customizer_all_values;

    /*google font*/
    wp_enqueue_style( 'online-shop-googleapis', '//fonts.googleapis.com/css?family=Oswald:400,300|Open+Sans:600,400', array(), '1.0.0' );

    /*Font-Awesome-master*/
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/library/Font-Awesome/css/font-awesome.min.css', array(), '4.7.0' );
    wp_style_add_data( 'font-awesome', 'rtl', 'replace' );

	/*Select 2*/
	if( online_shop_is_woocommerce_active() ){
		wp_enqueue_style('select2');
		wp_enqueue_script('select2');
	}

	wp_enqueue_style( 'online-shop-style', get_stylesheet_uri(), array(), '1.3.2' );
    wp_style_add_data( 'online-shop-style', 'rtl', 'replace' );


	/*jquery start*/
    wp_enqueue_script('html5shiv', get_template_directory_uri() . '/assets/library/html5shiv/html5shiv.min.js', array('jquery'), '3.7.3', false);
    wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

    wp_enqueue_script('respond', get_template_directory_uri() . '/assets/library/respond/respond.min.js', array('jquery'), '1.4.2', false);
    wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );

	/*slick slider*/
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/library/slick/slick.css', array(), '1.8.1' );
    wp_style_add_data( 'slick', 'rtl', 'replace' );
	wp_enqueue_script('slick', get_template_directory_uri() . '/assets/library/slick/slick.min.js', array('jquery'), '1.8.1', 1);

    wp_enqueue_script('slicknav', get_template_directory_uri() . '/assets/library/SlickNav/jquery.slicknav.min.js', array('jquery'), '1.0.10', 1);

	if( 1 == $online_shop_customizer_all_values['online-shop-enable-sticky-sidebar'] ){
		wp_enqueue_script('theia-sticky-sidebar', get_template_directory_uri() . '/assets/library/theia-sticky-sidebar/theia-sticky-sidebar.min.js', array('jquery'), '1.7.0', 1);
	}

    wp_enqueue_script('online-shop-custom', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), '1.3.2', 1);

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'online_shop_scripts' );

/**
 * Enqueue admin scripts and styles.
 */
function online_shop_is_edit_page() {
	//make sure we are on the backend
	if ( !is_admin() ){
		return false;
	}
	global $pagenow;
	return in_array( $pagenow, array( 'post.php', 'post-new.php' ) );
}

/**
 * Enqueue admin scripts and styles.
 */
function online_shop_admin_scripts( $hook ) {
	if ( 'widgets.php' == $hook || online_shop_is_edit_page() ){
		wp_enqueue_media();
		wp_enqueue_script( 'online-shop-admin-script', get_template_directory_uri() . '/assets/js/acme-admin.js', array( 'jquery' ), '1.0.0' );
		wp_enqueue_style( 'online-shop-admin-style', get_template_directory_uri() . '/assets/css/acme-admin.css', array(), '1.0.0' );
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/library/Font-Awesome/css/font-awesome.min.css', array(), '4.7.0' );
	}
}
add_action( 'admin_enqueue_scripts', 'online_shop_admin_scripts' );

/**
 * Custom template tags for this theme.
 */
require_once online_shop_file_directory('acmethemes/core/template-tags.php');

/**
 * Custom functions that act independently of the theme templates.
 */
require_once online_shop_file_directory('acmethemes/core/extras.php');

/**
 * Load custom header.
 */
require_once online_shop_file_directory('acmethemes/core/custom-header.php');

/**
 * Load Jetpack compatibility file.
 */
require_once online_shop_file_directory('acmethemes/core/jetpack.php');