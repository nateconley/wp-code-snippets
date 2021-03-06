(function( $ ) {

$( document ).ready( function() {

	// The themes available
	var themes = {
		default: {
			name: 'default',
		},
		coy: {
			name: 'coy',
		},
		dark: {
			name: 'dark',
		},
		funky: {
			name: 'funky',
		},
		okaidia: {
			name: 'okaidia',
		},
		solarizedlight: {
			name: 'solarizedlight',
		},
		tomorrow: {
			name: 'tomorrow',
		},
		twilight: {
			name: 'twilight',
		},
	};

	for( var theme in themes ) {
		// Add link element as jQuery object to themes object
		var themeLink = $( '#wp-code-snippets-prism-' + themes[ theme ].name + '-css' );
		themes[ theme ].link = themeLink;

		// Remove link element from the DOM
		themeLink.remove();
	}

	// Add the default link, too
	themes.default.link = $( '#wp-code-snippets-prism-css' );

	// On page load, see which option is selected
	changeTheme( $( '#code-snippets-theme' ).val() );

	// On change, change out the theme
	$( '#code-snippets-theme' ).change( function() {
		changeTheme( $( this ).val() );
	} );

	// handles changing the theme
	function changeTheme( theme ) {

		// Remove all the other stylesheets
		for( var name in themes ) {
			$( 'head ' + themes[ name ].link.selector ).remove();
		}
		
		// Insert the link into the head
		$( 'head' ).prepend( themes[ theme ].link );

	}

	// Handle line numbers
	var lineNumbers = document.getElementById( 'code-snippets-line-numbers' );

	lineNumbers.addEventListener( 'change', handleLineNumbers );

	function handleLineNumbers() {
		var lineNumbers = document.getElementById( 'code-snippets-line-numbers' );

		var previews = document.querySelectorAll( '#preview pre' );

		if ( lineNumbers.value ) {
			for ( var i = 0; i < previews.length; i++ ) {
				previews[ i ].classList.add( 'line-numbers' );
			}
		} else {
			for ( var j = 0; j < previews.length; j++ ) {
				previews[ j ].classList.remove( 'line-numbers' );
			}
		}

		Prism.highlightAll();
	}

	handleLineNumbers();
} );

})( jQuery );
