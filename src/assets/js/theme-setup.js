/**
 * JavaScript handler for the totc-theme-setup lib
 * github.com/NateWr/totc-theme-setup
 */
jQuery(document).ready(function ($) {
	console.log( 'hello!' );

	$( 'body' ).click( function(e) {

		var target = $( e.target );

		if ( !target.hasClass( 'totc-theme-setup-install-demo-content' ) ) {
			return;
		}

		e.preventDefault();

		console.log( target.data() );
		
	});
});
