/*!
 * Custom JS
 * @package Acme Themes
 * @subpackage Online Shop
 */
jQuery(document).ready(function($) {
    var at_body = $('body'),
        at_window = $(window);

    //Select 2 js init
    if (typeof select2 !== 'undefined' && $.isFunction(select2)){
        $('.select_products, .woocommerce-ordering .orderby').select2({
            minimumResultsForSearch: -1
        });
    }

    $('.header-wrapper .acmethemes-nav').slicknav({
        allowParentLinks :true,
        duration: 500,
        prependTo: '.header-wrapper .responsive-slick-menu',
        easingOpen: "swing",
        'closedSymbol': '+',
        'openedSymbol': '-'
    });
    $('.acmethemes-nav >ul > li,.special-menu-wrapper > li').each(function () {
        if ($(this).children('ul.sub-menu').length) {
            $(this).prepend("<i class='fa fa-angle-down angle-down'></i>")
        }
    });
    $('.header-main-menu ul.sub-menu li').each(function () {
        if ($(this).children('ul.sub-menu').length) {
            $(this).prepend("<i class='fa fa-angle-right angle-down'></i>")
        }
    });

    //for menu
    $('.header-wrapper #site-navigation .menu-main-menu-container').addClass('clearfix');
    $('.menu-item-has-children > a').click(function(){
        var at_this = $(this);
        if( at_this.hasClass('at-clicked')){
            return true;
        }
        var at_width = at_window.width();
        if( at_width > 992 && at_width <= 1230 ){
            at_this.addClass('at-clicked');
            return false;
        }
    });

    /*sticky menu*/
    var menu_sticky_height = $('#masthead').height() - $('#site-navigation').height();
    at_window.scroll(function(){
        if ( $(this).scrollTop() > menu_sticky_height) {
            $('.online-shop-enable-sticky-menu').css({"position": "fixed", "top": "0","right": "0","left": "0","z-index":'999'});
            $('.online-shop-enable-sticky-menu .header-main-menu').css('margin','0 auto');
        }
        else {
            $('.online-shop-enable-sticky-menu').removeAttr( 'style' );
            $('.online-shop-enable-sticky-menu .header-main-menu').removeAttr( 'style' );
        }
        if ( $(this).scrollTop() > menu_sticky_height) {
            $('.sm-up-container').show();
        }
        else {
            $('.sm-up-container').hide();
        }
    });

    //Sticky Sidebar
    if(at_body.hasClass('at-sticky-sidebar')){
        if(at_body.hasClass('both-sidebar')){
            $('#primary-wrap, #secondary-right, #secondary-left').theiaStickySidebar();
        }
        else{
            $('.secondary-sidebar, #primary').theiaStickySidebar();
        }
    }

    at_window.on('load', function() {
        /*slick*/
        $('.acme-slick-carausel').each(function() {
            var at_featured_img_slider = $(this);

            var slidesToShow = parseInt(at_featured_img_slider.data('column'));
            var slidesToScroll = parseInt(at_featured_img_slider.data('column'));
            var prevArrow =at_featured_img_slider.closest('.widget').find('.at-action-wrapper > .prev');
            var nextArrow =at_featured_img_slider.closest('.widget').find('.at-action-wrapper > .next');
            at_featured_img_slider.css('visibility', 'visible').slick({
                slidesToShow: slidesToShow,
                slidesToScroll: slidesToScroll,
                autoplay: true,
                adaptiveHeight: true,
                cssEase: 'linear',
                arrows: true,
                prevArrow: prevArrow,
                nextArrow: nextArrow,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: ( slidesToShow > 1 ? slidesToShow - 1 : slidesToShow ),
                            slidesToScroll: ( slidesToScroll > 1 ? slidesToScroll - 1 : slidesToScroll )
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: ( slidesToShow > 2 ? slidesToShow - 2 : slidesToShow ),
                            slidesToScroll: ( slidesToScroll > 2 ? slidesToScroll - 2 : slidesToScroll )
                        }
                    }
                ]
            });
        });

        $('.featured-slider').each(function() {
            var at_featured_img_slider = $(this);
            var autoplay = parseInt(at_featured_img_slider.data('autoplay'));
            var arrows = parseInt(at_featured_img_slider.data('arrows'));

            var prevArrow = at_featured_img_slider.closest('.slider-section').find('.at-action-wrapper > .prev');
            var nextArrow = at_featured_img_slider.closest('.slider-section').find('.at-action-wrapper > .next');
            at_featured_img_slider.css('visibility', 'visible').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: (autoplay===1),
                adaptiveHeight: true,
                cssEase: 'linear',
                arrows: (arrows===1),
                prevArrow: prevArrow,
                nextArrow: nextArrow
            });
        });

        $('.fs-right-slider').each(function() {
            var at_featured_img_slider = $(this);
            var autoplay = parseInt(at_featured_img_slider.data('autoplay'));
            var arrows = parseInt(at_featured_img_slider.data('arrows'));
            var prevArrow = at_featured_img_slider.closest('.beside-slider').find('.at-action-wrapper > .prev');
            var nextArrow = at_featured_img_slider.closest('.beside-slider').find('.at-action-wrapper > .next');
            at_featured_img_slider.css('visibility', 'visible').slick({
                slidesToShow: 2,
                slidesToScroll: 1,
                autoplay: (autoplay===1),
                vertical: true,
                verticalSwiping: true,
                arrows: (arrows===1),
                prevArrow: prevArrow,
                nextArrow: nextArrow,
                adaptiveHeight: false
            });
        });

        /*feature special menu*/
        function feature_special_menu_height_fixed() {
            var width = at_window.width();
            if( width > 992 ){
                var slider_height = $('.online-shop-feature-special-menu .slider-feature-wrap').height();
                $('.online-shop-feature-special-menu .special-menu-wrapper > li > ul').height( slider_height+19 );
            }
            else{
                $('.online-shop-feature-special-menu .special-menu-wrapper > li > ul').attr('style','');
            }
        }
        feature_special_menu_height_fixed();
        at_window.on('resize orientationchange', function() {
            feature_special_menu_height_fixed();
        });

        /*click hover effect on mobile*/
        $(document).on('click', '.special-menu, .angle-down', function (event) {
            var width = at_window.width();
            if( width > 992 ){
                return false;
            }
            event.preventDefault();
            var angle_down = $(this).parent().children('i.angle-down'),
                submenu = angle_down.siblings('ul.sub-menu');
            submenu.toggleClass('open');
            angle_down.toggleClass('fa-angle-up');
            angle_down.toggleClass('fa-angle-down');
            return false;
        });

        /*cats tab*/
        function cats_tab() {
            // Runs when the image button is clicked.
            var complete = 1;
            at_body.on('click','.at-tabs > span', function(e){

                var $this = $(this),
                    tab_wrap = $this.closest('.widget_online_shop_wc_cats_tabs'),
                    cats_tab_id = $this.data('id'),
                    tab_title = tab_wrap.find('.at-tabs > span'),
                    single_tab_content_wrap = tab_wrap.find('.at-tabs-wrap');

                if( $this.hasClass('active') || complete === 0 ){
                    return false;
                }
                if( complete === 1 ){
                    complete = 0;
                }
                tab_title.removeClass('active');
                $this.addClass('active');
                single_tab_content_wrap.removeClass('active');

                single_tab_content_wrap.each(function () {
                    if( $(this).data('id') === cats_tab_id ){
                        $(this).addClass('active');
                        var at_featured_img_slider = $(this).find('.acme-slick-carausel');
                        var prevArrow =at_featured_img_slider.closest('.widget').find('.at-action-wrapper > .prev');
                        var nextArrow =at_featured_img_slider.closest('.widget').find('.at-action-wrapper > .next');
                        prevArrow.off('click');
                        nextArrow.off('click');
                        at_featured_img_slider.slick('reinit')
                    }
                });
                complete = 1;
                e.preventDefault();
            });
            $('.widget_online_shop_wc_cats_tabs').each(function () {
                $(this).find('.at-tabs-wrap:first').find('.acme-slick-carausel').slick('reinit')
            })
        }
        cats_tab();

        function toggle_cats() {
            var width = at_window.width();
            if( width > 767 ){
               $('.at-action-wrapper.at-tabs').show();
            }
            at_body.on('click','.toggle-cats', function(e){
                var width = at_window.width();
                if( width <= 767 ){
                    var $this = $(this),
                        action_wrapper = $this.next('.at-action-wrapper.at-tabs');
                    action_wrapper.slideToggle();
                }
                e.preventDefault();
            })
        }
        toggle_cats();

        function modal_toggle(){
            $(document).on('click', '.at-modal', function (event) {
                event.preventDefault();
                at_body.addClass('modal-open');
                $('#at-widget-modal').fadeIn();
            });
            $(document).on('click', '.modal-header .close', function (event) {
                event.preventDefault();
                $(this).closest('.modal').fadeOut();
                at_body.removeClass('modal-open');
            });
        }
        modal_toggle();
    });
});