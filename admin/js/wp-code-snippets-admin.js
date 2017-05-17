(function( $ ) {

$( document ).ready( function() {

	// The themes available
	var themes = [
		'default',
		'coy',
		'dark',
		'funky',
		'okaidia',
		'solarizedlight',
		'tomorrow',
		'twilight',
	];

	for( var i = 0; i < themes.length; i++ ) {
		var themeLink = $( '#wp-code-snippets-prism-' + themes[ i ] + '-css' );
		themes = themes.push( themeLink );
	}

	console.log( themes[ 1 ] );

} );

})( jQuery );
