( function( $, wp, settings ) {
	var $document = $( document );

	wp = wp || {};

	/**
	 * The WP Updates object.
	 *
	 * @type {object}
	 */
	wp.updates = wp.updates || {};

	/**
	 * Localized strings.
	 *
	 * @type {object}
	 */
	wp.updates.l10n = _.extend( wp.updates.l10n, settings.l10n || {} );

	/**
	 * Sends an Ajax request to the server to import a demo.
	 *
	 * @param {object}             args
	 * @param {string}             args.slug    Demo ID.
	 * @param {importDemoSuccess=} args.success Optional. Success callback. Default: wp.updates.importDemoSuccess
	 * @param {importDemoError=}   args.error   Optional. Error callback. Default: wp.updates.importDemoError
	 * @return {$.promise} A jQuery promise that represents the request,
	 *                     decorated with an abort() method.
	 */
	wp.updates.importDemo = function( args ) {
		var $message = $( '.demo-import[data-slug="' + args.slug + '"]' );

		if ( $document.find( 'body' ).hasClass( 'full-overlay-active' ) ) {
			$message = $( '.wp-full-overlay-header, .wp-full-overlay-footer' ).find( '.demo-import' );
		}

		args = _.extend( {
			success: wp.updates.importDemoSuccess,
			error: wp.updates.importDemoError
		}, args );

		$message.addClass( 'updating-message' );
		$message.parents( '.theme' ).addClass( 'focus' );
		if ( $message.html() !== wp.updates.l10n.importing ) {
			$message.data( 'originaltext', $message.html() );
		}

		$message
			.text( wp.updates.l10n.importing )
			.attr( 'aria-label', wp.updates.l10n.demoImportingLabel.replace( '%s', $message.data( 'name' ) ) );
		wp.a11y.speak( wp.updates.l10n.importingMsg, 'polite' );

		// Remove previous error messages, if any.
		$( '.install-theme-info, [data-slug="' + args.slug + '"]' ).removeClass( 'demo-import-failed' ).find( '.notice.notice-error' ).remove();

		$document.trigger( 'wp-demo-importing', args );

		return wp.updates.ajax( 'import-demo', args );
	};

	/**
	 * Updates the UI appropriately after a successful demo import.
	 *
	 * @typedef {object} importDemoSuccess
	 * @param {object} response            Response from the server.
	 * @param {string} response.slug       Slug of the demo that was imported.
	 * @param {string} response.previewUrl URL to preview the just imported demo.
	 */
	wp.updates.importDemoSuccess = function( response ) {
		var $card = $( '.wp-full-overlay-header, .wp-full-overlay-footer, [data-slug=' + response.slug + ']' ),
			$message;

		$document.trigger( 'wp-demo-import-success', response );

		$message = $card.find( '.button-primary' )
			.removeClass( 'updating-message' )
			.addClass( 'updated-message disabled' )
			.attr( 'aria-label', wp.updates.l10n.demoImportedLabel.replace( '%s', response.demoName ) )
			.text( wp.updates.l10n.imported );

		wp.a11y.speak( wp.updates.l10n.importedMsg, 'polite' );

		setTimeout( function() {

			if ( response.previewUrl ) {

				// Remove the 'Preview' button.
				$message.siblings( '.demo-preview' ).remove();

				// Transform the 'Import' button into an 'Live Preview' button.
				$message
					.attr( 'target', '_blank' )
					.attr( 'href', response.previewUrl )
					.removeClass( 'demo-import updated-message disabled' )
					.addClass( 'live-preview' )
					.attr( 'aria-label', wp.updates.l10n.livePreviewLabel.replace( '%s', response.demoName ) )
					.text( wp.updates.l10n.livePreview );
			}
		}, 1000 );
	};

	/**
	 * Updates the UI appropriately after a failed demo import.
	 *
	 * @typedef {object} importDemoError
	 * @param {object} response              Response from the server.
	 * @param {string} response.slug         Slug of the demo to be imported.
	 * @param {string} response.errorCode    Error code for the error that occurred.
	 * @param {string} response.errorMessage The error that occurred.
	 */
	wp.updates.importDemoError = function( response ) {
		var $card, $button,
			errorMessage = wp.updates.l10n.importFailed.replace( '%s', response.errorMessage ),
			$message     = wp.updates.adminNotice( {
				className: 'update-message notice-error notice-alt',
				message:   errorMessage
			} );

		if ( ! wp.updates.isValidResponse( response, 'import' ) ) {
			return;
		}

		if ( wp.updates.maybeHandleCredentialError( response, 'import-demo' ) ) {
			return;
		}

		if ( $document.find( 'body' ).hasClass( 'full-overlay-active' ) ) {
			$button = $( '.demo-import[data-slug="' + response.slug + '"]' );
			$card   = $( '.install-theme-info' ).prepend( $message );
		} else {
			$card   = $( '[data-slug="' + response.slug + '"]' ).removeClass( 'focus' ).addClass( 'demo-import-failed' ).append( $message );
			$button = $card.find( '.demo-import' );
		}

		$button
			.removeClass( 'updating-message' )
			.attr( 'aria-label', wp.updates.l10n.demoImportFailedLabel.replace( '%s', $button.data( 'name' ) ) )
			.text( wp.updates.l10n.importFailedShort );

		wp.a11y.speak( errorMessage, 'assertive' );

		$document.trigger( 'wp-demo-import-error', response );
	};

	/**
	 * Sends an Ajax request to the server to install a plugin.
	 *
	 * @param {object}                    args         Arguments.
	 * @param {string}                    args.slug    Plugin identifier in the WordPress.org Plugin repository.
	 * @param {bulkInstallPluginSuccess=} args.success Optional. Success callback. Default: wp.updates.bulkInstallPluginSuccess
	 * @param {bulkInstallPluginError=}   args.error   Optional. Error callback. Default: wp.updates.bulkInstallPluginError
	 * @return {$.promise} A jQuery promise that represents the request,
	 *                     decorated with an abort() method.
	 */
	wp.updates.bulkInstallPlugin = function( args ) {
		var $pluginRow, $message, message;

		args = _.extend( {
			success: wp.updates.bulkInstallPluginSuccess,
			error: wp.updates.bulkInstallPluginError
		}, args );

		if ( $document.find( 'body' ).hasClass( 'full-overlay-active' ) ) {
			$pluginRow = $( 'tr[data-slug="' + args.slug + '"]' );
			$message   = $( '.theme-install-overlay .demo-import[data-slug="' + args.demo + '"]' );
			message    = wp.updates.l10n.pluginInstallingLabel.replace( '%s', $pluginRow.data( 'name' ) );
			$pluginRow.find( '.plugin-status span' )
				.addClass( 'updating-message' )
				.attr( 'aria-label', wp.updates.l10n.pluginInstallingLabel.replace( '%s', $pluginRow.data( 'name' ) ) )
				.text( wp.updates.l10n.installing );
		} else {
			$message = $( '.demo-import[data-slug="' + args.demo + '"]' );
			message  = wp.updates.l10n.pluginInstallingLabel.replace( '%s', args.name );
			$message.parents( '.theme' ).addClass( 'focus' );
		}

		if ( $message.html() !== wp.updates.l10n.installing ) {
			$message.data( 'originaltext', $message.html() );
		}

		$message
			.attr( 'aria-label', message )
			.addClass( 'updating-message' )
			.text( wp.updates.l10n.installing );

		wp.a11y.speak( wp.updates.l10n.installingMsg, 'polite' );

		$document.trigger( 'wp-plugin-bulk-installing', args );

		return wp.updates.ajax( 'install-required-plugin', args );
	};

	/**
	 * Updates the UI appropriately after a successful plugin install.
	 *
	 * @typedef {object} installPluginSuccess
	 * @param {object} response             Response from the server.
	 * @param {string} response.slug        Slug of the installed plugin.
	 * @param {string} response.pluginName  Name of the installed plugin.
	 * @param {string} response.activateUrl URL to activate the just installed plugin.
	 */
	wp.updates.bulkInstallPluginSuccess = function( response ) {
		var $pluginRow     = $( 'tr[data-slug="' + response.slug + '"]' ).removeClass( 'install' ).addClass( 'installed' ),
			$updateMessage = $pluginRow.find( '.plugin-status span' );

		$updateMessage
			.removeClass( 'updating-message install-now' )
			.addClass( 'updated-message active' )
			.attr( 'aria-label', wp.updates.l10n.pluginInstalledLabel.replace( '%s', response.pluginName ) )
			.text( wp.updates.l10n.pluginInstalled );

		wp.a11y.speak( wp.updates.l10n.installedMsg, 'polite' );

		$document.trigger( 'wp-plugin-bulk-install-success', response );
	};

	/**
	 * Updates the UI appropriately after a failed plugin install.
	 *
	 * @typedef {object} installPluginError
	 * @param {object}  response              Response from the server.
	 * @param {string}  response.slug         Slug of the plugin to be installed.
	 * @param {string=} response.pluginName   Optional. Name of the plugin to be installed.
	 * @param {string}  response.errorCode    Error code for the error that occurred.
	 * @param {string}  response.errorMessage The error that occurred.
	 */
	wp.updates.bulkInstallPluginError = function( response ) {
		var $pluginRow     = $( 'tr[data-slug="' + response.slug + '"]' ),
			$updateMessage = $pluginRow.find( '.plugin-status span' ),
			errorMessage;

		if ( ! wp.updates.isValidResponse( response, 'install' ) ) {
			return;
		}

		if ( wp.updates.maybeHandleCredentialError( response, 'install-plugin' ) ) {
			return;
		}

		errorMessage = wp.updates.l10n.installFailed.replace( '%s', response.errorMessage );

		$updateMessage
			.removeClass( 'updating-message' )
			.addClass( 'updated-message' )
			.attr( 'aria-label', wp.updates.l10n.pluginInstallFailedLabel.replace( '%s', $pluginRow.data( 'name' ) ) )
			.text( wp.updates.l10n.installFailedShort );

		wp.a11y.speak( errorMessage, 'assertive' );

		$document.trigger( 'wp-plugin-bulk-install-error', response );
	};

	/**
	 * Validates an AJAX response to ensure it's a proper object.
	 *
	 * If the response deems to be invalid, an admin notice is being displayed.
	 *
	 * @param {(object|string)} response              Response from the server.
	 * @param {function=}       response.always       Optional. Callback for when the Deferred is resolved or rejected.
	 * @param {string=}         response.statusText   Optional. Status message corresponding to the status code.
	 * @param {string=}         response.responseText Optional. Request response as text.
	 * @param {string}          action                Type of action the response is referring to. Can be 'delete',
	 *                                                'update' or 'install'.
	 */
	wp.updates.isValidResponse = function( response, action ) {
		var error = wp.updates.l10n.unknownError,
			errorMessage;

		// Make sure the response is a valid data object and not a Promise object.
		if ( _.isObject( response ) && ! _.isFunction( response.always ) ) {
			return true;
		}

		if ( _.isString( response ) && '-1' === response ) {
			error = wp.updates.l10n.nonceError;
		} else if ( _.isString( response ) ) {
			error = response;
		} else if ( 'undefined' !== typeof response.readyState && 0 === response.readyState ) {
			error = wp.updates.l10n.connectionError;
		} else if ( _.isString( response.statusText ) ) {
			error = response.statusText + ' ' + wp.updates.l10n.statusTextLink;
		}

		switch ( action ) {
			case 'import':
				errorMessage = wp.updates.l10n.importFailed;
				break;
		}

		errorMessage = errorMessage.replace( '%s', error );

		// Add admin notice.
		wp.updates.addAdminNotice( {
			id:        'unknown_error',
			className: 'notice-error is-dismissible',
			message:   _.unescape( errorMessage )
		} );

		// Remove the lock, and clear the queue.
		wp.updates.ajaxLocked = false;
		wp.updates.queue      = [];

		// Change buttons of all running updates.
		$( '.button.updating-message' )
			.removeClass( 'updating-message' )
			.removeAttr( 'aria-label' )
			.text( wp.updates.l10n.importFailedShort );

		wp.a11y.speak( errorMessage, 'assertive' );

		return false;
	};

	/**
	 * Pulls available jobs from the queue and runs them.
	 *
	 * @see https://core.trac.wordpress.org/ticket/39364
	 */
	wp.updates.queueChecker = function() {
		var job;

		if ( wp.updates.ajaxLocked || ! wp.updates.queue.length ) {
			return;
		}

		job = wp.updates.queue.shift();

		// Handle a queue job.
		switch ( job.action ) {
			case 'import-demo':
				wp.updates.importDemo( job.data );
				break;

			case 'install-plugin':
				wp.updates.bulkInstallPlugin( job.data );
				break;

			default:
				break;
		}

		// Handle a queue job.
		$document.trigger( 'wp-updates-queue-job', job );
	};

})( jQuery, window.wp, window._demoUpdatesSettings );
