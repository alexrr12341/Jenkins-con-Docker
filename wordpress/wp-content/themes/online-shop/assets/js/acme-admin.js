/*!
 * Custom JS for custom image uploading
 * @package Acme Themes
 * @subpackage Online Shop
 */
jQuery(function($){
    var at_document = $(document);

    at_document.on('click','.media-image-upload', function(e){

        // Prevents the default action from occuring.
        e.preventDefault();

        var media_title = $(this).data('title');
        var media_button = $(this).data('button');
        var media_input_val = $(this).prev();
        var media_image_url_value = $(this).prev().prev().children('img');
        var media_image_url = $(this).siblings('.img-preview-wrap');

        meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
            title: media_title,
            button: { text:  media_button },
            library: { type: 'image' }
        });
        // Opens the media library frame.
        meta_image_frame.open();
        // Runs when an image is selected.
        meta_image_frame.on('select', function(){

            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

            // Sends the attachment URL to our custom image input field.
            media_input_val.val(media_attachment.url);
            if( media_image_url_value != null ){
                media_image_url_value.attr( 'src', media_attachment.url );
                media_image_url.show();
            }
            media_input_val.trigger('change');
        });
    });
    // Runs when the image button is clicked.
    at_document.on('click','.media-image-remove', function(e){
        $(this).siblings('.img-preview-wrap').hide();
        $(this).prev().prev().val('');
    });

    /*carousel column*/
    function at_display_select( select ) {
        var widget_content = select.closest('.widget-content'),
            optionSelected = select.find("option:selected"),
            valueSelected = optionSelected.val();

        if( valueSelected === 'carousel' ){
            widget_content.find('.at-enable-prev-next').show();
        }
        else{
            widget_content.find('.at-enable-prev-next').hide();
        }
    }
    $('.at-display-select').each(function(){
        var select = $(this);
        at_display_select( select );
    });
    at_document.on('widget-added widget-updated', function( event, widgetContainer ) {
        widgetContainer.find('.at-display-select').each(function(){
            var select = $(this);
            at_display_select( select )
        });
    });
    at_document.on('change', '.at-display-select', function (e) {
        e.preventDefault();
        var select = $(this);
        at_display_select( select );
    });

    /*wc advanced option*/
    function at_wc_advanced_option( select ) {
        var widget_content = select.closest('.widget-content'),
            optionSelected = select.find("option:selected"),
            valueSelected = optionSelected.val();

        widget_content.find('.wc-select').hide();
        if( valueSelected === 'cat' ){
            widget_content.find('.wc-product-cat').show();
        }
        else if( valueSelected === 'tag' ){
            widget_content.find('.wc-product-tag').show();
        }
        else{
            widget_content.find('.wc-select').hide();
        }
    }
    $('.at-wc-advanced-option').each(function(){
        var select = $(this);
        at_wc_advanced_option( select );
    });
    at_document.on('widget-added widget-updated', function( event, widgetContainer ) {
        widgetContainer.find('.at-wc-advanced-option').each(function(){
            var select = $(this);
            at_wc_advanced_option( select )
        });
    });
    at_document.on('change', '.at-wc-advanced-option', function (e) {
        e.preventDefault();
        var select = $(this);
        at_wc_advanced_option( select );
    });

    /*post advanced option*/
    function at_post_advanced_option( select ) {
        var widget_content = select.closest('.widget-content'),
            optionSelected = select.find("option:selected"),
            valueSelected = optionSelected.val();

        widget_content.find('.post-select').hide();
        if( valueSelected === 'cat' ){
            widget_content.find('.post-cat').show();
        }
        else if( valueSelected === 'tag' ){
            widget_content.find('.post-tag').show();
        }
        else{
            widget_content.find('.post-select').hide();
        }
    }
    $('.at-post-advanced-option').each(function(){
        var select = $(this);
        at_post_advanced_option( select );
    });
    at_document.on('widget-added widget-updated', function( event, widgetContainer ) {
        widgetContainer.find('.at-post-advanced-option').each(function(){
            var select = $(this);
            at_post_advanced_option( select )
        });
    });
    at_document.on('change', '.at-post-advanced-option', function (e) {
        e.preventDefault();
        var select = $(this);
        at_post_advanced_option( select );
    });

    /**
     * Script for Customizer icons
     */
    at_document.on('click', '.at-icons-wrapper .single-icon', function() {
        var single_icon = $(this),
            at_customize_icons = single_icon.closest( '.at-icons-wrapper' ),
            icon_display_value = single_icon.children('i').attr('class'),
            icon_split_value = icon_display_value.split(' '),
            icon_value = icon_split_value[1];

        single_icon.siblings().removeClass('selected');
        single_icon.addClass('selected');
        at_customize_icons.find('.at-icon-value').val( icon_value );
        at_customize_icons.find('.icon-preview').html('<i class="' + icon_display_value + '"></i>');
        at_customize_icons.find('.at-icon-value').trigger('change');
    });

    at_document.on('click', '.at-icons-wrapper .icon-toggle ,.at-icons-wrapper .icon-preview', function() {
        var icon_toggle = $(this),
            at_customize_icons = icon_toggle.closest( '.at-icons-wrapper' ),
            icons_list_wrapper = at_customize_icons.find( '.icons-list-wrapper' ),
            dashicons = at_customize_icons.find( '.dashicons' );

        if ( icons_list_wrapper.is(':hidden') ) {
            icons_list_wrapper.slideDown();
            dashicons.removeClass('dashicons-arrow-down');
            dashicons.addClass('dashicons-arrow-up');
        } else {
            icons_list_wrapper.slideUp();
            dashicons.addClass('dashicons-arrow-down');
            dashicons.removeClass('dashicons-arrow-up');
        }

    });
    at_document.on('keyup', '.at-icons-wrapper .icon-search', function() {
        var text = $(this),
            value = this.value,
            at_customize_icons = text.closest( '.at-icons-wrapper' ),
            icons_list_wrapper = at_customize_icons.find( '.icons-list-wrapper' );

        icons_list_wrapper.find('i').each(function () {
            if ($(this).attr('class').search(value) > -1) {
                $(this).parent('.single-icon').show();
            } else {
                $(this).parent('.single-icon').hide();

            }
        });
    });
});

/*Repeater*/
(function ( $, window, document, undefined ) {
    'use strict';
    var at_document = $(document);
    /**repeater**/
    /*sortable*/
    var ATREFRESHVALUE = function (wrapObject) {
        wrapObject.find('[name]').each(function(){
            $(this).trigger('change');
        });
    };
    var ATSORTABLE = function () {
        var repeaters = $('.at-repeater');
        repeaters.sortable({
            orientation: "vertical",
            items: '> .repeater-table',
            placeholder: 'at-sortable-placeholder',
            update: function( event, ui ) {
                ATREFRESHVALUE(ui.item);
            }
        });
        repeaters.trigger("sortupdate");
        repeaters.sortable("refresh");
    };
    /*replace*/
    var ATREPLACE = function( str, replaceWhat, replaceTo ){
        var re = new RegExp(replaceWhat, 'g');
        return str.replace(re,replaceTo);
    };
    var ATREPEATER =  function (){
        at_document.on('click','.at-add-repeater',function (e) {
            e.preventDefault();
            var add_repeater = $(this),
                repeater_wrap = add_repeater.closest('.at-repeater'),
                code_for_repeater = repeater_wrap.find('.at-code-for-repeater'),
                total_repeater = repeater_wrap.find('.at-total-repeater'),
                total_repeater_value = parseInt( total_repeater.val() ),
                repeater_html = code_for_repeater.html();

            total_repeater.val( total_repeater_value +1 );
            var final_repeater_html = ATREPLACE( repeater_html, add_repeater.attr('id'),total_repeater_value );
            add_repeater.before($('<div class="repeater-table"></div>').append( final_repeater_html ));
            var new_html_object = add_repeater.prev('.repeater-table');
            var repeater_inside = new_html_object.find('.at-repeater-inside');
            repeater_inside.slideDown( 'fast',function () {
                new_html_object.addClass( 'open' );
                ATREFRESHVALUE(new_html_object);
            } );

        });
        at_document.on('click', '.at-repeater-top, .at-repeater-close', function (e) {
            e.preventDefault();
            var accordion_toggle = $(this),
                repeater_field = accordion_toggle.closest('.repeater-table'),
                repeater_inside = repeater_field.find('.at-repeater-inside');

            if ( repeater_inside.is( ':hidden' ) ) {
                repeater_inside.slideDown( 'fast',function () {
                    repeater_field.addClass( 'open' );
                } );
            }
            else {
                repeater_inside.slideUp( 'fast', function() {
                    repeater_field.removeClass( 'open' );
                });
            }
        });
        at_document.on('click', '.at-repeater-remove', function (e) {
            e.preventDefault();
            var repeater_remove = $(this),
                repeater_field = repeater_remove.closest('.repeater-table'),
                repeater_wrap = repeater_remove.closest('.at-repeater');

            repeater_field.remove();
            ATREFRESHVALUE(repeater_wrap);
        });

        at_document.on('change', '.at-select', function (e) {
            e.preventDefault();
            var select = $(this),
                repeater_inside = select.closest('.at-repeater-inside'),
                postid = repeater_inside.find('.at-postid'),
                repeater_control_actions = repeater_inside.find('.at-repeater-control-actions'),
                optionSelected = select.find("option:selected"),
                valueSelected = optionSelected.val();

            if( valueSelected == 0 ){
                postid.remove();
            }
            else{
                postid.remove();
                $.ajax({
                    type      : "GET",
                    data      : {
                        action: 'at_get_edit_post_link',
                        id: valueSelected
                    },
                    url       : ajaxurl,
                    beforeSend: function ( data, settings ) {
                        postid.remove();

                    },
                    success   : function (data) {
                        if( 0 != data ){
                            repeater_control_actions.append( data );
                        }
                    },
                    error     : function (jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
                    }
                });
            }
        });
    };

    /*call all methods on ready*/
    at_document.ready( function() {
        at_document.on('widget-added widget-updated, panelsopen', function( event, widgetContainer ) {
            ATSORTABLE();
        });

        /*
         * Manually trigger widget-added events for media widgets on the admin
         * screen once they are expanded. The widget-added event is not triggered
         * for each pre-existing widget on the widgets admin screen like it is
         * on the customizer. Likewise, the customizer only triggers widget-added
         * when the widget is expanded to just-in-time construct the widget form
         * when it is actually going to be displayed. So the following implements
         * the same for the widgets admin screen, to invoke the widget-added
         * handler when a pre-existing media widget is expanded.
         */
        $( function initializeExistingWidgetContainers() {
            var widgetContainers;
            if ( 'widgets' !== window.pagenow ) {
                return;
            }
            widgetContainers = $( '.widgets-holder-wrap:not(#available-widgets)' ).find( 'div.widget' );
            widgetContainers.one( 'click.toggle-widget-expanded', function toggleWidgetExpanded() {
                ATSORTABLE();
            });
        });
        ATREPEATER();
    });
})( jQuery, window, document );