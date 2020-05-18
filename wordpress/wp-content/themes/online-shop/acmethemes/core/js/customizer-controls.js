jQuery(document).ready(function ($) {
    var at_body = $('body');
    at_body.on('click','.at-customizer', function(evt){
        evt.preventDefault();
        section = $(this).data('section');
        panel = $(this).data('panel');
        if ( section ) {
            wp.customize.section( section ).focus();
        }
        if ( panel ) {
            wp.customize.panel( panel ).focus();
        }
    });
});