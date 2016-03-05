/**
 * JavaScript handler for the totc-theme-setup lib
 * github.com/NateWr/totc-theme-setup
 */
jQuery(document).ready(function ($) {

	$( 'body' ).click( function(e) {

		var target = $( e.target );

		if ( !target.hasClass( 'totc-theme-setup-install-demo-content' ) ) {
			return;
		}

		e.preventDefault();

		var button_label = target.text();
		target.text( totc_theme_setup.strings['ajax.installing'] )
			.removeClass( 'button-primary' )
			.attr( 'disabled', 'disabled' )
			.append( '<span class="spinner" style="float:none;visibility:visible;vertical-align:top;margin-right:0"></span>' );

		var params = {
			action: 'totc-theme-setup',
			route: 'demos',
			slug: target.data( 'slug' ),
			nonce: totc_theme_setup.nonce,
		};

		$.post(
			ajaxurl,
			$.param( params ),
			function( r ) {

				if ( r.success && typeof r.data !== 'undefined' ) {
					target.attr( 'href', r.data )
						.removeClass( 'button totc-theme-setup-install-demo-content' )
						.text( totc_theme_setup.strings['page.demo.view_demo'] );

				} else {
					if ( typeof r.data !== 'undefined' ) {
						alert( r.data );
					} else {
						alert( totc_theme_setup.strings['ajax.error.unknown'] );
					}
					target.text( button_label )
						.addClass( 'button-primary' );
				}

				target.removeAttr( 'disabled' );
			}
		);

	});
});
