jQuery( document ).on( 'cf.form.submit', function ( event, data ) {

	jQuery( window ).on( 'beforeunload', function( e ) {
		
		e.preventDefault();

		// most browser don't display a custom message
		var message = 'The form is still processing. If you leave the page, your data might be lost.';

		e.returnValue = message;
		return message;

	} );

	jQuery( document ).ajaxComplete( function( event, xhr, settings ) {

		if ( xhr.responseJSON && xhr.responseJSON.form_id && xhr.responseJSON.status ) {
			// remove event
			jQuery( window ).off( 'beforeunload' );
			// restore default
			window.onbeforeunload = null;
		}

	} );

} );
