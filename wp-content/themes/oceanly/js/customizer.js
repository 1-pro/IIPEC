/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title > a' ).text( to );
		} );
	} );

	// Site tagline.
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Show header search form.
	wp.customize( 'set_show_header_search', function( value ) {
		value.bind( function( to ) {
			if ( to ) {
				$( '.header-search-form-wrap' ).show();
			} else {
				$( '.header-search-form-wrap' ).hide();
			}
		} );
	} );

	// Show header breadcrumbs.
	wp.customize( 'set_show_header_breadcrumbs', function( value ) {
		value.bind( function( to ) {
			if ( to ) {
				$( '.site-hero-header .breadcrumbs' ).show();
			} else {
				$( '.site-hero-header .breadcrumbs' ).hide();
			}
		} );
	} );

	// Theme styles output.
	var oceanly_styles_output;

	$.each( oceanly.styles, function( key, rules ) {

		wp.customize( 'set_styles[' + key + ']', function( value ) {

			value.bind( function( to ) {
				if ( ! $( 'style#oceanly-styles-' + key ).length ) {
					$( '<style id="oceanly-styles-' + key + '"></style>' ).insertAfter( '#oceanly-style-inline-css' );
				}

				oceanly_styles_output = '';

				$.each( rules, function( selector, values ) {

					$.each( values, function( prop_key, prop_value ) {
						oceanly_styles_output += ( selector + '{' );

						oceanly_styles_output += ( prop_key + ':' + prop_value.place.replace( '_PLACE', to ) + ';' );

						oceanly_styles_output += '}';
					} );

				} );

				$( 'style#oceanly-styles-' + key ).html( oceanly_styles_output );

			} );

		} );

	} );

}( jQuery ) );
