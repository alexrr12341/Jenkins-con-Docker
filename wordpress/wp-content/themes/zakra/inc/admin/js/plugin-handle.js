/**
 * Get Started button on welcome page.
 */
jQuery( document ).ready( function ( $ ) {

	$( '.btn-get-started' ).click( function ( e ) {
		e.preventDefault();

		var extra_uri, redirect_uri, state, dismiss_nonce;

		// Show About > import button while processing.
		if ( jQuery( this ).parents( '.theme-actions' ).length ) {
			jQuery( this ).parents( '.theme-actions' ).css( 'opacity', '1' );
		}

		// Show updating gif icon.
		jQuery( this ).addClass( 'updating-message' );

		// Change button text.
		jQuery( this ).text( zakra_redirect_demo_page.btn_text );


		// Assign `TG demo importer` plugin state for processing from PHP.
		if ( $( this ).hasClass( 'tdi-activated' ) ) { // Installed and activated.
			state = 'activated';
		} else if ( $( this ).hasClass( 'tdi-installed' ) ) { // Installed but not activated.
			state = 'installed';
		} else { // Not installed.
			state = '';
		}

		var data = {
			action     : 'import_button',
			security : zakra_redirect_demo_page.nonce,
			state      : state,
		};

		$.ajax({
			type: "POST",
			url: ajaxurl, // URL to "wp-admin/admin-ajax.php"
			data: data,
			success:function( response ) {
				extra_uri = '';
				if ( jQuery( '.zakra-message-close' ).length ) {
					dismiss_nonce = jQuery( '.zakra-message-close' ).attr( 'href' ).split( '_zakra_notice_nonce=' )[1];
					extra_uri     = '&_zakra_notice_nonce=' + dismiss_nonce;
				}

				redirect_uri         = response.redirect + extra_uri;
				window.location.href = redirect_uri;
			},
			error: function( xhr, ajaxOptions, thrownError ){
				console.log(thrownError);
			}
		});


	} );
} );
