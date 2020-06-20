/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function ($) {
    // Site title and description.
    wp.customize('blogname', function (value) {
        value.bind(function (to) {
            $('.site-title a').text(to);
        });
    });
    wp.customize('blogdescription', function (value) {
        value.bind(function (to) {
            $('.site-description').text(to);
        });
    });
    // Header text color.
    wp.customize('header_textcolor', function (value) {
        value.bind(function (to) {
            if ('blank' === to) {
                $('.site-title, .site-description').css({
                    'clip': 'rect(1px, 1px, 1px, 1px)',
                    'position': 'absolute'
                });
            } else {
                $('.site-title, .site-description').css({
                    'clip': 'auto',
                    'color': to,
                    'position': 'relative'
                });
            }
        });
    });

    // Primary color option
    wp.customize( 'masonic_primary_color', function ( value ) {
        value.bind( function ( primaryColor ) {
            // Store internal style for primary color
            var primaryColorStyle = '<style id="masonic-internal-primary-color"> blockquote { border-left: 2px solid ' + primaryColor + '; }' +
           '.post-header .entry-author, .post-header .entry-standard, .post-header .entry-date, .post-header .entry-tag { color: ' + primaryColor + '; }' +
           '.entry-author, .entry-standard, .entry-date { color: ' + primaryColor + '; }' +
           'a:hover { color: ' + primaryColor + '; }' +
           '.widget_recent_entries li:before, .widget_recent_comments li:before { color: ' + primaryColor + '; }' +
           '.underline { background: none repeat scroll 0 0 ' + primaryColor + '; }' +
           '.widget-title { border-left: 3px solid ' + primaryColor + '; }' +
           '.sticky { border: 1px solid ' + primaryColor + '; }' +
           '.footer-background { border-top: 5px solid ' + primaryColor + '; }' +
           '.site-title a:hover { color: ' + primaryColor + '; }' +
           'button, input[type="button"], input[type="reset"], input[type="submit"] { background: none repeat scroll 0 0 ' + primaryColor + '; }' +
           '.breadcrums span { color: ' + primaryColor + '; }' +
           '.button:hover { color: ' + primaryColor + '; }' +
           '.catagory-type a:hover { color: ' + primaryColor + '; }' +
           '.copyright a span { color: ' + primaryColor + '; }' +
           'button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover { color: ' + primaryColor + '; }' +
           '.widget_rss li a:hover { color: ' + primaryColor + '; }' +
           '@media screen and (max-width: 768px) { nav li:hover ul li a:hover, nav li a:hover { background: ' + primaryColor + '; } }' +
           '.entry-date a .entry-date:hover { color: ' + primaryColor + '; }' +
           '.wp-pagenavi a, .wp-pagenavi span { border: 1px solid ' + primaryColor + '; }</style>';

            // Remove previously create internal style and add new one.
            $( 'head #masonic-internal-primary-color' ).remove();
            $( 'head' ).append( primaryColorStyle );
        }
        );
    } );

    // Link color option
    wp.customize( 'masonic_link_color', function ( value ) {
        value.bind( function ( linkColor ) {
            // Store internal style for primary color
            var linkColorStyle = '<style id="masonic-internal-link-color">  a { color: ' + linkColor + '; }' +
           '.button { color: ' + linkColor + '; }' +
           '.catagory-type a { color: ' + linkColor + '; }' +
           '.widget_rss li a { color: ' + linkColor + '; }' +
           '.entry-date a .entry-date { color: ' + linkColor + '; }</style>';

            // Remove previously create internal style and add new one.
            $( 'head #masonic-internal-link-color' ).remove();
            $( 'head' ).append( linkColorStyle );
        }
        );
    } );
})(jQuery);
